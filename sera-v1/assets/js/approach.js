/**
 * 3.55 · Home #approach "Piso vivo" (front-page.php), at every width: the section title in grains that assembles
 * as it scrolls in (the grains live on one canvas over the whole dark block, and never come apart), plus a
 * perspective floor of glyphs that each principle reshapes (hover / tap / focus a principle, or every 5 s on its own).
 * One rAF loop for every canvas, paused off screen (IntersectionObserver); reduced motion draws the end state still.
 */
( function () {
	'use strict';

	var sec = document.getElementById( 'approach' );
	if ( ! sec || ! window.ResizeObserver || ! window.IntersectionObserver || ! window.matchMedia || ! window.AbortController ) {
		return; // no-JS layout stays: visible h2, plain principles
	}
	sec.classList.add( 'ap-ready' );

	var RM = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	// Big screens: the section is one screen tall and pinned (approach.css); the scroll walks 01 → 04.
	// Smaller screens and reduced motion: static layout, tap / hover / every 5 s.
	var PIN_MQ = window.matchMedia( '(min-width: 1081px) and (min-height: 600px)' );
	var pin = sec.querySelector( '.ap-pin' ) || sec;
	function pinned() { return ! RM && PIN_MQ.matches; }
	sec.classList.toggle( 'ap-pinned', pinned() );
	var COARSE = false;
	var RAMP = ' .:-=+*#%@';
	var PAPER = '#EFEEE8', TEAL = '#7DB8B4';
	var MONO = '"Geist Mono", ui-monospace, Menlo, monospace';
	var DISPLAY = '"Bricolage Grotesque", Geist, sans-serif';

	function hash( n ) { n = Math.sin( n * 127.1 + 311.7 ) * 43758.5453; return n - Math.floor( n ); }
	function clamp( v, a, b ) { return v < a ? a : v > b ? b : v; }
	function smooth( a, b, v ) { var t = clamp( ( v - a ) / ( b - a ), 0, 1 ); return t * t * ( 3 - 2 * t ); }
	function easeOut( t ) { return 1 - Math.pow( 1 - t, 5 ); }
	function $$( s, c ) { return [].slice.call( ( c || document ).querySelectorAll( s ) ); }

	/* ---------- shared loop: one rAF for every canvas that is on screen ---------- */
	var stages = [], raf = 0, last = 0;
	function tick( now ) {
		raf = 0;
		var k = last ? Math.min( 3, ( now - last ) / 16.67 ) : 1;
		last = now;
		var any = false;
		for ( var i = 0; i < stages.length; i++ ) {
			var s = stages[ i ];
			if ( s.vis && s.ready ) {
				any = true;
				s.ctx.setTransform( s.dpr, 0, 0, s.dpr, 0, 0 );
				s.api.frame( s, now / 1000, k );
			}
		}
		if ( any ) {
			raf = requestAnimationFrame( tick );
		} else {
			last = 0;
		}
	}
	function wake() { if ( ! raf && ! RM ) { raf = requestAnimationFrame( tick ); } }

	/**
	 * A canvas in the loop. `ctl` is the running variant: its listeners, observers and stages go away with it.
	 */
	function stage( cv, host, api, ctl ) {
		var s = { cv: cv, host: host, api: api, ctx: cv.getContext( '2d' ), w: 0, h: 0, dpr: 1, vis: false, ready: false, px: -1e4, py: -1e4, on: false, t0: 0, small: false };
		var opt = { signal: ctl.ac.signal };
		stages.push( s );
		ctl.stages.push( s );
		function still() {
			if ( ! s.ready ) { return; }
			s.ctx.setTransform( 1, 0, 0, 1, 0, 0 );
			s.ctx.clearRect( 0, 0, cv.width, cv.height );
			s.ctx.setTransform( s.dpr, 0, 0, s.dpr, 0, 0 );
			api.still( s );
		}
		s.resize = function () {
			var r = cv.getBoundingClientRect(), w = Math.round( r.width ), h = Math.round( r.height );
			if ( ! w || ! h ) { return; }
			var dpr = Math.min( api.maxDpr || 2, window.devicePixelRatio || 1 );
			if ( w === s.w && h === s.h && dpr === s.dpr && s.ready ) { return; }
			s.w = w; s.h = h; s.dpr = dpr;
			cv.width = Math.round( w * dpr ); cv.height = Math.round( h * dpr );
			s.small = COARSE || sec.clientWidth < 600;
			api.build( s );
			s.ready = true;
			if ( RM ) { still(); } else { wake(); }
		};
		var ro = new ResizeObserver( function () { s.resize(); } );
		ro.observe( cv );
		var io = new IntersectionObserver( function ( es ) {
			es.forEach( function ( e ) {
				var was = s.vis;
				s.vis = e.isIntersecting;
				if ( s.vis && ! was ) {
					s.t0 = performance.now() / 1000;
					if ( api.enter ) { api.enter( s ); }
					wake();
				}
			} );
		}, { rootMargin: '40px 0px' } );
		io.observe( host );
		ctl.obs.push( ro, io );
		// pointer: mouse follows hover; touch holds for a moment after the finger lifts
		var rel = 0;
		function at( e ) { var r = cv.getBoundingClientRect(); s.px = e.clientX - r.left; s.py = e.clientY - r.top; s.on = true; clearTimeout( rel ); wake(); }
		function off() { s.on = false; s.px = s.py = -1e4; }
		host.addEventListener( 'pointermove', function ( e ) { if ( e.pointerType === 'mouse' ) { at( e ); } }, opt );
		host.addEventListener( 'pointerleave', function ( e ) { if ( e.pointerType === 'mouse' ) { off(); } }, opt );
		host.addEventListener( 'pointerdown', function ( e ) { at( e ); if ( e.pointerType !== 'mouse' ) { clearTimeout( rel ); rel = setTimeout( off, 1100 ); } }, opt );
		host.addEventListener( 'touchmove', function ( e ) { var t = e.touches[ 0 ]; if ( t ) { at( t ); clearTimeout( rel ); rel = setTimeout( off, 900 ); } }, { passive: true, signal: ctl.ac.signal } );
		ctl.cleanup.push( function () { clearTimeout( rel ); } );
		s.still = still;
		return s;
	}

	/* =====================================================================
	   1/2 · the title in grains, on one canvas over the whole block
	   ===================================================================== */
	function grains( ctl ) {
		var host = sec.querySelector( '.ap-mast' );
		if ( ! host ) { return; }
		var cv = document.createElement( 'canvas' );
		cv.className = 'ap-bleed';
		cv.setAttribute( 'aria-hidden', 'true' );
		pin.insertBefore( cv, pin.firstChild );
		ctl.cleanup.push( function () { cv.remove(); } );
		var TXT = ( sec.getAttribute( 'data-ap-title' ) || 'Approach' ).toUpperCase();
		var P = [], LV = 6, buckets = [], sz = 1.8, idle = false;
		for ( var b = 0; b < LV; b++ ) { buckets.push( [] ); }
		stage( cv, host, {
			maxDpr: 1.5, // this canvas is as big as the section
			build: function ( s ) {
				var step = s.small ? 2.7 : 2.6;
				sz = s.small ? 1.7 : 2.1;
				var cr = cv.getBoundingClientRect(), hr = host.getBoundingClientRect();
				var bx = hr.left - cr.left, by = hr.top - cr.top, bw = hr.width, bh = hr.height;
				var off = document.createElement( 'canvas' );
				off.width = s.w; off.height = s.h;
				var x = off.getContext( '2d' );
				x.font = 'condensed 800 100px ' + DISPLAY;
				try { x.fontStretch = 'condensed'; } catch ( e ) {}
				try { x.letterSpacing = '-1.2px'; } catch ( e ) {}
				var m = x.measureText( TXT ), w100 = m.width || 1, asc100 = m.actualBoundingBoxAscent || 72;
				var fs = Math.min( bw * 0.985 / w100 * 100, bh * 0.96 / asc100 * 100 );
				x.font = 'condensed 800 ' + fs + 'px ' + DISPLAY;
				try { x.letterSpacing = ( -0.012 * fs ) + 'px'; } catch ( e ) {}
				var mw = x.measureText( TXT ).width, asc = asc100 * fs / 100;
				x.fillStyle = '#000';
				x.textBaseline = 'alphabetic';
				x.fillText( TXT, bx + Math.max( 0, bw - mw ) * ( pinned() ? 0 : 0.5 ), by + ( bh + asc ) / 2 ); // pinned: flush left, the intro sits on its right
				var d = x.getImageData( 0, 0, s.w, s.h ).data;
				P = [];
				for ( var cy = Math.max( 0, by | 0 ); cy < Math.min( s.h, by + bh ); cy += step ) {
					for ( var cx = Math.max( 0, bx | 0 ); cx < Math.min( s.w, bx + bw ); cx += step ) {
						var hx = cx + Math.random() * step, hy = cy + Math.random() * step;
						var xi = Math.min( s.w - 1, hx | 0 ), yi = Math.min( s.h - 1, hy | 0 );
						if ( d[ ( yi * s.w + xi ) * 4 + 3 ] > 120 ) {
							var r = Math.random();
							// dust rises from below the title, across the block, and settles into the letters
							P.push( { hx: hx, hy: hy, r: r, sx: hx + ( Math.random() - 0.5 ) * bw * 0.12, sy: hy + bh * ( 0.35 + Math.random() * 0.9 ), d: ( hx - bx ) / bw * 0.7 + r * 0.45, ox: 0, oy: 0 } );
						}
					}
				}
				idle = false;
			},
			enter: function () { idle = false; },
			still: function ( s ) { draw( s, 99, 0, 1 ); },
			frame: function ( s, t, k ) {
				var vh = window.innerHeight, r = host.getBoundingClientRect();
				var tgt = clamp( ( vh - r.top ) / ( vh * 0.75 ), 0, 1 ) * 2.7; // assembles with the scroll, never comes apart
				s.el = s.el == null ? tgt : s.el + ( tgt - s.el ) * Math.min( 1, 0.09 * ( k || 1 ) );
				if ( Math.abs( tgt - s.el ) > 0.002 ) { idle = false; }
				draw( s, s.el, t, k );
			}
		}, ctl );
		function draw( s, el, t, k ) {
			var settled = el > 2.4;
			if ( settled && idle && ! s.on && ! RM ) { return; }
			var ctx = s.ctx;
			ctx.clearRect( 0, 0, s.w, s.h );
			for ( var b = 0; b < LV; b++ ) { buckets[ b ].length = 0; }
			var hot = [], R = s.small ? 70 : 120, busy = false, j;
			for ( var i = 0; i < P.length; i++ ) {
				var p = P[ i ], a = clamp( ( el - p.d ) / 1.5, 0, 1 ), e = a * a * ( 3 - 2 * a );
				var x = p.sx + ( p.hx - p.sx ) * e, y = p.sy + ( p.hy - p.sy ) * e, alpha = 0.15 + 0.85 * a;
				if ( a < 1 ) { busy = true; }
				var tx = 0, ty = 0;
				if ( s.on ) {
					var dx = p.hx - s.px, dy = p.hy - s.py;
					if ( dx < R && dx > -R && dy < R && dy > -R ) {
						var dd = Math.sqrt( dx * dx + dy * dy ) || 1, f = smooth( R, 0, dd );
						f *= f;
						if ( f > 0 ) {
							var ang = ( p.r - 0.5 ) * 1.4, ux = dx / dd, uy = dy / dd, ca = Math.cos( ang ), sa = Math.sin( ang ), push = f * R * ( 0.18 + p.r * 0.6 );
							tx = ( ux * ca - uy * sa ) * push + Math.sin( t * 1.3 + p.r * 40 ) * f;
							ty = ( ux * sa + uy * ca ) * push + Math.cos( t * 1.1 + p.r * 31 ) * f;
						}
					}
				}
				if ( tx !== 0 || ty !== 0 || p.ox !== 0 || p.oy !== 0 ) {
					p.ox += ( tx - p.ox ) * Math.min( 1, 0.18 * ( k || 1 ) );
					p.oy += ( ty - p.oy ) * Math.min( 1, 0.18 * ( k || 1 ) );
					if ( Math.abs( p.ox ) + Math.abs( p.oy ) < 0.05 && tx === 0 && ty === 0 ) { p.ox = p.oy = 0; } else { busy = true; }
				}
				if ( alpha < 0.02 ) { continue; }
				var disp = Math.abs( p.ox ) + Math.abs( p.oy );
				if ( disp > 3 ) { hot.push( x + p.ox, y + p.oy ); continue; }
				buckets[ Math.min( LV - 1, Math.floor( alpha * LV ) ) ].push( x + p.ox, y + p.oy );
			}
			ctx.fillStyle = PAPER;
			for ( b = 0; b < LV; b++ ) {
				var B = buckets[ b ];
				if ( ! B.length ) { continue; }
				ctx.globalAlpha = ( b + 0.5 ) / LV;
				ctx.beginPath();
				for ( j = 0; j < B.length; j += 2 ) { ctx.rect( B[ j ], B[ j + 1 ], sz, sz ); }
				ctx.fill();
			}
			if ( hot.length ) {
				ctx.fillStyle = PAPER;
				ctx.globalAlpha = 0.95;
				ctx.beginPath();
				for ( j = 0; j < hot.length; j += 2 ) { ctx.rect( hot[ j ], hot[ j + 1 ], sz * 1.25, sz * 1.25 ); }
				ctx.fill();
			}
			ctx.globalAlpha = 1;
			idle = ! busy && ! s.on;
		}
	}

	/* =====================================================================
	   2/2 · living floor: the hero's perspective grid as a field of glyphs
	   ===================================================================== */
	function floor( ctl ) {
		var host = sec.querySelector( '.ap-stage' ), cv = host && host.querySelector( 'canvas' );
		if ( ! cv ) { return; }
		var opt = { signal: ctl.ac.signal };
		var items = $$( '.ap-floor .ap-p', sec );
		var titles = items.map( function ( el ) { var h = el.querySelector( '.ap-tt' ); return h ? h.textContent : ''; } );
		var nums = items.map( function ( el ) { var n = el.querySelector( '.ap-n' ); return n ? n.textContent : ''; } );
		var nowN = host.querySelector( '.ap-now .ap-n' ), nowT = host.querySelector( '.ap-now .ap-cap' );
		var D = 900, TH = 64 * Math.PI / 180, CS = Math.cos( TH ), SN = Math.sin( TH );
		var pts = [], Xmax = 1, Ymax = 1, A = 100, act = 0, since = 0, user = false, lastSwitch = 0, st = null;
		function setAct( i, byUser ) {
			if ( byUser ) { user = true; }
			if ( i === act ) { return; }
			act = i;
			since = performance.now() / 1000;
			items.forEach( function ( el, j ) {
				el.classList.toggle( 'on', j === i );
				el.querySelector( 'button' ).setAttribute( 'aria-pressed', j === i ? 'true' : 'false' );
			} );
			if ( nowN ) { nowN.textContent = nums[ i ]; }
			if ( nowT ) { nowT.textContent = titles[ i ]; }
			if ( RM && st ) { st.still(); }
		}
		// pinned: the scroll position inside the tall section picks the principle
		function pinTop() { return parseFloat( getComputedStyle( pin ).top ) || 0; }
		function range() { return sec.offsetHeight - pin.offsetHeight; }
		function fromScroll() {
			if ( ! pinned() ) { return; }
			var R = range();
			if ( R <= 0 ) { return; }
			var p = clamp( ( pinTop() - sec.getBoundingClientRect().top ) / R, 0, 1 );
			// each item's bar fills on its own as the scroll walks through its slice
			items.forEach( function ( el, j ) { el.style.setProperty( '--fill', clamp( p * items.length - j, 0, 1 ).toFixed( 4 ) ); } );
			setAct( Math.min( items.length - 1, Math.floor( p * items.length ) ) );
		}
		function scrollToItem( i ) {
			var y = sec.getBoundingClientRect().top + window.scrollY - pinTop() + range() * ( i + 0.5 ) / items.length;
			if ( window.seraSmooth && window.seraSmooth.glide ) {
				window.seraSmooth.glide( y );
			} else if ( window.lenis && window.lenis.scrollTo ) {
				window.lenis.scrollTo( y );
			} else {
				window.scrollTo( { top: y, behavior: 'smooth' } );
			}
		}
		window.addEventListener( 'scroll', fromScroll, { passive: true, signal: ctl.ac.signal } );
		var onPin = function () { sec.classList.toggle( 'ap-pinned', pinned() ); fromScroll(); };
		if ( PIN_MQ.addEventListener ) { PIN_MQ.addEventListener( 'change', onPin, opt ); }
		fromScroll();
		items.forEach( function ( el, i ) {
			var btn = el.querySelector( 'button' );
			// static layout: mouse hover and keyboard focus hold the relief; a tap only picks it, and the 5 s rotation resumes from there
			el.addEventListener( 'pointerenter', function ( e ) { if ( e.pointerType === 'mouse' && ! pinned() ) { setAct( i, true ); } }, opt );
			btn.addEventListener( 'click', function () {
				if ( pinned() ) { scrollToItem( i ); return; }
				setAct( i, false ); since = performance.now() / 1000; wake();
			}, opt );
			btn.addEventListener( 'focus', function () {
				if ( pinned() ) { if ( btn.matches( ':focus-visible' ) ) { scrollToItem( i ); } return; }
				setAct( i, btn.matches( ':focus-visible' ) );
			}, opt );
			btn.addEventListener( 'blur', function () { user = false; lastSwitch = performance.now() / 1000; }, opt );
		} );
		sec.querySelector( '.ap-floor' ).addEventListener( 'pointerleave', function () { user = false; lastSwitch = performance.now() / 1000; }, opt );
		ctl.cleanup.push( function () {
			items.forEach( function ( el, j ) { el.classList.toggle( 'on', j === 0 ); el.querySelector( 'button' ).setAttribute( 'aria-pressed', j === 0 ? 'true' : 'false' ); } );
			if ( nowN ) { nowN.textContent = nums[ 0 ]; }
			if ( nowT ) { nowT.textContent = titles[ 0 ]; }
		} );
		function target( k, u, v, X, Y, t, el, p ) {
			if ( k === 0 ) { // numbers: a bar chart rising left to right
				var nb = 9, f = ( u + 0.85 ) / 1.7 * nb, b = Math.floor( f ), fr = f - b;
				if ( b < 0 || b >= nb || fr < 0.18 || fr > 0.82 || v < 0.3 || v > 0.62 ) { return 0; }
				var grow = clamp( ( el - b * 0.07 ) / 0.6, 0, 1 );
				return ( 0.25 + b / ( nb - 1 ) * 1.35 ) * A * easeOut( grow ) * ( 1 + 0.04 * Math.sin( t * 2 + b ) );
			}
			if ( k === 1 ) { // evidence: a lens sweeping a field of scattered points
				var cx = 0.62 * Math.sin( t * 0.55 ), cy = 0.48 + 0.22 * Math.cos( t * 0.4 );
				var du = ( u - cx ) * Xmax, dv = ( v - cy ) * Ymax, d = Math.sqrt( du * du + dv * dv ) / Xmax;
				var ring = Math.exp( -Math.pow( d - 0.16, 2 ) / 0.0018 ) * A * 0.7;
				var spike = p.e > 0.9 ? A * ( 0.18 + 0.9 * smooth( 0.3, 0.1, d ) ) : 0;
				return ring + spike;
			}
			if ( k === 2 ) { // measure: concentric rings out of a target centre
				var ru = u * Xmax, rv = ( v - 0.45 ) * Ymax, rr = Math.sqrt( ru * ru + rv * rv ) / Xmax;
				return ( Math.max( 0, Math.cos( rr * 30 - t * 2.4 ) ) * Math.exp( -rr * 2.6 ) * 0.8 + Math.exp( -rr * rr / 0.002 ) * 1.3 ) * A;
			}
			// build: modules stack up one after the other, like a tool being assembled
			var mu = ( u + 0.66 ) / 0.33, mv = ( v - 0.18 ) / 0.2, bu = Math.floor( mu ), bv = Math.floor( mv );
			if ( bu < 0 || bu > 3 || bv < 0 || bv > 2 || mu - bu < 0.12 || mu - bu > 0.88 || mv - bv < 0.14 || mv - bv > 0.86 ) { return 0; }
			var at = ( bu + ( 2 - bv ) * 4 ) * 0.12, on = clamp( ( el - at ) / 0.35, 0, 1 );
			return ( 0.35 + ( ( bu * 7 + bv * 3 ) % 5 ) * 0.22 ) * A * easeOut( on );
		}
		st = stage( cv, host, {
			build: function ( s ) {
				var gap = s.small ? 28 : pinned() ? 48 : 40, // pinned desktop: a sparser floor (about a third fewer glyphs), more air between the columns
					 u = s.h * 0.6, yb = s.h - 8;
				Ymax = u * D / ( CS * D - u * SN );
				var sBack = D / ( D + Ymax * SN );
				Xmax = s.w / 2 / sBack * 1.02;
				A = s.small ? 95 : 170;
				pts = [];
				for ( var Y = 0; Y <= Ymax; Y += gap * ( 1 + Y / Ymax * 0.5 ) ) {
					for ( var X = -Xmax; X <= Xmax; X += gap ) {
						pts.push( { X: X, Y: Y, u: X / Xmax, v: Y / Ymax, H: 0, e: hash( X * 0.013 + Y * 0.71 ), yb: yb } );
					}
				}
			},
			enter: function ( s ) { since = lastSwitch = s.t0; },
			still: function ( s ) {
				pts.forEach( function ( p ) { p.H = target( act, p.u, p.v, p.X, p.Y, 2, 9, p ); } );
				paint( s );
			},
			frame: function ( s, t, k ) {
				if ( ! user && ! pinned() && t - Math.max( since, lastSwitch ) > 5 ) { lastSwitch = t; setAct( ( act + 1 ) % items.length ); }
				var el = t - since, cur = null;
				if ( s.on ) { // the pointer, back-projected onto the plane
					var uu = ( pts.length ? pts[ 0 ].yb : s.h ) - s.py;
					if ( uu > 0 ) {
						var Yn = uu * D / ( CS * D - uu * SN );
						if ( Yn > 0 && Yn < Ymax * 1.3 ) { var sc = D / ( D + Yn * SN ); cur = { X: ( s.px - s.w / 2 ) / sc, Y: Yn }; }
					}
				}
				var ease = Math.min( 1, 0.07 * k );
				for ( var i = 0; i < pts.length; i++ ) {
					var p = pts[ i ], tg = target( act, p.u, p.v, p.X, p.Y, t, el, p );
					if ( cur ) {
						var dx = p.X - cur.X, dy = p.Y - cur.Y, dd = Math.sqrt( dx * dx + dy * dy ), sg = s.small ? 160 : 240;
						tg += Math.exp( -dd * dd / ( 2 * sg * sg ) ) * A * 0.9 + Math.cos( dd / 38 - t * 6 ) * Math.exp( -dd / 260 ) * A * 0.18;
					}
					p.H += ( tg - p.H ) * ease;
				}
				s.ctx.clearRect( 0, 0, s.w, s.h );
				paint( s );
			}
		}, ctl );
		function paint( s ) {
			var ctx = s.ctx, lastY = -1, fs0 = s.small ? 12 : 15;
			ctx.textAlign = 'center';
			ctx.textBaseline = 'middle';
			for ( var i = pts.length - 1; i >= 0; i-- ) {
				var p = pts[ i ], sc = D / ( D + p.Y * SN );
				if ( p.Y !== lastY ) { lastY = p.Y; ctx.font = '500 ' + ( fs0 * ( 0.35 + sc * 0.75 ) ).toFixed( 1 ) + 'px ' + MONO; }
				var x = s.w / 2 + p.X * sc;
				if ( x < -10 || x > s.w + 10 ) { continue; }
				var lift = Math.max( 0, p.H ) * SN * sc, y0 = p.yb - p.Y * CS * sc, y = y0 - lift;
				var hn = clamp( p.H / ( A * 1.5 ), 0, 1 ), g = 1 + Math.round( hn * ( RAMP.length - 2 ) );
				var fade = Math.pow( 1 - p.v, 1.1 ) * 0.85 + 0.15, fz = fs0 * ( 0.35 + sc * 0.75 ) * 0.9;
				if ( lift > fz * 1.3 ) { // a raised point is a column of glyphs, so the relief reads as volume
					var n = Math.floor( lift / fz );
					ctx.fillStyle = PAPER;
					for ( var j = 0; j < n; j++ ) { var ff = j / n; ctx.globalAlpha = ( 0.1 + 0.45 * ff ) * fade; ctx.fillText( RAMP[ 1 + Math.floor( ff * 4 ) ], x, y0 - j * fz ); }
				}
				ctx.globalAlpha = Math.min( 1, ( 0.3 + hn * 0.9 ) * fade + 0.05 );
				ctx.fillStyle = hn > 0.55 ? TEAL : PAPER;
				ctx.fillText( RAMP[ g ], x, y );
			}
			ctx.globalAlpha = 1;
		}
	}

	/* ---------- start ---------- */
	function start() {
		COARSE = window.matchMedia( '(pointer: coarse)' ).matches;
		var ctl = { ac: new AbortController(), obs: [], stages: [], cleanup: [] };
		grains( ctl );
		floor( ctl );
	}

	// the grains and glyphs are sampled from Bricolage and Geist Mono: start once the type is in
	var fontsReady = document.fonts && document.fonts.load ? Promise.all( [
		document.fonts.load( '500 40px "Geist Mono"' ),
		document.fonts.load( '800 100px "Bricolage Grotesque"' )
	] ).catch( function () {} ) : Promise.resolve();
	Promise.race( [ fontsReady, new Promise( function ( r ) { setTimeout( r, 2500 ); } ) ] ).then( function () {
		start();
	} );
}() );

/* 3.56.3 · the paper → ink fade rises with the scroll (--ap-s = where the dark starts, 72% → 0%). */
( function () {
	var f = document.querySelector( '.ap-fade' );
	if ( ! f ) { return; }
	if ( window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) { f.style.setProperty( '--ap-s', '0%' ); return; }
	var ticking = false;
	function upd() {
		ticking = false;
		var r = f.getBoundingClientRect(), vh = window.innerHeight || 1;
		var p = Math.min( 1, Math.max( 0, ( vh - r.top ) / ( vh * 0.85 ) ) );
		p = 1 - Math.pow( 1 - p, 2 ); // ease out
		f.style.setProperty( '--ap-s', ( ( 1 - p ) * 72 ).toFixed( 2 ) + '%' );
	}
	function q() { if ( ! ticking ) { ticking = true; requestAnimationFrame( upd ); } }
	window.addEventListener( 'scroll', q, { passive: true } );
	window.addEventListener( 'resize', q );
	upd();
}() );
