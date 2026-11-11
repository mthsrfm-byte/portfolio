/* Telas do estúdio e a home, em código, dentro de iframes srcdoc isolados.
   Monta perto da viewport, desmonta longe (no máximo ~6 vivas), toca o roteiro só com a moldura à vista. */
(() => {
  'use strict'
  /* Duas fontes para as mesmas telas:
     - arquivo único: tudo vem do <script id="pp-payload"> (base64) e vira Blob URL;
     - tema WordPress: window.PPCaseConfig.base aponta para assets/cases/paperplane/, e cada tela é buscada por URL
       só quando a moldura chega perto da tela (fetch sob demanda). */
  const CFG = window.PPCaseConfig || null
  const dados = document.getElementById('pp-payload')
  if (!dados && !(CFG && CFG.base)) return
  const POR_URL = !dados
  const BASE = POR_URL ? String(CFG.base).replace(/\/?$/, '/') : ''
  const V = POR_URL && CFG.ver ? '?v=' + encodeURIComponent(CFG.ver) : '' // versão do tema: troca o cache a cada deploy
  let P = null
  const payload = () => P || (P = JSON.parse(dados.textContent))
  const decod = new TextDecoder()
  const texto = (b64) => decod.decode(Uint8Array.from(atob(b64), (c) => c.charCodeAt(0)))
  const reduzido = () => matchMedia('(prefers-reduced-motion: reduce)').matches
  const LIMITE_VIVAS = 6

  /* ---------- recursos ---------- */
  const cacheTexto = new Map()
  const extra = (k) => { if (!cacheTexto.has(k)) cacheTexto.set(k, texto(payload().x[k])); return cacheTexto.get(k) }
  const urls = new Map()
  function blobUrl(chave, tipo) {
    if (!urls.has(chave)) urls.set(chave, URL.createObjectURL(new Blob([extra(chave)], { type: tipo })))
    return urls.get(chave)
  }
  const midias = new Map()
  function midia(chave) {
    if (POR_URL) {
      const [orig, ...resto] = chave.split('/'), nome = resto.join('/')
      return BASE + (orig === 'sim' ? 'sim/media/' : orig === 'vid' ? 'sim/video/' : orig === 'site' ? 'site/media/' : 'pg/') + nome
    }
    if (midias.has(chave)) return midias.get(chave)
    const bruto = payload().m[chave]
    if (!bruto) { midias.set(chave, 'data:,'); return 'data:,' }
    const i = bruto.indexOf('|'), tipo = bruto.slice(0, i)
    const bin = atob(bruto.slice(i + 1)), u8 = new Uint8Array(bin.length)
    for (let k = 0; k < bin.length; k++) u8[k] = bin.charCodeAt(k)
    const url = URL.createObjectURL(new Blob([u8], { type: tipo }))
    midias.set(chave, url)
    return url
  }
  const temMidia = (chave) => (POR_URL ? (CFG.midias || []).indexOf(chave) >= 0 : !!payload().m[chave])
  // Por URL, os caminhos relativos (media/…, video/…) resolvem pelo <base> do documento da tela.
  const trocarMidias = (html, origem) => POR_URL ? html : html.replace(/media\/([\w.-]+\.(?:webp|svg|mp4|png|jpg))/g, (_m, n) => midia(origem + '/' + n))
    .replace(/data-sim-video="video\/([\w.-]+\.mp4)"/g, (_m, n) => 'data-sim-video="' + midia('vid/' + n) + '"')
  const htmlTelas = new Map()
  const pedidos = new Map()
  /** Fragmento (corpo) de uma tela; por URL, carrega uma vez e guarda. */
  function carregarTela(nome) {
    if (htmlTelas.has(nome)) return Promise.resolve(htmlTelas.get(nome))
    if (!POR_URL) { htmlTelas.set(nome, trocarMidias(texto(payload().t[nome].h), 'sim')); return Promise.resolve(htmlTelas.get(nome)) }
    if (!pedidos.has(nome)) pedidos.set(nome, fetch(BASE + 'sim/screens/' + nome + '.html' + V).then((r) => (r.ok ? r.text() : '')).then((h) => { htmlTelas.set(nome, h); return h }))
    return pedidos.get(nome)
  }
  const htmlDaTela = (nome) => htmlTelas.get(nome) || ''
  const infoDaTela = (nome) => (POR_URL ? (CFG.telas || {})[nome] : payload().t[nome]) || { a: {}, b: {}, v: { width: 1440, height: 900 } }
  let pecasHtml = null
  const carregarPecas = () => (POR_URL ? (pecasHtml ? Promise.resolve(pecasHtml) : fetch(BASE + 'sim/pecas.html' + V).then((r) => r.text()).then((h) => (pecasHtml = h))) : Promise.resolve(trocarMidias(extra('pecas'), 'sim')))
  const esc = (v) => String(v).replace(/&/g, '&amp;').replace(/"/g, '&quot;')
  const attrs = (o) => Object.entries(o || {}).map(([k, v]) => k + '="' + esc(v) + '"').join(' ')

  function cabeca(comApp) {
    if (POR_URL) {
      return '<meta charset="utf-8"><base href="' + esc(BASE + 'sim/') + '">' +
        (comApp ? '<link rel="stylesheet" href="app.css' + V + '">' : '') +
        '<link rel="stylesheet" href="../micro.css' + V + '"><link rel="stylesheet" href="extra.css' + V + '">'
    }
    return '<meta charset="utf-8">' +
      (comApp ? '<link rel="stylesheet" href="' + blobUrl('app', 'text/css') + '">' : '') +
      '<link rel="stylesheet" href="' + blobUrl('microCss', 'text/css') + '">' +
      '<link rel="stylesheet" href="' + blobUrl('extra', 'text/css') + '">'
  }
  const rodape = () => POR_URL
    ? '<script src="../micro.js' + V + '"><\/script><script src="rt.js' + V + '"><\/script>'
    : '<script src="' + blobUrl('microJs', 'text/javascript') + '"><\/script><script src="' + blobUrl('rt', 'text/javascript') + '"><\/script>'

  async function docDaTela(nome) {
    const t = infoDaTela(nome)
    const corpo = await carregarTela(nome)
    return '<!doctype html><html ' + attrs(t.a) + '><head>' + cabeca(true) + '</head><body ' + attrs(t.b) + '>' + corpo + rodape() + '</body></html>'
  }
  async function docDasPecas() {
    const html = await carregarPecas()
    return '<!doctype html><html lang="pt-BR" data-theme="dark"><head>' + cabeca(true) +
      '<style>html,body{margin:0;background:transparent!important;overflow:hidden;height:100%}' +
      '.pv-fila{display:grid;grid-template-columns:repeat(4,1fr);grid-auto-rows:1fr;gap:1px;height:100vh;background:var(--line)}' +
      '.pv-peca{display:flex;align-items:center;justify-content:center;padding:18px;background:var(--bg);min-width:0;overflow:hidden}' +
      '.pv-peca .oriload{position:relative;inset:auto;width:100%;height:150px}' +
      '.pv-peca .sbn-frame{width:250px;list-style:none}.pv-peca .campo-mencoes{width:300px}' +
      '.pv-peca .credit{position:static}' +
      '.app.v2.sim-peca{display:block;height:auto;max-width:none;padding:0;margin:0;background:none;position:static;min-height:0}</style></head>' +
      '<body><div class="app v2 sim-peca" data-cop="min"><div class="pv-fila">' + html + '</div></div>' + rodape() + '</body></html>'
  }
  function docDoCursor() {
    return '<!doctype html><html lang="pt-BR"><head>' + cabeca(false) +
      '<style>html,body{margin:0;height:100%;overflow:hidden}body.pp-micro{background:var(--grao-papel),var(--fundo-pagina);display:grid;place-items:center;font-family:var(--body)}' +
      '.fila{display:flex;gap:18px;align-items:center}</style></head>' +
      '<body class="pp-micro" data-theme="light"><div class="fila"><button type="button" class="pp-btn a">Aprovar</button><button type="button" class="pp-btn g">Editar com Origami</button><a href="#" class="pp-btn g">Ver a cena</a></div>' + rodape() + '</body></html>'
  }
  function docDaHome(chave) { return trocarMidias(extra(chave), 'site') }
  const urlDaHome = (tipo) => BASE + (tipo === 'site' ? 'site/home.html' : 'site/home-celular.html') + V

  /* ---------- molduras ---------- */
  const molduras = []
  let ordem = 0
  class Moldura {
    constructor(el) {
      this.el = el
      this.tipo = el.dataset.tipo || 'tela'
      this.tela = el.dataset.tela
      this.roteiro = el.dataset.roteiro || ''
      const vp = this.tipo === 'tela' && this.tela ? infoDaTela(this.tela).v : null
      this.vw = Number(el.dataset.vw) || (vp ? vp.width : 1440)
      this.vh = Number(el.dataset.vh) || (vp ? vp.height : 900)
      this.frame = null; this.pronto = false; this.visivel = false; this.tocando = false; this.usado = 0
      this.ouvintes = []
      el.style.setProperty('--sim-ar', this.vw + ' / ' + this.vh)
      el.classList.add('sim-on')
      this.palco = document.createElement('div')
      this.palco.className = 'sim-escala'
      el.prepend(this.palco)
      new ResizeObserver(() => this.escalar()).observe(el)
      molduras.push(this)
    }
    escalar() {
      if (!this.frame) return
      const s = this.el.clientWidth / this.vw
      this.frame.style.transform = 'scale(' + s + ')'
    }
    async documento() {
      if (this.tipo === 'pecas') return docDasPecas()
      if (this.tipo === 'cursor') return docDoCursor()
      if (this.tipo === 'site') return docDaHome('home')
      if (this.tipo === 'siteCel') return docDaHome('homeCel')
      return docDaTela(this.tela)
    }
    montar() {
      if (this.frame) return
      const f = document.createElement('iframe')
      f.className = 'sim-frame'
      f.title = this.el.getAttribute('aria-label') || 'Tela do estúdio'
      f.setAttribute('aria-hidden', 'true')
      f.tabIndex = -1
      f.setAttribute('scrolling', 'no')
      f.width = this.vw; f.height = this.vh
      f.name = 'sim' + (++ordem)
      // Só vale o load do documento da tela (o iframe vazio também dispara um, antes do srcdoc chegar).
      const aoCarregar = () => {
        if (!f.getAttribute('srcdoc') && !f.getAttribute('src')) return
        f.removeEventListener('load', aoCarregar)
        this.pronto = true
        const w = f.contentWindow
        try {
          const extras = (this.el.dataset.extras || '').split(',').filter(Boolean)
          if (extras.length && w.__sim) Promise.all(extras.map(carregarTela)).then(() => { const mapa = {}; extras.forEach((n) => (mapa[n] = htmlDaTela(n))); try { w.__sim.telas(mapa) } catch (e) {} })
          if (this.vars && w.__sim) w.__sim.vars(this.vars)
        } catch (e) {}
        this.el.classList.add('sim-pronta')
        this.ouvintes.forEach((fn) => fn(this))
        this.atualizar()
      }
      f.addEventListener('load', aoCarregar)
      // A home é um documento inteiro: por URL, abre direto; as telas viram srcdoc (corpo buscado + cabeça montada aqui).
      if (POR_URL && (this.tipo === 'site' || this.tipo === 'siteCel')) f.src = urlDaHome(this.tipo)
      else this.documento().then((doc) => { if (this.frame === f) f.srcdoc = doc })
      this.palco.append(f)
      this.frame = f
      this.escalar()
      this.usado = performance.now()
      podar(this)
    }
    desmontar() {
      if (!this.frame) return
      this.frame.remove(); this.frame = null; this.pronto = false; this.tocando = false
      this.el.classList.remove('sim-pronta')
    }
    get janela() { return this.frame && this.pronto ? this.frame.contentWindow : null }
    aoFicarPronta(fn) { if (this.pronto) fn(this); else this.ouvintes.push(fn) }
    atualizar() {
      const w = this.janela
      if (!w || !w.__sim || !this.roteiro || reduzido() || this.el.dataset.manual) return
      const deve = this.visivel && !document.hidden
      if (deve && !this.tocando) { this.tocando = true; w.__sim.tocar(this.roteiro) }
      else if (!deve && this.tocando) { this.tocando = false; w.__sim.parar() }
    }
  }
  function vivas() { return molduras.filter((m) => m.frame) }
  function distancia(m) {
    const r = m.el.getBoundingClientRect()
    if (r.bottom < 0) return -r.bottom
    if (r.top > innerHeight) return r.top - innerHeight
    return 0
  }
  function podar(nova) {
    const total = () => document.querySelectorAll('iframe').length
    if (total() <= LIMITE_VIVAS) return
    const candidatas = vivas().filter((m) => m !== nova).sort((a, b) => distancia(b) - distancia(a))
    for (const m of candidatas) { if (total() <= LIMITE_VIVAS) break; if (distancia(m) > innerHeight * 0.3) m.desmontar() }
  }
  const ioPerto = new IntersectionObserver((entradas) => {
    entradas.forEach((e) => { const m = e.target.__moldura; if (m && e.isIntersecting) m.montar() })
  }, { rootMargin: '25% 0px 25% 0px' })
  const ioVisivel = new IntersectionObserver((entradas) => {
    entradas.forEach((e) => { const m = e.target.__moldura; if (!m) return; m.visivel = e.isIntersecting; m.atualizar() })
  }, { threshold: 0.3 })
  document.addEventListener('visibilitychange', () => molduras.forEach((m) => m.atualizar()))
  // Rolando, as molduras que ficaram longe saem para nunca passar de ~6 iframes vivos.
  let podaPendente = 0
  addEventListener('scroll', () => { if (podaPendente) return; podaPendente = setTimeout(() => { podaPendente = 0; podar(null) }, 250) }, { passive: true })

  /* Tema da tela: o roteiro avisa quando a tela troca de claro para escuro, e o palco em volta acompanha. */
  const temaDoPalco = (t) => (t === 'light' || t === 'claro' ? 'claro' : 'escuro')
  addEventListener('message', (e) => {
    if (!e.data || e.data.type !== 'sim-tema') return
    const m = molduras.find((x) => x.frame && x.frame.contentWindow === e.source)
    if (!m) return
    const tema = temaDoPalco(e.data.tema)
    m.el.dataset.tema = tema
    const palco = m.el.closest('[data-tema-segue]')
    if (palco) palco.dataset.tema = tema
  })

  function registrar(el) {
    if (el.__moldura) return el.__moldura
    const m = new Moldura(el)
    el.__moldura = m
    ioPerto.observe(el); ioVisivel.observe(el)
    return m
  }

  /* ---------- palco das 10 etapas: moldura parada, só o conteúdo troca ---------- */
  class PalcoDeEtapas {
    constructor(el, etapas) {
      this.el = el; this.etapas = etapas; this.atual = 0; this.desejado = 0; this.ocupado = false; this.visivel = false
      this.camadas = []; this.frente = 0; this.prontas = 0; this.montado = false
      el.style.setProperty('--sim-ar', '1440 / 900')
      el.classList.add('sim-on')
      new ResizeObserver(() => this.escalar()).observe(el)
      const io = new IntersectionObserver((es) => es.forEach((e) => { if (e.isIntersecting) this.montar(); else this.desmontar() }), { rootMargin: '60% 0px' })
      io.observe(el)
      new IntersectionObserver((es) => es.forEach((e) => { this.visivel = e.isIntersecting; this.atualizar() }), { threshold: 0.3 }).observe(el)
    }
    escalar() { const s = this.el.clientWidth / 1440; this.camadas.forEach((c) => (c.frame.style.transform = 'scale(' + s + ')')) }
    montar() {
      if (this.montado) return
      this.montado = true
      for (let i = 0; i < 2; i++) {
        const camada = document.createElement('div')
        camada.className = 'sim-escala etapa-camada'
        const f = document.createElement('iframe')
        f.className = 'sim-frame'; f.tabIndex = -1; f.setAttribute('aria-hidden', 'true'); f.width = 1440; f.height = 900; f.setAttribute('scrolling', 'no')
        f.title = 'Tela do estúdio'
        camada.append(f)
        this.el.append(camada)
        this.camadas.push({ camada, frame: f })
        const aoCarregar = () => { if (!f.getAttribute('srcdoc')) return; f.removeEventListener('load', aoCarregar); this.prontas++; if (this.prontas === 2) this.aoPronto() }
        f.addEventListener('load', aoCarregar)
        docDaTela(this.etapas[i === 0 ? this.atual : Math.min(this.etapas.length - 1, this.atual + 1)].tela).then((doc) => { f.srcdoc = doc })
      }
      this.camadas[1].camada.style.opacity = '0'
      this.camadas[1].camada.style.visibility = 'hidden'
      this.escalar()
    }
    desmontar() {
      if (!this.montado || this.ocupado) return
      this.camadas.forEach((c) => c.camada.remove())
      this.camadas = []; this.prontas = 0; this.montado = false; this.frente = 0; this.tocando = null
      this.el.classList.remove('sim-pronta')
    }
    aoPronto() {
      this.el.classList.add('sim-pronta')
      carregarTela('roteiro-origami').then(() => this.camadas.forEach((c) => { try { c.frame.contentWindow.__sim.telas({ 'roteiro-origami': htmlDaTela('roteiro-origami') }) } catch (e) {} }))
      // As dez telas vêm uma vez, em segundo plano, para a troca ao rolar ser imediata.
      this.etapas.forEach((e) => carregarTela(e.tela))
      this.atualizar()
      if (this.desejado !== this.atual) this.mostrar(this.desejado)
    }
    win(i) { const c = this.camadas[i]; return c && c.frame.contentWindow && c.frame.contentWindow.__sim ? c.frame.contentWindow : null }
    atualizar() {
      const w = this.win(this.frente)
      if (!w || reduzido()) return
      const roteiro = this.etapas[this.atual].roteiro
      if (this.visivel && !document.hidden && roteiro) { if (this.tocando !== this.atual) { this.tocando = this.atual; w.__sim.tocar(roteiro) } }
      else if (this.tocando != null) { this.tocando = null; w.__sim.parar() }
    }
    async mostrar(i) {
      this.desejado = i
      if (this.ocupado || this.prontas < 2) return
      this.ocupado = true
      try {
        while (this.atual !== this.desejado) {
          const alvo = this.desejado
          const tras = 1 - this.frente
          const wTras = this.win(tras), wFrente = this.win(this.frente)
          const info = this.etapas[alvo]
          if (wTras) {
            wTras.__sim.carregar(await carregarTela(info.tela))
            const imgs = Array.from(wTras.document.images).slice(0, 24)
            await Promise.race([Promise.all(imgs.map((im) => (im.decode ? im.decode().catch(() => {}) : null))), new Promise((r) => setTimeout(r, 260))])
          }
          if (wFrente) { this.tocando = null; wFrente.__sim.parar() }
          const velha = this.camadas[this.frente].camada, nova = this.camadas[tras].camada
          nova.style.visibility = ''
          nova.style.zIndex = '2'; velha.style.zIndex = '1'
          if (reduzido()) { nova.style.opacity = '1'; velha.style.opacity = '0' }
          else {
            const sai = velha.animate([{ opacity: 1, transform: 'none' }, { opacity: 0, transform: 'translateY(-4px)' }], { duration: 140, easing: 'cubic-bezier(.4,0,1,1)', fill: 'forwards' })
            const entra = nova.animate([{ opacity: 0, transform: 'translateY(8px)' }, { opacity: 1, transform: 'none' }], { duration: 280, delay: 40, easing: 'cubic-bezier(.33,1,.68,1)', fill: 'forwards' })
            await entra.finished
            sai.cancel(); entra.cancel()
            nova.style.opacity = '1'; velha.style.opacity = '0'
          }
          velha.style.visibility = 'hidden'
          this.frente = tras
          this.atual = alvo
        }
      } finally { this.ocupado = false }
      this.atualizar()
    }
  }

  const quadrosDoCeu = () => (POR_URL ? CFG.ceu || [] : payload().ceu || []).map(midia)
  window.PPSims = { registrar, molduras, PalcoDeEtapas, htmlDaTela, midia, temMidia, quadrosDoCeu, reduzido, todas: () => molduras }
})()
