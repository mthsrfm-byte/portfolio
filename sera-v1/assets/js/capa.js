/* Sera · v3.44 · Selected work cards: "Capa" (template-parts/case-card.php, assets/css/capa.css)
   1. Fit: the case name fills the card's width in one line (refit only when the width changes, so the
      stacked phone layout can't loop), then the mockup and the cover lines are placed from it.
   2. Grains: near the cursor the name opens a soft hole and a canvas draws the same letters as the
      cover's round ink grains, pushed outwards at a random angle. Never over the mockup.
   Off under reduced motion. Scrolling is plain and native: nothing here runs per scroll frame. */
( function () {
	'use strict';
	var cards = [].slice.call( document.querySelectorAll( '.cases > .case-capa' ) );
	if ( ! cards.length ) {
		return;
	}
	var reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var finePointer = window.matchMedia( '(hover: hover) and (pointer: fine)' ).matches;
	var PHONE = 760;
	var FIG_RATIO = 528 / 600; // the mockup stage (width / height) on tablet and desktop
	var fontsReady = document.fonts && document.fonts.ready ? document.fonts.ready : Promise.resolve();

	function isPhone() {
		return window.innerWidth <= PHONE;
	}

	/* ---------- 1. fit ---------- */
	function textWidthAt100( el ) {
		var cs = getComputedStyle( el );
		var probe = document.createElement( 'span' );
		probe.textContent = el.textContent;
		probe.style.cssText = 'position:absolute;left:-9999px;top:0;visibility:hidden;white-space:nowrap;font-size:100px;line-height:1';
		probe.style.fontFamily = cs.fontFamily;
		probe.style.fontWeight = cs.fontWeight;
		probe.style.fontStretch = cs.fontStretch;
		probe.style.letterSpacing = '-1.2px'; // -.012em at 100px
		probe.style.textTransform = cs.textTransform;
		document.body.appendChild( probe );
		var w = probe.getBoundingClientRect().width || 1;
		probe.remove();
		return w;
	}

	function layout( card ) {
		var mast = card.querySelector( '.cc-mast' );
		var name = card.querySelector( '.cc-mast-t' );
		if ( ! mast || ! name ) {
			return;
		}
		flatFloor( card );
		var phone = isPhone();
		var W = card.clientWidth;
		var H = card.clientHeight;
		var pad = phone ? 16 : parseFloat( getComputedStyle( mast ).left ) || 32;
		var size = Math.min( phone ? 150 : H * 0.3, 100 * ( W - pad * 2 ) / textWidthAt100( name ) );
		mast.style.fontSize = size + 'px';
		// never let the name run past the card: shrink until the browser's own layout says it fits
		for ( var g = 0; g < 30 && mast.scrollWidth > mast.clientWidth + 1; g++ ) {
			size *= 0.97;
			mast.style.fontSize = size + 'px';
		}
		var nameH = size * 0.8;
		card.style.setProperty( '--mh', ( nameH + pad * 0.8 ) + 'px' );
		if ( phone ) {
			card.style.setProperty( '--fmt', ( -nameH * 0.16 ) + 'px' );
			fitWords( card );
			// short screens: the third metric line steps aside before the mockup gets cramped
			card.classList.remove( 'is-tight', 'is-snug' );
			var fig = card.querySelector( '.cc-fig' );
			if ( fig && fig.offsetHeight < W * 0.7 ) {
				card.classList.add( 'is-tight' );
			}
			return;
		}
		var st = pad * 0.8 + nameH * 0.74; // the mockup covers the bottom 26% of the letters
		// narrower cards give the mockup a little less, so the corner columns keep room for "Read case"
		var sw = Math.min( ( H - st - pad * 1.1 ) * FIG_RATIO, W * ( W < 1000 ? 0.44 : 0.5 ) );
		card.style.setProperty( '--st', st + 'px' );
		card.style.setProperty( '--sw', sw + 'px' );
		card.style.setProperty( '--fh', ( sw / FIG_RATIO ) + 'px' );
		fitWords( card );
		fitCorners( card );
	}

	// a cover line never breaks inside a word ("SEARCHABLE" in a narrow column): it steps down instead
	function fitWords( card ) {
		[].forEach.call( card.querySelectorAll( '.cl .h, .cl h3' ), function ( el ) {
			el.style.fontSize = '';
			var fs = parseFloat( getComputedStyle( el ).fontSize ) || 0;
			for ( var g = 0; fs && g < 24 && el.scrollWidth > el.clientWidth + 1; g++ ) {
				fs *= 0.94;
				el.style.fontSize = fs.toFixed( 1 ) + 'px';
			}
		} );
	}

	// the bottom corners never reach the top ones: the left title steps down, then on the right the
	// big proof number, and last the small print under the other two metrics
	function overlaps( top, bottom ) {
		return top && bottom && bottom.getBoundingClientRect().top < top.getBoundingClientRect().bottom + 20;
	}
	function shrinkUntil( el, check, floor ) {
		var base = el ? parseFloat( getComputedStyle( el ).fontSize ) || 0 : 0;
		for ( var f = 0.92; base && f >= floor && check(); f -= 0.08 ) {
			el.style.fontSize = ( base * f ).toFixed( 1 ) + 'px';
		}
	}
	function fitCorners( card ) {
		var c1 = card.querySelector( '.c1' );
		var c2 = card.querySelector( '.c2' );
		var c3 = card.querySelector( '.c3' );
		var c4 = card.querySelector( '.c4' );
		card.classList.remove( 'is-snug' );
		shrinkUntil( c3 && c3.querySelector( 'h3' ), function () {
			return overlaps( c1, c3 );
		}, 0.5 );
		shrinkUntil( c2 && c2.querySelector( '.big' ), function () {
			return overlaps( c2, c4 );
		}, 0.6 );
		if ( overlaps( c2, c4 ) ) {
			card.classList.add( 'is-snug' );
		}
	}

	/* ---------- 1b. floor, flattened (3.44.3) ----------
	   The CSS floor is three 3D-tilted grids, blurred and masked, in every card: the browser redraws them on
	   every scroll frame (the deck's flicker). Here the same picture is drawn once per floor size on a canvas,
	   with the same maths as the CSS (perspective 900px, rotateX 64deg, origin at the bottom centre, 84px grid
	   anchored centre/bottom, 1px lines at .13), and shown as a flat background. The CSS stays as the fallback. */
	var FLOOR = {
		d: 900,
		th: 64 * Math.PI / 180,
		cell: 84,
		layers: [
			{ blur: 0, op: 1, mask: [ [ 0, 1 ], [ 0.16, 1 ], [ 0.4, 0 ] ] },
			{ blur: 1.3, op: 1, mask: [ [ 0.12, 0 ], [ 0.32, 1 ], [ 0.46, 1 ], [ 0.66, 0 ] ] },
			{ blur: 3.4, op: 0.85, mask: [ [ 0.4, 0 ], [ 0.6, 1 ], [ 0.78, 0.6 ], [ 0.96, 0 ] ] },
		],
	};
	var floors = {}; // "w×h" → blob URL, shared by every card of that size
	function floorImage( w, h, done ) {
		var key = w + 'x' + h;
		if ( floors[ key ] ) {
			if ( floors[ key ].url ) {
				done( floors[ key ].url );
			} else {
				floors[ key ].wait.push( done );
			}
			return;
		}
		floors[ key ] = { url: '', wait: [ done ] };
		var dpr = Math.min( 2, window.devicePixelRatio || 1 );
		var out = document.createElement( 'canvas' );
		out.width = Math.round( w * dpr );
		out.height = Math.round( h * dpr );
		var o = out.getContext( '2d' );
		var cs = Math.cos( FLOOR.th );
		var sn = Math.sin( FLOOR.th );
		var half = w * 0.8; // the plane is 160% of the floor wide (left/right -30%)
		function P( X, Y ) {
			var s = FLOOR.d / ( FLOOR.d - Y * sn );
			return [ ( w / 2 + X * s ) * dpr, ( h + Y * cs * s ) * dpr ];
		}
		function quad( c, a, b, e, f ) {
			c.moveTo( a[ 0 ], a[ 1 ] );
			c.lineTo( b[ 0 ], b[ 1 ] );
			c.lineTo( e[ 0 ], e[ 1 ] );
			c.lineTo( f[ 0 ], f[ 1 ] );
			c.closePath();
		}
		FLOOR.layers.forEach( function ( L ) {
			var cv = document.createElement( 'canvas' );
			cv.width = out.width;
			cv.height = out.height;
			var c = cv.getContext( '2d' );
			c.fillStyle = 'rgba(17,17,16,.13)';
			// horizontal lines: 1px bands at the top of each cell, cells stacked up from the bottom edge
			for ( var Y = -FLOOR.cell; Y >= -h; Y -= FLOOR.cell ) {
				c.beginPath();
				quad( c, P( -half, Y ), P( half, Y ), P( half, Y + 1 ), P( -half, Y + 1 ) );
				c.fill();
			}
			// vertical lines: 1px bands at the left of each cell, the grid centred
			for ( var X = -FLOOR.cell / 2 - Math.ceil( half / FLOOR.cell ) * FLOOR.cell; X < half; X += FLOOR.cell ) {
				if ( X + 1 < -half ) {
					continue;
				}
				c.beginPath();
				quad( c, P( X, 0 ), P( X + 1, 0 ), P( X + 1, -h ), P( X, -h ) );
				c.fill();
			}
			// blur, then the mask (bottom → top, in the floor box), then opacity: the CSS order
			var src = cv;
			if ( L.blur ) {
				var b = document.createElement( 'canvas' );
				b.width = cv.width;
				b.height = cv.height;
				var bc = b.getContext( '2d' );
				if ( 'filter' in bc ) {
					bc.filter = 'blur(' + ( L.blur * dpr ) + 'px)';
					bc.drawImage( cv, 0, 0 );
				} else {
					// no canvas filters: soften by drawing small and back up
					var k = 1 / ( 1 + L.blur );
					var t = document.createElement( 'canvas' );
					t.width = Math.max( 1, Math.round( cv.width * k ) );
					t.height = Math.max( 1, Math.round( cv.height * k ) );
					t.getContext( '2d' ).drawImage( cv, 0, 0, t.width, t.height );
					bc.imageSmoothingQuality = 'high';
					bc.drawImage( t, 0, 0, b.width, b.height );
				}
				src = b;
			}
			var m = src.getContext( '2d' );
			m.filter = 'none';
			m.globalCompositeOperation = 'destination-in';
			var g = m.createLinearGradient( 0, src.height, 0, 0 );
			L.mask.forEach( function ( st ) {
				g.addColorStop( st[ 0 ], 'rgba(0,0,0,' + st[ 1 ] + ')' );
			} );
			m.fillStyle = g;
			m.fillRect( 0, 0, src.width, src.height );
			o.globalAlpha = L.op;
			o.drawImage( src, 0, 0 );
		} );
		o.globalAlpha = 1;
		function finish( url ) {
			floors[ key ].url = url;
			floors[ key ].wait.forEach( function ( fn ) {
				fn( url );
			} );
			floors[ key ].wait = [];
		}
		if ( out.toBlob && window.URL && URL.createObjectURL ) {
			out.toBlob( function ( blob ) {
				if ( blob ) {
					finish( URL.createObjectURL( blob ) );
				}
			} );
		} else {
			finish( out.toDataURL() );
		}
	}
	function flatFloor( card ) {
		var fl = card.querySelector( '.cc-floor' );
		if ( ! fl ) {
			return;
		}
		var w = fl.clientWidth;
		var h = fl.clientHeight;
		if ( ! w || ! h ) {
			return;
		}
		var key = w + 'x' + h;
		fl.ccKey = key;
		try {
			floorImage( w, h, function ( url ) {
				if ( fl.ccKey === key ) {
					fl.style.backgroundImage = 'url("' + url + '")';
					fl.classList.add( 'is-flat' );
				}
			} );
		} catch ( e ) {} // the CSS floor stays
	}

	/* ---------- 2. grains ---------- */
	var dust = null; // one fixed canvas shared by every card: the name's box plus MARGIN, kept inside the viewport
	function dustLayer() {
		if ( dust ) {
			return dust;
		}
		var cv = document.createElement( 'canvas' );
		cv.className = 'cc-dust';
		cv.setAttribute( 'aria-hidden', 'true' );
		document.body.appendChild( cv );
		dust = { cv: cv, ctx: cv.getContext( '2d' ), dpr: 1, w: 0, h: 0, x: 0, y: 0 };
		return dust;
	}
	function placeDust( mr ) {
		var d = dustLayer();
		var dpr = Math.min( 1.5, window.devicePixelRatio || 1 );
		var vw = document.documentElement.clientWidth;
		var vh = window.innerHeight;
		var w = Math.min( vw, Math.ceil( mr.width + 2 * MARGIN ) );
		var h = Math.min( vh, Math.ceil( mr.height + 2 * MARGIN ) );
		if ( w !== d.w || h !== d.h || dpr !== d.dpr ) {
			d.w = w;
			d.h = h;
			d.dpr = dpr;
			d.cv.width = Math.round( w * dpr );
			d.cv.height = Math.round( h * dpr );
			d.cv.style.width = w + 'px';
			d.cv.style.height = h + 'px';
		}
		var x = Math.round( Math.max( 0, Math.min( vw - w, mr.left - MARGIN ) ) );
		var y = Math.round( Math.max( 0, Math.min( vh - h, mr.top - MARGIN ) ) );
		if ( x !== d.x || y !== d.y ) {
			d.x = x;
			d.y = y;
			d.cv.style.transform = 'translate(' + x + 'px,' + y + 'px)';
		}
		return d;
	}

	var REACH = 140; // the hole opens with the cursor up to this far from the letters
	var MARGIN = 220; // how far past the name a grain may travel
	var LEVELS = 8; // grains are batched by alpha into this many fills per frame

	function smooth( a, b, v ) {
		var t = Math.max( 0, Math.min( 1, ( v - a ) / ( b - a ) ) );
		return t * t * ( 3 - 2 * t );
	}

	function grains( card ) {
		var mast = card.querySelector( '.cc-mast' );
		var name = card.querySelector( '.cc-mast-t' );
		var fig = card.querySelector( '.cc-fig' );
		var pts = [];
		var W = 0;
		var H = 0;
		var mx = -1e4;
		var my = -1e4;
		var R = 0;
		var RT = 0;
		var raf = 0;
		var stale = true;

		function build() {
			stale = false;
			W = mast.offsetWidth;
			H = mast.offsetHeight;
			pts = [];
			if ( ! W || ! H ) {
				return;
			}
			// where the browser actually set the type: the text box and its baseline
			var mr = mast.getBoundingClientRect();
			var range = document.createRange();
			range.selectNodeContents( name );
			var tr = range.getBoundingClientRect();
			var baseline = mast.querySelector( '.bl' ).getBoundingClientRect().top - mr.top;
			var fs = parseFloat( getComputedStyle( mast ).fontSize );
			var txt = name.textContent.toUpperCase();
			var off = document.createElement( 'canvas' );
			off.width = Math.ceil( W );
			off.height = Math.ceil( H );
			var x = off.getContext( '2d' );
			x.font = 'condensed 800 ' + fs + 'px "Bricolage Grotesque"';
			try {
				x.fontStretch = 'condensed';
			} catch ( e ) {}
			try {
				x.letterSpacing = ( -0.012 * fs ) + 'px';
			} catch ( e ) {}
			var cw = x.measureText( txt ).width || 1;
			x.setTransform( tr.width / cw, 0, 0, 1, tr.left - mr.left, 0 );
			x.fillStyle = '#000';
			x.textBaseline = 'alphabetic';
			x.fillText( txt, 0, baseline );
			// the cover's dust grains: round ink dots of 1.75px on a jittered grid, each with its own seed
			var data = x.getImageData( 0, 0, off.width, off.height ).data;
			var step = 2.6;
			for ( var cy = 0; cy < off.height; cy += step ) {
				for ( var cx = 0; cx < off.width; cx += step ) {
					var hx = cx + Math.random() * step;
					var hy = cy + Math.random() * step;
					var xi = Math.min( off.width - 1, hx | 0 );
					var yi = Math.min( off.height - 1, hy | 0 );
					if ( data[ ( yi * off.width + xi ) * 4 + 3 ] > 120 ) {
						pts.push( { hx: hx, hy: hy, r: Math.random(), ox: 0, oy: 0 } );
					}
				}
			}
		}

		function frame() {
			raf = 0;
			var mr = mast.getBoundingClientRect();
			var fr = fig.getBoundingClientRect();
			var d = placeDust( mr );
			var ctx = d.ctx;
			R += ( RT - R ) * 0.14;
			mast.classList.add( 'is-hole' );
			mast.style.setProperty( '--mr', Math.max( 1, R ).toFixed( 1 ) + 'px' );
			mast.style.setProperty( '--mx', mx.toFixed( 1 ) + 'px' );
			mast.style.setProperty( '--my', my.toFixed( 1 ) + 'px' );
			ctx.setTransform( 1, 0, 0, 1, 0, 0 );
			ctx.clearRect( 0, 0, d.cv.width, d.cv.height );
			ctx.setTransform( d.dpr, 0, 0, d.dpr, ( mr.left - d.x ) * d.dpr, ( mr.top - d.y ) * d.dpr );
			// never draw over the mockup: clip it out
			ctx.save();
			ctx.beginPath();
			ctx.rect( -MARGIN, -MARGIN, W + 2 * MARGIN, H + 2 * MARGIN );
			ctx.rect( fr.left - mr.left, fr.top - mr.top, fr.width, fr.height );
			ctx.clip( 'evenodd' );
			var inner = R * 0.66;
			var reach = R * 1.1 + 1;
			var busy = RT > 0 || R > 0.6;
			var t = performance.now() / 1000;
			var paths = [];
			for ( var l = 0; l < LEVELS; l++ ) {
				paths.push( new Path2D() );
			}
			for ( var i = 0; i < pts.length; i++ ) {
				var p = pts[ i ];
				var dx = p.hx - mx;
				var dy = p.hy - my;
				// far from the cursor and already home: nothing to move or draw (most of the name, every frame)
				if ( p.ox === 0 && p.oy === 0 && ( dx > reach || dx < -reach || dy > reach || dy < -reach ) ) {
					continue;
				}
				// the cover dust's push: outward from the pointer, turned by a random angle, scaled by the seed
				var dd = Math.sqrt( dx * dx + dy * dy ) || 1;
				var k = R > 1 ? smooth( R * 1.1, 0, dd ) : 0;
				k *= k;
				var tx = 0;
				var ty = 0;
				if ( k > 0 ) {
					var ang = ( p.r - 0.5 ) * 1.4;
					var ux = dx / dd;
					var uy = dy / dd;
					var ca = Math.cos( ang );
					var sa = Math.sin( ang );
					var push = k * R * ( 0.12 + p.r * 0.5 );
					tx = ( ux * ca - uy * sa ) * push + Math.sin( t * 1.3 + p.r * 40 ) * 0.6 * k;
					ty = ( ux * sa + uy * ca ) * push + Math.cos( t * 1.1 + p.r * 31 ) * 0.6 * k;
				}
				p.ox += ( tx - p.ox ) * 0.18;
				p.oy += ( ty - p.oy ) * 0.18;
				var disp = Math.abs( p.ox ) + Math.abs( p.oy );
				if ( 0 === k && disp < 0.05 ) {
					p.ox = 0;
					p.oy = 0;
				}
				if ( disp > 0.3 ) {
					busy = true;
				}
				var a = R < 1 ? 0 : 1 - smooth( inner, R, dd );
				if ( disp > 1.2 ) {
					a = Math.max( a, Math.min( 1, disp / 6 ) );
				}
				if ( a < 0.02 ) {
					continue;
				}
				var rad = ( 1.75 + k * 2.4 * p.r ) / 2;
				var path = paths[ Math.min( LEVELS - 1, Math.floor( a * LEVELS ) ) ];
				var px = p.hx + p.ox;
				var py = p.hy + p.oy;
				path.moveTo( px + rad, py );
				path.arc( px, py, rad, 0, 6.2832 );
			}
			ctx.fillStyle = '#111110';
			for ( var b = 0; b < LEVELS; b++ ) {
				ctx.globalAlpha = ( b + 0.5 ) / LEVELS;
				ctx.fill( paths[ b ] );
			}
			ctx.globalAlpha = 1;
			ctx.restore();
			if ( busy ) {
				raf = window.requestAnimationFrame( frame );
			} else {
				ctx.setTransform( 1, 0, 0, 1, 0, 0 );
				ctx.clearRect( 0, 0, d.cv.width, d.cv.height );
				mast.classList.remove( 'is-hole' );
			}
		}
		function kick() {
			if ( ! raf ) {
				raf = window.requestAnimationFrame( frame );
			}
		}
		function release() {
			if ( RT !== 0 ) {
				RT = 0;
				kick();
			}
		}
		card.addEventListener( 'pointermove', function ( e ) {
			if ( stale ) {
				build();
			}
			var r = mast.getBoundingClientRect();
			mx = e.clientX - r.left;
			my = e.clientY - r.top;
			var gx = Math.max( r.left - e.clientX, 0, e.clientX - r.right );
			var gy = Math.max( r.top - e.clientY, 0, e.clientY - r.bottom );
			var rmax = Math.max( 90, Math.min( 180, H * 0.75 ) );
			RT = rmax * Math.max( 0, Math.min( 1, 1 - Math.sqrt( gx * gx + gy * gy ) / REACH ) );
			kick();
		} );
		card.addEventListener( 'pointerleave', release );
		return {
			invalidate: function () {
				stale = true;
			},
			release: release,
		};
	}

	/* ---------- wiring ---------- */
	fontsReady.then( function () {
		cards.forEach( function ( card ) {
			layout( card );
			if ( ! reduce && finePointer ) {
				card.ccGrains = grains( card );
			}
		} );
		if ( 'ResizeObserver' in window ) {
			// refit only when the width changes (and the height, where the layout isn't stacked)
			var seen = new WeakMap();
			var ro = new ResizeObserver( function ( entries ) {
				entries.forEach( function ( e ) {
					var card = e.target;
					var w = card.clientWidth;
					var h = isPhone() ? 0 : card.clientHeight;
					var last = seen.get( card );
					if ( last && last.w === w && last.h === h ) {
						return;
					}
					seen.set( card, { w: w, h: h } );
					layout( card );
					if ( card.ccGrains ) {
						card.ccGrains.invalidate();
					}
				} );
			} );
			cards.forEach( function ( c ) {
				ro.observe( c );
			} );
		}
		// scrolling moves the name away from a still cursor: close the hole instead of leaving it open
		if ( ! reduce && finePointer ) {
			window.addEventListener( 'scroll', function () {
				cards.forEach( function ( card ) {
					if ( card.ccGrains ) {
						card.ccGrains.release();
					}
				} );
			}, { passive: true } );
		}
		// 3.44.3 · the stack: every card stays stuck under the header, so all nine are "on screen" at once,
		// each with its looping mockup and blurred floor. A card that is already covered stops: its animations
		// pause, and from two below the top of the stack it isn't drawn at all (the one right under the top
		// stays drawn, so scrolling back up never uncovers an empty spot). Cards far below the fold pause too.
		var stackState = cards.map( function () {
			return '';
		} );
		var stackTick = false;
		function stack() {
			stackTick = false;
			var stick = parseFloat( getComputedStyle( cards[ 0 ] ).top ) || 0;
			var vh = window.innerHeight;
			var tops = cards.map( function ( c ) {
				return c.getBoundingClientRect().top;
			} );
			var k = -1; // the top of the stack: the last card resting at its sticky line
			tops.forEach( function ( t, i ) {
				if ( t <= stick + 1 ) {
					k = i;
				}
			} );
			cards.forEach( function ( card, i ) {
				var s = '';
				if ( i < k - 1 ) {
					s = 'is-buried';
				} else if ( i < k || tops[ i ] > vh * 2 ) {
					s = 'is-still';
				}
				// 3.45.1 · buried or well below the fold: the mockup becomes a plain skeleton block, so its
				// screens, layers and images stop costing memory; it comes back before it reaches the screen
				card.classList.toggle( 'is-skel', i < k - 1 || tops[ i ] > vh * 1.5 );
				if ( s !== stackState[ i ] ) {
					card.classList.remove( 'is-buried', 'is-still' );
					if ( s ) {
						card.classList.add( s );
					}
					stackState[ i ] = s;
				}
			} );
		}
		function queueStack() {
			if ( ! stackTick ) {
				stackTick = true;
				window.requestAnimationFrame( stack );
			}
		}
		if ( cards.length > 1 ) {
			window.addEventListener( 'scroll', queueStack, { passive: true } );
			window.addEventListener( 'resize', queueStack );
			stack();
		}
		// the thin cover-line face can arrive after fonts.ready (it is only requested once used): refit then
		function refitAll() {
			cards.forEach( function ( card ) {
				layout( card );
				if ( card.ccGrains ) {
					card.ccGrains.invalidate();
				}
			} );
		}
		if ( document.fonts && document.fonts.addEventListener ) {
			document.fonts.addEventListener( 'loadingdone', refitAll );
		}
		window.addEventListener( 'load', refitAll );
	} );
} )();
