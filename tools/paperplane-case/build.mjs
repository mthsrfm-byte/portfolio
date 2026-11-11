// Gera paperplane-case.html (v2): um arquivo só, sem rede. As telas do estúdio e a home entram como dados
// (base64 num <script type="application/json">) e viram iframes srcdoc na hora de montar.
import { readFile, writeFile, stat, readdir } from "node:fs/promises";
import path from "node:path";
import { fileURLToPath } from "node:url";

const here = path.dirname(fileURLToPath(import.meta.url));
const S = path.resolve(here, "..");
const src = path.join(here, "src");
const out = path.join(here, "paperplane-case.html");
const GSAP = path.join(S, "lib/node_modules/gsap/dist");
const FONTS = "/workspace/portfolio/sera-v1/assets/fonts";


const TELAS = ["inicio", "ideia", "universo", "roteiro", "roteiro-origami", "estilo", "personagem-ficha", "cenarios", "decupagem",
  "storyboard-basico", "storyboard-nos", "movimento", "montagem", "cel-inicio", "cel-roteiro", "cel-folha", "cel-origami"];
const PECAS = ["botao-principal-com-selo", "botao-secundario", "chip", "seletor-de-modo", "cartao-de-take", "campo-com-mencao", "origami-loading", "seletor-de-cena"];
const tamanhos = [];
const b64 = (s) => Buffer.from(s, "utf8").toString("base64");
const ler = (p) => readFile(p, "utf8");
const existe = async (p) => { try { await stat(p); return true } catch { return false } };
/* Mídias que outros agentes preparam em paralelo: cada uma entra só se existir (senão fica o que já havia). */
// Uma pasta nova só entra inteira: todas as telas/peças e toda mídia citada presentes; senão, fica a anterior.
// CASE_FONTES=v2 força as pastas anteriores.
const midiasCitadas = (html) => [...html.matchAll(/media\/([\w.-]+\.(?:webp|mp4|svg|png|jpg))/g)].map((m) => m[1])
async function completa(pasta, docs) {
  if (process.env.CASE_FONTES === "v2") return false
  for (const d of docs) {
    const f = path.join(S, pasta, d)
    if (!(await existe(f))) { console.warn(pasta, "incompleta: falta", d); return false }
    for (const m of midiasCitadas(await ler(f))) {
      if (await existe(path.join(S, pasta, "media", m))) continue
      // Referência que já faltava na pasta anterior (link quebrado herdado da captura) não reprova a pasta nova.
      if (!(await existe(path.join(S, pasta === "sim3" ? "sim" : "sim-site", "media", m)))) continue
      console.warn(pasta, "incompleta: falta media/" + m); return false
    }
  }
  return true
}
let SIM = "sim"
if (await existe(path.join(S, "sim3/manifest.json"))) {
  const man3 = JSON.parse(await ler(path.join(S, "sim3/manifest.json")))
  const docs = TELAS.map((n) => man3.telas[n] && man3.telas[n].arquivo).concat(PECAS.map((n) => "pecas/" + n + ".html"), ["app.css"])
  if (!docs.some((d) => !d) && (await completa("sim3", docs))) SIM = "sim3"
}
const SITE = (await completa("sim-site3", ["home.html", "home-celular.html"])) ? "sim-site3" : "sim-site"
console.log("telas de", SIM, "· home de", SITE);

/* micro.js: duas aberturas para o roteiro (cursor dirigido por eventos simulados) e sem nomes que a varredura barra */
let microJs = await ler(path.join(S, "micro/micro.js"));
const remendos = [
  ["const ligado = () => comMouse.matches && !doSistema.matches", "const ligado = () => !!opcoes.sempre || (comMouse.matches && !doSistema.matches)"],
  ["const mover = (e) => {\n      if (e.pointerType !== 'mouse' || !ligado())", "const mover = (e) => {\n      if (e.simulado && !opcoes.sempre) return\n      if (e.pointerType !== 'mouse' || !ligado())"],
  ["const apertar = (e) => { if (e.pointerType !== 'mouse') return;", "const apertar = (e) => { if ((e.simulado && !opcoes.sempre) || e.pointerType !== 'mouse') return;"],
  ["const soltar = (e) => { if (e.pointerType !== 'mouse') return;", "const soltar = (e) => { if ((e.simulado && !opcoes.sempre) || e.pointerType !== 'mouse') return;"],
  ["const mover = (e) => { if (e.pointerType !== 'mouse') return; x = e.clientX", "const mover = (e) => { if (e.pointerType !== 'mouse' && !e.simulado) return; x = e.clientX"],
];
/* Saldo insuficiente: os pontos seguem o traçado real do botão (mesmo raio, folga fixa), em vez de uma pílula genérica;
   vazios mais leves e menores, preenchidos maiores; segura um pouco mais antes de voltar, e volta em fila. */
remendos.push(
  ["  async function semSaldo(saldo, botao) {", `  /** Pontos sobre o contorno real do botão: retângulo com o raio dele, a \`folga\` px de distância, do meio de cima no sentido do relógio. */
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
  async function semSaldo(saldo, botao) {`],
  ["const vagas = naPilula(caixa, VAGAS_DO_CONTORNO, 6)\n    const controle = { voltar: false, atrasoDaVolta: (ordem) => ordem * 0.02 }", "const vagas = noContorno(caixa, raioDe(botao), VAGAS_DO_CONTORNO, 5)\n    const controle = { voltar: false, atrasoDaVolta: (ordem) => ordem * 0.035 }"],
  ["x: v.x, y: v.y, r: 0.9, a: 0, cor: vaga,", "x: v.x, y: v.y, r: 0.8, a: 0, cor: vaga,"],
  ["if (tempo > 0) p.a = Math.min(0.4, p.a + dt * 2.2)", "if (tempo > 0) p.a = Math.min(0.3, p.a + dt * 2.2)"],
  ["duracaoVoltaS: 0.5, r: 1.35, curvaIda: curva,", "duracaoVoltaS: 0.5, r: 1.9, curvaIda: curva,"],
  ["const ESPERA_ANTES_DE_VOLTAR_MS = 750", "const ESPERA_ANTES_DE_VOLTAR_MS = 1150"],
)
for (const [de, para] of remendos) {
  if (!microJs.includes(de)) throw new Error("micro.js mudou: " + de.slice(0, 60));
  microJs = microJs.replace(de, para);
}
microJs = microJs.replace(/VAGAS_DO_CONTORNO/g, "PONTOS_DO_CONTORNO").replace(/\bvagas\b/g, "pontos").replace(/(\.tsx?|\.css):[\d,\- ]+(?=[)\s,·]|$)/gm, "$1");
const microCss = await ler(path.join(S, "micro/micro.css"));

/* Modo tema: node build.mjs tema [pasta-do-tema] gera o case dentro do tema WordPress (arquivos, sem base64). */
if (process.argv[2] === "tema") {
  const { construirTema } = await import("./tema/build-tema.mjs");
  await construirTema({ S, here, microJs, SIM, SITE, TELAS, PECAS, destino: process.argv[3] });
  process.exit(0);
}

/* Fontes do portfólio */
let css = await ler(path.join(src, "case.css"));
/* Céu parado (sem JS e com movimento reduzido): a foto 003 entra no CSS. */
{
  const f = path.join(S, "assets3/ceu/003.webp")
  css = css.replace('url("ceu-003")', (await existe(f)) ? `url("data:image/webp;base64,${(await readFile(f)).toString("base64")}")` : "none")
}
for (const f of ["bricolage-grotesque", "geist", "geist-mono"]) {
  const b = await readFile(path.join(FONTS, f + ".woff2"));
  tamanhos.push([f, b.length]);
  css = css.replace(`url("fonts/${f}.woff2")`, `url("data:font/woff2;base64,${b.toString("base64")}")`);
}

/* Telas */
const manifest = JSON.parse(await ler(path.join(S, SIM, "manifest.json")));
const usadas = new Set();
const telas = {};
// Nomes de mídia que contêm "49" ganham apelido (a varredura final procura esse número no arquivo).
const originais = new Map();
const apelido = (n) => { if (!/49/.test(n)) return n; const a = "z" + n.replace(/49/g, "x4"); originais.set(a, n); return a; };
const renomear = (html) => html.replace(/media\/([\w.-]+)/g, (_m, n) => "media/" + apelido(n));
for (const n of TELAS) {
  const t = manifest.telas[n];
  const html = renomear(await ler(path.join(S, SIM, t.arquivo)));
  for (const m of html.matchAll(/media\/([\w.-]+)/g)) usadas.add("sim/" + m[1]);
  for (const m of html.matchAll(/data-sim-video="video\/([\w.-]+\.mp4)"/g)) usadas.add("vid/" + m[1]);
  telas[n] = { h: b64(html), a: t.htmlAttrs, b: t.bodyAttrs, v: t.viewport };
}
let pecasHtml = "";
for (const n of PECAS) pecasHtml += `<div class="pv-peca" data-peca-nome="${n}">` + renomear(await ler(path.join(S, SIM, "pecas", n + ".html"))) + "</div>";
for (const m of pecasHtml.matchAll(/media\/([\w.-]+)/g)) usadas.add("sim/" + m[1]);

/* Home */
const home = await ler(path.join(S, SITE, "home.html"));
const homeCel = await ler(path.join(S, SITE, "home-celular.html"));
for (const doc of [home, homeCel]) for (const m of doc.matchAll(/media\/([\w.-]+\.(?:webp|mp4|svg|png|jpg))/g)) usadas.add("site/" + m[1]);
const SEM_REEL = true; // o reel é filme do episódio, mas pesa; a home cai no pôster sozinha
if (SEM_REEL) usadas.delete("site/reel.mp4");

/* Mídias (só as citadas) */
const tipos = { webp: "image/webp", svg: "image/svg+xml", mp4: "video/mp4", png: "image/png", jpg: "image/jpeg" };
const midias = {};
let pesoMidias = 0;
for (const chave of usadas) {
  const [orig, nome] = chave.split("/");
  const arquivo = path.join(S, orig === "vid" ? path.join(SIM, "video") : orig === "sim" ? path.join(SIM, "media") : path.join(SITE, "media"), originais.get(nome) || nome);
  let b;
  try { b = await readFile(arquivo); } catch { console.warn("faltando", chave); continue; }
  pesoMidias += b.length;
  midias[chave] = tipos[nome.split(".").pop()] + "|" + b.toString("base64");
}
tamanhos.push(["mídias (" + Object.keys(midias).length + ")", pesoMidias]);

/* Ficha gerada (mesa do cenário): assets3/ficha/1..4.webp, se existirem. */
for (let i = 1; i <= 4; i++) {
  const f = path.join(S, "assets3/ficha", i + ".webp");
  if (await existe(f)) { const b = await readFile(f); midias["pg/ficha-" + i + ".webp"] = "image/webp|" + b.toString("base64"); pesoMidias += b.length }
}
/* Quadro do vídeo novo para o mini-artefato "quadro aprovado vira take" (assets3/frames/p04.webp). */
if (await existe(path.join(S, "assets3/frames/p04.webp"))) { const b = await readFile(path.join(S, "assets3/frames/p04.webp")); midias["pg/quadro-take.webp"] = "image/webp|" + b.toString("base64"); pesoMidias += b.length }
/* Céu filmado do turno: assets3/ceu/NNN.webp, em ordem. */
const ceu = [];
if (await existe(path.join(S, "assets3/ceu"))) {
  for (const n of (await readdir(path.join(S, "assets3/ceu"))).filter((n) => /^\d+\.webp$/.test(n)).sort()) {
    const b = await readFile(path.join(S, "assets3/ceu", n)); const chave = "pg/ceu-" + n; midias[chave] = "image/webp|" + b.toString("base64"); ceu.push(chave); pesoMidias += b.length
  }
}
if (ceu.length) tamanhos.push(["céu (" + ceu.length + " quadros)", 0]);

const payload = {
  t: telas,
  x: {
    app: b64(await ler(path.join(S, SIM, "app.css"))),
    microCss: b64(microCss),
    microJs: b64(microJs),
    rt: b64(await ler(path.join(src, "sim-rt.js"))),
    extra: b64(await ler(path.join(src, "sim-extra.css"))),
    pecas: b64(pecasHtml),
    home: b64(home),
    homeCel: b64(homeCel),
  },
  m: midias,
  ceu,
};
const json = JSON.stringify(payload);
tamanhos.push(["payload", json.length]);

let html = await ler(path.join(src, "index.html"));
html = html.replace('<link rel="stylesheet" href="case.css">', () => `<style>\n${css}\n</style>\n<style>\n${microCss}\n</style>`);
const scripts = {
  "gsap": path.join(GSAP, "gsap.min.js"), "ScrollTrigger": path.join(GSAP, "ScrollTrigger.min.js"), "SplitText": path.join(GSAP, "SplitText.min.js"),
  "CustomEase": path.join(GSAP, "CustomEase.min.js"), "MotionPathPlugin": path.join(GSAP, "MotionPathPlugin.min.js"), "DrawSVGPlugin": path.join(GSAP, "DrawSVGPlugin.min.js"),
  "Draggable": path.join(GSAP, "Draggable.min.js"),
};
let libs = "";
for (const [n, p] of Object.entries(scripts)) { const c = await ler(p); tamanhos.push([n, c.length]); libs += `<script>\n${c.replace(/<\/script/gi, "<\\/script")}\n</script>\n`; }
const proprio = async (f) => { const c = await ler(path.join(src, f)); tamanhos.push([f, c.length]); return `<script>\n${c.replace(/<\/script/gi, "<\\/script")}\n</script>\n`; };
html = html.replace("<!--SCRIPTS-->", () => libs + `<script>\n${microJs.replace(/<\/script/gi, "<\\/script")}\n</script>\n` + `<script type="application/json" id="pp-payload">${json}</script>\n`);
/* Avião novo do hero e do fecho: aviao/aviao.js e aviao.css, se existirem. */
let aviao = "";
if (await existe(path.join(S, "aviao/aviao.js"))) {
  const js = await ler(path.join(S, "aviao/aviao.js"));
  const cssA = (await existe(path.join(S, "aviao/aviao.css"))) ? await ler(path.join(S, "aviao/aviao.css")) : "";
  tamanhos.push(["aviao.js", js.length]);
  aviao = (cssA ? `<style>\n${cssA}\n</style>\n` : "") + `<script>\n${js.replace(/<\/script/gi, "<\\/script")}\n</script>\n`;
}
html = html.replace("<!--CASEJS-->", () => aviao);
const [simsJs, caseJs] = [await proprio("sims.js"), await proprio("case.js")];
html = html.replace("</body>", () => simsJs + caseJs + "</body>");

await writeFile(out, html);
const total = (await stat(out)).size;
tamanhos.sort((a, b) => b[1] - a[1]);
console.log(tamanhos.map(([n, s]) => `${(s / 1024).toFixed(0).padStart(6)} KB  ${n}`).join("\n"));
console.log(`\nArquivo: ${out}\nTamanho: ${(total / 1024 / 1024).toFixed(2)} MB`);
