/* Avião de papel do Paperplane: porte vanilla da animação da chamada final da home (#comecar).
   Uso: PPAviao.voar(elementoContainer, { aoPousar(){}, passada:0, duracao:7600, pouso:true }); PPAviao.parar([el]).
   Tempos, curvas e desenho: ver README.md (linhas do site). */
(function () {
  'use strict'
  var SVGNS = 'http://www.w3.org/2000/svg'
  var DURACAO_DA_PASSADA = 7600      // site: const T=7600
  var RASTRO_MAX = 320               // site: Math.min(L,320)
  var PASSO_DO_RASTRO = 6            // site: d+=6
  var FRACAO_DO_POUSO = 0.88         // adaptação: a partir daqui o avião desacelera até parar
  var ALTURA_DE_REFERENCIA = 420     // altura do container para a qual os desvios em px do site valem 1:1
  var ativos = new Map()

  // Mesmo desenho do site (#flyPlane): três dobras, viewBox -20..20.
  var AVIAO_SVG =
    '<svg aria-hidden="true" viewBox="-20 -20 40 40"><g transform="rotate(45) translate(-19 -19) scale(1.6)" ' +
    'stroke="var(--aviao-tinta)" stroke-width="1" stroke-linejoin="round" stroke-linecap="round">' +
    '<path class="pf1" d="M21.5 2.5 2.5 10.5 9 13Z"/><path class="pf2" d="M21.5 2.5 9 13l7 7.5Z"/>' +
    '<path class="pf1" d="M9 13l.5 6 2.8-2.4Z"/></g></svg>'

  function limitar(v, a, b) { return Math.min(b, Math.max(a, v)) }

  // site: flyLayout(). As quatro passadas usam as mesmas fórmulas de curva; y1,y2,m (faixa do título)
  // e b1,b2,bm (faixa da palavra grande) saem da altura do container em vez do <h2> e do #bigword.
  function trajetos(w, h, ancoras) {
    var e = limitar(h / ALTURA_DE_REFERENCIA, 0.45, 1.25) // escala dos desvios em px (-90, +70...)
    var top = h * 0.15, hh = h * 0.7
    var y1 = top + hh * 0.25, y2 = top + hh * 0.78, m = top + hh * 0.5
    var bt = h * 0.55, bh = h * 0.4
    var b1 = bt + bh * 0.3, b2 = bt + bh * 0.7, bm = bt + bh * 0.5
    if (ancoras) { y1 = ancoras.y1; y2 = ancoras.y2; m = ancoras.m; if (ancoras.b1 != null) { b1 = ancoras.b1; b2 = ancoras.b2; bm = ancoras.bm } e = ancoras.e != null ? ancoras.e : 1 }
    var f = function (n) { return n * e }
    return [
      'M ' + (-80) + ' ' + (y2 + f(60)) + ' C ' + w * 0.18 + ' ' + (y2 + f(40)) + ', ' + w * 0.22 + ' ' + (y1 - f(90)) + ', ' + w * 0.42 + ' ' + (y1 - f(20)) +
        ' S ' + w * 0.62 + ' ' + (y2 + f(70)) + ', ' + w * 0.78 + ' ' + m + ' S ' + w * 0.95 + ' ' + (y1 - f(80)) + ', ' + (w + 120) + ' ' + (y1 - f(40)),
      'M ' + (-80) + ' ' + (b1 - f(40)) + ' C ' + w * 0.2 + ' ' + (b1 - f(70)) + ', ' + w * 0.36 + ' ' + (b2 + f(20)) + ', ' + w * 0.52 + ' ' + bm +
        ' S ' + w * 0.8 + ' ' + (b1 - f(60)) + ', ' + (w + 120) + ' ' + b2,
      'M ' + (-80) + ' ' + m + ' C ' + w * 0.2 + ' ' + (m - f(40)) + ', ' + w * 0.36 + ' ' + (y1 - f(70)) + ', ' + w * 0.5 + ' ' + (y1 - f(60)) +
        ' C ' + w * 0.62 + ' ' + (y1 - f(50)) + ', ' + w * 0.64 + ' ' + (y2 + f(40)) + ', ' + w * 0.54 + ' ' + (y2 + f(40)) +
        ' C ' + w * 0.44 + ' ' + (y2 + f(40)) + ', ' + w * 0.44 + ' ' + (y1 - f(10)) + ', ' + w * 0.58 + ' ' + (y1 - f(30)) +
        ' S ' + w * 0.9 + ' ' + m + ', ' + (w + 120) + ' ' + y2,
      'M ' + (-80) + ' ' + (b2 + f(20)) + ' C ' + w * 0.25 + ' ' + (b2 + f(30)) + ', ' + w * 0.3 + ' ' + (b1 - f(70)) + ', ' + w * 0.5 + ' ' + (b1 - f(40)) +
        ' S ' + w * 0.75 + ' ' + (b2 + f(40)) + ', ' + (w + 120) + ' ' + (bm - f(20))
    ]
  }

  // Modo borda: o avião entra pela borda esquerda da tela, sobe um pouco, planeia e pousa ao lado do botão (opcoes.alvo).
  function trajetoBorda(inst, w, h) {
    var r = inst.el.getBoundingClientRect(), a = inst.opcoes.alvo
    var xs = -r.left - 90, ys = h * 0.66, xe = w * 0.9, ye = h * 0.45
    if (a) { var ar = a.getBoundingClientRect(); xe = Math.min(w - 30, ar.right - r.left + 52); ye = ar.top - r.top + ar.height * 0.42 }
    var dx = xe - xs, lift = Math.min(h * 0.24, 150)
    return 'M ' + xs + ' ' + ys + ' C ' + (xs + dx * 0.32) + ' ' + (ys - lift) + ', ' + (xs + dx * 0.7) + ' ' + (ye - lift * 0.35) + ', ' + xe + ' ' + ye
  }

  function criar(el, opcoes) {
    var o = opcoes || {}
    var inst = {
      el: el, opcoes: o, passada: limitar(o.passada | 0, 0, 3), duracao: o.duracao || DURACAO_DA_PASSADA,
      pouso: o.pouso !== false, t0: null, raf: 0, parado: false, pousou: false, tPouso: 0,
      w: 0, h: 0, len: 0, lenFinal: 0, metade: 27
    }
    inst.estavaComClasse = el.classList.contains('pp-aviao-area')
    el.classList.add('pp-aviao-area')

    inst.svgTrilha = document.createElementNS(SVGNS, 'svg')
    inst.svgTrilha.setAttribute('class', 'pp-aviao-trilha')
    inst.svgTrilha.setAttribute('aria-hidden', 'true')
    inst.guia = document.createElementNS(SVGNS, 'path')
    inst.guia.setAttribute('class', 'pp-aviao-guia')
    inst.rastro = document.createElementNS(SVGNS, 'path')
    inst.svgTrilha.appendChild(inst.guia)
    inst.svgTrilha.appendChild(inst.rastro)
    inst.aviao = document.createElement('div')
    inst.aviao.className = 'pp-aviao-aviao'
    inst.aviao.innerHTML = AVIAO_SVG
    el.appendChild(inst.svgTrilha)
    el.appendChild(inst.aviao)
    return inst
  }

  function medir(inst) {
    var w = inst.el.clientWidth, h = inst.el.clientHeight
    if (w === inst.w && h === inst.h && inst.len) return
    inst.w = w; inst.h = h
    inst.metade = (inst.aviao.offsetWidth || 54) / 2
    inst.guia.setAttribute('d', inst.opcoes.borda ? trajetoBorda(inst, w, h) : trajetos(w, h, inst.opcoes.ancoras)[inst.passada])
    inst.len = inst.guia.getTotalLength()
    // adaptação: a passada do site sai pela direita do container; aqui o avião pousa antes, perto da borda direita.
    var alvoX = w * (inst.opcoes.pousoX != null ? inst.opcoes.pousoX : 0.9)
    var fim = inst.len, passo = 4
    if (inst.pouso && !inst.opcoes.borda) {
      for (var d = inst.len * 0.5; d <= inst.len; d += passo) { if (inst.guia.getPointAtLength(d).x >= alvoX) { fim = d; break } }
    }
    inst.lenFinal = fim
  }

  // Progresso ao longo do trecho: linear como no site (L = t * flyLen); no pouso, desacelera até zero sem saltar de velocidade.
  function progresso(inst, t) {
    if (!inst.pouso) return t
    var a = FRACAO_DO_POUSO, tau = 1 - a, sFinal = a + tau / 2
    var s = t <= a ? t : a + (t - a) - ((t - a) * (t - a)) / (2 * tau)
    return s / sFinal
  }

  function desenhar(inst, t, agora) {
    var frac = progresso(inst, t)
    var L = frac * inst.lenFinal
    var pt = inst.guia.getPointAtLength(L)
    var pt2 = inst.guia.getPointAtLength(Math.min(inst.len, L + 2))
    var a = Math.atan2(pt2.y - pt.y, pt2.x - pt.x) * 180 / Math.PI
    var d = 1.05 + Math.sin(t * Math.PI * 2) * 0.12 // site: respira entre 0,93 e 1,17 do tamanho
    var m = inst.metade
    inst.aviao.style.opacity = inst.opcoes.borda ? Math.min(1, t / 0.07) : 1
    inst.aviao.style.transform = 'translate3d(' + (pt.x - m) + 'px,' + (pt.y - m) + 'px,0) rotate(' + a + 'deg) scale(' + d + ')'
    // rastro: os últimos 320 px percorridos (site: flyTrailMask). Depois do pouso a cauda alcança o avião e some.
    var ini = Math.max(0, L - Math.min(L, RASTRO_MAX))
    if (inst.pousou) {
      var k = limitar((agora - inst.tPouso) / 1100, 0, 1), e = k < 0.5 ? 2 * k * k : 1 - Math.pow(-2 * k + 2, 2) / 2
      ini = ini + (L - ini) * e
    }
    var pts = []
    for (var s = ini; s <= L; s += PASSO_DO_RASTRO) { var q = inst.guia.getPointAtLength(s); pts.push(q.x.toFixed(1) + ' ' + q.y.toFixed(1)) }
    inst.rastro.setAttribute('d', pts.length > 1 ? 'M' + pts.join(' L') : '')
  }

  function limpar(inst, mantemVisual) {
    inst.parado = true
    cancelAnimationFrame(inst.raf)
    if (inst.ro) inst.ro.disconnect()
    if (!mantemVisual) {
      inst.svgTrilha.remove(); inst.aviao.remove()
      if (!inst.estavaComClasse) inst.el.classList.remove('pp-aviao-area')
    }
    ativos.delete(inst.el)
  }

  function voar(el, opcoes) {
    if (!el) throw new Error('PPAviao.voar: informe o elemento container')
    parar(el)
    var inst = criar(el, opcoes)
    ativos.set(el, inst)
    var reduzido = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches
    medir(inst)
    if (window.ResizeObserver) { inst.ro = new ResizeObserver(function () { medir(inst) }); inst.ro.observe(el) }

    function pousar(agora) {
      inst.pousou = true; inst.tPouso = agora
      if (typeof inst.opcoes.aoPousar === 'function') { try { inst.opcoes.aoPousar() } catch (e) { setTimeout(function () { throw e }) } }
    }

    if (reduzido) {
      // sem movimento: avião parado na posição final (já pousado), sem rastro
      var pt = inst.guia.getPointAtLength(inst.lenFinal), pt2 = inst.guia.getPointAtLength(Math.min(inst.len, inst.lenFinal + 2))
      var a = Math.atan2(pt2.y - pt.y, pt2.x - pt.x) * 180 / Math.PI
      inst.aviao.style.opacity = 1
      inst.aviao.style.transform = 'translate3d(' + (pt.x - inst.metade) + 'px,' + (pt.y - inst.metade) + 'px,0) rotate(' + a + 'deg) scale(1.05)'
      inst.pousou = true
      Promise.resolve().then(function () { if (!inst.parado && typeof inst.opcoes.aoPousar === 'function') inst.opcoes.aoPousar() })
      return inst
    }

    function quadro(agora) {
      if (inst.parado) return
      if (inst.t0 === null) inst.t0 = agora
      medir(inst)
      var t = limitar((agora - inst.t0) / inst.duracao, 0, 1)
      if (t >= 1 && !inst.pousou) { desenhar(inst, 1, agora); pousar(agora) }
      else desenhar(inst, t, agora)
      if (inst.pousou && agora - inst.tPouso > 1100) { desenhar(inst, 1, agora); inst.raf = 0; return } // fim: avião parado, rastro apagado
      inst.raf = requestAnimationFrame(quadro)
    }
    inst.raf = requestAnimationFrame(quadro)
    return inst
  }

  function parar(el) {
    if (el) { var i = ativos.get(el); if (i) limpar(i, false); return }
    Array.from(ativos.values()).forEach(function (i) { limpar(i, false) })
  }

  window.PPAviao = { voar: voar, parar: parar, versao: '1.0' }
})()
