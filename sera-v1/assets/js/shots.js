/* Sera v.1 — .shots pair-card sliders (Research Hub real screens).
   Native scroll-snap does the scrolling; this adds the active card, dots, prev/next,
   counter, keyboard arrows and the first-view entrance. Vanilla, no dependencies.
   Without JS the row still scrolls and every card is shown in full. */
( function () {
	'use strict';

	var reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var hasIO = 'IntersectionObserver' in window;

	function pad( n ) {
		return ( n < 10 ? '0' : '' ) + n;
	}

	[].slice.call( document.querySelectorAll( '.shots' ) ).forEach( function ( root ) {
		var track = root.querySelector( '.shots-track' );
		var cards = track ? [].slice.call( track.querySelectorAll( '.shots-card' ) ) : [];
		var nav = root.querySelector( '.shots-nav' );
		if ( ! track || cards.length < 2 || ! nav ) {
			return;
		}
		var dots = [].slice.call( nav.querySelectorAll( '.shots-dot' ) );
		var prev = nav.querySelector( '.shots-prev' );
		var next = nav.querySelector( '.shots-next' );
		var count = nav.querySelector( '.shots-count' );
		var total = cards.length;
		var active = -1;
		var ticking = false;

		nav.hidden = false;
		root.classList.add( 'is-ready' );

		function setActive( i ) {
			if ( i === active ) {
				return;
			}
			active = i;
			cards.forEach( function ( c, k ) {
				c.classList.toggle( 'is-active', k === i );
			} );
			dots.forEach( function ( d, k ) {
				if ( k === i ) {
					d.setAttribute( 'aria-current', 'true' );
				} else {
					d.removeAttribute( 'aria-current' );
				}
			} );
			if ( count ) {
				count.innerHTML = '<b>' + pad( i + 1 ) + '</b> / ' + pad( total );
			}
			if ( prev ) {
				prev.disabled = i === 0;
			}
			if ( next ) {
				next.disabled = i === total - 1;
			}
		}

		function centreOf( card ) {
			return card.offsetLeft + card.offsetWidth / 2 - track.clientWidth / 2;
		}

		function goTo( i ) {
			i = Math.max( 0, Math.min( total - 1, i ) );
			var left = centreOf( cards[ i ] );
			if ( track.scrollTo ) {
				track.scrollTo( { left: left, behavior: reduce ? 'auto' : 'smooth' } );
			} else {
				track.scrollLeft = left;
			}
			setActive( i );
		}

		function sync() {
			ticking = false;
			var mid = track.scrollLeft;
			var best = 0;
			var bestD = Infinity;
			cards.forEach( function ( c, k ) {
				var d = Math.abs( centreOf( c ) - mid );
				if ( d < bestD ) {
					bestD = d;
					best = k;
				}
			} );
			setActive( best );
		}

		track.addEventListener( 'scroll', function () {
			if ( ! ticking ) {
				ticking = true;
				requestAnimationFrame( sync );
			}
		}, { passive: true } );
		window.addEventListener( 'resize', function () {
			if ( active >= 0 ) {
				track.scrollLeft = centreOf( cards[ active ] );
			}
		} );

		if ( prev ) {
			prev.addEventListener( 'click', function () {
				goTo( active - 1 );
			} );
		}
		if ( next ) {
			next.addEventListener( 'click', function () {
				goTo( active + 1 );
			} );
		}
		dots.forEach( function ( d, k ) {
			d.addEventListener( 'click', function () {
				goTo( k );
			} );
		} );
		// Tapping a peeking neighbour brings it to the centre.
		cards.forEach( function ( c, k ) {
			c.addEventListener( 'click', function () {
				if ( k !== active ) {
					goTo( k );
				}
			} );
		} );
		track.addEventListener( 'keydown', function ( e ) {
			var map = { ArrowLeft: active - 1, ArrowRight: active + 1, Home: 0, End: total - 1 };
			if ( Object.prototype.hasOwnProperty.call( map, e.key ) ) {
				e.preventDefault();
				goTo( map[ e.key ] );
			}
		} );

		setActive( 0 );
		sync();

		// Entrance: the first time the slider is on screen, the desktop rises and the phone follows.
		if ( reduce || ! hasIO ) {
			root.classList.add( 'is-seen' );
			return;
		}
		var io = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( e ) {
				if ( e.isIntersecting ) {
					root.classList.add( 'is-seen' );
					io.disconnect();
				}
			} );
		}, { threshold: 0.3 } );
		io.observe( track );
	} );
} )();

/* v3.7.7 · loading state: the track fades in once the first card's screenshots are ready
   (or after 2.5 s at most); every screenshot fades in as it arrives. */
( function () {
	[].forEach.call( document.querySelectorAll( '.shots' ), function ( sl ) {
		var imgs = [].slice.call( sl.querySelectorAll( '.shots-img' ) );
		if ( ! imgs.length ) {
			return;
		}
		var first = sl.querySelector( '.shots-card' );
		var firstImgs = first ? [].slice.call( first.querySelectorAll( '.shots-img' ) ) : [];
		function mark( img ) {
			img.classList.add( 'is-loaded' );
		}
		function ready() {
			sl.classList.remove( 'is-loading' );
		}
		sl.classList.add( 'is-loading' );
		var pending = 0;
		imgs.forEach( function ( img ) {
			if ( img.complete && img.naturalWidth ) {
				mark( img );
			} else {
				img.addEventListener( 'load', function () {
					mark( img );
					if ( firstImgs.indexOf( img ) > -1 && --pending <= 0 ) {
						ready();
					}
				} );
				img.addEventListener( 'error', function () {
					mark( img );
				} );
				if ( firstImgs.indexOf( img ) > -1 ) {
					pending++;
					img.loading = 'eager';
				}
			}
		} );
		if ( ! pending ) {
			ready();
		}
		setTimeout( ready, 2500 );
	} );
} )();
