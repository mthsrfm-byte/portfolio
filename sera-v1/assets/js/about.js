/* About · "Caixinhas" bento.
   1) Photo parallax: the image moves slower than its card (small translateY, scaled so no edge shows).
      Reads the window scroll, so it follows Lenis too (Lenis scrolls the window). Off with reduced motion.
   2) Mobile carousel counter: "01 / 04" follows the card snapped at the start. */
( function () {
	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' );

	var box = document.querySelector( '#about [data-ab-parallax]' );
	var img = box && box.querySelector( 'img' );
	if ( box && img ) {
		var AMP = 0.07; // share of the card height the image travels to each side.
		var visible = false, ticking = false;
		var set = function () {
			ticking = false;
			if ( reduce && reduce.matches ) {
				box.style.removeProperty( '--ab-y' );
				box.style.removeProperty( '--ab-s' );
				return;
			}
			var r = box.getBoundingClientRect();
			var vh = window.innerHeight || document.documentElement.clientHeight;
			// -1 when the card's centre is at the bottom of the screen, 1 at the top.
			var p = ( vh / 2 - ( r.top + r.height / 2 ) ) / ( vh / 2 + r.height / 2 );
			p = Math.max( -1, Math.min( 1, p ) );
			box.style.setProperty( '--ab-s', ( 1 + AMP * 2 + 0.02 ).toFixed( 3 ) );
			box.style.setProperty( '--ab-y', ( p * AMP * r.height ).toFixed( 1 ) + 'px' );
		};
		var req = function () {
			if ( visible && ! ticking ) {
				ticking = true;
				window.requestAnimationFrame( set );
			}
		};
		if ( 'IntersectionObserver' in window ) {
			new IntersectionObserver( function ( en ) {
				visible = en[ 0 ].isIntersecting;
				req();
			}, { rootMargin: '120px 0px' } ).observe( box );
		} else {
			visible = true;
		}
		window.addEventListener( 'scroll', req, { passive: true } );
		window.addEventListener( 'resize', req );
		if ( window.seraLenis && window.seraLenis.on ) {
			window.seraLenis.on( 'scroll', req );
		}
		if ( reduce && reduce.addEventListener ) {
			reduce.addEventListener( 'change', function () {
				visible = true;
				req();
			} );
		}
		set();
	}

	var track = document.querySelector( '#about [data-ab-facts]' );
	var now = document.querySelector( '#about [data-ab-now]' );
	if ( track && now ) {
		var cards = [].slice.call( track.children );
		var pending = false;
		var update = function () {
			pending = false;
			var best = 0, d = Infinity;
			var left = track.getBoundingClientRect().left + ( parseFloat( getComputedStyle( track ).paddingLeft ) || 0 );
			cards.forEach( function ( c, i ) {
				var dist = Math.abs( c.getBoundingClientRect().left - left );
				if ( dist < d ) {
					d = dist;
					best = i;
				}
			} );
			if ( track.scrollLeft + track.clientWidth >= track.scrollWidth - 4 ) {
				best = cards.length - 1;
			}
			now.textContent = ( best + 1 < 10 ? '0' : '' ) + ( best + 1 );
		};
		track.addEventListener( 'scroll', function () {
			if ( ! pending ) {
				pending = true;
				window.requestAnimationFrame( update );
			}
		}, { passive: true } );
	}
} )();
