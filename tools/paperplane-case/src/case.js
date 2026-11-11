/* Case Paperplane Studio v2: movimento da página e as peças vivas.
   Conteúdo nunca depende disto: sem JS tudo aparece; com movimento reduzido, sem pin, sem scrub, sem partículas. */
(() => {
  'use strict'
  const root = document.documentElement
  const unboot = () => root.classList.remove('boot')
  const { gsap, ScrollTrigger, SplitText, CustomEase, MotionPathPlugin, DrawSVGPlugin, Draggable, PPMicro: M, PPSims } = window
  if (!gsap || !ScrollTrigger) { unboot(); return }
  gsap.registerPlugin(ScrollTrigger, SplitText, CustomEase, MotionPathPlugin, DrawSVGPlugin, Draggable)
  CustomEase.create('studio', 'M0,0 C0.16,1 0.3,1 1,1')
  CustomEase.create('quieto', 'M0,0 C0.33,1 0.68,1 1,1')
  CustomEase.create('pouso', 'M0,0 C0.2,1.25 0.4,1 1,1')
  CustomEase.create('sair', 'M0,0 C0.4,0 1,1 1,1')

  const $ = (s, c = document) => c.querySelector(s)
  const $$ = (s, c = document) => Array.from(c.querySelectorAll(s))
  const reduzido = () => matchMedia('(prefers-reduced-motion: reduce)').matches
  const fino = () => matchMedia('(hover: hover) and (pointer: fine)').matches
  const esperar = (ms) => new Promise((r) => setTimeout(r, ms))
  // No tema, o cabeçalho é o do site: a altura vem dele (e vira --header-h no case).
  const cabecalho = document.querySelector('.site-header')
  const HEADER = (cabecalho && Math.round(cabecalho.getBoundingClientRect().height)) || 72
  const raizDoCase = document.querySelector('.pp-case') || document.body
  if (raizDoCase !== document.body) raizDoCase.style.setProperty('--header-h', HEADER + 'px')
  // Textos da página que nascem no JS: português por padrão; o tema passa a versão do idioma em window.PPCaseI18n.
  const T = Object.assign({"reservaN": " · reserva até N", "leitorN": "preço estimado, reserva até N créditos", "desenhar": "Desenhar", "desenhando": "Desenhando", "consentimento": "O clique é o consentimento: a reserva sai só agora.", "gerarTomada": "Gerar tomada", "tentarDeNovo": "Tentar de novo", "novoTake": "Novo take", "aprovado": "Aprovado", "paraAprovar": "Para aprovar", "aprovar": "Aprovar", "verDeNovo": "Ver de novo", "take10": "Take #1.0", "quadroVira": "O quadro aprovado é o primeiro quadro do vídeo.", "basicoPct": "% Básico", "reservados": "24 créditos reservados", "tomadaPronta": "Tomada pronta", "falhou": "O gerador falhou. Os créditos voltaram.", "semSaldo": "Faltam 14 créditos. <b>Nada foi gasto.</b>", "compra": "+500 créditos no saldo", "resposta": "Separei a cena 3 em cinco tomadas: abre no plano geral do vagão e fecha no close da Lia.", "acentoLimao": "--accent volta ao limão: botões, selos e progresso.", "acentoOutro": "--accent e --lime-* em {v}: o botão principal, os selos e a barra de progresso acompanham.", "cantoZero": "--r-* em zero: tudo reto.", "cantoPadrao": "--r-* no padrão.", "cantoMais": "--r-* multiplicado: cartões e campos arredondam.", "temaClaro": "data-theme=\"light\": os mesmos tokens, papel claro.", "temaEscuro": "data-theme=\"dark\": os mesmos tokens, papel carbono.", "fonteMono": "--body em Geist Mono: o estúdio inteiro troca de voz.", "fonteGeist": "--body em Geist, a fonte do produto.", "escolha": "Escolha acento, canto, tema ou fonte. A prévia ao lado é o estúdio de verdade.", "padrao": "Tudo de volta ao padrão da Dobra.", "padraoFim": "De volta ao padrão. Agora é com você.", "nomes": "{\"menta\":\"menta\",\"pessego\":\"pêssego\",\"lilas\":\"lilás\",\"ceu\":\"céu\"}"}, window.PPCaseI18n || {})
  const nomeDoAcento = (v) => { try { return JSON.parse(T.nomes)[v] || v } catch (e) { return v } }
  let cursor = null

  const fontes = document.fonts
    ? Promise.all(['500 40px "Bricolage Grotesque"', '400 16px "Geist"', '500 12px "Geist Mono"'].map((f) => document.fonts.load(f))).then(() => document.fonts.ready)
    : Promise.resolve()
  Promise.race([fontes.catch(() => {}), esperar(800)]).then(iniciar)

  function iniciar() {
    iconesEmLinha()
    $$('.sim').forEach((el) => PPSims && PPSims.registrar(el))
    hero()
    temaPorSecao()
    progresso()
    cursorDaPagina()
    preco()
    comparador()
    micro()
    dobra()
    noite()
    contrato()
    curvas()
    midiasDaPagina()
    fichaGerada()
    dadosDaDobra()
    const mm = gsap.matchMedia()
    mm.add({ desk: '(min-width: 900px)', estreito: '(max-width: 899.98px)', reduz: '(prefers-reduced-motion: reduce)' }, (ctx) => {
      const { desk, reduz } = ctx.conditions
      const limpar = []
      try {
        tese(reduz)
        titulos(reduz)
        revelar(reduz)
        limpar.push(mesa(reduz))
        limpar.push(etapas(reduz))
        empilhar(desk, reduz)
        limpar.push(site(reduz))
        limpar.push(celular(reduz))
        numeros(reduz)
        licoes(reduz)
        limpar.push(dias())
        decolar(reduz)
      } catch (e) { console.error('movimento', e && e.stack || e) }
      return () => limpar.forEach((fn) => fn && fn())
    })
    addEventListener('load', () => ScrollTrigger.refresh())
    setTimeout(() => ScrollTrigger.refresh(), 1400)
  }

  /* Ícones: o <use> vira traço em linha para poder ser desenhado. */
  function iconesEmLinha() {
    $$('.st-ic, .li-ic, .regra-ic, .ct-ic, .pa-ic, .nc-ic, .ind-ic').forEach((svg) => {
      const use = $('use', svg)
      const id = use && use.getAttribute('href')
      const sym = id && $(id)
      if (!sym) return
      svg.setAttribute('viewBox', sym.getAttribute('viewBox'))
      svg.innerHTML = sym.innerHTML
    })
  }
  function midiasDaPagina() {
    $$('img[data-midia]').forEach((im) => {
      if (!PPSims) return
      const chave = PPSims.temMidia(im.dataset.midia) ? im.dataset.midia : im.dataset.midiaReserva || im.dataset.midia
      im.src = PPSims.midia(chave)
    })
  }
  /** Ficha gerada (assets3/ficha/1..4.webp): os quatro retratos entram na janela "gerador de imagem"; sem eles, as silhuetas. */
  function fichaGerada() {
    const lista = $('[data-ficha]')
    if (!lista || !PPSims || !PPSims.temMidia || !PPSims.temMidia('pg/ficha-1.webp')) return
    $$('li', lista).forEach((li, i) => {
      if (!PPSims.temMidia('pg/ficha-' + (i + 1) + '.webp')) return
      const im = document.createElement('img'); im.alt = ''; im.src = PPSims.midia('pg/ficha-' + (i + 1) + '.webp')
      li.classList.add('tem-foto'); li.append(im)
    })
  }
  /** Faixa de dados da Dobra: odômetro e ícone desenhado ao chegar. */
  function dadosDaDobra() {
    const faixa = $('.db-dados')
    if (!faixa) return
    const odos = $$('.odo', faixa).map(odometro)
    const icones = $$('.db-ic', faixa)
    icones.forEach((svg) => { const use = $('use', svg), sym = use && $(use.getAttribute('href')); if (sym) { svg.setAttribute('viewBox', sym.getAttribute('viewBox')); svg.innerHTML = sym.innerHTML } })
    if (reduzido()) return
    const partes = icones.map((ic) => $$('path,circle,rect,line', ic))
    partes.forEach((p) => gsap.set(p, { drawSVG: '0%' }))
    ScrollTrigger.create({ trigger: faixa, start: 'top 75%', once: true, onEnter: () => {
      odos.forEach((o, i) => o.tocar(i * 0.18))
      partes.forEach((p, i) => gsap.to(p, { drawSVG: '100%', duration: 0.9, ease: 'quieto', delay: i * 0.18, stagger: 0.06 }))
    } })
  }

  /* ================= ODÔMETRO ================= */
  function odometro(el) {
    if (el.__odo) return el.__odo
    const final = el.dataset.odo || el.textContent.trim()
    const leitor = document.createElement('span'); leitor.className = 'visually-hidden'; leitor.textContent = final
    const vis = document.createElement('span'); vis.setAttribute('aria-hidden', 'true'); vis.style.display = 'inline-flex'
    const chars = final.split('')
    const digitos = chars.filter((c) => /\d/.test(c)).length
    let k = digitos
    const colunas = []
    chars.forEach((c) => {
      if (/\d/.test(c)) {
        k--
        const d = Number(c), voltas = Math.min(k, 2)
        const janela = document.createElement('span'); janela.className = 'odo-d'
        const col = document.createElement('span')
        const total = voltas * 10 + d + 1
        for (let i = 0; i < total; i++) { const s = document.createElement('span'); s.textContent = String(i % 10); col.append(s) }
        janela.append(col); vis.append(janela)
        colunas.push({ col, passos: total - 1, ordem: k })
      } else { const s = document.createElement('span'); s.className = 'odo-s'; s.textContent = c; vis.append(s) }
    })
    el.textContent = ''
    el.append(vis, leitor)
    const tocar = (atraso = 0) => {
      if (reduzido()) { colunas.forEach(({ col, passos }) => gsap.set(col, { y: -passos + 'em' })); return }
      colunas.forEach(({ col, passos, ordem }) => gsap.fromTo(col, { y: 0 }, { y: -passos + 'em', duration: 1.6, ease: 'power3.out', delay: atraso + ordem * 0.04 }))
    }
    if (reduzido()) tocar()
    el.__odo = { tocar }
    return el.__odo
  }

  /* ================= HERO ================= */
  /** Avião novo (aviao.js, embutido pelo build quando existe): window.PPAviao.voar(container, { aoPousar }). */
  const temAviao = () => !!(window.PPAviao && typeof window.PPAviao.voar === 'function')
  /**
   * Onde o avião pousa: logo depois de "clique", no fim do marca-texto. A passada 0 do aviao.js é uma curva cujos y
   * dependem linearmente das âncoras (y1, y2, m); refazemos a mesma curva aqui, medimos o y dela no x do pouso e
   * deslocamos as âncoras pela diferença, para a curva terminar exatamente ao lado da última palavra.
   */
  function pousoNoClique() { return pousoAoLado($('.hero-in'), $('.hero-title'), $('#kw')) }
  /** Âncoras para o avião pousar logo à direita do fim de `alvo` (texto ou botão), voando pela faixa de `titulo`. */
  function pousoAoLado(area, titulo, alvo) {
    const caixa = area.getBoundingClientRect(), tt = titulo.getBoundingClientRect()
    const linhas = alvo.getClientRects(), fim = linhas[linhas.length - 1]
    const w = area.clientWidth, h = area.clientHeight
    const e = gsap.utils.clamp(0.45, 1.25, h / 420)
    const topo = tt.top - caixa.top, alto = tt.height
    let y1 = topo + alto * 0.25, y2 = topo + alto * 0.78, m = topo + alto * 0.5
    // Com espaço, pousa logo depois de "clique"; sem espaço (linha até a borda, no celular), pousa sobre o fim da palavra.
    const cabe = fim.right - caixa.left + 60 <= w
    const alvoX = cabe ? fim.right - caixa.left + 32 : fim.right - caixa.left - 22
    const alvoY = cabe ? fim.top - caixa.top + fim.height * 0.42 : fim.top - caixa.top - 18
    const f = (n) => n * e
    const curva = (a1, a2, am) => 'M -80 ' + (a2 + f(60)) + ' C ' + w * 0.18 + ' ' + (a2 + f(40)) + ', ' + w * 0.22 + ' ' + (a1 - f(90)) + ', ' + w * 0.42 + ' ' + (a1 - f(20)) +
      ' S ' + w * 0.62 + ' ' + (a2 + f(70)) + ', ' + w * 0.78 + ' ' + am + ' S ' + w * 0.95 + ' ' + (a1 - f(80)) + ', ' + (w + 120) + ' ' + (a1 - f(40))
    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg'), guia = document.createElementNS('http://www.w3.org/2000/svg', 'path')
    svg.style.cssText = 'position:absolute;width:0;height:0;overflow:hidden'
    svg.append(guia); document.body.append(svg)
    guia.setAttribute('d', curva(y1, y2, m))
    const L = guia.getTotalLength()
    let yNaCurva = alvoY
    for (let d = L * 0.5; d <= L; d += 3) { const p = guia.getPointAtLength(d); if (p.x >= alvoX) { yNaCurva = p.y; break } }
    svg.remove()
    const delta = alvoY - yNaCurva
    y1 += delta; y2 += delta; m += delta
    return { passada: 0, pousoX: alvoX / w, ancoras: { y1, y2, m, e } }
  }
  function hero() {
    const titulo = $('.hero-title'), wrap = $('.h1-wrap')
    let aceso = false
    const acender = () => { if (aceso) return; aceso = true; wrap.classList.add('is-lit') }
    const odos = $$('.metrics .odo').map(odometro)
    if (reduzido()) { acender(); unboot(); return }
    const split = SplitText.create(titulo, { type: 'lines', mask: 'lines', aria: 'auto' })
    const tl = gsap.timeline({ delay: 0.05, onComplete: () => split.revert() })
    tl.fromTo('.back-link,.case-meta', { autoAlpha: 0, y: 8 }, { autoAlpha: 1, y: 0, duration: 0.5, ease: 'quieto', stagger: 0.06 }, 0)
      .from(split.lines, { yPercent: 110, duration: 0.95, ease: 'studio', stagger: 0.08 }, 0.1)
      .fromTo('.lede,.chips', { autoAlpha: 0, y: 12 }, { autoAlpha: 1, y: 0, duration: 0.6, ease: 'quieto', stagger: 0.08 }, 0.45)
      .fromTo('.metrics', { autoAlpha: 0, y: 12 }, { autoAlpha: 1, y: 0, duration: 0.6, ease: 'quieto' }, 0.6)
      .add(() => odos.forEach((o, i) => o.tocar(i * 0.15)), 0.75)
      .fromTo('.hero-shot', { autoAlpha: 0, y: 48 }, { autoAlpha: 1, y: 0, duration: 1.2, ease: 'studio' }, 0.7)
    unboot()
    // O limão acende em "preço antes do clique" quando o avião pousa; sem o avião, acende sozinho.
    if (temAviao()) {
      // Parte quando as linhas do título já assentaram (e as fontes chegaram): o pouso é medido na posição final.
      tl.add(() => {
        const voar = () => { let pouso = null; try { pouso = pousoNoClique() } catch (e) {} try { window.PPAviao.voar($('.hero-in'), { aoPousar: acender, ...(pouso || {}) }) } catch (e) { acender() } }
        Promise.race([document.fonts ? document.fonts.ready : Promise.resolve(), esperar(800)]).then(voar)
      }, 1.3)
      tl.add(acender, 12)
    } else tl.add(acender, 1.6)
  }

  /* ================= TEMA, PROGRESSO, CURSOR ================= */
  function temaPorSecao() {
    $$('.zone').forEach((zona) => ScrollTrigger.create({
      trigger: zona, start: 'top 50%', end: 'bottom 50%', refreshPriority: -1,
      onToggle: (s) => { if (s.isActive) { root.dataset.theme = zona.dataset.theme; if (cursor) cursor.tema(zona.dataset.theme === 'dark' ? 'dark' : 'light') } },
    }))
  }
  function progresso() {
    const h = $('.site-header')
    if (!h) return
    // Uma barra só: a do próprio cabeçalho (no tema ela é criada aqui, como faz o case.js do site).
    if (!$('.read-progress', h)) { const b = document.createElement('span'); b.className = 'read-progress'; b.setAttribute('aria-hidden', 'true'); h.append(b) }
    ScrollTrigger.create({ start: 0, end: 'max', refreshPriority: -1, onUpdate: (s) => h.style.setProperty('--p', s.progress.toFixed(4)) })
  }
  /** O cursor do produto vale na página inteira: só ponteiro fino, nunca com movimento reduzido; campos e molduras com roteiro ficam com o nativo. */
  function cursorDaPagina() {
    if (!M || reduzido() || !fino()) return
    cursor = M.cursorBolinha({ raiz: raizDoCase })
    cursor.tema('light')
  }

  /* ================= TESE, TÍTULOS, REVELAÇÕES ================= */
  function tese(reduz) {
    const l = $('.thesis-line')
    if (!l || reduz) return
    const s = SplitText.create(l, { type: 'words', aria: 'auto' })
    gsap.fromTo(s.words, { opacity: 0.14 }, { opacity: 1, ease: 'none', stagger: 0.1, scrollTrigger: { trigger: l, start: 'clamp(top 80%)', end: 'clamp(bottom 40%)', scrub: 0.6, refreshPriority: -1 } })
  }
  function titulos(reduz) {
    if (reduz) return
    $$('.chapter-title').forEach((h) => {
      const s = SplitText.create(h, { type: 'lines', mask: 'lines', aria: 'auto' })
      gsap.from(s.lines, { yPercent: 110, duration: 0.9, ease: 'studio', stagger: 0.07, scrollTrigger: { trigger: h, start: 'top 88%', once: true, refreshPriority: -1 }, onComplete: () => s.revert() })
    })
  }
  function revelar(reduz) {
    if (reduz) return
    const q = $$('.reveal')
    gsap.set(q, { opacity: 0, y: 8 })
    ScrollTrigger.batch(q, { start: 'top 88%', once: true, refreshPriority: -1, onEnter: (b) => gsap.to(b, { opacity: 1, y: 0, duration: 0.6, ease: 'quieto', stagger: 0.08, overwrite: 'auto', onComplete: () => gsap.set(b, { clearProps: 'transform,opacity' }) }) })
    const c = $$('.reveal-card, .dores li, .ct, .stat, .notas-cel li')
    gsap.set(c, { opacity: 0, y: 14 })
    ScrollTrigger.batch(c, { start: 'top 90%', once: true, refreshPriority: -1, onEnter: (b) => gsap.to(b, { opacity: 1, y: 0, duration: 0.7, ease: 'pouso', stagger: 0.08, overwrite: 'auto', onComplete: () => gsap.set(b, { clearProps: 'transform,opacity' }) }) })
    ;[...q, ...c].forEach((el) => el.addEventListener('focusin', () => gsap.set(el, { clearProps: 'transform,opacity' })))
  }

  /* ================= 01 A MESA QUE SE DOBRA ================= */
  function mesa(reduz) {
    const m = $('.mesa')
    if (!m) return null
    const jan = $$('.jan', m), notif = $('.notif', m), estudio = $('.mesa-estudio', m), sim = $('.sim', estudio)
    const moldura = sim && sim.__moldura
    if (moldura) { sim.dataset.manual = '1' }
    const liberar = () => { if (moldura) { delete sim.dataset.manual; moldura.atualizar() } }
    if (reduz) {
      m.classList.add('estatico'); m.dataset.estado = '2'; m.dataset.tema = 'escuro'; liberar()
      return () => m.classList.remove('estatico')
    }
    m.classList.remove('estatico')
    const colunaDe = (i) => i % 3, linhaDe = (i) => (i < 3 ? 0 : 1)
    const geo = () => {
      const W = m.clientWidth, H = m.clientHeight, gap = W * 0.018
      const area = { x: W * 0.08, y: H * 0.06, w: W * 0.84, h: H * 0.88 }
      return { gap, area, cw: (area.w - gap * 2) / 3, ch: (area.h - gap) / 2 }
    }
    // A dobra anda com a leitura: a mesa fica presa enquanto as janelas se alinham, dobram e viram o estúdio.
    const tl = gsap.timeline({ defaults: { overwrite: false } })
    tl.fromTo(jan, { autoAlpha: 0, y: -26, rotation: (i) => (i % 2 ? 7 : -7) }, { autoAlpha: 1, y: 0, rotation: (i, el) => parseFloat(getComputedStyle(el).getPropertyValue('--r')) || 0, duration: 0.6, ease: 'pouso', stagger: 0.09 })
      .fromTo(notif, { autoAlpha: 0, x: 30 }, { autoAlpha: 1, x: 0, duration: 0.45, ease: 'pouso' }, '+=0.2')
      .to({}, { duration: 1.4 })
      .to(notif, { autoAlpha: 0, y: -4, duration: 0.2, ease: 'sair' })
    jan.forEach((j, i) => {
      tl.to(j, { left: () => { const g = geo(); return g.area.x + colunaDe(i) * (g.cw + g.gap) }, top: () => { const g = geo(); return g.area.y + linhaDe(i) * (g.ch + g.gap) }, width: () => geo().cw, height: () => geo().ch, rotation: 0, duration: 0.7, ease: 'power3.inOut' }, i === 0 ? '+=0.05' : '<0.03')
    })
    tl.to({}, { duration: 0.3 })
    const esq = [jan[0], jan[3]], dir = [jan[2], jan[5]], meioC = jan[1], meioB = jan[4]
    tl.to(esq, { rotationY: 90, transformOrigin: () => { const g = geo(); return `${g.cw + g.gap / 2}px 50%` }, '--sombra': 0.5, duration: 0.45, ease: 'power2.in' })
      .set(esq, { autoAlpha: 0 })
      .to(dir, { rotationY: -90, transformOrigin: () => `${-geo().gap / 2}px 50%`, '--sombra': 0.5, duration: 0.45, ease: 'power2.in' }, '<0.12')
      .set(dir, { autoAlpha: 0 })
      .to(meioC, { rotationX: -90, transformOrigin: () => { const g = geo(); return `50% ${g.ch + g.gap / 2}px` }, '--sombra': 0.45, duration: 0.42, ease: 'power2.in' }, '>-0.02')
      .set(meioC, { autoAlpha: 0 })
      .to(meioB, { scaleY: 0.03, '--sombra': 0.35, duration: 0.36, ease: 'power2.in' }, '>-0.04')
      .set(meioB, { autoAlpha: 0 })
      .addLabel('dois')
      .fromTo(estudio, { autoAlpha: 0, rotationX: -84, scaleY: 0.2, transformOrigin: '50% 50%', filter: 'brightness(.6)' }, { autoAlpha: 1, rotationX: 0, scaleY: 1, filter: 'brightness(1)', duration: 0.9, ease: 'pouso' })
      .to({}, { duration: 0.6 })
    // Estado e palco seguem a animação (que anda com atraso do scrub), não a rolagem: o fundo escurece junto com a dobra.
    tl.eventCallback('onUpdate', () => {
      const estado = tl.time() >= tl.labels.dois ? '2' : '1'
      if (m.dataset.estado !== estado) { m.dataset.estado = estado; m.dataset.tema = estado === '2' ? 'escuro' : 'claro' }
    })
    gsap.set(m, { perspective: 1400 })
    let solto = false
    const st = ScrollTrigger.create({
      trigger: '.mesa-art', start: () => 'top top+=' + (HEADER + 12), end: () => '+=' + Math.round(innerHeight * 1.7), pin: true, scrub: 0.6, anticipatePin: 1, animation: tl, invalidateOnRefresh: true,
      onUpdate: (s) => {
        const fim = s.progress > 0.9
        if (fim !== solto && moldura) { solto = fim; if (fim) liberar(); else { sim.dataset.manual = '1'; moldura.atualizar() } }
      },
    })
    const replay = () => scrollTo({ top: st.start, behavior: 'smooth' })
    $('.mesa-replay').addEventListener('click', replay)
    return () => { st.kill(true); tl.kill(); jan.forEach((j) => gsap.set(j, { clearProps: 'left,top,width,height,transform,opacity,visibility,--sombra' })); $('.mesa-replay').removeEventListener('click', replay) }
  }

  /* ================= 02 DEZ ETAPAS: moldura parada, conteúdo troca ao cruzar cada etapa ================= */
  let palco = null
  function etapas(reduz) {
    const wrap = $('.etapas'), lista = $$('.etapas-lista li'), grupos = $$('.grupos li'), barras = grupos.map((g) => $('.g-bar i', g))
    const cont = $('.et-cont'), el = $('.palco-etapas')
    if (!wrap || !el || !PPSims) return null
    if (!palco) palco = new PPSims.PalcoDeEtapas(el, lista.map((li) => ({ tela: li.dataset.tela, roteiro: li.dataset.roteiro })))
    lista.forEach((li, i) => { if (i === 0 || lista[i - 1].dataset.g !== li.dataset.g) li.dataset.primeira = '' })
    const INICIO = [0, 3, 8], TAM = [3, 5, 2]
    let ativo = -1
    const marcar = (i) => {
      if (i === ativo) return
      ativo = i
      lista.forEach((li, k) => li.classList.toggle('is-active', k === i))
      const g = Number(lista[i].dataset.g)
      grupos.forEach((li, k) => li.classList.toggle('is-on', k === g))
      barras.forEach((b, k) => gsap.to(b, { scaleX: gsap.utils.clamp(0, 1, (i - INICIO[k] + 1) / TAM[k]), duration: reduz ? 0 : 0.45, ease: 'quieto', overwrite: true }))
      cont.textContent = String(i + 1).padStart(2, '0') + ' / 10'
      palco.mostrar(i)
    }
    const cliques = []
    if (reduz) {
      wrap.classList.add('sem-pin')
      lista.forEach((li, i) => { const b = $('.et-b', li); const fn = () => marcar(i); b.addEventListener('click', fn); cliques.push([b, fn]) })
      marcar(0)
      return () => { wrap.classList.remove('sem-pin'); cliques.forEach(([b, fn]) => b.removeEventListener('click', fn)) }
    }
    wrap.classList.add('is-pin')
    const st = ScrollTrigger.create({
      trigger: wrap, start: 'top top', end: () => '+=' + Math.round(innerHeight * 0.62 * 10), pin: true, anticipatePin: 1,
      onUpdate: (s) => marcar(Math.min(9, Math.floor(s.progress * 10))),
      onRefresh: (s) => marcar(Math.min(9, Math.floor(s.progress * 10))),
    })
    lista.forEach((li, i) => {
      const b = $('.et-b', li)
      const fn = () => scrollTo({ top: st.start + ((i + 0.5) / 10) * (st.end - st.start), behavior: 'smooth' })
      b.addEventListener('click', fn); cliques.push([b, fn])
    })
    marcar(0)
    return () => { st.kill(); wrap.classList.remove('is-pin'); cliques.forEach(([b, fn]) => b.removeEventListener('click', fn)) }
  }

  /* ================= 03 PREÇO: cartões empilhados com mini-artefatos ================= */
  function empilhar(desk, reduz) {
    if (!desk || reduz) return
    const cards = $$('[data-stack-card]')
    const topo = HEADER + 16, passo = 14, encolhe = 0.035, ultimo = cards[cards.length - 1]
    const em = (i) => `top top+=${topo + i * passo}`
    cards.slice(0, -1).forEach((c, i) => {
      ScrollTrigger.create({ trigger: c, start: em(i), endTrigger: ultimo, end: em(cards.length - 1), pin: true, pinSpacing: false })
      gsap.to(c, { scale: 1 - encolhe * (cards.length - 1 - i), transformOrigin: '50% 0%', ease: 'none', scrollTrigger: { trigger: cards[i + 1], start: 'top bottom', endTrigger: ultimo, end: em(cards.length - 1), scrub: 0.6 } })
    })
  }
  function trocarNumeroPorN(botao) {
    const p = $('.pp-preco', botao)
    if (!p) return
    const vis = Array.from(p.children).find((s) => s.getAttribute('aria-hidden') === 'true' && !s.classList.contains('moeda'))
    if (vis) vis.textContent = '≈ N'
    const leitor = $('.pp-so-leitor', p); if (leitor) leitor.textContent = T.leitorN
    const r = document.createElement('span'); r.className = 'reserva'; r.setAttribute('aria-hidden', 'true'); r.textContent = T.reservaN
    p.append(r)
  }
  function html(alvo, conteudo) { const t = document.createElement('template'); t.innerHTML = conteudo; const el = t.content.firstElementChild; alvo.replaceWith(el); return el }
  function preco() {
    if (!M) return
    const quando = (card, fn) => ScrollTrigger.create({ trigger: card, start: 'top 58%', once: true, onEnter: fn })
    /* 1. anel de saldo */
    const c1 = $('[data-art="saldo"]')
    if (c1) {
      const fg = $('.ag-fg', c1), v = $('.ag-v', c1), botoes = $$('.qual button', c1), anel = $('.anel-g', c1)
      const valor = (min) => '<span class="ag-aprox">≈</span> ' + min
      // O número cabe nos três estados com ~12% de folga de cada lado do miolo do anel (raio 84 de 100, traço 4,5).
      const caber = () => {
        const miolo = anel.clientWidth * ((84 - 2.25) / 100) * 0.76
        const antes = v.innerHTML
        v.style.setProperty('--ag-tam', '100px')
        const largura = Math.max(...botoes.map((b) => { v.innerHTML = valor(b.dataset.min); return v.scrollWidth }))
        v.innerHTML = antes
        v.style.setProperty('--ag-tam', Math.min(40, Math.floor((100 * miolo) / largura)) + 'px')
      }
      caber(); new ResizeObserver(caber).observe(anel)
      if (document.fonts) document.fonts.ready.then(caber)
      const escolher = (b) => {
        botoes.forEach((x) => x.setAttribute('aria-checked', String(x === b)))
        fg.style.strokeDashoffset = String(100 - Number(b.dataset.p))
        if (reduzido()) { v.innerHTML = valor(b.dataset.min); return }
        gsap.timeline().to(v, { autoAlpha: 0, y: -4, duration: 0.14, ease: 'sair' }).add(() => { v.innerHTML = valor(b.dataset.min) }).fromTo(v, { autoAlpha: 0, y: 8 }, { autoAlpha: 1, y: 0, duration: 0.28, ease: 'quieto' })
      }
      botoes.forEach((b) => b.addEventListener('click', () => { parado1 = true; escolher(b) }))
      let parado1 = false
      fg.style.strokeDashoffset = '0'; v.innerHTML = valor('4 min 10 s'); botoes.forEach((x, i) => x.setAttribute('aria-checked', String(i === 0)))
      if (reduzido()) escolher(botoes[1])
      else quando(c1, async () => { for (const i of [0, 1, 2, 1]) { if (parado1) return; escolher(botoes[i]); await esperar(1500) } })
    }
    /* 2. botão limão com selo */
    const c2 = $('[data-art="botao"]')
    if (c2) {
      const saldo = html($('.art-saldo-slot', c2), M.pecas.saldo(1200))
      const bt = html($('.bt-slot', c2), M.pecas.botaoDeCredito({ rotulo: T.desenhar, custo: 24 }))
      trocarNumeroPorN(bt)
      const nota = $('.art-nota', c2)
      let ocupado = false
      const clicar = async () => {
        if (ocupado) return
        ocupado = true
        nota.textContent = ''
        const e = M.creditos.gerar(saldo, bt, { custo: 24 })
        await e.pronta
        M.botao.gerando(bt, true, T.desenhando)
        nota.textContent = T.consentimento
        await esperar(2200)
        M.botao.gerando(bt, false)
        bt.classList.remove('bt-aberto')
        M.creditos.definirSaldo(saldo, 1200)
        ocupado = false
      }
      bt.addEventListener('click', clicar)
      M.afundarNoClique(bt)
      quando(c2, async () => {
        if (reduzido()) return
        await esperar(500); bt.classList.add('bt-aberto')
        await esperar(1500); M.afundar(bt); clicar()
      })
    }
    /* 3. reservado, falhou, devolvido */
    const c3 = $('[data-art="falha"]')
    if (c3) {
      const saldo = html($('.art-saldo-slot', c3), M.pecas.saldo(1200))
      const bt = html($('.bt-slot', c3), M.pecas.botaoDeCredito({ rotulo: T.gerarTomada, custo: 24 }))
      trocarNumeroPorN(bt)
      const passos = $$('.faixa li', c3)
      const marcar = (n) => passos.forEach((p, i) => p.classList.toggle('on', i === n))
      let ocupado = false
      const tocar = async () => {
        if (ocupado) return
        ocupado = true
        marcar(-1)
        if (reduzido()) { marcar(2); ocupado = false; return }
        M.afundar(bt)
        const e = M.creditos.gerar(saldo, bt, { custo: 24 })
        marcar(0)
        await e.pronta
        M.botao.gerando(bt, true)
        await esperar(900)
        marcar(1)
        M.botao.gerando(bt, false)
        await M.creditos.devolver(saldo, bt, { energia: e })
        marcar(2)
        ocupado = false
      }
      bt.addEventListener('click', tocar)
      $('.art-de-novo', c3).addEventListener('click', tocar)
      if (reduzido()) marcar(2); else quando(c3, () => setTimeout(tocar, 400))
    }
    /* 4. quadro aprovado vira take */
    const c4 = $('[data-art="quadro"]')
    if (c4) {
      const q = $('.aq-quadro', c4), take = $('.aq-take', c4), ok = $('.aq-ok', c4), pill = $('.aq-pill', c4), bt = $('.aq-aprovar', c4), nota = $('.art-nota', c4), tk = $('.aq-tk', c4)
      M.afundarNoClique(bt)
      let feito = false
      const zerar = () => { gsap.set([q, ok], { clearProps: 'all' }); take.classList.remove('vivo'); pill.classList.remove('ok'); pill.textContent = T.paraAprovar; bt.textContent = T.aprovar; tk.textContent = T.take10; nota.textContent = ''; feito = false }
      const aprovar = () => {
        if (feito) { zerar(); return }
        feito = true
        pill.classList.add('ok'); pill.textContent = T.aprovado
        bt.textContent = T.verDeNovo
        if (reduzido()) { take.classList.add('vivo'); gsap.set(ok, { opacity: 1, scale: 1 }); nota.textContent = T.quadroVira; return }
        const a = q.getBoundingClientRect(), b = take.getBoundingClientRect()
        gsap.timeline()
          .to(ok, { opacity: 1, scale: 1, duration: 0.45, ease: 'pouso' })
          .to(q, { x: b.left - a.left, y: b.top - a.top, scale: b.width / a.width, transformOrigin: '0 0', duration: 0.8, ease: 'power3.inOut' }, '+=0.4')
          .add(() => { take.classList.add('vivo'); nota.textContent = T.quadroVira }, '-=0.15')
          .fromTo(take, { scale: 0.97 }, { scale: 1, duration: 0.45, ease: 'pouso' }, '<')
      }
      bt.addEventListener('click', aprovar)
      if (reduzido()) aprovar(); else quando(c4, () => setTimeout(() => { M.afundar(bt); aprovar() }, 700))
    }
  }

  /* ================= 04 COMPARADOR ================= */
  function comparador() {
    const palcoC = $('.compare-stage')
    if (!palcoC) return
    const range = $('.cmp-range', palcoC), botoes = $$('.modo-b')
    const estado = { v: 50 }
    const pos = (v) => {
      estado.v = gsap.utils.clamp(0, 100, v)
      palcoC.style.setProperty('--pos', estado.v.toFixed(2) + '%')
      range.value = String(Math.round(estado.v)); range.setAttribute('aria-valuetext', Math.round(estado.v) + T.basicoPct)
      botoes.forEach((b) => b.setAttribute('aria-pressed', String(Number(b.dataset.to) === Math.round(estado.v))))
    }
    const deX = (x) => { const r = palcoC.getBoundingClientRect(); pos(((x - r.left) / r.width) * 100) }
    const proxy = document.createElement('div')
    Draggable.create(proxy, { type: 'x', trigger: palcoC, allowNativeTouchScrolling: true, onPress() { gsap.killTweensOf(estado); deX(this.pointerX) }, onDrag() { deX(this.pointerX) } })
    range.addEventListener('input', () => { gsap.killTweensOf(estado); pos(Number(range.value)) })
    botoes.forEach((b) => b.addEventListener('click', () => gsap.to(estado, { v: Number(b.dataset.to), duration: reduzido() ? 0 : 0.8, ease: 'studio', onUpdate: () => pos(estado.v) })))
    pos(50)
    if (!reduzido()) ScrollTrigger.create({ trigger: palcoC, start: 'top 60%', once: true, onEnter: () => {
      if (estado.v !== 50) return
      gsap.timeline().to(estado, { v: 72, duration: 0.8, ease: 'power2.inOut', onUpdate: () => pos(estado.v) })
        .to(estado, { v: 28, duration: 1.1, ease: 'power2.inOut', onUpdate: () => pos(estado.v) }, '+=0.5')
        .to(estado, { v: 50, duration: 0.8, ease: 'pouso', onUpdate: () => pos(estado.v) }, '+=0.4')
    } })
  }

  /* ================= 05 MICROINTERAÇÕES ================= */
  function micro() {
    const grade = $('.mi-grade')
    if (!grade || !M) return
    const tile = (n) => $(`[data-mi="${n}"]`, grade)
    const acoes = {}
    const nota = (t, txt) => { const n = $('.mi-nota', t); if (n) n.textContent = txt }
    const trava = new Set()
    const unico = (n, fn) => async () => { if (trava.has(n)) return; trava.add(n); try { await fn() } finally { trava.delete(n) } }
    // Gerar
    { const t = tile('gerar'); const s = html($('.mi-saldo', t), M.pecas.saldo(1200)); const b = html($('.mi-bt', t), M.pecas.botaoDeCredito({ rotulo: T.gerarTomada, custo: 24 }))
      acoes.gerar = unico('gerar', async () => { nota(t, ''); M.creditos.definirSaldo(s, 1200); const e = M.creditos.gerar(s, b, { custo: 24 }); await e.pronta; M.botao.gerando(b, true); e.concluir(); nota(t, T.reservados); await esperar(1800); M.botao.gerando(b, false); nota(t, T.tomadaPronta) })
      b.addEventListener('click', acoes.gerar) }
    // Falha
    { const t = tile('falha'); const s = html($('.mi-saldo', t), M.pecas.saldo(1200)); const b = html($('.mi-bt', t), M.pecas.botaoDeCredito({ rotulo: T.gerarTomada, custo: 24 }))
      acoes.falha = unico('falha', async () => { nota(t, ''); const lbl = $('.pp-rotulo', b); if (lbl) lbl.textContent = T.gerarTomada; const e = M.creditos.gerar(s, b, { custo: 24 }); await e.pronta; M.botao.gerando(b, true); await esperar(700); await M.creditos.devolver(s, b, { energia: e }); M.botao.gerando(b, false); if (lbl) lbl.textContent = T.tentarDeNovo; nota(t, T.falhou) })
      b.addEventListener('click', acoes.falha) }
    // Sem saldo
    { const t = tile('sem'); const s = html($('.mi-saldo', t), M.pecas.saldo(10)); const b = html($('.mi-bt', t), M.pecas.botaoDeCredito({ rotulo: T.gerarTomada, custo: 24, falta: true }))
      const avisar = () => { const n = $('.mi-nota', t); n.innerHTML = T.semSaldo }
      acoes.sem = unico('sem', async () => { nota(t, ''); const aviso = setTimeout(avisar, 900); await M.creditos.semSaldo(s, b); if (reduzido()) { clearTimeout(aviso); avisar() } })
      b.addEventListener('click', acoes.sem) }
    // Compra
    { const t = tile('compra'); const s = html($('.mi-saldo', t), M.pecas.saldo(40)); const p = $('.mi-pacote', t)
      acoes.compra = unico('compra', async () => { nota(t, ''); M.creditos.definirSaldo(s, 40); await M.creditos.comprar(s, p, { creditos: 500 }); nota(t, T.compra) })
      p.addEventListener('click', acoes.compra) }
    // Ímã: o mesmo ímã do cursor; no autoplay um ponteiro simulado chega perto
    { const t = tile('ima'); const b = $('.mi-ima', t), ponto = $('.mi-ponteiro', t), palcoI = $('.mi-palco', t)
      M.ima(b)
      acoes.ima = unico('ima', async () => {
        if (reduzido()) return
        const r = b.getBoundingClientRect(), pr = palcoI.getBoundingClientRect()
        const caminho = [[r.left - 60, r.top + r.height * 0.5], [r.left - 6, r.top + r.height * 0.4], [r.left + r.width * 0.3, r.top - 4], [r.right + 5, r.top + r.height * 0.7], [r.right + 70, r.bottom + 30]]
        gsap.set(ponto, { opacity: 1 })
        let [x, y] = caminho[0]
        for (const [nx, ny] of caminho.slice(1)) {
          const de = { x, y }
          await new Promise((ok) => gsap.to(de, { x: nx, y: ny, duration: 0.7, ease: 'power2.inOut', onUpdate: () => {
            gsap.set(ponto, { x: de.x - pr.left - 5, y: de.y - pr.top - 5 })
            const e = new PointerEvent('pointermove', { clientX: de.x, clientY: de.y, pointerType: 'mouse' }); e.simulado = true; dispatchEvent(e)
          }, onComplete: ok }))
          x = nx; y = ny
          await esperar(350)
        }
        gsap.to(ponto, { opacity: 0, duration: 0.2 })
      }) }
    // Pouso
    { const t = tile('pouso'); acoes.pouso = () => $$('.mi-cartoes div', t).forEach((c, i) => M.pouso(c, i * 48)) }
    // Clique
    { const t = tile('clique'); const b = $('.mi-afunda', t); M.afundarNoClique(b); acoes.clique = async () => { M.afundar(b); await esperar(700); M.afundar(b) } }
    // Origami pensando
    { const t = tile('pensa'); const conv = $('.mi-conversa', t); let pensando = null, relogio = 0
      acoes.pensa = () => {
        clearTimeout(relogio); if (pensando) pensando.parar()
        $$('.mi-resposta', conv).forEach((r) => r.remove())
        pensando = M.origamiPensando(conv)
        relogio = setTimeout(() => { const p = document.createElement('p'); p.className = 'mi-resposta'; p.textContent = T.resposta; conv.append(p); pensando.responder(p); pensando = null }, 2400)
      } }
    // Tsuru
    { const t = tile('tsuru'); const loop = $('.mi-tsuru', t); loop.innerHTML = M.pecas.tsuru({ tamanho: 22 })
      const b = html($('.mi-bt-tsuru', t), M.pecas.botaoDeCredito({ rotulo: T.novoTake, custo: 4, classe: 'g sm' }))
      acoes.tsuru = async () => { const ic = $('.pp-oricon', b); if (!ic) return; ic.classList.add('bate'); await esperar(1300); ic.classList.remove('bate') } }
    $$('.mi', grade).forEach((t) => { const n = t.dataset.mi, bt = $('.mi-tocar', t); if (bt && acoes[n]) bt.addEventListener('click', acoes[n]) })
    const ordem = ['gerar', 'falha', 'sem', 'compra', 'ima', 'pouso', 'clique', 'pensa', 'tsuru']
    const todas = () => ordem.forEach((n, i) => setTimeout(() => acoes[n] && acoes[n](), i * 650))
    $('.mi-todas').addEventListener('click', todas)
    if (!reduzido()) ScrollTrigger.create({ trigger: grade, start: 'top 62%', once: true, onEnter: todas })
  }
  function curvas() {
    const linhas = $$('.curve')
    linhas.forEach((l) => {
      const n = l.dataset.ease.match(/[\d.]+/g).map(Number), W = 34, H = 24
      $('path', l).setAttribute('d', `M0,${H} C${n[0] * W},${H - n[1] * H} ${n[2] * W},${H - n[3] * H} ${W},0`)
      l.addEventListener('click', () => tocar(l))
    })
    function tocar(l) {
      const d = $('.track i', l), tr = $('.track', l), fora = d.dataset.out !== '1'
      d.style.transition = reduzido() ? 'none' : `transform ${l.dataset.ms}ms ${l.dataset.ease}`
      d.style.transform = `translateX(${fora ? tr.clientWidth - d.offsetWidth : 0}px)`
      d.dataset.out = fora ? '1' : '0'
    }
    const todas = $('.curves-all')
    if (todas) todas.addEventListener('click', () => linhas.forEach((l, i) => setTimeout(() => tocar(l), reduzido() ? 0 : i * 110)))
  }

  /* ================= 06 DOBRA: o painel muda variáveis no :root dos iframes ================= */
  function dobra() {
    const painel = $('.db-painel')
    if (!painel || !PPSims) return
    const alvos = $$('.db-previa .sim').map((el) => el.__moldura).filter(Boolean)
    const leitura = $('.db-leitura', painel)
    const ACENTOS = { limao: null, menta: '#B8F5D2', pessego: '#FFD2A8', lilas: '#DCCBFF', ceu: '#BFE3FF' }
    const RAIOS = { '--r-xs': 2, '--r-tag': 3, '--r-sm': 4, '--r-card': 6, '--r-md': 8, '--r-panel': 10, '--r-lg': 16 }
    const PADRAO = { acento: 'limao', canto: '1', tema: 'dark', fonte: 'geist' }
    const previa = $('.db-previa')
    const est = { ...PADRAO }
    function vars() {
      const v = {}
      const c = ACENTOS[est.acento]
      for (const k of ['--accent', '--lime-300', '--lime-400']) v[k] = c
      v['--lime-50'] = c ? `color-mix(in srgb, ${c} 40%, #fff)` : null
      v['--lime-100'] = c ? `color-mix(in srgb, ${c} 70%, #fff)` : null
      v['--lime-500'] = c ? `color-mix(in srgb, ${c} 80%, #000)` : null
      const f = Number(est.canto)
      for (const [k, b] of Object.entries(RAIOS)) v[k] = f === 1 ? null : b * f + 'px'
      const mono = '"Geist Mono",ui-monospace,Menlo,monospace'
      v['--body'] = est.fonte === 'mono' ? mono : null
      v['--display'] = est.fonte === 'mono' ? mono : null
      return v
    }
    function aplicar(motivo) {
      const v = vars()
      alvos.forEach((m) => { m.vars = v; const w = m.janela; if (w && w.__sim) { w.__sim.vars(v); w.__sim.tema(est.tema) } })
      if (previa) previa.dataset.tema = est.tema === 'light' ? 'claro' : 'escuro'

      $$('.db-ctl', painel).forEach((ctl) => $$('[role="radio"]', ctl).forEach((b) => b.setAttribute('aria-checked', String(b.dataset.v === est[ctl.dataset.ctl]))))
      if (motivo) leitura.textContent = motivo
    }
    alvos.forEach((m) => m.aoFicarPronta(() => aplicar()))
    const textos = {
      acento: (v) => v === 'limao' ? T.acentoLimao : T.acentoOutro.replace('{v}', nomeDoAcento(v)),
      canto: (v) => (v === '0' ? T.cantoZero : v === '1' ? T.cantoPadrao : T.cantoMais),
      tema: (v) => (v === 'light' ? T.temaClaro : T.temaEscuro),
      fonte: (v) => (v === 'mono' ? T.fonteMono : T.fonteGeist),
    }
    let assumiu = false
    $$('.db-ctl', painel).forEach((ctl) => ctl.addEventListener('click', (e) => {
      const b = e.target.closest('[role="radio"]'); if (!b) return
      assumiu = true
      est[ctl.dataset.ctl] = b.dataset.v
      aplicar(textos[ctl.dataset.ctl](b.dataset.v))
    }))
    $('.db-zera', painel).addEventListener('click', () => { assumiu = true; Object.assign(est, PADRAO); aplicar(T.padrao) })
    aplicar(T.escolha)
    if (reduzido()) return
    ScrollTrigger.create({ trigger: '.dobra-art', start: 'top 55%', once: true, onEnter: async () => {
      const passos = [['acento', 'menta'], ['canto', '2.4'], ['tema', 'light'], ['fonte', 'mono'], ['acento', 'pessego']]
      for (const [k, v] of passos) { await esperar(1700); if (assumiu) return; est[k] = v; aplicar(textos[k](v)) }
      await esperar(2200); if (assumiu) return
      Object.assign(est, PADRAO); aplicar(T.padraoFim)
    } })
  }

  /* ================= 07 SITE: a home rola de verdade dentro da moldura ================= */
  function site(reduz) {
    const sec = $('.site-sec'), simEl = $('.sim[data-tipo="site"]'), celEl = $('.sim[data-tipo="siteCel"]')
    if (!sec || !simEl || !simEl.__moldura) return null
    const m = simEl.__moldura, mc = celEl && celEl.__moldura
    const caps = $$('.site-caps li')
    let secoes = null, altura = 0, alturaCel = 0, pedido = 0, ultimoY = -1, ultimoYc = -1, prog = 0
    const ouvir = (e) => {
      if (!e.data || e.data.type !== 'secoes') return
      if (m.frame && e.source === m.frame.contentWindow) { secoes = e.data.secoes; altura = e.data.altura; enviar(true) }
      else if (mc && mc.frame && e.source === mc.frame.contentWindow) { alturaCel = e.data.altura; enviar(true) }
    }
    addEventListener('message', ouvir)
    const topoDe = (id) => { const s = secoes && secoes.find((x) => x.id === id); return s ? s.top : null }
    // De seção em seção: a home descansa no topo de cada uma e só anda no meio do trecho, sem parar no meio do caminho.
    const suave = (a, b, x) => { const t = Math.min(1, Math.max(0, (x - a) / (b - a))); return t * t * (3 - 2 * t) }
    function alvoY(p) {
      if (!secoes) return 0
      const max = Math.max(0, altura - 720)
      const marcos = caps.map((c, i) => { const v = topoDe(c.dataset.sec); return v == null ? (i ? null : 0) : Math.min(v, max) })
      const validos = marcos.map((v, i) => (v == null ? marcos.slice(0, i).filter((x) => x != null).pop() || 0 : v))
      const n = validos.length - 1, t = p * n, i = Math.min(n - 1, Math.floor(t)), f = suave(0.3, 0.7, t - i)
      const atual = Math.min(n, Math.round(i + f))
      caps.forEach((c, k) => c.classList.toggle('is-on', k === atual))
      return validos[i] + (validos[i + 1] - validos[i]) * f
    }
    function enviar(forca) {
      cancelAnimationFrame(pedido)
      pedido = requestAnimationFrame(() => {
        const y = Math.round(alvoY(prog))
        const w = m.janela
        if (w && (forca || y !== ultimoY)) { ultimoY = y; w.postMessage({ type: 'scrollTo', y, instant: !!forca }, '*') }
        const wc = mc && mc.janela
        if (wc && alturaCel) { const yc = Math.round(Math.min(1, prog * 1.6) * Math.max(0, alturaCel - 844)); if (forca || yc !== ultimoYc) { ultimoYc = yc; wc.postMessage({ type: 'scrollTo', y: yc, instant: !!forca }, '*') } }
      })
    }
    m.aoFicarPronta(() => { try { m.janela.postMessage({ type: 'medir' }, '*') } catch (e) {} })
    if (mc) mc.aoFicarPronta(() => { try { mc.janela.postMessage({ type: 'medir' }, '*') } catch (e) {} })
    if (reduz) { caps.forEach((c) => c.classList.add('is-on')); return () => removeEventListener('message', ouvir) }
    sec.classList.add('is-pin')
    const st = ScrollTrigger.create({ trigger: sec, start: 'top top', end: () => '+=' + Math.round(innerHeight * 2.5), pin: true, anticipatePin: 1, onUpdate: (s) => { prog = s.progress; enviar(false) } })
    return () => { st.kill(); sec.classList.remove('is-pin'); removeEventListener('message', ouvir) }
  }

  /* ================= 08 CELULAR: aparelhos, notas numeradas e índices em anel ================= */
  function celular(reduz) {
    const art = $('.cel-art'), cels = $$('.cel')
    if (!art) return null
    const inds = $$('.indices .ind'), odos = $$('.indices .odo').map(odometro)
    const sts = []
    if (!reduz) gsap.from(cels, { y: 60, autoAlpha: 0, duration: 1, ease: 'studio', stagger: 0.12, scrollTrigger: { trigger: art, start: 'top 75%', once: true } })
    const encher = () => { inds.forEach((d) => d.classList.add('on')); odos.forEach((o, i) => o.tocar(i * 0.15)) }
    if (reduz) encher(); else sts.push(ScrollTrigger.create({ trigger: '.indices', start: 'top 80%', once: true, onEnter: encher }))
    return () => sts.forEach((s) => s.kill())
  }

  /* ================= 09 TURNO: relógio sobre o céu fotografado ================= */
  function noite() {
    const n = $('.night')
    if (!n) return
    const ticks = $('.c-ticks', n)
    for (let i = 0; i < 12; i++) {
      const a = (i * 30 * Math.PI) / 180, l = document.createElementNS('http://www.w3.org/2000/svg', 'line')
      l.setAttribute('x1', 60 + Math.sin(a) * 48); l.setAttribute('y1', 60 - Math.cos(a) * 48); l.setAttribute('x2', 60 + Math.sin(a) * 53); l.setAttribute('y2', 60 - Math.cos(a) * 53)
      ticks.appendChild(l)
    }
    const hora = $('.clock-time', n), itens = $$('.night-list li', n)
    const definir = (li) => {
      const h = Number(li.dataset.h)
      n.dataset.h = String(h); n.style.setProperty('--h', String(h))
      hora.textContent = (h < 10 ? '0' : '') + h + ':00'
      itens.forEach((x) => x.classList.toggle('is-on', x === li))
    }
    let atual = itens[0]
    const escolher = () => {
      const linha = innerHeight * 0.6
      let e = itens[0]
      itens.forEach((li) => { if (li.getBoundingClientRect().top <= linha) e = li })
      if (e !== atual) { atual = e; definir(e) }
    }
    definir(itens[0])
    const relogio = ScrollTrigger.create({ trigger: $('.night-list', n), start: 'top 60%', end: 'bottom 60%', refreshPriority: -1, onUpdate: escolher, onRefresh: escolher, onLeave: escolher, onLeaveBack: escolher })
    if (PPSims && PPSims.quadrosDoCeu) { const q = PPSims.quadrosDoCeu(); if (q.length) setCeu(q, relogio) }
  }

  /**
   * Céu fotografado: setCeu(fotos) desenha num <canvas> (cover) um crossfade contínuo entre as fotos conforme a hora
   * do relógio (05:00 = 1ª, ~07:00 = 2ª, ~09:00 = 3ª, 12:00 = 4ª), com escala e deslocamento lentos ligados à
   * rolagem (paralaxe de ~4%). Estrelas só na noite, grão por cima, véu atrás do texto para AA e o texto troca de cor
   * quando o céu clareia. Com movimento reduzido fica a 3ª foto parada (o fundo em CSS), sem canvas.
   */
  const HORAS_DAS_FOTOS = [5, 7, 9, 12]
  const HORA_EM_QUE_O_TEXTO_ESCURECE = 9.7
  function setCeu(fotos, relogio) {
    const n = $('.night'), ceu = $('.night-sky', n)
    if (!n || !ceu || !fotos || !fotos.length) return
    if (!$('.night-veu', n)) { const veu = document.createElement('i'); veu.className = 'night-veu'; veu.setAttribute('aria-hidden', 'true'); ceu.after(veu) }
    n.classList.add('tem-ceu')
    if (reduzido()) { n.classList.add('ceu-parado'); return }
    let canvas = $('.ceu-quadros', ceu)
    if (!canvas) { canvas = document.createElement('canvas'); canvas.className = 'ceu-quadros'; canvas.setAttribute('aria-hidden', 'true'); ceu.prepend(canvas) }
    const ctx = canvas.getContext('2d')
    const imgs = fotos.map((src) => { const im = new Image(); im.decoding = 'async'; im.src = src; im.onload = () => pedir(); return im })
    const horas = HORAS_DAS_FOTOS.slice(0, imgs.length)
    let hora = 5, paralaxe = 0, pedido = 0
    const cobrir = (im, alfa, escala, dy) => {
      if (!im.complete || !im.naturalWidth || alfa <= 0) return
      const W = canvas.width, H = canvas.height
      const k = Math.max(W / im.naturalWidth, H / im.naturalHeight) * escala, w = im.naturalWidth * k, h = im.naturalHeight * k
      ctx.globalAlpha = alfa
      ctx.drawImage(im, (W - w) / 2, (H - h) / 2 + dy, w, h)
    }
    const desenhar = () => {
      pedido = 0
      const W = canvas.clientWidth, H = canvas.clientHeight, dpr = Math.min(2, devicePixelRatio || 1)
      if (canvas.width !== Math.round(W * dpr) || canvas.height !== Math.round(H * dpr)) { canvas.width = Math.round(W * dpr); canvas.height = Math.round(H * dpr) }
      let i = 0
      while (i < horas.length - 2 && hora >= horas[i + 1]) i++
      const t = gsap.utils.clamp(0, 1, (hora - horas[i]) / (horas[i + 1] - horas[i]))
      const mistura = t * t * (3 - 2 * t)
      const escala = 1.05 + 0.03 * paralaxe, dy = (paralaxe - 0.5) * 0.04 * canvas.height
      ctx.globalAlpha = 1
      cobrir(imgs[i], 1, escala, dy)
      cobrir(imgs[i + 1], mistura, escala, dy)
      ctx.globalAlpha = 1
    }
    const pedir = () => { if (!pedido) pedido = requestAnimationFrame(desenhar) }
    // A hora anda junto com o relógio: entre o horário de um item e o do próximo, pela posição deles na linha de leitura.
    const itens = $$('.night-list li', n)
    const horaContinua = () => {
      const linha = innerHeight * 0.6, topos = itens.map((li) => li.getBoundingClientRect().top)
      if (topos[0] > linha) return 5
      let i = 0
      while (i < itens.length - 1 && topos[i + 1] <= linha) i++
      if (i === itens.length - 1) return Number(itens[i].dataset.h)
      const f = gsap.utils.clamp(0, 1, (linha - topos[i]) / (topos[i + 1] - topos[i]))
      return Number(itens[i].dataset.h) + f * (Number(itens[i + 1].dataset.h) - Number(itens[i].dataset.h))
    }
    const ajustar = () => {
      hora = horaContinua()
      n.classList.toggle('claro', hora >= HORA_EM_QUE_O_TEXTO_ESCURECE)
      n.style.setProperty('--noite', String(gsap.utils.clamp(0, 1, (8 - hora) / 3)))
      pedir()
    }
    ScrollTrigger.create({ trigger: n, start: 'top bottom', end: 'bottom top', onUpdate: (s) => { paralaxe = s.progress; ajustar() }, onRefresh: (s) => { paralaxe = s.progress; ajustar() } })
    new ResizeObserver(pedir).observe(canvas)
    ajustar()
  }
  window.setCeu = setCeu

  /* Cartões do turno: o que os agentes entregam e onde entra a minha escolha; cada um anima uma vez ao assentar. */
  function contrato() {
    const lista = $('.contrato')
    if (!lista) return
    const rodadas = $('.ct-decisoes .odo') && odometro($('.ct-decisoes .odo'))
    const animar = async () => {
      const linhas = $$('.ct-tabela span')
      const larg = $$('.ct-larguras span')
      const escolha = $$('.ct-escolha span')
      if (reduzido()) { larg.forEach((s) => s.classList.add('on')); escolha.forEach((s) => s.classList.add('on')); return }
      if (rodadas) rodadas.tocar(0.2)
      for (let i = 0; i < 3; i++) { linhas.forEach((s, k) => s.classList.toggle('on', k === i)); larg[i] && larg[i].classList.add('on'); escolha[i] && escolha[i].classList.add('on'); await esperar(520) }
      $$('.ct-ic').forEach((ic) => gsap.fromTo($$('path,circle,rect,line', ic), { drawSVG: '0%' }, { drawSVG: '100%', duration: 0.9, ease: 'quieto', stagger: 0.08 }))
    }
    ScrollTrigger.create({ trigger: lista, start: 'top 70%', once: true, onEnter: animar })
  }

  /* ================= 10 NÚMEROS e 11 APRENDI ================= */
  function numeros(reduz) {
    const cards = $$('.stats .stat')
    if (!cards.length) return
    const odos = cards.map((c) => odometro($('.odo', c)))
    const icones = cards.map((c) => $$('path,circle,rect,line', $('.st-ic', c)))
    if (reduz) return
    icones.forEach((ic) => gsap.set(ic, { drawSVG: '0%' }))
    ScrollTrigger.create({ trigger: '.stats', start: 'top 62%', once: true, onEnter: () => {
      cards.forEach((c, i) => {
        odos[i].tocar(i * 0.18)
        gsap.to(icones[i], { drawSVG: '100%', duration: 0.9, ease: 'quieto', delay: i * 0.18, stagger: 0.06 })
      })
    } })
  }
  function licoes(reduz) {
    const itens = $$('.licoes-l li')
    if (!itens.length || reduz) return
    itens.forEach((li) => {
      const partes = $$('path,circle,rect,line', $('.li-ic', li))
      gsap.set(partes, { drawSVG: '0%' })
      gsap.set($$('h3,p,.li-n', li), { autoAlpha: 0, y: 8 })
    })
    ScrollTrigger.batch(itens, { start: 'top 82%', once: true, onEnter: (lote) => lote.forEach((li, i) => {
      gsap.to($$('path,circle,rect,line', $('.li-ic', li)), { drawSVG: '100%', duration: 0.9, ease: 'quieto', delay: i * 0.12, stagger: 0.07 })
      gsap.to($$('.li-n,h3,p', li), { autoAlpha: 1, y: 0, duration: 0.5, ease: 'quieto', delay: 0.25 + i * 0.12, stagger: 0.07 })
    }) })
  }

  /* ---------- Linha dos 23 dias: arrastar, teclado; o fio se preenche em limão até o marco em foco ---------- */
  function dias() {
    const vp = $('.days-viewport'), trilho = $('.days-trilho'), cheio = $('.days-fio-cheio')
    if (!vp || !trilho) return null
    const itens = $$('.days-track li', trilho)
    const pad = () => parseFloat(getComputedStyle(vp).paddingLeft) || 0
    const minX = () => Math.min(0, vp.clientWidth - pad() - trilho.offsetWidth - (parseFloat(getComputedStyle(trilho).marginRight) || 0))
    const prender = (x) => gsap.utils.clamp(minX(), 0, x)
    vp.style.overflow = 'hidden'
    let emFoco = null
    const focar = (it) => {
      if (!it || it === emFoco) return
      emFoco = it
      itens.forEach((x) => x.classList.toggle('is-on', x === it))
      cheio.style.setProperty('--cheio', it.offsetLeft + 'px')
    }
    // Em foco: o marco mais perto do primeiro terço da janela.
    const peloMeio = () => {
      const r = vp.getBoundingClientRect(), alvo = r.left + Math.min(r.width * 0.33, 420)
      let melhor = itens[0], dist = Infinity
      itens.forEach((it) => { const d = Math.abs(it.getBoundingClientRect().left - alvo); if (d < dist) { dist = d; melhor = it } })
      focar(melhor)
    }
    let arrastou = false
    const [d] = Draggable.create(trilho, { type: 'x', bounds: { minX: minX(), maxX: 0 }, edgeResistance: 0.85, dragClickables: true, zIndexBoost: false, onDrag: peloMeio,
      onDragEnd() { arrastou = true; setTimeout(() => (arrastou = false), 60); const alvo = gsap.utils.snap(itens.map((it) => prender(-it.offsetLeft)), this.x); gsap.to(trilho, { x: alvo, duration: reduzido() ? 0 : 0.5, ease: 'power3.out', onUpdate: () => { d.update(); peloMeio() } }) } })
    const bloquear = (e) => { if (arrastou) { e.preventDefault(); e.stopPropagation() } }
    trilho.addEventListener('click', bloquear, true)
    const foco = (e) => { const it = itens.find((c) => c.contains(e.target)); if (!it) return; vp.scrollLeft = 0; focar(it); gsap.to(trilho, { x: prender(-(it.offsetLeft - Math.min(vp.clientWidth * 0.33, 420) + pad())), duration: reduzido() ? 0 : 0.45, ease: 'power3.out', onUpdate: () => d.update() }) }
    trilho.addEventListener('focusin', foco)
    const ro = new ResizeObserver(() => { d.applyBounds({ minX: minX(), maxX: 0 }); gsap.set(trilho, { x: prender(Number(gsap.getProperty(trilho, 'x'))) }); d.update(); peloMeio() })
    ro.observe(vp)
    focar(itens[0])
    return () => { ro.disconnect(); d.kill(); trilho.removeEventListener('click', bloquear, true); trilho.removeEventListener('focusin', foco); vp.style.overflow = ''; gsap.set(trilho, { clearProps: 'transform' }) }
  }

  /* ---------- Fecho: o avião novo pousa nos botões (só se aviao.js existir; sem ele, nada solto na tela) ---------- */
  function decolar(reduz) {
    const ctas = $('[data-aviao-pouso]')
    if (!ctas || reduz || !temAviao()) return
    // Pousa ao lado do último botão, voando pela faixa do título do fecho.
    const voar = () => { let pouso = {}; try { pouso = pousoAoLado(ctas, $('.chapter-title', ctas), $('.ctas .cta:last-child', ctas)) } catch (e) {} try { window.PPAviao.voar(ctas, pouso) } catch (e) {} }
    ScrollTrigger.create({ trigger: ctas, start: 'top 60%', once: true, onEnter: voar })
  }
})()
