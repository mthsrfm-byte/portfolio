/* Sera · cover, first paint. Printed inline by template-parts/cover.php, so it runs while the page parses,
   long before Three.js and the bust model arrive. It paints the ASCII portrait from a small baked map
   (assets/img/cover-ascii.png, made with window.__cvBake() under ?cvdebug) on the exact cell grid the
   WebGL ASCII pass uses, so cover.js can swap to the live one without a visible jump. */
(function () {
	var root = document.getElementById('cover');
	var cv = root && root.querySelector('canvas.bust-pre');
	var bust = root && root.querySelector('canvas.bust');
	var box = root && root.querySelector('#bustBox');
	if (!cv || !bust || !box || !cv.getContext) return;
	// must match cover.js: frameF (portrait framing), the bake's aspect, glyph ramp, cell size, ink
	var F = { cap: 0.0734, chin: 0.6205 }, A = 1.4, RAMP = ' .:-=+*#%@', CW = 5.2, CH = 8.9, INK = '#111110';
	var stacked = window.matchMedia('(max-aspect-ratio:4/5),(max-width:760px)');
	var map = null, mw = 0, mh = 0;

	// same as layoutBust() in cover.js: on portrait screens the bust box is sized between logo and headline
	function layout() {
		box.style.top = ''; box.style.height = '';
		if (!stacked.matches) return;
		var hero = root.getBoundingClientRect(), lg = root.querySelector('.mast svg'), c3 = root.querySelector('.c3');
		if (!lg || !c3) return;
		var L = lg.getBoundingClientRect().bottom - hero.top, S = c3.getBoundingClientRect().top - hero.top - 14;
		var bw = box.getBoundingClientRect().width || innerWidth;
		if (S - L < 60) return;
		var h = Math.max(120, Math.min((S - L) / (0.86 * (F.chin - F.cap)), bw * 1.35));
		box.style.top = (L - (F.cap + 0.14 * (F.chin - F.cap)) * h).toFixed(1) + 'px';
		box.style.height = h.toFixed(1) + 'px';
	}

	// the veil (cover.css): the bust fades to transparent over the lower part of its box; same as cover.js
	function veil(r, b) {
		var f1 = b.bottom - r.top;
		root.style.setProperty('--cv-f0', (f1 - b.height * 0.26).toFixed(1) + 'px');
		root.style.setProperty('--cv-f1', f1.toFixed(1) + 'px');
	}

	function draw() {
		if (!map || !cv.isConnected) return;
		layout();
		var dpr = Math.min(window.devicePixelRatio || 1, 2), r = bust.getBoundingClientRect();
		var w = Math.floor(Math.max(1, r.width) * dpr), h = Math.floor(Math.max(1, r.height) * dpr);
		if (cv.width !== w) cv.width = w;
		if (cv.height !== h) cv.height = h;
		var g = cv.getContext('2d');
		g.clearRect(0, 0, w, h);
		// the camera fits the bust by height inside the box (and pulls back on very narrow boxes)
		var b = box.getBoundingClientRect();
		veil(r, b);
		var f = Math.min(1, (b.width / Math.max(1, b.height)) * 1.35);
		var ih = b.height * dpr * f, iw = ih * A;
		var ox = (b.left - r.left + b.width / 2) * dpr - iw / 2, oy = (b.top - r.top + b.height / 2) * dpr - ih / 2;
		var cw = CW * dpr, ch = CH * dpr;
		// glyph atlas in cover.js: 86px type in a 64 × 110 cell, centred 4px below the middle
		g.font = '500 ' + (86 * ch / 110).toFixed(2) + 'px "Geist Mono", ui-monospace, Menlo, monospace';
		g.textAlign = 'center'; g.textBaseline = 'middle'; g.fillStyle = INK;
		// rows count from the canvas bottom, like gl_FragCoord
		var c0 = Math.max(0, Math.floor(ox / cw)), c1 = Math.min(Math.ceil(w / cw), Math.ceil((ox + iw) / cw));
		var r0 = Math.max(0, Math.floor((h - oy - ih) / ch)), r1 = Math.min(Math.ceil(h / ch), Math.ceil((h - oy) / ch));
		for (var row = r0; row < r1; row++) {
			var cyT = h - (row + 0.5) * ch, v = (cyT - oy) / ih;
			if (v < 0 || v >= 1) continue;
			var my = Math.floor(v * mh) * mw;
			for (var col = c0; col < c1; col++) {
				var cx = (col + 0.5) * cw, u = (cx - ox) / iw;
				if (u < 0 || u >= 1) continue;
				var p = (my + Math.floor(u * mw)) * 4;
				if (map[p + 3] < 128) continue;
				var L = Math.pow(Math.min(1, Math.max(0, (map[p] / 255 - 0.18) / 0.66)), 1.7);
				var k = Math.floor((1 - L) * (RAMP.length - 1) + 0.5);
				if (k > 0) g.fillText(RAMP[k], cx, h - (row + 1) * ch + ch * 59 / 110);
			}
		}
		cv.classList.add('on');
	}

	var img = new Image();
	img.onload = function () {
		var t = document.createElement('canvas'); t.width = mw = img.naturalWidth; t.height = mh = img.naturalHeight;
		var tg = t.getContext('2d'); tg.drawImage(img, 0, 0);
		try { map = tg.getImageData(0, 0, mw, mh).data; } catch (e) { return; }
		draw();
		if (document.fonts && document.fonts.load) document.fonts.load('500 10px "Geist Mono"').then(draw, function () {});
		if (document.fonts && document.fonts.ready) document.fonts.ready.then(draw);
	};
	img.src = cv.getAttribute('data-src');
	window.addEventListener('resize', draw);
})();
