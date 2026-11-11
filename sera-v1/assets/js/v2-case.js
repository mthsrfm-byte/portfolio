/* Sera v2 · case study layer (all case pages). Progressive enhancement only:
   every hidden initial state lives under classes this file adds once it is running (html.cv2…).
   Paperplane (body.is-pp) has its own template and is left alone. */
( function () {
	'use strict';
	var doc = document.documentElement;
	var body = document.body;
	var content = document.querySelector( '.case-content' );
	var hero = document.querySelector( '.case-hero' );
	if ( ! content || ! hero || ! body || body.classList.contains( 'is-pp' ) ) {
		return;
	}
	var reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var hasIO = 'IntersectionObserver' in window;
	var PT = body.classList.contains( 'lang-pt' ) || ( doc.lang || '' ).indexOf( 'pt' ) === 0;
	var L = PT ? { chapters: 'Capítulos', current: 'Capítulo atual' } : { chapters: 'Chapters', current: 'Current chapter' };
	var slice = function ( l ) {
		return [].slice.call( l );
	};
	var clamp = function ( v, a, b ) {
		return Math.max( a, Math.min( b, v ) );
	};
	doc.classList.add( 'cv2' );

	/* ---------- case accent: each case's own brand colour (the theme's --ca on its artifacts) ----------
	   --case-accent  fill colour (the brand itself)
	   --case-on      text/icon colour on the fill (white on pinks and darks, ink on light accents)
	   --case-mark    the accent darkened until it reads as a small mark on paper (≥ 3:1)
	   --case-text    the accent darkened until it passes as small text on paper (≥ 4.5:1) */
	function parseColor( s ) {
		s = ( s || '' ).trim();
		var m = /^#([0-9a-f]{3}|[0-9a-f]{6})$/i.exec( s );
		if ( m ) {
			var h = m[ 1 ].length === 3 ? m[ 1 ].replace( /./g, '$&$&' ) : m[ 1 ];
			return [ parseInt( h.slice( 0, 2 ), 16 ), parseInt( h.slice( 2, 4 ), 16 ), parseInt( h.slice( 4, 6 ), 16 ) ];
		}
		m = /rgba?\(\s*(\d+)[ ,]+(\d+)[ ,]+(\d+)/i.exec( s );
		return m ? [ +m[ 1 ], +m[ 2 ], +m[ 3 ] ] : null;
	}
	function lum( c ) {
		var a = c.map( function ( v ) {
			v /= 255;
			return v <= 0.03928 ? v / 12.92 : Math.pow( ( v + 0.055 ) / 1.055, 2.4 );
		} );
		return 0.2126 * a[ 0 ] + 0.7152 * a[ 1 ] + 0.0722 * a[ 2 ];
	}
	function contrast( a, b ) {
		var x = lum( a );
		var y = lum( b );
		return ( Math.max( x, y ) + 0.05 ) / ( Math.min( x, y ) + 0.05 );
	}
	function hex( c ) {
		return '#' + c.map( function ( v ) {
			return ( '0' + Math.round( v ).toString( 16 ) ).slice( -2 );
		} ).join( '' );
	}
	var PAPER = [ 245, 244, 239 ];
	var INK = [ 17, 17, 16 ];
	function darkenTo( c, target ) {
		for ( var t = 0; t <= 1.0001; t += 0.05 ) {
			var d = c.map( function ( v, i ) {
				return v + ( INK[ i ] - v ) * t;
			} );
			if ( contrast( d, PAPER ) >= target ) {
				return d;
			}
		}
		return INK;
	}
	function accentVars( el, c ) {
		// pinks and darks take white; light accents (yellows, corals) take ink
		var on = lum( c ) > 0.33 ? '#111110' : '#ffffff';
		el.style.setProperty( '--case-accent', hex( c ) );
		el.style.setProperty( '--case-on', on );
		el.style.setProperty( '--case-mark', hex( darkenTo( c, 3 ) ) );
		el.style.setProperty( '--case-text', hex( darkenTo( c, 4.5 ) ) );
	}
	var artWithCa = content.querySelector( '.art[class*="art--"]' );
	var caseColor = artWithCa ? parseColor( getComputedStyle( artWithCa ).getPropertyValue( '--ca' ) ) : null;
	if ( ! caseColor ) {
		caseColor = parseColor( getComputedStyle( doc ).getPropertyValue( '--accent' ) ) || [ 51, 71, 255 ];
	}
	accentVars( doc, caseColor );
	// the next-case block carries the NEXT case's colour
	slice( document.querySelectorAll( '.next-case' ) ).forEach( function ( nc ) {
		var c = parseColor( getComputedStyle( nc ).getPropertyValue( '--ca' ) ) || parseColor( getComputedStyle( doc ).getPropertyValue( '--accent' ) );
		if ( c ) {
			accentVars( nc, c );
		}
	} );

	/* ---------- geometry ---------- */
	function setVW() {
		doc.style.setProperty( '--cv2-vw', doc.clientWidth + 'px' );
	}
	setVW();

	/* ---------- line-by-line mask reveal (hero title + chapter headings, plain text only) ---------- */
	function splitLines( el ) {
		if ( el.__cv2src === undefined ) {
			if ( el.children.length || ! el.textContent.trim() ) {
				el.__cv2src = null;
			} else {
				el.__cv2src = el.textContent;
			}
		}
		if ( el.__cv2src === null ) {
			return false;
		}
		var words = el.__cv2src.trim().split( /\s+/ );
		el.textContent = '';
		var spans = words.map( function ( w, i ) {
			var s = document.createElement( 'span' );
			s.className = 'cv2-w';
			s.textContent = w;
			el.appendChild( s );
			if ( i < words.length - 1 ) {
				el.appendChild( document.createTextNode( ' ' ) );
			}
			return s;
		} );
		var lines = [];
		var lastTop = null;
		spans.forEach( function ( s ) {
			var t = s.offsetTop;
			if ( lastTop === null || Math.abs( t - lastTop ) > 4 ) {
				lines.push( [] );
				lastTop = t;
			}
			lines[ lines.length - 1 ].push( s.textContent );
		} );
		el.textContent = '';
		lines.forEach( function ( ws, i ) {
			var line = document.createElement( 'span' );
			line.className = 'cv2-line';
			var inner = document.createElement( 'span' );
			inner.className = 'cv2-li';
			inner.style.setProperty( '--l', String( i ) );
			inner.textContent = ws.join( ' ' );
			line.appendChild( inner );
			el.appendChild( line );
			if ( i < lines.length - 1 ) {
				el.appendChild( document.createTextNode( ' ' ) );
			}
		} );
		el.classList.add( 'cv2-lines' );
		return true;
	}

	var h1 = hero.querySelector( 'h1' );
	var chapters = slice( content.querySelectorAll( ':scope > h2.chapter' ) );
	var titles = ( h1 ? [ h1 ] : [] ).concat( chapters );
	function splitAll() {
		titles.forEach( splitLines );
	}
	var fontsReady = document.fonts && document.fonts.ready ? document.fonts.ready : Promise.resolve();

	/* ---------- chapter openers: number + label inside the existing kicker ---------- */
	var kickers = [];
	chapters.forEach( function ( h, i ) {
		var k = h.previousElementSibling;
		if ( ! k || ! k.classList.contains( 'kicker' ) || k.children.length ) {
			k = null;
		}
		var raw = k ? k.textContent.trim() : '';
		var parts = raw.split( /\s*[·•|—–-]\s+/ );
		var numbered = parts.length > 1 && /^\d{1,2}$/.test( parts[ 0 ] );
		var num = numbered ? ( parts[ 0 ].length < 2 ? '0' : '' ) + parts[ 0 ] : ( i < 9 ? '0' : '' ) + ( i + 1 );
		var label = numbered ? parts.slice( 1 ).join( ' · ' ) : ( raw || h.textContent.trim() );
		if ( k && numbered ) {
			k.textContent = '';
			var n = document.createElement( 'span' );
			n.className = 'cv2-kn';
			n.textContent = parts[ 0 ];
			var sep = document.createElement( 'span' );
			sep.className = 'cv2-ksep';
			sep.textContent = ' · ';
			var lab = document.createElement( 'span' );
			lab.className = 'cv2-kl';
			lab.textContent = label;
			var rule = document.createElement( 'span' );
			rule.className = 'cv2-krule';
			rule.setAttribute( 'aria-hidden', 'true' );
			k.appendChild( n );
			k.appendChild( sep );
			k.appendChild( lab );
			k.appendChild( rule );
			k.classList.add( 'cv2-opener' );
		}
		var target = k || h;
		if ( ! target.id ) {
			target.id = 'chapter-' + num;
		}
		target.classList.add( 'cv2-anchor' );
		kickers.push( { k: target, h: h, num: num, label: label } );
	} );

	/* ---------- pull quotes: a short plain sentence that closes a text run right before a figure ---------- */
	slice( content.children ).forEach( function ( p ) {
		if ( p.tagName !== 'P' || p.className.replace( /\bwp-block-paragraph\b/, '' ).trim() || p.children.length ) {
			return;
		}
		var t = p.textContent.trim();
		var prev = p.previousElementSibling;
		var next = p.nextElementSibling;
		var prevText = prev && prev.tagName === 'P' && ! prev.classList.contains( 'kicker' );
		var nextFig = next && ( next.classList.contains( 'art' ) || next.classList.contains( 'sera-mockup-block' ) );
		if ( t.length > 24 && t.length < 96 && /[.!?”"]$/.test( t ) && prevText && nextFig ) {
			p.classList.add( 'cv2-pull' );
		}
	} );

	/* ---------- figures: tag artifacts, dark interludes ---------- */
	function isDark( el ) {
		var c = parseColor( getComputedStyle( el ).backgroundColor );
		return !! c && lum( c ) < 0.08;
	}
	var figs = slice( content.querySelectorAll( ':scope > .art, :scope > .sera-mockup-block' ) );
	figs.forEach( function ( f ) {
		f.classList.add( 'cv2-fig' );
		// full bleed only for a figure that IS one dark panel (optionally with its caption)
		var kids = slice( f.children ).filter( function ( c ) {
			return ! c.classList.contains( 'art-cap' );
		} );
		if ( kids.length === 1 && ( kids[ 0 ].matches( '.art-panel.art-dark' ) || kids[ 0 ].matches( '.impact' ) ) && isDark( kids[ 0 ] ) ) {
			f.classList.add( 'cv2-bleed' );
		}
	} );
	slice( content.children ).forEach( function ( el ) {
		var prev = el.previousElementSibling;
		if ( prev && prev.classList.contains( 'cv2-fig' ) && ! el.classList.contains( 'cv2-fig' ) ) {
			el.classList.add( 'cv2-after-fig' );
		}
	} );

	/* ---------- reveals (once) ---------- */
	var pending = [];
	function show( el ) {
		el.classList.add( 'cv2-in' );
	}
	// anything already above the fold's bottom edge is shown, even if a jump skipped past it
	function catchUp( vh ) {
		if ( ! pending.length ) {
			return;
		}
		pending = pending.filter( function ( el ) {
			if ( el.classList.contains( 'cv2-in' ) ) {
				return false;
			}
			if ( el.getBoundingClientRect().top < vh * 0.92 ) {
				show( el );
				return false;
			}
			return true;
		} );
	}
	var revealables = chapters.concat( kickers.map( function ( o ) {
		return o.k;
	} ) ).concat( figs );
	if ( reduce || ! hasIO ) {
		revealables.forEach( show );
		if ( h1 ) {
			show( h1 );
		}
	} else {
		doc.classList.add( 'cv2-anim' );
		if ( h1 && ! h1.children.length ) {
			h1.classList.add( 'cv2-wait' );
		}
		var rio = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( e ) {
				if ( e.isIntersecting ) {
					show( e.target );
					rio.unobserve( e.target );
				}
			} );
		}, { rootMargin: '0px 0px -12% 0px' } );
		revealables.forEach( function ( el ) {
			rio.observe( el );
		} );
		pending = revealables.slice();
		setTimeout( function () {
			doc.classList.add( 'cv2-safe' );
		}, 9000 );
	}

	/* ---------- next case: wrap the title text so it can carry a drawn underline ---------- */
	slice( document.querySelectorAll( '.next-case .next-link .t' ) ).forEach( function ( t ) {
		var tn = t.firstChild;
		if ( tn && tn.nodeType === 3 && tn.textContent.trim() ) {
			var sp = document.createElement( 'span' );
			sp.className = 'cv2-nt';
			t.insertBefore( sp, tn );
			sp.appendChild( tn );
		}
	} );

	var cover = hero.querySelector( '.case-hero-visual' );
	var nextCase = document.querySelector( '.next-case' );

	/* ---------- current chapter: a label in the header pill (wide) or a bottom pill (narrow) ----------
	   Both open the same chapter list. The text only changes when the active chapter changes. */
	var nav = null;
	var links = [];
	var headBtn = null;
	var headTxt = null;
	var pill = null;
	var pillN;
	var pillT;
	var mode = '';
	var headSlot = null;
	var actions = document.querySelector( '.site-header .header-actions' );
	var header = document.querySelector( '.site-header' );
	var openBtn = null;
	function setOpen( open, btn ) {
		doc.classList.toggle( 'cv2-toc-open', open );
		[ headBtn, pill ].forEach( function ( b ) {
			if ( b ) {
				b.setAttribute( 'aria-expanded', String( open && b === btn ) );
			}
		} );
		openBtn = open ? btn : null;
		if ( open && nav ) {
			var cur = nav.querySelector( 'a[aria-current]' ) || links[ 0 ];
			if ( cur && btn && btn.__kbd ) {
				cur.focus();
			}
		}
	}
	if ( kickers.length > 1 ) {
		nav = document.createElement( 'nav' );
		nav.className = 'cv2-toc';
		nav.id = 'cv2-toc';
		nav.setAttribute( 'aria-label', L.chapters );
		var ol = document.createElement( 'ol' );
		kickers.forEach( function ( o ) {
			var li = document.createElement( 'li' );
			var a = document.createElement( 'a' );
			a.href = '#' + o.k.id;
			var n = document.createElement( 'span' );
			n.className = 'n';
			n.textContent = o.num;
			var t = document.createElement( 'span' );
			t.className = 't';
			t.textContent = o.label;
			a.appendChild( n );
			a.appendChild( t );
			li.appendChild( a );
			ol.appendChild( li );
			links.push( a );
			a.addEventListener( 'click', function () {
				var b = openBtn;
				setOpen( false );
				if ( b && b.__kbd ) {
					o.k.setAttribute( 'tabindex', '-1' );
					setTimeout( function () {
						o.k.focus( { preventScroll: true } );
					}, 50 );
				}
			} );
		} );
		nav.appendChild( ol );

		function makeBtn( cls ) {
			var b = document.createElement( 'button' );
			b.type = 'button';
			b.className = cls;
			b.setAttribute( 'aria-controls', 'cv2-toc' );
			b.setAttribute( 'aria-expanded', 'false' );
			b.addEventListener( 'keydown', function ( e ) {
				if ( e.key === 'Enter' || e.key === ' ' || e.key === 'ArrowDown' ) {
					b.__kbd = true;
				}
				if ( e.key === 'ArrowDown' && ! doc.classList.contains( 'cv2-toc-open' ) ) {
					e.preventDefault();
					setOpen( true, b );
				}
			} );
			b.addEventListener( 'pointerdown', function () {
				b.__kbd = false;
			} );
			b.addEventListener( 'click', function () {
				setOpen( ! ( doc.classList.contains( 'cv2-toc-open' ) && openBtn === b ), b );
			} );
			return b;
		}
		// header label
		if ( actions && header ) {
			headSlot = document.createElement( 'div' );
			headSlot.className = 'cv2-chap';
			headBtn = makeBtn( 'cv2-chap-btn' );
			headBtn.innerHTML = '<span class="cv2-chap-txt"></span><svg viewBox="0 0 12 12" aria-hidden="true"><path d="M3 4.5 6 7.5 9 4.5" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>';
			headTxt = headBtn.querySelector( '.cv2-chap-txt' );
			headSlot.appendChild( headBtn );
			actions.insertBefore( headSlot, actions.firstChild );
		}
		// bottom pill
		pill = makeBtn( 'cv2-pill' );
		pill.innerHTML = '<span class="n"></span><span class="t"></span>';
		pillN = pill.querySelector( '.n' );
		pillT = pill.querySelector( '.t' );
		body.appendChild( pill );

		document.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'Escape' && doc.classList.contains( 'cv2-toc-open' ) ) {
				var b = openBtn;
				setOpen( false );
				if ( b ) {
					b.focus();
				}
			}
		} );
		document.addEventListener( 'click', function ( e ) {
			if ( doc.classList.contains( 'cv2-toc-open' ) && ! nav.contains( e.target ) && ! ( headBtn && headBtn.contains( e.target ) ) && ! pill.contains( e.target ) ) {
				setOpen( false );
			}
		} );
	}

	// the header slot gets the longest label's width, so the text can change without moving anything
	var headW = 0;
	function measureHead() {
		if ( ! headSlot ) {
			return;
		}
		// measure in a hidden clone of the button (the real slot may be display:none right now)
		var box = document.createElement( 'span' );
		box.className = 'cv2-chap-btn';
		box.style.cssText = 'position:absolute;left:-9999px;top:0;width:auto;visibility:hidden';
		var probe = document.createElement( 'span' );
		probe.className = 'cv2-chap-txt';
		probe.style.whiteSpace = 'nowrap';
		box.appendChild( probe );
		body.appendChild( box );
		headW = 0;
		kickers.forEach( function ( o ) {
			probe.textContent = o.num + ' · ' + o.label;
			headW = Math.max( headW, probe.getBoundingClientRect().width );
		} );
		body.removeChild( box );
		headSlot.style.setProperty( '--chap-w', Math.ceil( headW ) + 'px' );
	}
	function chooseMode() {
		if ( ! nav ) {
			return;
		}
		var m = 'pill';
		if ( headSlot && window.innerWidth >= 900 ) {
			// room between whatever is visible on the left (nav links or brand) and the actions
			var left = 0;
			var navEl = header.querySelector( '.primary-nav' );
			var ul = navEl && navEl.querySelector( 'ul' );
			if ( navEl && ul && getComputedStyle( navEl ).position !== 'absolute' && ul.getBoundingClientRect().width > 0 ) {
				left = ul.getBoundingClientRect().right;
			} else {
				var brand = header.querySelector( '.brand' );
				left = brand ? brand.getBoundingClientRect().right : 0;
			}
			var room = actions.getBoundingClientRect().left - left;
			// the slot takes the longest label's width; a very long one may end in an ellipsis
			var fit = Math.min( headW, room - 56 );
			if ( fit >= headW || fit >= 130 ) {
				m = 'head';
				headSlot.style.setProperty( '--chap-w', Math.floor( fit ) + 'px' );
			}
		}
		if ( m !== mode ) {
			setOpen( false );
			mode = m;
			doc.classList.toggle( 'cv2-mode-head', m === 'head' );
			doc.classList.toggle( 'cv2-mode-pill', m === 'pill' );
			( m === 'head' ? headSlot : body ).appendChild( nav );
		}
	}

	function layout() {
		var vw = doc.clientWidth;
		// cover: how far it may grow on each side (to a 16 px page margin)
		if ( cover ) {
			var wrap = cover.parentElement.getBoundingClientRect();
			var cs = getComputedStyle( cover.parentElement );
			var inner = wrap.width - parseFloat( cs.paddingLeft ) - parseFloat( cs.paddingRight );
			var extra = Math.max( 0, ( vw - 32 - inner ) / 2 );
			cover.style.setProperty( '--cv2-cw', ( inner + 2 * extra ) + 'px' );
			cover.__extra = extra;
			cover.classList.toggle( 'cv2-cover', vw >= 700 && extra > 8 && ! reduce );
		}
		measureHead();
		chooseMode();
	}

	var ticking = false;
	var lastIdx = -2;
	var lastRange = null;
	var lastY = window.scrollY;
	var swapT = 0;
	function setLabel( idx ) {
		var cur = kickers[ Math.max( 0, idx ) ];
		var txt = cur.num + ' · ' + cur.label;
		links.forEach( function ( l, j ) {
			if ( j === idx ) {
				l.setAttribute( 'aria-current', 'location' );
			} else {
				l.removeAttribute( 'aria-current' );
			}
		} );
		pillN.textContent = cur.num;
		pillT.textContent = cur.label;
		var lab = L.chapters + ': ' + txt;
		pill.setAttribute( 'aria-label', lab );
		if ( headBtn ) {
			headBtn.setAttribute( 'aria-label', lab );
			if ( ! headTxt.textContent || reduce || ! doc.classList.contains( 'cv2-inrange' ) ) {
				headTxt.textContent = txt;
				headTxt.classList.remove( 'is-out' );
			} else {
				clearTimeout( swapT );
				headTxt.classList.add( 'is-out' );
				swapT = setTimeout( function () {
					headTxt.textContent = txt;
					headTxt.classList.remove( 'is-out' );
				}, 180 );
			}
		}
	}
	function frame() {
		ticking = false;
		var vh = window.innerHeight;
		catchUp( vh );
		if ( cover && cover.classList.contains( 'cv2-cover' ) ) {
			var r = cover.getBoundingClientRect();
			var o = clamp( 1 - ( r.top - vh * 0.12 ) / ( vh * 0.78 ), 0, 1 );
			o = o * o * ( 3 - 2 * o );
			cover.style.setProperty( '--cv2-cx', ( cover.__extra * ( 1 - o ) ).toFixed( 1 ) + 'px' );
			cover.style.setProperty( '--cv2-o', o.toFixed( 3 ) );
		}
		if ( ! nav ) {
			return;
		}
		var probe = vh * 0.42;
		var idx = -1;
		for ( var i = kickers.length - 1; i >= 0; i-- ) {
			if ( kickers[ i ].k.getBoundingClientRect().top < probe ) {
				idx = i;
				break;
			}
		}
		// the pill sits over the text: tuck it away while reading down, bring it back on scroll up
		var sy = window.scrollY;
		if ( Math.abs( sy - lastY ) > 8 ) {
			doc.classList.toggle( 'cv2-reading', sy > lastY );
			lastY = sy;
		}
		var endTop = nextCase ? nextCase.getBoundingClientRect().top : content.getBoundingClientRect().bottom;
		var inRange = idx >= 0 && endTop > vh * 0.75;
		if ( inRange !== lastRange ) {
			lastRange = inRange;
			doc.classList.toggle( 'cv2-inrange', inRange );
			if ( ! inRange && doc.classList.contains( 'cv2-toc-open' ) ) {
				setOpen( false );
			}
		}
		if ( idx !== lastIdx && idx >= 0 ) {
			lastIdx = idx;
			setLabel( idx );
		}
	}
	function queue() {
		if ( ! ticking ) {
			ticking = true;
			requestAnimationFrame( frame );
		}
	}
	window.addEventListener( 'scroll', queue, { passive: true } );

	fontsReady.then( function () {
		splitAll();
		if ( h1 ) {
			h1.classList.remove( 'cv2-wait' );
		}
		requestAnimationFrame( function () {
			if ( h1 ) {
				show( h1 );
			}
		} );
		layout();
		frame();
	} );
	var lastW = doc.clientWidth;
	var rt;
	window.addEventListener( 'resize', function () {
		clearTimeout( rt );
		rt = setTimeout( function () {
			setVW();
			if ( doc.clientWidth !== lastW ) {
				lastW = doc.clientWidth;
				splitAll();
			}
			layout();
			frame();
		}, 120 );
	} );
	layout();
	frame();
	window.addEventListener( 'load', function () {
		layout();
		frame();
	} );

	/* next-case thumbnail: the 760x553 card is scaled to the frame's real width, so it always fills it
	   (fixed per-breakpoint scales left gaps on wide phones and tablets) */
	var nc = document.querySelector( '.next-case.has-thumb' );
	var nt = nc && nc.querySelector( '.next-thumb' );
	if ( nt && window.ResizeObserver ) {
		var fit = function () {
			var w = nt.offsetWidth;
			if ( w ) {
				nc.style.setProperty( '--nt-w', w + 'px' );
				nc.style.setProperty( '--nt-s', ( w / 760 ).toFixed( 5 ) );
			}
		};
		new ResizeObserver( fit ).observe( nt );
		fit();
	}
} )();
