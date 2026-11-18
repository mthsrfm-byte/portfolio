/* Sera · proposal: "a laundromat becomes a construction site, then 48 homes" (three.js, vendored).
   Sticky beside the stage list; the scroll through the stages drives it:
     01 Assessment  → today's single-storey laundromat, surveyed in dashed lines with dimensions
     02 Foundations → it clears; the teal slab, the concrete podium and a light frame go up
     03 Refinement  → four floors of homes (12 a floor), balconies, roof, a new laundromat at the corner
   Hidden lines are removed with paper-coloured solids, so it reads like a drawing, not a wireframe.
   Reduced motion: the finished building, no scroll link. No WebGL: the figure hides. */
(function () {
  'use strict';
  var wrap = document.querySelector('[data-build-scroll]');
  var host = document.querySelector('[data-building]');
  if (!wrap || !host) { return; }
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var stages = Array.prototype.slice.call(wrap.querySelectorAll('[data-stage]'));

  var activeId = '';
  function markActive() {
    var vh = window.innerHeight, id = stages.length ? stages[0].getAttribute('data-stage') : '';
    var line = window.innerWidth < 900 ? 0.78 : 0.55;
    stages.forEach(function (s) { if (s.getBoundingClientRect().top < vh * line) { id = s.getAttribute('data-stage'); } });
    if (id !== activeId) {
      activeId = id;
      stages.forEach(function (s) { s.classList.toggle('is-active', s.getAttribute('data-stage') === id); });
    }
  }
  if (!reduce) { wrap.classList.add('is-on'); }
  markActive();

  if (!window.THREE) { host.hidden = true; return; }
  var THREE = window.THREE;
  var canvas = document.createElement('canvas');
  var renderer;
  try { renderer = new THREE.WebGLRenderer({ canvas: canvas, antialias: true, alpha: true }); } catch (e) { host.hidden = true; return; }
  var stageEl = host.querySelector('.p-bld-stage');
  stageEl.appendChild(canvas);
  renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));

  var INK = 0x1A1F23, TEAL = 0x0B6E73, SAGE = 0x86A398, GREY = 0x8F8C84, PAPER = 0xF5F4EF, SAND = 0xEDE6D6;
  var scene = new THREE.Scene();
  var camera = new THREE.PerspectiveCamera(26, 1, 0.1, 500);
  var root = new THREE.Group();
  scene.add(root);

  var seed = 23;
  function rnd() { seed = (seed * 16807) % 2147483647; return (seed - 1) / 2147483646; }

  /* Lines. `pencil` adds a faint second pass that overshoots corners (outlines only). */
  function lines(segs, color, opacity, opts) {
    opts = opts || {};
    var g = new THREE.Group();
    var a = [], b = [];
    for (var i = 0; i < segs.length; i += 2) {
      var p = segs[i], q = segs[i + 1];
      a.push(p[0], p[1], p[2], q[0], q[1], q[2]);
      if (opts.pencil) {
        var dx = q[0] - p[0], dy = q[1] - p[1], dz = q[2] - p[2];
        var len = Math.sqrt(dx * dx + dy * dy + dz * dz) || 1, e1 = 0.35 * rnd() / len, e2 = 0.35 * rnd() / len, j = 0.05;
        b.push(p[0] - dx * e1 + (rnd() - 0.5) * j, p[1] - dy * e1 + (rnd() - 0.5) * j, p[2] - dz * e1 + (rnd() - 0.5) * j,
               q[0] + dx * e2 + (rnd() - 0.5) * j, q[1] + dy * e2 + (rnd() - 0.5) * j, q[2] + dz * e2 + (rnd() - 0.5) * j);
      }
    }
    var passes = [[a, opacity]];
    if (opts.pencil) { passes.push([b, opacity * 0.35]); }
    passes.forEach(function (pair) {
      var geo = new THREE.BufferGeometry();
      geo.setAttribute('position', new THREE.Float32BufferAttribute(pair[0], 3));
      var mat = opts.dashed
        ? new THREE.LineDashedMaterial({ color: color, transparent: true, opacity: pair[1], dashSize: 0.5, gapSize: 0.35 })
        : new THREE.LineBasicMaterial({ color: color, transparent: true, opacity: pair[1] });
      mat.userData.base = pair[1];
      var l = new THREE.LineSegments(geo, mat);
      if (opts.dashed) { l.computeLineDistances(); }
      g.add(l);
    });
    return g;
  }
  /* Paper-coloured solid that hides what is behind it (lines on its faces still show). */
  function solid(x0, y0, z0, x1, y1, z1, color) {
    var m = new THREE.Mesh(new THREE.BoxGeometry(x1 - x0, y1 - y0, z1 - z0),
      new THREE.MeshBasicMaterial({ color: color || PAPER, polygonOffset: true, polygonOffsetFactor: 1, polygonOffsetUnits: 2 }));
    m.position.set((x0 + x1) / 2, (y0 + y1) / 2, (z0 + z1) / 2);
    m.userData.solid = true;
    return m;
  }
  function seg(o, x1, y1, z1, x2, y2, z2) { o.push([x1, y1, z1], [x2, y2, z2]); }
  function box(o, x0, y0, z0, x1, y1, z1) {
    var c = [[x0, z0], [x1, z0], [x1, z1], [x0, z1]];
    for (var i = 0; i < 4; i++) {
      var p = c[i], q = c[(i + 1) % 4];
      seg(o, p[0], y0, p[1], q[0], y0, q[1]); seg(o, p[0], y1, p[1], q[0], y1, q[1]); seg(o, p[0], y0, p[1], p[0], y1, p[1]);
    }
  }
  // façade helpers: 'z' = front (constant z, u = x), 'x' = side (constant x, u = z)
  function P(ax, c, u, v, out) { return ax === 'z' ? [u, v, c + (out || 0)] : [c + (out || 0), v, u]; }
  function L(o, ax, c, u1, v1, u2, v2, out) { o.push(P(ax, c, u1, v1, out), P(ax, c, u2, v2, out)); }
  function R(o, ax, c, u0, v0, u1, v1, out) { L(o, ax, c, u0, v0, u1, v0, out); L(o, ax, c, u1, v0, u1, v1, out); L(o, ax, c, u1, v1, u0, v1, out); L(o, ax, c, u0, v1, u0, v0, out); }
  function circle(o, ax, c, u, v, r, out) {
    for (var i = 0; i < 14; i++) {
      var a1 = i / 14 * Math.PI * 2, a2 = (i + 1) / 14 * Math.PI * 2;
      L(o, ax, c, u + Math.cos(a1) * r, v + Math.sin(a1) * r, u + Math.cos(a2) * r, v + Math.sin(a2) * r, out);
    }
  }
  function win(o, ax, c, u, v, w, h) {
    R(o, ax, c, u - w / 2, v, u + w / 2, v + h, 0.01);
    L(o, ax, c, u, v, u, v + h, 0.01);
    L(o, ax, c, u - w / 2 - 0.12, v - 0.02, u + w / 2 + 0.12, v - 0.02, 0.12);
  }
  function balcony(o, ax, c, u, v, w) {
    var d = 1.25, top = v + 1.05;
    R(o, ax, c, u - w / 2, v - 0.18, u + w / 2, v, d);
    o.push(P(ax, c, u - w / 2, v, 0), P(ax, c, u - w / 2, v, d), P(ax, c, u + w / 2, v, 0), P(ax, c, u + w / 2, v, d));
    L(o, ax, c, u - w / 2, top, u + w / 2, top, d);
    o.push(P(ax, c, u - w / 2, top, d), P(ax, c, u - w / 2, v, d), P(ax, c, u + w / 2, top, d), P(ax, c, u + w / 2, v, d));
    for (var x = u - w / 2 + 0.25; x < u + w / 2 - 0.1; x += 0.25) { L(o, ax, c, x, v, x, top - 0.05, d); }
    R(o, ax, c, u - 0.7, v, u + 0.7, v + 2.15, 0.01); // door behind
    L(o, ax, c, u, v, u, v + 2.15, 0.01);
  }
  function awning(o, ax, c, u0, u1, v, d, n) {
    for (var i = 0; i <= n; i++) { var u = u0 + (u1 - u0) * i / n; o.push(P(ax, c, u, v, 0), P(ax, c, u, v - 0.7, d)); }
    L(o, ax, c, u0, v, u1, v, 0); L(o, ax, c, u0, v - 0.7, u1, v - 0.7, d); L(o, ax, c, u0, v - 0.95, u1, v - 0.95, d);
    o.push(P(ax, c, u0, v - 0.7, d), P(ax, c, u0, v - 0.95, d), P(ax, c, u1, v - 0.7, d), P(ax, c, u1, v - 0.95, d));
  }

  var parts = [];
  // kind: fade | drop | slab | rise; out: [c, d] to fade away again
  function add(obj, a, b, kind, out) { root.add(obj); parts.push({ obj: obj, a: a, b: b, kind: kind || 'fade', out: out }); return obj; }

  /* ---------- 01 · today's laundromat, surveyed ---------- */
  var LA = { x0: -8, x1: 8, z0: -5, z1: 5, h: 4.4 };
  var la = [];
  box(la, LA.x0, 0, LA.z0, LA.x1, LA.h, LA.z1);
  box(la, LA.x0 - 0.1, LA.h, LA.z0 - 0.1, LA.x1 + 0.1, LA.h + 0.6, LA.z1 + 0.1);
  R(la, 'z', LA.z1, LA.x0 + 1, 0.3, LA.x1 - 4.5, 3, 0.01);
  for (var lw = LA.x0 + 1; lw < LA.x1 - 4.5; lw += 2.5) { L(la, 'z', LA.z1, lw, 0.3, lw, 3, 0.01); }
  for (var wm = 0; wm < 4; wm++) { circle(la, 'z', LA.z1, LA.x0 + 2.2 + wm * 2.5, 1.3, 0.55, -0.3); }
  R(la, 'z', LA.z1, LA.x1 - 3.6, 0, LA.x1 - 1.4, 2.6, 0.01);
  R(la, 'z', LA.z1, LA.x0 + 2, 3.5, LA.x1 - 2, 4.2, 0.02);
  awning(la, 'z', LA.z1, LA.x0 + 0.6, LA.x1 - 4.2, 3.25, 1.2, 10);
  add(lines(la, GREY, 0.95, { dashed: true }), 0, 0.14, 'fade', [0.28, 0.36]);
  var dm = [];
  var lot = { x0: -12, x1: 12, z0: -8, z1: 8 };
  [[lot.x0, lot.z0], [lot.x1, lot.z0], [lot.x1, lot.z1], [lot.x0, lot.z1]].forEach(function (c) {
    seg(dm, c[0] - 0.8, 0, c[1], c[0] + 0.8, 0, c[1]); seg(dm, c[0], 0, c[1] - 0.8, c[0], 0, c[1] + 0.8);
  });
  var dz = lot.z1 + 1.4;
  seg(dm, lot.x0, 0, dz, lot.x1, 0, dz);
  [lot.x0, LA.x0, LA.x1, lot.x1].forEach(function (x) { seg(dm, x, 0, dz - 0.45, x, 0, dz + 0.45); seg(dm, x - 0.3, 0, dz - 0.3, x + 0.3, 0, dz + 0.3); });
  var dxl = lot.x1 + 1.4;
  seg(dm, dxl, 0, lot.z0, dxl, 0, lot.z1);
  [lot.z0, lot.z1].forEach(function (z) { seg(dm, dxl - 0.45, 0, z, dxl + 0.45, 0, z); });
  add(lines(dm, GREY, 0.9), 0.04, 0.18, 'fade', [0.56, 0.66]);

  /* ---------- 02 · slab, podium, frame ---------- */
  var B = { x0: -11, x1: 11, z0: -7, z1: 7 };
  var PH = 4.6, FH = 3.1, FLOORS = 4, TOP = PH + FLOORS * FH;
  var SL = { x0: B.x0 - 1.4, x1: B.x1 + 1.4, z0: B.z0 - 1.4, z1: B.z1 + 1.4, h: 1 };
  var slab = new THREE.Group();
  var sfill = new THREE.Mesh(new THREE.BoxGeometry(SL.x1 - SL.x0, SL.h, SL.z1 - SL.z0),
    new THREE.MeshBasicMaterial({ color: 0xD6E6E3, polygonOffset: true, polygonOffsetFactor: 1, polygonOffsetUnits: 2 }));
  sfill.position.set(0, -SL.h / 2, 0);
  sfill.userData.solid = true;
  slab.add(sfill);
  var sl = [];
  box(sl, SL.x0, -SL.h, SL.z0, SL.x1, 0, SL.z1);
  for (var hx = SL.x0 + 0.45; hx < SL.x1; hx += 0.55) { seg(sl, hx, -SL.h, SL.z1, hx + 0.45, 0, SL.z1); }
  for (var hz = SL.z0 + 0.45; hz < SL.z1; hz += 0.55) { seg(sl, SL.x1, -SL.h, hz, SL.x1, 0, hz + 0.45); }
  slab.add(lines(sl, TEAL, 1));
  add(slab, 0.32, 0.42, 'slab');

  // light structural frame on a 3.66 × 3.5 m grid; it fades away when the façades arrive
  var fr = [];
  for (var cx = 0; cx <= 6; cx++) {
    for (var cz = 0; cz <= 4; cz++) {
      if (cx > 0 && cx < 6 && cz > 0 && cz < 4) { continue; }
      var x = B.x0 + (B.x1 - B.x0) * cx / 6, z = B.z0 + (B.z1 - B.z0) * cz / 4;
      seg(fr, x, 0, z, x, TOP, z);
    }
  }
  for (var lv = 1; lv <= FLOORS; lv++) { box(fr, B.x0, PH + (lv - 1) * FH, B.z0, B.x1, PH + (lv - 1) * FH, B.z1); }
  add(lines(fr, INK, 0.32), 0.4, 0.54, 'rise', [0.62, 0.74]);

  // podium: concrete ground floor (solid, sand tint) with its slab edge
  var podium = new THREE.Group();
  podium.add(solid(B.x0, 0, B.z0, B.x1, PH, B.z1, SAND));
  var po = [];
  box(po, B.x0, 0, B.z0, B.x1, PH, B.z1);
  box(po, B.x0 - 0.2, PH - 0.35, B.z0 - 0.2, B.x1 + 0.2, PH, B.z1 + 0.2);
  for (var pc = 0; pc <= 6; pc++) { var px = B.x0 + (B.x1 - B.x0) * pc / 6; seg(po, px, 0, B.z1 + 0.01, px, PH - 0.35, B.z1 + 0.01); }
  for (var pz = 0; pz <= 4; pz++) { var pzz = B.z0 + (B.z1 - B.z0) * pz / 4; seg(po, B.x1 + 0.01, 0, pzz, B.x1 + 0.01, PH - 0.35, pzz); }
  podium.add(lines(po, INK, 0.95, { pencil: true }));
  add(podium, 0.44, 0.56, 'rise');

  /* ---------- 03 · the homes ---------- */
  var sh = [];
  var bay = (B.x1 - B.x0) / 6;
  for (var b2 = 0; b2 < 6; b2++) {
    var u0 = B.x0 + bay * b2 + 0.35, u1 = B.x0 + bay * (b2 + 1) - 0.35;
    if (b2 === 2) { R(sh, 'z', B.z1, u0 + 0.4, 0, u1 - 0.4, 3, 0.02); L(sh, 'z', B.z1, (u0 + u1) / 2, 0, (u0 + u1) / 2, 3, 0.02); continue; }
    R(sh, 'z', B.z1, u0, 0.35, u1, 3.4, 0.02);
    L(sh, 'z', B.z1, u0, 2.8, u1, 2.8, 0.02);
  }
  box(sh, B.x0 + bay * 2 - 0.4, 3.35, B.z1, B.x0 + bay * 3 + 0.4, 3.5, B.z1 + 1.6);   // lobby canopy
  awning(sh, 'z', B.z1, B.x0 + bay * 4 + 0.3, B.x1 - 0.3, 3.9, 1.3, 12);                // the new laundromat
  for (var wsh = 0; wsh < 5; wsh++) { circle(sh, 'z', B.z1, B.x0 + bay * 4 + 0.9 + wsh * 1.35, 1.3, 0.45, -0.3); }
  for (var sb = 0; sb < 4; sb++) {
    var su0 = B.z0 + (B.z1 - B.z0) * sb / 4 + 0.35, su1 = B.z0 + (B.z1 - B.z0) * (sb + 1) / 4 - 0.35;
    R(sh, 'x', B.x1, su0, 0.35, su1, 3.4, 0.02);
  }
  for (var wsx = 0; wsx < 3; wsx++) { circle(sh, 'x', B.x1, B.z1 - 1.2 - wsx * 1.35, 1.3, 0.45, -0.3); }
  add(lines(sh, INK, 0.85), 0.62, 0.7, 'fade');

  function floor(i) {
    var g = new THREE.Group();
    var y0 = PH + i * FH, y1 = y0 + FH;
    g.add(solid(B.x0, y0, B.z0, B.x1, y1, B.z1));
    var o = [], d = [];
    box(o, B.x0, y0, B.z0, B.x1, y1, B.z1);
    L(o, 'z', B.z1, B.x0, y1 - 0.08, B.x1, y1 - 0.08, 0.06);
    L(o, 'x', B.x1, B.z0, y1 - 0.08, B.z1, y1 - 0.08, 0.06);
    for (var k = 0; k < 6; k++) {
      var u = B.x0 + bay * (k + 0.5);
      if ((k + i) % 2 === 0) { balcony(d, 'z', B.z1, u, y0 + 0.15, 2.7); } else { win(d, 'z', B.z1, u, y0 + 0.75, 1.5, 1.75); }
    }
    for (var s2 = 0; s2 < 4; s2++) {
      var zu = B.z0 + (B.z1 - B.z0) * (s2 + 0.5) / 4;
      if (s2 === 1 && i % 2 === 1) { balcony(d, 'x', B.x1, zu, y0 + 0.15, 2.4); } else { win(d, 'x', B.x1, zu, y0 + 0.75, 1.3, 1.75); }
    }
    g.add(lines(o, INK, 0.95, { pencil: true }));
    g.add(lines(d, INK, 0.8));
    return g;
  }
  for (var f = 0; f < FLOORS; f++) { add(floor(f), 0.66 + f * 0.06, 0.73 + f * 0.06, 'drop'); }

  var rf = new THREE.Group();
  rf.add(solid(B.x0 + 2, TOP, B.z0 + 1.5, B.x0 + 7, TOP + 2.8, B.z0 + 5));
  var ro = [];
  box(ro, B.x0 - 0.12, TOP, B.z0 - 0.12, B.x1 + 0.12, TOP + 0.7, B.z1 + 0.12);
  box(ro, B.x0 + 2, TOP, B.z0 + 1.5, B.x0 + 7, TOP + 2.8, B.z0 + 5);
  for (var r1 = 0; r1 < 3; r1++) {
    for (var r2 = 0; r2 < 4; r2++) {
      var sx = B.x0 + 9 + r2 * 2.9, sz = B.z0 + 1.6 + r1 * 3.6;
      seg(ro, sx, TOP + 0.4, sz + 2.2, sx + 2.4, TOP + 0.4, sz + 2.2);
      seg(ro, sx, TOP + 1.3, sz, sx + 2.4, TOP + 1.3, sz);
      seg(ro, sx, TOP + 0.4, sz + 2.2, sx, TOP + 1.3, sz);
      seg(ro, sx + 2.4, TOP + 0.4, sz + 2.2, sx + 2.4, TOP + 1.3, sz);
      seg(ro, sx + 1.2, TOP + 0.4, sz + 2.2, sx + 1.2, TOP + 1.3, sz);
    }
  }
  rf.add(lines(ro, INK, 0.9, { pencil: true }));
  add(rf, 0.9, 0.95, 'drop');

  var gr = [];
  seg(gr, -17, 0, SL.z1 + 2.2, 17, 0, SL.z1 + 2.2);
  seg(gr, -17, 0, SL.z1 + 5.4, 17, 0, SL.z1 + 5.4);
  for (var pv = -16; pv < 17; pv += 2.4) { seg(gr, pv, 0, SL.z1 + 2.2, pv, 0, SL.z1 + 5.4); }
  add(lines(gr, INK, 0.22), 0.9, 0.97, 'fade');
  function tree(x, z, h, r) {
    var t = [], l = [];
    seg(t, x, 0, z, x, h * 0.82, z);
    seg(t, x, h * 0.35, z, x - r * 0.5, h * 0.62, z); seg(t, x, h * 0.45, z, x + r * 0.55, h * 0.72, z);
    for (var i = 0; i < 12; i++) {
      var tt = -1 + (i + 0.5) * (2 / 12), y = h * 0.7 + tt * r * 1.15;
      var rr = r * Math.sqrt(Math.max(0.05, 1 - tt * tt)) * (0.85 + rnd() * 0.3), off = (rnd() - 0.5) * 0.4;
      seg(l, x - rr + off, y, z, x + rr + off, y + 0.22, z);
    }
    var g = new THREE.Group();
    g.add(lines(t, INK, 0.65)); g.add(lines(l, SAGE, 1));
    return g;
  }
  function person(x, z, s) {
    var o = [], h = 1.75 * (s || 1);
    for (var a = 0; a < 10; a++) { var t1 = a / 10 * Math.PI * 2, t2 = (a + 1) / 10 * Math.PI * 2; seg(o, x + Math.cos(t1) * 0.14, h - 0.14 + Math.sin(t1) * 0.14, z, x + Math.cos(t2) * 0.14, h - 0.14 + Math.sin(t2) * 0.14, z); }
    seg(o, x, h - 0.3, z, x, h * 0.48, z); seg(o, x, h * 0.48, z, x - 0.25, 0, z); seg(o, x, h * 0.48, z, x + 0.22, 0, z + 0.1);
    seg(o, x, h * 0.75, z, x - 0.3, h * 0.5, z); seg(o, x, h * 0.75, z, x + 0.28, h * 0.52, z);
    return lines(o, INK, 0.85);
  }
  function lamp(x, z) { var o = []; seg(o, x, 0, z, x, 5.2, z); seg(o, x, 5.2, z, x - 1, 5.2, z); seg(o, x - 1.25, 5.05, z, x - 0.75, 5.05, z); return lines(o, INK, 0.7); }
  add(tree(-14.2, SL.z1 + 3.6, 8.6, 2.3), 0.9, 0.98);
  add(tree(14.6, SL.z1 + 1.2, 7.8, 2.1), 0.92, 1);
  add(lamp(4.5, SL.z1 + 2.5), 0.92, 0.99);
  add(person(-3.2, SL.z1 + 3.4), 0.93, 1);
  add(person(8.8, SL.z1 + 4.4, 0.95), 0.94, 1);

  root.position.set(-0.4, -7.6, 0);

  /* ---------- callouts ---------- */
  var anchors = {
    assess: new THREE.Vector3(LA.x0 + 2, LA.h + 0.6, LA.z1),
    found: new THREE.Vector3(SL.x0 + 1.4, -SL.h * 0.45, SL.z1),
    refine: new THREE.Vector3(B.x1 + 1.25, PH + FH + 1.0, B.z0 + (B.z1 - B.z0) * 0.375)
  };
  var spans = { assess: [0, 0.3], found: [0.3, 0.6], refine: [0.6, 1.01] };
  var svg = host.querySelector('.p-bld-lines');
  var homes = host.querySelector('[data-homes]');
  var tags = {};
  Object.keys(anchors).forEach(function (k) {
    tags[k] = { el: host.querySelector('[data-tag="' + k + '"]'), line: svg && svg.querySelector('[data-line="' + k + '"]'), dot: svg && svg.querySelector('[data-dot="' + k + '"]') };
  });

  /* ---------- loop ---------- */
  var W = 1, H = 1;
  function resize() {
    var r = stageEl.getBoundingClientRect();
    W = Math.max(1, Math.round(r.width)); H = Math.max(1, Math.round(r.height));
    renderer.setSize(W, H, false);
    canvas.style.width = W + 'px'; canvas.style.height = H + 'px';
    camera.aspect = W / H; camera.updateProjectionMatrix();
    if (svg) { svg.setAttribute('viewBox', '0 0 ' + W + ' ' + H); }
  }
  function clamp(x) { return x < 0 ? 0 : x > 1 ? 1 : x; }
  function ease(x) { x = clamp(x); return x * x * (3 - 2 * x); }
  function setOpacity(obj, k) {
    obj.traverse(function (o) {
      if (o.userData.solid) { o.visible = k > 0.5; return; }
      if (o.material && o.material.userData.base != null) { o.material.opacity = o.material.userData.base * k; }
    });
  }
  function target() {
    if (reduce) { return 1; }
    var r = wrap.getBoundingClientRect(), vh = window.innerHeight;
    return clamp((vh * 0.62 - r.top) / Math.max(1, r.height - vh * 0.55));
  }
  var prog = target(), raf = 0, near = true;
  var v = new THREE.Vector3();

  function frame() {
    raf = 0;
    var goal = target();
    prog += (goal - prog) * 0.12;
    if (Math.abs(goal - prog) < 0.0005) { prog = goal; }
    var p = prog;

    parts.forEach(function (it) {
      var kin = ease((p - it.a) / (it.b - it.a));
      var k = it.out ? kin * (1 - ease((p - it.out[0]) / (it.out[1] - it.out[0]))) : kin;
      if (it.kind === 'slab') { it.obj.scale.set(0.75 + 0.25 * kin, Math.max(0.001, kin), 0.75 + 0.25 * kin); }
      if (it.kind === 'rise') { it.obj.scale.y = Math.max(0.001, kin); }
      if (it.kind === 'drop') { it.obj.position.y = (1 - kin) * 2.2; }
      setOpacity(it.obj, k);
      it.obj.visible = k > 0.002;
    });

    var az = 0.6 + p * 0.28;
    var el = 0.26 - p * 0.06;
    // the camera starts close on the laundromat and pulls back as the building grows
    var grow = ease(p / 0.92);
    var fit = 1 / Math.min(1.25, Math.max(0.55, camera.aspect));
    var dist = (56 + 28 * grow) * Math.max(1, fit * 0.95);
    var lookY = -4.6 + 6.2 * grow;
    camera.position.set(Math.sin(az) * Math.cos(el) * dist, lookY + Math.sin(el) * dist, Math.cos(az) * Math.cos(el) * dist);
    camera.lookAt(0.4, lookY, 0.6);
    renderer.render(scene, camera);
    host.style.setProperty('--bp', p.toFixed(3));
    if (homes) { homes.classList.toggle('is-on', p > 0.95); }

    var sr = stageEl.getBoundingClientRect();
    Object.keys(anchors).forEach(function (k) {
      var tg = tags[k];
      if (!tg.el) { return; }
      var sp = spans[k];
      var on = p >= sp[0] - 0.02 && p < sp[1];
      var shown = reduce ? 1 : ease((p - sp[0] + 0.04) / 0.06);
      tg.el.classList.toggle('is-on', on && !reduce);
      tg.el.style.opacity = String(shown * (on || reduce ? 1 : 0.55));
      v.copy(anchors[k]).add(root.position).project(camera);
      var ax = (v.x * 0.5 + 0.5) * W, ay = (-v.y * 0.5 + 0.5) * H;
      var er = tg.el.getBoundingClientRect(), right = tg.el.classList.contains('is-right');
      var ex = (right ? er.left : er.right) - sr.left, ey = er.top - sr.top + er.height / 2;
      var lo = String(shown * (on || reduce ? 1 : 0.35));
      if (tg.line) { tg.line.setAttribute('x1', ex.toFixed(1)); tg.line.setAttribute('y1', ey.toFixed(1)); tg.line.setAttribute('x2', ax.toFixed(1)); tg.line.setAttribute('y2', ay.toFixed(1)); tg.line.style.opacity = lo; }
      if (tg.dot) { tg.dot.setAttribute('cx', ax.toFixed(1)); tg.dot.setAttribute('cy', ay.toFixed(1)); tg.dot.style.opacity = lo; }
    });

    if (near && Math.abs(target() - prog) > 0.0005) { raf = requestAnimationFrame(frame); }
  }
  function kick() { markActive(); if (near && !raf) { raf = requestAnimationFrame(frame); } }

  resize();
  window.addEventListener('scroll', kick, { passive: true });
  window.addEventListener('resize', function () { resize(); kick(); });
  if ('ResizeObserver' in window) { new ResizeObserver(function () { resize(); kick(); }).observe(stageEl); }
  if ('IntersectionObserver' in window) {
    new IntersectionObserver(function (en) { near = en[0].isIntersecting; if (near) { resize(); kick(); } }, { rootMargin: '200px 0px' }).observe(wrap);
  }
  kick();
  host.classList.add('is-ready');
})();
