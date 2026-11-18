/* Sera · proposal: the building that the three stages put up (three.js, vendored in assets/js/lib).
   Sticky beside the stage list; the scroll through the stages drives it:
     01 Assessment  → a dashed survey of what is already there, with dimension lines
     02 Foundations → the teal slab, then columns and floor plates rising
     03 Refinement  → façades, windows, balconies, roof and context, floor by floor
   Reduced motion: the finished building, no scroll link. No WebGL: the figure hides and the
   stage list stays as plain reading. Nothing renders while the section is off screen. */
(function () {
  'use strict';
  var wrap = document.querySelector('[data-build-scroll]');
  var host = document.querySelector('[data-building]');
  if (!wrap || !host) { return; }
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var stages = Array.prototype.slice.call(wrap.querySelectorAll('[data-stage]'));

  /* Which stage is being read (works with or without WebGL). */
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
  try {
    renderer = new THREE.WebGLRenderer({ canvas: canvas, antialias: true, alpha: true });
  } catch (e) {
    host.hidden = true;
    return;
  }
  var stageEl = host.querySelector('.p-bld-stage');
  stageEl.appendChild(canvas);
  renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));

  var INK = 0x1A1F23, TEAL = 0x0B6E73, SAGE = 0x86A398, GREY = 0x8A8780;
  var scene = new THREE.Scene();
  var camera = new THREE.PerspectiveCamera(26, 1, 0.1, 500);
  var root = new THREE.Group();
  scene.add(root);

  var seed = 11;
  function rnd() { seed = (seed * 16807) % 2147483647; return (seed - 1) / 2147483646; }

  /* Segments drawn as an ink line plus a faint pencil pass that overshoots the corners a little. */
  function sketch(segs, color, opacity, opts) {
    opts = opts || {};
    var g = new THREE.Group();
    var a = [], b = [];
    var j = opts.jitter == null ? 0.05 : opts.jitter;
    var over = opts.over == null ? 0.22 : opts.over;
    for (var i = 0; i < segs.length; i += 2) {
      var p = segs[i], q = segs[i + 1];
      a.push(p[0], p[1], p[2], q[0], q[1], q[2]);
      var dx = q[0] - p[0], dy = q[1] - p[1], dz = q[2] - p[2];
      var len = Math.sqrt(dx * dx + dy * dy + dz * dz) || 1;
      var e1 = over * rnd() / len, e2 = over * rnd() / len;
      b.push(p[0] - dx * e1 + (rnd() - 0.5) * j, p[1] - dy * e1 + (rnd() - 0.5) * j, p[2] - dz * e1 + (rnd() - 0.5) * j,
             q[0] + dx * e2 + (rnd() - 0.5) * j, q[1] + dy * e2 + (rnd() - 0.5) * j, q[2] + dz * e2 + (rnd() - 0.5) * j);
    }
    var passes = opts.dashed ? [[a, opacity]] : [[a, opacity], [b, opacity * 0.4]];
    passes.forEach(function (pair) {
      var geo = new THREE.BufferGeometry();
      geo.setAttribute('position', new THREE.Float32BufferAttribute(pair[0], 3));
      var mat = opts.dashed
        ? new THREE.LineDashedMaterial({ color: color, transparent: true, opacity: pair[1], dashSize: 0.45, gapSize: 0.35 })
        : new THREE.LineBasicMaterial({ color: color, transparent: true, opacity: pair[1] });
      mat.userData.base = pair[1];
      var line = new THREE.LineSegments(geo, mat);
      if (opts.dashed) { line.computeLineDistances(); }
      g.add(line);
    });
    return g;
  }
  function seg(o, x1, y1, z1, x2, y2, z2) { o.push([x1, y1, z1], [x2, y2, z2]); }
  function box(o, x0, y0, z0, x1, y1, z1) {
    var c = [[x0, z0], [x1, z0], [x1, z1], [x0, z1]];
    for (var i = 0; i < 4; i++) {
      var p = c[i], q = c[(i + 1) % 4];
      seg(o, p[0], y0, p[1], q[0], y0, q[1]);
      seg(o, p[0], y1, p[1], q[0], y1, q[1]);
      seg(o, p[0], y0, p[1], p[0], y1, p[1]);
    }
  }
  // A point on a façade: axis 'z' (front, constant z, u = x) or 'x' (side, constant x, u = z).
  function P(axis, c, u, v, out) { return axis === 'z' ? [u, v, c + (out || 0)] : [c + (out || 0), v, u]; }
  function line2(o, axis, c, u1, v1, u2, v2, out) { o.push(P(axis, c, u1, v1, out), P(axis, c, u2, v2, out)); }
  function rect(o, axis, c, u0, v0, u1, v1, out) {
    line2(o, axis, c, u0, v0, u1, v0, out); line2(o, axis, c, u1, v0, u1, v1, out);
    line2(o, axis, c, u1, v1, u0, v1, out); line2(o, axis, c, u0, v1, u0, v0, out);
  }
  function windowAt(o, axis, c, u, v, w, h) {
    rect(o, axis, c, u - w / 2, v, u + w / 2, v + h, 0.02);
    rect(o, axis, c, u - w / 2 + 0.1, v + 0.1, u + w / 2 - 0.1, v + h - 0.1, 0.02); // frame
    line2(o, axis, c, u, v + 0.1, u, v + h - 0.1, 0.02);                              // mullion
    line2(o, axis, c, u - w / 2 + 0.1, v + h * 0.72, u + w / 2 - 0.1, v + h * 0.72, 0.02); // transom
    line2(o, axis, c, u - w / 2 - 0.15, v, u + w / 2 + 0.15, v, 0.14);               // sill
    line2(o, axis, c, u - w / 2 - 0.15, v - 0.08, u + w / 2 + 0.15, v - 0.08, 0.14);
  }
  function balcony(o, axis, c, u, v, w) {
    var d = 1.2, top = v + 1.05;
    rect(o, axis, c, u - w / 2, v - 0.2, u + w / 2, v, d);                      // slab edge
    o.push(P(axis, c, u - w / 2, v, 0), P(axis, c, u - w / 2, v, d));
    o.push(P(axis, c, u + w / 2, v, 0), P(axis, c, u + w / 2, v, d));
    line2(o, axis, c, u - w / 2, top, u + w / 2, top, d);                       // handrail
    line2(o, axis, c, u - w / 2, top - 0.08, u + w / 2, top - 0.08, d);
    o.push(P(axis, c, u - w / 2, top, 0), P(axis, c, u - w / 2, top, d));
    o.push(P(axis, c, u + w / 2, top, 0), P(axis, c, u + w / 2, top, d));
    for (var x = u - w / 2; x <= u + w / 2 + 0.001; x += 0.14) { line2(o, axis, c, x, v, x, top, d); }
    rect(o, axis, c, u - 0.75, v, u + 0.75, v + 2.2, 0.02);                    // French door
    line2(o, axis, c, u, v, u, v + 2.2, 0.02);
    line2(o, axis, c, u - 0.75, v + 1.75, u + 0.75, v + 1.75, 0.02);
  }

  /* ---------- program ---------- */
  var FH = 3.1;
  var MAIN = { x0: -5.2, x1: 4.2, z0: -4.2, z1: 3.6, floors: 5 };
  var WING = { x0: 4.2, x1: 9, z0: -3.4, z1: 2.4, floors: 4 };
  var SL = { x0: -6.8, x1: 10.4, z0: -5.4, z1: 5, h: 1 };
  var parts = []; // { obj, a, b, kind }: appears while the scroll progress goes from a to b

  function add(obj, a, b, kind) { root.add(obj); parts.push({ obj: obj, a: a, b: b, kind: kind || 'fade' }); return obj; }

  // 01 · survey: dashed volumes of what is there, dimension lines.
  var sv = [];
  box(sv, MAIN.x0, 0, MAIN.z0, MAIN.x1, MAIN.floors * FH, MAIN.z1);
  box(sv, WING.x0, 0, WING.z0, WING.x1, WING.floors * FH, WING.z1);
  for (var fl = 1; fl < MAIN.floors; fl++) {
    seg(sv, MAIN.x0, fl * FH, MAIN.z1, MAIN.x1, fl * FH, MAIN.z1);
    if (fl < WING.floors) { seg(sv, WING.x1, fl * FH, WING.z0, WING.x1, fl * FH, WING.z1); }
  }
  add(sketch(sv, GREY, 0.9, { dashed: true }), 0.0, 0.16, 'survey');
  var dim = [];
  var dz = SL.z1 + 1.6;
  seg(dim, MAIN.x0, -SL.h, dz, WING.x1, -SL.h, dz);
  [MAIN.x0, MAIN.x1, WING.x1].forEach(function (x) { seg(dim, x, -SL.h, dz - 0.5, x, -SL.h, dz + 0.5); seg(dim, x - 0.3, -SL.h, dz - 0.3, x + 0.3, -SL.h, dz + 0.3); });
  var dxl = SL.x1 + 1.6;
  seg(dim, dxl, -SL.h, MAIN.z0, dxl, -SL.h, MAIN.z1);
  [MAIN.z0, MAIN.z1].forEach(function (z) { seg(dim, dxl - 0.5, -SL.h, z, dxl + 0.5, -SL.h, z); });
  seg(dim, MAIN.x0 - 1.2, 0, MAIN.z1 + 0.2, MAIN.x0 - 1.2, MAIN.floors * FH, MAIN.z1 + 0.2);
  for (var hy = 0; hy <= MAIN.floors; hy++) { seg(dim, MAIN.x0 - 1.5, hy * FH, MAIN.z1 + 0.2, MAIN.x0 - 0.9, hy * FH, MAIN.z1 + 0.2); }
  add(sketch(dim, GREY, 0.85, { jitter: 0.02, over: 0.1 }), 0.04, 0.2, 'survey');

  // 02 · slab, structure.
  var slab = new THREE.Group();
  var fill = new THREE.Mesh(
    new THREE.BoxGeometry(SL.x1 - SL.x0, SL.h, SL.z1 - SL.z0),
    new THREE.MeshBasicMaterial({ color: TEAL, transparent: true, opacity: 0.15, depthWrite: false })
  );
  fill.material.userData.base = 0.15;
  fill.position.set((SL.x0 + SL.x1) / 2, -SL.h / 2, (SL.z0 + SL.z1) / 2);
  slab.add(fill);
  var sl = [];
  box(sl, SL.x0, -SL.h, SL.z0, SL.x1, 0, SL.z1);
  for (var hx = SL.x0 + 0.4; hx < SL.x1 - 0.2; hx += 0.5) { seg(sl, hx, -SL.h, SL.z1, hx + 0.42, 0, SL.z1); }
  for (var hz = SL.z0 + 0.4; hz < SL.z1 - 0.2; hz += 0.5) { seg(sl, SL.x1, -SL.h, hz, SL.x1, 0, hz + 0.42); }
  for (var gx = MAIN.x0; gx <= WING.x1 + 0.01; gx += 2.35) { seg(sl, gx, 0.01, SL.z0 + 0.6, gx, 0.01, SL.z1 - 0.6); } // footing grid
  slab.add(sketch(sl, TEAL, 1, { jitter: 0.03, over: 0.12 }));
  add(slab, 0.3, 0.42, 'slab');

  function columnsOf(spec, o) {
    var nx = Math.round((spec.x1 - spec.x0) / 2.35), nz = Math.round((spec.z1 - spec.z0) / 2.6);
    for (var i = 0; i <= nx; i++) {
      for (var k = 0; k <= nz; k++) {
        if (i > 0 && i < nx && k > 0 && k < nz) { continue; } // perimeter only, keeps it readable
        var x = spec.x0 + (spec.x1 - spec.x0) * i / nx, z = spec.z0 + (spec.z1 - spec.z0) * k / nz;
        seg(o, x, 0, z, x, spec.floors * FH, z);
        seg(o, x + 0.22, 0, z, x + 0.22, spec.floors * FH, z);
      }
    }
  }
  var col = [];
  columnsOf(MAIN, col);
  columnsOf(WING, col);
  add(sketch(col, INK, 0.55, { jitter: 0.03 }), 0.36, 0.5, 'rise');

  function plate(spec, y, o) { box(o, spec.x0 - 0.12, y - 0.3, spec.z0 - 0.12, spec.x1 + 0.12, y, spec.z1 + 0.12); }
  for (var f1 = 1; f1 <= MAIN.floors; f1++) {
    var po = [];
    plate(MAIN, f1 * FH, po);
    if (f1 <= WING.floors) { plate(WING, f1 * FH, po); }
    add(sketch(po, INK, 0.85, { jitter: 0.04 }), 0.4 + f1 * 0.035, 0.46 + f1 * 0.035, 'drop');
  }

  // 03 · façades, floor by floor.
  function facade(i) {
    var o = [];
    var y0 = i * FH;
    var m = MAIN, span = m.x1 - m.x0, depth = m.z1 - m.z0;
    if (i === 0) {
      for (var u = m.x0 + 0.5; u < m.x1 - 0.4; u += 1.15) { rect(o, 'z', m.z1, u, 0.3, u + 1.05, 2.7, 0.02); line2(o, 'z', m.z1, u, 2.1, u + 1.05, 2.1, 0.02); }
      var cx = m.x0 + span * 0.5;
      rect(o, 'z', m.z1, cx - 0.9, 0, cx + 0.9, 2.6, 0.04);
      line2(o, 'z', m.z1, cx, 0, cx, 2.6, 0.04);
      box(o, cx - 2.2, 2.85, m.z1, cx + 2.2, 3.0, m.z1 + 1.5);   // canopy
    } else {
      windowAt(o, 'z', m.z1, m.x0 + span * 0.13, y0 + 0.75, 1.3, 1.85);
      balcony(o, 'z', m.z1, m.x0 + span * 0.5, y0 + 0.15, 3.2);
      windowAt(o, 'z', m.z1, m.x0 + span * 0.87, y0 + 0.75, 1.3, 1.85);
    }
    // main side (x = x1): the part the wing doesn't cover, and the whole side above it
    windowAt(o, 'x', m.x1, m.z0 + (WING.z0 - m.z0) * 0.5, y0 + 0.75, 0.6, 1.85);
    if (i >= WING.floors) {
      for (var k = 0; k < 3; k++) { windowAt(o, 'x', m.x1, m.z0 + depth * (0.2 + k * 0.3), y0 + 0.75, 1.0, 1.85); }
    }
    [m.x0 + 0.25, m.x1 - 0.25].forEach(function (x) { seg(o, x, y0, m.z1 + 0.06, x, y0 + FH, m.z1 + 0.06); }); // pilasters
    if (i < WING.floors) {
      var w = WING, ws = w.x1 - w.x0, wd = w.z1 - w.z0;
      if (i === 0) {
        rect(o, 'z', w.z1, w.x0 + 0.6, 0.3, w.x1 - 0.6, 2.7, 0.02);
        for (var q = 1; q < 3; q++) { var qu = w.x0 + 0.6 + (ws - 1.2) * q / 3; line2(o, 'z', w.z1, qu, 0.3, qu, 2.7, 0.02); }
        windowAt(o, 'x', w.x1, w.z0 + wd * 0.5, 0.75, 2.2, 1.85);
      } else {
        rect(o, 'z', w.z1, w.x0 + 0.6, y0 + 0.8, w.x1 - 0.6, y0 + 2.5, 0.02);   // ribbon window
        for (var r = 1; r < 4; r++) { var ru = w.x0 + 0.6 + (ws - 1.2) * r / 4; line2(o, 'z', w.z1, ru, y0 + 0.8, ru, y0 + 2.5, 0.02); }
        line2(o, 'z', w.z1, w.x0 + 0.45, y0 + 0.8, w.x1 - 0.45, y0 + 0.8, 0.14);
        balcony(o, 'x', w.x1, w.z0 + wd * 0.58, y0 + 0.15, 2.4);
        windowAt(o, 'x', w.x1, w.z0 + wd * 0.15, y0 + 0.75, 0.7, 1.85);
      }
    }
    return sketch(o, INK, 0.9, { jitter: 0.05, over: 0.18 });
  }
  for (var f2 = 0; f2 < MAIN.floors; f2++) { add(facade(f2), 0.62 + f2 * 0.045, 0.69 + f2 * 0.045, 'drop'); }

  var wl = [];
  box(wl, MAIN.x0, 0, MAIN.z0, MAIN.x1, MAIN.floors * FH, MAIN.z1);
  box(wl, WING.x0, 0, WING.z0, WING.x1, WING.floors * FH, WING.z1);
  add(sketch(wl, INK, 0.95, { jitter: 0.06, over: 0.3 }), 0.6, 0.7, 'fade');

  // roof: parapets, setback penthouse, stair core, rooftop unit
  var rf = [];
  var top = MAIN.floors * FH, wtop = WING.floors * FH;
  box(rf, MAIN.x0 - 0.15, top, MAIN.z0 - 0.15, MAIN.x1 + 0.15, top + 0.55, MAIN.z1 + 0.15);
  box(rf, WING.x0, wtop, WING.z0 - 0.15, WING.x1 + 0.15, wtop + 0.5, WING.z1 + 0.15);
  box(rf, MAIN.x0 + 1.2, top, MAIN.z0 + 0.8, MAIN.x0 + 5.6, top + 2.6, MAIN.z1 - 2.4);
  for (var pm = MAIN.x0 + 1.2; pm <= MAIN.x0 + 5.61; pm += 0.88) { seg(rf, pm, top, MAIN.z1 - 2.4, pm, top + 2.6, MAIN.z1 - 2.4); }
  box(rf, MAIN.x0 + 1, top + 2.6, MAIN.z0 + 0.6, MAIN.x0 + 5.8, top + 2.75, MAIN.z1 - 2.2);
  box(rf, MAIN.x1 - 2.6, top, MAIN.z0 + 0.6, MAIN.x1 - 0.8, top + 1.3, MAIN.z0 + 2);
  var fcx = MAIN.x1 - 1.7, fcz = MAIN.z0 + 1.3;
  for (var a = 0; a < 16; a++) {
    var t1 = a / 16 * Math.PI * 2, t2 = (a + 1) / 16 * Math.PI * 2;
    seg(rf, fcx + Math.cos(t1) * 0.5, top + 1.31, fcz + Math.sin(t1) * 0.5, fcx + Math.cos(t2) * 0.5, top + 1.31, fcz + Math.sin(t2) * 0.5);
  }
  box(rf, WING.x0 + 1, wtop, WING.z0 + 0.8, WING.x0 + 2.8, wtop + 2.2, WING.z0 + 2.6);
  add(sketch(rf, INK, 0.9, { jitter: 0.05 }), 0.84, 0.92, 'drop');

  // context: ground, paving, trees, bushes, people
  var gr = [];
  seg(gr, -10, -SL.h, 8.2, 15, -SL.h, 8.2);
  seg(gr, -10, -SL.h, 11.6, 15, -SL.h, 11.6);
  for (var px = -9.5; px < 15; px += 2.2) { seg(gr, px, -SL.h, 8.2, px + 0.4, -SL.h, 11.6); }
  add(sketch(gr, INK, 0.28, { jitter: 0.06 }), 0.88, 0.97, 'fade');

  function tree(x, z, h, r) {
    var tr = [], lv = [];
    seg(tr, x, -SL.h, z, x, h * 0.8, z);
    seg(tr, x, h * 0.32, z, x - r * 0.5, h * 0.62, z);
    seg(tr, x, h * 0.42, z, x + r * 0.55, h * 0.72, z);
    seg(tr, x, h * 0.55, z, x - r * 0.3, h * 0.85, z);
    var cy = h * 0.7;
    for (var i = 0; i < 13; i++) {
      var t = -1 + (i + 0.5) * (2 / 13);
      var y = cy + t * r * 1.2;
      var rr = r * Math.sqrt(Math.max(0.04, 1 - t * t)) * (0.85 + rnd() * 0.3);
      var off = (rnd() - 0.5) * 0.4;
      seg(lv, x - rr + off, y, z + 0.2, x + rr + off, y + 0.22, z + 0.2);
    }
    var g = new THREE.Group();
    g.add(sketch(tr, INK, 0.7, { jitter: 0.05 }));
    g.add(sketch(lv, SAGE, 1, { jitter: 0.1, over: 0.4 }));
    g.position.y = 0;
    return g;
  }
  function bush(x, z, w) {
    var o = [];
    for (var i = 0; i < 5; i++) {
      var y = -SL.h + 0.15 + i * 0.22, k = 1 - Math.abs(i - 1.6) / 3.2;
      seg(o, x - w * k, y, z, x + w * k, y + 0.08, z);
    }
    return sketch(o, SAGE, 0.95, { jitter: 0.08, over: 0.3 });
  }
  function person(x, z, s) {
    var o = [], b = -SL.h, h = 1.75 * (s || 1);
    for (var a2 = 0; a2 < 10; a2++) {
      var u1 = a2 / 10 * Math.PI * 2, u2 = (a2 + 1) / 10 * Math.PI * 2;
      seg(o, x + Math.cos(u1) * 0.14, b + h - 0.14 + Math.sin(u1) * 0.14, z, x + Math.cos(u2) * 0.14, b + h - 0.14 + Math.sin(u2) * 0.14, z);
    }
    seg(o, x, b + h - 0.3, z, x, b + h * 0.48, z);
    seg(o, x, b + h * 0.48, z, x - 0.25, b, z);
    seg(o, x, b + h * 0.48, z, x + 0.22, b, z + 0.1);
    seg(o, x, b + h * 0.75, z, x - 0.3, b + h * 0.5, z);
    seg(o, x, b + h * 0.75, z, x + 0.28, b + h * 0.52, z);
    return sketch(o, INK, 0.85, { jitter: 0.03, over: 0.05 });
  }
  add(tree(-8.2, 6.2, 8.4, 2.2), 0.9, 0.98, 'fade');
  add(tree(12.4, 4.6, 7.4, 1.9), 0.92, 1, 'fade');
  add(bush(-4.5, 6, 1.3), 0.9, 0.97, 'fade');
  add(bush(1.8, 6.1, 1.1), 0.91, 0.98, 'fade');
  add(bush(7.6, 4.6, 1.2), 0.92, 0.99, 'fade');
  add(person(-1.2, 9.6), 0.93, 1, 'fade');
  add(person(9.8, 9.9, 0.95), 0.94, 1, 'fade');

  root.position.set(-1.8, -7.2, -0.6);

  /* ---------- callouts ---------- */
  var anchors = {
    assess: new THREE.Vector3(MAIN.x0, MAIN.floors * FH, MAIN.z1),
    found: new THREE.Vector3(SL.x0 + 1.4, -SL.h * 0.45, SL.z1),
    refine: new THREE.Vector3(WING.x1 + 1.2, 2 * FH + 1.0, WING.z0 + (WING.z1 - WING.z0) * 0.58)
  };
  var spans = { assess: [0, 0.3], found: [0.3, 0.6], refine: [0.6, 1.01] };
  var svg = host.querySelector('.p-bld-lines');
  var tags = {};
  Object.keys(anchors).forEach(function (k) {
    tags[k] = {
      el: host.querySelector('[data-tag="' + k + '"]'),
      line: svg && svg.querySelector('[data-line="' + k + '"]'),
      dot: svg && svg.querySelector('[data-dot="' + k + '"]')
    };
  });

  /* ---------- size & loop ---------- */
  var W = 1, H = 1;
  function resize() {
    var r = stageEl.getBoundingClientRect();
    W = Math.max(1, Math.round(r.width));
    H = Math.max(1, Math.round(r.height));
    renderer.setSize(W, H, false);
    canvas.style.width = W + 'px';
    canvas.style.height = H + 'px';
    camera.aspect = W / H;
    camera.updateProjectionMatrix();
    if (svg) { svg.setAttribute('viewBox', '0 0 ' + W + ' ' + H); }
  }
  function clamp(x) { return x < 0 ? 0 : x > 1 ? 1 : x; }
  function ease(x) { x = clamp(x); return x * x * (3 - 2 * x); }
  function setOpacity(obj, k) {
    obj.traverse(function (o) {
      if (o.material && o.material.userData.base != null) { o.material.opacity = o.material.userData.base * k; }
    });
  }
  // 0 when the stage list reaches the middle of the screen, 1 close to its end.
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
      var k = ease((p - it.a) / (it.b - it.a));
      var vis = k;
      if (it.kind === 'survey') { vis = k * (1 - 0.8 * ease((p - 0.58) / 0.16)); }
      if (it.kind === 'slab') { it.obj.scale.set(0.7 + 0.3 * k, Math.max(0.001, k), 0.7 + 0.3 * k); }
      if (it.kind === 'rise') { it.obj.scale.y = Math.max(0.001, k); }
      if (it.kind === 'drop') { it.obj.position.y = (1 - k) * 2.5; }
      setOpacity(it.obj, vis);
      it.obj.visible = vis > 0.002;
    });

    var az = 0.62 + p * 0.3;
    var el = 0.27 - p * 0.07;
    var dist = Math.max(64, 46 / Math.max(0.5, camera.aspect));
    camera.position.set(Math.sin(az) * Math.cos(el) * dist, Math.sin(el) * dist, Math.cos(az) * Math.cos(el) * dist);
    camera.lookAt(0.8, 0.9, 0.4);
    renderer.render(scene, camera);
    host.style.setProperty('--bp', p.toFixed(3));

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
      var er = tg.el.getBoundingClientRect();
      var right = tg.el.classList.contains('is-right');
      var ex = (right ? er.left : er.right) - sr.left, ey = er.top - sr.top + er.height / 2;
      var lo = String(shown * (on || reduce ? 1 : 0.4));
      if (tg.line) {
        tg.line.setAttribute('x1', ex.toFixed(1)); tg.line.setAttribute('y1', ey.toFixed(1));
        tg.line.setAttribute('x2', ax.toFixed(1)); tg.line.setAttribute('y2', ay.toFixed(1));
        tg.line.style.opacity = lo;
      }
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
