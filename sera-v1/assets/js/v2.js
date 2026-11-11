/* Sera v2 · shared layer (home + case). Vanilla, progressive: nothing is hidden unless this runs. */
( function () {
	'use strict';
	var root = document.documentElement;
	var V2 = window.V2 = window.V2 || {};
	var rmq = window.matchMedia( '(prefers-reduced-motion: reduce)' );
	var fine = window.matchMedia( '(hover: hover) and (pointer: fine)' );
	V2.reduce = function () {
		return rmq.matches;
	};
	V2.fine = function () {
		return fine.matches;
	};
	V2.clamp = function ( v, a, b ) {
		return Math.max( a, Math.min( b, v ) );
	};
	var SVGNS = 'http://www.w3.org/2000/svg';
	function el( name, attrs, parent ) {
		var n = document.createElementNS( SVGNS, name );
		for ( var k in attrs ) {
			n.setAttribute( k, attrs[ k ] );
		}
		if ( parent ) {
			parent.appendChild( n );
		}
		return n;
	}

	/* ---- one rAF-gated scroll loop that other parts subscribe to ---- */
	var subs = [];
	var queued = false;
	function tick() {
		queued = false;
		var y = window.scrollY;
		var vh = window.innerHeight;
		var max = Math.max( 1, root.scrollHeight - vh );
		for ( var i = 0; i < subs.length; i++ ) {
			subs[ i ]( y, vh, max );
		}
	}
	V2.onScroll = function ( fn ) {
		subs.push( fn );
		fn( window.scrollY, window.innerHeight, Math.max( 1, root.scrollHeight - window.innerHeight ) );
	};
	function queue() {
		if ( ! queued ) {
			queued = true;
			requestAnimationFrame( tick );
		}
	}
	window.addEventListener( 'scroll', queue, { passive: true } );
	window.addEventListener( 'resize', queue, { passive: true } );
	window.addEventListener( 'load', queue );

	/* ---- seeded random + maze (depth-first backtracker) ---- */
	function rng( seed ) {
		var s = seed >>> 0;
		return function () {
			s = ( s + 0x6D2B79F5 ) >>> 0;
			var t = s;
			t = Math.imul( t ^ ( t >>> 15 ), t | 1 );
			t ^= t + Math.imul( t ^ ( t >>> 7 ), t | 61 );
			return ( ( t ^ ( t >>> 14 ) ) >>> 0 ) / 4294967296;
		};
	}
	V2.rng = rng;
	// walls bitmask per cell: 1 N, 2 E, 4 S, 8 W
	function carve( cols, rows, seed ) {
		var r = rng( seed );
		var n = cols * rows;
		var w = new Uint8Array( n ).fill( 15 );
		var seen = new Uint8Array( n );
		var stack = [ Math.floor( r() * n ) ];
		seen[ stack[ 0 ] ] = 1;
		var D = [ [ 0, -1, 1, 4 ], [ 1, 0, 2, 8 ], [ 0, 1, 4, 1 ], [ -1, 0, 8, 2 ] ];
		while ( stack.length ) {
			var c = stack[ stack.length - 1 ];
			var x = c % cols;
			var y = ( c - x ) / cols;
			var opts = [];
			for ( var d = 0; d < 4; d++ ) {
				var nx = x + D[ d ][ 0 ];
				var ny = y + D[ d ][ 1 ];
				if ( nx >= 0 && ny >= 0 && nx < cols && ny < rows && ! seen[ ny * cols + nx ] ) {
					opts.push( d );
				}
			}
			if ( ! opts.length ) {
				stack.pop();
				continue;
			}
			var k = opts[ Math.floor( r() * opts.length ) ];
			var nc = ( y + D[ k ][ 1 ] ) * cols + x + D[ k ][ 0 ];
			w[ c ] &= ~D[ k ][ 2 ];
			w[ nc ] &= ~D[ k ][ 3 ];
			seen[ nc ] = 1;
			stack.push( nc );
		}
		return w;
	}
	// breadth-first search; returns { order: [[from,to]...], path: [cells] }
	function search( w, cols, rows, a, b ) {
		var n = cols * rows;
		var prev = new Int32Array( n ).fill( -1 );
		prev[ a ] = a;
		var q = [ a ];
		var order = [];
		var D = [ [ 1, -cols ], [ 2, 1 ], [ 4, cols ], [ 8, -1 ] ];
		for ( var h = 0; h < q.length; h++ ) {
			var c = q[ h ];
			if ( c === b ) {
				break;
			}
			for ( var d = 0; d < 4; d++ ) {
				if ( w[ c ] & D[ d ][ 0 ] ) {
					continue;
				}
				var cx0 = c % cols;
				if ( ( 1 === d && cx0 === cols - 1 ) || ( 3 === d && 0 === cx0 ) ) {
					continue;
				}
				var nc = c + D[ d ][ 1 ];
				if ( nc < 0 || nc >= n || prev[ nc ] !== -1 ) {
					continue;
				}
				prev[ nc ] = c;
				order.push( [ c, nc ] );
				q.push( nc );
			}
		}
		var path = [];
		if ( b >= 0 && prev[ b ] !== -1 ) {
			for ( var p = b; p !== a; p = prev[ p ] ) {
				path.push( p );
			}
			path.push( a );
			path.reverse();
		}
		return { order: order, path: path };
	}

	/* V2.maze( host, { cols, rows, cell, seed, start:[x,y], end:[x,y], open:'right'|'top'… } )
	   Builds the SVG (hairline walls + flood + solution) inside host. Returns a controller. */
	var uid = 0;
	/* V2.maze( host, { cols, rows, cell, seed, start:[x,y], inner, fade:[a,b], scale, solPx } )
	   Two stacked SVGs in host: a static one with the (masked) hairline walls, and a light one with the
	   route, the markers and the wandering path, so per-frame changes never repaint the walls. */
	V2.maze = function ( host, o ) {
		var cols = o.cols;
		var rows = o.rows;
		var s = o.cell || 10;
		var w = carve( cols, rows, o.seed || 7 );
		var W = cols * s;
		var H = rows * s;
		var vb = { viewBox: '0 0 ' + W + ' ' + H, preserveAspectRatio: 'xMaxYMin meet', 'aria-hidden': 'true', focusable: 'false' };
		var svg = el( 'svg', vb );
		var svg2 = el( 'svg', vb );
		svg2.setAttribute( 'class', 'mz-top' );
		var idx = function ( x, y ) {
			return y * cols + x;
		};
		var start = idx( o.start[ 0 ], o.start[ 1 ] );
		// walls: north + west of every cell (+ outer edges unless inner), merged into runs
		var d = '';
		var y, x, run;
		var inner = !! o.inner;
		for ( y = inner ? 1 : 0; y <= ( inner ? rows - 1 : rows ); y++ ) {
			run = -1;
			for ( x = 0; x <= cols; x++ ) {
				var on = x < cols && ( y < rows ? ( w[ idx( x, y ) ] & 1 ) : ( w[ idx( x, rows - 1 ) ] & 4 ) );
				if ( on && run < 0 ) {
					run = x;
				} else if ( ! on && run >= 0 ) {
					d += 'M' + run * s + ' ' + y * s + 'H' + x * s;
					run = -1;
				}
			}
		}
		for ( x = inner ? 1 : 0; x <= ( inner ? cols - 1 : cols ); x++ ) {
			run = -1;
			for ( y = 0; y <= rows; y++ ) {
				var onv = y < rows && ( x < cols ? ( w[ idx( x, y ) ] & 8 ) : ( w[ idx( cols - 1, y ) ] & 2 ) );
				if ( onv && run < 0 ) {
					run = y;
				} else if ( ! onv && run >= 0 ) {
					d += 'M' + x * s + ' ' + run * s + 'V' + y * s;
					run = -1;
				}
			}
		}
		var walls = el( 'path', { class: 'mz-walls', d: d }, svg );
		if ( o.fade ) {
			var defs = el( 'defs', {}, svg );
			var id = 'v2mz' + ( ++uid );
			var g = el( 'radialGradient', { id: id + 'g', cx: '1', cy: '0', r: '1', fx: '1', fy: '0' }, defs );
			el( 'stop', { offset: o.fade[ 0 ], 'stop-color': '#fff' }, g );
			el( 'stop', { offset: Math.min( 1, o.fade[ 1 ] ), 'stop-color': '#fff', 'stop-opacity': o.fade[ 1 ] > 1 ? String( 1 - 1 / o.fade[ 1 ] ) : '0' }, g );
			var m = el( 'mask', { id: id, maskUnits: 'userSpaceOnUse', x: 0, y: 0, width: W, height: H }, defs );
			el( 'rect', { x: 0, y: 0, width: W, height: H, fill: 'url(#' + id + 'g)' }, m );
			walls.setAttribute( 'mask', 'url(#' + id + ')' );
		}
		var flood = el( 'path', { class: 'mz-flood', d: '' }, svg2 );
		var sol = el( 'path', { class: 'mz-sol', d: '', pathLength: '1' }, svg2 );
		var snake = el( 'path', { class: 'mz-snake', d: '' }, svg2 );
		var sw = ( ( o.solPx || 1.6 ) / ( o.scale || 1 ) ).toFixed( 3 );
		sol.style.strokeWidth = sw;
		snake.style.strokeWidth = sw;
		var head = el( 'g', {}, svg2 );
		var ring = el( 'circle', { class: 'mz-b-ring', r: s * 0.16, cx: 0, cy: 0 }, head );
		var dot = el( 'circle', { class: 'mz-b', r: s * 0.16, cx: 0, cy: 0 }, head );
		var cxy = function ( c ) {
			var cx = c % cols;
			return [ ( cx + 0.5 ) * s, ( ( c - cx ) / cols + 0.5 ) * s ];
		};
		var sp = cxy( start );
		el( 'rect', { class: 'mz-a', x: sp[ 0 ] - s * 0.14, y: sp[ 1 ] - s * 0.14, width: s * 0.28, height: s * 0.28 }, svg2 );
		host.appendChild( svg );
		host.appendChild( svg2 );
		function placeDot( px, py ) {
			head.setAttribute( 'transform', 'translate(' + px.toFixed( 2 ) + ' ' + py.toFixed( 2 ) + ')' );
		}
		var cellsD = function ( cells ) {
			return 'M' + cells.map( function ( c ) {
				return cxy( c ).join( ' ' );
			} ).join( ' L' );
		};

		var timer = 0;
		var raf = 0;
		var gen = 0;
		var solved = null; // cells of the last solved route
		function solveTo( tx, ty, instant, done ) {
			var b = idx( V2.clamp( tx, 0, cols - 1 ), V2.clamp( ty, 0, rows - 1 ) );
			var res = search( w, cols, rows, start, b );
			var my = ++gen;
			cancelAnimationFrame( raf );
			clearTimeout( timer );
			host.classList.remove( 'is-solved' );
			var bp = cxy( b );
			placeDot( bp[ 0 ], bp[ 1 ] );
			solved = res.path;
			var pd = cellsD( res.path );
			snake.setAttribute( 'd', '' );
			sol.style.display = '';
			var finish = function () {
				if ( my === gen ) {
					host.classList.add( 'is-solved' );
					if ( done ) {
						done();
					}
				}
			};
			if ( instant || V2.reduce() ) {
				flood.setAttribute( 'd', '' );
				sol.style.transition = 'none';
				sol.setAttribute( 'd', pd );
				sol.style.strokeDashoffset = '0';
				finish();
				return;
			}
			// 1. flood the corridors (search order), 2. draw the answer
			flood.classList.remove( 'is-fading' );
			flood.setAttribute( 'd', '' );
			sol.style.transition = 'none';
			sol.style.strokeDashoffset = '1';
			var segs = res.order;
			var total = segs.length;
			var dur = V2.clamp( total * 1.1, 500, 1100 );
			var t0 = 0;
			var k0 = 0;
			var acc = '';
			function step( now ) {
				if ( my !== gen ) {
					return;
				}
				if ( ! t0 ) {
					t0 = now;
				}
				var k = V2.clamp( ( now - t0 ) / dur, 0, 1 );
				var upto = Math.floor( total * ( 1 - Math.pow( 1 - k, 1.6 ) ) );
				for ( ; k0 < upto; k0++ ) {
					var p1 = cxy( segs[ k0 ][ 0 ] );
					var p2 = cxy( segs[ k0 ][ 1 ] );
					acc += 'M' + p1[ 0 ] + ' ' + p1[ 1 ] + 'L' + p2[ 0 ] + ' ' + p2[ 1 ];
				}
				flood.setAttribute( 'd', acc );
				if ( k < 1 ) {
					raf = requestAnimationFrame( step );
					return;
				}
				sol.setAttribute( 'd', pd );
				void sol.getBoundingClientRect();
				var ms = V2.clamp( res.path.length * 22, 700, 1500 );
				sol.style.transition = 'stroke-dashoffset ' + ms + 'ms cubic-bezier(.45,0,.2,1)';
				sol.style.strokeDashoffset = '0';
				flood.classList.add( 'is-fading' );
				timer = setTimeout( finish, ms - 120 );
			}
			raf = requestAnimationFrame( step );
		}

		/* ---- wander: after a solve, the route becomes a fixed-length path that keeps walking the
		   corridors to new reachable cells (only cells allowed(x, y) says yes to), calm and slow.
		   Only the dash offset of one path and the transform of the head dot change per frame. */
		var wd = null;
		function wander( opt ) {
			if ( V2.reduce() || ! solved || solved.length < 2 ) {
				return;
			}
			var allowed = opt.allowed || function () {
				return true;
			};
			var L = ( opt.len || 12 ) * s;
			var speed = opt.speed || 1.3; // cells per second
			var r = rng( ( opt.seed || 11 ) >>> 0 );
			var okCell = function ( c ) {
				return allowed( c % cols, Math.floor( c / cols ) );
			};
			var okRoute = function ( p ) {
				for ( var i = 0; i < p.length; i++ ) {
					if ( ! okCell( p[ i ] ) ) {
						return false;
					}
				}
				return true;
			};
			wd = {
				trail: solved.slice(),
				win: ( solved.length - 1 ) * s,
				j: null,
				wait: opt.firstWait || 1400,
				queued: null,
				run: true,
				last: 0,
				visible: true
			};
			sol.style.display = 'none';
			ring.style.display = 'none';
			function pickTarget( from ) {
				for ( var tries = 0; tries < 80; tries++ ) {
					var c = Math.floor( r() * cols * rows );
					if ( c === from || ! okCell( c ) ) {
						continue;
					}
					var p = search( w, cols, rows, from, c ).path;
					var prev = wd.trail.length > 1 ? wd.trail[ wd.trail.length - 2 ] : -1;
					// prefer routes that carry on forward; turning back is allowed only late
					if ( p.length >= 6 && p.length <= 28 && okRoute( p ) && ( tries > 60 || p[ 1 ] !== prev ) ) {
						return p;
					}
				}
				// fall back: walk back the way we came
				var back = wd.trail.slice( Math.max( 0, wd.trail.length - 14 ) ).reverse();
				return back.length > 1 ? back : null;
			}
			function startJourney( path ) {
				var keep = Math.ceil( Math.max( wd.win, L ) / s ) + 1;
				var tail = wd.trail.slice( Math.max( 0, wd.trail.length - keep ) );
				var cells = tail.concat( path.slice( 1 ) );
				snake.setAttribute( 'd', cellsD( cells ) );
				var total = ( cells.length - 1 ) * s;
				snake.style.strokeDasharray = '0 ' + ( total + L * 4 );
				wd.j = {
					cells: cells,
					total: total,
					from: ( tail.length - 1 ) * s, // head distance at start
					to: total,
					pos: ( tail.length - 1 ) * s,
					t: 0,
					win0: wd.win
				};
			}
			function draw() {
				var j = wd.j;
				var win = wd.win;
				var a = Math.max( 0, j.pos - win );
				snake.style.strokeDasharray = ( j.pos - a ).toFixed( 2 ) + ' ' + ( j.total + L * 4 ).toFixed( 0 );
				snake.style.strokeDashoffset = ( -a ).toFixed( 2 );
				var pt = snake.getPointAtLength( j.pos );
				placeDot( pt.x, pt.y );
			}
			// hand over from the solved route without a visible change
			startJourney( [ wd.trail[ wd.trail.length - 1 ] ] );
			draw();
			function frame( now ) {
				if ( ! wd.run ) {
					return;
				}
				var dt = wd.last ? Math.min( 0.05, ( now - wd.last ) / 1000 ) : 0;
				wd.last = now;
				var j = wd.j;
				if ( j.pos >= j.to - 0.001 ) {
					// resting between walks
					wd.wait -= dt * 1000;
					if ( wd.wait <= 0 || wd.queued ) {
						var head = j.cells[ j.cells.length - 1 ];
						wd.trail = j.cells;
						var p = wd.gather ? wd.gather : ( wd.queued ? wd.queued( head ) : pickTarget( head ) );
						wd.queued = null;
						if ( p && p.length > 1 ) {
							var back = wd.trail.length > 1 && p[ 1 ] === wd.trail[ wd.trail.length - 2 ];
							if ( back && wd.win > s * 0.05 ) {
								// turning back into its own line: first draw the tail in to the head
								if ( ! wd.gather ) {
									wd.gRate = Math.max( speed * 1.4, wd.win / s / 2.4 ) * s;
								}
								wd.gather = p;
								wd.win = Math.max( 0, wd.win - wd.gRate * dt );
								draw();
								wd.raf = requestAnimationFrame( frame );
								return;
							}
							if ( back ) {
								wd.trail = [ head ];
								wd.win = L;
							}
							wd.gather = null;
							startJourney( p );
						}
						wd.wait = 1600 + r() * 2200;
					}
				} else {
					// constant calm pace, eased in and out over the first / last cell
					j.t += dt;
					var remain = ( j.to - j.pos ) / s;
					var v = speed * Math.max( 0.12, Math.min( 1, j.t / 0.8, Math.sqrt( remain / 1.1 ) ) );
					j.pos = Math.min( j.to, j.pos + v * s * dt );
					// the visible length settles to L during the first walk
					if ( wd.win !== L ) {
						var k = V2.clamp( ( j.pos - j.from ) / Math.max( s, j.to - j.from ), 0, 1 );
						wd.win = j.win0 + ( L - j.win0 ) * ( k * k * ( 3 - 2 * k ) );
						if ( k >= 1 ) {
							wd.win = L;
						}
					}
					draw();
				}
				wd.raf = requestAnimationFrame( frame );
			}
			wd.raf = requestAnimationFrame( frame );
			wd.restart = function () {
				wd.raf = requestAnimationFrame( frame );
			};
			wd.goTo = function ( tx, ty ) {
				var t = idx( tx, ty );
				if ( ! okCell( t ) ) {
					return false;
				}
				// stop at the next cell, then walk to the target
				var j = wd.j;
				var nextI = Math.min( j.cells.length - 1, Math.ceil( j.pos / s - 1e-6 ) );
				j.to = nextI * s;
				j.cells = j.cells.slice( 0, nextI + 1 );
				wd.queued = function ( from ) {
					var p = search( w, cols, rows, from, t ).path;
					return okRoute( p ) ? p : null;
				};
				return true;
			};
		}
		return {
			svg: svg,
			cols: cols,
			rows: rows,
			solveTo: solveTo,
			wander: function ( opt ) {
				wander( opt );
			},
			pause: function () {
				if ( wd && wd.run ) {
					wd.run = false;
					cancelAnimationFrame( wd.raf );
				}
			},
			resume: function () {
				if ( wd && ! wd.run ) {
					wd.run = true;
					wd.last = 0;
					wd.restart();
				}
			},
			goTo: function ( tx, ty ) {
				return wd && wd.goTo ? wd.goTo( tx, ty ) : false;
			},
			destroy: function () {
				gen++;
				cancelAnimationFrame( raf );
				clearTimeout( timer );
				if ( wd ) {
					wd.run = false;
					cancelAnimationFrame( wd.raf );
				}
			},
			route: function ( tx, ty ) {
				return search( w, cols, rows, start, idx( tx, ty ) ).path.map( function ( c ) {
					return [ c % cols, Math.floor( c / cols ) ];
				} );
			},
			cellAt: function ( clientX, clientY ) {
				var rr = svg.getBoundingClientRect();
				var sc = rr.width / W;
				var ox = rr.right - W * sc; // xMax alignment
				var cx = Math.floor( ( clientX - ox ) / ( s * sc ) );
				var cy = Math.floor( ( clientY - rr.top ) / ( s * sc ) );
				return ( cx < 0 || cy < 0 || cx >= cols || cy >= rows ) ? null : [ cx, cy ];
			}
		};
	};

	/* ---- header: reading progress on the pill (CSS scroll timeline where supported, else here) ---- */
	var header = document.querySelector( '.site-header' );
	// dark tint as a real element: iOS Safari does not always repaint a backdrop-filtered ::before
	// when only its background changes, which left light text on a light pill over dark sections.
	if ( header && ! header.querySelector( '.v2-pill-tint' ) ) {
		var tint = document.createElement( 'span' );
		tint.className = 'v2-pill-tint';
		tint.setAttribute( 'aria-hidden', 'true' );
		header.insertBefore( tint, header.firstChild );
	}
	var cssProgress = window.CSS && CSS.supports && CSS.supports( 'animation-timeline: scroll()' );
	if ( header && ( ! cssProgress || V2.reduce() ) ) {
		var lastP = -1;
		V2.onScroll( function ( y, vh, max ) {
			var p = Math.round( V2.clamp( y / max, 0, 1 ) * 1000 ) / 1000;
			if ( p !== lastP ) {
				lastP = p;
				header.style.setProperty( '--v2-p', p );
			}
		} );
	}

	/* ---- header pill: dark over dark blocks ----
	   Blocks are measured once (and on resize / page growth): large painted elements, each classed
	   dark or light from its OWN background. The pill is dark while its vertical centre is inside a
	   dark block; whatever passes behind it (chips, phone screens) never matters. Hysteresis: the
	   state flips only when the centre is a few px past an edge. */
	if ( header ) {
		var lum = function ( r, g, b ) {
			return 0.2126 * r / 255 + 0.7152 * g / 255 + 0.0722 * b / 255;
		};
		var ownTone = function ( e ) {
			var cs = getComputedStyle( e );
			var v = cs.backgroundColor.match( /[\d.]+/g );
			if ( v && ( v.length < 4 || +v[ 3 ] >= 0.5 ) ) {
				return lum( +v[ 0 ], +v[ 1 ], +v[ 2 ] );
			}
			var gi = cs.backgroundImage || '';
			if ( gi.indexOf( 'gradient' ) < 0 ) {
				return null;
			}
			// the bottom layer decides, and only when it paints a full surface (no transparent stops:
			// stars and glows on top do not count)
			var depth = 0;
			var cut = 0;
			for ( var ci = 0; ci < gi.length; ci++ ) {
				var ch0 = gi.charAt( ci );
				if ( '(' === ch0 ) {
					depth++;
				} else if ( ')' === ch0 ) {
					depth--;
				} else if ( ',' === ch0 && 0 === depth ) {
					cut = ci + 1;
				}
			}
			gi = gi.slice( cut );
			if ( /transparent/.test( gi ) || /url\(/.test( gi ) ) {
				return null;
			}
			var m = gi.match( /rgba?\([^)]+\)|#[0-9a-f]{3,8}\b/gi ) || [];
			var acc = 0;
			var n = 0;
			m.forEach( function ( c ) {
				var r;
				var g;
				var b;
				var a = 1;
				if ( '#' === c.charAt( 0 ) ) {
					var hx = c.slice( 1 );
					if ( hx.length < 6 ) {
						hx = hx.split( '' ).map( function ( ch ) {
							return ch + ch;
						} ).join( '' );
					}
					r = parseInt( hx.slice( 0, 2 ), 16 );
					g = parseInt( hx.slice( 2, 4 ), 16 );
					b = parseInt( hx.slice( 4, 6 ), 16 );
				} else {
					var q = c.match( /[\d.]+/g ).map( parseFloat );
					r = q[ 0 ];
					g = q[ 1 ];
					b = q[ 2 ];
					a = q.length > 3 ? q[ 3 ] : 1;
				}
				if ( a < 0.5 ) {
					n = -999;
					return;
				}
				acc += lum( r, g, b );
				n++;
			} );
			return n > 0 ? acc / n : null;
		};
		var blocks = [];
		var measure = V2._measure = function () {
			var vw = document.documentElement.clientWidth;
			var sy = window.scrollY;
			blocks = [];
			var list = document.querySelectorAll( 'main *, .site-footer, main, body' );
			for ( var i = 0; i < list.length; i++ ) {
				var e = list[ i ];
				if ( e.closest( '.site-header, .cases, svg, input, button, select, textarea, img, video, canvas, iframe' ) ) {
					continue;
				}
				var r = e.getBoundingClientRect();
				if ( ( r.width < vw * 0.7 && e !== document.body ) || r.height < 120 ) {
					continue;
				}
				var tone = ownTone( e );
				if ( null === tone || ( tone > 0.3 && tone < 0.6 ) ) {
					continue;
				}
				blocks.push( { top: r.top + sy, bottom: r.bottom + sy, dark: tone <= 0.3 } );
			}
		};
		V2._blocks = function () {
			return blocks;
		};
		// tone at a document y: the last (innermost / latest) block containing it wins
		var toneAt = function ( y ) {
			var dark = false;
			for ( var i = 0; i < blocks.length; i++ ) {
				if ( y >= blocks[ i ].top && y < blocks[ i ].bottom ) {
					dark = blocks[ i ].dark;
				}
			}
			return dark;
		};
		var isDark = false;
		var check = function ( y ) {
			var hb = header.getBoundingClientRect();
			var c = y + hb.top + hb.height / 2;
			var a = toneAt( c - 6 );
			var b = toneAt( c + 6 );
			if ( a === b && a !== isDark ) {
				isDark = a;
				// menu fixo em vidro claro: não troca mais de cor sobre blocos escuros (3.22.0)
			}
		};
		var remeasure = function () {
			measure();
			check( window.scrollY );
		};
		remeasure();
		window.addEventListener( 'load', remeasure );
		var rmT;
		var debounced = function () {
			clearTimeout( rmT );
			rmT = setTimeout( remeasure, 180 );
		};
		window.addEventListener( 'resize', debounced );
		if ( window.ResizeObserver ) {
			new ResizeObserver( debounced ).observe( document.body );
		}
		V2.onScroll( check );
	}

	/* ---- magnetic pull, restrained (max ~6px), fine pointers only ---- */
	V2.magnet = function ( nodes, strength ) {
		if ( V2.reduce() || ! V2.fine() ) {
			return;
		}
		[].forEach.call( nodes, function ( n ) {
			if ( ! n ) {
				return;
			}
			n.classList.add( 'v2-mag' );
			n.addEventListener( 'pointermove', function ( e ) {
				var r = n.getBoundingClientRect();
				var dx = ( e.clientX - ( r.left + r.width / 2 ) ) / ( r.width / 2 );
				var dy = ( e.clientY - ( r.top + r.height / 2 ) ) / ( r.height / 2 );
				var k = strength || 6;
				n.style.translate = ( dx * k ).toFixed( 2 ) + 'px ' + ( dy * k * 0.6 ).toFixed( 2 ) + 'px';
			} );
			n.addEventListener( 'pointerleave', function () {
				n.style.translate = '';
			} );
		} );
	};

	/* ---- footer: the maze wordmark as a background layer (right half, faded to the left) ---- */
	var footer = document.querySelector( '.site-footer' );
	var logo = document.querySelector( '.site-header .brand svg, .site-footer .brand svg' );
	if ( footer && logo ) {
		var wm = document.createElement( 'div' );
		wm.className = 'v2-wm';
		wm.setAttribute( 'aria-hidden', 'true' );
		var copy = logo.cloneNode( true );
		copy.removeAttribute( 'role' );
		copy.removeAttribute( 'aria-label' );
		copy.setAttribute( 'aria-hidden', 'true' );
		copy.setAttribute( 'focusable', 'false' );
		wm.appendChild( copy );
		footer.insertBefore( wm, footer.firstChild );
		if ( ! V2.reduce() ) {
			var lastWm = -1;
			V2.onScroll( function ( y, vh, max ) {
				var p = Math.round( V2.clamp( ( max - y ) / ( vh * 0.9 ), 0, 1 ) * 200 ) / 200;
				if ( p !== lastWm ) {
					lastWm = p;
					wm.style.setProperty( '--v2-wm', p );
				}
			} );
		}
		V2.magnet( footer.querySelectorAll( '.footer-mail' ), 5 );
	}
} )();
