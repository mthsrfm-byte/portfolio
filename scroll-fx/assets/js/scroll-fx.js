/* Sera v.1 · scroll-fx
   Scroll com peso de verdade, na linha do 14islands.com (Lenis + imagens em WebGL que dobram com a
   velocidade): aqui sem biblioteca e sem WebGL, porque as mídias do portfólio são mockups em HTML.

   1. Texto que acende com a rolagem: cada palavra sai do cinza e chega na cor final conforme o
      parágrafo atravessa a tela (lead dos cases, "Sobre" da home, statements).
   2. Mídia com peso: os quadros (topo do case, mockups, próximo case, imagens e vídeos) atrasam um
      pouco, esticam e curvam a borda de trás conforme a velocidade da rolagem, e voltam com mola
      quando ela para.
   3. Paralaxe dentro do quadro: o conteúdo do quadro anda mais devagar que o quadro e entra com um
      leve zoom de saída.

   Só usa `translate`, `scale` e `clip-path` (nunca `transform`), então não briga com o `.reveal`, com
   a animação dos cards da home nem com o hover dos mockups. Mídia e paralaxe só rodam quando o smooth scroll do tema está ligado
   (`html.has-smooth`: mouse/trackpad), porque ali a rolagem anda no mesmo quadro que estes efeitos;
   no toque, só o texto. Com `prefers-reduced-motion`, nada roda e tudo fica no estado final.

   Opt-in em qualquer bloco: `data-sfx-text`, `data-sfx-media`, `data-sfx-parallax`, `data-sfx-drift`.
   Opt-out: `data-sfx-off` no elemento ou num ancestral. */
( function () {
	'use strict';

	var root = document.documentElement;
	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' );
	if ( ! window.requestAnimationFrame || ! document.querySelectorAll || ( reduce && reduce.matches ) ) {
		return;
	}

	var CFG = {
		text: '.case-content p.lead, .about-text, .statement > p, [data-sfx-text]',
		textMin: 0.16, // opacidade da palavra ainda "apagada"
		textSpread: 9, // quantas palavras a borda do degradê ocupa
		media: '.case-hero-visual, .sera-mockup-block, .next-thumb, .case-content .wp-block-image, .case-content .wp-block-video, [data-sfx-media]',
		// imagem/vídeo (e o mini card do próximo case): anda dentro do quadro com zoom de cobertura
		parallax: '.case-hero-visual > img.cover, .next-thumb > :first-child, .case-content .wp-block-image img, .case-content .wp-block-video video, [data-sfx-parallax]',
		// mockups em HTML: só o conteúdo desliza; fundo e selo da marca ficam no lugar
		drift: '.case-hero-visual .mockup-stage > :not(.brand-chip), [data-sfx-drift]',
		lag: 22, // px que o quadro atrasa na velocidade máxima
		stretch: 0.045, // quanto estica (scaleY) na velocidade máxima
		curve: 34, // px de curva na borda de trás na velocidade máxima (0 desliga a curva)
		vMax: 70, // px por quadro (60 fps) que contam como "velocidade máxima"
		damp: 0.14, // mola da velocidade (menor = volta mais devagar)
		depth: 0.045, // paralaxe: fração da altura do quadro
		zoom: 0.07, // zoom extra na entrada (imagem/vídeo)
		driftDepth: 0.035, // paralaxe dos mockups em HTML
		driftZoom: 0.04 // zoom extra na entrada dos mockups em HTML
	};

	function off( el ) {
		return !! ( el.closest && el.closest( '[data-sfx-off]' ) );
	}
	function clamp( v, a, b ) {
		return v < a ? a : v > b ? b : v;
	}
	function all( sel ) {
		return [].filter.call( document.querySelectorAll( sel ), function ( el ) {
			return ! off( el );
		} );
	}

	/* ---------- 1. texto ---------- */
	function split( el ) {
		if ( el.hasAttribute( 'data-sfx-split' ) ) {
			return el.sfxWords || [];
		}
		el.setAttribute( 'data-sfx-split', '' );
		var walker = document.createTreeWalker( el, NodeFilter.SHOW_TEXT, null );
		var nodes = [];
		for ( var n = walker.nextNode(); n; n = walker.nextNode() ) {
			if ( n.nodeValue.trim() ) {
				nodes.push( n );
			}
		}
		var words = [];
		nodes.forEach( function ( node ) {
			var frag = document.createDocumentFragment();
			node.nodeValue.split( /(\s+)/ ).forEach( function ( part ) {
				if ( ! part ) {
					return;
				}
				if ( /^\s+$/.test( part ) ) {
					frag.appendChild( document.createTextNode( part ) );
					return;
				}
				var s = document.createElement( 'span' );
				s.className = 'sfx-w';
				s.textContent = part;
				frag.appendChild( s );
				words.push( s );
			} );
			node.parentNode.replaceChild( frag, node );
		} );
		el.sfxWords = words;
		return words;
	}

	var texts = all( CFG.text ).map( function ( el ) {
		var words = split( el );
		return { el: el, words: words, last: [] };
	} ).filter( function ( t ) {
		return t.words.length > 2;
	} );

	/* ---------- 2 e 3. mídia e paralaxe ---------- */
	var motion = root.classList.contains( 'has-smooth' );
	var medias = [];
	var layers = [];
	if ( motion ) {
		medias = all( CFG.media ).filter( function ( el ) {
			// cenas presas na rolagem (tour, Duo) são altas: ficam paradas
			return el.offsetHeight < window.innerHeight * 1.5 && ! el.querySelector( '[data-sfx-off]' );
		} ).map( function ( el ) {
			return { el: el, r: parseFloat( getComputedStyle( el ).borderTopLeftRadius ) || 0 };
		} );
		var frameSel = CFG.media.replace( /\.case-content /g, '' );
		var free = function ( el ) {
			var cs = getComputedStyle( el );
			return 'none' === cs.translate && 'none' === cs.scale; // não pisa em quem já usa
		};
		var layer = function ( cover ) {
			return function ( el ) {
				return { el: el, frame: ( el.parentElement && el.parentElement.closest( frameSel ) ) || el.parentElement, cover: cover };
			};
		};
		layers = all( CFG.parallax ).filter( free ).map( layer( true ) )
			.concat( all( CFG.drift ).filter( free ).map( layer( false ) ) );
	}

	/* ---------- só calcula o que está perto da tela ---------- */
	var live = new Set();
	var io = 'IntersectionObserver' in window ? new IntersectionObserver( function ( es ) {
		es.forEach( function ( e ) {
			if ( e.isIntersecting ) {
				live.add( e.target );
			} else {
				live.delete( e.target );
			}
		} );
		kick();
	}, { rootMargin: '25% 0px' } ) : null;
	function watch( el ) {
		if ( io ) {
			io.observe( el );
		} else {
			live.add( el );
		}
	}
	texts.forEach( function ( t ) {
		watch( t.el );
	} );
	medias.forEach( function ( m ) {
		watch( m.el );
	} );
	layers.forEach( function ( l ) {
		watch( l.frame );
	} );

	/* ---------- laço ---------- */
	var raf = 0;
	var lastY = window.scrollY;
	var lastT = 0;
	var vel = 0; // px por quadro (60 fps), suavizado

	function tick( now ) {
		raf = 0;
		var dt = lastT ? Math.min( 64, now - lastT ) : 16.7;
		lastT = now;
		var y = window.scrollY;
		var raw = ( y - lastY ) * ( 16.7 / dt );
		lastY = y;
		vel += ( raw - vel ) * ( 1 - Math.pow( 1 - CFG.damp, dt / 16.7 ) );
		if ( Math.abs( vel ) < 0.05 && 0 === raw ) {
			vel = 0;
		}

		var vh = window.innerHeight;
		var reads = [];

		// leituras primeiro, escritas depois (nada de layout no meio)
		texts.forEach( function ( t ) {
			if ( live.has( t.el ) ) {
				reads.push( [ t, t.el.getBoundingClientRect() ] );
			}
		} );
		var lr = [];
		layers.forEach( function ( l ) {
			if ( live.has( l.frame ) ) {
				lr.push( [ l, l.frame.getBoundingClientRect() ] );
			}
		} );
		var mr = [];
		medias.forEach( function ( m ) {
			if ( live.has( m.el ) ) {
				mr.push( [ m, m.el.offsetWidth ] );
			}
		} );

		reads.forEach( function ( pair ) {
			var t = pair[ 0 ];
			var r = pair[ 1 ];
			// 0 quando o topo entra a 90% da tela; 1 quando a base passa de 55%
			var start = vh * 0.9;
			var end = vh * 0.55;
			var p = clamp( ( start - r.top ) / ( start - end + r.height ), 0, 1 );
			var n = t.words.length;
			var S = CFG.textSpread;
			var head = p * ( n + S );
			for ( var i = 0; i < n; i++ ) {
				var k = clamp( ( head - i ) / S, 0, 1 );
				var o = Math.round( ( CFG.textMin + ( 1 - CFG.textMin ) * k ) * 100 ) / 100;
				if ( t.last[ i ] !== o ) {
					t.last[ i ] = o;
					t.words[ i ].style.opacity = 1 === o ? '' : o;
				}
			}
		} );

		lr.forEach( function ( pair ) {
			var l = pair[ 0 ];
			var r = pair[ 1 ];
			var p = clamp( ( vh - r.top ) / ( vh + r.height ), 0, 1 ); // 0 entrando, 1 saindo
			var zoomIn = 1 - clamp( p / 0.5, 0, 1 );
			var sc = l.cover ? 1 + CFG.depth * 2 + CFG.zoom * zoomIn : 1 + CFG.driftZoom * zoomIn;
			var ty = ( 0.5 - p ) * 2 * ( l.cover ? CFG.depth : CFG.driftDepth ) * r.height;
			l.el.style.translate = '0 ' + ty.toFixed( 1 ) + 'px';
			l.el.style.scale = sc.toFixed( 4 );
		} );

		var s = clamp( vel / CFG.vMax, -1, 1 );
		var a = Math.abs( s );
		var e = a * ( 2 - a ); // ease-out: reage logo, satura macio
		var down = s > 0;
		mr.forEach( function ( pair ) {
			var m = pair[ 0 ];
			var st = m.el.style;
			if ( e < 0.002 ) {
				if ( m.on ) {
					m.on = false;
					st.translate = st.scale = st.transformOrigin = st.willChange = '';
					st.clipPath = '';
				}
				return;
			}
			m.on = true;
			// descendo (s > 0) o conteúdo sobe: o topo puxa, a base atrasa, estica e curva
			st.willChange = 'translate, scale';
			st.transformOrigin = down ? '50% 0' : '50% 100%';
			st.translate = '0 ' + ( ( down ? 1 : -1 ) * CFG.lag * e ).toFixed( 1 ) + 'px';
			st.scale = ( 1 - CFG.stretch * 0.35 * e ).toFixed( 4 ) + ' ' + ( 1 + CFG.stretch * e ).toFixed( 4 );
			if ( ! CFG.curve ) {
				return;
			}
			// curva na borda de trás: os dois cantos dela viram uma elipse que vai até o meio da largura.
			// É um recorte (clip-path), não um raio de borda, então o fundo do quadro não repinta.
			var rh = ( m.r + ( pair[ 1 ] / 2 - m.r ) * e ).toFixed( 1 ) + 'px';
			var rv = ( m.r + CFG.curve * e ).toFixed( 1 ) + 'px';
			var R = m.r + 'px';
			st.clipPath = 'inset(0 round ' + ( down ?
				R + ' ' + R + ' ' + rh + ' ' + rh + ' / ' + R + ' ' + R + ' ' + rv + ' ' + rv :
				rh + ' ' + rh + ' ' + R + ' ' + R + ' / ' + rv + ' ' + rv + ' ' + R + ' ' + R ) + ')';
		} );

		if ( 0 !== vel ) {
			raf = requestAnimationFrame( tick );
		} else {
			lastT = 0;
		}
	}

	// Pede o quadro a partir do evento de scroll (e refaz o pedido), para rodar sempre depois do
	// smooth scroll do tema no mesmo quadro: assim o efeito nunca fica um quadro atrás da página.
	function kick() {
		if ( raf ) {
			cancelAnimationFrame( raf );
		}
		raf = requestAnimationFrame( tick );
	}
	window.addEventListener( 'scroll', kick, { passive: true } );
	window.addEventListener( 'resize', kick, { passive: true } );
	kick();
}() );
