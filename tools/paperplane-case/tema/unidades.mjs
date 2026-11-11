// Quebra o <article> do case em unidades de tradução: blocos de texto (com marcação em linha) e atributos legíveis.
// Usado pelo build (modo tema) para gerar o template PHP com sera_t('EN','PT').
export const EM_LINHA = new Set(['strong', 'em', 'code', 'br', 'a', 'small', 'mark', 'sub', 'sup'])
const SEM_CLASSE = new Set(['b', 'span', 'i'])
const VAZIOS = new Set(['br', 'img', 'input', 'meta', 'link', 'source', 'hr', 'use', 'path', 'circle', 'rect', 'line', 'feTurbulence', 'feColorMatrix', 'stop'])
export const ATRIBUTOS = ['aria-label', 'alt', 'title', 'placeholder', 'aria-valuetext']
const TEM_LETRA = /[A-Za-zÀ-ÿ]/

function ehEmLinha(tag) {
  const m = /^<\/?([a-zA-Z][\w-]*)/.exec(tag)
  if (!m) return false
  const nome = m[1]
  if (EM_LINHA.has(nome)) return true
  if (SEM_CLASSE.has(nome)) return !/\sclass=/.test(tag) && !/\saria-hidden/.test(tag) && !/\sstyle=/.test(tag)
  return false
}

/** Devolve { pedacos: [string | {texto}], attrs: Set } — texto = unidade traduzível (HTML em linha). */
export function quebrar(html) {
  const toks = html.match(/<!--[\s\S]*?-->|<\/?[a-zA-Z][^>]*>|[^<]+/g)
  const saida = []
  let i = 0
  let dentroDeSvgOuScript = 0
  while (i < toks.length) {
    const t = toks[i]
    if (/^<(svg|script|style|noscript)\b/.test(t) && !/\/>$/.test(t)) {
      dentroDeSvgOuScript++
    }
    if (/^<\/(svg|script|style|noscript)>/.test(t)) dentroDeSvgOuScript--
    const podeComecar = !dentroDeSvgOuScript && (t[0] !== '<' || (ehEmLinha(t) && !t.startsWith('</')))
    if (podeComecar) {
      // junta texto + tags em linha (balanceadas) até a próxima tag de bloco
      let j = i, prof = 0, buf = ''
      while (j < toks.length) {
        const u = toks[j]
        if (u[0] === '<' && !u.startsWith('<!--')) {
          if (!ehEmLinha(u)) break
          const nome = /^<\/?([a-zA-Z][\w-]*)/.exec(u)[1]
          const vazio = VAZIOS.has(nome) || u.endsWith('/>')
          if (u.startsWith('</')) { if (prof === 0) break; prof-- } else if (!vazio) prof++
        }
        buf += u
        j++
      }
      if (prof !== 0) { // desbalanceado: recua para só o texto
        saida.push(t); i++; continue
      }
      const m = /^(\s*)([\s\S]*?)(\s*)$/.exec(buf)
      if (TEM_LETRA.test(m[2].replace(/<[^>]+>/g, '').replace(/&[a-z]+;/g, ''))) saida.push(m[1], { texto: m[2] }, m[3])
      else saida.push(buf)
      i = j
      continue
    }
    saida.push(t)
    i++
  }
  return saida
}

/** Atributos traduzíveis de uma tag: [{nome, valor}] */
export function atributosDe(tag) {
  const out = []
  for (const a of ATRIBUTOS) {
    const m = new RegExp('\\s' + a + '="([^"]*)"').exec(tag)
    if (m && TEM_LETRA.test(m[1])) out.push({ nome: a, valor: m[1] })
  }
  return out
}
