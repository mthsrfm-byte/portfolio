( function () {
	'use strict';

	// One rAF-gated scroll handler: header border + over-scroll canvas colour.
	var header = document.querySelector( '.site-header' );
	var root = document.documentElement;
	var PT = ( root.lang || '' ).indexOf( 'pt' ) === 0;
	function t( en, pt ) {
		return PT ? pt : en;
	}
	var scrollTick = false;
	function onScroll() {
		scrollTick = false;
		if ( header ) {
			header.classList.toggle( 'is-scrolled', window.scrollY > 8 );
		}
		// Over-scroll colour. The root canvas is footer-dark by default (CSS), so pulling past the end never
		// shows cream. In the top half of a scrollable page it turns paper so a top over-pull matches the header.
		var max = root.scrollHeight - window.innerHeight;
		root.classList.toggle( 'is-top', max > 0 && window.scrollY < max / 2 );
		// Near the end (used by case.css to fade the side TOC away from the footer).
		root.classList.toggle( 'at-end', max - window.scrollY < window.innerHeight );
	}
	function queueScroll() {
		if ( ! scrollTick ) {
			scrollTick = true;
			requestAnimationFrame( onScroll );
		}
	}
	window.addEventListener( 'scroll', queueScroll, { passive: true } );
	window.addEventListener( 'resize', queueScroll, { passive: true } );
	window.addEventListener( 'load', onScroll );
	window.addEventListener( 'pageshow', onScroll );
	onScroll();

	// Mobile menu.
	var toggle = document.querySelector( '.menu-toggle' );
	var nav = document.getElementById( 'primary-nav' );
	if ( toggle && nav ) {
		var label = toggle.querySelector( '.menu-label' );
		function setMenu( open, refocus ) {
			if ( open ) {
				document.dispatchEvent( new CustomEvent( 'sera:open', { detail: 'menu' } ) );
			}
			nav.classList.toggle( 'is-open', open );
			toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			if ( label ) {
				label.textContent = open ? t( 'Close', 'Fechar' ) : t( 'Menu', 'Menu' );
			}
			if ( open ) {
				var first = nav.querySelector( 'a' );
				if ( first ) {
					first.focus();
				}
			} else if ( refocus ) {
				toggle.focus();
			}
		}
		toggle.addEventListener( 'click', function () {
			setMenu( ! nav.classList.contains( 'is-open' ) );
		} );
		nav.addEventListener( 'click', function ( e ) {
			if ( e.target.closest( 'a' ) ) {
				setMenu( false );
			}
		} );
		document.addEventListener( 'sera:open', function ( e ) {
			if ( 'menu' !== e.detail && nav.classList.contains( 'is-open' ) ) {
				setMenu( false );
			}
		} );
		document.addEventListener( 'keydown', function ( e ) {
			if ( 'Escape' === e.key && nav.classList.contains( 'is-open' ) ) {
				setMenu( false, true );
			}
		} );
		document.addEventListener( 'click', function ( e ) {
			if ( nav.classList.contains( 'is-open' ) && ! e.target.closest( '#primary-nav, .menu-toggle' ) ) {
				setMenu( false );
			}
		} );
		// aria-current on the link that points at this page.
		var here = location.href.replace( /[#?].*$/, '' ).replace( /\/$/, '' );
		[].slice.call( nav.querySelectorAll( 'a[href]' ) ).forEach( function ( a ) {
			var href = a.href.replace( /[#?].*$/, '' ).replace( /\/$/, '' );
			if ( href === here && ! /#./.test( a.getAttribute( 'href' ) ) ) {
				a.setAttribute( 'aria-current', 'page' );
			}
		} );
	}

	/* ---- language switcher: glass popover with real links (EN at /, PT at /pt/) ----
	   Without JS the trigger is a plain link to the other language. With JS it opens a menu:
	   click / Enter / Space / ↓ open it, arrows move, Esc closes and returns focus, a click outside
	   closes it. Choosing a language stores it (cookie sera_lang) and lets the link navigate at once;
	   the code in the pill flips while the next page loads. */
	( function () {
		var box = document.querySelector( '.lang' );
		if ( ! box ) {
			return;
		}
		var trigger = box.querySelector( '.lang-trigger' );
		var pop = box.querySelector( '.lang-pop' );
		var opts = pop ? [].slice.call( pop.querySelectorAll( '.lang-opt' ) ) : [];
		var cur = box.getAttribute( 'data-lang' ) || 'en';
		var closeT = null;
		if ( ! trigger || ! pop || ! opts.length ) {
			return;
		}

		function setCookie( lang ) {
			try {
				document.cookie = 'sera_lang=' + lang + '; path=/; max-age=31536000; SameSite=Lax' + ( 'https:' === location.protocol ? '; Secure' : '' );
			} catch ( err ) {}
		}

		// The pill becomes a menu button.
		trigger.setAttribute( 'role', 'button' );
		trigger.setAttribute( 'aria-haspopup', 'menu' );
		trigger.setAttribute( 'aria-expanded', 'false' );
		trigger.setAttribute( 'aria-controls', pop.id );
		pop.hidden = false;
		box.classList.add( 'is-ready' );

		// Where the popover grows from: the trigger's centre (it is right-aligned to the actions on phones).
		function origin() {
			var pr = pop.getBoundingClientRect();
			var tr = trigger.getBoundingClientRect();
			var x = Math.round( tr.left + tr.width / 2 - pr.left );
			pop.style.setProperty( '--lang-ox', Math.max( 16, Math.min( pr.width - 16, x ) ) + 'px' );
		}
		function isOpen() {
			return box.classList.contains( 'is-open' );
		}
		function open( focusIdx ) {
			if ( isOpen() ) {
				return;
			}
			document.dispatchEvent( new CustomEvent( 'sera:open', { detail: 'lang' } ) );
			clearTimeout( closeT );
			box.classList.remove( 'is-closing' );
			box.classList.add( 'is-open' );
			trigger.setAttribute( 'aria-expanded', 'true' );
			origin();
			var i = 'number' === typeof focusIdx ? focusIdx : Math.max( 0, opts.findIndex( function ( o ) {
				return o.classList.contains( 'is-current' );
			} ) );
			opts[ ( i + opts.length ) % opts.length ].focus( { preventScroll: true } );
		}
		function close( refocus ) {
			if ( ! isOpen() ) {
				return;
			}
			box.classList.remove( 'is-open' );
			box.classList.add( 'is-closing' );
			trigger.setAttribute( 'aria-expanded', 'false' );
			closeT = setTimeout( function () {
				box.classList.remove( 'is-closing' );
			}, 200 );
			if ( refocus ) {
				trigger.focus( { preventScroll: true } );
			}
		}

		trigger.addEventListener( 'click', function ( e ) {
			e.preventDefault();
			if ( isOpen() ) {
				close( false );
			} else {
				open();
			}
		} );
		trigger.addEventListener( 'keydown', function ( e ) {
			if ( ' ' === e.key || 'Enter' === e.key || 'ArrowDown' === e.key ) {
				e.preventDefault();
				open( 'ArrowDown' === e.key ? 0 : undefined );
			} else if ( 'ArrowUp' === e.key ) {
				e.preventDefault();
				open( opts.length - 1 );
			}
		} );
		pop.addEventListener( 'keydown', function ( e ) {
			var i = opts.indexOf( document.activeElement );
			var next = null;
			if ( 'ArrowDown' === e.key ) {
				next = i + 1;
			} else if ( 'ArrowUp' === e.key ) {
				next = i - 1;
			} else if ( 'Home' === e.key ) {
				next = 0;
			} else if ( 'End' === e.key ) {
				next = opts.length - 1;
			} else if ( 'Escape' === e.key ) {
				e.preventDefault();
				close( true );
				return;
			} else if ( 'Tab' === e.key ) {
				close( false );
				return;
			} else if ( ' ' === e.key && i >= 0 ) {
				e.preventDefault();
				opts[ i ].click();
				return;
			}
			if ( null !== next ) {
				e.preventDefault();
				opts[ ( next + opts.length ) % opts.length ].focus();
			}
		} );
		document.addEventListener( 'click', function ( e ) {
			if ( isOpen() && ! box.contains( e.target ) ) {
				close( false );
			}
		} );
		document.addEventListener( 'sera:open', function ( e ) {
			if ( 'lang' !== e.detail ) {
				close( false );
				}
		} );
		window.addEventListener( 'resize', function () {
			if ( isOpen() ) {
				origin();
			}
		}, { passive: true } );

		// Choosing: remember it, flip the code in the pill, and let the link navigate (never blocked).
		function choose( lang, e ) {
			setCookie( lang );
			if ( lang === cur ) {
				if ( e ) {
					e.preventDefault();
				}
				close( true );
				return;
			}
			if ( e && ( e.metaKey || e.ctrlKey || e.shiftKey || e.altKey || 0 !== e.button ) ) {
				return; // New tab / window: nothing changes here.
			}
			opts.forEach( function ( o ) {
				var on = o.getAttribute( 'data-lang' ) === lang;
				o.classList.toggle( 'is-current', on );
				o.setAttribute( 'aria-checked', on ? 'true' : 'false' );
			} );
			box.classList.add( 'is-switching' );
		}
		opts.forEach( function ( o ) {
			o.addEventListener( 'click', function ( e ) {
				choose( o.getAttribute( 'data-lang' ), e );
			} );
		} );
		// Back/forward cache: undo the flip if the page is shown again.
		window.addEventListener( 'pageshow', function ( e ) {
			if ( e.persisted ) {
				box.classList.remove( 'is-switching', 'is-open', 'is-closing' );
				trigger.setAttribute( 'aria-expanded', 'false' );
				opts.forEach( function ( o ) {
					var on = o.getAttribute( 'data-lang' ) === cur;
					o.classList.toggle( 'is-current', on );
					o.setAttribute( 'aria-checked', on ? 'true' : 'false' );
				} );
			}
		} );
	} )();

	// Reveal on scroll + active section in the nav.
	if ( 'IntersectionObserver' in window ) {
		var io = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( e ) {
				if ( e.isIntersecting ) {
					e.target.classList.add( 'is-in' );
					io.unobserve( e.target );
				}
			} );
		}, { threshold: 0.12 } );
		document.querySelectorAll( '.reveal' ).forEach( function ( el ) {
			io.observe( el );
		} );

		var links = nav ? nav.querySelectorAll( 'a[href*="#"]' ) : [];
		var so = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( e ) {
				if ( ! e.isIntersecting ) {
					return;
				}
				links.forEach( function ( l ) {
					var on = l.hash === '#' + e.target.id;
					var li = l.closest( 'li' );
					if ( li ) {
						li.classList.toggle( 'is-active', on );
					}
					if ( on ) {
						l.setAttribute( 'aria-current', 'true' );
					} else {
						l.removeAttribute( 'aria-current' );
					}
				} );
			} );
		}, { rootMargin: '-45% 0px -50% 0px' } );
		[ 'work', 'approach', 'experience', 'about' ].forEach( function ( id ) {
			var s = document.getElementById( id );
			if ( s ) {
				so.observe( s );
			}
		} );
	} else {
		document.querySelectorAll( '.reveal' ).forEach( function ( el ) {
			el.classList.add( 'is-in' );
		} );
	}
	// Hero title "magnet": letters get heavier near the cursor; a slow weight wave when idle.
	( function () {
		var h = document.querySelector( '.hero-title' );
		if ( ! h || ! window.requestAnimationFrame || window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
			return;
		}
		var slot = h.querySelector( '.slot' );
		if ( ! h.hasAttribute( 'aria-label' ) ) {
			h.setAttribute( 'aria-label', h.textContent.replace( /\s+/g, ' ' ).trim() );
		}
		( function walk( node ) {
			[].slice.call( node.childNodes ).forEach( function ( n ) {
				if ( 1 === n.nodeType ) {
					if ( n !== slot ) {
						walk( n );
					}
					return;
				}
				if ( 3 !== n.nodeType ) {
					return;
				}
				var frag = document.createDocumentFragment();
				n.textContent.split( /(\s+)/ ).forEach( function ( tok ) {
					if ( ! tok ) {
						return;
					}
					if ( /^\s+$/.test( tok ) ) {
						frag.appendChild( document.createTextNode( ' ' ) );
						return;
					}
					var w = document.createElement( 'span' );
					w.className = 'w';
					w.setAttribute( 'aria-hidden', 'true' );
					Array.from( tok ).forEach( function ( ch ) {
						var l = document.createElement( 'span' );
						l.className = 'l';
						l.textContent = ch;
						w.appendChild( l );
					} );
					frag.appendChild( w );
				} );
				n.parentNode.replaceChild( frag, n );
			} );
		} )( h );

		var letters = [].slice.call( h.querySelectorAll( '.l' ) );
		var words = [].slice.call( h.querySelectorAll( '.w' ) );
		var slotItems = slot ? [].slice.call( slot.querySelectorAll( '.slot-item' ) ) : [];
		var slotIdx = 0;
		if ( slot ) {
			words = [].slice.call( h.querySelectorAll( '.w, .slot' ) );
		}
		function slotWidth( i ) {
			return slotItems[ i ].offsetWidth;
		}
		function setSlot( i ) {
			slot.style.width = slotWidth( i ) + 'px';
		}
		var centers = [];
		var pointer = null;
		var visible = true;
		var t0 = performance.now();
		var near = false;
		var rafOn = false;
		var WAVE_MS = 6000;

		// Lock line breaks at the base weight so heavier letters never re-wrap the title.
		function layout() {
			h.classList.remove( 'is-magnet' );
			[].slice.call( h.querySelectorAll( 'br.mb' ) ).forEach( function ( b ) {
				b.remove();
			} );
			letters.forEach( function ( l ) {
				l.style.removeProperty( '--w' );
			} );
			if ( slot ) {
				slot.style.transition = 'none';
				slot.style.width = Math.max.apply( null, slotItems.map( function ( x, i ) {
					return slotWidth( i );
				} ) ) + 'px';
			}
			var fs = parseFloat( getComputedStyle( h ).fontSize ) || 60;
			var prev = null;
			words.forEach( function ( w ) {
				var r = w.getBoundingClientRect();
				var c = r.top + r.height / 2;
				if ( null !== prev && c > prev + fs * 0.5 ) {
					var br = document.createElement( 'br' );
					br.className = 'mb';
					w.parentNode.insertBefore( br, w );
				}
				prev = c;
			} );
			h.classList.add( 'is-magnet' );
			if ( slot ) {
				setSlot( slotIdx );
				void slot.offsetWidth;
				slot.style.transition = '';
			}
			measure();
		}
		function rotate() {
			if ( ! visible || document.hidden ) {
				return;
			}
			var out = slotItems[ slotIdx ];
			slotIdx = ( slotIdx + 1 ) % slotItems.length;
			var inn = slotItems[ slotIdx ];
			inn.classList.add( 'no-tr' );
			inn.classList.remove( 'is-out', 'is-on' );
			void inn.offsetWidth;
			inn.classList.remove( 'no-tr' );
			out.classList.remove( 'is-on' );
			out.classList.add( 'is-out' );
			inn.classList.add( 'is-on' );
			setSlot( slotIdx );
		}
		function measure() {
			centers = letters.map( function ( l ) {
				var r = l.getBoundingClientRect();
				return [ r.left + r.width / 2 + window.scrollX, r.top + r.height / 2 + window.scrollY ];
			} );
		}
		function rest() {
			letters.forEach( function ( l ) {
				l.style.setProperty( '--w', '500' );
			} );
		}
		// The loop only runs during the opening wave (6 s) and while the pointer is near the title.
		function frame( now ) {
			var waving = now - t0 < WAVE_MS;
			var hot = pointer && now - pointer.t < 2500;
			if ( ! visible || ( ! waving && ! hot ) ) {
				rafOn = false;
				rest();
				return;
			}
			var r = h.getBoundingClientRect();
			var px, py, rad;
			if ( hot ) {
				px = pointer.x + window.scrollX;
				py = pointer.y + window.scrollY;
				rad = 190;
			} else {
				var ph = ( ( now - t0 ) / 5200 ) % 1;
				px = r.left + window.scrollX - 200 + ph * ( r.width + 400 );
				py = r.top + window.scrollY + r.height / 2;
				rad = 260;
			}
			for ( var i = 0; i < letters.length; i++ ) {
				var dx = centers[ i ][ 0 ] - px;
				var dy = ( centers[ i ][ 1 ] - py ) * 1.4;
				var f = Math.max( 0, 1 - Math.sqrt( dx * dx + dy * dy ) / rad );
				f = f * f * ( 3 - 2 * f );
				letters[ i ].style.setProperty( '--w', Math.round( 480 + 320 * f ) );
			}
			requestAnimationFrame( frame );
		}
		function wake() {
			if ( ! rafOn ) {
				rafOn = true;
				requestAnimationFrame( frame );
			}
		}

		var hero = h.closest( 'section' ) || h;
		hero.addEventListener( 'pointermove', function ( e ) {
			if ( 'mouse' !== e.pointerType && 'pen' !== e.pointerType ) {
				return;
			}
			var r = h.getBoundingClientRect();
			near = e.clientX > r.left - 160 && e.clientX < r.right + 160 && e.clientY > r.top - 160 && e.clientY < r.bottom + 160;
			if ( near ) {
				pointer = { x: e.clientX, y: e.clientY, t: performance.now() };
				wake();
			} else {
				pointer = null;
			}
		}, { passive: true } );
		hero.addEventListener( 'pointerleave', function () {
			pointer = null;
			near = false;
		} );
		if ( 'IntersectionObserver' in window ) {
			new IntersectionObserver( function ( es ) {
				visible = es[ 0 ].isIntersecting;
			} ).observe( h );
		}
		var rt;
		var lastW = window.innerWidth;
		var lastFs = getComputedStyle( h ).fontSize;
		window.addEventListener( 'resize', function () {
			// The title reflows only with width or its (svh-based) font size; iOS toolbar show/hide changes
			// neither, so skip the re-layout then.
			var fs = getComputedStyle( h ).fontSize;
			if ( window.innerWidth === lastW && fs === lastFs ) {
				return;
			}
			lastW = window.innerWidth;
			lastFs = fs;
			clearTimeout( rt );
			rt = setTimeout( layout, 150 );
		} );
		( document.fonts && document.fonts.ready ? document.fonts.ready : Promise.resolve() ).then( function () {
			layout();
			t0 = performance.now();
			wake();
			if ( slot && slotItems.length > 1 ) {
				setInterval( rotate, 2400 );
			}
		} );
	} )();
	/* ---- easter egg: a three-reel slot machine on the footer's last line ----
	   Tap / Enter spins it; so does pulling past the very end (wheel or touch). Every 3rd spin is a jackpot. */
	( function () {
		var box = document.querySelector( '.footer-slot' );
		if ( ! box ) {
			return;
		}
		var btn = box.querySelector( '.fs-machine' );
		var line = box.querySelector( '.fs-line' );
		var win = box.querySelector( '.fs-win' );
		var strips = [].slice.call( box.querySelectorAll( '.fs-strip' ) );
		var reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' );
		var N = 5; // 7 · coffee · 3 · ✦ · 1, repeated three times per strip
		var JACKS = [ 0, 1 ]; // 7-7-7 or coffee-coffee-coffee, alternating
		var LINES = PT ? [ 'Quase. Puxa de novo.', 'Dois de três. Mais uma?', 'Os rolos estão esquentando.', 'Por pouco. Só mais uma.', 'Sorte em lazy loading. De novo?' ] : [ 'So close. Pull again.', 'Two out of three. Again?', 'The reels are warming up.', 'Almost. One more pull.', 'Luck loads lazily. Again?' ];
		var pulls = 0, spinning = false, pos = [ 0, 1, 2 ];
		function place( st, i, dur ) {
			st.classList.toggle( 'no-tr', ! dur );
			st.style.setProperty( '--d', dur + 'ms' );
			st.style.setProperty( '--i', String( i ) );
		}
		strips.forEach( function ( st, k ) {
			place( st, pos[ k ], 0 );
		} );
		function outcome( jackpot ) {
			if ( jackpot ) {
				var j = JACKS[ ( pulls / 3 - 1 ) % JACKS.length ];
				return [ j, j, j ];
			}
			var r = [ 0, 0, 0 ].map( function () {
				return Math.floor( Math.random() * N );
			} );
			if ( r[ 0 ] === r[ 1 ] && r[ 1 ] === r[ 2 ] ) {
				r[ 2 ] = ( r[ 2 ] + 1 ) % N;
			}
			return r;
		}
		function spin() {
			if ( spinning ) {
				return;
			}
			spinning = true;
			pulls++;
			var jackpot = 0 === pulls % 3;
			var res = outcome( jackpot );
			var still = reduce.matches;
			box.classList.remove( 'is-jackpot' );
			box.classList.add( 'is-spinning' );
			win.setAttribute( 'tabindex', '-1' );
			win.setAttribute( 'aria-hidden', 'true' );
			strips.forEach( function ( st, k ) {
				// Jump back to the first cycle, then roll forward into the third (quick: under a second).
				place( st, pos[ k ] % N, 0 );
				void st.offsetWidth;
				pos[ k ] = 2 * N + res[ k ];
				place( st, pos[ k ], still ? 0 : 480 + k * 150 );
			} );
			setTimeout( function () {
				spinning = false;
				box.classList.remove( 'is-spinning' );
				if ( jackpot ) {
					box.classList.add( 'is-jackpot' );
					win.removeAttribute( 'tabindex' );
					win.removeAttribute( 'aria-hidden' );
					line.textContent = t( 'Jackpot. Now hire me.', 'Bingo! Agora me contrata.' );
				} else {
					line.textContent = LINES[ ( pulls - 1 ) % LINES.length ];
				}
			}, still ? 0 : 820 );
		}
		btn.addEventListener( 'click', spin );

		function atEnd() {
			// Lenient (mobile toolbars resize the viewport by a few px while the finger is down).
			var vh = window.visualViewport ? Math.max( window.innerHeight, window.visualViewport.height ) : window.innerHeight;
			return Math.ceil( vh + window.scrollY ) >= root.scrollHeight - 8;
		}
		// Touch: at the very end, every upward drag spins. No re-arming by scrolling away: the only pause is
		// the spin itself (~0.8 s). A long drag can spin again once the reels stop (the start point resets).
		var ty = null;
		window.addEventListener( 'touchstart', function ( e ) {
			ty = e.touches[ 0 ].clientY;
		}, { passive: true } );
		window.addEventListener( 'touchmove', function ( e ) {
			if ( null === ty ) {
				return;
			}
			var y = e.touches[ 0 ].clientY;
			if ( ! atEnd() || y > ty ) {
				ty = y; // not at the end yet, or moving down: measure the pull from here
				return;
			}
			if ( ty - y > 56 && ! spinning ) {
				ty = y;
				spin();
			}
		}, { passive: true } );
		window.addEventListener( 'touchend', function () {
			ty = null;
		}, { passive: true } );
		window.addEventListener( 'touchcancel', function () {
			ty = null;
		}, { passive: true } );
		// Wheel / trackpad at the very bottom: one spin per new gesture (a pause of ~200 ms starts a new one),
		// ignored only while the reels are turning.
		var acc = 0, lastWheel = 0, wheelArmed = true;
		window.addEventListener( 'wheel', function ( e ) {
			var now = performance.now();
			if ( now - lastWheel > 200 ) {
				acc = 0;
				wheelArmed = true;
			}
			lastWheel = now;
			if ( e.deltaY <= 0 || ! atEnd() ) {
				acc = 0;
				return;
			}
			acc += Math.min( Math.abs( e.deltaY ) * ( 1 === e.deltaMode ? 40 : 1 ), 120 );
			if ( acc > 240 && wheelArmed && ! spinning ) {
				wheelArmed = false;
				spin();
			}
		}, { passive: true } );
		window.seraSlotSpin = spin; // handy for testing in the console
	} )();

	/* ---- footer: liquid title on pull ---- */
	( function () {
		var title = document.querySelector( '.footer-title' );
		function atEnd() {
			return window.innerHeight + window.scrollY >= root.scrollHeight - 4;
		}

		var turb = document.querySelector( '#sera-liquid feTurbulence' );
		var disp = document.querySelector( '#sera-liquid feDisplacementMap' );
		if ( ! title || ! turb || ! disp || window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
			return;
		}
		var energy = 0, vel = 0, running = false, t0 = performance.now(), ty = null;
		function push( amount ) {
			vel += amount;
			if ( ! running ) {
				running = true;
				title.classList.add( 'is-liquid' );
				requestAnimationFrame( frame );
			}
		}
		function frame( now ) {
			/* spring back to rest */
			energy += vel;
			vel *= 0.55;
			energy *= 0.945;
			if ( energy > 1 ) { energy = 1; }
			var t = ( now - t0 ) / 1000;
			var e = energy;
			turb.setAttribute( 'baseFrequency', ( 0.0038 + 0.0013 * Math.sin( t * 0.9 ) ).toFixed( 4 ) + ' ' + ( 0.013 + 0.0065 * Math.sin( t * 1.7 ) ).toFixed( 4 ) );
			disp.setAttribute( 'scale', ( e * 88 ).toFixed( 2 ) ); // v3.4: ~25% more warp than before (70)
			title.style.transform = 'perspective(900px) rotateX(' + ( e * 7 ).toFixed( 3 ) + 'deg) scaleY(' + ( 1 + e * 0.0625 ).toFixed( 4 ) + ') skewX(' + ( Math.sin( t * 3.2 ) * e * -2 ).toFixed( 3 ) + 'deg) skewY(' + ( Math.sin( t * 2.1 + 1 ) * e * 0.7 ).toFixed( 3 ) + 'deg)';
			title.style.setProperty( '--pull', e.toFixed( 3 ) );
			if ( e < 0.004 && Math.abs( vel ) < 0.001 ) {
				energy = 0; running = false;
				title.classList.remove( 'is-liquid' );
				title.style.transform = '';
				title.style.removeProperty( '--pull' );
				disp.setAttribute( 'scale', '0' );
				return;
			}
			requestAnimationFrame( frame );
		}
		window.addEventListener( 'wheel', function ( ev ) {
			if ( ev.deltaY > 0 && atEnd() ) {
				push( Math.min( ev.deltaY, 120 ) / 800 );
			}
		}, { passive: true } );
		window.addEventListener( 'touchstart', function ( ev ) {
			ty = atEnd() ? ev.touches[ 0 ].clientY : null;
		}, { passive: true } );
		window.addEventListener( 'touchmove', function ( ev ) {
			if ( null === ty ) { return; }
			var y = ev.touches[ 0 ].clientY, d = ty - y;
			ty = y;
			if ( d > 0 && atEnd() ) {
				push( Math.min( d, 60 ) / 320 );
			}
		}, { passive: true } );
	} )();
} )();

/* Research Hub screens: scale the 1280 px browser frames to the column width. */
( function () {
	var boxes = document.querySelectorAll( '.rh-fit' );
	if ( ! boxes.length || ! ( 'ResizeObserver' in window ) ) {
		return;
	}
	var ro = new ResizeObserver( function ( entries ) {
		entries.forEach( function ( e ) {
			var w = e.contentRect.width;
			e.target.querySelectorAll( '.browser' ).forEach( function ( b ) {
				b.style.setProperty( '--bs', Math.min( 1, w / 1280 ).toFixed( 4 ) );
			} );
		} );
	} );
	boxes.forEach( function ( b ) {
		ro.observe( b );
	} );
}() );


/* Lume screens in code: zoom the 1280 px desktop screens to their card (--lz). */
( function () {
	var boxes = document.querySelectorAll( '.lmx-fit' );
	if ( ! boxes.length || ! ( 'ResizeObserver' in window ) ) {
		return;
	}
	var ro = new ResizeObserver( function ( entries ) {
		entries.forEach( function ( e ) {
			e.target.style.setProperty( '--lz', Math.min( 1, e.contentRect.width / 1280 ).toFixed( 4 ) );
		} );
	} );
	boxes.forEach( function ( b ) {
		ro.observe( b );
	} );
}() );


/* v3.4 · home cards as slides: snap, compact "Selected work" bar with the current case number. */
( function () {
	var bar = document.querySelector( '#work .work-bar' ) || document.querySelector( '.work-bar:not(.xp-bar)' );
	var cards = [].slice.call( document.querySelectorAll( '.cases > .case-card' ) );
	if ( ! bar || cards.length < 2 ) {
		return;
	}
	var root = document.documentElement;
	root.classList.add( 'snap-cards' );
	var head = bar.previousElementSibling;
	var num = bar.querySelector( '.wbar-n b' );
	var prog = bar.querySelector( '.wbar-p' );
	var total = cards.length;
	var current = -1;
	var ticking = false;
	function px( v ) {
		return parseFloat( getComputedStyle( root ).getPropertyValue( v ) ) || 0;
	}
	function update() {
		ticking = false;
		var top = bar.getBoundingClientRect().top; // sticky line under the header
		var wbar = px( '--wbar' ) || 52;
		var headBottom = head ? head.getBoundingClientRect().bottom : 0;
		var last = cards[ total - 1 ].getBoundingClientRect();
		var stuck = top <= px( '--adm' ) + ( px( '--hdr' ) || 80 ) + 1; // in flow (not yet sticking) = still under the heading
		var on = stuck && headBottom < top + 8 && last.bottom > top + wbar + 40;
		bar.classList.toggle( 'is-on', on );
		// current card: the one whose centre is closest to the centre of the visible area
		var mid = ( top + wbar + window.innerHeight ) / 2;
		var best = 0;
		var bestD = Infinity;
		cards.forEach( function ( c, i ) {
			var r = c.getBoundingClientRect();
			var d = Math.abs( ( r.top + r.bottom ) / 2 - mid );
			if ( d < bestD ) {
				bestD = d;
				best = i;
			}
		} );
		if ( best !== current ) {
			current = best;
			cards.forEach( function ( c, i ) {
				c.classList.toggle( 'is-current', i === best );
			} );
			if ( num ) {
				num.textContent = ( best < 9 ? '0' : '' ) + ( best + 1 );
				num.classList.remove( 'is-flip' );
				void num.offsetWidth;
				num.classList.add( 'is-flip' );
			}
			if ( prog ) {
				prog.style.setProperty( '--wp', String( ( best + 1 ) / total ) );
			}
		}
	}
	function queue() {
		if ( ! ticking ) {
			ticking = true;
			window.requestAnimationFrame( update );
		}
	}
	window.addEventListener( 'scroll', queue, { passive: true } );
	window.addEventListener( 'resize', queue );
	update();

	// Touch / no smooth scroller: hard (mandatory) snapping only while you're inside the cards, so each swipe
	// lands on the next case like a card deck; the page scrolls freely everywhere else. The section after the
	// cards is a snap point too, so you can always swipe out.
	var section = bar.closest( 'section' );
	var after = section ? ( section.nextElementSibling || ( section.parentNode && section.parentNode.nextElementSibling ) ) : null;
	if ( after ) {
		after.classList.add( 'after-cards' );
	}
	var hardTick = false;
	var lastHardY = window.scrollY;
	function hard() {
		hardTick = false;
		if ( root.classList.contains( 'has-smooth' ) ) {
			root.classList.remove( 'snap-hard' );
			return;
		}
		var vh = window.innerHeight;
		var first = cards[ 0 ].getBoundingClientRect();
		var last = cards[ total - 1 ].getBoundingClientRect();
		var y = window.scrollY;
		var up = y < lastHardY - 2;
		if ( Math.abs( y - lastHardY ) > 2 ) {
			lastHardY = y;
		}
		// snapping only on the way down; scrolling up stays free
		root.classList.toggle( 'snap-hard', first.top < vh * 0.6 && last.bottom > vh * 0.4 );
	}
	window.addEventListener( 'scroll', function () {
		if ( ! hardTick ) {
			hardTick = true;
			window.requestAnimationFrame( hard );
		}
	}, { passive: true } );
	hard();
} )();


/* v3.4.1 · Hero → Selected work: the hero sits still (sticky, bottom pinned to the viewport bottom) while
   the work section rises over it. CSS does the recede/dim with a view-timeline; browsers without
   scroll-driven animations get --sheet-p (0…1) from here. */
( function () {
	var scope = document.querySelector( '.sheet-scope' );
	var hero = scope && scope.querySelector( '.hero' );
	var sheet = scope && scope.querySelector( '.sheet' );
	if ( ! hero || ! sheet || window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
		return;
	}
	var root = document.documentElement;
	var timeline = window.CSS && CSS.supports && CSS.supports( 'animation-timeline: view()' );
	if ( ! timeline ) {
		root.classList.add( 'sheet-fallback' );
	}
	function hdr() {
		return parseFloat( getComputedStyle( root ).getPropertyValue( '--hdr' ) ) || 80;
	}
	function size() {
		// Sticks once its bottom meets the viewport bottom (or right under the header when it is shorter).
		root.style.setProperty( '--hero-top', Math.round( Math.min( hdr(), window.innerHeight - hero.offsetHeight ) ) + 'px' );
	}
	size();
	window.addEventListener( 'resize', size, { passive: true } );
	window.addEventListener( 'load', size );
	if ( window.ResizeObserver ) {
		new ResizeObserver( size ).observe( hero );
	}
	if ( timeline ) {
		return;
	}
	var ticking = false;
	var last = -1;
	function update() {
		ticking = false;
		var vh = window.innerHeight;
		var p = Math.max( 0, Math.min( 1, ( vh - sheet.getBoundingClientRect().top ) / vh ) );
		p = Math.round( p * 1000 ) / 1000;
		if ( p !== last ) {
			last = p;
			hero.style.setProperty( '--sheet-p', String( p ) );
		}
	}
	window.addEventListener( 'scroll', function () {
		if ( ! ticking ) {
			ticking = true;
			requestAnimationFrame( update );
		}
	}, { passive: true } );
	update();
} )();

/* v3.4.1 · Experience: the same compact bar as Selected work (title, intro, current role, n / total). */
( function () {
	var bar = document.querySelector( '.xp-bar' );
	var rows = bar ? [].slice.call( bar.parentNode.querySelectorAll( '.xp-row' ) ) : [];
	if ( ! bar || rows.length < 2 ) {
		return;
	}
	var head = bar.parentNode.querySelector( '.xp-head' ) || bar.nextElementSibling;
	var cur = bar.querySelector( '.wbar-c' );
	var num = bar.querySelector( '.wbar-n b' );
	var prog = bar.querySelector( '.wbar-p' );
	var total = rows.length;
	var current = -1;
	var ticking = false;
	function flip( el ) {
		el.classList.remove( 'is-flip' );
		void el.offsetWidth;
		el.classList.add( 'is-flip' );
	}
	function update() {
		ticking = false;
		var top = bar.getBoundingClientRect().top;
		var wbar = parseFloat( getComputedStyle( document.documentElement ).getPropertyValue( '--wbar' ) ) || 52;
		var line = top + wbar + ( window.innerHeight - top - wbar ) * 0.3;
		var hr = head ? head.getBoundingClientRect() : { top: 0, height: 1 };
		var lastRow = rows[ total - 1 ].getBoundingClientRect();
		var cs = getComputedStyle( document.documentElement );
		var stuck = top <= ( parseFloat( cs.getPropertyValue( '--adm' ) ) || 0 ) + ( parseFloat( cs.getPropertyValue( '--hdr' ) ) || 80 ) + 1;
		// the big "Experience" title shrinks and fades as it slides under the header, handing over to the fixed bar
		var line0 = ( parseFloat( cs.getPropertyValue( '--adm' ) ) || 0 ) + ( parseFloat( cs.getPropertyValue( '--hdr' ) ) || 80 );
		// the head itself is sticky now: it shrinks over the last 140px before it pins (v3.6.3)
		var p = Math.max( 0, Math.min( 1, ( line0 + 140 - hr.top ) / 140 ) );
		if ( head ) {
			head.style.setProperty( '--xp', p.toFixed( 3 ) );
		}
		// leaving: over the last ~180px of the list the bar eases up and out instead of blinking off
		var out = Math.max( 0, Math.min( 1, ( top + wbar + 180 - lastRow.bottom ) / 180 ) );
		bar.style.setProperty( '--out', out.toFixed( 3 ) );
		bar.classList.toggle( 'is-on', stuck && hr.top < top + wbar * 0.5 && out < 1 );
		var best = 0;
		rows.forEach( function ( r, i ) {
			if ( r.getBoundingClientRect().top <= line ) {
				best = i;
			}
		} );
		if ( best !== current ) {
			current = best;
			if ( cur ) {
				cur.textContent = rows[ best ].getAttribute( 'data-label' ) || '';
				flip( cur );
			}
			if ( num ) {
				num.textContent = ( best < 9 ? '0' : '' ) + ( best + 1 );
				flip( num );
			}
			if ( prog ) {
				prog.style.setProperty( '--wp', String( ( best + 1 ) / total ) );
			}
		}
	}
	function queue() {
		if ( ! ticking ) {
			ticking = true;
			requestAnimationFrame( update );
		}
	}
	window.addEventListener( 'scroll', queue, { passive: true } );
	window.addEventListener( 'resize', queue );
	update();
} )();

/* v3.4.1 · smooth (inertial) wheel scrolling, Lenis-style, no library.
   Mouse wheels and trackpads on fine-pointer devices only: touch, keyboard and scrollbar dragging stay
   native (any scroll we did not make re-syncs the position). The page is moved with window.scrollTo, so
   position:sticky and every scroll listener keep working. Wheels over something that scrolls itself
   (a scrollable panel, a horizontal slider, an open menu or dialog) are left alone. Same-page anchor
   clicks glide. On the home, CSS snap is switched off and the cards snap here instead: once the wheel
   settles inside the cards region, the page eases to the nearest card's centre. */
( function () {
	var root = document.documentElement;
	if ( ! window.requestAnimationFrame || ! window.matchMedia( '(hover: hover) and (pointer: fine)' ).matches || window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
		return;
	}
	root.classList.add( 'has-smooth' );

	var target = window.scrollY;
	var current = target;
	var lastSet = target;
	var raf = 0;
	var lastT = 0;
	var lerp = 0.1;
	var tween = null;
	var snapT = null;
	var lastWheel = 0;
	var padUntil = 0;

	function px( v ) {
		return parseFloat( getComputedStyle( root ).getPropertyValue( v ) ) || 0;
	}
	function maxY() {
		return Math.max( 0, root.scrollHeight - window.innerHeight );
	}
	function clamp( y ) {
		return Math.max( 0, Math.min( maxY(), y ) );
	}
	function ease( k ) {
		return k < 0.5 ? 4 * k * k * k : 1 - Math.pow( -2 * k + 2, 3 ) / 2;
	}
	function frame( now ) {
		var dt = lastT ? Math.min( 64, now - lastT ) : 16.7;
		lastT = now;
		if ( tween ) {
			var k = Math.min( 1, ( now - tween.t0 ) / tween.d );
			current = tween.from + ( tween.to - tween.from ) * ( tween.firm ? 1 - Math.pow( 1 - k, 4 ) : ease( k ) );
			target = current;
			if ( k >= 1 ) {
				tween = null;
			}
		} else {
			target = clamp( target );
			current += ( target - current ) * ( 1 - Math.pow( 1 - lerp, dt / 16.7 ) );
			if ( Math.abs( target - current ) < 0.4 ) {
				current = target;
			}
		}
		lastSet = current;
		window.scrollTo( 0, current );
		if ( tween || current !== target ) {
			raf = requestAnimationFrame( frame );
		} else {
			raf = 0;
			lastT = 0;
		}
	}
	function run() {
		if ( ! raf ) {
			raf = requestAnimationFrame( frame );
		}
	}
	function stop() {
		if ( raf ) {
			cancelAnimationFrame( raf );
		}
		raf = 0;
		lastT = 0;
		tween = null;
		clearTimeout( snapT );
		target = current = lastSet = window.scrollY;
	}
	function glide( y, d ) {
		y = clamp( y );
		if ( ! raf ) {
			current = window.scrollY;
		}
		var dist = Math.abs( y - current );
		if ( dist < 1 ) {
			return;
		}
		tween = { from: current, to: y, t0: performance.now(), d: d || Math.max( 550, Math.min( 1400, 380 + dist * 0.28 ) ) };
		run();
	}

	// Anything that scrolls the page without us (keys, scrollbar, find-in-page, scrollIntoView) wins.
	window.addEventListener( 'scroll', function () {
		if ( Math.abs( window.scrollY - lastSet ) > 3 ) {
			stop();
		}
	}, { passive: true } );
	// only a width change cancels a glide (iOS toolbar show/hide changes just the height)
	var glideW = window.innerWidth;
	window.addEventListener( 'resize', function () {
		if ( window.innerWidth !== glideW ) {
			glideW = window.innerWidth;
			stop();
		}
	}, { passive: true } );
	[ 'keydown', 'mousedown', 'touchstart' ].forEach( function ( ev ) {
		window.addEventListener( ev, function ( e ) {
			// Keyboard scrolling and scrollbar drags are native: hand over immediately.
			var scrollbar = 'mousedown' === ev && e.clientX >= root.clientWidth;
			if ( raf && ( 'touchstart' === ev || scrollbar || ( 'keydown' === ev && /^(Arrow|Page|Home|End| )/.test( e.key ) ) ) ) {
				stop();
			}
		}, { passive: true } );
	} );

	function nativeHere( e, dy ) {
		if ( document.querySelector( 'dialog[open]' ) ) {
			return true;
		}
		for ( var el = e.target; el && 1 === el.nodeType && el !== document.body && el !== root; el = el.parentElement ) {
			if ( el.matches( '[data-native-scroll], .primary-nav.is-open, .lang.is-open' ) ) {
				return true;
			}
			if ( el.scrollHeight > el.clientHeight + 1 ) {
				var oy = getComputedStyle( el ).overflowY;
				if ( 'auto' === oy || 'scroll' === oy || 'overlay' === oy ) {
					if ( ( dy < 0 && el.scrollTop > 0 ) || ( dy > 0 && el.scrollTop + el.clientHeight < el.scrollHeight - 1 ) ) {
						return true;
					}
				}
			}
		}
		return false;
	}

	window.addEventListener( 'wheel', function ( e ) {
		if ( e.defaultPrevented || e.ctrlKey || e.shiftKey ) {
			return; // pinch-zoom / horizontal intent
		}
		if ( root.classList.contains( 'deck-on' ) ) {
			if ( raf ) {
				stop();
			}
			return; // the case deck uses native scroll + CSS snap (instant, like the mockup sliders)
		}
		var dy = e.deltaY;
		if ( Math.abs( e.deltaX ) > Math.abs( dy ) ) {
			return; // sideways: sliders and rows scroll natively
		}
		if ( 1 === e.deltaMode ) {
			dy *= 40;
		} else if ( 2 === e.deltaMode ) {
			dy *= window.innerHeight;
		}
		if ( ! dy || nativeHere( e, dy ) ) {
			return;
		}
		e.preventDefault();
		var now = performance.now();
		// Trackpads (small or fractional pixel deltas, dense streams) already carry momentum: follow them
		// closely so it never feels laggy. Notched wheels get the long, soft glide.
		if ( 0 === e.deltaMode && ( dy % 1 !== 0 || Math.abs( dy ) < 40 ) ) {
			padUntil = now + 300;
		}
		lastDir = dy > 0 ? 1 : -1;
		if ( stepCards( dy, now ) ) {
			return;
		}
		lerp = now < padUntil ? 0.3 : 0.14;
		if ( ! raf ) {
			target = current = window.scrollY;
		}
		if ( tween ) {
			target = current;
			tween = null;
		}
		target = clamp( target + dy );
		lastWheel = now;
		run();
		clearTimeout( snapT );
		snapT = setTimeout( snap, 120 );
	}, { passive: false } );


	// Home cards: inside the cards region each wheel / trackpad gesture moves exactly one card, with a short,
	// firm ease-out (no soft drift). Momentum tails are swallowed until the gesture goes quiet.
	var stepLock = 0;
	var stepDir = 0;
	var stepStart = 0;
	var lastDir = 1;
	function cardCentres() {
		var cards = document.querySelectorAll( '.cases > .case-card' );
		var top = px( '--adm' ) + ( px( '--hdr' ) || 80 );
		var mid = ( top + ( px( '--wbar' ) || 52 ) + window.innerHeight ) / 2;
		var base = raf ? current : window.scrollY;
		return [].map.call( cards, function ( c ) {
			// layout position (offsetTop chain), so the scroll-driven card animation's translate/scale can't skew it
			var y = 0;
			for ( var el = c; el; el = el.offsetParent ) {
				y += el.offsetTop;
			}
			return y + c.offsetHeight / 2 - mid;
		} );
	}
	function stepCards( dy, now ) {
		if ( ! root.classList.contains( 'snap-cards' ) ) {
			return false;
		}
		var dirNow = dy > 0 ? 1 : -1;
		if ( now < stepLock && dirNow === stepDir ) {
			// same gesture (trackpad momentum): swallow it, but never longer than ~0.6s after the step
			stepLock = Math.min( now + 140, stepStart + 1000 );
			return true;
		}
		var ys = cardCentres();
		if ( ys.length < 2 ) {
			return false;
		}
		var pos = tween ? tween.to : ( raf ? target : window.scrollY );
		var near = -1;
		ys.forEach( function ( y, i ) {
			if ( Math.abs( y - pos ) < window.innerHeight * 0.45 && ( near < 0 || Math.abs( y - pos ) < Math.abs( ys[ near ] - pos ) ) ) {
				near = i;
			}
		} );
		if ( near < 0 ) {
			return false;
		}
		var dir = dy > 0 ? 1 : -1;
		var next = Math.abs( ys[ near ] - pos ) > 6 && ( ys[ near ] - pos ) * dir > 0 ? near : near + dir;
		if ( next < 0 || next >= ys.length ) {
			return false; // leaving the cards: normal scrolling takes over
		}
		clearTimeout( snapT );
		glide( ys[ next ], 250 );
		if ( tween ) {
			tween.firm = true;
		}
		stepDir = dir;
		stepStart = now;
		stepLock = now + 330;
		lastWheel = now;
		return true;
	}

	// Home cards: settle on the nearest card (centre of the area under header + work bar, as in v3.4).
	function snap() {
		if ( tween || ! root.classList.contains( 'snap-cards' ) ) {
			return;
		}
		if ( performance.now() - lastWheel < 170 ) {
			snapT = setTimeout( snap, 90 );
			return;
		}
		var cards = document.querySelectorAll( '.cases > .case-card' );
		if ( ! cards.length ) {
			return;
		}
		var shift = target - window.scrollY; // where the page is heading, not where it is
		var top = px( '--adm' ) + ( px( '--hdr' ) || 80 );
		var mid = ( top + ( px( '--wbar' ) || 52 ) + window.innerHeight ) / 2;
		var best = null;
		[].forEach.call( cards, function ( c ) {
			var r = c.getBoundingClientRect();
			var d = ( r.top + r.bottom ) / 2 - shift - mid;
			if ( null === best || Math.abs( d ) < Math.abs( best ) ) {
				best = d;
			}
		} );
		if ( null === best || Math.abs( best ) < 2 || Math.abs( best ) > window.innerHeight * 0.42 ) {
			return;
		}
		glide( target + best, 420 );
		if ( tween ) {
			tween.firm = true;
		}
	}

	// Same-page anchors (#work, #contact, #top…) glide; keyboard activation stays native (focus moves too).
	document.addEventListener( 'click', function ( e ) {
		if ( e.defaultPrevented || 0 !== e.button || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey || 0 === e.detail ) {
			return;
		}
		var a = e.target.closest && e.target.closest( 'a[href*="#"]' );
		if ( ! a || a.target || a.closest( '.lang' ) || a.href.split( '#' )[ 0 ] !== location.href.split( '#' )[ 0 ] ) {
			return;
		}
		var id = decodeURIComponent( a.hash.slice( 1 ) );
		var el = id ? document.getElementById( id ) : null;
		if ( ! id || ( ! el && 'top' !== id ) ) {
			return;
		}
		e.preventDefault();
		if ( 'top' === id ) {
			// back to top: vista aérea (v2.js); native smooth scroll when it does not run
			stop();
			if ( ! ( window.V2 && window.V2.flyTop && window.V2.flyTop() ) ) {
				window.scrollTo( { top: 0, behavior: window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ? 'auto' : 'smooth' } );
			}
			if ( history.pushState ) {
				history.pushState( null, '', '#top' );
			}
			return;
		}
		var pad = parseFloat( getComputedStyle( root ).scrollPaddingTop ) || ( px( '--adm' ) + ( px( '--hdr' ) || 80 ) );
		var y = ( 'top' === id || ( el && el.classList.contains( 'site-header' ) ) ) ? 0 : el.getBoundingClientRect().top + window.scrollY - pad;
		glide( y );
		if ( history.pushState ) {
			history.pushState( null, '', '#' + id );
		}
	} );

	window.seraSmooth = { glide: glide, stop: stop };
} )();

/* v3.6 · Selected work deck: sticky cards; the card being covered eases back (--cover 0→1),
   the slim pinned head shows the current case number and a progress line. Native scroll only. */
( function () {
	var head = document.querySelector( '.work-head' );
	var cards = [].slice.call( document.querySelectorAll( '.cases > .case-card' ) );
	if ( ! head || ! cards.length ) {
		return;
	}
	var num = head.querySelector( '.wh-n b' );
	var prog = head.querySelector( '.wh-p' );
	var total = cards.length;
	var current = -1;
	var ticking = false;
	var reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	function update() {
		ticking = false;
		var stick = parseFloat( getComputedStyle( cards[ 0 ] ).top ) || 0;
		var rects = cards.map( function ( c ) {
			return c.getBoundingClientRect();
		} );
		var best = 0;
		rects.forEach( function ( r, i ) {
			if ( r.top <= stick + r.height * 0.5 ) {
				best = i;
			}
			if ( ! reduce ) {
				var next = rects[ i + 1 ];
				var cover = next ? Math.max( 0, Math.min( 1, 1 - ( next.top - stick ) / r.height ) ) : 0;
				cards[ i ].style.setProperty( '--cover', cover.toFixed( 3 ) );
			}
		} );
		var hr = head.getBoundingClientRect();
		head.classList.toggle( 'is-stuck', hr.top <= stick - head.offsetHeight - 13 && rects[ total - 1 ].bottom > hr.bottom );
		if ( best !== current ) {
			current = best;
			if ( num ) {
				num.textContent = ( best < 9 ? '0' : '' ) + ( best + 1 );
				num.classList.remove( 'is-flip' );
				void num.offsetWidth;
				num.classList.add( 'is-flip' );
			}
			if ( prog ) {
				prog.style.setProperty( '--wp', String( ( best + 1 ) / total ) );
			}
		}
	}
	function queue() {
		if ( ! ticking ) {
			ticking = true;
			window.requestAnimationFrame( update );
		}
	}
	window.addEventListener( 'scroll', queue, { passive: true } );
	window.addEventListener( 'resize', queue );
	update();
} )();

/* (v3.6.4: desktop wheel/trackpad only — touch uses the native CSS snap points at the end) */
/* v3.6.1 · Deck settling: one gesture = one card. When scrolling stops between two cards, the page
   finishes the move in the direction you were going (or falls back if you barely moved), so a card is
   always fully in place to read. Leaving the deck (past the last card or above the first) is free. */
( function () {
	var cases = document.querySelector( '.cases' );
	var cards = cases ? [].slice.call( cases.querySelectorAll( ':scope > .case-card' ) ) : [];
	if ( cards.length < 2 || ! document.querySelector( '.work-head' ) ) {
		return;
	}
	var root = document.documentElement;
	var lastY = window.scrollY;
	var dir = 1;
	var timer = 0;
	var settling = false;
	var settleUntil = 0;
	function rests() {
		var stick = parseFloat( getComputedStyle( cards[ 0 ] ).top ) || 0;
		var y = 0;
		for ( var el = cases; el; el = el.offsetParent ) {
			y += el.offsetTop;
		}
		var step = cards[ 0 ].offsetHeight + ( parseFloat( getComputedStyle( cards[ 0 ] ).marginBottom ) || 0 );
		return cards.map( function ( c, i ) {
			return Math.round( y + i * step - stick );
		} );
	}
	function go( y ) {
		settling = true;
		settleUntil = performance.now() + 700;
		if ( root.classList.contains( 'has-smooth' ) && window.seraSmooth && window.seraSmooth.glide ) {
			window.seraSmooth.glide( y, 260 );
		} else {
			window.scrollTo( { top: y, behavior: 'smooth' } );
		}
	}
	function settle() {
		timer = 0;
		if ( settling || ! root.classList.contains( 'has-smooth' ) ) {
			return;
		}
		var y = window.scrollY;
		var r = rests();
		var step = r[ 1 ] - r[ 0 ];
		if ( y < r[ 0 ] - step * 0.35 || y > r[ r.length - 1 ] + 2 ) {
			return; // outside the deck: free scrolling
		}
		if ( y <= r[ 0 ] ) {
			if ( r[ 0 ] - y > 2 && dir > 0 ) {
				go( r[ 0 ] );
			}
			return;
		}
		var i = Math.min( r.length - 2, Math.floor( ( y - r[ 0 ] ) / step ) );
		var t = ( y - r[ i ] ) / step; // 0 = card i in place, 1 = card i+1 in place
		if ( t < 0.01 || t > 0.99 ) {
			return;
		}
		var target = dir > 0 ? ( t > 0.08 ? r[ i + 1 ] : r[ i ] ) : ( t < 0.92 ? r[ i ] : r[ i + 1 ] );
		go( target );
	}
	function arm() {
		clearTimeout( timer );
		// with the inertial wheel scroller every frame is its own tiny scroll (and fires scrollend), so wait for quiet
		timer = setTimeout( settle, root.classList.contains( 'has-smooth' ) ? 90 : ( 'onscrollend' in window ? 200 : 120 ) );
	}
	var firstSince = 0;
	window.addEventListener( 'scroll', function () {
		var y = window.scrollY;
		var r0 = rests()[ 0 ];
		if ( Math.abs( y - r0 ) < 4 ) {
			firstSince = firstSince || performance.now();
		} else {
			firstSince = 0;
		}
		if ( settling && performance.now() > settleUntil ) {
			settling = false;
		}
		if ( ! settling && Math.abs( y - lastY ) > 0.5 ) {
			dir = y > lastY ? 1 : -1;
		}
		lastY = y;
		if ( ! settling ) {
			arm();
		}
	}, { passive: true } );
	// Instant flips: the first wheel tick / a short swipe already moves to the next card (no waiting for
	// the scroll to settle). Momentum from the same gesture is swallowed for a moment.
	function deckIndex( y, r ) {
		var step = r[ 1 ] - r[ 0 ];
		if ( y < r[ 0 ] - 2 || y > r[ r.length - 1 ] + 2 ) {
			return null;
		}
		return Math.max( 0, Math.min( r.length - 1, ( y - r[ 0 ] ) / step ) );
	}
	function flip( d ) {
		var r = rests();
		var y = settling && window.seraSmooth ? lastTarget : window.scrollY;
		var f = deckIndex( y, r );
		if ( null === f ) {
			return false;
		}
		// first card holds a beat (~0.7s) before the next flip, so a fast scroll doesn't fly past it
		if ( d > 0 && f < 0.05 && ( ! firstSince || performance.now() - firstSince < 700 ) ) {
			return true;
		}
		var to = d > 0 ? Math.floor( f + 0.02 ) + 1 : Math.ceil( f - 0.02 ) - 1;
		if ( to < 0 || to >= r.length ) {
			return false; // first card going up / last card going down: leave the deck freely
		}
		lastTarget = r[ to ];
		dir = d;
		go( r[ to ] );
		return true;
	}
	var lastTarget = 0;
	var lastAbs = 0;
	var lockUntil = 0;
	var lockStart = 0;
	var lockDir = 0;
	document.addEventListener( 'wheel', function ( e ) {
		if ( ! root.classList.contains( 'has-smooth' ) || e.ctrlKey || Math.abs( e.deltaX ) > Math.abs( e.deltaY ) || ! e.deltaY ) {
			return;
		}
		var d = e.deltaY > 0 ? 1 : -1;
		var now = performance.now();
		var ad = Math.abs( e.deltaY ) * ( 1 === e.deltaMode ? 40 : 1 );
		// a new swipe during the momentum tail of the previous one shows up as a jump in |delta|
		var fresh = ad > lastAbs * 1.8 + 6 && now - lockStart > 180;
		lastAbs = ad;
		if ( now < lockUntil && d === lockDir && ! fresh ) {
			lockUntil = Math.min( now + 120, lockStart + 1300 );
			e.preventDefault();
			e.stopImmediatePropagation();
			return;
		}
		if ( flip( d ) ) {
			lockDir = d;
			lockStart = now;
			lockUntil = now + 300;
			e.preventDefault();
			e.stopImmediatePropagation();
		}
	}, { capture: true, passive: false } );
	var ty0 = null;
	var tyT = 0;
	window.addEventListener( 'touchstart', function ( e ) {
		ty0 = e.touches.length === 1 ? e.touches[ 0 ].clientY : null;
		tyT = performance.now();
	}, { passive: true } );
	window.addEventListener( 'touchend', function ( e ) {
		if ( null === ty0 || ! e.changedTouches.length ) {
			return;
		}
		var dy = ty0 - e.changedTouches[ 0 ].clientY;
		ty0 = null;
		void dy; // touch: native CSS snap handles it (v3.6.4)
	}, { passive: true } );

	if ( 'onscrollend' in window ) {
		window.addEventListener( 'scrollend', function () {
			if ( root.classList.contains( 'has-smooth' ) ) {
				return;
			}
			if ( settling ) {
				settling = false;
				return;
			}
			clearTimeout( timer );
			timer = setTimeout( settle, 40 );
		} );
	}
} )();

/* v3.6.4 · Case deck = native vertical snap, exactly like the iPhone sliders inside the cases:
   one zero-height snap point per card rest position (scroll-margin = sticky top), mandatory snapping
   only while you're inside the deck, so a single swipe / wheel tick lands on the next card instantly
   and the rest of the page scrolls freely. */
( function () {
	var cases = document.querySelector( '.cases' );
	var cards = cases ? [].slice.call( cases.querySelectorAll( ':scope > .case-card' ) ) : [];
	if ( cards.length < 2 || ! document.querySelector( '.work-head' ) ) {
		return;
	}
	var root = document.documentElement;
	var marks = cards.map( function ( c, i ) {
		var m = document.createElement( 'span' );
		m.className = 'deck-snap';
		m.setAttribute( 'aria-hidden', 'true' );
		m.style.setProperty( '--i', String( i ) );
		cases.appendChild( m );
		return m;
	} );
	// exits: the work section above and the next section below are snap points too (only while deck-on)
	var work = cases.closest( 'section' );
	var next = work ? ( work.nextElementSibling || ( work.parentNode && work.parentNode.nextElementSibling ) ) : null;
	if ( work ) {
		work.classList.add( 'deck-before' );
	}
	if ( next ) {
		next.classList.add( 'deck-after' );
	}
	var ticking = false;
	function update() {
		ticking = false;
		var vh = window.innerHeight;
		var a = marks[ 0 ].getBoundingClientRect().top;
		var b = marks[ marks.length - 1 ].getBoundingClientRect().top;
		var stick = parseFloat( getComputedStyle( cards[ 0 ] ).top ) || 0;
		// on between "first card almost in place" and "last card in place"
		// mandatory snapping only once the first card has reached its place (and until the last one leaves),
		// so scrolling up from the first card is always free (v3.7.5)
		void vh;
		root.classList.toggle( 'deck-on', ! root.classList.contains( 'has-smooth' ) && a <= stick + 6 && b > stick - 4 );
	}
	function queue() {
		if ( ! ticking ) {
			ticking = true;
			window.requestAnimationFrame( update );
		}
	}
	window.addEventListener( 'scroll', queue, { passive: true } );
	window.addEventListener( 'resize', queue );
	update();
} )();

/* v3.6.6 · About list on touch / narrow screens: show each line's polaroid while it crosses the middle
   of the screen (there's no hover there). */
( function () {
	var items = [].slice.call( document.querySelectorAll( '.about-list li' ) );
	if ( ! items.length || ! window.IntersectionObserver ) {
		return;
	}
	var mq = window.matchMedia( '(max-width: 1080px), (hover: none)' );
	var io = new IntersectionObserver( function ( entries ) {
		if ( ! mq.matches ) {
			return;
		}
		entries.forEach( function ( e ) {
			e.target.classList.toggle( 'is-seen', e.isIntersecting );
		} );
	}, { rootMargin: '-38% 0px -38% 0px' } );
	items.forEach( function ( li ) {
		if ( li.querySelector( '.about-pop' ) ) {
			io.observe( li );
		}
	} );
} )();

/* v3.13 · Home cards: lay out the screens by the real size of the card, with margins and whitespace.
   Phones never cut at the sides; when they bleed, the cut falls on the straight part, never on a corner. */
( function () {
	var vis = document.querySelectorAll( '.case-card .case-visual' );
	if ( ! vis.length || ! ( 'ResizeObserver' in window ) ) {
		return;
	}
	var PW = 417, PH = 876, R = 70;
	function place( el, x, y ) {
		el.style.left = Math.round( x ) + 'px';
		el.style.top = Math.round( y ) + 'px';
	}
	// Keep a bleeding phone's cut away from its rounded corner: fully in, or cut at least 1.6 radii up.
	function safeTop( top, s, H, m ) {
		var h = PH * s, over = top + h - H;
		if ( over <= 0 ) {
			return top;
		}
		if ( over < R * s * 1.6 ) {
			return h + m <= H - top ? top : top + ( R * s * 1.6 - over );
		}
		return top;
	}
	function layout( v ) {
		var st = v.querySelector( '.mockup-stage' );
		if ( ! st ) {
			return;
		}
		var W = v.clientWidth, H = v.clientHeight;
		if ( ! W || ! H ) {
			return;
		}
		v.classList.add( 'cv-fit' );
		var m = Math.max( 24, W * 0.075 );
		var chip = st.querySelector( '.brand-chip' );
		var top = ( chip ? chip.offsetTop + chip.offsetHeight : 56 ) + Math.max( 28, H * 0.05 );
		var browser = st.querySelector( '.browser' );
		var phones = st.querySelectorAll( '.device' );
		if ( browser ) {
			var phone = phones[0];
			var aw = W - 2 * m;
			var bs = Math.min( 0.5, ( aw * 0.84 ) / 1280 );
			browser.style.setProperty( '--bs', bs.toFixed( 4 ) );
			var bh = browser.offsetHeight;
			var s = phone ? Math.min( 0.5, ( aw * 0.3 ) / PW ) : 0;
			var pOff = bh * 0.3;
			// Centre the browser + phone group in the space under the chip when it fits.
			var groupH = Math.max( bh, pOff + PH * s );
			var free2 = H - top - m - groupH;
			var y0 = free2 > 0 ? top + free2 / 2 : top;
			place( browser, m, y0 );
			if ( phone ) {
				phone.style.setProperty( '--s', s.toFixed( 4 ) );
				place( phone, W - m - PW * s, safeTop( y0 + pOff, s, H, m ) );
			}
			return;
		}
		if ( phones.length >= 2 ) {
			var g = Math.max( 16, W * 0.045 );
			var s2 = Math.min( 0.62, ( W - 2 * m - g ) / ( 2 * PW ) );
			var pw = PW * s2, left = ( W - 2 * pw - g ) / 2;
			var lift = PH * s2 * 0.06;
			// Room to show both phones whole? Centre them in the space under the chip; otherwise bleed off the bottom.
			var free = H - top - m - PH * s2 - lift;
			var y = free > 0 ? top + free / 2 : top;
			phones.forEach( function ( p, i ) {
				p.style.setProperty( '--s', s2.toFixed( 4 ) );
				var yy = i === 0 ? y + lift : y;
				place( p, left + i * ( pw + g ), safeTop( yy, s2, H, m ) );
			} );
		} else if ( phones.length === 1 ) {
			var s1 = Math.min( 0.62, ( W - 2 * m ) / PW, ( H - top ) / ( PH * 0.7 ) );
			phones[0].style.setProperty( '--s', s1.toFixed( 4 ) );
			place( phones[0], ( W - PW * s1 ) / 2, safeTop( top, s1, H, m ) );
		}
	}
	var ro = new ResizeObserver( function ( entries ) {
		entries.forEach( function ( e ) {
			layout( e.target );
		} );
	} );
	vis.forEach( function ( v ) {
		ro.observe( v );
	} );
}() );

/* Back to top everywhere (touch devices skip the smooth-scroll module above). The #top target is the
   sticky header, so the native anchor jump does nothing; scroll to 0 instead. */
( function () {
	document.addEventListener( 'click', function ( e ) {
		var a = e.target.closest && e.target.closest( 'a[href="#top"]' );
		if ( ! a || e.defaultPrevented ) {
			return;
		}
		e.preventDefault();
		// 3.32 · vista aérea (v2.js); short trips and reduced motion keep the plain scroll
		if ( window.V2 && window.V2.flyTop && window.V2.flyTop() ) {
			return;
		}
		window.scrollTo( { top: 0, behavior: window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ? 'auto' : 'smooth' } );
	} );
} )();
