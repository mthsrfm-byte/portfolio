/* Sera v2 · home. Runs after the theme's main.js. */

/* ==========================================================================
   Card metric icons: data, kept apart so the port can move it to PHP as is.
   V2_ICONS: name -> inner SVG markup (viewBox 0 0 256 256, stroked, no fill).
   V2_CASE_ICONS: case slug (last segment of the card link) -> three icon names, in metric order.
   Never a lightning / bolt shape.
   ========================================================================== */
var V2_ICONS = {
	calendar: '<rect x="40" y="48" width="176" height="168" rx="10"/><path d="M40 92h176M84 32v32M172 32v32"/>',
	steps: '<path d="M32 208h48v-44h48v-44h48V76h48"/><path d="M32 208h192"/>',
	cursor: '<path d="M64 40l136 96-60 12 36 68-28 12-36-68-48 40z"/>',
	flag: '<path d="M56 224V40"/><path d="M56 52c40-24 80 24 120 0 16-9 28-10 40-6v100c-12-4-24-3-40 6-40 24-80-24-120 0"/>',
	chip: '<rect x="72" y="72" width="112" height="112" rx="10"/><rect x="104" y="104" width="48" height="48" rx="4"/><path d="M104 40v32M152 40v32M104 184v32M152 184v32M40 104h32M40 152h32M184 104h32M184 152h32"/>',
	pulse: '<path d="M24 136h48l24-56 40 104 24-48h72"/>',
	search: '<circle cx="112" cy="112" r="72"/><path d="M163 163l61 61"/>',
	file: '<path d="M152 32H64a8 8 0 0 0-8 8v176a8 8 0 0 0 8 8h128a8 8 0 0 0 8-8V80z"/><path d="M152 32v48h48M96 136h64M96 168h64"/>',
	kanban: '<rect x="32" y="48" width="192" height="160" rx="10"/><path d="M96 48v160M160 48v160M52 76h24M116 76h24M180 76h24"/>',
	link: '<path d="M122 86l20-20a40 40 0 0 1 56 56l-28 28a40 40 0 0 1-56 0"/><path d="M134 170l-20 20a40 40 0 0 1-56-56l28-28a40 40 0 0 1 56 0"/>',
	mic: '<rect x="96" y="24" width="64" height="120" rx="32"/><path d="M200 120a72 72 0 0 1-144 0M128 192v40M96 232h64"/>',
	users: '<circle cx="96" cy="100" r="40"/><path d="M24 204c16-32 44-48 72-48s56 16 72 48"/><circle cx="180" cy="92" r="30"/><path d="M176 140c28 0 48 14 60 38"/>',
	trend: '<path d="M32 192l72-72 40 40 80-80"/><path d="M168 80h56v56"/>',
	retry: '<path d="M40 128a88 88 0 0 1 152-60l24 24"/><path d="M216 44v48h-48"/><path d="M216 128a88 88 0 0 1-152 60l-24-24"/><path d="M40 212v-48h48"/>',
	timer: '<circle cx="128" cy="140" r="80"/><path d="M128 140l32-32M104 32h48"/>',
	fork: '<circle cx="64" cy="60" r="24"/><circle cx="192" cy="60" r="24"/><circle cx="128" cy="204" r="24"/><path d="M64 84v12a24 24 0 0 0 24 24h80a24 24 0 0 0 24-24V84M128 120v60"/>',
	smile: '<circle cx="128" cy="128" r="96"/><path d="M92 104v4M164 104v4M84 152a52 52 0 0 0 88 0"/>',
	chat: '<path d="M40 56h176v120H100l-44 36v-36H40z"/>',
	bars: '<path d="M32 216h192"/><rect x="48" y="136" width="40" height="80" rx="4"/><rect x="108" y="96" width="40" height="120" rx="4"/><rect x="168" y="48" width="40" height="168" rx="4"/>',
	persona: '<circle cx="128" cy="92" r="48"/><path d="M44 216c16-44 48-68 84-68s68 24 84 68"/>',
	grid: '<rect x="44" y="44" width="72" height="72" rx="10"/><rect x="140" y="44" width="72" height="72" rx="10"/><rect x="44" y="140" width="72" height="72" rx="10"/><rect x="140" y="140" width="72" height="72" rx="10"/>',
	video: '<rect x="24" y="64" width="152" height="128" rx="14"/><path d="M176 112l56-32v96l-56-32"/>',
	idcard: '<rect x="24" y="48" width="208" height="160" rx="14"/><circle cx="92" cy="116" r="24"/><path d="M56 172c8-16 22-24 36-24s28 8 36 24M152 104h48M152 140h48"/>',
	target: '<circle cx="128" cy="128" r="96"/><circle cx="128" cy="128" r="56"/><circle cx="128" cy="128" r="14"/>',
	eye: '<path d="M16 128c40-72 184-72 224 0-40 72-184 72-224 0z"/><circle cx="128" cy="128" r="36"/>',
	coins: '<ellipse cx="104" cy="84" rx="72" ry="32"/><path d="M32 84v44c0 18 32 32 72 32s72-14 72-32V84"/><path d="M128 158c8 18 36 30 64 30 40 0 64-14 64-32v-44c0-16-22-28-52-31"/>',
	slot: '<rect x="32" y="40" width="192" height="176" rx="10"/><path d="M32 80h192"/><rect x="64" y="104" width="128" height="44" rx="4"/><path d="M64 176h80"/>'
};
var V2_CASE_ICONS = {
	'paperplane-studio': [ 'calendar', 'steps', 'cursor' ],
	'combina-antes': [ 'flag', 'chip', 'pulse' ],
	'research-hub': [ 'search', 'file', 'kanban' ],
	'lume': [ 'link', 'mic', 'users' ],
	'western-union-onboarding': [ 'trend', 'retry', 'timer' ],
	'will-bank-switching-the-brain': [ 'fork', 'smile', 'chat' ],
	'acordo-certo-homepage': [ 'bars', 'persona', 'grid' ],
	'fatal-model-perfis-ad': [ 'video', 'idcard', 'target' ],
	'bastidores-redesign': [ 'eye', 'coins', 'slot' ]
};

( function () {
	'use strict';
	var V2 = window.V2;
	var root = document.documentElement;
	if ( ! V2 || ! document.body.classList.contains( 'home' ) ) {
		return;
	}
	root.classList.add( 'v2-js' );
	var reduce = V2.reduce();
	var $ = function ( s, c ) {
		return ( c || document ).querySelector( s );
	};
	var $$ = function ( s, c ) {
		return [].slice.call( ( c || document ).querySelectorAll( s ) );
	};
	var fontsReady = document.fonts && document.fonts.ready ? document.fonts.ready : Promise.resolve();

	/* ---- section titles: mask reveal wrapper (Approach, Experience) ---- */
	function maskTitle( h2 ) {
		if ( ! h2 ) {
			return;
		}
		var line = document.createElement( 'span' );
		line.className = 'v2-ml';
		var inner = document.createElement( 'span' );
		while ( h2.firstChild ) {
			inner.appendChild( h2.firstChild );
		}
		line.appendChild( inner );
		h2.appendChild( line );
	}
	maskTitle( $( '#approach .section-head h2' ) );
	maskTitle( $( '#experience .xp-head h2' ) );

	/* ---- card metric icons ---- */
	$$( '.cases > .case-card' ).forEach( function ( card ) {
		var a = card.querySelector( '.case-link' );
		var slug = a ? ( a.getAttribute( 'href' ) || '' ).replace( /[?#].*$/, '' ).replace( /\/+$/, '' ).split( '/' ).pop() : '';
		var names = V2_CASE_ICONS[ slug ];
		if ( ! names ) {
			return;
		}
		card.querySelectorAll( '.metric' ).forEach( function ( m, i ) {
			var svg = V2_ICONS[ names[ i ] ];
			if ( ! svg || m.querySelector( '.v2-mi' ) ) {
				return;
			}
			var span = document.createElement( 'span' );
			span.className = 'v2-mi';
			span.setAttribute( 'aria-hidden', 'true' );
			span.innerHTML = '<svg viewBox="0 0 256 256" focusable="false">' + svg + '</svg>';
			m.insertBefore( span, m.firstChild );
		} );
	} );

	/* ---- hero ---- */
	var hero = $( '.hero' );
	var title = $( '.hero-title' );
	var heroB = $( '.hero-b' );

	// 1. headline: line-by-line mask reveal. The theme has already split the words (.w > .l);
	//    its layout pass (after fonts) adds the line breaks, so we read lines after that.
	var canIntro = ! reduce && title && title.querySelector( '.w' );
	if ( canIntro ) {
		root.classList.add( 'v2-intro' );
	}
	function assignLines() {
		var items = $$( '.w, .slot', title );
		var line = -1;
		var lastTop = null;
		var wi = 0;
		items.forEach( function ( w ) {
			var t = w.offsetTop;
			if ( null === lastTop || t > lastTop + 8 ) {
				line++;
				wi = 0;
				lastTop = t;
			}
			w.style.setProperty( '--li', line );
			w.style.setProperty( '--wi', wi++ );
			[].forEach.call( w.querySelectorAll( '.l,.slot-item' ), function ( l ) {
				l.style.setProperty( '--li', line );
				l.style.setProperty( '--wi', wi - 1 );
			} );
		} );
		return line + 1;
	}
	var introDone = false;
	function endIntro() {
		if ( introDone ) {
			return;
		}
		introDone = true;
		root.classList.remove( 'v2-intro', 'v2-go' );
	}
	if ( canIntro ) {
		setTimeout( endIntro, 4000 ); // safety: never leave the title hidden
		fontsReady.then( function () {
			requestAnimationFrame( function () {
				var lines = assignLines();
				void title.offsetWidth;
				root.classList.add( 'v2-go' );
				setTimeout( endIntro, 1150 + lines * 115 + 400 );
				setTimeout( startMaze, 650 + lines * 115 );
			} );
		} );
	} else {
		fontsReady.then( function () {
			startMaze();
		} );
	}

	// 2. the grey sentence fills to ink with the first scroll (idle once full)
	var soft = title ? $$( '.soft .w', title ) : [];
	if ( soft.length && ! reduce ) {
		var lastSoft = -1;
		V2.onScroll( function ( y, vh ) {
			var p = Math.round( V2.clamp( y / ( vh * 0.42 ), 0, 1 ) * 100 ) / 100;
			if ( p === lastSoft ) {
				return;
			}
			lastSoft = p;
			var n = soft.length;
			soft.forEach( function ( w, i ) {
				w.style.setProperty( '--f', V2.clamp( p * ( n + 1.5 ) - i, 0, 1 ).toFixed( 2 ) );
			} );
		} );
	}

	// 3. the maze, behind the content, inside the content column; the blue path solves once, then
	//    keeps wandering the corridors of the clear band above the headline (calm, ~1.3 cells/s)
	var maze = null;
	var host = null;
	var allowedFn = null;
	function buildMaze() {
		if ( ! hero || ! heroB || ! title ) {
			return;
		}
		if ( maze ) {
			maze.destroy();
		}
		if ( host ) {
			host.parentNode.removeChild( host );
		}
		var vw = document.documentElement.clientWidth;
		var mobile = vw < 861;
		var cell = mobile ? 22 : 28;
		var wrap = hero.querySelector( '.wrap' );
		var wr = wrap.getBoundingClientRect();
		var colRight = wr.right - ( parseFloat( getComputedStyle( wrap ).paddingRight ) || 0 );
		var right = Math.max( 0, Math.round( vw - colRight ) );
		var bw = mobile ? colRight : Math.min( colRight * 0.68, 1000 );
		var bottom = mobile ? ( title.offsetTop + title.offsetHeight + 40 ) : ( heroB.offsetTop + heroB.offsetHeight );
		var cols = Math.max( 6, Math.floor( bw / cell ) );
		var rows = Math.max( 6, Math.floor( bottom / cell ) );
		var hr = hero.getBoundingClientRect();
		var ox = colRight - cols * cell; // host left, viewport x
		var start = [ cols - 2, 2 ];
		var opts = function ( sd ) {
			return { cols: cols, rows: rows, cell: 10, scale: cell / 10, solPx: 1.7, inner: true, seed: sd, start: start,
				fade: mobile ? [ 0.2, 1 ] : [ 0.42, 1.02 ] };
		};
		var seed = 2017;
		var end = null;
		allowedFn = null;
		if ( ! mobile ) {
			// the clear band: above the headline, never behind a word, the avatar row or a status card
			var blocked = {};
			var firstLine = Infinity;
			// words when the theme has split them; the whole title box otherwise (e.g. reduced motion)
			var words = title.querySelector( '.w' ) ? $$( '.w, .slot', title ) : [ title ];
			words.concat( $$( '.hb-who img, .hb-who b, .hb-who span span, .hb-av li' ) ).forEach( function ( wd ) {
				var r = wd.getBoundingClientRect();
				if ( wd === title || wd.closest( '.hero-title' ) ) {
					firstLine = Math.min( firstLine, r.top );
				}
				var c0 = Math.max( 0, Math.floor( ( r.left - ox - 10 ) / cell ) );
				var c1 = Math.min( cols - 1, Math.floor( ( r.right - ox + 10 ) / cell ) );
				var r0 = Math.max( 0, Math.floor( ( r.top - hr.top - 6 ) / cell ) );
				var r1 = Math.min( rows - 1, Math.floor( ( r.bottom - hr.top + 6 ) / cell ) );
				for ( var y = r0; y <= r1; y++ ) {
					for ( var x = c0; x <= c1; x++ ) {
						blocked[ y * cols + x ] = 1;
					}
				}
			} );
			var maxRow = Math.floor( ( firstLine - hr.top ) / cell ) - 1;
			allowedFn = function ( x, y ) {
				return y >= 0 && y <= maxRow && x >= 0 && x < cols && ! blocked[ y * cols + x ];
			};
			// plan the first route: try seeds, keep the one that travels furthest across the band
			var best = -Infinity;
			var tmp = document.createElement( 'div' );
			for ( var sd = 1; sd <= 160; sd++ ) {
				var mz = V2.maze( tmp, opts( sd ) );
				tmp.textContent = '';
				for ( var ey = 2; ey <= maxRow; ey++ ) {
					for ( var ex = Math.floor( cols * 0.08 ); ex < cols * 0.55; ex++ ) {
						if ( ! allowedFn( ex, ey ) ) {
							continue;
						}
						var path = mz.route( ex, ey );
						if ( path.length < 20 || path.length > 64 ) {
							continue;
						}
						var ok = true;
						var minR = rows;
						var maxR = 0;
						var top0 = 0;
						for ( var k = 0; k < path.length; k++ ) {
							if ( ! allowedFn( path[ k ][ 0 ], path[ k ][ 1 ] ) ) {
								ok = false;
								break;
							}
							minR = Math.min( minR, path[ k ][ 1 ] );
							top0 += 0 === path[ k ][ 1 ] ? 1 : 0;
							maxR = Math.max( maxR, path[ k ][ 1 ] );
						}
						if ( ! ok ) {
							continue;
						}
						var score = ( start[ 0 ] - ex ) * 3 - path.length * 0.5 + ( maxR - minR ) * 3 + ey - top0 * 2.5;
						if ( score > best ) {
							best = score;
							seed = sd;
							end = [ ex, ey ];
						}
					}
				}
			}
		}
		if ( mobile ) {
			// mobile: the path only lives in the strip to the right of every line of text (title, name row)
			var textRight = 0;
			$$( '.hero-title .w, .hero-title .slot, .hb-who b, .hb-who span span' ).concat( [ title ] ).forEach( function ( e ) {
				[].slice.call( e.getClientRects() ).forEach( function ( r ) {
					if ( r.width && r.right < vw - 4 ) {
						textRight = Math.max( textRight, r.right );
					}
				} );
			} );
			var minCol = Math.min( cols - 2, Math.max( 0, Math.ceil( ( textRight - ox + 6 ) / cell ) ) );
			allowedFn = function ( x, y ) {
				return x >= minCol && x < cols && y >= 0 && y < rows;
			};
			var bestM = -Infinity;
			var tmpM = document.createElement( 'div' );
			for ( var sm = 1; sm <= 120; sm++ ) {
				var mm = V2.maze( tmpM, opts( sm ) );
				tmpM.textContent = '';
				for ( var my = Math.floor( rows * 0.4 ); my < rows - 1; my++ ) {
					for ( var mx = minCol; mx < cols; mx++ ) {
						var pth = mm.route( mx, my );
						var okm = pth.length >= 8;
						for ( var q = 0; okm && q < pth.length; q++ ) {
							okm = allowedFn( pth[ q ][ 0 ], pth[ q ][ 1 ] );
						}
						if ( okm && my - pth.length * 0.1 > bestM ) {
							bestM = my - pth.length * 0.1;
							seed = sm;
							end = [ mx, my ];
						}
					}
				}
			}
		}
		host = document.createElement( 'div' );
		host.className = 'v2-maze hero-maze' + ( mobile ? ' is-walls' : '' );
		host.setAttribute( 'aria-hidden', 'true' );
		host.style.width = cols * cell + 'px';
		host.style.height = rows * cell + 'px';
		host.style.right = right + 'px';
		hero.insertBefore( host, hero.firstChild );
		maze = V2.maze( host, opts( seed ) );
		maze.mobile = mobile;
		// mobile: the path stays in the strip right of the text (allowedFn above)
		maze.end = end;
	}
	var mazeStarted = false;
	var heroVisible = true;
	function wanderOpts() {
		// livelier: faster walks at a varying pace, short pauses, a longer tail and a ring on each arrival
		var mob = maze && maze.mobile;
		return { allowed: allowedFn, len: mob ? 14 : 18, speed: mob ? 2.4 : 3, seed: 29, firstWait: 700, vary: true, pulse: true,
			rest: function ( r ) {
				return 350 + r() * 900;
			} };
	}
	function startMaze() {
		if ( mazeStarted ) {
			return;
		}
		mazeStarted = true;
		buildMaze();
		if ( maze && maze.end ) {
			maze.solveTo( maze.end[ 0 ], maze.end[ 1 ], false, function () {
				maze.wander( wanderOpts() );
				syncRun();
			} );
		}
	}
	function syncRun() {
		if ( ! maze ) {
			return;
		}
		if ( heroVisible && ! document.hidden ) {
			maze.resume();
		} else {
			maze.pause();
		}
	}
	if ( hero ) {
		if ( 'IntersectionObserver' in window ) {
			new IntersectionObserver( function ( es ) {
				heroVisible = es[ 0 ].isIntersecting;
				syncRun();
			} ).observe( hero );
		}
		document.addEventListener( 'visibilitychange', syncRun );
		// click on empty hero space: the path walks there (only inside the clear band)
		hero.addEventListener( 'click', function ( e ) {
			if ( ! maze || maze.mobile || reduce || e.target.closest( 'a,button,input,.hb-av,.logos,.facts' ) ) {
				return;
			}
			if ( window.getSelection && String( window.getSelection() ) ) {
				return;
			}
			var c = maze.cellAt( e.clientX, e.clientY );
			if ( c ) {
				maze.goTo( c[ 0 ], c[ 1 ] );
			}
		} );
		var rz;
		var lastW = window.innerWidth;
		window.addEventListener( 'resize', function () {
			if ( Math.abs( window.innerWidth - lastW ) < 2 ) {
				return; // mobile toolbars: height only
			}
			lastW = window.innerWidth;
			clearTimeout( rz );
			rz = setTimeout( function () {
				if ( mazeStarted ) {
					buildMaze();
					if ( maze.end ) {
						maze.solveTo( maze.end[ 0 ], maze.end[ 1 ], true );
						maze.wander( wanderOpts() );
						syncRun();
					}
				}
			}, 200 );
		} );
	}

	// 4. facts count up once
	var facts = $$( '.fact b' );
	if ( facts.length && ! reduce && 'IntersectionObserver' in window ) {
		var io = new IntersectionObserver( function ( es ) {
			es.forEach( function ( e ) {
				if ( ! e.isIntersecting ) {
					return;
				}
				io.unobserve( e.target );
				var b = e.target;
				var txt = b.textContent;
				var m = txt.match( /^(\D*)(\d+)(.*)$/ );
				if ( ! m ) {
					return;
				}
				var to = parseInt( m[ 2 ], 10 );
				var t0 = performance.now();
				var dur = 1100 + to * 20;
				b.setAttribute( 'aria-label', txt );
				( function f( now ) {
					var k = V2.clamp( ( now - t0 ) / dur, 0, 1 );
					b.textContent = m[ 1 ] + Math.round( to * ( 1 - Math.pow( 1 - k, 4 ) ) ) + m[ 3 ];
					if ( k < 1 ) {
						requestAnimationFrame( f );
					} else {
						b.textContent = txt;
						b.removeAttribute( 'aria-label' );
					}
				} )( t0 );
			} );
		}, { threshold: 0.6 } );
		facts.forEach( function ( b ) {
			io.observe( b );
		} );
	}

	// 5. CTAs: restrained magnetic pull
	V2.magnet( $$( '.hero-ctas .btn' ), 6 );
} )();

/* 3.35 · Selected work: a card has a fixed height, so a long headline (the Portuguese ones above all)
   used to push the "Read case" button out of the card. Each title now steps its size down, only as far
   as needed, until everything in the card's text column fits. Runs again when fonts load or the window
   changes size. */
( function () {
	'use strict';
	var cards = [].slice.call( document.querySelectorAll( '.cases > .case-card' ) );
	if ( ! cards.length ) {
		return;
	}
	function fit() {
		cards.forEach( function ( card ) {
			var body = card.querySelector( '.case-body' );
			var title = card.querySelector( '.case-title' );
			if ( ! body || ! title ) {
				return;
			}
			title.style.fontSize = '';
			if ( body.scrollHeight - body.clientHeight <= 1 ) {
				return;
			}
			var base = parseFloat( getComputedStyle( title ).fontSize ) || 0;
			for ( var f = 0.94; base && f >= 0.52; f -= 0.06 ) {
				title.style.fontSize = ( base * f ).toFixed( 1 ) + 'px';
				if ( body.scrollHeight - body.clientHeight <= 1 ) {
					break;
				}
			}
		} );
	}
	var t = 0;
	function later() {
		clearTimeout( t );
		t = setTimeout( fit, 120 );
	}
	fit();
	window.addEventListener( 'load', fit );
	window.addEventListener( 'resize', later );
	if ( document.fonts && document.fonts.ready ) {
		document.fonts.ready.then( fit );
	}
} )();
