import { readFile, writeFile } from 'node:fs/promises'
import { quebrar, atributosDe } from './unidades.mjs'
const src = await readFile(new URL('../src/index.html', import.meta.url), 'utf8')
const art = src.slice(src.indexOf('<article class="case">'), src.lastIndexOf('</article>') + 10)
const pedacos = quebrar(art)
const unid = new Set()
for (const p of pedacos) {
  if (typeof p === 'object') unid.add(p.texto)
  else if (p.startsWith('<')) for (const a of atributosDe(p)) unid.add(a.valor)
}
let antigo = {}
try { antigo = JSON.parse(await readFile(new URL('./en.json', import.meta.url), 'utf8')) } catch {}
const out = {}
for (const u of unid) out[u] = antigo[u] ?? ''
await writeFile(new URL('./en.todo.json', import.meta.url), JSON.stringify(out, null, 1))
console.log(unid.size, 'unidades;', Object.values(out).filter((v) => !v).length, 'sem tradução')
