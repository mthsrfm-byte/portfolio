/* Sera v.1 — case pages: reveal, reading progress, chapter rail, mockup motion,
   row-stage dots and the "View full page" dialog. Vanilla, no dependencies. */
( function () {
	'use strict';

	var reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var hasIO = 'IntersectionObserver' in window;
	var PT = ( document.documentElement.lang || '' ).indexOf( 'pt' ) === 0;
	function t( en, pt ) {
		return PT ? pt : en;
	}
	var content = document.querySelector( '.case-content' );
	// The case accent lives on the artifact wrappers (.art--pg …), so read it from the first one.
	function caseAccent() {
		var scope = content ? ( content.querySelector( '.art[class*="art--"]' ) || content ) : document.body;
		return getComputedStyle( scope ).getPropertyValue( '--ca' ).trim();
	}

	/* ---- reveal: .art / .sera-mockup-block (+ .glance/.impact/.statement when they stand alone) with staggered children ---- */
	( function () {
		if ( ! content ) {
			return;
		}
		var targets = [].slice.call( content.querySelectorAll( '.art, .sera-mockup-block' ) );
		[].slice.call( content.querySelectorAll( '.glance, .impact, .statement' ) ).forEach( function ( el ) {
			if ( ! el.closest( '.art, .sera-mockup-block' ) ) {
				targets.push( el );
			}
		} );
		targets.forEach( function ( el ) {
			el.classList.add( 'reveal' );
			[].slice.call( el.querySelectorAll( '.stat, .signals > div, .art-grid > *' ) ).forEach( function ( child, i ) {
				child.style.setProperty( '--i', String( Math.min( i, 8 ) ) );
			} );
		} );
		if ( reduce || ! hasIO ) {
			targets.forEach( function ( el ) {
				el.classList.add( 'is-in' );
			} );
			return;
		}
		var io = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( e ) {
				if ( e.isIntersecting ) {
					e.target.classList.add( 'is-in' );
					io.unobserve( e.target );
				}
			} );
		}, { threshold: 0, rootMargin: '0px 0px -8% 0px' } );
		targets.forEach( function ( el ) {
			io.observe( el );
		} );
	} )();

	/* ---- reading progress: a 3 px ink bar (the logo colour) under the header, rAF-throttled ---- */
	( function () {
		var header = document.querySelector( '.site-header' );
		if ( ! header || ! content ) {
			return;
		}
		var bar = document.createElement( 'span' );
		bar.className = 'read-progress';
		bar.setAttribute( 'aria-hidden', 'true' );
		header.appendChild( bar );
		var ticking = false;
		function update() {
			ticking = false;
			var doc = document.documentElement;
			var max = doc.scrollHeight - window.innerHeight;
			var p = max > 0 ? Math.min( 1, Math.max( 0, window.scrollY / max ) ) : 0;
			bar.style.setProperty( '--p', p.toFixed( 4 ) );
		}
		window.addEventListener( 'scroll', function () {
			if ( ! ticking ) {
				ticking = true;
				requestAnimationFrame( update );
			}
		}, { passive: true } );
		window.addEventListener( 'resize', update );
		update();
	} )();

	/* ---- chapter rail: removed in 3.5.4 (the owner preferred the page without the 01–NN side index) ---- */
	( function () {
		if ( true || ! content ) {
			return;
		}
		var chapters = [].slice.call( content.querySelectorAll( 'h2.chapter' ) );
		if ( chapters.length < 2 ) {
			return;
		}
		var toc = document.createElement( 'ol' );
		toc.className = 'case-toc';
		toc.setAttribute( 'aria-label', t( 'Chapters', 'Capítulos' ) );
		var links = [];
		chapters.forEach( function ( h, i ) {
			var kicker = h.previousElementSibling && h.previousElementSibling.classList.contains( 'kicker' ) ? h.previousElementSibling.textContent.trim() : '';
			var parts = kicker.split( /\s*[·•]\s*/ );
			var num = parts.length > 1 && /^\d+$/.test( parts[ 0 ] ) ? parts[ 0 ] : ( i < 9 ? '0' + ( i + 1 ) : String( i + 1 ) );
			var label = parts.length > 1 ? parts.slice( 1 ).join( ' · ' ) : ( kicker || h.textContent.trim() );
			if ( ! h.id ) {
				h.id = 'chapter-' + ( i + 1 );
			}
			var li = document.createElement( 'li' );
			var a = document.createElement( 'a' );
			a.href = '#' + h.id;
			a.innerHTML = '<span class="n">' + num + '</span><span class="t"></span>';
			a.querySelector( '.t' ).textContent = label;
			a.setAttribute( 'aria-label', num + ' · ' + label );
			li.appendChild( a );
			toc.appendChild( li );
			links.push( a );
		} );
		var ca = caseAccent();
		if ( ca ) {
			toc.style.setProperty( '--ca', ca );
		}
		document.body.appendChild( toc );
		function setActive( idx ) {
			links.forEach( function ( a, i ) {
				if ( i === idx ) {
					a.setAttribute( 'aria-current', 'true' );
				} else {
					a.removeAttribute( 'aria-current' );
				}
			} );
		}
		if ( ! hasIO ) {
			setActive( 0 );
			return;
		}
		var current = -1;
		var io = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( e ) {
				if ( e.isIntersecting ) {
					current = chapters.indexOf( e.target );
				}
			} );
			if ( current < 0 ) {
				// Nothing crossing the band: pick the last heading above the fold.
				for ( var i = chapters.length - 1; i >= 0; i-- ) {
					if ( chapters[ i ].getBoundingClientRect().top < window.innerHeight * 0.4 ) {
						current = i;
						break;
					}
				}
			}
			setActive( Math.max( 0, current ) );
		}, { rootMargin: '-35% 0px -55% 0px' } );
		chapters.forEach( function ( h ) {
			io.observe( h );
		} );
	} )();

	/* ---- mockup motion (v3.2) ----
	   Arms every .mk-anim stage (except the decorative next-case thumbnail) so mockups.css can run:
	   · .is-in   once, the first time a stage is properly on screen (entrance choreography);
	   · .is-live while ≥40% of it is on screen (or it fills half the viewport), so the 7.2 s loops
	              only run when someone can see them and pause off screen or in a hidden tab;
	   · --p      scroll depth, −1 (below the fold) … 1 (above), written in one rAF per frame for
	              the stages near the viewport only (all reads first, then all writes).
	   Nothing is armed under reduced motion or without IntersectionObserver, so the static,
	   fully visible mockups remain the default. */
	( function () {
		var stages = [].slice.call( document.querySelectorAll( '.mk-anim' ) ).filter( function ( s ) {
			return ! s.closest( '.next-thumb' );
		} );
		if ( ! stages.length || reduce || ! hasIO ) {
			return;
		}
		stages.forEach( function ( s ) {
			[].slice.call( s.querySelectorAll( '.device, .browser, .mk-depth' ) ).forEach( function ( f, i ) {
				f.style.setProperty( '--mk-i', String( Math.min( i, 6 ) ) );
			} );
			s.classList.add( 'mk-armed' );
		} );

		var near = [];
		var ticking = false;
		function depth() {
			ticking = false;
			var vh = window.innerHeight;
			var vals = near.map( function ( s ) {
				var r = s.getBoundingClientRect();
				var p = ( vh / 2 - ( r.top + r.height / 2 ) ) / ( ( vh + r.height ) / 2 );
				return Math.max( -1, Math.min( 1, p ) ).toFixed( 3 );
			} );
			near.forEach( function ( s, i ) {
				if ( s.__mkp !== vals[ i ] ) {
					s.__mkp = vals[ i ];
					s.style.setProperty( '--p', vals[ i ] );
				}
			} );
		}
		function queue() {
			if ( ! ticking && near.length ) {
				ticking = true;
				requestAnimationFrame( depth );
			}
		}

		var live = new IntersectionObserver( function ( entries ) {
			var vh = window.innerHeight;
			entries.forEach( function ( e ) {
				var h = e.intersectionRect.height;
				if ( e.isIntersecting && ( e.intersectionRatio >= 0.15 || h >= vh * 0.3 ) ) {
					e.target.classList.add( 'is-in' );
				}
				e.target.classList.toggle( 'is-live', ! document.hidden && e.isIntersecting && ( e.intersectionRatio >= 0.4 || h >= vh * 0.5 ) );
			} );
		}, { threshold: [ 0, 0.15, 0.3, 0.4, 0.6, 0.8, 1 ] } );

		var watch = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( e ) {
				var i = near.indexOf( e.target );
				if ( e.isIntersecting && i < 0 ) {
					near.push( e.target );
				} else if ( ! e.isIntersecting && i >= 0 ) {
					near.splice( i, 1 );
				}
			} );
			queue();
		}, { rootMargin: '25% 0px 25% 0px' } );

		stages.forEach( function ( s ) {
			live.observe( s );
			watch.observe( s );
		} );
		window.addEventListener( 'scroll', queue, { passive: true } );
		window.addEventListener( 'resize', queue, { passive: true } );

		// A hidden tab pauses every loop; coming back re-reads what is on screen.
		document.addEventListener( 'visibilitychange', function () {
			stages.forEach( function ( s ) {
				if ( document.hidden ) {
					s.classList.remove( 'is-live' );
				} else {
					live.unobserve( s );
					live.observe( s );
				}
			} );
		} );
	} )();

	/* ---- row stages: dots indicator + keyboard focus only while they actually scroll ---- */
	( function () {
		[].slice.call( document.querySelectorAll( '.stage-row' ) ).forEach( function ( row ) {
			var devices = [].slice.call( row.querySelectorAll( ':scope > .device' ) );
			var host = row.parentElement;
			if ( devices.length < 2 || ! host ) {
				return;
			}
			// The brand chip lives inside the scroller: keep it pinned while the row scrolls sideways.
			// v3.7.6: the chip moves out of the scroller (into the block) so it never moves while swiping.
			var chip = row.querySelector( ':scope > .brand-chip' );
			if ( chip && host ) {
				chip.classList.add( 'is-fixed' );
				// keep the stage's colour rules (.stage-wu .brand-chip…) with a display:contents wrapper
				var wrap = document.createElement( 'span' );
				wrap.className = row.className.split( /\s+/ ).filter( function ( c ) {
					return /^stage-/.test( c ) && 'stage-row' !== c;
				} ).join( ' ' ) + ' chip-host';
				wrap.appendChild( chip );
				host.appendChild( wrap );
				chip = null;
			}
			var dots = document.createElement( 'span' );
			dots.className = 'stage-dots';
			dots.setAttribute( 'aria-hidden', 'true' );
			devices.forEach( function () {
				dots.appendChild( document.createElement( 'i' ) );
			} );
			host.appendChild( dots );
			var ticking = false;
			function sync() {
				ticking = false;
				var scrolls = row.scrollWidth > row.clientWidth + 4;
				if ( scrolls ) {
					row.setAttribute( 'tabindex', '0' );
				} else {
					row.removeAttribute( 'tabindex' );
				}
				if ( chip ) {
					chip.style.translate = row.scrollLeft ? row.scrollLeft + 'px 0' : '';
				}
				var mid = row.scrollLeft + row.clientWidth / 2;
				var best = 0;
				var bestD = Infinity;
				devices.forEach( function ( d, i ) {
					var c = d.offsetLeft + d.offsetWidth / 2;
					var dist = Math.abs( c - mid );
					if ( dist < bestD ) {
						bestD = dist;
						best = i;
					}
				} );
				[].slice.call( dots.children ).forEach( function ( dot, i ) {
					if ( i === best ) {
						dot.setAttribute( 'aria-current', 'true' );
					} else {
						dot.removeAttribute( 'aria-current' );
					}
				} );
			}
			function queue() {
				if ( ! ticking ) {
					ticking = true;
					requestAnimationFrame( sync );
				}
			}
			row.addEventListener( 'scroll', queue, { passive: true } );
			window.addEventListener( 'resize', queue );
			sync();
		} );
	} )();

	/* ---- full-page browsers: "View full page" opens a <dialog> with the page at --bs:1 ---- */
	( function () {
		var browsers = [].slice.call( document.querySelectorAll( '.ac-compare .browser, .rh-shot .browser, .rh-fit .browser' ) );
		if ( ! browsers.length || ! ( 'HTMLDialogElement' in window ) ) {
			return;
		}
		var dialog = null;
		function openDialog( browser ) {
			if ( ! dialog ) {
				dialog = document.createElement( 'dialog' );
				dialog.className = 'browser-dialog';
				dialog.innerHTML = '<div class="bd-bar"><span class="bd-title"></span><button type="button" class="bd-close">' + t( 'Close', 'Fechar' ) + '</button></div><div class="bd-scroll"></div>';
				dialog.querySelector( '.bd-close' ).addEventListener( 'click', function () {
					dialog.close();
				} );
				dialog.addEventListener( 'close', function () {
					dialog.querySelector( '.bd-scroll' ).innerHTML = '';
					if ( dialog.opener ) {
						dialog.opener.focus();
						dialog.opener = null;
					}
				} );
				document.body.appendChild( dialog );
			}
			var clone = browser.cloneNode( true );
			clone.style.removeProperty( '--bs' );
			var cap = clone.querySelector( 'figcaption' );
			if ( cap ) {
				cap.remove();
			}
			[].slice.call( clone.querySelectorAll( '.mk-anim' ) ).forEach( function ( s ) {
				s.classList.remove( 'is-live' );
			} );
			dialog.querySelector( '.bd-title' ).textContent = browser.getAttribute( 'aria-label' ) || t( 'Full page', 'Página inteira' );
			var scroll = dialog.querySelector( '.bd-scroll' );
			scroll.innerHTML = '';
			scroll.appendChild( clone );
			dialog.showModal();
			scroll.scrollTop = 0;
			scroll.scrollLeft = 0;
		}
		browsers.forEach( function ( browser ) {
			var btn = document.createElement( 'button' );
			btn.type = 'button';
			btn.className = 'browser-more';
			btn.innerHTML = '<svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 14v6h6M20 10V4h-6M4 20l6-6M20 4l-6 6"/></svg>' + t( 'View full page', 'Ver página inteira' );
			btn.addEventListener( 'click', function () {
				openDialog( browser );
				dialog.opener = btn;
			} );
			// After the figure (role="img"), never inside it.
			browser.insertAdjacentElement( 'afterend', btn );
		} );
	} )();
} )();
