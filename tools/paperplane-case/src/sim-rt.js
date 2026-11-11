/* Roteiros das telas do estúdio. Roda DENTRO de cada iframe (srcdoc), sobre o DOM real capturado do app.
   O JS do app não roda: o roteiro encena o resultado mexendo no DOM e dirige o cursor de avião do produto
   (PPMicro.cursorBolinha) com eventos de ponteiro simulados. O pai só chama __sim.tocar() e __sim.parar(). */
(function () {
  'use strict'
  const M = window.PPMicro
  const doc = document
  const reduzido = matchMedia('(prefers-reduced-motion: reduce)')
  const QUIETO = 'cubic-bezier(.33,1,.68,1)', POUSO = 'cubic-bezier(.2,1.25,.4,1)', IN_OUT = 'cubic-bezier(.45,0,.55,1)'
  const W = () => doc.documentElement.clientWidth, H = () => doc.documentElement.clientHeight

  class Parado extends Error {}
  let geracao = 0
  let cursor = null
  let px = -60, py = -60
  let telaAtual = null
  const desfazer = []
  const telas = {}

  /* ---------- montagem da tela ---------- */
  function aplicarRolagens() {
    doc.querySelectorAll('[data-sim-scroll]').forEach((el) => {
      const [x, y] = el.getAttribute('data-sim-scroll').split(',').map(Number)
      el.scrollLeft = x; el.scrollTop = y
    })
  }
  function criarCursor() {
    if (cursor) { try { cursor.destruir() } catch (e) {} }
    cursor = M && !reduzido.matches ? M.cursorBolinha({ raiz: doc.body, sempre: true }) : null
  }
  function trocarCorpo(html) {
    if (M) M.limpar()
    doc.body.innerHTML = html
    aplicarRolagens()
    criarCursor()
  }

  /* ---------- relógio que pode ser interrompido ---------- */
  const vivo = (g) => { if (g !== geracao) throw new Parado() }
  const esperar = (ms, g) => new Promise((ok, falha) => setTimeout(() => (g !== geracao ? falha(new Parado()) : ok()), ms))
  const $ = (s) => (typeof s === 'string' ? doc.querySelector(s) : s)
  const $$ = (s) => Array.from(doc.querySelectorAll(s))
  const quadro = () => new Promise((r) => requestAnimationFrame(r))

  /* ---------- ponteiro simulado ---------- */
  function emitir(tipo, x, y) {
    const alvo = doc.elementFromPoint(Math.max(0, Math.min(W() - 1, x)), Math.max(0, Math.min(H() - 1, y))) || doc.body
    const e = new PointerEvent(tipo, { bubbles: true, cancelable: true, clientX: x, clientY: y, pointerType: 'mouse', isPrimary: true, button: 0, buttons: tipo === 'pointerdown' ? 1 : 0 })
    e.simulado = true
    alvo.dispatchEvent(e)
    return alvo
  }
  const curva = (t) => (t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2)
  /** Voa até o centro do alvo (ou um ponto da caixa), num arco leve, emitindo pointermove a cada quadro. */
  async function ir(alvo, g, opcoes = {}) {
    const el = $(alvo)
    let tx, ty
    if (el && el.getBoundingClientRect) { const r = el.getBoundingClientRect(); tx = r.left + r.width * (opcoes.ox ?? 0.5); ty = r.top + r.height * (opcoes.oy ?? 0.55) }
    else { tx = alvo.x; ty = alvo.y }
    const x0 = px, y0 = py, dist = Math.hypot(tx - x0, ty - y0)
    const dur = opcoes.dur || Math.min(1300, Math.max(520, dist * 0.9))
    const arco = (opcoes.arco ?? 0.12) * dist
    const t0 = performance.now()
    for (;;) {
      vivo(g)
      const k = Math.min(1, (performance.now() - t0) / dur), e = curva(k)
      px = x0 + (tx - x0) * e; py = y0 + (ty - y0) * e - Math.sin(Math.PI * e) * arco
      emitir('pointermove', px, py)
      if (k >= 1) break
      await quadro()
    }
  }
  async function clicar(alvo, g) {
    const el = $(alvo)
    emitir('pointerdown', px, py)
    if (el && M) M.afundar(el)
    await esperar(150, g)
    emitir('pointerup', px, py)
    await esperar(220, g)
  }
  async function sair(g) {
    await ir({ x: W() + 40, y: py + 60 }, g, { dur: 700, arco: 0.05 })
    const e = new PointerEvent('pointerout', { bubbles: true, pointerType: 'mouse' })
    e.simulado = true
    doc.dispatchEvent(e)
    px = -60; py = H() * 0.7
  }
  function entrarPor(lado) { px = lado === 'baixo' ? W() * 0.62 : W() + 30; py = lado === 'baixo' ? H() + 30 : H() * 0.62 }

  /* ---------- mudanças com volta ---------- */
  function guardar(el) {
    if (!el) return
    if (desfazer.some((d) => d.el === el)) return
    desfazer.push({ el, html: el.innerHTML, cls: el.className && el.className.baseVal === undefined ? el.className : el.getAttribute('class'), style: el.getAttribute('style') })
  }
  function texto(el, t) { el = $(el); if (!el) return; guardar(el); el.textContent = t }
  function classe(el, tira, poe) { el = $(el); if (!el) return; guardar(el); if (tira) el.classList.remove(...tira.split(' ')); if (poe) el.classList.add(...poe.split(' ')) }
  function estilo(el, obj) { el = $(el); if (!el) return; guardar(el); Object.assign(el.style, obj) }
  function inserir(pai, html, onde = 'beforeend') {
    pai = $(pai); if (!pai) return null
    guardar(pai)
    pai.insertAdjacentHTML(onde, html)
    return onde === 'beforeend' ? pai.lastElementChild : onde === 'afterbegin' ? pai.firstElementChild : onde === 'afterend' ? pai.nextElementSibling : pai.previousElementSibling
  }
  async function restaurar() {
    if (telaAtual && telaAtual !== 'base' && telas.base) { trocarCorpo(telas.base); telaAtual = 'base'; desfazer.length = 0; return }
    const mudados = desfazer.splice(0).reverse()
    for (const d of mudados) {
      if (!d.el.isConnected) continue
      d.el.innerHTML = d.html
      if (d.cls != null) d.el.setAttribute('class', d.cls)
      if (d.style == null) d.el.removeAttribute('style'); else d.el.setAttribute('style', d.style)
      if (!reduzido.matches) d.el.animate([{ opacity: 0.35 }, { opacity: 1 }], { duration: 320, easing: QUIETO })
    }
  }
  function trocarTela(nome) {
    if (!telas[nome]) return false
    if (!telas.base) telas.base = doc.body.innerHTML
    const sx = px, sy = py
    trocarCorpo(telas[nome]); telaAtual = nome
    px = sx; py = sy
    emitir('pointermove', px, py)
    return true
  }

  /* ---------- gestos de animação ---------- */
  const anim = (el, quadros, opcoes) => { el = $(el); return el && !reduzido.matches ? el.animate(quadros, { fill: 'both', ...opcoes }) : null }
  const pousar = (el, atraso = 0) => anim(el, [{ opacity: 0, transform: 'translateY(8px)' }, { opacity: 1, transform: 'none' }], { duration: 450, delay: atraso, easing: POUSO })
  const entrarQuieto = (el, atraso = 0) => anim(el, [{ opacity: 0, transform: 'translateY(8px)' }, { opacity: 1, transform: 'none' }], { duration: 280, delay: atraso, easing: QUIETO })
  async function digitar(el, t, g, cps = 26) {
    el = $(el); if (!el) return
    guardar(el)
    const ehCampo = 'value' in el && (el.tagName === 'TEXTAREA' || el.tagName === 'INPUT')
    el.classList.add('sim-digitando')
    for (let i = 1; i <= t.length; i++) {
      vivo(g)
      if (ehCampo) el.value = t.slice(0, i); else el.textContent = t.slice(0, i)
      await esperar(1000 / cps * (t[i - 1] === ' ' ? 0.6 : 1) * (0.75 + Math.random() * 0.5), g)
    }
    el.classList.remove('sim-digitando')
  }
  /** Toque de dedo (celular): um círculo que aparece e some no ponto. */
  async function tocarDedo(alvo, g) {
    const el = $(alvo); if (!el) return
    const r = el.getBoundingClientRect()
    const dedo = doc.createElement('i'); dedo.className = 'sim-dedo'
    dedo.style.left = r.left + r.width / 2 + 'px'; dedo.style.top = r.top + r.height / 2 + 'px'
    doc.body.append(dedo)
    if (M) M.afundar(el)
    await esperar(520, g).finally(() => dedo.remove())
  }
  function selo(el, tipo, rotulo) {
    el = $(el); if (!el) return
    classe(el, 'warn ok ac', tipo)
    guardar(el)
    el.innerHTML = (tipo === 'ok' ? '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg>' : '') + rotulo
    anim(el, [{ transform: 'scale(.92)', opacity: 0.4 }, { transform: 'scale(1)', opacity: 1 }], { duration: 450, easing: POUSO })
  }
  const anel = () => $('.credit-ring') || $('#credit')
  /** Troca o tema da tela e avisa o pai, para o palco em volta acompanhar com a mesma duração. */
  function definirTema(t) {
    doc.documentElement.setAttribute('data-theme', t)
    try { parent.postMessage({ type: 'sim-tema', tema: t }, '*') } catch (e) {}
  }
  /* Vídeo de verdade dentro da tela: o elemento com data-sim-video="media/<arquivo>.mp4" (o pai troca o caminho por um
     Blob URL) toca mudo, em laço, quando o roteiro dá play; para quando a moldura sai de vista (parar). */
  let videoAtual = null
  const PALCO_DO_VIDEO = ['img[data-take][data-sim-video]', '.mt-screen img.mt-vid.on[data-sim-video]', '.nv-card img[data-sim-video]', '[data-sim-video]']
  function videoDaTela() {
    const el = PALCO_DO_VIDEO.map((s) => $(s)).find(Boolean)
    if (!el) return null
    const src = el.getAttribute('data-sim-video')
    if (!src) return null
    // Em <img> (monitor da Montagem) o vídeo entra por cima, no mesmo pai; em qualquer outro elemento, dentro dele.
    const caixa = el.tagName === 'IMG' ? el.parentElement : el
    let v = el.tagName === 'VIDEO' ? el : caixa.querySelector('video.sim-video')
    if (!v) {
      v = doc.createElement('video'); v.className = 'sim-video'
      v.setAttribute('aria-hidden', 'true')
      if (getComputedStyle(caixa).position === 'static') caixa.style.position = 'relative'
      caixa.append(v)
    }
    if (v.getAttribute('src') !== src) v.src = src
    v.muted = true; v.loop = true; v.playsInline = true; v.preload = 'auto'
    return v
  }
  async function tocarVideo() {
    const v = videoDaTela()
    if (!v || reduzido.matches) return null
    videoAtual = v
    try { await v.play() } catch (e) {}
    return v
  }
  function pararVideo() { if (videoAtual) { try { videoAtual.pause() } catch (e) {} } }

  /* =====================================================================================
     ROTEIROS: 2 a 4 batidas cada, no ritmo "quieto com pouso"
     ===================================================================================== */
  const R = {}

  /* Início: o saldo em minutos abre por qualidade; o botão limão chama o próximo passo. */
  R.inicio = async (g) => {
    entrarPor('baixo')
    const det = $('details.h2-q')
    await esperar(500, g)
    await ir('.h2-cred-n', g, { dur: 1100 })
    await esperar(350, g)
    if (det) {
      await ir(det.querySelector('summary'), g)
      await clicar(det.querySelector('summary'), g)
      guardar(det); det.open = true
      det.querySelectorAll('.h2-q-r').forEach((r, i) => pousar(r, i * 48))
      await esperar(1800, g)
    }
    await ir('.v2-next', g, { dur: 900 })
    await esperar(500, g)
    await clicar('.v2-next', g)
    await esperar(700, g)
    if (det) det.open = false
    await sair(g)
  }

  /* Ideia: a pessoa reescreve a frase; o Origami relê e os cartões pousam. */
  R.ideia = async (g) => {
    entrarPor('baixo')
    const campo = $('#premise')
    await esperar(400, g)
    await ir(campo, g, { ox: 0.9 })
    await clicar(campo, g)
    guardar(campo)
    const frase = campo.value
    for (let i = frase.length; i >= 52; i -= 3) { vivo(g); campo.value = frase.slice(0, i); await esperar(16, g) }
    for (let i = 53; i <= frase.length; i++) { vivo(g); campo.value = frase.slice(0, i); await esperar(42 + Math.random() * 30, g) }
    await esperar(400, g)
    const cartao = $('.v2-ct-t') && $('.v2-ct-t').closest('section, .v2-card, aside, div')
    const alvo = cartao && cartao.parentElement ? cartao.parentElement : null
    const blocos = alvo ? Array.from(alvo.children) : []
    blocos.forEach((b, i) => entrarQuieto(b, 120 + i * 60))
    $$('.id2-chip').forEach((c, i) => pousar(c, 300 + i * 70))
    await esperar(1600, g)
    await sair(g)
  }

  /* Universo: uma regra nova entra na lista que o Origami consulta. */
  R.universo = async (g) => {
    entrarPor('baixo')
    await esperar(400, g)
    const campo = $('#ruleIn')
    await ir(campo, g, { ox: 0.3 })
    await clicar(campo, g)
    await digitar(campo, 'O trem nunca para duas vezes na mesma estação.', g, 30)
    await esperar(300, g)
    const lista = campo.closest('form') && campo.closest('form').previousElementSibling
    if (lista && lista.lastElementChild) {
      const ultimo = lista.lastElementChild
      guardar(lista)
      const novo = ultimo.cloneNode(true)
      const n = lista.children.length + 1
      novo.querySelectorAll('*').forEach((el) => {
        if (el.children.length === 0 && /^\d+$/.test(el.textContent.trim())) el.textContent = String(n)
        else if (el.children.length === 0 && el.textContent.trim().length > 20) el.textContent = campo.value
      })
      lista.append(novo)
      pousar(novo)
      guardar(campo); campo.value = ''
    }
    await esperar(1500, g)
    await sair(g)
  }

  /* Roteiro: o Origami abre ao lado, pensa e a resposta pousa nas linhas. */
  R.roteiro = async (g) => {
    entrarPor('baixo')
    await esperar(400, g)
    const linha = $('.sel-mark, mark, .screenplay mark') || $('[class*="sp-"] p')
    await ir('.cop-pill', g, { dur: 1100 })
    await esperar(300, g)
    await clicar('.cop-pill', g)
    if (!trocarTela('roteiro-origami')) return
    const painel = $('.og2')
    anim(painel, [{ opacity: 0, transform: 'translateY(8px) scale(.985)' }, { opacity: 1, transform: 'none' }], { duration: 450, easing: POUSO })
    const corpo = $('.og2-body') || painel
    const msgs = corpo ? Array.from(corpo.children) : []
    const ultima = msgs[msgs.length - 1]
    if (ultima && M && !reduzido.matches) {
      ultima.style.visibility = 'hidden'
      await esperar(700, g)
      const caixa = doc.createElement('div'); caixa.className = 'sim-pensa'
      ultima.before(caixa)
      const pensando = M.origamiPensando(caixa)
      await esperar(2300, g)
      ultima.style.visibility = ''
      const p = ultima.querySelector('p') || ultima
      pensando.responder(p)
      setTimeout(() => caixa.remove(), 900)
    }
    await esperar(2600, g)
    await sair(g)
  }

  /* Estilo visual: um estilo da biblioteca é provado no quadro do projeto, com a paleta junto. */
  R.estilo = async (g) => {
    entrarPor('baixo')
    await esperar(400, g)
    const cartoes = $$('.es2-row > li')
    const alvo = cartoes[1]
    if (!alvo) return
    await ir(alvo.querySelector('.es-card-img'), g, { oy: 0.25, dur: 1100 })
    await esperar(350, g)
    await clicar(alvo.querySelector('.es-card-img'), g)
    const mosaico = $('.es2-media .es-mosaic')
    const novas = Array.from(alvo.querySelectorAll('.es-mosaic img')).map((i) => i.src)
    if (mosaico) {
      guardar(mosaico)
      Array.from(mosaico.querySelectorAll('img')).forEach((im, i) => { im.src = novas[i % novas.length]; anim(im, [{ opacity: 0, transform: 'scale(1.04)' }, { opacity: 1, transform: 'none' }], { duration: 450, delay: i * 70, easing: QUIETO }) })
    }
    texto('.es2-name', alvo.querySelector('.es-card-t b').textContent)
    texto('.es2-info .es-meta', alvo.querySelector('.es-card-t span').textContent)
    const cores = Array.from(alvo.querySelectorAll('.es-bar span')).map((s) => s.style.background)
    $$('.es2-pal .es2-sw-c').forEach((sw, i) => { if (cores[i]) estilo(sw, { background: cores[i], transition: 'background .45s ' + QUIETO }) })
    entrarQuieto('.es2-info')
    await esperar(2400, g)
    await ir('.es2-next', g, { dur: 900 })
    await esperar(900, g)
    await sair(g)
  }

  /* Personagem: a ficha da Lia é aprovada e o selo muda. */
  R['personagem-ficha'] = async (g) => {
    entrarPor('baixo')
    await esperar(400, g)
    const vistas = $$('.pg2-vistas img, .pg2-hero img, figure img').slice(0, 4)
    if (vistas[0]) { await ir(vistas[1] || vistas[0], g, { dur: 1000 }); await esperar(500, g) }
    const botao = $$('button').find((b) => /Aprovar ficha/.test(b.textContent))
    if (botao) {
      await ir(botao, g)
      await esperar(300, g)
      await clicar(botao, g)
      selo($('.pg2-ih .pill'), 'ok', 'Visual aprovado')
      guardar(botao)
      botao.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg> Ficha aprovada'
      classe(botao, 'a p', 'g sim-feito')
    }
    await esperar(1800, g)
    await sair(g)
  }

  /* Cenários: a vista Frente do vagão é aprovada. */
  R.cenarios = async (g) => {
    entrarPor('baixo')
    await esperar(400, g)
    await ir('.cn-acoes-l .btn', g, { dur: 1100 })
    await esperar(450, g)
    await clicar('.cn-acoes-l .btn', g)
    selo('.cn-acoes-l .pill', 'ok', 'Aprovada')
    estilo('.cn-acoes-l .btn', { visibility: 'hidden' })
    const item = $$('.cn-lista li, [class*="cn-"] li').find((li) => /Vagão/.test(li.textContent))
    const falta = item && Array.from(item.querySelectorAll('*')).find((el) => el.children.length === 0 && /falta aprovar/.test(el.textContent))
    if (falta) { texto(falta, 'aprovado'); classe(falta, '', 'sim-ok') }
    await esperar(1800, g)
    await sair(g)
  }

  /* Decupagem: a seleção desce de tomada em tomada, na tabela e na régua da cena. */
  R.decupagem = async (g) => {
    entrarPor('baixo')
    await esperar(300, g)
    const linhas = $$('.dc-tr')
    const regua = $$('.v2-ruler-t')
    const escolher = (i) => {
      linhas.forEach((x, k) => { guardar(x); x.classList.toggle('sel', k === i) })
      regua.forEach((x, k) => { guardar(x); x.classList.toggle('on', k === i); const c = x.querySelector('.v2-code'); if (c) c.classList.toggle('d', k !== i) })
      if (linhas[i]) entrarQuieto(linhas[i])
    }
    for (const i of [3, 4, 1]) {
      const l = linhas[i]; if (!l) continue
      await ir(l.querySelector('.dc-what') || l, g, { ox: 0.3 })
      await esperar(250, g)
      await clicar(l, g)
      escolher(i)
      await esperar(1000, g)
    }
    if (regua[2]) { await ir(regua[2], g); await esperar(200, g); await clicar(regua[2], g); escolher(2) }
    await esperar(800, g)
    await sair(g)
  }

  const rolador = (el) => { for (let p = el && el.parentElement; p; p = p.parentElement) { const s = getComputedStyle(p); if (/(auto|scroll)/.test(s.overflowY) && p.scrollHeight > p.clientHeight + 4) return p } return null }

  /* Storyboard básico: a 3E é conferida e aprovada; o contador fecha 5 de 5. */
  R['storyboard-basico'] = async (g) => {
    entrarPor('baixo')
    await esperar(300, g)
    const quadro = $('[data-live="shot:3E"]')
    const grade = rolador(quadro)
    const topo0 = grade ? grade.scrollTop : 0
    if (grade && quadro) grade.scrollTo({ top: topo0 + quadro.getBoundingClientRect().top - grade.getBoundingClientRect().top - 120, behavior: reduzido.matches ? 'auto' : 'smooth' })
    await esperar(800, g)
    if (quadro) {
      await ir(quadro.querySelector('.sbn-media'), g, { dur: 1100 })
      await esperar(300, g)
      await clicar(quadro.querySelector('.sbn-media'), g)
      $$('.sbn-frame').forEach((f) => { if (f.classList.contains('on') || f.classList.contains('sel')) classe(f, 'on sel', '') })
      classe(quadro, '', 'on')
      await esperar(700, g)
      emitir('keydown', px, py)
      selo(quadro.querySelector('.sbn-ovr .pill'), 'ok', 'Aprovado')
      const cont = $('.sbn-acoes .pill')
      if (cont) selo(cont, 'ok', '5 de 5 aprovados')
    }
    await esperar(1700, g)
    await sair(g)
    if (grade) grade.scrollTo({ top: topo0, behavior: reduzido.matches ? 'auto' : 'smooth' })
  }

  /* Movimento: o crédito sai do saldo e carrega o botão; o botão vira "Gerando". */
  R.movimento = async (g) => {
    entrarPor('baixo')
    await esperar(400, g)
    const botao = $('.cartao-gerador-gerar')
    if (!botao) return
    const play = $('.playbtn')
    if (play) {
      // O take toca de verdade: play, um trecho do vídeo, e depois o próximo take é gerado.
      await ir(play, g, { dur: 900 }); await esperar(250, g); await clicar(play, g)
      estilo(play, { opacity: '0', transition: 'opacity .28s' })
      await tocarVideo()
      await esperar(3200, g)
    } else { await ir('.anp-take, .anp-takes > *', g, { dur: 900 }); await esperar(300, g) }
    await ir(botao, g)
    await esperar(400, g)
    await clicar(botao, g)
    if (M) {
      const saldo = anel()
      guardar(botao)
      const energia = M.creditos.gerar(saldo, botao, { custo: 48 })
      await energia.pronta
      vivo(g)
      const t = botao.querySelector('.cartao-gerador-gerar-t')
      if (t) texto(t, 'Animando 3C · #2.0')
      classe(botao, '', 'sim-gerando')
      await tocarVideo()
      await esperar(2200, g)
      energia.concluir()
      await esperar(500, g)
    }
    await sair(g)
    if (M && anel()) M.creditos.definirSaldo(anel(), 500)
  }

  /* Montagem: play; a agulha corre e o monitor acompanha cada tomada. */
  R.montagem = async (g) => {
    entrarPor('baixo')
    await esperar(300, g)
    const play = $('.mt-play') || $$('button').find((b) => /^Reproduzir/i.test(b.getAttribute('aria-label') || ''))
    const agulha = $('.mt-playhead')
    const tc = $('.mt-tc')
    const monitor = $('img[data-sim-was="canvas"]')
    const clipes = $$('.mt-vc')
    if (play) { await ir(play, g, { dur: 1100 }); await esperar(300, g); await clicar(play, g) }
    else await esperar(600, g)
    const video = await tocarVideo()
    if (agulha && video && video.duration > 0) {
      // Com vídeo: a agulha anda com o tempo real do vídeo, numa volta inteira.
      guardar(agulha); if (tc) guardar(tc)
      const de = parseFloat(agulha.style.left) || 0
      const pista = agulha.parentElement.getBoundingClientRect()
      const ate = Math.min(pista.width - 20, de + 520)
      const inicio = video.currentTime
      for (;;) {
        vivo(g)
        const decorrido = (video.currentTime - inicio + video.duration) % video.duration
        const k = Math.min(1, decorrido / video.duration)
        agulha.style.left = de + (ate - de) * k + 'px'
        if (tc) tc.firstChild.textContent = '00:' + String(Math.floor(video.currentTime)).padStart(2, '0')
        if (k > 0.97) break
        await quadro()
      }
    } else if (agulha) {
      guardar(agulha); if (tc) guardar(tc); if (monitor) guardar(monitor)
      const de = parseFloat(agulha.style.left) || 0
      const pista = agulha.parentElement.getBoundingClientRect()
      const ate = Math.min(pista.width - 20, de + 520)
      const t0 = performance.now(), dur = 4200
      let ultimoClipe = null
      for (;;) {
        vivo(g)
        const k = Math.min(1, (performance.now() - t0) / dur)
        const x = de + (ate - de) * k
        agulha.style.left = x + 'px'
        const seg = 6 + Math.round(k * 10)
        if (tc) tc.firstChild.textContent = '00:' + String(seg).padStart(2, '0')
        const ax = pista.left + x
        const clipe = clipes.find((c) => { const r = c.getBoundingClientRect(); return ax >= r.left && ax <= r.right })
        if (clipe && clipe !== ultimoClipe && monitor) { ultimoClipe = clipe; const im = clipe.querySelector('img'); if (im) monitor.src = im.src }
        if (k >= 1) break
        await quadro()
      }
    }
    await esperar(900, g)
    await sair(g)
  }

  /* Storyboard em nós (comparador): as arestas se desenham e o take pousa. */
  R['storyboard-nos'] = async (g) => {
    const arestas = $$('.nv-edge path, path.nv-edge')
    arestas.forEach((a, i) => {
      const L = a.getTotalLength ? a.getTotalLength() : 400
      anim(a, [{ strokeDasharray: L, strokeDashoffset: L }, { strokeDasharray: L, strokeDashoffset: 0 }], { duration: 900, delay: 200 + i * 90, easing: QUIETO, fill: 'none' })
    })
    const take = $$('.nv-card').pop()
    if (take) pousar(take, 900)
    await esperar(6000, g)
  }

  /* Celular: a ilha abre "Visualizar" e a folha sobe. */
  R['cel-roteiro'] = async (g) => {
    await esperar(900, g)
    const item = $$('.v2-bb').find((b) => /Visualizar/i.test(b.textContent + (b.getAttribute('aria-label') || ''))) || $$('.v2-bb')[2]
    if (item) await tocarDedo(item, g)
    if (!trocarTela('cel-folha')) return
    anim('.v2-sheet', [{ transform: 'translateY(100%)' }, { transform: 'none' }], { duration: 520, easing: POUSO })
    anim('.v2-sheet-scrim', [{ opacity: 0 }, { opacity: 1 }], { duration: 300, easing: QUIETO })
    await esperar(2600, g)
    anim('.v2-sheet', [{ transform: 'none' }, { transform: 'translateY(100%)' }], { duration: 260, easing: 'cubic-bezier(.4,0,1,1)' })
    anim('.v2-sheet-scrim', [{ opacity: 1 }, { opacity: 0 }], { duration: 260 })
    await esperar(280, g)
    await restaurar()
    await esperar(1000, g)
  }
  R['cel-inicio'] = async (g) => {
    const itens = $$('.v2-bb')
    for (const i of [1, 2, 3, 0]) {
      const it = itens[i]; if (!it) continue
      await esperar(900, g)
      await tocarDedo(it, g)
      itens.forEach((x) => { guardar(x); x.classList.toggle('sim-on', x === it) })
    }
    await esperar(800, g)
  }
  R['cel-origami'] = async (g) => {
    await esperar(1400, g)
    const html = doc.documentElement
    html.classList.add('sim-tema')
    definirTema('light')
    await esperar(2600, g)
    definirTema('dark')
    await esperar(1800, g)
  }

  /* Cursor da seção de microinterações: avião, bolinha, ímã e clique. */
  R.cursor = async (g) => {
    entrarPor('lado')
    const botoes = $$('.pp-btn')
    await ir({ x: W() * 0.3, y: H() * 0.3 }, g, { dur: 700 })
    await ir({ x: W() * 0.75, y: H() * 0.25 }, g, { dur: 380, arco: 0.3 })
    for (const b of botoes) {
      await ir(b, g, { ox: 0.8, oy: 0.2 })
      await esperar(500, g)
      await clicar(b, g)
      await esperar(300, g)
    }
    await ir({ x: W() * 0.2, y: H() * 0.85 }, g, { dur: 360, arco: 0.25 })
    await sair(g)
  }

  const ROTEIROS_POR_TELA = R

  /* ---------- API para o pai ---------- */
  async function laco(nome, g) {
    const r = ROTEIROS_POR_TELA[nome]
    if (!r) return
    try {
      for (;;) {
        await r(g)
        await esperar(1400, g)
        await restaurar()
        await esperar(900, g)
      }
    } catch (e) {
      if (!(e instanceof Parado)) console.error('roteiro', nome, e)
    }
  }
  window.__sim = {
    pronto: true,
    tocar(nome) {
      if (reduzido.matches) return
      const g = ++geracao
      laco(nome, g)
    },
    parar() { geracao++; pararVideo(); restaurar(); if (cursor) { const e = new PointerEvent('pointerout', { bubbles: true, pointerType: 'mouse' }); e.simulado = true; doc.dispatchEvent(e) } },
    carregar(html, attrs) {
      geracao++
      desfazer.length = 0; telas.base = null; telaAtual = null
      if (attrs) for (const [k, v] of Object.entries(attrs)) if (k !== 'data-theme') doc.documentElement.setAttribute(k, v)
      trocarCorpo(html)
    },
    telas(mapa) { Object.assign(telas, mapa) },
    vars(obj) { const r = doc.documentElement; for (const [k, v] of Object.entries(obj)) { if (v == null) r.style.removeProperty(k); else r.style.setProperty(k, v) } },
    tema(t) { definirTema(t) },
  }
  aplicarRolagens()
  criarCursor()
  try { parent.postMessage({ type: 'sim-pronto', id: window.name }, '*') } catch (e) {}
})()
