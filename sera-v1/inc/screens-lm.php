<?php
/**
 * Pagaleve · Lume — product screens in HTML (designer area on desktop, participant session on mobile).
 * Ported 1:1 from the Lume UI built in Lovable: same Pitaya tokens, IBM Plex Sans and components.
 * Studies, people and quotes are fictional. Styles and motion: assets/css/lume-ui.css (scope .lmx).
 * Motion hooks (lmx-*) only animate inside an armed .mk-anim stage; otherwise each screen shows its final state.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/**
 * Raw markup of one screen (D1–D6 desktop, P1–P7 mobile).
 */
function sera_lm_screen_html( $name ) {
	static $s = null;
	if ( null === $s ) {
		$s = array(
			'D1' => <<<'LMX'
<div style="display:grid;grid-template-columns:560px 1fr;height:100%">
<div style="background:var(--u-navy);color:#fff;padding:56px 56px;position:relative;overflow:hidden" class="c">
<div style="position:absolute;width:520px;height:520px;right:-180px;top:-160px;border-radius:50%;background:radial-gradient(circle,rgba(255,0,155,.38),rgba(255,0,155,0) 65%)"></div>
<div style="position:absolute;width:520px;height:520px;left:-200px;bottom:-240px;border-radius:50%;background:radial-gradient(circle,rgba(61,107,214,.35),rgba(61,107,214,0) 65%)"></div>
<div class="kick" style="position:relative">Testes com protótipos do Figma</div>
<p style="position:relative;font-size:36px;line-height:44px;font-weight:600;margin-top:14px;max-width:440px">Do jeito que você moderaria, com a escala que você não tem.</p>
<div class="c g16" style="position:relative;margin-top:40px">
<div class="r g12"><span class="mono t13" style="color:#FF75C9">1</span><span class="t15">Cole o link do protótipo e o roteiro</span></div>
<div class="r g12"><span class="mono t13" style="color:#FF75C9">2</span><span class="t15">Mande o link do teste no e-mail do Customer.io</span></div>
<div class="r g12"><span class="mono t13" style="color:#FF75C9">3</span><span class="t15">Leia os achados com a voz de cada pessoa</span></div>
</div>
<div style="position:relative;margin-top:auto;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);border-radius:16px;padding:16px" class="r g12">
<span class="mic" style="width:36px;height:36px"><svg class="i" style="width:14px;height:14px" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4.5v15l12-7.5z" fill="currentColor" stroke="none"></path></svg></span>
<div class="f1"><p class="t15">“Achei que esse botão fazia outra coisa.”</p><p class="t12" style="color:#B3BEC4;margin-top:2px"><b>Revisão do Pix</b> · 01:23 · Participante 4</p></div>
</div>
</div>
<div class="c" style="justify-content:center;padding:0 120px">
<div class="brand"><div class="mark"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"></path><circle cx="12" cy="12" r="3"></circle></svg></div><div><b>Lume</b><small>Pagaleve · Design</small></div></div>
<p class="t32 b6" style="margin-top:32px">Entrar no Lume</p>
<p class="t15 mut" style="margin-top:6px">Use a sua conta Google da Pagaleve.</p>
<div class="btn" style="margin-top:28px;height:52px"><span style="width:24px;height:24px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center"><svg class="i" style="width:15px;height:15px" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 12.2c0-.6-.1-1.2-.2-1.8H12v3.5h5a4.3 4.3 0 0 1-1.9 2.8v2.3h3A9 9 0 0 0 21 12.2z" fill="#4285F4" stroke="none"></path><path d="M12 21c2.4 0 4.5-.8 6-2.2l-3-2.3c-.8.6-1.8.9-3 .9-2.3 0-4.3-1.6-5-3.7H4v2.4A9 9 0 0 0 12 21z" fill="#34A853" stroke="none"></path><path d="M7 13.7a5.4 5.4 0 0 1 0-3.4V7.9H4a9 9 0 0 0 0 8.2z" fill="#FBBC05" stroke="none"></path><path d="M12 6.6c1.3 0 2.5.5 3.4 1.3l2.6-2.6A9 9 0 0 0 4 7.9l3 2.4c.7-2.1 2.7-3.7 5-3.7z" fill="#EA4335" stroke="none"></path></svg></span>Entrar com Google</div>
<p class="t13 mut" style="margin-top:14px">Acesso restrito ao time de Product Design.</p>
</div>
</div>
<i class="lmx-cur" aria-hidden="true" style="--x0:760px;--y0:640px;--x1:920px;--y1:468px"></i>
LMX
,
			'D2' => <<<'LMX'
<div class="shell">
<aside class="side">
<div class="brand" style="padding:0 6px"><div class="mark"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"></path><circle cx="12" cy="12" r="3"></circle></svg></div><div><b>Lume</b><small>Pagaleve · Design</small></div></div>
<div class="btn sm"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>Novo estudo</div>
<nav class="snav c g4"><a class="on"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="4" width="7" height="7" rx="1.5"></rect><rect x="13" y="4" width="7" height="7" rx="1.5"></rect><rect x="4" y="13" width="7" height="7" rx="1.5"></rect><rect x="13" y="13" width="7" height="7" rx="1.5"></rect></svg>Estudos<span class="cnt">5</span></a><a><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1.1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"></path></svg>Configurações</a></nav>
<div class="c g4"><p class="over" style="padding:0 10px 4px">Em campo</p>
<div class="sitem"><span class="dot" style="color:var(--u-green)"></span><span class="f1" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">Antecipação e nova compra…</span></div>
<div class="sitem"><span class="dot" style="color:var(--u-g4)"></span><span class="f1" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">Antecipe &amp; Compre · Multi…</span></div>
</div>
<div class="r g8" style="margin-top:auto;padding:0 6px"><span class="avatar">MS</span><div class="f1"><p class="t13 b6">Matheus Serafim</p><p class="t11 mut">Sair</p></div></div>
</aside>
<div class="main">
<div class="mhead" style="padding-bottom:0">
<div class="r sb"><div><p class="t24 b6">Estudos</p><p class="t13 mut" style="margin-top:2px"><span style="color:var(--u-green)" class="b6">1 pessoa testando agora</span> · 4 sessões válidas hoje</p></div><div class="inp r g8" style="width:260px;height:38px"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><path d="M20 20l-4-4"></path></svg>Buscar estudo</div></div>
<div class="utabs" style="margin-top:18px"><a class="on">Todos <span class="n">5</span></a><a>Em campo <span class="n">3</span></a><a>Rascunhos <span class="n">1</span></a><a>Concluídos <span class="n">1</span></a></div>
</div>
<div class="mbody" style="padding:20px 32px">
<div class="card" style="overflow:hidden">
<table>
<thead><tr><th>Estudo</th><th>Status</th><th style="width:200px">Sessões válidas</th><th>Última sessão</th><th>Próximo passo</th></tr></thead>
<tbody>
<tr><td><p class="b6">Antecipação e nova compra em um Pix</p><p class="t12 mut">18 telas · 5 blocos</p></td><td><span class="pill p-live"><span class="dot"></span>1 ao vivo</span></td><td><div class="r g10"><div class="prog f1"><i style="width:58%"></i></div><span class="t13 b6 tab">7/12</span></div></td><td class="mut">há 12 min</td><td><span class="b6 pk r g4">Acompanhar <svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 6l6 6-6 6"></path></svg></span></td></tr>
<tr><td><p class="b6">Antecipe &amp; Compre · Multi-offer (quinzenal x mensal)</p><p class="t12 mut">14 telas · 4 blocos</p></td><td><span class="pill p-field">Em campo</span></td><td><div class="r g10"><div class="prog f1"><i style="width:33%"></i></div><span class="t13 b6 tab">4/12</span></div></td><td class="mut">há 2 h</td><td><span class="b6 pk r g4">Ver sessões <svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 6l6 6-6 6"></path></svg></span></td></tr>
<tr><td><p class="b6">A&amp;C - Teste #3</p><p class="t12 mut">12 telas · 4 blocos</p></td><td><span class="pill p-field">Em campo</span></td><td><div class="r g10"><div class="prog f1"><i style="width:8%"></i></div><span class="t13 b6 tab">1/12</span></div></td><td class="mut">ontem</td><td><span class="b6 pk r g4">Ver sessões <svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 6l6 6-6 6"></path></svg></span></td></tr>
<tr><td><p class="b6">Teste #2</p><p class="t12 mut">9 telas · 3 blocos</p></td><td><span class="pill p-draft">Rascunho</span></td><td class="mut t13">Meta de 12</td><td class="mut">—</td><td><span class="b6 pk r g4">Revisar e publicar <svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 6l6 6-6 6"></path></svg></span></td></tr>
<tr><td><p class="b6">Teste #1</p><p class="t12 mut">9 telas · 3 blocos</p></td><td><span class="pill p-done">Concluído</span></td><td><div class="r g10"><div class="prog f1"><i style="width:100%;background:var(--u-navy)"></i></div><span class="t13 b6 tab">16/16</span></div></td><td class="mut">há 3 d</td><td><span class="b6 pk r g4">Ler o report <svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 6l6 6-6 6"></path></svg></span></td></tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<i class="lmx-cur" aria-hidden="true" style="--x0:980px;--y0:640px;--x1:1160px;--y1:251px"></i>
LMX
,
			'D3' => <<<'LMX'
<div class="shell">
<aside class="side">
<div class="brand" style="padding:0 6px"><div class="mark"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"></path><circle cx="12" cy="12" r="3"></circle></svg></div><div><b>Lume</b><small>Pagaleve · Design</small></div></div>
<div class="btn sm"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>Novo estudo</div>
<nav class="snav c g4"><a class="on"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="4" width="7" height="7" rx="1.5"></rect><rect x="13" y="4" width="7" height="7" rx="1.5"></rect><rect x="4" y="13" width="7" height="7" rx="1.5"></rect><rect x="13" y="13" width="7" height="7" rx="1.5"></rect></svg>Estudos<span class="cnt">5</span></a><a><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1.1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"></path></svg>Configurações</a></nav>
<div class="r g8" style="margin-top:auto;padding:0 6px"><span class="avatar">MS</span><div class="f1"><p class="t13 b6">Matheus Serafim</p><p class="t11 mut">Sair</p></div></div>
</aside>
<div class="main">
<div class="mhead" style="padding-bottom:18px;border-bottom:1px solid var(--u-g3)"><p class="t13 mut">Estudos / Novo estudo</p><p class="t24 b6" style="margin-top:2px">Novo estudo</p></div>
<div class="mbody" style="display:grid;grid-template-columns:1fr 320px;gap:24px">
<div class="c g16">
<div class="card c g12" style="padding:18px">
<div class="r g10"><span class="r lmx-pop1" style="width:24px;height:24px;border-radius:50%;background:var(--u-green);color:#fff;justify-content:center"><svg class="i" style="width:13px;height:13px;stroke-width:3" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg></span><p class="t15 b6">Protótipo</p><span class="t13 mut lmx-late" style="margin-left:auto">18 telas lidas</span></div>
<div class="inp" style="color:var(--u-ink)"><span class="lmx-type">https://www.figma.com/proto/s7kwZp5F/Antecipe---compre?node-id=433-2</span></div>
</div>
<div class="card c g12" style="padding:18px">
<div class="r g10"><span class="r t12 b7" style="width:24px;height:24px;border-radius:50%;background:var(--u-pink);color:#fff;justify-content:center">2</span><p class="t15 b6">Roteiro</p></div>
<div class="r" style="background:var(--u-g1);border-radius:10px;padding:3px;gap:3px">
<span class="f1 r g6 t13 b6" style="height:34px;justify-content:center;background:#fff;border-radius:8px;box-shadow:0 1px 2px rgba(25,45,55,.1)"><svg class="i pk" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8z"></path><path d="M19 15l.7 2 2 .7-2 .7-.7 2-.7-2-2-.7 2-.7z"></path></svg>Lume sugere</span>
<span class="f1 r t13 b5 mut" style="height:34px;justify-content:center">Colar roteiro ou Doc</span>
<span class="f1 r t13 b5 mut" style="height:34px;justify-content:center">Importar JSON</span>
</div>
<div class="ta" style="height:132px">Objetivo: entender se a pessoa percebe que um único Pix antecipa as parcelas e já libera a nova compra.<br><br>Bloco 1 · Entrada pela home<br>• Dá uma lida na tela em voz alta e me conta o que você entendeu.<br>• O que esses valores querem dizer para você?</div>
<p class="t12 mut">Sugerido a partir das 18 telas. Edite à vontade antes de criar.</p>
</div>
<div class="card r sb" style="padding:18px">
<div class="r g10"><span class="r t12 b7" style="width:24px;height:24px;border-radius:50%;background:var(--u-g2);color:var(--u-mut);justify-content:center">3</span><div><p class="t15 b6">Sessões válidas</p><p class="t12 mut">O estudo conclui sozinho ao bater a meta.</p></div></div>
<div class="r g4">
<span class="chip" style="height:32px;padding:0 11px">5</span><span class="chip" style="height:32px;padding:0 11px">8</span><span class="chip navy" style="height:32px;padding:0 11px">12</span><span class="t12 mut" style="margin-left:6px">Mais ajustes</span>
</div>
</div>
</div>
<div class="card c" style="padding:18px;align-self:start">
<p class="over">O Lume vai montar</p>
<div style="display:grid;grid-template-columns:repeat(6,1fr);gap:5px;margin-top:12px">
<i style="aspect-ratio: 9 / 19; border-radius: 4px; background: var(--u-g2); --k: 0;" class="lmx-pop"></i><i style="aspect-ratio: 9 / 19; border-radius: 4px; background: var(--u-g2); --k: 1;" class="lmx-pop"></i><i style="aspect-ratio: 9 / 19; border-radius: 4px; background: var(--u-pink-soft); --k: 2;" class="lmx-pop"></i><i style="aspect-ratio: 9 / 19; border-radius: 4px; background: var(--u-g2); --k: 3;" class="lmx-pop"></i><i style="aspect-ratio: 9 / 19; border-radius: 4px; background: var(--u-pink-soft); --k: 4;" class="lmx-pop"></i><i style="aspect-ratio: 9 / 19; border-radius: 4px; background: var(--u-g2); --k: 5;" class="lmx-pop"></i>
</div>
<div class="c g10" style="margin-top:16px">
<div class="r sb t13"><span class="mut">Telas</span><span class="b6 tab">18</span></div>
<div class="r sb t13"><span class="mut">Blocos</span><span class="b6 tab">5 · 3 essenciais</span></div>
<div class="r sb t13"><span class="mut">Perguntas</span><span class="b6 tab">16</span></div>
<div class="r sb t13"><span class="mut">Duração estimada</span><span class="b6 tab">~12 min</span></div>
<div class="r sb t13"><span class="mut">Meta</span><span class="b6 tab">12 sessões</span></div>
</div>
<div class="hr" style="margin:16px 0"></div>
<p class="t13 mut">Nasce como rascunho. Ninguém recebe o link até você publicar.</p>
<div class="btn" style="margin-top:14px">Criar rascunho</div>
</div>
</div>
</div>
</div>
<i class="lmx-cur" aria-hidden="true" style="--x0:560px;--y0:300px;--x1:1088px;--y1:506px"></i>
LMX
,
			'D4' => <<<'LMX'
<div class="shell">
<aside class="side">
<div class="brand" style="padding:0 6px"><div class="mark"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"></path><circle cx="12" cy="12" r="3"></circle></svg></div><div><b>Lume</b><small>Pagaleve · Design</small></div></div>
<div class="btn sm"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>Novo estudo</div>
<nav class="snav c g4"><a class="on"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="4" width="7" height="7" rx="1.5"></rect><rect x="13" y="4" width="7" height="7" rx="1.5"></rect><rect x="4" y="13" width="7" height="7" rx="1.5"></rect><rect x="13" y="13" width="7" height="7" rx="1.5"></rect></svg>Estudos<span class="cnt">5</span></a><a><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1.1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"></path></svg>Configurações</a></nav>
<div class="c g4"><p class="over" style="padding:0 10px 4px">Recentes</p>
<div class="sitem on"><span class="dot" style="color:var(--u-g4)"></span>Teste #2</div>
<div class="sitem"><span class="dot" style="color:var(--u-green)"></span>Antecipação e nova compra…</div>
</div>
</aside>
<div class="main">
<div class="mhead">
<p class="t13 mut">Estudos / Teste #2</p>
<div class="r sb" style="margin-top:4px"><div class="r g10"><p class="t24 b6">Teste #2</p><span class="pill p-draft">Rascunho</span></div><div class="r g8"><span class="btn out sm"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4.5v15l12-7.5z" fill="currentColor" stroke="none"></path></svg>Ensaiar</span><span class="btn sm">Publicar para o campo</span></div></div>
<div class="r g8" style="margin-top:14px;flex-wrap:wrap">
<span class="t12 b6 mut">Antes de publicar · 3 de 4</span>
<span class="pill p-ok"><svg class="i" style="width:12px;height:12px;stroke-width:3" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg>9 telas lidas</span>
<span class="pill p-ok"><svg class="i" style="width:12px;height:12px;stroke-width:3" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg>Cenário</span>
<span class="pill p-ok"><svg class="i" style="width:12px;height:12px;stroke-width:3" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg>2 blocos essenciais</span>
<span class="pill p-warn">Eventos do Figma desligados · Configurar</span>
</div>
<div class="utabs" style="margin-top:14px"><a class="on">Roteiro</a><a>Campo</a><a>Sessões <span class="n">0</span></a><a>Simuladas <span class="n">3</span></a></div>
</div>
<div class="mbody" style="display:grid;grid-template-columns:360px 1fr;gap:20px">
<div class="c g12">
<div class="card" style="padding:14px"><div class="r sb"><p class="over">Cenário</p><svg class="i mut" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20h4L19 9l-4-4L4 16z"></path><path d="M13.5 6.5l4 4"></path></svg></div><p class="t13" style="margin-top:6px">Imagine que você tem duas parcelas para pagar e quer aproveitar para fazer uma nova compra de R$ 400.</p></div>
<div class="card" style="overflow:hidden">
<div class="r g10" style="padding:10px 12px"><i style="width:22px;height:40px;border-radius:4px;background:var(--u-g2);flex:none"></i><div class="f1"><p class="t13 b6">01 · Entrada pela home</p><p class="t12 mut">3 perguntas · Home</p></div></div>
<div class="r g10" style="padding:10px 12px;background:var(--u-pink-soft);border-top:1px solid var(--u-g2)"><i style="width:22px;height:40px;border-radius:4px;background:#fff;flex:none;border:1px solid var(--u-pink)"></i><div class="f1"><p class="t13 b6">02 · Entendimento da oferta</p><p class="t12 mut">4 perguntas · Oferta</p></div><span class="pill p-done" style="height:20px;font-size:11px">Essencial</span></div>
<div class="r g10" style="padding:10px 12px;border-top:1px solid var(--u-g2)"><i style="width:22px;height:40px;border-radius:4px;background:var(--u-g2);flex:none"></i><div class="f1"><p class="t13 b6">03 · Revisão e pagamento Pix</p><p class="t12 mut">4 perguntas · Revisão</p></div><span class="pill p-done" style="height:20px;font-size:11px">Essencial</span></div>
<div class="r g10" style="padding:10px 12px;border-top:1px solid var(--u-g2)"><i style="width:22px;height:40px;border-radius:4px;background:var(--u-g2);flex:none"></i><div class="f1"><p class="t13 b6">Fechamento</p><p class="t12 mut">3 perguntas · nota de 1 a 5</p></div></div>
<div class="r g8 t13 b6 pk" style="padding:12px;border-top:1px solid var(--u-g2)"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>Adicionar bloco<span style="margin-left:auto" class="r g6"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8z"></path><path d="M19 15l.7 2 2 .7-2 .7-.7 2-.7-2-2-.7 2-.7z"></path></svg>Otimizar com o Lume</span></div>
</div>
</div>
<div class="card c g16" style="padding:20px">
<div class="r sb"><p class="t18 b6">02 · Entendimento da oferta</p><div class="r g8"><span class="t13 b6">Essencial</span><span class="sw on"></span></div></div>
<div class="r g12" style="background:var(--u-g1);border-radius:12px;padding:10px"><i style="width:34px;height:62px;border-radius:6px;background:#fff;border:1px solid var(--u-g3);flex:none"></i><div class="f1"><p class="t13 b6">Tela: Oferta</p><p class="t12 mut mono">929:1188</p></div><span class="btn out xs">Trocar tela</span></div>
<div class="c g8"><p class="lbl">Perguntas</p>
<div class="r g8 t13" style="border:1px solid var(--u-g3);border-radius:10px;padding:9px 12px"><span class="mut mono t12">a</span>Dá uma lida na tela em voz alta e me conta o que você entendeu.</div>
<div class="r g8 t13" style="border:1px solid var(--u-g3);border-radius:10px;padding:9px 12px"><span class="mut mono t12">b</span>O que esses valores querem dizer para você?</div>
<div class="r g8 t13" style="border:1px solid var(--u-g3);border-radius:10px;padding:9px 12px"><span class="mut mono t12">c</span>Antes de tocar, o que você espera que aconteça depois?</div>
<span class="t13 b6 pk r g6"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>Pergunta</span>
</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
<div class="c g6"><p class="lbl">O que observar</p><div class="ta" style="height:64px">Se a pessoa nota que o valor inclui as duas parcelas.</div></div>
<div class="c g6"><p class="lbl">Conta como sucesso</p><div class="ta" style="height:64px">Explica com as próprias palavras quanto paga hoje.</div></div>
</div>
<p class="t12 mut" style="margin-top:auto">Salvo há 2 s</p>
</div>
</div>
</div>
</div>
<i class="lmx-cur" aria-hidden="true" style="--x0:700px;--y0:560px;--x1:1150px;--y1:63px"></i>
LMX
,
			'D5' => <<<'LMX'
<div class="shell">
<aside class="side">
<div class="brand" style="padding:0 6px"><div class="mark"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"></path><circle cx="12" cy="12" r="3"></circle></svg></div><div><b>Lume</b><small>Pagaleve · Design</small></div></div>
<div class="btn sm"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>Novo estudo</div>
<nav class="snav c g4"><a class="on"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="4" width="7" height="7" rx="1.5"></rect><rect x="13" y="4" width="7" height="7" rx="1.5"></rect><rect x="4" y="13" width="7" height="7" rx="1.5"></rect><rect x="13" y="13" width="7" height="7" rx="1.5"></rect></svg>Estudos<span class="cnt">5</span></a><a><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1.1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"></path></svg>Configurações</a></nav>
<div class="c g4"><p class="over" style="padding:0 10px 4px">Em campo</p>
<div class="sitem on"><span class="dot" style="color:var(--u-green)"></span><span class="f1" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">Antecipação e nova compra…</span></div>
<div class="sitem"><span class="dot" style="color:var(--u-g4)"></span><span class="f1" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">Antecipe &amp; Compre · Multi…</span></div>
</div>
</aside>
<div class="main">
<div class="mhead">
<p class="t13 mut">Estudos / Antecipação e nova compra em um Pix</p>
<div class="r sb" style="margin-top:4px"><div class="r g10"><p class="t24 b6">Antecipação e nova compra em um Pix</p><span class="pill p-live"><span class="dot"></span>Em campo</span></div><div class="r g8"><span class="btn out sm"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><rect x="8" y="8" width="12" height="12" rx="2"></rect><path d="M16 8V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h3"></path></svg>Link do e-mail</span><span class="btn out sm" style="width:36px;padding:0"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="12" r="1.2" fill="currentColor"></circle><circle cx="12" cy="12" r="1.2" fill="currentColor"></circle><circle cx="19" cy="12" r="1.2" fill="currentColor"></circle></svg></span></div></div>
<div class="r g24" style="margin-top:14px">
<div class="r g10" style="width:220px"><span class="t13 b6 tab">7 de 12 válidas</span><div class="prog f1"><i style="width:58%"></i></div></div>
<span class="t13 r g6" style="color:var(--u-green)"><span class="dot"></span><b>1 ao vivo</b></span>
<span class="t13 mut">Média de 21 palavras por resposta</span>
<span class="t13 mut">Facilidade 3,6 de 5</span>
</div>
<div class="utabs" style="margin-top:14px"><a>Roteiro</a><a>Campo</a><a class="on">Sessões <span class="n">9</span></a><a>Simuladas <span class="n">3</span></a></div>
</div>
<div class="mbody" style="display:grid;grid-template-columns:1fr 300px;gap:20px">
<div class="c g12">
<div class="r sb"><p class="t18 b6">Achados</p><div class="r g8"><span class="t12 mut">Atualizado há 12 min</span><span class="btn out xs"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M14 3H6a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8z"></path><path d="M14 3v5h5M8 13h8M8 17h5"></path></svg>Report do dia</span></div></div>
<p class="t15" style="max-width:560px">A maioria entende a antecipação, mas só metade percebe que o mesmo Pix já libera a nova compra.</p>
<div class="card c g10" style="padding:16px">
<div class="r sb"><p class="t15 b6">O valor de hoje parece só a parcela, não as duas</p><span class="pill p-bad">5 de 7 sessões</span></div>
<div class="r g4"><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-red); --k: 0;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-red); --k: 1;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-red); --k: 2;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-red); --k: 3;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-red); --k: 4;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-g2); --k: 5;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-g2); --k: 6;" class="lmx-seg"></i></div>
<div class="r g10" style="background:var(--u-g1);border-radius:12px;padding:10px"><span class="mic" style="width:30px;height:30px"><svg class="i" style="width:11px" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4.5v15l12-7.5z" fill="currentColor" stroke="none"></path></svg></span><p class="f1 t13">“Ué, R$ 186? Achei que eram duas parcelas.”</p><span class="t12 mut">Participante 4 · Oferta · 02:14</span></div>
</div>
<div class="card c g10" style="padding:16px">
<div class="r sb"><p class="t15 b6">“Compre” não é lido como uma nova compra</p><span class="pill p-warn">3 de 7 sessões</span></div>
<div class="r g4"><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: rgb(245, 150, 45); --k: 4;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: rgb(245, 150, 45); --k: 5;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: rgb(245, 150, 45); --k: 6;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-g2); --k: 7;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-g2); --k: 8;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-g2); --k: 9;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-g2); --k: 10;" class="lmx-seg"></i></div>
<div class="r g10" style="background:var(--u-g1);border-radius:12px;padding:10px"><span class="mic" style="width:30px;height:30px"><svg class="i" style="width:11px" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4.5v15l12-7.5z" fill="currentColor" stroke="none"></path></svg></span><p class="f1 t13">“Compre o quê? Eu já comprei.”</p><span class="t12 mut">Participante 2 · Home · 00:48</span></div>
</div>
<div class="card r g10" style="padding:14px 16px"><svg class="i pk" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8z"></path><path d="M19 15l.7 2 2 .7-2 .7-.7 2-.7-2-2-.7 2-.7z"></path></svg><p class="f1 t13"><b>Só o Lume pegou:</b> duas pessoas tentaram tocar no valor para ver o detalhe.</p></div>
</div>
<div class="card c" style="overflow:hidden;align-self:start">
<div class="r sb" style="padding:12px 14px"><p class="t15 b6">Sessões</p><div class="r g4 t12"><span class="b6">Todas</span><span class="mut">· Válidas</span></div></div>
<div class="r g10" style="padding:10px 14px;border-top:1px solid var(--u-g2);background:var(--u-green-soft)"><span class="dot" style="color:var(--u-green)"></span><div class="f1"><p class="t13 b6">Participante 8</p><p class="t12 mut">06:10 de sessão</p></div><span class="t12 b6" style="color:var(--u-green)">Ao vivo</span></div>
<div class="r g10" style="padding:10px 14px;border-top:1px solid var(--u-g2)"><div class="f1"><p class="t13 b6">Participante 7</p><p class="t12 mut">hoje 13:20 · 24 palavras</p></div><span class="pill p-ok">Válida</span></div>
<div class="r g10" style="padding:10px 14px;border-top:1px solid var(--u-g2)"><div class="f1"><p class="t13 b6">Participante 6</p><p class="t12 mut">hoje 11:05 · 3 palavras</p></div><span class="pill p-bad">Invalidada</span></div>
<div class="r g10" style="padding:10px 14px;border-top:1px solid var(--u-g2)"><div class="f1"><p class="t13 b6">Participante 5</p><p class="t12 mut">ontem 18:40 · 19 palavras</p></div><span class="pill p-ok">Válida</span></div>
<div class="r g10" style="padding:10px 14px;border-top:1px solid var(--u-g2)"><div class="f1"><p class="t13 b6">Ensaio do Matheus</p><p class="t12 mut">ontem 10:12</p></div><span class="pill p-test">Teste</span></div>
<div class="r sb t13" style="padding:12px 14px;border-top:1px solid var(--u-g2)"><span class="b6 pk">Planilha de cupons</span><span class="b6 pk">Sessão humana</span></div>
</div>
</div>
</div>
</div>
<i class="lmx-cur" aria-hidden="true" style="--x0:700px;--y0:700px;--x1:858px;--y1:212px"></i>
LMX
,
			'D6' => <<<'LMX'
<div class="shell">
<aside class="side">
<div class="brand" style="padding:0 6px"><div class="mark"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"></path><circle cx="12" cy="12" r="3"></circle></svg></div><div><b>Lume</b><small>Pagaleve · Design</small></div></div>
<div class="btn sm"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>Novo estudo</div>
<nav class="snav c g4"><a class="on"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="4" width="7" height="7" rx="1.5"></rect><rect x="13" y="4" width="7" height="7" rx="1.5"></rect><rect x="4" y="13" width="7" height="7" rx="1.5"></rect><rect x="13" y="13" width="7" height="7" rx="1.5"></rect></svg>Estudos<span class="cnt">5</span></a><a><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1.1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"></path></svg>Configurações</a></nav>
</aside>
<div class="main">
<div class="mhead" style="padding-bottom:16px;border-bottom:1px solid var(--u-g3)">
<p class="t13 mut">Antecipação e nova compra em um Pix / Sessões</p>
<div class="r sb" style="margin-top:4px"><div class="r g10"><p class="t24 b6">Participante 4</p><span class="pill p-ok">Válida</span><span class="t13 mut">09/10 · 15:23</span></div><div class="r g8"><span class="btn out sm" style="width:36px;padding:0"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M15 6l-6 6 6 6"></path></svg></span><span class="btn out sm" style="width:36px;padding:0"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 6l6 6-6 6"></path></svg></span><span class="btn out sm"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M14 3H6a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8z"></path><path d="M14 3v5h5M8 13h8M8 17h5"></path></svg>Exportar</span></div></div>
</div>
<div class="mbody" style="display:grid;grid-template-columns:1fr 320px;gap:20px;background:var(--u-bg);padding-top:20px">
<div class="c g10">
<p class="over">Bloco 02 · Entendimento da oferta</p>
<div class="r g8 t12 mut"><span style="height:1px;flex:1;background:var(--u-g3)"></span>Foi para a tela <b style="color:var(--u-ink)">Oferta</b> · 02:00<span style="height:1px;flex:1;background:var(--u-g3)"></span></div>
<div class="bl t13" style="font-size:13px">Dá uma lida na tela em voz alta e me conta o que você entendeu.<p class="t11 mut" style="margin-top:2px">Lume · 02:02</p></div>
<div style="align-self:flex-end;max-width:80%;background:#fff;border:1.5px solid var(--u-ink);border-radius:16px 16px 4px 16px;padding:10px 12px" class="t15">Ué, R$ 186? Achei que eram duas parcelas. Aqui diz antecipar, mas não diz quanto fica a outra.<p class="t11 mut r g6" style="margin-top:4px"><svg class="i" style="width:12px;height:12px" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4.5v15l12-7.5z" fill="currentColor" stroke="none"></path></svg>Pessoa · 02:14 · <span class="pill p-warn" style="height:18px;font-size:11px">Dúvida na voz</span></p></div>
<div class="bl t13" style="font-size:13px">O que esses valores querem dizer para você?<p class="t11 mut" style="margin-top:2px">Lume · 02:40</p></div>
<div style="align-self:flex-end;max-width:80%;background:#fff;border:1.5px solid var(--u-ink);border-radius:16px 16px 4px 16px;padding:10px 12px" class="t15">Que eu pago 186 hoje e a próxima some? Não sei se a nova compra já entra junto.<p class="t11 mut" style="margin-top:4px">Pessoa · 02:52</p></div>
<div class="r g8 t12" style="align-self:center;background:var(--u-pink-soft);color:var(--u-pink-ink);border-radius:20px;padding:4px 10px"><svg class="i" style="width:12px;height:12px" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 21V4M5 4h11l-2 4 2 4H5"></path></svg>Momento inesperado · tentou tocar no valor · 03:05</div>
</div>
<div class="c g12">
<div class="card c g10" style="padding:14px">
<div class="r g10"><span class="mic" style="width:40px;height:40px"><svg class="i" style="width:15px" viewBox="0 0 24 24" aria-hidden="true"><rect x="6" y="4" width="4" height="16" rx="1" fill="currentColor" stroke="none"></rect><rect x="14" y="4" width="4" height="16" rx="1" fill="currentColor" stroke="none"></rect></svg></span><div class="f1" style="position: relative;"><div class="wave lmx-wbase" data-wave="40" data-h="30" data-p="0.3" style="height:32px;color:var(--u-g3)"><i style="height: 23px; background: rgb(255, 0, 155); --i: 0;"></i><i style="height: 21px; background: rgb(255, 0, 155); --i: 1;"></i><i style="height: 23px; background: rgb(255, 0, 155); --i: 2;"></i><i style="height: 18px; background: rgb(255, 0, 155); --i: 3;"></i><i style="height: 8px; background: rgb(255, 0, 155); --i: 4;"></i><i style="height: 19px; background: rgb(255, 0, 155); --i: 5;"></i><i style="height: 25px; background: rgb(255, 0, 155); --i: 6;"></i><i style="height: 24px; background: rgb(255, 0, 155); --i: 7;"></i><i style="height: 25px; background: rgb(255, 0, 155); --i: 8;"></i><i style="height: 13px; background: rgb(255, 0, 155); --i: 9;"></i><i style="height: 10px; background: rgb(255, 0, 155); --i: 10;"></i><i style="height: 22px; background: rgb(255, 0, 155); --i: 11;"></i><i style="height: 23px; --i: 12;"></i><i style="height: 23px; --i: 13;"></i><i style="height: 20px; --i: 14;"></i><i style="height: 10px; --i: 15;"></i><i style="height: 12px; --i: 16;"></i><i style="height: 23px; --i: 17;"></i><i style="height: 21px; --i: 18;"></i><i style="height: 21px; --i: 19;"></i><i style="height: 18px; --i: 20;"></i><i style="height: 8px; --i: 21;"></i><i style="height: 16px; --i: 22;"></i><i style="height: 25px; --i: 23;"></i><i style="height: 21px; --i: 24;"></i><i style="height: 20px; --i: 25;"></i><i style="height: 14px; --i: 26;"></i><i style="height: 9px; --i: 27;"></i><i style="height: 21px; --i: 28;"></i><i style="height: 21px; --i: 29;"></i><i style="height: 27px; --i: 30;"></i><i style="height: 23px; --i: 31;"></i><i style="height: 11px; --i: 32;"></i><i style="height: 14px; --i: 33;"></i><i style="height: 21px; --i: 34;"></i><i style="height: 23px; --i: 35;"></i><i style="height: 23px; --i: 36;"></i><i style="height: 17px; --i: 37;"></i><i style="height: 9px; --i: 38;"></i><i style="height: 14px; --i: 39;"></i></div><div class="wave lmx-played" data-wave="40" data-h="30" data-p="0.3" style="height: 32px; color: var(--u-g3); position: absolute; margin: 0px; left: 0px; top: 0px; width: 240px;"><i style="height: 23px; background: rgb(255, 0, 155); --i: 0;"></i><i style="height: 21px; background: rgb(255, 0, 155); --i: 1;"></i><i style="height: 23px; background: rgb(255, 0, 155); --i: 2;"></i><i style="height: 18px; background: rgb(255, 0, 155); --i: 3;"></i><i style="height: 8px; background: rgb(255, 0, 155); --i: 4;"></i><i style="height: 19px; background: rgb(255, 0, 155); --i: 5;"></i><i style="height: 25px; background: rgb(255, 0, 155); --i: 6;"></i><i style="height: 24px; background: rgb(255, 0, 155); --i: 7;"></i><i style="height: 25px; background: rgb(255, 0, 155); --i: 8;"></i><i style="height: 13px; background: rgb(255, 0, 155); --i: 9;"></i><i style="height: 10px; background: rgb(255, 0, 155); --i: 10;"></i><i style="height: 22px; background: rgb(255, 0, 155); --i: 11;"></i><i style="height: 23px; --i: 12; background: rgb(255, 0, 155);"></i><i style="height: 23px; --i: 13; background: rgb(255, 0, 155);"></i><i style="height: 20px; --i: 14; background: rgb(255, 0, 155);"></i><i style="height: 10px; --i: 15; background: rgb(255, 0, 155);"></i><i style="height: 12px; --i: 16; background: rgb(255, 0, 155);"></i><i style="height: 23px; --i: 17; background: rgb(255, 0, 155);"></i><i style="height: 21px; --i: 18; background: rgb(255, 0, 155);"></i><i style="height: 21px; --i: 19; background: rgb(255, 0, 155);"></i><i style="height: 18px; --i: 20; background: rgb(255, 0, 155);"></i><i style="height: 8px; --i: 21; background: rgb(255, 0, 155);"></i><i style="height: 16px; --i: 22; background: rgb(255, 0, 155);"></i><i style="height: 25px; --i: 23; background: rgb(255, 0, 155);"></i><i style="height: 21px; --i: 24; background: rgb(255, 0, 155);"></i><i style="height: 20px; --i: 25; background: rgb(255, 0, 155);"></i><i style="height: 14px; --i: 26; background: rgb(255, 0, 155);"></i><i style="height: 9px; --i: 27; background: rgb(255, 0, 155);"></i><i style="height: 21px; --i: 28; background: rgb(255, 0, 155);"></i><i style="height: 21px; --i: 29; background: rgb(255, 0, 155);"></i><i style="height: 27px; --i: 30; background: rgb(255, 0, 155);"></i><i style="height: 23px; --i: 31; background: rgb(255, 0, 155);"></i><i style="height: 11px; --i: 32; background: rgb(255, 0, 155);"></i><i style="height: 14px; --i: 33; background: rgb(255, 0, 155);"></i><i style="height: 21px; --i: 34; background: rgb(255, 0, 155);"></i><i style="height: 23px; --i: 35; background: rgb(255, 0, 155);"></i><i style="height: 23px; --i: 36; background: rgb(255, 0, 155);"></i><i style="height: 17px; --i: 37; background: rgb(255, 0, 155);"></i><i style="height: 9px; --i: 38; background: rgb(255, 0, 155);"></i><i style="height: 14px; --i: 39; background: rgb(255, 0, 155);"></i></div></div></div>
<div class="r sb t12 mut tab"><span>03:<span class="lmx-s"></span></span><span>11:42</span></div>
</div>
<div class="card" style="overflow:hidden">
<p class="over" style="padding:12px 14px 6px">Blocos</p>
<div class="r g10 t13" style="padding:8px 14px"><svg class="i" style="color:var(--u-green)" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg><span class="f1">01 · Entrada pela home</span><span class="mut tab">00:20</span></div>
<div class="r g10 t13 b6" style="padding:8px 14px;background:var(--u-pink-soft)"><svg class="i" style="color:var(--u-green)" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg><span class="f1">02 · Oferta</span><span class="tab">02:00</span></div>
<div class="r g10 t13" style="padding:8px 14px"><svg class="i" style="color:var(--u-green)" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg><span class="f1">03 · Revisão e Pix</span><span class="mut tab">05:48</span></div>
<div class="r g10 t13" style="padding:8px 14px 12px"><svg class="i" style="color:var(--u-green)" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg><span class="f1">Fechamento</span><span class="mut tab">09:30</span></div>
</div>
<div class="card" style="display:grid;grid-template-columns:1fr 1fr;padding:4px">
<div style="padding:10px"><p class="t11 mut">Duração</p><p class="t18 b6 tab">11:42</p></div>
<div style="padding:10px"><p class="t11 mut">Palavras/resposta</p><p class="t18 b6 tab">22</p></div>
<div style="padding:10px"><p class="t11 mut">Facilidade</p><p class="t18 b6 tab">4 de 5</p></div>
<div style="padding:10px"><p class="t11 mut">Gostou do Lume</p><p class="t18 b6">Sim</p></div>
</div>
<p class="t13 b6 mut r g6" style="padding:0 4px">Detalhes técnicos <svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg></p>
</div>
</div>
</div>
</div>
<i class="lmx-cur" aria-hidden="true" style="--x0:600px;--y0:720px;--x1:586px;--y1:496px"></i>
LMX
,
			'P1' => <<<'LMX'
<div style="padding:12px 20px 0">
<div class="r sb"><div class="r g8"><div class="mark" style="width:26px;height:26px;border-radius:8px"><svg class="i" style="width:14px;height:14px" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"></path><circle cx="12" cy="12" r="3"></circle></svg></div><span class="b6">Lume</span></div><span class="t13 mut tab">1 de 3</span></div>
<div class="r g4" style="margin-top:12px"><i style="flex:1;height:4px;border-radius:2px;background:var(--u-pink)"></i><i style="flex:1;height:4px;border-radius:2px;background:var(--u-g2)"></i><i style="flex:1;height:4px;border-radius:2px;background:var(--u-g2)"></i></div>
<div class="r g10" style="margin-top:20px;background:var(--u-navy);color:#fff;border-radius:14px;padding:12px 14px"><svg class="i" style="width:20px;height:20px;color:#FF75C9" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="8" width="18" height="4" rx="1"></rect><path d="M5 12v8h14v-8M12 8v12M12 8S10.5 3.5 8 4.5 9 8 12 8zM12 8s1.5-4.5 4-3.5S15 8 12 8z"></path></svg><p class="t13">Teste por voz de uns 12 min. Quem conclui ganha um cupom.</p></div>
<p style="font-size:28px;line-height:34px;font-weight:600;margin-top:28px">Com que frequência você compra parcelado?</p>
<div class="c g10" style="margin-top:24px">
<div class="r sb t16" style="height:60px;border:1px solid var(--u-g3);border-radius:14px;padding:0 18px;background:#fff">Toda semana</div>
<div class="r sb t16 b6 lmx-sel" style="height: 60px; border: 2px solid var(--u-pink); border-radius: 14px; padding: 0px 17px; background: var(--u-pink-soft); color: var(--u-pink-ink); --pb: rgb(255, 255, 255); --pbc: rgb(220, 220, 225); --pc: rgb(25, 45, 55); --pw: 400;">Uma ou duas vezes por mês<span class="r lmx-ckmark" style="width:22px;height:22px;border-radius:50%;background:var(--u-pink);color:#fff;justify-content:center"><svg class="i" style="width:13px;height:13px;stroke-width:3" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg></span></div>
<div class="r sb t16" style="height:60px;border:1px solid var(--u-g3);border-radius:14px;padding:0 18px;background:#fff">Raramente</div>
</div>
</div>
<div class="pfoot" style="border-top:0"><div class="btn">Continuar</div></div>
<i class="lmx-tap" aria-hidden="true" style="--x:257px;--y:388px;--d:1.4s"></i><i class="lmx-tap" aria-hidden="true" style="--x:197px;--y:744px;--d:5.2s"></i>
LMX
,
			'P2' => <<<'LMX'
<div style="padding:12px 20px 0" class="c">
<div class="r sb"><span class="t13 b6 mut r g4"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M15 6l-6 6 6 6"></path></svg>Voltar</span><span class="t13 mut tab">Passo 2 de 3</span></div>
<div class="r g4" style="margin-top:12px"><i style="flex:1;height:4px;border-radius:2px;background:var(--u-green)"></i><i style="flex:1;height:4px;border-radius:2px;background:var(--u-pink)"></i><i style="flex:1;height:4px;border-radius:2px;background:var(--u-g2)"></i></div>
<div style="margin:64px auto 0;width:168px;height:168px;border-radius:50%;background:var(--u-pink-soft);display:flex;align-items:center;justify-content:center" class="lmx-halo">
<div style="width:112px;height:112px;border-radius:50%;background:var(--u-pink);color:#fff;display:flex;align-items:center;justify-content:center"><svg class="i" style="width:44px;height:44px;stroke-width:1.7" viewBox="0 0 24 24" aria-hidden="true"><rect x="9" y="3" width="6" height="12" rx="3"></rect><path d="M5 11a7 7 0 0 0 14 0M12 18v3"></path></svg></div>
</div>
<p style="font-size:26px;line-height:32px;font-weight:600;text-align:center;margin-top:36px">Agora, diga “oi”</p>
<p class="t15 mut" style="text-align:center;margin-top:8px;padding:0 12px">Quando o celular pedir, toque em <b style="color:var(--u-ink)">Permitir</b> para eu poder te ouvir.</p>
<div class="r g8" style="justify-content:center;margin-top:28px">
<div class="wave" data-wave="28" data-h="28" data-p="1" style="height:30px;color:var(--u-pink)"><i style="height: 25px; --i: 0;"></i><i style="height: 18px; --i: 1;"></i><i style="height: 8px; --i: 2;"></i><i style="height: 14px; --i: 3;"></i><i style="height: 25px; --i: 4;"></i><i style="height: 20px; --i: 5;"></i><i style="height: 20px; --i: 6;"></i><i style="height: 14px; --i: 7;"></i><i style="height: 9px; --i: 8;"></i><i style="height: 15px; --i: 9;"></i><i style="height: 19px; --i: 10;"></i><i style="height: 27px; --i: 11;"></i><i style="height: 18px; --i: 12;"></i><i style="height: 11px; --i: 13;"></i><i style="height: 11px; --i: 14;"></i><i style="height: 17px; --i: 15;"></i><i style="height: 19px; --i: 16;"></i><i style="height: 24px; --i: 17;"></i><i style="height: 16px; --i: 18;"></i><i style="height: 9px; --i: 19;"></i><i style="height: 12px; --i: 20;"></i><i style="height: 24px; --i: 21;"></i><i style="height: 20px; --i: 22;"></i><i style="height: 24px; --i: 23;"></i><i style="height: 15px; --i: 24;"></i><i style="height: 8px; --i: 25;"></i><i style="height: 16px; --i: 26;"></i><i style="height: 21px; --i: 27;"></i></div>
</div>
<p class="t13 b6 lmx-late" style="text-align:center;margin-top:10px;color:var(--u-green)">Ouvi você</p>
</div>
<div class="pfoot" style="border-top:0"><div class="btn">Próximo: som do celular</div></div>
LMX
,
			'P3' => <<<'LMX'
<div style="padding:12px 20px 0" class="c">
<div class="r sb"><span class="t13 b6 mut r g4"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M15 6l-6 6 6 6"></path></svg>Voltar</span><span class="t13 mut tab">Último passo</span></div>
<p style="font-size:28px;line-height:34px;font-weight:600;margin-top:24px">Pense em voz alta</p>
<p class="t15 mut" style="margin-top:8px">Fale o que está vendo, procurando e sentindo. Não existe resposta certa: quem está sendo testado é o app.</p>
<p class="over" style="margin-top:24px">Assim, por exemplo</p>
<div class="c g8" style="margin-top:10px">
<div class="bp lmx-in" style="align-self: flex-start; border-radius: 16px 16px 16px 4px; --k: 0;"><span class="r" style="width:28px;height:28px;border-radius:50%;background:rgba(255,255,255,.22);justify-content:center"><svg class="i" style="width:11px" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4.5v15l12-7.5z" fill="currentColor" stroke="none"></path></svg></span><span class="t13">“Estou procurando onde pagar…”</span></div>
<div class="bp lmx-in" style="align-self: flex-start; border-radius: 16px 16px 16px 4px; --k: 1;"><span class="r" style="width:28px;height:28px;border-radius:50%;background:rgba(255,255,255,.22);justify-content:center"><svg class="i" style="width:11px" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4.5v15l12-7.5z" fill="currentColor" stroke="none"></path></svg></span><span class="t13">“Achei que esse botão fazia outra coisa.”</span></div>
<div class="bp lmx-in" style="align-self: flex-start; border-radius: 16px 16px 16px 4px; --k: 2;"><span class="r" style="width:28px;height:28px;border-radius:50%;background:rgba(255,255,255,.22);justify-content:center"><svg class="i" style="width:11px" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4.5v15l12-7.5z" fill="currentColor" stroke="none"></path></svg></span><span class="t13">“Esse valor me deixou em dúvida.”</span></div>
</div>
<div class="r g10" style="margin-top:20px;background:var(--u-g1);border-radius:12px;padding:12px"><svg class="i" style="width:18px;height:18px;color:var(--u-ink)" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 18h6M10 21h4M12 3a6 6 0 0 0-3.5 10.9c.6.4 1 1.1 1 1.8V16h5v-.3c0-.7.4-1.4 1-1.8A6 6 0 0 0 12 3z"></path></svg><p class="t13">Explique o porquê das suas respostas. É isso que valida a sessão e libera o cupom.</p></div>
<div class="r g12 lmx-sel2" style="margin-top: 14px; border: 1.5px solid var(--u-pink); background: var(--u-pink-soft); border-radius: 14px; padding: 14px; --pb: rgb(245, 245, 250); --pbc: rgb(25, 45, 55); --pc: rgb(25, 45, 55); --pw: 400;"><span class="ck on lmx-ckbox"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg></span><p class="t15 b6">Combinado, vou falar o que eu penso</p></div>
</div>
<div class="pfoot" style="border-top:0"><div class="btn">Começar o teste · 12 min</div></div>
<i class="lmx-tap" aria-hidden="true" style="--x:45px;--y:489px;--d:4.6s"></i><i class="lmx-tap" aria-hidden="true" style="--x:197px;--y:744px;--d:6.1s"></i>
LMX
,
			'P4' => <<<'LMX'
<div style="position:absolute;width:420px;height:420px;right:-160px;top:-140px;border-radius:50%;background:radial-gradient(circle,rgba(255,0,155,.35),rgba(255,0,155,0) 65%)"></div>
<div style="position:relative;padding:20px 22px 0;height:calc(100% - 47px)" class="c">
<div class="r g10"><div class="mark" style="width:36px;height:36px;border-radius:50%"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"></path><circle cx="12" cy="12" r="3"></circle></svg></div><div><p class="t15 b6">Lume</p><p class="t12 r g6" style="color:#FF75C9"><svg class="i" style="width:12px;height:12px" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 9v6h4l5 4V5L8 9z"></path><path d="M16.5 8.5a5 5 0 0 1 0 7M19 6a8.5 8.5 0 0 1 0 12"></path></svg>falando</p></div></div>
<div class="c g8" style="margin-top:22px">
<p class="t16" style="color:#B3BEC4">Oi! Eu sou o Lume. Vou te mostrar uma ideia nova para o app e conversar com você enquanto mexe.</p>
<p class="t20 b6" style="line-height:28px">Quem está sendo testado é o app, não você. Não existe resposta certa.</p>
</div>
<div style="margin-top:28px;background:#fff;color:var(--u-ink);border-radius:18px;padding:18px">
<p class="over">Imagine o seguinte</p>
<p class="t18 b6" style="margin-top:6px;line-height:25px">Você tem duas parcelas para pagar e quer aproveitar para fazer uma nova compra de R$ 400.</p>
<p class="t12 mut" style="margin-top:12px">É um protótipo: nem tudo funciona como no app.</p>
</div>
<div style="margin-top:auto;padding-bottom:38px">
<div style="position:relative;height:54px;border-radius:14px;background:rgba(255,255,255,.1);overflow:hidden" class="r">
<i style="position:absolute;inset:0;width:62%;background:var(--u-pink)" class="lmx-load"></i>
<span style="position:relative;margin:auto" class="t15 b6">Carregando o protótipo · <span class="lmx-pct"></span></span>
</div>
<p class="t12" style="color:#B3BEC4;text-align:center;margin-top:10px">Vira “Vamos começar” assim que carregar.</p>
</div>
</div>
LMX
,
			'P5' => <<<'LMX'
<div style="margin: 0px; width: 100%; height: 100%; border-radius: 0px; padding: 0px; background: rgb(255, 255, 255); box-shadow: none;"><div style="width: 100%; height: 100%; border-radius: 0px; overflow: hidden;"><div class="proto" style="width: 300px; height: 609px; transform: scale(1.31); transform-origin: 0px 0px;"><div style="height:30px"></div><div class="ph" style="font-size:15px;padding:12px 16px"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M15 6l-6 6 6 6"></path></svg>Antecipar e comprar</div><div style="padding:6px 16px 0;font-size:13px;line-height:18px"><p class="mut">Pague hoje</p><p style="font-size:30px;line-height:36px;font-weight:600">R$ 372,00</p><p class="mut">2 parcelas de R$ 186,00</p><div style="margin-top:18px"><div class="ln" style="padding:11px 0"><span>Parcela 3 · 15/11</span><b>R$ 186,00</b></div><div class="ln" style="padding:11px 0"><span>Parcela 4 · 15/12</span><b>R$ 186,00</b></div><div class="ln" style="padding:11px 0"><span>Libera para nova compra</span><b style="color:#0A7D50">R$ 400,00</b></div></div><div style="margin-top:18px;background:#F5F5FA;border-radius:12px;padding:12px">Pix único: antecipa as duas parcelas e libera limite na hora.</div></div><div style="margin-top:auto;margin:auto 16px 26px;height:46px;border-radius:12px;background:#FF009B;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:15px">Pagar com Pix</div></div></div></div>
<div style="position:absolute;left:12px;right:12px;bottom:28px;background:#fff;border-radius:22px;box-shadow:0 12px 32px -4px rgba(25,45,55,.22),0 0 0 1px rgba(25,45,55,.06);padding:14px 14px 14px" class="c g10">
<p class="t16 b6" style="line-height:22px;padding:0 2px">O que esses valores querem dizer para você?</p>
<div class="r g10">
<span class="r" style="width:40px;height:40px;border-radius:50%;border:1px solid var(--u-g3);justify-content:center;color:var(--u-mut)"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M9 7V4h6v3M6 7l1 13h10l1-13"></path></svg></span>
<div class="f1 r g8" style="height:44px;background:var(--u-g1);border-radius:22px;padding:0 12px"><span class="dot lmx-blink" style="color:var(--u-red)"></span><span class="t13 b6 tab">0:<span class="lmx-s9"></span></span><div class="wave f1" data-wave="34" data-h="24" data-p="1" style="color:var(--u-pink-ink);justify-content:space-between;height:28px"><i style="height: 16px; --i: 0;"></i><i style="height: 21px; --i: 1;"></i><i style="height: 17px; --i: 2;"></i><i style="height: 14px; --i: 3;"></i><i style="height: 7px; --i: 4;"></i><i style="height: 11px; --i: 5;"></i><i style="height: 20px; --i: 6;"></i><i style="height: 21px; --i: 7;"></i><i style="height: 20px; --i: 8;"></i><i style="height: 14px; --i: 9;"></i><i style="height: 7px; --i: 10;"></i><i style="height: 13px; --i: 11;"></i><i style="height: 18px; --i: 12;"></i><i style="height: 22px; --i: 13;"></i><i style="height: 15px; --i: 14;"></i><i style="height: 10px; --i: 15;"></i><i style="height: 9px; --i: 16;"></i><i style="height: 17px; --i: 17;"></i><i style="height: 21px; --i: 18;"></i><i style="height: 19px; --i: 19;"></i><i style="height: 17px; --i: 20;"></i><i style="height: 8px; --i: 21;"></i><i style="height: 11px; --i: 22;"></i><i style="height: 14px; --i: 23;"></i><i style="height: 16px; --i: 24;"></i><i style="height: 15px; --i: 25;"></i><i style="height: 15px; --i: 26;"></i><i style="height: 6px; --i: 27;"></i><i style="height: 13px; --i: 28;"></i><i style="height: 18px; --i: 29;"></i><i style="height: 21px; --i: 30;"></i><i style="height: 19px; --i: 31;"></i><i style="height: 11px; --i: 32;"></i><i style="height: 8px; --i: 33;"></i></div></div>
<span class="mic" style="width:48px;height:48px"><svg class="i" style="width:20px;height:20px" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 19V5M6 11l6-6 6 6"></path></svg></span>
</div>
</div>
<i class="lmx-tap" aria-hidden="true" style="--x:343px;--y:732px;--d:6.2s"></i>
LMX
,
			'P6' => <<<'LMX'
<div style="padding:16px 20px 0" class="c">
<div class="r sb"><span class="pill p-ok"><svg class="i" style="width:12px;height:12px;stroke-width:3" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg>Telas concluídas</span><span class="t13 mut tab">Pergunta 1 de 3</span></div>
<div class="r g10" style="margin-top:28px"><div class="mark" style="width:36px;height:36px;border-radius:50%"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"></path><circle cx="12" cy="12" r="3"></circle></svg></div><p class="t13 mut">Agora umas perguntas rápidas sobre o que você viu.</p></div>
<p style="font-size:26px;line-height:32px;font-weight:600;margin-top:20px">De 1 a 5, quão fácil foi entender quanto pagar hoje e depois?</p>
<div class="c g8" style="margin-top:28px">
<div class="r g12" style="height:54px;border:1px solid var(--u-g3);border-radius:14px;padding:0 16px"><span class="t18 b6 tab" style="width:18px">5</span><span class="t15">Muito fácil</span></div>
<div class="r g12 lmx-sel" style="height: 54px; border: 2px solid var(--u-pink); background: var(--u-pink); color: rgb(255, 255, 255); border-radius: 14px; padding: 0px 15px; --pb: rgba(0, 0, 0, 0); --pbc: rgb(220, 220, 225); --pc: rgb(25, 45, 55); --pw: 400;"><span class="t18 b6 tab" style="width:18px">4</span><span class="t15 b6">Fácil</span><svg class="i lmx-ckmark" style="margin-left:auto;stroke-width:3" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg></div>
<div class="r g12" style="height:54px;border:1px solid var(--u-g3);border-radius:14px;padding:0 16px"><span class="t18 b6 tab" style="width:18px">3</span><span class="t15">Nem fácil nem difícil</span></div>
<div class="r g12" style="height:54px;border:1px solid var(--u-g3);border-radius:14px;padding:0 16px"><span class="t18 b6 tab" style="width:18px">2</span><span class="t15">Difícil</span></div>
<div class="r g12" style="height:54px;border:1px solid var(--u-g3);border-radius:14px;padding:0 16px"><span class="t18 b6 tab" style="width:18px">1</span><span class="t15">Muito difícil</span></div>
</div>
</div>
<div class="pfoot" style="border-top:0"><p class="t13 mut" style="text-align:center">Depois o Lume pergunta por que você deu essa nota.</p></div>
<i class="lmx-tap" aria-hidden="true" style="--x:197px;--y:335px;--d:2.4s"></i>
LMX
,
			'P7' => <<<'LMX'
<div style="padding:16px 20px 0" class="c">
<span class="pill p-ok" style="align-self:flex-start"><svg class="i" style="width:12px;height:12px;stroke-width:3" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg>Sessão validada</span>
<p style="font-size:28px;line-height:34px;font-weight:600;margin-top:12px">Valeu demais! Seu cupom está garantido.</p>
<div class="r g12" style="margin-top:18px;border:1px solid var(--u-g3);background:#fff;border-radius:16px;padding:14px 16px"><span class="icb" style="width:40px;height:40px"><svg class="i" style="width:20px;height:20px" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="8" width="18" height="4" rx="1"></rect><path d="M5 12v8h14v-8M12 8v12M12 8S10.5 3.5 8 4.5 9 8 12 8zM12 8s1.5-4.5 4-3.5S15 8 12 8z"></path></svg></span><div class="f1"><p class="t13 mut">Chega no seu e-mail</p><p class="t18 b6">até 24/10 <span class="t13 mut b5">· 10 dias úteis</span></p></div></div>
<p class="t18 b6" style="margin-top:28px">Como foi conversar com o Lume?</p>
<p class="t13 mut">Opcional. Ajuda a melhorar os próximos testes.</p>
<div class="r sb" style="margin-top:14px;color:var(--u-pink)"><svg class="i" style="width:44px;height:44px;fill:currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3.5l2.6 5.3 5.9.9-4.2 4.1 1 5.8L12 16.8l-5.3 2.8 1-5.8L3.5 9.7l5.9-.9z"></path></svg><svg class="i" style="width:44px;height:44px;fill:currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3.5l2.6 5.3 5.9.9-4.2 4.1 1 5.8L12 16.8l-5.3 2.8 1-5.8L3.5 9.7l5.9-.9z"></path></svg><svg class="i" style="width:44px;height:44px;fill:currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3.5l2.6 5.3 5.9.9-4.2 4.1 1 5.8L12 16.8l-5.3 2.8 1-5.8L3.5 9.7l5.9-.9z"></path></svg><svg class="i" style="width:44px;height:44px;fill:currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3.5l2.6 5.3 5.9.9-4.2 4.1 1 5.8L12 16.8l-5.3 2.8 1-5.8L3.5 9.7l5.9-.9z"></path></svg><svg class="i" style="width:44px;height:44px;color:var(--u-g4)" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3.5l2.6 5.3 5.9.9-4.2 4.1 1 5.8L12 16.8l-5.3 2.8 1-5.8L3.5 9.7l5.9-.9z"></path></svg></div>
<p class="t13 b6 lmx-late" style="margin-top:6px">Bom</p>
<div class="r g6" style="margin-top:14px;flex-wrap:wrap"><span class="chip on lmx-sel3" style="height: 34px; --pb: rgb(252, 252, 252); --pbc: rgb(220, 220, 225); --pc: rgb(25, 45, 55); --pw: 600;"><svg class="i lmx-ckmark3" style="width:13px" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg>Perguntas claras</span><span class="chip" style="height:34px">Ritmo bom</span><span class="chip" style="height:34px">Me interrompeu</span><span class="chip" style="height:34px">Demorou para responder</span></div>
</div>
<div class="pfoot c g6" style="border-top:0"><div class="btn">Enviar e sair</div><div class="btn ghost" style="height:36px">Sair sem responder</div></div>
<i class="lmx-tap" aria-hidden="true" style="--x:107px;--y:429px;--d:4.4s"></i>
LMX
,
			'M2' => <<<'LMX'
<div class="shell" style="display: block; height: 100%;">
<div class="main" style="height: 100%;"><div class="r sb g12" style="height:64px;padding:0 16px;border-bottom:1px solid var(--u-g3);background:#fff;box-shadow:0 1px 3px rgba(25,45,55,.08);flex:none"><div class="brand"><div class="mark"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"></path><circle cx="12" cy="12" r="3"></circle></svg></div><div><b>Lume</b><small>Pagaleve · Design</small></div></div><div class="r g8"><div class="btn sm"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>Novo estudo</div><div class="btn sm out" style="width:36px;padding:0" aria-label="Abrir menu"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"></path></svg></div></div></div>
<div class="mhead" style="padding: 20px 16px 0px;">
<div class="r sb" style="flex-flow: column wrap; align-items: flex-start; gap: 6px 16px;"><div><p class="t24 b6">Estudos</p><p class="t13 mut" style="margin-top:2px"><span style="color:var(--u-green)" class="b6">1 pessoa testando agora</span> · 4 sessões válidas hoje</p></div><div class="inp r g8" style="width: 100%; height: 38px;"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><path d="M20 20l-4-4"></path></svg>Buscar estudo</div></div>
<div class="utabs" style="margin-top: 18px; overflow: hidden; white-space: nowrap;"><a class="on">Todos <span class="n">5</span></a><a>Em campo <span class="n">3</span></a><a>Rascunhos <span class="n">1</span></a><a>Concluídos <span class="n">1</span></a></div>
</div>
<div class="mbody" style="padding: 20px 16px; grid-template-columns: minmax(0px, 1fr); gap: 16px; overflow: hidden;">
<div class="card" style="overflow:hidden"><div class="r g8" style="padding:12px 16px;"><div class="f1"><p class="t15 b6" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis">Antecipação e nova compra em um Pix</p><div class="r g12" style="margin-top:8px"><span class="pill p-live"><span class="dot"></span>1 ao vivo</span><div class="f1 r g10"><div class="r g10 f1"><div class="prog f1"><i style="width:58%"></i></div><span class="t13 b6 tab">7/12</span></div></div></div></div><svg class="i mut" viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="12" r="1"></circle><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle></svg></div><div class="r g8" style="padding:12px 16px;border-top:1px solid var(--u-g2);"><div class="f1"><p class="t15 b6" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis">Antecipe &amp; Compre · Multi-offer (quinzenal x mensal)</p><div class="r g12" style="margin-top:8px"><span class="pill p-field">Em campo</span><div class="f1 r g10"><div class="r g10 f1"><div class="prog f1"><i style="width:33%"></i></div><span class="t13 b6 tab">4/12</span></div></div></div></div><svg class="i mut" viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="12" r="1"></circle><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle></svg></div><div class="r g8" style="padding:12px 16px;border-top:1px solid var(--u-g2);"><div class="f1"><p class="t15 b6" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis">A&amp;C - Teste #3</p><div class="r g12" style="margin-top:8px"><span class="pill p-field">Em campo</span><div class="f1 r g10"><div class="r g10 f1"><div class="prog f1"><i style="width:8%"></i></div><span class="t13 b6 tab">1/12</span></div></div></div></div><svg class="i mut" viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="12" r="1"></circle><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle></svg></div><div class="r g8" style="padding:12px 16px;border-top:1px solid var(--u-g2);"><div class="f1"><p class="t15 b6" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis">Teste #2</p><div class="r g12" style="margin-top:8px"><span class="pill p-draft">Rascunho</span><div class="f1 r g10">Meta de 12</div></div></div><svg class="i mut" viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="12" r="1"></circle><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle></svg></div><div class="r g8" style="padding:12px 16px;border-top:1px solid var(--u-g2);"><div class="f1"><p class="t15 b6" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis">Teste #1</p><div class="r g12" style="margin-top:8px"><span class="pill p-done">Concluído</span><div class="f1 r g10"><div class="r g10 f1"><div class="prog f1"><i style="width:100%;background:var(--u-navy)"></i></div><span class="t13 b6 tab">16/16</span></div></div></div></div><svg class="i mut" viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="12" r="1"></circle><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle></svg></div></div>
</div>
</div>
</div>
<i class="lmx-tap" aria-hidden="true" style="--x:185px;--y:288px;--d:5s"></i>
LMX
,
			'M3' => <<<'LMX'
<div class="shell" style="display: block; height: 100%;">
<div class="main" style="height: 100%;"><div class="r sb g12" style="height:64px;padding:0 16px;border-bottom:1px solid var(--u-g3);background:#fff;box-shadow:0 1px 3px rgba(25,45,55,.08);flex:none"><div class="brand"><div class="mark"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"></path><circle cx="12" cy="12" r="3"></circle></svg></div><div><b>Lume</b><small>Pagaleve · Design</small></div></div><div class="r g8"><div class="btn sm"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>Novo estudo</div><div class="btn sm out" style="width:36px;padding:0" aria-label="Abrir menu"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"></path></svg></div></div></div>
<div class="mhead" style="padding: 20px 16px 0px; border-bottom: 1px solid var(--u-g3);"><p class="t13 mut">Estudos / Novo estudo</p><p class="t24 b6" style="margin-top:2px">Novo estudo</p></div>
<div class="mbody" style="display: grid; grid-template-columns: minmax(0px, 1fr); gap: 16px; padding: 20px 16px; overflow: hidden;">
<div class="c g16" style="min-width: 0px;">
<div class="card c g12" style="padding:18px">
<div class="r g10"><span class="r lmx-pop1" style="width:24px;height:24px;border-radius:50%;background:var(--u-green);color:#fff;justify-content:center"><svg class="i" style="width:13px;height:13px;stroke-width:3" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg></span><p class="t15 b6">Protótipo</p><span class="t13 mut lmx-late" style="margin-left:auto">18 telas lidas</span></div>
<div class="inp" style="color:var(--u-ink)"><span class="lmx-type">https://www.figma.com/proto/s7kwZp5F/Antecipe---compre?node-id=433-2</span></div>
</div>
<div class="card c g12" style="padding:18px">
<div class="r g10"><span class="r t12 b7" style="width:24px;height:24px;border-radius:50%;background:var(--u-pink);color:#fff;justify-content:center">2</span><p class="t15 b6">Roteiro</p></div>
<div class="r" style="background:var(--u-g1);border-radius:10px;padding:3px;gap:3px">
<span class="f1 r g6 t13 b6" style="height: 34px; justify-content: center; background: rgb(255, 255, 255); border-radius: 8px; box-shadow: rgba(25, 45, 55, 0.1) 0px 1px 2px; white-space: nowrap; font-size: 12px; padding: 0px 6px;"><svg class="i pk" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8z"></path><path d="M19 15l.7 2 2 .7-2 .7-.7 2-.7-2-2-.7 2-.7z"></path></svg>Lume sugere</span>
<span class="f1 r t13 b5 mut" style="height: 34px; justify-content: center; white-space: nowrap; font-size: 12px; padding: 0px 6px;">Colar roteiro ou Doc</span>
</div>
<div class="ta" style="height:132px">Objetivo: entender se a pessoa percebe que um único Pix antecipa as parcelas e já libera a nova compra.<br><br>Bloco 1 · Entrada pela home<br>• Dá uma lida na tela em voz alta e me conta o que você entendeu.<br>• O que esses valores querem dizer para você?</div>
<p class="t12 mut">Sugerido a partir das 18 telas. Edite à vontade antes de criar.</p>
</div>
<div class="card r sb" style="padding:18px">
<div class="r g10"><span class="r t12 b7" style="width:24px;height:24px;border-radius:50%;background:var(--u-g2);color:var(--u-mut);justify-content:center">3</span><div><p class="t15 b6">Sessões válidas</p><p class="t12 mut">O estudo conclui sozinho ao bater a meta.</p></div></div>
<div class="r g4">
<span class="chip" style="height:32px;padding:0 11px">5</span><span class="chip" style="height:32px;padding:0 11px">8</span><span class="chip navy" style="height:32px;padding:0 11px">12</span>
</div>
</div>
</div>
<div class="card c" style="padding: 18px; align-self: start; min-width: 0px;">
<p class="over">O Lume vai montar</p>
<div style="display:grid;grid-template-columns:repeat(6,1fr);gap:5px;margin-top:12px">
<i style="aspect-ratio:9/19;border-radius:4px;background:var(--u-g2)"></i><i style="aspect-ratio:9/19;border-radius:4px;background:var(--u-g2)"></i><i style="aspect-ratio:9/19;border-radius:4px;background:var(--u-pink-soft)"></i><i style="aspect-ratio:9/19;border-radius:4px;background:var(--u-g2)"></i><i style="aspect-ratio:9/19;border-radius:4px;background:var(--u-pink-soft)"></i><i style="aspect-ratio:9/19;border-radius:4px;background:var(--u-g2)"></i>
</div>
<div class="c g10" style="margin-top:16px">
<div class="r sb t13"><span class="mut">Telas</span><span class="b6 tab">18</span></div>
<div class="r sb t13"><span class="mut">Blocos</span><span class="b6 tab">5 · 3 essenciais</span></div>
<div class="r sb t13"><span class="mut">Perguntas</span><span class="b6 tab">16</span></div>
<div class="r sb t13"><span class="mut">Duração estimada</span><span class="b6 tab">~12 min</span></div>
<div class="r sb t13"><span class="mut">Meta</span><span class="b6 tab">12 sessões</span></div>
</div>
<div class="hr" style="margin:16px 0"></div>
<p class="t13 mut">Nasce como rascunho. Ninguém recebe o link até você publicar.</p>
<div class="btn" style="margin-top:14px">Criar rascunho</div>
</div>
</div>
</div>
</div>
<i class="lmx-tap" aria-hidden="true" style="--x:117px;--y:366px;--d:3.6s"></i>
LMX
,
			'M4' => <<<'LMX'
<div class="shell" style="display: block; height: 100%;">
<div class="main" style="height: 100%;"><div class="r sb g12" style="height:64px;padding:0 16px;border-bottom:1px solid var(--u-g3);background:#fff;box-shadow:0 1px 3px rgba(25,45,55,.08);flex:none"><div class="brand"><div class="mark"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"></path><circle cx="12" cy="12" r="3"></circle></svg></div><div><b>Lume</b><small>Pagaleve · Design</small></div></div><div class="r g8"><div class="btn sm"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>Novo estudo</div><div class="btn sm out" style="width:36px;padding:0" aria-label="Abrir menu"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"></path></svg></div></div></div>
<div class="mhead" style="padding: 20px 16px 0px;">
<p class="t13 mut">Estudos / Teste #2</p>
<div class="r sb" style="margin-top: 4px; flex-flow: column wrap; align-items: flex-start; gap: 6px 16px;"><div class="r g10"><p class="t24 b6">Teste #2</p><span class="pill p-draft">Rascunho</span></div><div class="r g8"><span class="btn out sm"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4.5v15l12-7.5z" fill="currentColor" stroke="none"></path></svg>Ensaiar</span><span class="btn sm">Publicar para o campo</span></div></div>
<div class="r g8" style="margin-top: 14px; flex-wrap: wrap; gap: 6px 16px;">
<span class="t12 b6 mut">Antes de publicar · 3 de 4</span>
<span class="pill p-ok"><svg class="i" style="width:12px;height:12px;stroke-width:3" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg>9 telas lidas</span>
<span class="pill p-ok"><svg class="i" style="width:12px;height:12px;stroke-width:3" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg>Cenário</span>
<span class="pill p-ok"><svg class="i" style="width:12px;height:12px;stroke-width:3" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg>2 blocos essenciais</span>
<span class="pill p-warn">Eventos do Figma desligados · Configurar</span>
</div>
<div class="utabs" style="margin-top:14px"><a class="on">Roteiro</a><a>Campo</a><a>Sessões <span class="n">0</span></a><a>Simuladas <span class="n">3</span></a></div>
</div>
<div class="mbody" style="display: grid; grid-template-columns: minmax(0px, 1fr); gap: 16px; padding: 20px 16px; overflow: hidden;">
<div class="c g12" style="min-width: 0px;">
<div class="card" style="padding:14px"><div class="r sb"><p class="over">Cenário</p><svg class="i mut" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20h4L19 9l-4-4L4 16z"></path><path d="M13.5 6.5l4 4"></path></svg></div><p class="t13" style="margin-top:6px">Imagine que você tem duas parcelas para pagar e quer aproveitar para fazer uma nova compra de R$ 400.</p></div>
<div class="card" style="overflow:hidden">
<div class="r g10" style="padding:10px 12px"><i style="width:22px;height:40px;border-radius:4px;background:var(--u-g2);flex:none"></i><div class="f1"><p class="t13 b6">01 · Entrada pela home</p><p class="t12 mut">3 perguntas · Home</p></div></div>
<div class="r g10" style="padding:10px 12px;background:var(--u-pink-soft);border-top:1px solid var(--u-g2)"><i style="width:22px;height:40px;border-radius:4px;background:#fff;flex:none;border:1px solid var(--u-pink)"></i><div class="f1"><p class="t13 b6">02 · Entendimento da oferta</p><p class="t12 mut">4 perguntas · Oferta</p></div><span class="pill p-done" style="height:20px;font-size:11px">Essencial</span></div>
<div class="r g10" style="padding:10px 12px;border-top:1px solid var(--u-g2)"><i style="width:22px;height:40px;border-radius:4px;background:var(--u-g2);flex:none"></i><div class="f1"><p class="t13 b6">03 · Revisão e pagamento Pix</p><p class="t12 mut">4 perguntas · Revisão</p></div><span class="pill p-done" style="height:20px;font-size:11px">Essencial</span></div>
<div class="r g10" style="padding:10px 12px;border-top:1px solid var(--u-g2)"><i style="width:22px;height:40px;border-radius:4px;background:var(--u-g2);flex:none"></i><div class="f1"><p class="t13 b6">Fechamento</p><p class="t12 mut">3 perguntas · nota de 1 a 5</p></div></div>
<div class="r g8 t13 b6 pk" style="padding:12px;border-top:1px solid var(--u-g2)"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>Adicionar bloco<span style="margin-left:auto" class="r g6"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8z"></path><path d="M19 15l.7 2 2 .7-2 .7-.7 2-.7-2-2-.7 2-.7z"></path></svg>Otimizar com o Lume</span></div>
</div>
</div>
</div>
</div>
</div>
<i class="lmx-tap" aria-hidden="true" style="--x:169px;--y:621px;--d:3.2s"></i>
LMX
,
			'M5' => <<<'LMX'
<div class="shell" style="display: block; height: 100%;">
<div class="main" style="height: 100%;"><div class="r sb g12" style="height:64px;padding:0 16px;border-bottom:1px solid var(--u-g3);background:#fff;box-shadow:0 1px 3px rgba(25,45,55,.08);flex:none"><div class="brand"><div class="mark"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"></path><circle cx="12" cy="12" r="3"></circle></svg></div><div><b>Lume</b><small>Pagaleve · Design</small></div></div><div class="r g8"><div class="btn sm"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>Novo estudo</div><div class="btn sm out" style="width:36px;padding:0" aria-label="Abrir menu"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"></path></svg></div></div></div>
<div class="mhead" style="padding: 20px 16px 0px;">
<p class="t13 mut">Estudos / Antecipação e nova compra em um Pix</p>
<div class="r sb" style="margin-top: 4px; flex-flow: column wrap; align-items: flex-start; gap: 6px 16px;"><div class="r g10"><p class="t24 b6">Antecipação e nova compra em um Pix</p><span class="pill p-live"><span class="dot"></span>Em campo</span></div><div class="r g8"><span class="btn out sm"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><rect x="8" y="8" width="12" height="12" rx="2"></rect><path d="M16 8V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h3"></path></svg>Link do e-mail</span><span class="btn out sm" style="width:36px;padding:0"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="12" r="1.2" fill="currentColor"></circle><circle cx="12" cy="12" r="1.2" fill="currentColor"></circle><circle cx="19" cy="12" r="1.2" fill="currentColor"></circle></svg></span></div></div>
<div class="r g24" style="margin-top: 14px; flex-wrap: wrap; gap: 6px 16px;">
<div class="r g10" style="width:220px"><span class="t13 b6 tab">7 de 12 válidas</span><div class="prog f1"><i style="width:58%"></i></div></div>
<span class="t13 r g6" style="color:var(--u-green)"><span class="dot"></span><b>1 ao vivo</b></span>
<span class="t13 mut">Média de 21 palavras por resposta</span>
<span class="t13 mut">Facilidade 3,6 de 5</span>
</div>
<div class="utabs" style="margin-top:14px"><a>Roteiro</a><a>Campo</a><a class="on">Sessões <span class="n">9</span></a><a>Simuladas <span class="n">3</span></a></div>
</div>
<div class="mbody" style="display: grid; grid-template-columns: minmax(0px, 1fr); gap: 16px; padding: 20px 16px; overflow: hidden;">
<div class="c g12" style="min-width: 0px;">
<div class="r sb"><p class="t18 b6">Achados</p><div class="r g8"><span class="t12 mut">Atualizado há 12 min</span><span class="btn out xs"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M14 3H6a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8z"></path><path d="M14 3v5h5M8 13h8M8 17h5"></path></svg>Report do dia</span></div></div>
<p class="t15" style="max-width:560px">A maioria entende a antecipação, mas só metade percebe que o mesmo Pix já libera a nova compra.</p>
<div class="card c g10" style="padding:16px">
<div class="r sb"><p class="t15 b6">O valor de hoje parece só a parcela, não as duas</p><span class="pill p-bad">5 de 7 sessões</span></div>
<div class="r g4"><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-red); --k: 0;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-red); --k: 1;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-red); --k: 2;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-red); --k: 3;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-red); --k: 4;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-g2); --k: 5;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-g2); --k: 6;" class="lmx-seg"></i></div>
<div class="r g10" style="background: var(--u-g1); border-radius: 12px; padding: 10px; flex-direction: column; align-items: flex-start; gap: 6px;"><span class="mic" style="width:30px;height:30px"><svg class="i" style="width:11px" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4.5v15l12-7.5z" fill="currentColor" stroke="none"></path></svg></span><p class="f1 t13">“Ué, R$ 186? Achei que eram duas parcelas.”</p><span class="t12 mut">Participante 4 · Oferta · 02:14</span></div>
</div>
<div class="card c g10" style="padding:16px">
<div class="r sb"><p class="t15 b6">“Compre” não é lido como uma nova compra</p><span class="pill p-warn">3 de 7 sessões</span></div>
<div class="r g4"><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: rgb(245, 150, 45); --k: 4;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: rgb(245, 150, 45); --k: 5;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: rgb(245, 150, 45); --k: 6;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-g2); --k: 7;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-g2); --k: 8;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-g2); --k: 9;" class="lmx-seg"></i><i style="flex: 1 1 0%; height: 6px; border-radius: 3px; background: var(--u-g2); --k: 10;" class="lmx-seg"></i></div>
<div class="r g10" style="background: var(--u-g1); border-radius: 12px; padding: 10px; flex-direction: column; align-items: flex-start; gap: 6px;"><span class="mic" style="width:30px;height:30px"><svg class="i" style="width:11px" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4.5v15l12-7.5z" fill="currentColor" stroke="none"></path></svg></span><p class="f1 t13">“Compre o quê? Eu já comprei.”</p><span class="t12 mut">Participante 2 · Home · 00:48</span></div>
</div>
<div class="card r g10" style="padding:14px 16px"><svg class="i pk" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8z"></path><path d="M19 15l.7 2 2 .7-2 .7-.7 2-.7-2-2-.7 2-.7z"></path></svg><p class="f1 t13"><b>Só o Lume pegou:</b> duas pessoas tentaram tocar no valor para ver o detalhe.</p></div>
</div>
<div class="card c" style="overflow: hidden; align-self: start; min-width: 0px;">
<div class="r sb" style="padding:12px 14px"><p class="t15 b6">Sessões</p><div class="r g4 t12"><span class="b6">Todas</span><span class="mut">· Válidas</span></div></div>
<div class="r g10" style="padding:10px 14px;border-top:1px solid var(--u-g2);background:var(--u-green-soft)"><span class="dot" style="color:var(--u-green)"></span><div class="f1"><p class="t13 b6">Participante 8</p><p class="t12 mut">06:10 de sessão</p></div><span class="t12 b6" style="color:var(--u-green)">Ao vivo</span></div>
<div class="r g10" style="padding:10px 14px;border-top:1px solid var(--u-g2)"><div class="f1"><p class="t13 b6">Participante 7</p><p class="t12 mut">hoje 13:20 · 24 palavras</p></div><span class="pill p-ok">Válida</span></div>
<div class="r g10" style="padding:10px 14px;border-top:1px solid var(--u-g2)"><div class="f1"><p class="t13 b6">Participante 6</p><p class="t12 mut">hoje 11:05 · 3 palavras</p></div><span class="pill p-bad">Invalidada</span></div>
<div class="r g10" style="padding:10px 14px;border-top:1px solid var(--u-g2)"><div class="f1"><p class="t13 b6">Participante 5</p><p class="t12 mut">ontem 18:40 · 19 palavras</p></div><span class="pill p-ok">Válida</span></div>
<div class="r g10" style="padding:10px 14px;border-top:1px solid var(--u-g2)"><div class="f1"><p class="t13 b6">Ensaio do Matheus</p><p class="t12 mut">ontem 10:12</p></div><span class="pill p-test">Teste</span></div>
<div class="r sb t13" style="padding:12px 14px;border-top:1px solid var(--u-g2)"><span class="b6 pk">Planilha de cupons</span><span class="b6 pk">Sessão humana</span></div>
</div>
</div>
</div>
</div>
<i class="lmx-tap" aria-hidden="true" style="--x:307px;--y:420px;--d:4.4s"></i>
LMX
,
			'P5b' => <<<'LMX'
<div style="margin: 0px; width: 100%; height: 100%; border-radius: 0px; padding: 0px; background: rgb(255, 255, 255); box-shadow: none;"><div style="width: 100%; height: 100%; border-radius: 0px; overflow: hidden;"><div class="proto" style="width: 300px; height: 609px; transform: scale(1.31); transform-origin: 0px 0px;"><div style="height:30px"></div><div class="ph" style="font-size:15px;padding:12px 16px"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M15 6l-6 6 6 6"></path></svg>Antecipar e comprar</div><div style="padding:6px 16px 0;font-size:13px;line-height:18px"><p class="mut">Pague hoje</p><p style="font-size:30px;line-height:36px;font-weight:600">R$ 372,00</p><p class="mut">2 parcelas de R$ 186,00</p><div style="margin-top:18px"><div class="ln" style="padding:11px 0"><span>Parcela 3 · 15/11</span><b>R$ 186,00</b></div><div class="ln" style="padding:11px 0"><span>Parcela 4 · 15/12</span><b>R$ 186,00</b></div><div class="ln" style="padding:11px 0"><span>Libera para nova compra</span><b style="color:#0A7D50">R$ 400,00</b></div></div><div style="margin-top:18px;background:#F5F5FA;border-radius:12px;padding:12px">Pix único: antecipa as duas parcelas e libera limite na hora.</div></div><div style="margin-top:auto;margin:auto 16px 26px;height:46px;border-radius:12px;background:#FF009B;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:15px">Pagar com Pix</div></div></div></div>
<div style="position:absolute;left:12px;right:12px;bottom:28px;background:#fff;border-radius:22px;box-shadow:0 12px 32px -4px rgba(25,45,55,.22),0 0 0 1px rgba(25,45,55,.06);padding:14px 14px 14px" class="c g10"><div class="r g12"><div class="mark" style="width:28px;height:28px;border-radius:9px"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"></path><circle cx="12" cy="12" r="3"></circle></svg></div><p class="t16 b6" style="line-height:22px">Combinado, toca aí onde você disse que ia tocar.</p></div></div>
<i class="lmx-tap" aria-hidden="true" style="--x:170px;--y:351px;--d:2.6s"></i>
LMX
,
		);
	}
	return isset( $s[ $name ] ) ? $s[ $name ] : '';
}

/**
 * Inline style of each mobile screen root (its background).
 */
function sera_lm_screen_style( $name ) {
	$st = array(
		'P1' => 'border-radius: 0px;',
		'P2' => 'border-radius: 0px;',
		'P3' => 'border-radius: 0px;',
		'P4' => 'background: var(--u-navy); color: rgb(255, 255, 255); border-radius: 0px;',
		'P5' => 'background: var(--u-g1); border-radius: 0px;',
		'P6' => 'border-radius: 0px;',
		'P7' => 'border-radius: 0px;',
		'P5b' => 'background: var(--u-g1); border-radius: 0px;',
	);
	return isset( $st[ $name ] ) ? $st[ $name ] : '';
}

/**
 * Desktop screen (1280×800) for a browser frame.
 */
function sera_lm_desk( $name ) {
	return '<div class="lmx lmx-desk">' . sera_lm_screen_html( $name ) . '</div>';
}

/**
 * Mobile screen content for sera_device(), below the theme status bar.
 */
function sera_lm_phone( $name ) {
	$st = sera_lm_screen_style( $name );
	return '<div class="lmx lmx-ph"' . ( $st ? ' style="' . esc_attr( $st ) . '"' : '' ) . '>' . sera_lm_screen_html( $name ) . '</div>';
}
