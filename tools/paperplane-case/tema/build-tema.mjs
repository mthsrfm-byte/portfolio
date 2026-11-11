// Modo "tema": gera o case Paperplane dentro do tema WordPress do portfólio (sera-v1), em arquivos (nada em base64).
//   node build.mjs tema [destino-do-tema]
// Saídas (destino padrão /workspace/portfolio/sera-v1):
//   assets/cases/paperplane/  pp-case.css, pp-case.js, micro.css, micro.js, aviao.js, lib/*.min.js (GSAP local),
//                             sim/ (app.css, extra.css, rt.js, pecas.html, screens/*.html, media/, video/),
//                             site/ (home.html, home-celular.html, media/), pg/ (ficha, céu, quadro do take), manifest.json
//   template-parts/cases/paperplane.php      o <article> do case, com sera_t('EN','PT') em todo texto visível
//   inc/paperplane-data.php                  telas, mídias e textos do JS (lidos pelo enqueue)
import { readFile, writeFile, mkdir, copyFile, stat, readdir, rm } from 'node:fs/promises'
import path from 'node:path'
import { quebrar, atributosDe } from './unidades.mjs'

export async function construirTema({ S, here, microJs, SIM, SITE, TELAS, PECAS, destino }) {
  const TEMA = destino || '/workspace/portfolio/sera-v1'
  const D = path.join(TEMA, 'assets/cases/paperplane')
  const src = path.join(here, 'src')
  const ler = (p) => readFile(p, 'utf8')
  const existe = async (p) => { try { await stat(p); return true } catch { return false } }
  const pesos = []
  const escrever = async (rel, conteudo) => { const f = path.join(D, rel); await mkdir(path.dirname(f), { recursive: true }); await writeFile(f, conteudo); pesos.push([rel, Buffer.byteLength(conteudo)]) }
  const copiar = async (de, rel) => { const f = path.join(D, rel); await mkdir(path.dirname(f), { recursive: true }); await copyFile(de, f); pesos.push([rel, (await stat(de)).size]) }

  await rm(D, { recursive: true, force: true })
  await mkdir(D, { recursive: true })

  /* ---------------- classes do case que colidem com o CSS/JS do tema: ganham o prefixo pp- ---------------- */
  const RENOMEAR = ['art-label', 'back-link', 'browser', 'browser-bar', 'cap', 'cap-note', 'case-hero', 'case-meta', 'chip', 'chips', 'col', 'cta', 'cta-lime', 'cta-line', 'cta-in', 'cta-note', 'ctas', 'dots', 'glance', 'glance-block', 'glance-did', 'hero-title', 'hero-in', 'hero-shot', 'hero-shot-wrap', 'kicker', 'lead', 'lede', 'metric', 'metrics', 'note', 'prog', 'reveal', 'reveal-card', 'stars', 'stat', 'stats', 'url', 'chapter', 'chapter-title', 'wide', 'zone', 'thesis', 'thesis-line', 'closing', 'odo', 'deck', 'compare', 'plan', 'clipes', 'onda', 'notif', 'mesa', 'leque', 'cel', 'night', 'clock', 'days', 'licoes', 'regra']
  const reNome = new RegExp('\\.(' + RENOMEAR.map((n) => n.replace(/-/g, '\\-')).join('|') + ')(?![\\w-])', 'g')
  const renomearCss = (css) => css.replace(reNome, '.pp-$1')
  const renomearClasses = (valor) => valor.split(/\s+/).map((c) => (RENOMEAR.includes(c) ? 'pp-' + c : c)).join(' ')
  const renomearHtml = (html) => html.replace(/\sclass="([^"]*)"/g, (_m, v) => ' class="' + renomearClasses(v) + '"')
  // No JS, só dentro de literais de texto (seletores e nomes de classe).
  const renomearJs = (js) => js.replace(/'(?:[^'\\\n]|\\.)*'|`(?:[^`\\]|\\.)*`/g, (lit) => {
    return lit.replace(reNome, '.pp-$1')
  }).replace(/(className\s*=\s*|classList\.(?:add|remove|toggle|contains)\()'([\w-]+)'/g, (m, pre, n) => (RENOMEAR.includes(n) ? pre + "'pp-" + n + "'" : m))

  /* ---------------- CSS: escopo .pp-case ---------------- */
  const FORA = /site-header|site-footer|\.hwrap|\.brand|primary-nav|\.hbtn|\.btn-dark|\.btn(?![\w-])|\.fwrap|\.eyebrow|footer-|\.flinks|\.skip\b|\.read-progress|\.toc\b/
  function escoparSeletor(sel) {
    sel = sel.trim()
    if (!sel) return sel
    if (/^(:root|html|body)$/.test(sel)) return '.pp-case'
    if (/^\*/.test(sel)) return '.pp-case ' + sel
    if (/^::selection/.test(sel)) return '.pp-case ' + sel + ',.pp-case' + sel
    if (/^:focus-visible/.test(sel)) return '.pp-case ' + sel
    // Prefixo de nível da página (html, html.js, html:not(.js), .js, .js.boot) fica fora; o resto entra no case.
    const m = /^((?:html|:root)?(?:\.js|\.boot|:not\(\.js\)|\[data-theme="[a-z]+"\])*)(?=\s|$)(.*)$/.exec(sel)
    if (m && m[1]) {
      const resto = m[2].trim()
      if (!resto) return m[1] + ' .pp-case'
      if (/^body\b/.test(resto)) return m[1] + ' .pp-case' + resto.slice(4)
      return m[1] + ' .pp-case ' + resto
    }
    return '.pp-case ' + sel
  }
  function escoparCss(css) {
    let out = '', i = 0
    css = css.replace(/\/\*[\s\S]*?\*\//g, '')
    while (i < css.length) {
      const ab = css.indexOf('{', i)
      if (ab < 0) break
      const cab = css.slice(i, ab).trim()
      // acha o fecho do bloco (com aninhamento)
      let prof = 1, j = ab + 1
      while (j < css.length && prof) { if (css[j] === '{') prof++; else if (css[j] === '}') prof--; j++ }
      const corpo = css.slice(ab + 1, j - 1)
      if (cab.startsWith('@font-face')) { /* fontes: as do tema */ }
      else if (/^@(media|supports)/.test(cab)) out += cab + '{' + escoparCss(corpo) + '}\n'
      else if (cab.startsWith('@')) out += cab + '{' + corpo + '}\n'
      else {
        const sels = cab.split(/,(?![^(]*\))/).map((s) => s.trim()).filter(Boolean)
        const dentro = sels.filter((s) => !FORA.test(s))
        if (dentro.length) out += dentro.map(escoparSeletor).join(',') + '{' + corpo + '}\n'
      }
      i = j
    }
    return out
  }
  let css = await ler(path.join(src, 'case.css'))
  css = css.replace('url("ceu-003")', 'url("pg/ceu-003.webp")')
  css = escoparCss(renomearCss(css))
  // ScrollTrigger e pins não combinam com scroll-behavior:smooth (o tema liga no <html>): só nesta página, desliga.
  css = 'html:has(.pp-case){scroll-behavior:auto}\n' +
    // Proteção contra o reset do tema e cabeçalho do site.
    '.pp-case{position:relative;display:block;background:var(--bg);color:var(--ink-2);font:400 17px/1.55 var(--sans);overflow-x:clip}\n' +
    '.pp-case h1,.pp-case h2,.pp-case h3,.pp-case h4{font-weight:inherit}\n' +
    '.pp-case .visually-hidden{position:absolute!important;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);clip-path:inset(50%);white-space:nowrap}\n' +
    // "Próximo case" do tema (o case.css não carrega nesta página): só a borda na cor do próximo case.
    '.pp-next .next-case{border-left:4px solid var(--ca,var(--accent))}.pp-next .next-case.is-pg{--ca:#FF0A8C}.pp-next .next-case.is-rh{--ca:#FF009B}.pp-next .next-case.is-wu{--ca:#FFDD00}.pp-next .next-case.is-wb{--ca:#F8D63E}.pp-next .next-case.is-fm{--ca:#FF8A89}.pp-next .next-case.is-ac{--ca:#1F4FE0}.pp-next .next-case.is-nb{--ca:#FF3B00}\n' +
    '.js.boot .pp-case [data-hero],.js.boot .pp-case .pp-hero-title,.js.boot .pp-case .pp-hero-shot{animation:pp-mostrar 0s 2.4s forwards}\n@keyframes pp-mostrar{to{opacity:1}}\n' +
    css
  await escrever('pp-case.css', css)

  /* ---------------- JS ---------------- */
  const GSAP = path.join(S, 'lib/node_modules/gsap/dist')
  for (const n of ['gsap', 'ScrollTrigger', 'SplitText', 'CustomEase', 'MotionPathPlugin', 'DrawSVGPlugin', 'Draggable']) await copiar(path.join(GSAP, n + '.min.js'), 'lib/' + n + '.min.js')
  await escrever('micro.js', microJs)
  await escrever('micro.css', await ler(path.join(S, 'micro/micro.css')))
  if (await existe(path.join(S, 'aviao/aviao.js'))) {
    await copiar(path.join(S, 'aviao/aviao.js'), 'aviao.js')
    if (await existe(path.join(S, 'aviao/aviao.css'))) await copiar(path.join(S, 'aviao/aviao.css'), 'aviao.css')
  }
  const sims = await ler(path.join(src, 'sims.js'))
  const caseJs = renomearJs(await ler(path.join(src, 'case.js')))
  await escrever('pp-case.js', '/* Paperplane Studio · case (gerado por build.mjs tema; fonte em scratchpad/case3/src). */\n' + sims + '\n;\n' + caseJs)

  /* ---------------- telas (sob demanda) ---------------- */
  const manifest = JSON.parse(await ler(path.join(S, SIM, 'manifest.json')))
  const usadas = new Set(), videos = new Set(), telas = {}
  const telasUsadas = TELAS
  for (const n of telasUsadas) {
    const t = manifest.telas[n]
    const html = await ler(path.join(S, SIM, t.arquivo))
    for (const m of html.matchAll(/media\/([\w.-]+\.(?:webp|svg|png|jpg|mp4))/g)) usadas.add(m[1])
    for (const m of html.matchAll(/data-sim-video="video\/([\w.-]+\.mp4)"/g)) videos.add(m[1])
    await escrever('sim/screens/' + n + '.html', html)
    telas[n] = { a: t.htmlAttrs, b: t.bodyAttrs, v: t.viewport }
  }
  let pecas = ''
  for (const n of PECAS) pecas += `<div class="pv-peca" data-peca-nome="${n}">` + (await ler(path.join(S, SIM, 'pecas', n + '.html'))) + '</div>'
  for (const m of pecas.matchAll(/media\/([\w.-]+\.(?:webp|svg|png|jpg))/g)) usadas.add(m[1])
  await escrever('sim/pecas.html', pecas)
  await escrever('sim/app.css', await ler(path.join(S, SIM, 'app.css')))
  await escrever('sim/extra.css', await ler(path.join(src, 'sim-extra.css')))
  await escrever('sim/rt.js', await ler(path.join(src, 'sim-rt.js')))
  // a página também usa um quadro de tela (quadro aprovado, reserva)
  const pagina = await ler(path.join(src, 'index.html'))
  for (const m of pagina.matchAll(/data-midia(?:-reserva)?="sim\/([\w.-]+)"/g)) usadas.add(m[1])
  for (const n of usadas) {
    const f = path.join(S, SIM, 'media', n)
    if (await existe(f)) await copiar(f, 'sim/media/' + n)
  }
  for (const n of videos) await copiar(path.join(S, SIM, 'video', n), 'sim/video/' + n)

  /* ---------------- home ---------------- */
  const siteMidias = new Set()
  for (const doc of ['home.html', 'home-celular.html']) {
    const html = await ler(path.join(S, SITE, doc))
    for (const m of html.matchAll(/media\/([\w.-]+\.(?:webp|mp4|svg|png|jpg))/g)) siteMidias.add(m[1])
    await escrever('site/' + doc, html)
  }
  siteMidias.delete('reel.mp4') // o filme do reel pesa; a home cai no pôster sozinha
  for (const n of siteMidias) { const f = path.join(S, SITE, 'media', n); if (await existe(f)) await copiar(f, 'site/media/' + n) }

  /* ---------------- mídias da página ---------------- */
  const midiasPg = []
  for (let i = 1; i <= 4; i++) { const f = path.join(S, 'assets3/ficha', i + '.webp'); if (await existe(f)) { await copiar(f, 'pg/ficha-' + i + '.webp'); midiasPg.push('pg/ficha-' + i + '.webp') } }
  if (await existe(path.join(S, 'assets3/frames/p04.webp'))) { await copiar(path.join(S, 'assets3/frames/p04.webp'), 'pg/quadro-take.webp'); midiasPg.push('pg/quadro-take.webp') }
  const ceu = []
  if (await existe(path.join(S, 'assets3/ceu'))) for (const n of (await readdir(path.join(S, 'assets3/ceu'))).filter((n) => /^\d+\.webp$/.test(n)).sort()) { await copiar(path.join(S, 'assets3/ceu', n), 'pg/ceu-' + n); ceu.push('pg/ceu-' + n); midiasPg.push('pg/ceu-' + n) }

  /* ---------------- template PHP ---------------- */
  const en = JSON.parse(await ler(path.join(here, 'tema/en.json')))
  const php = (s) => "'" + s.replace(/\\/g, '\\\\').replace(/'/g, "\\'") + "'"
  const faltando = []
  const tr = (pt) => { const e = en[pt]; if (e == null) { faltando.push(pt); return [pt, pt] } return [e, pt] }
  let art = pagina.slice(pagina.indexOf('<article class="case">'), pagina.lastIndexOf('</article>') + 10)
  const sprite = pagina.slice(pagina.indexOf('<svg class="sprite"'), pagina.indexOf('</svg>', pagina.indexOf('<svg class="sprite"')) + 6)
  art = art.replace('<article class="case">', '<article class="pp-case" id="paperplane-case">\n' + sprite)
  // ids do sprite e do filtro de grão ganham prefixo (evita colisão com o tema)
  art = art.replace(/id="i-/g, 'id="pp-i-').replace(/href="#i-/g, 'href="#pp-i-').replace(/id="grao-f"/g, 'id="pp-grao-f"').replace(/url\(#grao-f\)/g, 'url(#pp-grao-f)')
  art = renomearHtml(art)
  let saida = ''
  for (const p of quebrar(art)) {
    if (typeof p === 'object') {
      const [e, t] = tr(p.texto)
      saida += e === t ? p.texto.replace(/<\?/g, '&lt;?') : '<?php sera_e( ' + php(e) + ', ' + php(t) + ' ); ?>'
      continue
    }
    if (p.startsWith('<') && !p.startsWith('<!--')) {
      let tag = p
      for (const a of atributosDe(p)) {
        const [e, t] = tr(a.valor)
        if (e !== t) tag = tag.replace(a.nome + '="' + a.valor + '"', a.nome + '="<?php echo esc_attr( sera_t( ' + php(e) + ', ' + php(t) + ' ) ); ?>"')
      }
      saida += tag
    } else saida += p
  }
  if (faltando.length) throw new Error('Sem tradução EN para ' + faltando.length + ' textos: ' + faltando.slice(0, 5).join(' | '))
  // ligações com o site: voltar para os trabalhos, e o idioma no <article>
  saida = saida.replace(/<a class="pp-back-link" href="#top"/, '<a class="pp-back-link" href="<?php echo esc_url( home_url( \'/#work\' ) ); ?>"')
  saida = saida.replace('<article class="pp-case" id="paperplane-case">', '<article class="pp-case" id="paperplane-case" data-lang="<?php echo esc_attr( sera_lang() ); ?>">')
  // nota só em inglês: as telas do produto estão em português
  saida = saida.replace(/(<p class="pp-note reveal">[\s\S]*?<\/p>)/, (m) => m.replace('reveal">', 'reveal">').replace('</p>', "<?php if ( ! sera_is_pt() ) : ?> Product screens are shown in Portuguese, the product’s language.<?php endif; ?></p>"))
  const cabecalhoPhp = `<?php
/**
 * Case Paperplane Studio: layout próprio (gerado por scratchpad/case3/build.mjs tema; não editar à mão).
 * As telas do estúdio e a home entram como iframes carregados sob demanda de assets/cases/paperplane/.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<script>document.documentElement.classList.add('boot');setTimeout(function(){document.documentElement.classList.remove('boot')},2400);</script>
`
  await mkdir(path.join(TEMA, 'template-parts/cases'), { recursive: true })
  await writeFile(path.join(TEMA, 'template-parts/cases/paperplane.php'), cabecalhoPhp + saida + '\n')

  /* ---------------- dados para o enqueue (PHP) ---------------- */
  const i18n = JSON.parse(await ler(path.join(here, 'tema/js-i18n.json')))
  let dados = `<?php
/**
 * Paperplane Studio: dados do case para o enqueue (gerado por build.mjs tema; não editar à mão).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/** Telas do estúdio (atributos e tamanho), mídias e quadros do céu. */
function sera_pp_case_data() {
	return json_decode( ${php(JSON.stringify({ telas, midias: midiasPg, ceu }))}, true );
}

/** Textos que nascem no JS do case, no idioma da página. */
function sera_pp_case_i18n() {
	return array(
`
  for (const [k, [pt, enT]] of Object.entries(i18n)) dados += `\t\t${php(k)} => sera_t( ${php(enT)}, ${php(pt)} ),\n`
  dados += '\t);\n}\n'
  await writeFile(path.join(TEMA, 'inc/paperplane-data.php'), dados)

  pesos.sort((a, b) => b[1] - a[1])
  const total = pesos.reduce((s, p) => s + p[1], 0)
  await escrever('manifest.json', JSON.stringify({ gerado: 'build.mjs tema', arquivos: pesos.length, total }, null, 1))
  console.log(pesos.slice(0, 12).map(([n, s]) => `${(s / 1024).toFixed(0).padStart(6)} KB  ${n}`).join('\n'))
  console.log(`\nTema: ${pesos.length} arquivos, ${(total / 1024 / 1024).toFixed(2)} MB em ${D}`)
}
