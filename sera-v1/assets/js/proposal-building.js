/* Sera · proposal hero illustration (three.js, vendored in assets/js/lib/three.min.js).
   A line-drawn apartment block that is built from the ground up: the foundation slab first
   (the sprint's stage 02 colour), then each floor, then the details. Three callouts tie the
   picture to the sprint's stages. Static final state under reduced motion; nothing renders
   off screen; without WebGL the figure simply hides. */
(function () {
  'use strict';
  var host = document.querySelector('[data-building]');
  if (!host || !window.THREE) { return; }
  var THREE = window.THREE;
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var canvas = document.createElement('canvas');
  var renderer;
  try {
    renderer = new THREE.WebGLRenderer({ canvas: canvas, antialias: true, alpha: true });
  } catch (e) {
    host.hidden = true;
    return;
  }
  host.querySelector('.p-bld-stage').appendChild(canvas);
  renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));

  var INK = 0x1A1F23;
  var TEAL = 0x0B6E73;
  var SAGE = 0x8FAAA0;
  var scene = new THREE.Scene();
  var camera = new THREE.PerspectiveCamera(28, 1, 0.1, 400);
  var root = new THREE.Group();
  scene.add(root);

  // Deterministic jitter so the "pencil" pass is the same on every load.
  var seed = 7;
  function rnd() { seed = (seed * 16807) % 2147483647; return (seed - 1) / 2147483646; }

  /* A set of segments drawn twice: a clean ink line and a faint, slightly offset second pass. */
  function sketch(segs, color, opacity, jitter) {
    var g = new THREE.Group();
    var a = [], b = [];
    var j = jitter == null ? 0.05 : jitter;
    for (var i = 0; i < segs.length; i++) {
      a.push(segs[i][0], segs[i][1], segs[i][2]);
      b.push(segs[i][0] + (rnd() - 0.5) * j, segs[i][1] + (rnd() - 0.5) * j, segs[i][2] + (rnd() - 0.5) * j);
    }
    [[a, opacity], [b, opacity * 0.38]].forEach(function (pair) {
      var geo = new THREE.BufferGeometry();
      geo.setAttribute('position', new THREE.Float32BufferAttribute(pair[0], 3));
      var mat = new THREE.LineBasicMaterial({ color: color, transparent: true, opacity: pair[1] });
      mat.userData.base = pair[1];
      g.add(new THREE.LineSegments(geo, mat));
    });
    return g;
  }
  function seg(out, x1, y1, z1, x2, y2, z2) { out.push([x1, y1, z1], [x2, y2, z2]); }
  function box(out, x0, y0, z0, x1, y1, z1) {
    var p = [[x0, y0, z0], [x1, y0, z0], [x1, y0, z1], [x0, y0, z1]];
    for (var i = 0; i < 4; i++) {
      var q = p[i], r = p[(i + 1) % 4];
      seg(out, q[0], y0, q[2], r[0], y0, r[2]);
      seg(out, q[0], y1, q[2], r[0], y1, r[2]);
      seg(out, q[0], y0, q[2], q[0], y1, q[2]);
    }
  }
  /* Rectangle on a facade: axis 'z' = front face (constant z), 'x' = side face (constant x). */
  function rect(out, axis, c, u0, v0, u1, v1) {
    if (axis === 'z') {
      seg(out, u0, v0, c, u1, v0, c); seg(out, u1, v0, c, u1, v1, c);
      seg(out, u1, v1, c, u0, v1, c); seg(out, u0, v1, c, u0, v0, c);
    } else {
      seg(out, c, v0, u0, c, v0, u1); seg(out, c, v0, u1, c, v1, u1);
      seg(out, c, v1, u1, c, v1, u0); seg(out, c, v1, u0, c, v0, u0);
    }
  }
  function windowAt(out, axis, c, u, v, w, h) {
    rect(out, axis, c, u - w / 2, v, u + w / 2, v + h);
    // mullion + sill
    if (axis === 'z') { seg(out, u, v, c, u, v + h, c); seg(out, u - w / 2 - 0.12, v, c + 0.08, u + w / 2 + 0.12, v, c + 0.08); }
    else { seg(out, c, v, u, c, v + h, u); seg(out, c + 0.08, v, u - w / 2 - 0.12, c + 0.08, v, u + w / 2 + 0.12); }
  }
  function balcony(out, axis, c, u, v, w) {
    var d = 1.1, top = v + 1.05;
    if (axis === 'z') {
      box(out, u - w / 2, v - 0.18, c, u + w / 2, v, c + d);
      seg(out, u - w / 2, top, c + d, u + w / 2, top, c + d);
      seg(out, u - w / 2, top, c, u - w / 2, top, c + d);
      seg(out, u + w / 2, top, c, u + w / 2, top, c + d);
      for (var x = u - w / 2; x <= u + w / 2 + 0.001; x += 0.16) { seg(out, x, v, c + d, x, top, c + d); }
    } else {
      box(out, c, v - 0.18, u - w / 2, c + d, v, u + w / 2);
      seg(out, c + d, top, u - w / 2, c + d, top, u + w / 2);
      seg(out, c, top, u - w / 2, c + d, top, u - w / 2);
      seg(out, c, top, u + w / 2, c + d, top, u + w / 2);
      for (var z = u - w / 2; z <= u + w / 2 + 0.001; z += 0.16) { seg(out, c + d, v, z, c + d, top, z); }
    }
    // the door behind it
    rect(out, axis, c, u - 0.55, v, u + 0.55, v + 2.1);
  }

  /* ---------- the building ---------- */
  var FH = 3;           // floor height
  var MAIN = { x0: -5, x1: 4, z0: -4, z1: 3.5, floors: 5 };
  var WING = { x0: 4, x1: 8.4, z0: -3.4, z1: 2.4, floors: 4 };
  var parts = [];       // { obj, start, kind }

  // Foundation slab: filled + outlined, wider than the building.
  var slab = new THREE.Group();
  var sx0 = -6.4, sx1 = 9.6, sz0 = -5.2, sz1 = 4.9, sh = 0.9;
  var fill = new THREE.Mesh(
    new THREE.BoxGeometry(sx1 - sx0, sh, sz1 - sz0),
    new THREE.MeshBasicMaterial({ color: TEAL, transparent: true, opacity: 0.16, depthWrite: false })
  );
  fill.material.userData.base = 0.16;
  fill.position.set((sx0 + sx1) / 2, -sh / 2, (sz0 + sz1) / 2);
  slab.add(fill);
  var sl = [];
  box(sl, sx0, -sh, sz0, sx1, 0, sz1);
  for (var hx = sx0 + 0.5; hx < sx1; hx += 0.55) { seg(sl, hx, -sh, sz1, hx + 0.45, 0, sz1); }   // hatching on the front edge
  for (var hz = sz0 + 0.5; hz < sz1; hz += 0.55) { seg(sl, sx1, -sh, hz, sx1, 0, hz + 0.45); }
  slab.add(sketch(sl, TEAL, 1, 0.04));
  slab.position.y = 0;
  root.add(slab);
  parts.push({ obj: slab, start: 0, kind: 'slab' });

  function floorGroup(spec, i, isWing) {
    var out = [];
    var y0 = i * FH, y1 = y0 + FH;
    box(out, spec.x0, y0, spec.z0, spec.x1, y1, spec.z1);
    var cz = spec.z1, cx = spec.x1;
    var span = spec.x1 - spec.x0, depth = spec.z1 - spec.z0;
    if (!isWing) {
      // front: two windows, a balcony in the middle; side: three windows
      windowAt(out, 'z', cz, spec.x0 + span * 0.16, y0 + 0.8, 1.1, 1.6);
      if (i === 0) {
        rect(out, 'z', cz, spec.x0 + span * 0.38, y0, spec.x0 + span * 0.62, y0 + 2.5);        // entrance
        seg(out, spec.x0 + span * 0.5, y0, cz, spec.x0 + span * 0.5, y0 + 2.5, cz);
        box(out, spec.x0 + span * 0.32, y0 + 2.6, cz, spec.x0 + span * 0.68, y0 + 2.8, cz + 1.2); // canopy
      } else {
        balcony(out, 'z', cz, spec.x0 + span * 0.5, y0 + 0.2, 2.6);
      }
      windowAt(out, 'z', cz, spec.x0 + span * 0.84, y0 + 0.8, 1.1, 1.6);
      for (var k = 0; k < 3; k++) { windowAt(out, 'x', cx, spec.z0 + depth * (0.2 + k * 0.3), y0 + 0.8, 0.9, 1.7); }
    } else {
      windowAt(out, 'z', cz, spec.x0 + span * 0.5, y0 + 0.8, 1.0, 1.6);
      if (i > 0) { balcony(out, 'x', cx, spec.z0 + depth * 0.55, y0 + 0.2, 2.2); }
      else { windowAt(out, 'x', cx, spec.z0 + depth * 0.55, y0 + 0.8, 1.6, 1.6); }
      windowAt(out, 'x', cx, spec.z0 + depth * 0.18, y0 + 0.8, 0.8, 1.6);
    }
    if (i === spec.floors - 1) {
      // parapet
      box(out, spec.x0 - 0.15, y1, spec.z0 - 0.15, spec.x1 + 0.15, y1 + 0.45, spec.z1 + 0.15);
    }
    return sketch(out, INK, 0.92, 0.06);
  }
  var order = 0;
  for (var f = 0; f < MAIN.floors; f++) {
    var gm = floorGroup(MAIN, f, false);
    root.add(gm);
    parts.push({ obj: gm, start: 0.75 + order * 0.28, kind: 'floor' });
    if (f < WING.floors) {
      var gw = floorGroup(WING, f, true);
      root.add(gw);
      parts.push({ obj: gw, start: 0.75 + order * 0.28 + 0.12, kind: 'floor' });
    }
    order++;
  }

  // Ground, path and trees (sage hatching).
  var ground = [];
  seg(ground, -12, -sh, 7.5, 16, -sh, 7.5);
  seg(ground, -8, -sh, 10, 1, -sh, 10);
  seg(ground, 5, -sh, 9.8, 11, -sh, 9.8);
  var gG = sketch(ground, INK, 0.32, 0.08);
  root.add(gG);
  parts.push({ obj: gG, start: 0.3, kind: 'fade' });

  function tree(x, z, h, r) {
    var trunk = [];
    seg(trunk, x, -sh, z, x, h * 0.75, z);
    seg(trunk, x, h * 0.35, z, x - r * 0.45, h * 0.62, z);
    seg(trunk, x, h * 0.45, z, x + r * 0.5, h * 0.7, z);
    var leaves = [];
    var cy = h * 0.68;
    for (var i = 0; i < 9; i++) {
      var t = -1 + (i + 0.5) * (2 / 9);
      var y = cy + t * r * 1.15;
      var rr = r * Math.sqrt(Math.max(0.05, 1 - t * t));
      seg(leaves, x - rr, y, z + 0.3, x + rr, y + 0.25, z + 0.3);
      seg(leaves, x - rr + 0.2, y + 0.35, z + 0.3, x + rr - 0.2, y + 0.6, z + 0.3);
    }
    var g = new THREE.Group();
    g.add(sketch(trunk, INK, 0.75, 0.05));
    g.add(sketch(leaves, SAGE, 0.95, 0.12));
    return g;
  }
  var t1 = tree(-7.6, 6.2, 8.2, 2.2), t2 = tree(13.4, 1.5, 7.5, 2.1);
  root.add(t1); root.add(t2);
  parts.push({ obj: t1, start: 2.4, kind: 'fade' }, { obj: t2, start: 2.55, kind: 'fade' });

  root.position.set(-1.8, -6.4, 0);

  /* ---------- callouts ---------- */
  var anchors = {
    assess: new THREE.Vector3(MAIN.x0, MAIN.floors * FH + 0.45, MAIN.z1),
    found: new THREE.Vector3(sx0 + 1.2, -sh * 0.4, sz1),
    refine: new THREE.Vector3(WING.x1 + 1.1, 2 * FH + 1.0, WING.z0 + (WING.z1 - WING.z0) * 0.55)
  };
  var tags = {};
  var svg = host.querySelector('.p-bld-lines');
  Object.keys(anchors).forEach(function (k) {
    tags[k] = {
      el: host.querySelector('[data-tag="' + k + '"]'),
      line: svg ? svg.querySelector('[data-line="' + k + '"]') : null,
      dot: svg ? svg.querySelector('[data-dot="' + k + '"]') : null
    };
  });

  /* ---------- size, camera, loop ---------- */
  var W = 0, H = 0;
  function resize() {
    var r = host.querySelector('.p-bld-stage').getBoundingClientRect();
    W = Math.max(1, Math.round(r.width));
    H = Math.max(1, Math.round(r.height));
    renderer.setSize(W, H, false);
    canvas.style.width = W + 'px';
    canvas.style.height = H + 'px';
    camera.aspect = W / H;
    camera.updateProjectionMatrix();
    if (svg) { svg.setAttribute('viewBox', '0 0 ' + W + ' ' + H); }
  }
  var px = 0, py = 0, tx = 0, ty = 0;
  window.addEventListener('pointermove', function (e) {
    tx = (e.clientX / window.innerWidth - 0.5) * 2;
    ty = (e.clientY / window.innerHeight - 0.5) * 2;
  }, { passive: true });

  function ease(x) { x = Math.max(0, Math.min(1, x)); return 1 - Math.pow(1 - x, 3); }
  function setOpacity(obj, k) {
    obj.traverse(function (o) {
      if (o.material && o.material.userData.base != null) { o.material.opacity = o.material.userData.base * k; }
    });
  }

  var t0 = null, visible = false, raf = 0, done = false;
  var v = new THREE.Vector3();
  function frame(now) {
    raf = 0;
    if (t0 === null) { t0 = now; }
    var t = reduce ? 99 : (now - t0) / 1000;

    parts.forEach(function (p) {
      var k = ease((t - p.start) / (p.kind === 'slab' ? 0.9 : 0.7));
      if (p.kind === 'slab') {
        p.obj.scale.set(0.6 + 0.4 * k, Math.max(0.001, k), 0.6 + 0.4 * k);
      } else if (p.kind === 'floor') {
        p.obj.position.y = (1 - k) * 2.2;
      }
      setOpacity(p.obj, k);
      p.obj.visible = k > 0.001;
    });

    px += (tx - px) * 0.05; py += (ty - py) * 0.05;
    var az = 0.72 + (reduce ? 0 : Math.sin(t * 0.18) * 0.08 + px * 0.14);
    var el = 0.2 + (reduce ? 0 : py * -0.04);
    var dist = 56;
    camera.position.set(Math.sin(az) * Math.cos(el) * dist, Math.sin(el) * dist, Math.cos(az) * Math.cos(el) * dist);
    camera.lookAt(0.6, 1.2, 0);
    renderer.render(scene, camera);

    // callouts follow their anchors
    var tagK = ease((t - 2.6) / 0.6);
    Object.keys(anchors).forEach(function (k) {
      var tg = tags[k];
      if (!tg.el) { return; }
      v.copy(anchors[k]).add(root.position).project(camera);
      var ax = (v.x * 0.5 + 0.5) * W, ay = (-v.y * 0.5 + 0.5) * H;
      var er = tg.el.getBoundingClientRect(), hr = host.querySelector('.p-bld-stage').getBoundingClientRect();
      var ex = er.left - hr.left + (tg.el.classList.contains('is-right') ? 0 : er.width), ey = er.top - hr.top + er.height / 2;
      if (tg.el.classList.contains('is-right')) { ex = er.left - hr.left; }
      tg.el.style.opacity = String(tagK);
      if (tg.line) {
        tg.line.setAttribute('x1', ex.toFixed(1)); tg.line.setAttribute('y1', ey.toFixed(1));
        tg.line.setAttribute('x2', ax.toFixed(1)); tg.line.setAttribute('y2', ay.toFixed(1));
        tg.line.style.opacity = String(tagK);
      }
      if (tg.dot) { tg.dot.setAttribute('cx', ax.toFixed(1)); tg.dot.setAttribute('cy', ay.toFixed(1)); tg.dot.style.opacity = String(tagK); }
    });

    if (reduce) { done = true; return; }
    if (visible) { raf = requestAnimationFrame(frame); }
  }
  function kick() { if (!raf && !(reduce && done)) { raf = requestAnimationFrame(frame); } }

  resize();
  window.addEventListener('resize', function () { resize(); done = false; kick(); });
  if ('ResizeObserver' in window) {
    new ResizeObserver(function () { resize(); done = false; kick(); }).observe(host.querySelector('.p-bld-stage'));
  }
  if ('IntersectionObserver' in window) {
    new IntersectionObserver(function (en) {
      visible = en[0].isIntersecting;
      if (visible) { if (t0 === null) { resize(); } kick(); }
    }, { threshold: 0.05 }).observe(host);
  } else {
    visible = true;
    kick();
  }
  document.addEventListener('visibilitychange', function () {
    if (document.hidden) { visible = false; } else { visible = true; kick(); }
  });
  host.classList.add('is-ready');
})();
