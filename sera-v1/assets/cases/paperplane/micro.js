/*!
 * PPMicro: microinterações do Paperplane Studio em JavaScript puro (sem React, sem dependências).
 * Porte do código real do estúdio: src/motion/ (crédito em partículas, avião do Origami, quieto e pouso),
 * src/app/CursorDeAviao.tsx + bolinha-de-papel.ts + ima-do-cursor.ts + rastro-de-voo.ts (cursor, bolinha e ímã),
 * src/components/OrigamiLoading.tsx + PlaneFlight.tsx e src/copilot/OrigamiIcon.tsx.
 * Os números (contagem, duração, atraso, arco, curva, raio, cor) são os do produto; os comentários dizem de onde vêm.
 * Uso: <link rel="stylesheet" href="micro.css"> e <script src="micro.js"></script>; tudo dentro de um .pp-micro.
 * Expõe window.PPMicro. Com prefers-reduced-motion, cada função vai direto ao estado final.
 */
(function (global) {
  'use strict'

  /* =====================================================================================
     Curvas e tokens (src/motion/curvas.ts)
     ===================================================================================== */

  const limitar = (v, min, max) => Math.min(max, Math.max(min, v))
  const aleatorio = (de, ate) => de + Math.random() * (ate - de)

  /** cubic-bezier(x1, y1, x2, y2) como função do tempo (curvas.ts). */
  function cubicBezier(x1, y1, x2, y2) {
    const cx = 3 * x1, bx = 3 * (x2 - x1) - cx, ax = 1 - cx - bx
    const cy = 3 * y1, by = 3 * (y2 - y1) - cy, ay = 1 - cy - by
    const x = (t) => ((ax * t + bx) * t + cx) * t
    const y = (t) => ((ay * t + by) * t + cy) * t
    const dx = (t) => (3 * ax * t + 2 * bx) * t + cx
    return (p) => {
      if (p <= 0) return 0
      if (p >= 1) return 1
      let t = p
      for (let i = 0; i < 6; i++) {
        const erro = x(t) - p, d = dx(t)
        if (Math.abs(erro) < 1e-5) return y(t)
        if (Math.abs(d) < 1e-6) break
        t -= erro / d
      }
      let baixo = 0, alto = 1
      t = p
      for (let i = 0; i < 30; i++) { if (x(t) < p) baixo = t; else alto = t; t = (baixo + alto) / 2 }
      return y(t)
    }
  }

  /** Reservas iguais aos tokens (curvas.ts:37-44; tokens.css). */
  const RESERVA = {
    '--ease-quieto': 'cubic-bezier(.33,1,.68,1)', '--ease-pouso': 'cubic-bezier(.2,1.25,.4,1)', '--ease-suave': 'cubic-bezier(.22,.61,.36,1)',
    '--ease-in-out': 'cubic-bezier(.45,0,.55,1)', '--ease-in': 'cubic-bezier(.4,0,1,1)', '--spring': 'cubic-bezier(.34,1.56,.64,1)',
    '--dur-quieto': '280ms', '--dur-pouso': '450ms', '--dur-sair': '140ms', '--mov-sobe': '8px', '--mov-sai': '4px', '--mov-foco': '4px', '--mov-afunda': '.97',
  }

  /** O .pp-micro que vale para um elemento (tokens e tema dele). */
  const escopo = (el) => (el && el.closest && el.closest('.pp-micro')) || document.querySelector('.pp-micro') || document.documentElement
  const valorDoToken = (token, el) => getComputedStyle(escopo(el)).getPropertyValue(token).trim() || RESERVA[token] || ''

  function curvaDoTexto(texto) {
    const m = /cubic-bezier\(([^)]*)\)/.exec(texto || '')
    const n = m ? m[1].split(',').map(Number) : null
    if (!n || n.length !== 4 || n.some((v) => !Number.isFinite(v))) return (p) => limitar(p, 0, 1)
    return cubicBezier(n[0], n[1], n[2], n[3])
  }
  const curvasLidas = new Map()
  function curvaDoToken(token, el) {
    const texto = valorDoToken(token, el) || 'linear', guardada = curvasLidas.get(token)
    if (guardada && guardada.texto === texto) return guardada.curva
    const curva = curvaDoTexto(texto)
    curvasLidas.set(token, { texto, curva })
    return curva
  }
  const textoDaCurva = (token, el) => valorDoToken(token, el) || 'ease-out'
  function duracaoDoToken(token, reservaMs, el) {
    const t = valorDoToken(token, el)
    const ms = /ms$/.test(t) ? parseFloat(t) : /s$/.test(t) ? parseFloat(t) * 1000 : NaN
    return Number.isFinite(ms) ? ms : reservaMs
  }
  function medidaDoToken(token, reservaPx, el) { const v = parseFloat(valorDoToken(token, el)); return Number.isFinite(v) ? v : reservaPx }
  const preferePoucoMovimento = () => typeof matchMedia === 'function' && matchMedia('(prefers-reduced-motion: reduce)').matches

  /** Cor de um token pronta para o canvas, resolvida dentro do .pp-micro do elemento (campo.ts). */
  function corDoToken(token, el) {
    const prova = document.createElement('span')
    prova.style.cssText = `position:absolute;visibility:hidden;color:var(${token})`
    escopo(el).append(prova)
    const cor = getComputedStyle(prova).color
    prova.remove()
    return cor || 'currentColor'
  }

  /* =====================================================================================
     Interpolação (src/motion/tween.ts)
     ===================================================================================== */

  function animar(duracaoMs, curva, aoAtualizar, opcoes = {}) {
    const { atrasoMs = 0, sinal } = opcoes
    return new Promise((resolver) => {
      if (sinal && sinal.aborted) { resolver(); return }
      let comeco = 0, quadro = 0
      const parar = () => { cancelAnimationFrame(quadro); resolver() }
      if (sinal) sinal.addEventListener('abort', parar, { once: true })
      const passo = (agora) => {
        if (!comeco) comeco = agora + atrasoMs
        const progresso = duracaoMs <= 0 ? 1 : limitar((agora - comeco) / duracaoMs, 0, 1)
        if (agora >= comeco) aoAtualizar(curva(progresso), progresso)
        if (progresso >= 1) { if (sinal) sinal.removeEventListener('abort', parar); resolver(); return }
        quadro = requestAnimationFrame(passo)
      }
      quadro = requestAnimationFrame(passo)
    })
  }
  const esperar = (ms, sinal) => new Promise((r) => {
    if (sinal && sinal.aborted) { r(); return }
    const t = setTimeout(r, ms)
    if (sinal) sinal.addEventListener('abort', () => { clearTimeout(t); r() }, { once: true })
  })
  function entreChaves(chaves, valor) {
    if (chaves.length === 1) return chaves[0]
    const pos = Math.min(chaves.length - 1.000001, Math.max(0, valor * (chaves.length - 1)))
    const i = Math.floor(pos), resto = pos - i
    return chaves[i] + (chaves[i + 1] - chaves[i]) * resto
  }

  /* =====================================================================================
     Campo de partículas: um canvas por palco ou um fixo por cima da página (src/motion/campo.ts)
     ===================================================================================== */

  const PASSO_MAXIMO_S = 0.05, VOLTA = Math.PI * 2

  function criarCampo(host, opcoes = {}) {
    const canvas = document.createElement('canvas')
    canvas.className = 'pp-campo' + (opcoes.fixo ? ' fixo' : '')
    canvas.setAttribute('aria-hidden', 'true')
    host.append(canvas)
    const ctx = canvas.getContext('2d')
    let particulas = [], rodando = false, ultimo = 0, quadro = 0
    const origem = () => (opcoes.fixo ? { left: 0, top: 0 } : host.getBoundingClientRect())
    const caixaDoRetangulo = (r) => {
      const o = origem()
      return { x: r.left - o.left + r.width / 2, y: r.top - o.top + r.height / 2, w: r.width, h: r.height, l: r.left - o.left, t: r.top - o.top }
    }
    const pintar = (p) => {
      if (!ctx || p.a <= 0) return
      if (p.rastro && p.rastro.length) {
        p.rastro.forEach((q, i) => {
          ctx.globalAlpha = p.a * ((i + 1) / (p.rastro.length + 2)) * 0.5
          ctx.fillStyle = p.halo || p.cor
          ctx.beginPath(); ctx.arc(q.x, q.y, p.r * (0.5 + (i / p.rastro.length) * 0.5), 0, VOLTA); ctx.fill()
        })
      }
      if (p.halo) { ctx.globalAlpha = p.a * 0.55; ctx.fillStyle = p.halo; ctx.beginPath(); ctx.arc(p.x, p.y, p.r * 2.4, 0, VOLTA); ctx.fill() }
      ctx.globalAlpha = p.a
      ctx.beginPath(); ctx.arc(p.x, p.y, Math.max(0.1, p.r), 0, VOLTA)
      if (p.anel) { ctx.strokeStyle = p.cor; ctx.lineWidth = 1; ctx.stroke() } else { ctx.fillStyle = p.cor; ctx.fill() }
      ctx.globalAlpha = 1
    }
    const campo = {
      canvas, w: 0, h: 0,
      get vivas() { return particulas.length },
      medir() {
        const largura = opcoes.fixo ? innerWidth : host.clientWidth, altura = opcoes.fixo ? innerHeight : host.clientHeight
        const d = devicePixelRatio || 1
        canvas.width = Math.max(1, Math.round(largura * d)); canvas.height = Math.max(1, Math.round(altura * d))
        if (ctx) ctx.setTransform(d, 0, 0, d, 0, 0)
        campo.w = largura; campo.h = altura
      },
      adicionar(...novas) {
        particulas.push(...novas)
        if (rodando) return
        rodando = true; campo.medir(); ultimo = performance.now()
        quadro = requestAnimationFrame(desenhar)
      },
      limpar() { particulas = []; if (ctx) ctx.clearRect(0, 0, campo.w, campo.h) },
      caixa: (el) => caixaDoRetangulo(el.getBoundingClientRect()),
      caixaDoRetangulo,
      destruir() { cancelAnimationFrame(quadro); particulas = []; rodando = false; canvas.remove() },
    }
    function desenhar(agora) {
      const dt = Math.min(PASSO_MAXIMO_S, (agora - ultimo) / 1000); ultimo = agora
      if (ctx) ctx.clearRect(0, 0, campo.w, campo.h)
      particulas = particulas.filter((p) => { const viva = p.passo(dt); if (viva) pintar(p); return viva })
      if (particulas.length) quadro = requestAnimationFrame(desenhar)
      else { rodando = false; if (ctx) ctx.clearRect(0, 0, campo.w, campo.h) }
    }
    return campo
  }

  let campoAtual = null
  const aoRedimensionarCampo = () => campoAtual && campoAtual.medir()
  /** O campo por cima da página inteira (um só): o crédito que viaja entre o saldo e o botão. */
  function campoDaPagina() {
    if (campoAtual && campoAtual.canvas.isConnected) return campoAtual
    campoAtual = criarCampo(document.body, { fixo: true })
    addEventListener('resize', aoRedimensionarCampo)
    return campoAtual
  }

  /* =====================================================================================
     Partículas (src/motion/particulas.ts)
     ===================================================================================== */

  const TAMANHO_DO_RASTRO = 5
  function guardarRastro(p) { if (!p.rastro) return; p.rastro.push({ x: p.x, y: p.y }); if (p.rastro.length > TAMANHO_DO_RASTRO) p.rastro.shift() }

  /** Partícula de crédito que viaja em arco de `de` até `ate` (particulas.ts). */
  function viagem({ de, ate, cores, duracaoS = 0.6, atrasoS = 0, arco = -40, r = 1.8, curva, espalhar = true, aoChegar }) {
    curva = curva || curvaDoToken('--ease-in-out')
    const desvioX = espalhar ? aleatorio(-14, 14) : 0, desvioY = espalhar ? aleatorio(-6, 6) : 0
    const altura = arco * aleatorio(0.7, 1.3)
    let tempo = -atrasoS
    const p = {
      x: de.x, y: de.y, r, a: 0, cor: cores.nucleo, halo: cores.halo, rastro: [],
      passo(dt) {
        tempo += dt
        if (tempo < 0) return true
        const k = limitar(tempo / duracaoS, 0, 1), e = curva(k)
        guardarRastro(p)
        const x0 = de.x + desvioX, y0 = de.y + desvioY
        p.x = x0 + (ate.x - x0) * e
        p.y = y0 + (ate.y - y0) * e + Math.sin(k * Math.PI) * altura
        p.a = Math.min(1, k * 6)
        if (k >= 1) { if (aoChegar) aoChegar(); return false }
        return true
      },
    }
    return p
  }

  /** Vai até um lugar, espera lá e, quando liberada, volta para casa: nada foi gasto (particulas.ts). */
  function idaEVolta({ de, ate, cores, controle, ordem, atrasoS = 0, duracaoS = 0.55, duracaoVoltaS = duracaoS, r = 1.8, curvaIda, aoChegar, aoVoltar }) {
    curvaIda = curvaIda || curvaDoToken('--ease-pouso')
    const curvaVolta = curvaDoToken('--ease-in-out'), arco = aleatorio(-46, -28)
    let fase = 'ida', tempo = -atrasoS, tempoVolta = 0
    const p = {
      x: de.x, y: de.y, r, a: 0, cor: cores.nucleo, halo: cores.halo, rastro: [],
      passo(dt) {
        guardarRastro(p)
        if (fase === 'ida') {
          tempo += dt
          if (tempo < 0) return true
          const k = limitar(tempo / duracaoS, 0, 1), q = curvaIda(k)
          p.x = de.x + (ate.x - de.x) * q
          p.y = de.y + (ate.y - de.y) * q + Math.sin(k * Math.PI) * arco
          p.a = Math.min(1, k * 6)
          if (k >= 1) { fase = 'parada'; if (aoChegar) aoChegar() }
          return true
        }
        if (fase === 'parada') {
          p.rastro.length = 0
          p.y = ate.y + Math.sin(performance.now() / 260 + ate.x) * 0.6
          if (controle.voltar) { fase = 'volta'; tempoVolta = -(controle.atrasoDaVolta ? controle.atrasoDaVolta(ordem) : 0) }
          return true
        }
        tempoVolta += dt
        if (tempoVolta < 0) return true
        const k = limitar(tempoVolta / duracaoVoltaS, 0, 1), q = curvaVolta(k)
        p.x = ate.x + (de.x - ate.x) * q
        p.y = ate.y + (de.y - ate.y) * q + Math.sin(k * Math.PI) * arco * 0.7
        if (k >= 1) { if (aoVoltar) aoVoltar(); return false }
        return true
      },
    }
    return p
  }

  /** Pontos em volta de uma pílula, do meio da reta de cima, no sentido do relógio (particulas.ts). */
  function naPilula(caixa, quantos, folga = 7) {
    const w = caixa.w + folga * 2, h = caixa.h + folga * 2, raio = h / 2, reta = Math.max(0, w - h)
    const perimetro = 2 * reta + 2 * Math.PI * raio
    return Array.from({ length: quantos }, (_, i) => {
      let d = ((i / quantos) * perimetro + reta / 2) % perimetro
      if (d < reta) return { x: caixa.x - reta / 2 + d, y: caixa.y - raio }
      d -= reta
      if (d < Math.PI * raio) { const a = -Math.PI / 2 + d / raio; return { x: caixa.x + reta / 2 + Math.cos(a) * raio, y: caixa.y + Math.sin(a) * raio } }
      d -= Math.PI * raio
      if (d < reta) return { x: caixa.x + reta / 2 - d, y: caixa.y + raio }
      d -= reta
      const a = Math.PI / 2 + d / raio
      return { x: caixa.x - reta / 2 + Math.cos(a) * raio, y: caixa.y + Math.sin(a) * raio }
    })
  }

  /** Leva partículas de onde estão até alvos, saindo na direção em que se moviam, com curva de pouso (particulas.ts). */
  function migrar(campo, origens, alvos, { cor, duracaoS = 0.9, espalharS = 0.45, atrasoS = 0, soltura = 12, variarDuracao = 0, direcao = 0, impulso = 40, limiar = 1, aoAssentar }) {
    if (!alvos.length) return []
    const curva = curvaDoToken('--ease-pouso')
    let assentadas = 0
    const precisa = Math.max(1, Math.ceil(origens.length * limiar))
    const particulas = origens.map((o, i) => {
      const alvo = alvos[i % alvos.length], espera = atrasoS + (i / origens.length) * espalharS
      const raioInicial = o.r == null ? 1 : o.r, fase = aleatorio(0, Math.PI * 2), duracao = duracaoS * (1 + aleatorio(-variarDuracao, variarDuracao))
      let tempo = -espera, chegou = false, saiu = false, sx = o.x, sy = o.y, cx = 0, cy = 0
      const p = {
        x: o.x, y: o.y, r: raioInicial, a: o.a == null ? 1 : o.a, cor: o.cor || cor, sumir: false, rapido: false, raioAlvo: 1.05,
        passo(dt) {
          tempo += dt
          if (tempo < 0) {
            if (-tempo <= espalharS) { p.x += Math.cos(direcao) * 60 * dt; p.y += Math.sin(direcao) * 60 * dt }
            else p.y = o.y + Math.sin(performance.now() / 320 + fase) * 0.8
            return true
          }
          if (!saiu) {
            saiu = true; sx = p.x; sy = p.y
            cx = sx + Math.cos(direcao) * impulso + aleatorio(-soltura, soltura); cy = sy + Math.sin(direcao) * impulso + aleatorio(-soltura, soltura)
          }
          const k = limitar(tempo / duracao, 0, 1), e = curva(k), u = 1 - e
          p.x = u * u * sx + 2 * u * e * cx + e * e * alvo.x
          p.y = u * u * sy + 2 * u * e * cy + e * e * alvo.y
          p.r = raioInicial + (p.raioAlvo - raioInicial) * e
          if (!p.sumir) p.a = Math.max(p.a, Math.min(0.9, k * 3))
          if (k >= 1 && !chegou) { chegou = true; if (++assentadas === precisa && aoAssentar) aoAssentar() }
          if (p.sumir) { p.a -= dt * (p.rapido ? 8 : 2.5); if (p.rapido) p.r *= 0.88; return p.a > 0 }
          return true
        },
      }
      return p
    })
    campo.adicionar(...particulas)
    return particulas
  }

  /* =====================================================================================
     Quieto e pouso para o que já está na tela (src/motion/quieto.ts)
     ===================================================================================== */

  const animarEl = (el, quadros, opcoes) => (preferePoucoMovimento() || typeof el.animate !== 'function') ? null : el.animate(quadros, opcoes)

  /** Entrada com pouso: sobe --mov-sobe (8 px) e assenta passando ~2%, --dur-pouso (450 ms), --ease-pouso. */
  function pouso(el, atrasoMs = 0) {
    const sobe = medidaDoToken('--mov-sobe', 8, el)
    return animarEl(el, [{ opacity: 0, transform: `translateY(${sobe}px)` }, { opacity: 1, transform: 'none' }],
      { duration: duracaoDoToken('--dur-pouso', 450, el), delay: atrasoMs, easing: textoDaCurva('--ease-pouso', el), fill: 'backwards' })
  }
  /** Entrada quieta (.mv-quieto): sobe 8 px e aparece em --dur-quieto (280 ms), --ease-quieto, sem quique. */
  function entrarQuieto(el, atrasoMs = 0) {
    const sobe = medidaDoToken('--mov-sobe', 8, el)
    return animarEl(el, [{ opacity: 0, transform: `translateY(${sobe}px)` }, { opacity: 1, transform: 'none' }],
      { duration: duracaoDoToken('--dur-quieto', 280, el), delay: atrasoMs, easing: textoDaCurva('--ease-quieto', el), fill: 'backwards' })
  }
  /** Saída quieta: sobe --mov-sai (4 px) e some em --dur-sair (140 ms), --ease-in. */
  function sairQuieto(el) {
    const sobe = medidaDoToken('--mov-sai', 4, el)
    return animarEl(el, [{ opacity: 1, transform: 'none' }, { opacity: 0, transform: `translateY(-${sobe}px)` }],
      { duration: duracaoDoToken('--dur-sair', 140, el), easing: textoDaCurva('--ease-in', el), fill: 'forwards' })
  }
  /** Botão que recebeu tudo o que precisava: cresce 5% e volta (450 + 150 ms). */
  function assentar(el) {
    return animarEl(el, [{ transform: 'scale(1)' }, { transform: 'scale(1.05)', offset: 0.2 }, { transform: 'scale(1)' }],
      { duration: duracaoDoToken('--dur-pouso', 450, el) + 150, easing: 'ease-out' })
  }
  /** Clique vindo de código: afunda 3% e volta em 560 ms com --ease-quieto. */
  function afundar(el) {
    const escala = medidaDoToken('--mov-afunda', 0.97, el)
    return animarEl(el, [{ transform: 'scale(1)' }, { transform: `scale(${escala})`, offset: 0.16 }, { transform: 'scale(1)' }],
      { duration: 560, easing: textoDaCurva('--ease-quieto', el) })
  }
  /** Clique de verdade: :active afunda para scale(.97) e volta com --spring em --dur-base (base.css). */
  function afundarNoClique(el) { el.classList.add('pp-afunda'); return () => el.classList.remove('pp-afunda') }
  /** Balanço leve de recusa: 2 px para cada lado e assenta, 760 ms. */
  function balancar(el) {
    return animarEl(el, [{ transform: 'translateX(0)' }, { transform: 'translateX(-2px)', offset: 0.16 }, { transform: 'translateX(2px)', offset: 0.36 }, { transform: 'translateX(0)' }],
      { duration: 760, easing: 'ease-out' })
  }
  /** Pulso curto no saldo quando o crédito sai ou chega (300 ms). */
  function pulsar(el, escala = 1.04) {
    return animarEl(el, [{ transform: 'scale(1)' }, { transform: `scale(${escala})`, offset: 0.3 }, { transform: 'scale(1)' }], { duration: 300, easing: 'ease-out' })
  }
  /** Número que muda: sobe (ou desce) 3 px e assenta com pouso (380 ms). */
  function rolarNumero(el, subindo) {
    return animarEl(el, [{ transform: `translateY(${subindo ? 3 : -3}px)` }, { transform: 'none' }], { duration: 380, easing: textoDaCurva('--ease-pouso', el) })
  }

  /* =====================================================================================
     Texto que entra em foco por linha (src/motion/foco.ts)
     ===================================================================================== */

  const ATRASO_ENTRE_LINHAS_MS = 120

  function quebrarEmPalavras(copia) {
    const palavras = [], andar = document.createTreeWalker(copia, NodeFilter.SHOW_TEXT), nos = []
    for (let no = andar.nextNode(); no; no = andar.nextNode()) nos.push(no)
    for (const no of nos) {
      const fragmento = document.createDocumentFragment()
      for (const pedaco of (no.nodeValue || '').split(/(\s+)/)) {
        if (!pedaco) continue
        if (/^\s+$/.test(pedaco)) { fragmento.append(pedaco); continue }
        const palavra = document.createElement('span')
        palavra.className = 'pp-palavra'; palavra.textContent = pedaco
        palavras.push(palavra); fragmento.append(palavra)
      }
      no.replaceWith(fragmento)
    }
    return palavras
  }
  function agruparPorLinha(palavras) {
    const linhas = new Map()
    for (const p of palavras) {
      const topo = Math.round(p.getBoundingClientRect().top)
      const chave = [...linhas.keys()].find((k) => Math.abs(k - topo) <= 3)
      const k = chave === undefined ? topo : chave
      linhas.set(k, [...(linhas.get(k) || []), p])
    }
    return [...linhas.entries()].sort(([a], [b]) => a - b).map(([, l]) => l)
  }
  function esconderTexto(raiz) { raiz.classList.add('pp-foco-escondido'); raiz.style.setProperty('color', 'transparent') }
  function mostrarTexto(raiz) { raiz.classList.remove('pp-foco-escondido'); raiz.style.removeProperty('color') }

  /** Cada linha: desfoque --mov-foco → nítido, subindo 4 px, --dur-pouso, --ease-quieto, 120 ms entre linhas. */
  function entrarEmFoco(raiz, opcoes = {}) {
    if (preferePoucoMovimento() || !(raiz.textContent || '').trim() || typeof raiz.animate !== 'function') return null
    const { atrasoMs = 0, duracaoMs = duracaoDoToken('--dur-pouso', 450, raiz) } = opcoes
    const estilo = getComputedStyle(raiz)
    const copia = document.createElement('div')
    copia.className = 'pp-foco-copia'; copia.setAttribute('aria-hidden', 'true')
    copia.style.color = estilo.color; copia.style.padding = estilo.padding
    for (const filho of raiz.childNodes) copia.append(filho.cloneNode(true))
    copia.querySelectorAll('[id]').forEach((el) => el.removeAttribute('id'))
    raiz.classList.add('pp-foco-raiz'); esconderTexto(raiz); raiz.setAttribute('aria-busy', 'true'); raiz.append(copia)
    const linhasDePalavras = agruparPorLinha(quebrarEmPalavras(copia))
    const linhas = linhasDePalavras.map((l) => {
      const c = l.map((p) => p.getBoundingClientRect())
      return { esquerda: Math.min(...c.map((r) => r.left)), direita: Math.max(...c.map((r) => r.right)), topo: Math.min(...c.map((r) => r.top)), base: Math.max(...c.map((r) => r.bottom)) }
    })
    const desfoque = medidaDoToken('--mov-foco', 4, raiz), sobe = medidaDoToken('--mov-sobe', 8, raiz) / 2
    const animacoes = linhasDePalavras.flatMap((l, i) => l.map((p) => p.animate(
      [{ opacity: 0, filter: `blur(${desfoque}px)`, transform: `translateY(${sobe}px)` }, { opacity: 1, filter: 'blur(0)', transform: 'none' }],
      { duration: duracaoMs, delay: atrasoMs + i * ATRASO_ENTRE_LINHAS_MS, easing: textoDaCurva('--ease-quieto', raiz), fill: 'backwards' })))
    let encerrado = false
    const encerrar = () => {
      if (encerrado) return
      encerrado = true
      animacoes.forEach((a) => a.cancel()); copia.remove(); mostrarTexto(raiz); raiz.removeAttribute('aria-busy')
    }
    const pronto = Promise.all(animacoes.map((a) => a.finished.catch(() => undefined))).then(encerrar)
    return { linhas, pronto, cancelar: encerrar }
  }

  /* =====================================================================================
     Crédito em partículas (src/motion/credito.ts)
     ===================================================================================== */

  /** Quantas partículas levam o custo até o botão; contorno e preenchimento do saldo insuficiente (credito.ts). */
  const PARTICULAS_POR_GERACAO = 12
  const PONTOS_DO_CONTORNO = 40
  const PARTICULAS_SEM_SALDO = 16
  const ESPERA_ANTES_DE_VOLTAR_MS = 1150
  const PARTICULAS_DA_COMPRA = 22

  const coresDoCredito = (el) => ({ nucleo: corDoToken('--credito-nucleo', el), halo: corDoToken('--credito-halo', el) })

  /* Saldo na tela: o valor real e o que está "em voo" (credito.ts useCreditoEmVoo). O número mostra real − em voo. */
  const saldos = new WeakMap()
  const formatoDoSaldo = new Intl.NumberFormat('pt-BR', { maximumFractionDigits: 0 })
  const numeroDoSaldo = (saldo) => (saldo && (saldo.querySelector('[data-saldo-numero]') || saldo)) || null
  function estadoDoSaldo(saldo) {
    let st = saldos.get(saldo)
    if (!st) {
      const numero = numeroDoSaldo(saldo)
      const lido = Number(saldo.dataset.valor || ((numero && numero.textContent) || '').replace(/\D/g, '')) || 0
      st = { real: lido, emVoo: 0 }
      saldos.set(saldo, st)
    }
    return st
  }
  function pintarSaldo(saldo) {
    if (!saldo) return
    const st = estadoDoSaldo(saldo), mostrado = Math.max(0, st.real - st.emVoo)
    const numero = numeroDoSaldo(saldo)
    if (numero) numero.textContent = formatoDoSaldo.format(Math.round(mostrado))
    // Anel do menu: o arco acompanha o saldo à vista (Sidebar.tsx r = 15).
    const arco = saldo.querySelector('.cr-fg'), total = Number(saldo.dataset.total)
    if (arco && total > 0) { const C = 2 * Math.PI * 15; arco.style.strokeDashoffset = String(C * (1 - limitar(mostrado / total, 0, 1))) }
  }
  function mudarEmVoo(saldo, delta) { if (!saldo) return; const st = estadoDoSaldo(saldo); st.emVoo = Math.max(0, st.emVoo + delta); pintarSaldo(saldo) }
  /** Define o saldo real de um elemento de saldo (pílula ou anel). */
  function definirSaldo(saldo, valor) { const st = estadoDoSaldo(saldo); st.real = valor; st.emVoo = 0; pintarSaldo(saldo) }

  /** Sem saldo à vista: o crédito sai do canto onde fica o menu (credito.ts). */
  const origemDeReserva = (campo) => ({ x: 24, y: campo.h - 48, w: 0, h: 0, l: 24, t: campo.h - 48 })

  /** Estado de carga do botão: anel e reflexo pela variável --carga (credito.ts). */
  function carregar(botao, carga) { botao.dataset.energia = carga >= 1 ? 'cheia' : 'carregando'; botao.style.setProperty('--carga', String(Math.min(1, carga))) }
  async function descarregar(botao) {
    const de = Number(botao.style.getPropertyValue('--carga')) || 0
    await animar(600, curvaDoToken('--ease-quieto', botao), (v) => botao.style.setProperty('--carga', String(de * (1 - v))))
    delete botao.dataset.energia
    botao.style.removeProperty('--carga')
  }

  /**
   * Gerar (credito.ts energizar): 12 partículas saem do saldo em arco (−40 px ±30%) até o botão, 0,55 s cada,
   * a primeira com 80 ms e depois 45 ms entre elas, curva --ease-in-out. Cada uma que chega sobe --carga 1/12 e desconta
   * do saldo na tela. Cheio: o número rola, o botão assenta (5%) e, 300 ms depois, a carga apaga em 600 ms.
   * Devolve { pronta, emVoo, concluir() }: concluir() é a geração que deu certo (o saldo real desce o custo).
   */
  function gerar(saldo, botao, opcoes = {}) {
    const custo = opcoes.custo == null ? Number((botao.querySelector('[data-creditos]') || {}).dataset?.creditos) || 0 : opcoes.custo
    let emVoo = 0, concluida = false
    const concluir = () => {
      if (concluida) return
      concluida = true
      if (saldo) { const st = estadoDoSaldo(saldo); st.real -= custo; st.emVoo = Math.max(0, st.emVoo - emVoo); pintarSaldo(saldo) }
    }
    if (preferePoucoMovimento() || custo <= 0) return { pronta: Promise.resolve(), get emVoo() { return emVoo }, caixa: null, custo, concluir }
    const campo = campoDaPagina(), cores = coresDoCredito(botao)
    campo.medir()
    const de = saldo ? campo.caixa(saldo) : origemDeReserva(campo), caixa = campo.caixa(botao)
    const porParticula = custo / PARTICULAS_POR_GERACAO
    let chegaram = 0, terminar = () => {}
    const pronta = new Promise((r) => { terminar = r })
    carregar(botao, 0)
    if (saldo) pulsar(saldo)
    for (let i = 0; i < PARTICULAS_POR_GERACAO; i++) {
      campo.adicionar(viagem({
        de, ate: { x: caixa.x + aleatorio(-caixa.w * 0.35, caixa.w * 0.35), y: caixa.y }, cores, atrasoS: 0.08 + i * 0.045, duracaoS: 0.55,
        aoChegar: () => {
          chegaram++; emVoo += porParticula; mudarEmVoo(saldo, porParticula)
          carregar(botao, chegaram / PARTICULAS_POR_GERACAO)
          if (chegaram < PARTICULAS_POR_GERACAO) return
          const numero = numeroDoSaldo(saldo)
          if (numero) rolarNumero(numero, false)
          if (botao.isConnected) assentar(botao)
          esperar(300).then(() => descarregar(botao))
          terminar()
        },
      }))
    }
    return { pronta, get emVoo() { return emVoo }, caixa, custo, concluir }
  }

  /**
   * Falha técnica (credito.ts devolver): o botão balança e as 12 partículas saem dele de volta ao saldo,
   * arco −30 px, 0,55 s, 100 ms e depois 40 ms entre elas. Cada uma devolve a sua parte; na última, o saldo pulsa
   * 6% e o número rola para cima. Nada foi gasto.
   */
  async function devolver(saldo, botao, opcoes = {}) {
    const energia = opcoes.energia || null
    if (energia) await energia.pronta
    const emVoo = energia ? energia.emVoo : 0
    const custo = opcoes.custo == null ? (energia ? energia.custo : 0) : opcoes.custo
    if (preferePoucoMovimento()) { mudarEmVoo(saldo, -emVoo); return }
    const campo = campoDaPagina(), cores = coresDoCredito(botao)
    campo.medir()
    const caixa = botao.isConnected ? campo.caixa(botao) : energia && energia.caixa
    if (botao.isConnected) balancar(botao)
    if (!caixa) { mudarEmVoo(saldo, -emVoo); return }
    const ate = saldo ? campo.caixa(saldo) : origemDeReserva(campo)
    const porParticula = (emVoo || custo) / PARTICULAS_POR_GERACAO
    let voltaram = 0
    await new Promise((pronto) => {
      for (let i = 0; i < PARTICULAS_POR_GERACAO; i++) {
        campo.adicionar(viagem({
          de: { x: caixa.x + aleatorio(-caixa.w * 0.3, caixa.w * 0.3), y: caixa.y }, ate, cores, atrasoS: 0.1 + i * 0.04, duracaoS: 0.55, arco: -30,
          aoChegar: () => {
            voltaram++
            if (emVoo) mudarEmVoo(saldo, -porParticula)
            if (voltaram < PARTICULAS_POR_GERACAO) return
            if (saldo) { pulsar(saldo, 1.06); const numero = numeroDoSaldo(saldo); if (numero) rolarNumero(numero, true) }
            pronto()
          },
        }))
      }
    })
  }

  /**
   * Saldo insuficiente (credito.ts semSaldo): um contorno de 40 pontos leves (raio 0,9, opacidade até 0,4,
   * cor --credito-vaga) acende em volta do botão, a 6 px dele, em 9 ms por ponto. 16 partículas (raio 1,35) saem do
   * saldo e preenchem 2/5 do contorno (--ease-suave, 0,55 s, 100 ms e depois 24 ms entre elas, arco −28 a −46 px).
   * O número do saldo apaga para 40% em 350 ms. Todas chegaram: o botão balança; 750 ms depois voltam em fila
   * (a última que chegou sai primeiro, 20 ms entre elas, 0,5 s, --ease-in-out). Em casa: o número volta, o saldo
   * pulsa 3% e o contorno apaga. Nada foi gasto.
   */
  /** Pontos sobre o contorno real do botão: retângulo com o raio dele, a `folga` px de distância, do meio de cima no sentido do relógio. */
  function noContorno(caixa, raioDoBotao, quantos, folga = 5) {
    const w = caixa.w + folga * 2, h = caixa.h + folga * 2, r = Math.min(raioDoBotao + folga, h / 2, w / 2)
    const retaX = w - 2 * r, retaY = h - 2 * r, arco = Math.PI * r / 2
    const perimetro = 2 * retaX + 2 * retaY + 4 * arco
    const x0 = caixa.x - w / 2, y0 = caixa.y - h / 2
    const cantos = [[x0 + w - r, y0 + r, -Math.PI / 2], [x0 + w - r, y0 + h - r, 0], [x0 + r, y0 + h - r, Math.PI / 2], [x0 + r, y0 + r, Math.PI]]
    return Array.from({ length: quantos }, (_, i) => {
      let d = ((i / quantos) * perimetro + retaX / 2) % perimetro
      const trechos = [
        (t) => ({ x: x0 + r + t, y: y0 }), retaX, cantos[0],
        (t) => ({ x: x0 + w, y: y0 + r + t }), retaY, cantos[1],
        (t) => ({ x: x0 + w - r - t, y: y0 + h }), retaX, cantos[2],
        (t) => ({ x: x0, y: y0 + h - r - t }), retaY, cantos[3],
      ]
      for (let k = 0; k < 12; k += 3) {
        if (d < trechos[k + 1]) return trechos[k](d)
        d -= trechos[k + 1]
        if (d < arco) { const [cx, cy, a0] = trechos[k + 2], a = a0 + d / r; return { x: cx + Math.cos(a) * r, y: cy + Math.sin(a) * r } }
        d -= arco
      }
      return { x: x0 + r, y: y0 }
    })
  }
  const raioDe = (el) => parseFloat(getComputedStyle(el).borderTopLeftRadius) || 0
  async function semSaldo(saldo, botao) {
    if (preferePoucoMovimento()) return
    const campo = campoDaPagina(), cores = coresDoCredito(botao), vaga = corDoToken('--credito-vaga', botao)
    campo.medir()
    const casa = saldo ? campo.caixa(saldo) : origemDeReserva(campo), caixa = campo.caixa(botao)
    const pontos = noContorno(caixa, raioDe(botao), PONTOS_DO_CONTORNO, 5)
    const controle = { voltar: false, atrasoDaVolta: (ordem) => ordem * 0.035 }
    const contorno = pontos.map((v, i) => {
      let tempo = -i * 0.009
      const p = {
        x: v.x, y: v.y, r: 0.8, a: 0, cor: vaga,
        passo(dt) {
          tempo += dt
          if (controle.fim) { p.a -= dt * 2; return p.a > 0 }
          if (tempo > 0) p.a = Math.min(0.3, p.a + dt * 2.2)
          return true
        },
      }
      return p
    })
    campo.adicionar(...contorno)
    const numero = numeroDoSaldo(saldo)
    const apagado = numero && numero.animate ? numero.animate([{ opacity: 1 }, { opacity: 0.4 }], { duration: 350, easing: 'ease-in-out', fill: 'forwards' }) : null
    const curva = curvaDoToken('--ease-suave', botao)
    let chegaram = 0, voltaram = 0
    await new Promise((pronto) => {
      for (let i = 0; i < PARTICULAS_SEM_SALDO; i++) {
        campo.adicionar(idaEVolta({
          de: casa, ate: pontos[i], cores, controle, ordem: PARTICULAS_SEM_SALDO - 1 - i, atrasoS: 0.1 + i * 0.024, duracaoS: 0.55, duracaoVoltaS: 0.5, r: 1.9, curvaIda: curva,
          aoChegar: () => {
            if (++chegaram < PARTICULAS_SEM_SALDO) return
            if (botao.isConnected) balancar(botao)
            esperar(ESPERA_ANTES_DE_VOLTAR_MS).then(() => { controle.voltar = true })
          },
          aoVoltar: () => {
            if (++voltaram < PARTICULAS_SEM_SALDO) return
            if (apagado) apagado.reverse()
            if (saldo) pulsar(saldo, 1.03)
            controle.fim = true
            pronto()
          },
        }))
      }
    })
  }

  /**
   * Créditos comprados (credito.ts chegarCreditos): o pacote se desfaz em 22 partículas (raio 1,4 a 2,1)
   * espalhadas pela largura dele, que voam até o saldo: arco −50 px, 0,6 s, 50 ms e depois 30 ms entre elas. Cada
   * uma que chega dá um pulso de 3% no saldo; na última o número rola para cima (e aqui o saldo real sobe `creditos`).
   */
  async function comprar(saldo, pacote, opcoes = {}) {
    const creditos = opcoes.creditos || 0
    const somar = () => { if (saldo && creditos) { const st = estadoDoSaldo(saldo); st.real += creditos; pintarSaldo(saldo) } }
    if (preferePoucoMovimento()) { somar(); return }
    const campo = campoDaPagina(), cores = coresDoCredito(saldo || pacote)
    campo.medir()
    const caixa = pacote.getBoundingClientRect ? campo.caixa(pacote) : campo.caixaDoRetangulo(pacote)
    const ate = saldo ? campo.caixa(saldo) : origemDeReserva(campo)
    let chegaram = 0
    await new Promise((pronto) => {
      for (let i = 0; i < PARTICULAS_DA_COMPRA; i++) {
        campo.adicionar(viagem({
          de: { x: caixa.l + aleatorio(4, Math.max(5, caixa.w - 4)), y: caixa.y + aleatorio(-6, 6) }, ate, cores, atrasoS: 0.05 + i * 0.03, duracaoS: 0.6, arco: -50, r: aleatorio(1.4, 2.1),
          aoChegar: () => {
            if (saldo) pulsar(saldo, 1.03)
            if (++chegaram === PARTICULAS_DA_COMPRA) { somar(); const numero = numeroDoSaldo(saldo); if (numero) rolarNumero(numero, true); pronto() }
          },
        }))
      }
    })
  }

  /* =====================================================================================
     Avião de partículas do Origami (src/motion/aviao.ts, AviaoDeParticulas.tsx, aviaoQueSaiu.ts, repartir.ts)
     ===================================================================================== */

  const PA = (x, y) => [(x - 12) / 9, (y - 12) / 9]
  const ASA_DE_CIMA = [PA(3, 12), PA(21, 4), PA(12, 13)]
  const ASA_DE_BAIXO = [PA(12, 13), PA(21, 4), PA(15, 20)]
  const VINCOS = [[PA(3, 12), PA(21, 4)], [PA(21, 4), PA(15, 20)], [PA(15, 20), PA(12, 13)], [PA(12, 13), PA(3, 12)], [PA(12, 13), PA(21, 4)]]
  function dentro(px, py, [[ax, ay], [bx, by], [cx, cy]]) {
    const d = (by - cy) * (ax - cx) + (cx - bx) * (ay - cy)
    const u = ((by - cy) * (px - cx) + (cx - bx) * (py - cy)) / d, v = ((cy - ay) * (px - cx) + (ax - cx) * (py - cy)) / d
    return u >= 0 && v >= 0 && u + v <= 1
  }
  function pontosDoAviao(tamanho, passo = 3.2) {
    const pontos = [], s = passo / tamanho
    for (let y = -1.1; y <= 1.1; y += s) {
      for (let x = -1.1; x <= 1.1; x += s) {
        const jx = x + aleatorio(-s * 0.2, s * 0.2), jy = y + aleatorio(-s * 0.2, s * 0.2)
        if (dentro(jx, jy, ASA_DE_CIMA)) pontos.push({ hx: jx * tamanho, hy: jy * tamanho, tom: 1 })
        else if (dentro(jx, jy, ASA_DE_BAIXO)) pontos.push({ hx: jx * tamanho, hy: jy * tamanho, tom: 2 })
      }
    }
    for (const [[ax, ay], [bx, by]] of VINCOS) {
      const n = Math.ceil((Math.hypot(bx - ax, by - ay) * tamanho) / (passo * 0.7))
      for (let k = 0; k <= n; k++) pontos.push({ hx: (ax + ((bx - ax) * k) / n) * tamanho, hy: (ay + ((by - ay) * k) / n) * tamanho, tom: 0 })
    }
    return pontos
  }
  const OPACIDADE_DO_TOM = { 0: 1, 1: 0.55, 2: 0.45 }
  function criarAviao(campo, { x, y, tamanho = 26, passo = 3.2, tinta, sombra, origem }) {
    const est = { x, y, ang: 0, forma: 0, sopro: 0, rumo: 0, solto: 0, vivo: true }
    const base = pontosDoAviao(tamanho, passo)
    const pousoC = curvaDoToken('--ease-pouso'), soltar = curvaDoToken('--ease-in-out')
    const particulas = base.map((q, i) => {
      const o = origem ? origem(i, base.length) : { x: x + aleatorio(-120, 120), y: y + aleatorio(-60, 60) }
      const ordem = origem ? i / base.length : Math.random(), fase = Math.random() * Math.PI * 2
      const p = {
        x: o.x, y: o.y, r: q.tom === 0 ? 1.15 : 0.9, a: 0, cor: q.tom === 2 ? sombra : tinta, alvo: null,
        passo() {
          if (!est.vivo) return false
          const k = pousoC(limitar(est.forma * 1.4 - ordem * 0.4, 0, 1))
          const co = Math.cos(est.ang), si = Math.sin(est.ang)
          const ondula = Math.sin((performance.now() / 1000) * 4 + fase) * est.sopro
          const fx = est.x + q.hx * co - q.hy * si, fy = est.y + q.hx * si + q.hy * co + ondula
          if (p.alvo && est.solto > 0) {
            const s = soltar(limitar(est.solto * 1.5 - ordem * 0.5, 0, 1))
            p.x = fx + (p.alvo.x - fx) * s; p.y = fy + (p.alvo.y - fy) * s - Math.sin(s * Math.PI) * 18
            p.a = 1 - limitar((est.solto - 0.75) * 4, 0, 1)
            return true
          }
          p.x = o.x + (fx - o.x) * k; p.y = o.y + (fy - o.y) * k
          p.a = limitar(est.forma * 2, 0, 1) * OPACIDADE_DO_TOM[q.tom]
          return true
        },
      }
      return p
    })
    campo.adicionar(...particulas)
    const foto = () => particulas.map((p) => ({ x: p.x, y: p.y, r: p.r, cor: p.cor, a: p.a }))
    const fotografarFormado = () => {
      const antes = { forma: est.forma, vivo: est.vivo }
      est.forma = 1; est.vivo = true
      particulas.forEach((p) => p.passo(0))
      const pontos = foto()
      est.forma = antes.forma; est.vivo = antes.vivo
      return pontos
    }
    return { est, particulas, fotografar: foto, fotografarFormado }
  }

  /** Quantas partículas vão para cada linha: proporcional à largura, no mínimo 4 (repartir.ts). */
  function repartirPorLargura(total, larguras) {
    const soma = larguras.reduce((s, w) => s + Math.max(1, w), 0)
    const cotas = larguras.map((w) => Math.max(4, Math.floor((Math.max(1, w) / soma) * total)))
    let sobra = total - cotas.reduce((s, n) => s + n, 0)
    const ordem = larguras.map((w, i) => [w, i]).sort((a, b) => b[0] - a[0]).map(([, i]) => i)
    for (let passo = 0; sobra !== 0 && passo < total * 2; passo++) {
      const i = ordem[passo % ordem.length]
      if (sobra > 0) { cotas[i]++; sobra-- } else if (cotas[i] > 1) { cotas[i]--; sobra++ }
    }
    return cotas
  }

  /** O avião se desfaz e as partículas pousam na base de cada linha, no ritmo das linhas (aviaoQueSaiu.ts). */
  function pousarNasLinhas(pontos, linhas, { ancora, partidasMs = [] } = {}) {
    if (!linhas.length || preferePoucoMovimento()) return
    const campo = campoDaPagina()
    campo.medir()
    const cotas = repartirPorLargura(pontos.length, linhas.map((l) => l.direita - l.esquerda))
    const origens = [...pontos].sort((a, b) => a.y - b.y || a.x - b.x)
    const marcados = []
    let usados = 0
    linhas.forEach((l, indice) => {
      const quantas = cotas[indice], daLinha = origens.slice(usados, usados + quantas).sort((a, b) => a.x - b.x)
      usados += quantas
      if (!daLinha.length) return
      const largura = Math.max(1, l.direita - l.esquerda)
      const alvos = daLinha.map((_, j) => {
        const x = l.esquerda + ((j + 0.5) / daLinha.length) * largura + aleatorio(-1.2, 1.2), y = l.base - 3 + aleatorio(-0.8, 0.8)
        const alvo = { x, y }
        marcados.push({ alvo, x, y })
        return alvo
      })
      const particulas = migrar(campo, daLinha, alvos, {
        cor: corDoToken('--ink', ancora), duracaoS: 0.45, espalharS: 0.1, soltura: 26, variarDuracao: 0.2, atrasoS: (partidasMs[indice] || 0) / 1000,
        direcao: Math.PI / 2, impulso: 14, limiar: 0.7,
        aoAssentar: () => particulas.forEach((p) => { p.sumir = true }),
      })
    })
    if (ancora) {
      const inicio = ancora.getBoundingClientRect(), comeco = performance.now()
      const seguir = () => {
        if (!ancora.isConnected || performance.now() - comeco > 1800) return
        const agora = ancora.getBoundingClientRect(), dx = agora.left - inicio.left, dy = agora.top - inicio.top
        for (const m of marcados) { m.alvo.x = m.x + dx; m.alvo.y = m.y + dy }
        requestAnimationFrame(seguir)
      }
      requestAnimationFrame(seguir)
    }
  }

  /** Resposta nova: as linhas esperam 280 ms o pouso e entram em foco; as partículas do avião pousam nelas (RespostaEmFoco.tsx). */
  const ESPERA_DO_POUSO_MS = 280
  function respostaEmFoco(raiz, pontosDoAviao) {
    if (preferePoucoMovimento()) return null
    esconderTexto(raiz)
    let texto = null
    const quadro = requestAnimationFrame(() => {
      mostrarTexto(raiz)
      const atrasoMs = pontosDoAviao ? ESPERA_DO_POUSO_MS : 0
      texto = entrarEmFoco(raiz, { atrasoMs })
      const linhas = texto ? texto.linhas : []
      if (pontosDoAviao) pousarNasLinhas(pontosDoAviao, linhas, { ancora: raiz, partidasMs: linhas.map((_, i) => i * ATRASO_ENTRE_LINHAS_MS) })
    })
    return { cancelar() { cancelAnimationFrame(quadro); if (texto) texto.cancelar(); mostrarTexto(raiz) } }
  }

  /**
   * Origami pensando (AviaoDeParticulas.tsx › AviaoPairando + OrigamiPensando.tsx): num palco de 48 px de altura, um
   * avião de partículas (meio-lado 20 px, ponto a cada 2,3 px, contorno em --ink e asa de baixo em --muted) se forma em
   * 1,6 s (--ease-in-out, pontos nascem espalhados ±120 × ±60 px e assentam com --ease-pouso); as asas ondulam até 1,2 px
   * a partir de 0,6 s; depois paira em ciclos de 1,6 s (y 0/−5/+3/0 px, giro 0/−0,08/0,06/0 rad).
   * `responder(elDaResposta)`: o avião se desfaz e pousa nas linhas da resposta, que entram em foco.
   */
  const FORMAR_MS = 1600, PAIRAR_MS = 1600
  function origamiPensando(container, opcoes = {}) {
    const tamanho = opcoes.tamanho || 20
    const caixaDoPensando = document.createElement('div')
    caixaDoPensando.setAttribute('aria-hidden', 'true')
    container.append(caixaDoPensando)
    if (preferePoucoMovimento()) {
      caixaDoPensando.className = 'pp-pensando'
      caixaDoPensando.innerHTML = tsuruSvg({ tamanho: 14, parado: true }) + '<span class="pp-pensando-pontos"><i></i><i></i><i></i></span>'
      return {
        responder(raiz) { caixaDoPensando.remove(); return respostaEmFoco(raiz, null) },
        parar() { caixaDoPensando.remove() },
      }
    }
    caixaDoPensando.className = 'pp-pensando com-aviao'
    const host = document.createElement('div')
    host.className = 'pp-aviao'
    caixaDoPensando.append(host)
    const campo = criarCampo(host)
    campo.medir()
    const cy = campo.h / 2, cx = Math.min(campo.w / 2, tamanho * 1.2 + 8)
    const aviao = criarAviao(campo, { x: cx, y: cy, tamanho, passo: 2.3, tinta: corDoToken('--ink', host), sombra: corDoToken('--muted', host) })
    const parar = new AbortController(), sinal = parar.signal
    const balanco = curvaDoToken('--ease-in-out', host)
    let caixa = host.getBoundingClientRect()
    const lembrarCaixa = () => { const r = host.getBoundingClientRect(); if (r.width > 0 && r.height > 0) caixa = r }
    animar(600, (k) => k, (v) => { aviao.est.sopro = v * 1.2 }, { atrasoMs: 600, sinal })
    animar(FORMAR_MS, balanco, (v) => { aviao.est.forma = v; lembrarCaixa() }, { sinal }).then(async () => {
      while (!sinal.aborted) {
        await animar(PAIRAR_MS, balanco, (v) => { aviao.est.y = cy + entreChaves([0, -5, 3, 0], v); aviao.est.ang = entreChaves([0, -0.08, 0.06, 0], v); lembrarCaixa() }, { sinal })
      }
    })
    const encerrar = () => {
      parar.abort()
      if (host.isConnected) lembrarCaixa()
      const pontos = caixa.width > 0 && aviao.est.forma > 0.05
        ? aviao.fotografarFormado().map((p) => ({ ...p, a: Math.max(p.a || 0, 0.8), x: p.x + caixa.left, y: p.y + caixa.top }))
        : null
      campo.destruir()
      caixaDoPensando.remove()
      return pontos
    }
    return {
      /** A resposta chegou: `raiz` já está no lugar (no DOM); o avião pousa nas linhas dela. */
      responder(raiz) { const pontos = encerrar(); return respostaEmFoco(raiz, pontos) },
      parar() { encerrar() },
    }
  }

  /* =====================================================================================
     Tsuru (src/copilot/OrigamiIcon.tsx) e OrigamiLoading (src/components/OrigamiLoading.tsx, PlaneFlight.tsx)
     ===================================================================================== */

  /** O SVG real do tsuru. `parado`: o dos botões de gerar, que só bate as asas no hover. */
  function tsuruSvg({ tamanho = 20, parado = false } = {}) {
    return `<svg class="pp-oricon${parado ? ' still' : ''}" width="${tamanho}" height="${tamanho}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round" aria-hidden="true">` +
      '<path d="M1.2 7.6 7.6 15.6l2.6-1.1Z"/>' +
      '<g class="wing2"><path d="M2.2 21.5 7.6 15.6h2.6l5.4 3.4Z"/><path d="M2.2 21.5 15.6 19"/></g>' +
      '<path d="M10.2 15.6 12.7 13.3l2.9 3.9.7 3.8-2.1-1.4"/>' +
      '<path d="M16.3 21 18.6 13l.9-.6 3.8 3-3.6-.6-3.1 6.2"/>' +
      '<g class="wing"><path d="M10.9 14.6 11.1 11 19.9 2.5l-.5 10.2"/><path d="M19.9 2.5 14.5 15"/></g></svg>'
  }
  /**
   * Hover do tsuru parado: dentro de um <button> o CSS já cuida (base.css flapfast 0,42 s). Para um tsuru fora de
   * botão, liga a mesma batida enquanto o ponteiro está sobre o elemento dono dele.
   */
  function tsuruHover(svgEl, alvo) {
    const dono = alvo || svgEl.closest('a,[role="button"]') || svgEl.parentElement || svgEl
    const entrar = () => svgEl.classList.add('bate'), sair = () => svgEl.classList.remove('bate')
    dono.addEventListener('pointerenter', entrar); dono.addEventListener('pointerleave', sair)
    return () => { dono.removeEventListener('pointerenter', entrar); dono.removeEventListener('pointerleave', sair); sair() }
  }

  const LACO = 'M60 96 C60 34 196 30 200 96 S340 162 344 96 S204 30 200 96 S60 158 60 96 Z'
  function planeFlightSvg() {
    const parado = preferePoucoMovimento()
    return `<svg class="pp-planeflight" viewBox="0 0 400 190" preserveAspectRatio="xMidYMid slice" aria-hidden="true">` +
      `<path class="pp-planeflight-rastro" d="${LACO}" fill="none" stroke-width="1.4" stroke-linecap="round" pathLength="100" stroke-dasharray="0.1 2.2 0.1 2.2 0.1 2.2 0.1 2.2 0.1 2.2 0.1 79">` +
      (parado ? '' : '<animate attributeName="stroke-dashoffset" values="12;-88" dur="7s" repeatCount="indefinite"/>') + '</path>' +
      '<g>' + (parado ? '' : `<animateMotion path="${LACO}" dur="7s" repeatCount="indefinite" rotate="auto"/>`) +
      `<g${parado ? ' transform="translate(200 96) rotate(-20)"' : ''}>` +
      '<g class="pp-planeflight-aviao" transform="rotate(45) translate(-13 -13) scale(1.1)" stroke-width="1.2" stroke-linejoin="round" stroke-linecap="round">' +
      '<path class="pp-planeflight-asa" d="M21.5 2.5 2.5 10.5 9 13Z"/><path class="pp-planeflight-corpo" d="M21.5 2.5 9 13l7 7.5Z"/><path class="pp-planeflight-asa" d="M9 13l.5 6 2.8-2.4Z"/>' +
      '</g></g></g></svg>'
  }
  const esc = (t) => String(t).replace(/[&<>"]/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]))
  /** O HTML do OrigamiLoading: avião em laço de 7 s sobre o texto e a barra indeterminada (ou a versão de uma linha). */
  function origamiLoadingHtml({ texto = 'Origami animando…', detalhe, linha = false } = {}) {
    if (linha) {
      return '<div class="pp-oriload linha" role="status" aria-live="polite"><span class="pp-oriload-laco" aria-hidden="true">' +
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" stroke-linecap="round"><path d="M21.5 2.5 2.5 10.5 9 13Z"/><path d="M21.5 2.5 9 13l7 7.5Z"/><path d="M9 13l.5 6 2.8-2.4Z"/></svg>' +
        `</span><b>${esc(texto)}</b><span class="pp-bar indet" aria-hidden="true"><i></i></span></div>`
    }
    return '<div class="pp-oriload" role="status" aria-live="polite">' + planeFlightSvg() +
      `<div class="pp-oriload-t"><b>${esc(texto)}</b><div class="pp-bar indet"><i></i></div>${detalhe ? `<small class="pp-oriload-d">${esc(detalhe)}</small>` : ''}</div></div>`
  }
  /** Põe o OrigamiLoading por cima de `container` (que precisa ser position:relative); devolve quem tira. */
  function origamiLoading(container, opcoes) {
    const molde = document.createElement('template')
    molde.innerHTML = origamiLoadingHtml(opcoes)
    const el = molde.content.firstElementChild
    container.append(el)
    return () => el.remove()
  }

  /* =====================================================================================
     Peças HTML: botão limão com selo de preço, pílula de saldo e anel do menu
     ===================================================================================== */

  /** Botão pago (BotaoDeCredito.tsx + Cost em redesign/ui.tsx): tsuru parado, rótulo e o selo com a moeda e o custo. */
  function botaoDeCreditoHtml({ rotulo = 'Gerar tomada', custo = 24, classe = 'a', falta = false } = {}) {
    return `<button type="button" class="pp-btn ${classe}">${tsuruSvg({ tamanho: 16, parado: true })}<span class="pp-rotulo">${esc(rotulo)}</span>` +
      `<span class="pp-preco${falta ? ' falta' : ''}" data-creditos="${custo}"${falta ? ' data-falta="sim"' : ''}><span class="moeda" aria-hidden="true"></span><span aria-hidden="true">${formatoDoSaldo.format(custo)}</span><span class="pp-so-leitor">≈ ${custo} créditos${falta ? ' · saldo não cobre' : ''}</span></span></button>`
  }
  /** Pílula de saldo das fichas de movimento (motion/demos.tsx › SaldoDeDemo). */
  function saldoHtml(valor) {
    return `<span class="pp-saldo" data-saldo data-valor="${valor}"><span class="pp-saldo-moeda" aria-hidden="true"><svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="6" cy="6" r="3.2"/></svg></span>` +
      `<span data-saldo-numero>${formatoDoSaldo.format(valor)}</span><small>créditos</small></span>`
  }
  /** Anel de créditos do menu (Sidebar.tsx): 38 × 38, r = 15, arco --ok proporcional ao saldo. */
  function anelHtml(valor, total) {
    const C = 2 * Math.PI * 15, parte = total > 0 ? limitar(valor / total, 0, 1) : 1
    return `<span class="pp-anel" data-saldo data-valor="${valor}" data-total="${total || valor}" role="img" aria-label="${formatoDoSaldo.format(valor)} créditos">` +
      `<svg width="38" height="38" viewBox="0 0 38 38" aria-hidden="true"><circle cx="19" cy="19" r="15" class="cr-bg"/><circle cx="19" cy="19" r="15" class="cr-fg" stroke-dasharray="${C}" stroke-dashoffset="${C * (1 - parte)}"/></svg>` +
      `<span class="cr-v" data-saldo-numero aria-hidden="true">${formatoDoSaldo.format(valor)}</span></span>`
  }
  /** "Gerando" com três pontinhos no lugar do rótulo e do preço (BotaoDeCredito.tsx); `false` devolve o conteúdo. */
  const conteudoOriginal = new WeakMap()
  function botaoGerando(botao, gerando, rotulo = 'Gerando') {
    if (gerando) {
      if (!conteudoOriginal.has(botao)) conteudoOriginal.set(botao, botao.innerHTML)
      const icone = botao.querySelector('.pp-oricon')
      botao.innerHTML = `<span class="pp-gerando">${icone ? icone.outerHTML : ''}${esc(rotulo)}<span class="pp-pontinhos" aria-hidden="true"><i></i><i></i><i></i></span></span>`
      botao.setAttribute('aria-busy', 'true')
    } else {
      if (conteudoOriginal.has(botao)) botao.innerHTML = conteudoOriginal.get(botao)
      conteudoOriginal.delete(botao)
      botao.removeAttribute('aria-busy')
    }
  }

  /* =====================================================================================
     Cursor de avião, bolinha de papel e ímã (src/app/cursor-de-aviao.ts, bolinha-de-papel.ts, ima-do-cursor.ts,
     rastro-de-voo.ts, CursorDeAviao.tsx)
     ===================================================================================== */

  const DESENHO_DO_AVIAO = { corpo: 'M2.6 2.6 21 10.2l-7.4 2.2L11 20z', dobra: 'm2.6 2.6 11 9.8', sombra: 'M13.6 12.4 11 20l1.2-6.6z' }
  const LADO_DO_AVIAO = 30
  const INCLINACAO_MAXIMA = 14, GANHO_DA_INCLINACAO = 1.4, SUAVIDADE_DA_INCLINACAO = 0.18, RETORNO_DA_INCLINACAO = 0.9
  const ESCALA = { normal: 1, clicavel: 1.15, pressionado: 0.88 }
  const CURSORES_SUBSTITUIVEIS = new Set(['auto', 'default', 'pointer', 'none'])
  function decidirCursor(cursorDoCss, ehCampo, ehClicavel, emZonaNativa) {
    if (ehCampo || emZonaNativa) return 'nativo'
    const primeiro = cursorDoCss.split(',').pop().trim()
    if (!CURSORES_SUBSTITUIVEIS.has(primeiro)) return 'nativo'
    return primeiro === 'pointer' || ehClicavel ? 'aviao-clicavel' : 'aviao'
  }
  const inclinacaoPelaVelocidade = (dx, reduzido) => reduzido ? 0 : limitar(dx * GANHO_DA_INCLINACAO, -INCLINACAO_MAXIMA, INCLINACAO_MAXIMA)
  const SELETOR_DE_CAMPO = 'input:not([type="button"],[type="submit"],[type="reset"],[type="checkbox"],[type="radio"],[type="range"],[type="color"],[type="file"],[type="image"]),textarea,[contenteditable]:not([contenteditable="false"])'
  const SELETOR_CLICAVEL = 'a[href],button:not(:disabled),[role="button"],[role="tab"],[role="switch"],[role="option"],[role="menuitem"],[role="radio"],[role="checkbox"],summary,label,select'
  const SELETOR_DE_ZONA_NATIVA = '[data-cursor-nativo]'
  const RASTRO = { inicio: 650, faixa: 900, vida: 200, tracoDoMiolo: 1.2, tracoDoHalo: 4, alfaDoHalo: 0.22 }
  const ASAS_NO_DESENHO = [[19.2, 10.6], [11.6, 18.2]]
  const forcaDoRastro = (v, reduzido) => reduzido ? 0 : limitar((v - RASTRO.inicio) / RASTRO.faixa, 0, 1)
  function pontasDasAsas(inclinacao, escala) {
    const porPx = LADO_DO_AVIAO / 24, r = inclinacao * Math.PI / 180, c = Math.cos(r), s = Math.sin(r)
    return ASAS_NO_DESENHO.map(([x, y]) => { const dx = (x - 2.6) * porPx * escala, dy = (y - 2.6) * porPx * escala; return [dx * c - dy * s, dx * s + dy * c] })
  }

  // Bolinha de papel (bolinha-de-papel.ts): o contorno de 12 pontos que vai do avião à bolinha low-poly.
  const PX = 30 / 24, PONTA_NO_DESENHO = 2.6
  const doDesenho = (x, y) => [(x - PONTA_NO_DESENHO) * PX, (y - PONTA_NO_DESENHO) * PX]
  const PONTA = doDesenho(2.6, 2.6), ASA_DIREITA = doDesenho(21, 10.2), ENCAIXE = doDesenho(13.6, 12.4), ASA_BAIXO = doDesenho(11, 20)
  const entre = (a, b, k) => [a[0] + (b[0] - a[0]) * k, a[1] + (b[1] - a[1]) * k]
  const AVIAO_12 = [PONTA, entre(PONTA, ASA_DIREITA, 0.25), entre(PONTA, ASA_DIREITA, 0.5), entre(PONTA, ASA_DIREITA, 0.75), ASA_DIREITA,
    entre(ASA_DIREITA, ENCAIXE, 0.5), ENCAIXE, entre(ENCAIXE, ASA_BAIXO, 0.5), ASA_BAIXO,
    entre(ASA_BAIXO, PONTA, 0.25), entre(ASA_BAIXO, PONTA, 0.5), entre(ASA_BAIXO, PONTA, 0.75)]
  const MEIO_DO_AVIAO = [11.8, 10.9], RAIO_DA_BOLINHA = 8.6
  const IRREGULAR = [1.24, 0.96, 1.08, 0.84, 1.26, 1, 0.9, 1.16, 0.92, 1.22, 0.86, 1.04]
  const DESVIO = [0, 0.18, -0.12, 0.22, -0.08, 0.25, -0.2, 0.1, -0.15, 0.2, -0.1, 0.15]
  const ANGULO_INICIAL = Math.atan2(-MEIO_DO_AVIAO[1], -MEIO_DO_AVIAO[0])
  const BOLINHA = IRREGULAR.map((k, i) => { const a = ANGULO_INICIAL + ((i + DESVIO[i]) / IRREGULAR.length) * Math.PI * 2; return [Math.cos(a) * RAIO_DA_BOLINHA * k, Math.sin(a) * RAIO_DA_BOLINHA * k] })
  const prenderAmassado = (t) => limitar(t, 0, 1)
  function suave(de, ate, t) { const k = limitar((t - de) / (ate - de), 0, 1); return k * k * (3 - 2 * k) }
  function pontosDoPapel(t) {
    const k = prenderAmassado(t), centro = [MEIO_DO_AVIAO[0] * (1 - k), MEIO_DO_AVIAO[1] * (1 - k)]
    return AVIAO_12.map((p, i) => [p[0] * (1 - k) + (centro[0] + BOLINHA[i][0]) * k, p[1] * (1 - k) + (centro[1] + BOLINHA[i][1]) * k])
  }
  const n2 = (v) => Math.round(v * 100) / 100
  const contornoDoPapel = (t) => pontosDoPapel(t).map(([x, y], i) => `${i ? 'L' : 'M'}${n2(x)} ${n2(y)}`).join('') + 'Z'
  const meioDoPapel = (t) => { const k = prenderAmassado(t); return [MEIO_DO_AVIAO[0] * (1 - k), MEIO_DO_AVIAO[1] * (1 - k)] }
  const NO_DE_CIMA = [-1.6, -1.2], NO_DE_BAIXO = [2.2, 2.6], VINCO_ENTRA = 0.72
  function tomPelaLuz(centro, alterna) {
    const luz = (-centro[0] - centro[1]) / (RAIO_DA_BOLINHA * 1.4)
    const base = luz > 0.05 ? 1 : luz > -0.3 ? 2 : luz > -0.6 ? 3 : 4
    return alterna ? (base === 4 ? 3 : base + 1) : base
  }
  const triangulo = (a, b, c) => `M${n2(a[0])} ${n2(a[1])}L${n2(b[0])} ${n2(b[1])}L${n2(c[0])} ${n2(c[1])}Z`
  const centroDe = (...p) => [p.reduce((s, q) => s + q[0], 0) / p.length, p.reduce((s, q) => s + q[1], 0) / p.length]
  const FACETAS = (() => {
    const total = BOLINHA.length, metade = total / 2, f = []
    for (let i = 0; i < total; i++) {
      const a = BOLINHA[i], b = BOLINHA[(i + 1) % total], no = i < metade ? NO_DE_CIMA : NO_DE_BAIXO
      const meio = entre(no, entre(a, b, 0.5), VINCO_ENTRA)
      f.push({ d: triangulo(no, a, meio), tom: tomPelaLuz(centroDe(no, a, meio), i % 2 === 1) })
      f.push({ d: triangulo(no, meio, b), tom: tomPelaLuz(centroDe(no, meio, b), i % 2 === 0) })
      f.push({ d: triangulo(a, b, meio), tom: tomPelaLuz(centroDe(a, b, meio), i % 3 === 0) })
    }
    f.push({ d: triangulo(NO_DE_CIMA, NO_DE_BAIXO, BOLINHA[0]), tom: 2 })
    f.push({ d: triangulo(NO_DE_CIMA, NO_DE_BAIXO, BOLINHA[metade]), tom: 3 })
    return f
  })()

  // Ímã (ima-do-cursor.ts): captura a 8 px, solta a 12 px; cede até 10% e 2 px; bolinha puxada 35% (até 8 px).
  const RAIO_DE_CAPTURA = 8, RAIO_DE_SOLTURA = 12
  const MAIOR_ALVO = { largura: 420, altura: 140 }
  const CEDE_ATE = { fracao: 0.1, x: 2, y: 2 }
  const PARALLAX_DO_ELEMENTO = 1, PUXAO_DA_BOLINHA = 0.35, PUXAO_MAXIMO = 8
  const FOLGA = { botao: [4, 4], texto: [6, 3] }
  function puxaoDaBolinha(dx, dy, distanciaAteABorda) {
    const forca = PUXAO_DA_BOLINHA * Math.max(0, 1 - distanciaAteABorda / RAIO_DE_SOLTURA)
    const x = dx * forca, y = dy * forca, tamanho = Math.hypot(x, y), corte = tamanho > PUXAO_MAXIMO ? PUXAO_MAXIMO / tamanho : 1
    return { x: x * corte, y: y * corte }
  }
  function distanciaAteCaixa(px, py, c) { const dx = Math.max(c.x - px, 0, px - (c.x + c.w)), dy = Math.max(c.y - py, 0, py - (c.y + c.h)); return Math.hypot(dx, dy) }
  const temTamanhoDeAlvo = (c) => c.w <= MAIOR_ALVO.largura && c.h <= MAIOR_ALVO.altura
  function deslocamentoDoIma(dx, dy, c) {
    const lx = Math.min(c.w * CEDE_ATE.fracao, CEDE_ATE.x), ly = Math.min(c.h * CEDE_ATE.fracao, CEDE_ATE.y)
    return { x: lx * Math.tanh(dx / Math.max(1, c.w / 2)), y: ly * Math.tanh(dy / Math.max(1, c.h / 2)) }
  }
  const MOLAS = { forma: [560, 0.86], cede: [620, 0.82], encaixa: [640, 0.8], solta: [300, 0.5], amassa: [620, 0.6], desamassa: [360, 0.78], aparece: [700, 1] }
  const PASSO_DA_MOLA = 1 / 240
  const criarMola = (v, [k, z]) => ({ v, vel: 0, alvo: v, k, c: 2 * z * Math.sqrt(k) })
  function ajustarMola(m, [k, z]) { m.k = k; m.c = 2 * z * Math.sqrt(k) }
  function avancarMola(m, dt, reduzido) {
    if (reduzido) { m.v = m.alvo; m.vel = 0; return }
    for (let resta = dt; resta > 1e-6; resta -= PASSO_DA_MOLA) {
      const h = Math.min(PASSO_DA_MOLA, resta)
      m.vel += (-m.k * (m.v - m.alvo) - m.c * m.vel) * h
      m.v += m.vel * h
    }
  }
  const molaParada = (m, precisao = 0.002) => Math.abs(m.v - m.alvo) < precisao && Math.abs(m.vel) < precisao * 10
  function pousarMola(m, v) { m.v = v; m.alvo = v; m.vel = 0 }

  /** Rastro de voo: dois fios das pontas das asas, só acima de 650 px/s, que somem em 0,2 s (rastro-de-voo.ts). */
  function criarRastroDeVoo(tela) {
    const pincel = tela.getContext('2d')
    let fios = [[], []], rgb = '26,26,26', alfa = 0.64, sujo = null
    const r = {
      medir() {
        const d = Math.min(2, devicePixelRatio || 1)
        tela.width = Math.round(innerWidth * d); tela.height = Math.round(innerHeight * d)
        if (pincel) pincel.setTransform(d, 0, 0, d, 0, 0)
        const cor = getComputedStyle(tela).getPropertyValue('--cursor-rastro').trim()
        const m = /rgba?\(([^)]+)\)/.exec(cor), partes = m ? m[1].split(',').map((x) => x.trim()) : null
        if (partes && partes.length >= 3) { rgb = partes.slice(0, 3).join(','); alfa = partes[3] != null ? Number(partes[3]) : 1 }
        sujo = null
      },
      get temFio() { return fios[0].length > 0 || fios[1].length > 0 },
      limpar() { fios = [[], []]; if (pincel) pincel.clearRect(0, 0, innerWidth, innerHeight); sujo = null },
      desenhar(agora, x, y, inclinacao, escala, forca) {
        if (!pincel) return
        if (forca > 0.03) pontasDasAsas(inclinacao, escala).forEach(([dx, dy], i) => fios[i].push({ x: x + dx, y: y + dy, t: agora, forca }))
        for (const fio of fios) while (fio.length && agora - fio[0].t > RASTRO.vida) fio.shift()
        if (sujo) { pincel.clearRect(sujo.x0, sujo.y0, sujo.x1 - sujo.x0, sujo.y1 - sujo.y0); sujo = null }
        if (!r.temFio) return
        pincel.lineCap = 'round'; pincel.lineJoin = 'round'
        for (const fio of fios) {
          if (fio.length < 2) continue
          const cauda = fio[0], ponta = fio[fio.length - 1]
          const forcaDaPonta = Math.min(1, ponta.forca * (1 - (agora - ponta.t) / RASTRO.vida))
          if (forcaDaPonta <= 0.01) continue
          const caminho = new Path2D()
          caminho.moveTo(cauda.x, cauda.y)
          for (let i = 1; i < fio.length - 1; i++) { const b = fio[i], c = fio[i + 1]; caminho.quadraticCurveTo(b.x, b.y, (b.x + c.x) / 2, (b.y + c.y) / 2) }
          caminho.lineTo(ponta.x, ponta.y)
          const degrade = (a) => { const g = pincel.createLinearGradient(cauda.x, cauda.y, ponta.x, ponta.y); g.addColorStop(0, `rgba(${rgb},0)`); g.addColorStop(1, `rgba(${rgb},${(a * forcaDaPonta).toFixed(3)})`); return g }
          pincel.strokeStyle = degrade(alfa * RASTRO.alfaDoHalo); pincel.lineWidth = RASTRO.tracoDoHalo; pincel.stroke(caminho)
          pincel.strokeStyle = degrade(alfa); pincel.lineWidth = RASTRO.tracoDoMiolo; pincel.stroke(caminho)
          let x0 = Infinity, y0 = Infinity, x1 = -Infinity, y1 = -Infinity
          if (sujo) ({ x0, y0, x1, y1 } = sujo)
          for (const p of fio) { x0 = Math.min(x0, p.x); y0 = Math.min(y0, p.y); x1 = Math.max(x1, p.x); y1 = Math.max(y1, p.y) }
          sujo = { x0: x0 - 8, y0: y0 - 8, x1: x1 + 8, y1: y1 + 8 }
        }
      },
    }
    r.medir()
    return r
  }

  const QUADRO = 64, ORIGEM = 16, GIRO_AO_AMASSAR = -55, SQUASH_POR_VELOCIDADE = 0.012, SQUASH_MAXIMO = 0.12
  const APERTO = { largura: 0.06, altura: 0.1, realce: 0.035 }
  const SONDAS = [[1, 0], [-1, 0], [0, 1], [0, -1], [0.7, 0.7], [-0.7, 0.7], [0.7, -0.7], [-0.7, -0.7]]
  const SEGUE_A_VELOCIDADE = 0.45, QUEDA_DA_VELOCIDADE = 0.8

  /**
   * Cursor de avião (CursorDeAviao.tsx): o avião de papel do Origami no lugar da seta, só com mouse e dentro de `raiz`.
   * Sobre o que é clicável amassa numa bolinha de papel low-poly (−55°, mola amassa ~220 ms) e encaixa com o ímã
   * (realce na forma do elemento, que cede até 2 px); no movimento rápido deixa o rastro de voo. Devolve destruir().
   */
  function cursorBolinha(opcoes = {}) {
    const raiz = opcoes.raiz || document.body
    const comMouse = matchMedia('(pointer: fine) and (hover: hover)')
    const doSistema = matchMedia('(forced-colors: active), (prefers-contrast: more)')
    const reduzido = matchMedia('(prefers-reduced-motion: reduce)')
    const camada = document.createElement('div')
    camada.className = 'pp-micro pp-cursor-camada'
    const tema = escopo(raiz).getAttribute && escopo(raiz).getAttribute('data-theme')
    if (tema) camada.setAttribute('data-theme', tema)
    camada.innerHTML = '<div class="pp-cursor-realce" aria-hidden="true"></div><canvas class="pp-cursor-rastro" aria-hidden="true"></canvas>' +
      `<div class="pp-cursor-aviao" aria-hidden="true"><svg viewBox="${-ORIGEM} ${-ORIGEM} ${QUADRO} ${QUADRO}" width="${QUADRO}" height="${QUADRO}">` +
      '<defs><radialGradient id="pp-cursor-papel-luz" cx="35%" cy="28%" r="80%"><stop offset="0" class="pp-cursor-papel-luz"/><stop offset=".6" class="pp-cursor-papel-meio"/><stop offset="1" class="pp-cursor-papel-sombra"/></radialGradient>' +
      `<clipPath id="pp-cursor-papel-recorte"><path data-p="recorte" d="${contornoDoPapel(0)}"/></clipPath></defs>` +
      `<g data-p="giro"><g data-p="squash"><path data-p="corpo" class="pp-cursor-aviao-corpo" d="${contornoDoPapel(0)}"/>` +
      '<g clip-path="url(#pp-cursor-papel-recorte)">' +
      `<g data-p="dobras" transform="scale(1.25) translate(-2.6 -2.6)"><path class="pp-cursor-aviao-dobra" d="${DESENHO_DO_AVIAO.dobra}"/><path class="pp-cursor-aviao-sombra" d="${DESENHO_DO_AVIAO.sombra}"/></g>` +
      `<g data-p="amassados" style="opacity:0">${FACETAS.map((f) => `<path class="pp-bolinha-faceta tom-${f.tom}" d="${f.d}"/>`).join('')}</g>` +
      `</g><path data-p="borda" class="pp-cursor-aviao-borda" d="${contornoDoPapel(0)}"/></g></g></svg></div>`
    document.body.append(camada)
    const el = camada.querySelector('.pp-cursor-aviao'), tela = camada.querySelector('.pp-cursor-rastro'), caixaDoRealce = camada.querySelector('.pp-cursor-realce')
    const q = (n) => camada.querySelector(`[data-p="${n}"]`)
    const caminho = q('corpo'), caminhoDoRecorte = q('recorte'), caminhoDaBorda = q('borda'), grupoDoGiro = q('giro'), grupoDoSquash = q('squash'), dobras = q('dobras'), amassados = q('amassados')
    const fios = criarRastroDeVoo(tela)
    let x = 0, y = 0, ultimoX = null, inclinacao = 0, inclinacaoAlvo = 0
    let pressionado = false, visivel = false, quadro = 0, ultimoQuadro = 0, vx = 0, vy = 0, ultimoMovimento = 0
    let clicavelSob = null, podeCapturar = false, sondar = false, encaixe = null
    let elementoQueCede = null, cedido = { x: 0, y: 0 }, realceVisivel = false, ultimoAmassado = -1
    const amassa = criarMola(0, MOLAS.amassa), escala = criarMola(1, MOLAS.encaixa), aperto = criarMola(0, MOLAS.aparece)
    const bolaX = criarMola(0, MOLAS.encaixa), bolaY = criarMola(0, MOLAS.encaixa)
    const cedeX = criarMola(0, MOLAS.cede), cedeY = criarMola(0, MOLAS.cede)
    const rx = criarMola(0, MOLAS.forma), ry = criarMola(0, MOLAS.forma), rw = criarMola(0, MOLAS.forma), rh = criarMola(0, MOLAS.forma), rr = criarMola(0, MOLAS.forma)
    const opacidadeDoRealce = criarMola(0, MOLAS.aparece)
    const molas = [amassa, escala, aperto, bolaX, bolaY, cedeX, cedeY, rx, ry, rw, rh, rr, opacidadeDoRealce]
    let escondido = null, ultimoAlvo = null
    const ligado = () => !!opcoes.sempre || (comMouse.matches && !doSistema.matches)
    const devolverCursor = () => { if (escondido) { escondido.el.style.cursor = escondido.antes; escondido = null } }
    const mostrar = (sim) => { if (sim !== visivel) { visivel = sim; el.classList.toggle('on', sim) } }
    const caixaDe = (alvo) => { const r = alvo.getBoundingClientRect(), d = alvo === elementoQueCede ? cedido : { x: 0, y: 0 }; return { x: r.left - d.x, y: r.top - d.y, w: r.width, h: r.height } }
    const ehItemDeLista = (alvo) => !!alvo.closest('[role="listbox"],[role="menu"],[role="option"],[role="menuitem"],[role="menuitemradio"],[role="menuitemcheckbox"],[role="tablist"]')
    const podeCeder = (alvo) => !ehItemDeLista(alvo) && (alvo.matches('.pp-btn') || getComputedStyle(alvo).translate === 'none')
    const soltarElemento = () => {
      if (!elementoQueCede) return
      elementoQueCede.classList.remove('pp-cursor-ima')
      elementoQueCede.style.removeProperty('--cursor-ima-x'); elementoQueCede.style.removeProperty('--cursor-ima-y')
      elementoQueCede = null; cedido = { x: 0, y: 0 }
    }
    const clicavelDe = (alvo) => {
      const c = alvo.closest(SELETOR_CLICAVEL) || (getComputedStyle(alvo).cursor === 'pointer' ? alvo : null)
      if (!(c instanceof HTMLElement) || !raiz.contains(c)) return null
      const cartao = c.closest('[data-realce-cartao]')
      return cartao instanceof HTMLElement ? cartao : c
    }
    const decisaoSobre = (alvo) => !raiz.contains(alvo) ? 'nativo' : decidirCursor(getComputedStyle(alvo).cursor, !!alvo.closest(SELETOR_DE_CAMPO), !!alvo.closest(SELETOR_CLICAVEL), !!alvo.closest(SELETOR_DE_ZONA_NATIVA))
    const procurarCaptura = () => {
      if (encaixe && encaixe.capturado && encaixe.el.isConnected && distanciaAteCaixa(x, y, caixaDe(encaixe.el)) <= RAIO_DE_SOLTURA) return encaixe
      if (!sondar && !(encaixe && encaixe.capturado)) return null
      sondar = false
      let melhor = null
      for (const [sx, sy] of SONDAS) {
        const achado = document.elementFromPoint(x + sx * RAIO_DE_CAPTURA, y + sy * RAIO_DE_CAPTURA)
        const candidato = achado && clicavelDe(achado)
        if (!candidato || candidato.disabled || decisaoSobre(candidato) === 'nativo') continue
        const caixa = caixaDe(candidato), distancia = distanciaAteCaixa(x, y, caixa)
        if (distancia <= RAIO_DE_CAPTURA && temTamanhoDeAlvo(caixa) && (!melhor || distancia < melhor.distancia)) melhor = { el: candidato, distancia }
      }
      return melhor ? { el: melhor.el, capturado: true } : null
    }
    const estaNaTela = (alvo) => { if (!alvo.isConnected) return false; const r = alvo.getBoundingClientRect(); return r.width > 0 && r.height > 0 }
    const resolverEncaixe = () => {
      if (!visivel) { encaixe = null; return }
      if (clicavelSob && !estaNaTela(clicavelSob)) clicavelSob = null
      if (encaixe && !estaNaTela(encaixe.el)) encaixe = null
      if (clicavelSob) { encaixe = temTamanhoDeAlvo(caixaDe(clicavelSob)) ? { el: clicavelSob, capturado: false } : null; return }
      encaixe = podeCapturar ? procurarCaptura() : null
    }
    const definirAlvos = () => {
      const amassado = !!encaixe || !!clicavelSob
      ajustarMola(amassa, amassado ? MOLAS.amassa : MOLAS.desamassa)
      amassa.alvo = amassado ? 1 : 0
      escala.alvo = pressionado && !amassado ? ESCALA.pressionado : 1
      aperto.alvo = pressionado && amassado ? 1 : 0
      if (encaixe) {
        const caixa = caixaDe(encaixe.el), cx = caixa.x + caixa.w / 2, cy = caixa.y + caixa.h / 2
        const cede = ehItemDeLista(encaixe.el) ? { x: 0, y: 0 } : deslocamentoDoIma(x - cx, y - cy, caixa)
        for (const m of [cedeX, cedeY]) ajustarMola(m, MOLAS.cede)
        cedeX.alvo = cede.x; cedeY.alvo = cede.y
        const [folgaX, folgaY] = encaixe.el.matches('a, [role="link"]') && caixa.h < 28 ? FOLGA.texto : FOLGA.botao
        const raio = Math.min(parseFloat(getComputedStyle(encaixe.el).borderTopLeftRadius) || 0, caixa.h / 2)
        if (!realceVisivel) { pousarMola(rx, x - 8); pousarMola(ry, y - 8); pousarMola(rw, 16); pousarMola(rh, 16); pousarMola(rr, 8); realceVisivel = true }
        for (const m of [rx, ry, rw, rh, rr]) ajustarMola(m, MOLAS.forma)
        rx.alvo = caixa.x - folgaX + cedeX.v; ry.alvo = caixa.y - folgaY + cedeY.v
        rw.alvo = caixa.w + folgaX * 2; rh.alvo = caixa.h + folgaY * 2; rr.alvo = Math.min(raio + folgaY, (caixa.h + folgaY * 2) / 2)
        opacidadeDoRealce.alvo = 1
        for (const m of [bolaX, bolaY]) ajustarMola(m, MOLAS.encaixa)
        const puxao = puxaoDaBolinha(cx + cede.x - x, cy + cede.y - y, distanciaAteCaixa(x, y, caixa))
        bolaX.alvo = puxao.x; bolaY.alvo = puxao.y
        if (encaixe.el !== elementoQueCede) { soltarElemento(); if (podeCeder(encaixe.el)) { elementoQueCede = encaixe.el; elementoQueCede.classList.add('pp-cursor-ima') } }
      } else {
        for (const m of [bolaX, bolaY, cedeX, cedeY]) ajustarMola(m, MOLAS.solta)
        bolaX.alvo = 0; bolaY.alvo = 0; cedeX.alvo = 0; cedeY.alvo = 0
        rx.alvo = x - 8; ry.alvo = y - 8; rw.alvo = 16; rh.alvo = 16; rr.alvo = 8
        opacidadeDoRealce.alvo = 0
      }
    }
    const pintar = () => {
      const t = amassa.v
      el.style.transform = `translate3d(${(x + bolaX.v - ORIGEM).toFixed(2)}px,${(y + bolaY.v - ORIGEM).toFixed(2)}px,0)`
      const s = escala.v * (1 + Math.max(0, t - 1) * 0.6)
      grupoDoGiro.setAttribute('transform', `rotate(${(inclinacao * (1 - Math.min(1, t)) + GIRO_AO_AMASSAR * limitar(t, 0, 1)).toFixed(2)}) scale(${s.toFixed(4)})`)
      const [mx, my] = meioDoPapel(t)
      const estica = limitar(amassa.vel * SQUASH_POR_VELOCIDADE, -SQUASH_MAXIMO, SQUASH_MAXIMO) * limitar(t, 0, 1)
      const sx = 1 + estica + APERTO.largura * aperto.v, sy = 1 - estica - APERTO.altura * aperto.v
      grupoDoSquash.setAttribute('transform', `translate(${mx.toFixed(2)} ${my.toFixed(2)}) scale(${sx.toFixed(4)} ${sy.toFixed(4)}) translate(${(-mx).toFixed(2)} ${(-my).toFixed(2)})`)
      if (Math.abs(t - ultimoAmassado) > 0.002) {
        ultimoAmassado = t
        const d = contornoDoPapel(t)
        for (const c of [caminho, caminhoDoRecorte, caminhoDaBorda]) c.setAttribute('d', d)
        caminhoDaBorda.style.strokeOpacity = (1 - 0.25 * suave(0, 1, t)).toFixed(3)
        dobras.style.opacity = (1 - suave(0, 0.35, t)).toFixed(3)
        amassados.style.opacity = suave(0.55, 1, t).toFixed(3)
        amassados.setAttribute('transform', `translate(${mx.toFixed(2)} ${my.toFixed(2)})`)
      }
      const opacidade = limitar(opacidadeDoRealce.v, 0, 1)
      if (opacidade < 0.02 && opacidadeDoRealce.alvo === 0) realceVisivel = false
      caixaDoRealce.style.opacity = opacidade.toFixed(3)
      if (opacidade > 0.001) {
        caixaDoRealce.style.transform = `translate3d(${rx.v.toFixed(2)}px,${ry.v.toFixed(2)}px,0) scale(${(1 - APERTO.realce * aperto.v).toFixed(4)})`
        caixaDoRealce.style.width = Math.max(0, rw.v).toFixed(2) + 'px'
        caixaDoRealce.style.height = Math.max(0, rh.v).toFixed(2) + 'px'
        caixaDoRealce.style.borderRadius = Math.max(0, rr.v).toFixed(2) + 'px'
      }
      if (elementoQueCede) {
        cedido = { x: cedeX.v * PARALLAX_DO_ELEMENTO, y: cedeY.v * PARALLAX_DO_ELEMENTO }
        elementoQueCede.style.setProperty('--cursor-ima-x', cedido.x.toFixed(2) + 'px')
        elementoQueCede.style.setProperty('--cursor-ima-y', cedido.y.toFixed(2) + 'px')
        if (!encaixe && molaParada(cedeX) && molaParada(cedeY)) soltarElemento()
      }
    }
    const desenhar = (agora) => {
      const dt = Math.min(1 / 30, Math.max(0, (agora - (ultimoQuadro || agora)) / 1000))
      ultimoQuadro = agora
      if (agora - ultimoMovimento > 48) { vx *= QUEDA_DA_VELOCIDADE; vy *= QUEDA_DA_VELOCIDADE }
      inclinacao += (inclinacaoAlvo - inclinacao) * SUAVIDADE_DA_INCLINACAO
      inclinacaoAlvo *= RETORNO_DA_INCLINACAO
      resolverEncaixe(); definirAlvos()
      for (const m of molas) avancarMola(m, dt, reduzido.matches)
      pintar()
      const forca = visivel && amassa.v < 0.05 ? forcaDoRastro(Math.hypot(vx, vy), reduzido.matches) : 0
      fios.desenhar(agora, x, y, inclinacao, escala.v, forca)
      const emVoo = Math.hypot(vx, vy) > RASTRO.inicio
      const assentou = molas.every((m) => molaParada(m)) && Math.abs(inclinacao) < 0.05
      quadro = !assentou || fios.temFio || emVoo || (encaixe && encaixe.capturado) ? requestAnimationFrame(desenhar) : 0
      if (!quadro) ultimoQuadro = 0
    }
    const pedirQuadro = () => { if (!quadro) quadro = requestAnimationFrame(desenhar) }
    const avaliar = (alvo) => {
      devolverCursor()
      clicavelSob = null; podeCapturar = false
      if (!(alvo instanceof HTMLElement || alvo instanceof SVGElement)) { mostrar(false); return }
      const decisao = decisaoSobre(alvo)
      if (decisao === 'nativo') { mostrar(false); return }
      escondido = { el: alvo, antes: alvo.style.cursor }
      alvo.style.cursor = 'none'
      if (decisao === 'aviao-clicavel') clicavelSob = clicavelDe(alvo)
      else podeCapturar = true
      mostrar(true)
      pedirQuadro()
    }
    const mover = (e) => {
      if (e.simulado && !opcoes.sempre) return
      if (e.pointerType !== 'mouse' || !ligado()) { devolverCursor(); mostrar(false); return }
      if (ultimoX !== null) {
        inclinacaoAlvo = inclinacaoPelaVelocidade(e.clientX - ultimoX, reduzido.matches)
        const dt = Math.max(4, e.timeStamp - ultimoMovimento)
        vx += ((e.clientX - x) / dt * 1000 - vx) * SEGUE_A_VELOCIDADE
        vy += ((e.clientY - y) / dt * 1000 - vy) * SEGUE_A_VELOCIDADE
      }
      ultimoMovimento = e.timeStamp; ultimoX = e.clientX
      x = e.clientX; y = e.clientY
      sondar = true
      if (e.target !== ultimoAlvo) { ultimoAlvo = e.target; avaliar(e.target) }
      pedirQuadro()
    }
    const apertar = (e) => { if ((e.simulado && !opcoes.sempre) || e.pointerType !== 'mouse') return; pressionado = true; avaliar(e.target) }
    const soltar = (e) => { if ((e.simulado && !opcoes.sempre) || e.pointerType !== 'mouse') return; pressionado = false; avaliar(e.target) }
    const esconder = () => { devolverCursor(); mostrar(false); ultimoAlvo = null; ultimoX = null; vx = 0; vy = 0; clicavelSob = null; encaixe = null; fios.limpar(); pedirQuadro() }
    const sairDaJanela = (e) => { if (!e.relatedTarget) esconder() }
    const aoRolar = () => { if (visivel) { sondar = true; pedirQuadro() } }
    const aoRedimensionar = () => fios.medir()
    addEventListener('pointermove', mover, { passive: true })
    addEventListener('pointerdown', apertar, { passive: true })
    addEventListener('pointerup', soltar, { passive: true })
    document.addEventListener('pointerout', sairDaJanela)
    addEventListener('scroll', aoRolar, { passive: true, capture: true })
    addEventListener('blur', esconder)
    addEventListener('resize', aoRedimensionar)
    comMouse.addEventListener('change', esconder)
    doSistema.addEventListener('change', esconder)
    return {
      /** Para o tema da camada do cursor acompanhar uma troca de tema da página. */
      tema(valor) { if (valor) camada.setAttribute('data-theme', valor); else camada.removeAttribute('data-theme'); fios.medir() },
      destruir() {
        removeEventListener('pointermove', mover); removeEventListener('pointerdown', apertar); removeEventListener('pointerup', soltar)
        document.removeEventListener('pointerout', sairDaJanela); removeEventListener('scroll', aoRolar, { capture: true })
        removeEventListener('blur', esconder); removeEventListener('resize', aoRedimensionar)
        comMouse.removeEventListener('change', esconder); doSistema.removeEventListener('change', esconder)
        cancelAnimationFrame(quadro); devolverCursor(); soltarElemento(); camada.remove()
      },
    }
  }

  /**
   * Ímã sem o cursor de avião (adaptado: no produto o ímã só existe junto com o cursor). Mesmas regras de
   * ima-do-cursor.ts: perto de `el` (captura a 8 px, solta a 12 px) um realce tingido toma a forma dele (folga 4 px,
   * mesmo raio) e os dois cedem na direção do ponteiro, no máximo 10% do tamanho e 2 px, com as molas `forma`, `cede`
   * e `solta`. O clique continua onde o ponteiro está. Devolve destruir().
   */
  function ima(el) {
    const reduzido = matchMedia('(prefers-reduced-motion: reduce)')
    const realce = document.createElement('div')
    realce.className = 'pp-cursor-realce'; realce.setAttribute('aria-hidden', 'true')
    escopo(el).append(realce)
    const cedeX = criarMola(0, MOLAS.cede), cedeY = criarMola(0, MOLAS.cede)
    const rx = criarMola(0, MOLAS.forma), ry = criarMola(0, MOLAS.forma), rw = criarMola(0, MOLAS.forma), rh = criarMola(0, MOLAS.forma), rr = criarMola(0, MOLAS.forma)
    const opacidade = criarMola(0, MOLAS.aparece)
    const molas = [cedeX, cedeY, rx, ry, rw, rh, rr, opacidade]
    let x = 0, y = 0, encaixado = false, visivelAntes = false, quadro = 0, ultimo = 0
    const caixa = () => { const r = el.getBoundingClientRect(); return { x: r.left - cedeX.v, y: r.top - cedeY.v, w: r.width, h: r.height } }
    const passo = (agora) => {
      const dt = Math.min(1 / 30, Math.max(0, (agora - (ultimo || agora)) / 1000)); ultimo = agora
      const c = caixa(), dist = distanciaAteCaixa(x, y, c)
      encaixado = temTamanhoDeAlvo(c) && dist <= (encaixado ? RAIO_DE_SOLTURA : RAIO_DE_CAPTURA)
      if (encaixado) {
        const cede = deslocamentoDoIma(x - (c.x + c.w / 2), y - (c.y + c.h / 2), c)
        for (const m of [cedeX, cedeY]) ajustarMola(m, MOLAS.cede)
        cedeX.alvo = cede.x; cedeY.alvo = cede.y
        const raio = Math.min(parseFloat(getComputedStyle(el).borderTopLeftRadius) || 0, c.h / 2)
        if (!visivelAntes) { pousarMola(rx, x - 8); pousarMola(ry, y - 8); pousarMola(rw, 16); pousarMola(rh, 16); pousarMola(rr, 8); visivelAntes = true }
        rx.alvo = c.x - FOLGA.botao[0] + cedeX.v; ry.alvo = c.y - FOLGA.botao[1] + cedeY.v
        rw.alvo = c.w + FOLGA.botao[0] * 2; rh.alvo = c.h + FOLGA.botao[1] * 2; rr.alvo = Math.min(raio + FOLGA.botao[1], (c.h + FOLGA.botao[1] * 2) / 2)
        opacidade.alvo = 1
      } else {
        for (const m of [cedeX, cedeY]) ajustarMola(m, MOLAS.solta)
        cedeX.alvo = 0; cedeY.alvo = 0
        rx.alvo = x - 8; ry.alvo = y - 8; rw.alvo = 16; rh.alvo = 16; rr.alvo = 8
        opacidade.alvo = 0
      }
      for (const m of molas) avancarMola(m, dt, reduzido.matches)
      el.classList.add('pp-cursor-ima')
      el.style.setProperty('--cursor-ima-x', cedeX.v.toFixed(2) + 'px'); el.style.setProperty('--cursor-ima-y', cedeY.v.toFixed(2) + 'px')
      const a = limitar(opacidade.v, 0, 1)
      if (a < 0.02 && !encaixado) visivelAntes = false
      realce.style.opacity = a.toFixed(3)
      realce.style.transform = `translate3d(${rx.v.toFixed(2)}px,${ry.v.toFixed(2)}px,0)`
      realce.style.width = Math.max(0, rw.v).toFixed(2) + 'px'; realce.style.height = Math.max(0, rh.v).toFixed(2) + 'px'
      realce.style.borderRadius = Math.max(0, rr.v).toFixed(2) + 'px'
      const parado = molas.every((m) => molaParada(m))
      if (parado && !encaixado) { el.classList.remove('pp-cursor-ima'); el.style.removeProperty('--cursor-ima-x'); el.style.removeProperty('--cursor-ima-y') }
      quadro = parado ? 0 : requestAnimationFrame(passo)
      if (!quadro) ultimo = 0
    }
    const mover = (e) => { if (e.pointerType !== 'mouse' && !e.simulado) return; x = e.clientX; y = e.clientY; if (!quadro) quadro = requestAnimationFrame(passo) }
    addEventListener('pointermove', mover, { passive: true })
    return { destruir() { removeEventListener('pointermove', mover); cancelAnimationFrame(quadro); realce.remove(); el.classList.remove('pp-cursor-ima'); el.style.removeProperty('--cursor-ima-x'); el.style.removeProperty('--cursor-ima-y') } }
  }

  /* ===================================================================================== */

  /** Limpa o que o módulo criou fora dos elementos de quem usa (o canvas por cima da página). */
  function limpar() { if (campoAtual) { campoAtual.destruir(); campoAtual = null; removeEventListener('resize', aoRedimensionarCampo) } }

  global.PPMicro = {
    creditos: { gerar, devolver, semSaldo, comprar, definirSaldo, PARTICULAS_POR_GERACAO, PONTOS_DO_CONTORNO, PARTICULAS_SEM_SALDO },
    botao: { gerando: botaoGerando },
    pecas: { botaoDeCredito: botaoDeCreditoHtml, saldo: saldoHtml, anel: anelHtml, tsuru: tsuruSvg, origamiLoading: origamiLoadingHtml },
    pouso, entrarQuieto, sairQuieto, afundarNoClique, afundar, assentar, balancar, pulsar, rolarNumero, entrarEmFoco,
    origamiPensando, respostaEmFoco, tsuruHover, origamiLoading,
    cursorBolinha, ima,
    criarCampo, preferePoucoMovimento, limpar,
  }
})(typeof window !== 'undefined' ? window : globalThis)
