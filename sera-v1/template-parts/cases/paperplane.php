<?php
/**
 * Case Paperplane Studio: layout próprio (gerado por scratchpad/case3/build.mjs tema; não editar à mão).
 * As telas do estúdio e a home entram como iframes carregados sob demanda de assets/cases/paperplane/.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<script>document.documentElement.classList.add('boot');setTimeout(function(){document.documentElement.classList.remove('boot')},2400);</script>
<article class="pp-case" id="paperplane-case" data-lang="<?php echo esc_attr( sera_lang() ); ?>">
<svg class="sprite" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">
  <defs>
    <symbol id="pp-i-relogio" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8.5"/><path d="M12 7.5V12l3 2"/></symbol>
    <symbol id="pp-i-clique" viewBox="0 0 24 24"><path d="M9.5 8.5 19 12.4l-4.2 1.3-1.4 4.3z"/><path d="M14.8 13.7 19 18"/><path d="M5.2 9.2a4.6 4.6 0 0 1 4-4.1"/><path d="M3 6.6A7.6 7.6 0 0 1 6.7 3"/></symbol>
    <symbol id="pp-i-desfazer" viewBox="0 0 24 24"><path d="M8.5 13.5 4 9l4.5-4.5"/><path d="M4 9h10a5.5 5.5 0 0 1 0 11h-3"/></symbol>
    <symbol id="pp-i-quadro" viewBox="0 0 24 24"><rect x="3" y="4.5" width="18" height="15" rx="2"/><path d="m3 16 5-4.5 4 3.5 3-2.5 6 5"/><circle cx="15.5" cy="9" r="1.5"/></symbol>
    <symbol id="pp-i-placa" viewBox="0 0 24 24"><path d="M12 3v18"/><path d="M12 5.5h6.5L20.5 8l-2 2.5H12"/><path d="M12 12.5H5.5L3.5 15l2 2.5H12"/></symbol>
    <symbol id="pp-i-lista" viewBox="0 0 24 24"><path d="M10 6.5h10M10 12h10M10 17.5h10"/><path d="M4 5.5 5.5 4.5v4"/><path d="M3.8 11.2a1.5 1.5 0 0 1 2.6 1.1L3.8 15h2.8"/><path d="M3.8 17.6h2.6l-1.4 1.6a1.4 1.4 0 1 1-1.2 2.2" opacity="0"/></symbol>
    <symbol id="pp-i-telas" viewBox="0 0 24 24"><rect x="2.5" y="5" width="11" height="8" rx="1.5"/><path d="M6 16.5h4"/><rect x="15" y="4" width="6.5" height="11" rx="1.5"/><rect x="9" y="14.5" width="4.5" height="6" rx="1"/></symbol>
    <symbol id="pp-i-cadeado" viewBox="0 0 24 24"><rect x="5" y="10.5" width="14" height="10" rx="2"/><path d="M8.5 10.5V7.5a3.5 3.5 0 0 1 7 0v3"/><path d="M12 14.5v2"/></symbol>
    <symbol id="pp-i-calendario" viewBox="0 0 24 24"><rect x="3.5" y="5" width="17" height="15.5" rx="2"/><path d="M3.5 10h17M8 3v4M16 3v4"/><path d="M8 14h2M14 14h2M8 17h2"/></symbol>
    <symbol id="pp-i-commit" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3.2"/><path d="M3 12h5.8M15.2 12H21"/></symbol>
    <symbol id="pp-i-merge" viewBox="0 0 24 24"><circle cx="6" cy="5.5" r="2"/><circle cx="6" cy="18.5" r="2"/><circle cx="18" cy="12" r="2"/><path d="M6 7.5v9"/><path d="M6 8.5c0 3 2.5 3.5 5 3.5h5"/></symbol>
    <symbol id="pp-i-escudo" viewBox="0 0 24 24"><path d="M12 3.2 19 6v5.2c0 4.4-3 7.8-7 9.6-4-1.8-7-5.2-7-9.6V6z"/><path d="m9 12 2.2 2.2L15.5 10"/></symbol>
    <symbol id="pp-i-doc" viewBox="0 0 24 24"><path d="M6 3h8.5L18 6.5V21H6z"/><path d="M14 3v4h4"/><path d="M9 11h6M9 14.5h6M9 18h3.5"/></symbol>
    <symbol id="pp-i-camadas" viewBox="0 0 24 24"><path d="m12 3.5-8.5 4.3L12 12l8.5-4.2z"/><path d="m3.5 12 8.5 4.2 8.5-4.2"/><path d="m3.5 16.2 8.5 4.3 8.5-4.3"/></symbol>
    <symbol id="pp-i-lua" viewBox="0 0 24 24"><path d="M19.5 14.6A7.8 7.8 0 0 1 9.4 4.5 7.8 7.8 0 1 0 19.5 14.6z"/></symbol>
    <symbol id="pp-i-cruzar" viewBox="0 0 24 24"><rect x="3" y="5" width="11" height="8.5" rx="1.5"/><rect x="10" y="10.5" width="11" height="8.5" rx="1.5"/></symbol>
    <symbol id="pp-i-caderno" viewBox="0 0 24 24"><rect x="4" y="3" width="12" height="18" rx="1.5"/><path d="M7.5 3v18"/><path d="m18.5 7 1.8 1.8-6 6-2.3.5.5-2.3z"/></symbol>
    <symbol id="pp-i-borracha" viewBox="0 0 24 24"><path d="M8 20h12"/><path d="m4.6 14.8 8.6-8.6a2 2 0 0 1 2.8 0l2.4 2.4a2 2 0 0 1 0 2.8L11.6 18H7.8z"/><path d="m9 10.5 4.8 4.8"/></symbol>
    <symbol id="pp-i-porta" viewBox="0 0 24 24"><path d="M4 21h16"/><path d="M6 21V3.5h10V21"/><path d="M16 3.5 19.5 5v16"/><path d="M13 12.5h.01"/></symbol>
    <symbol id="pp-i-pergunta" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8.5"/><path d="M9.6 9.6a2.5 2.5 0 1 1 3.4 2.3c-.6.3-1 .9-1 1.6v.5"/><path d="M12 16.8h.01"/></symbol>
    <symbol id="pp-i-lupa" viewBox="0 0 24 24"><circle cx="10.5" cy="10.5" r="6"/><path d="m15 15 5 5"/></symbol>
    <symbol id="pp-i-aviao" viewBox="0 0 32 32"><path d="M3 15.5 29 4l-6.5 23-7.2-8.4L3 15.5Z"/><path d="M29 4 15.3 18.6l-1.8 7.9 4-5"/></symbol>
    <symbol id="pp-i-seta" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></symbol>
    <symbol id="pp-i-externa" viewBox="0 0 24 24"><path d="M7 17 17 7M8 7h9v9"/></symbol>
    <symbol id="pp-i-repetir" viewBox="0 0 24 24"><path d="M4 12a8 8 0 0 1 13.7-5.6L20 8.5"/><path d="M20 4v4.5h-4.5"/><path d="M20 12a8 8 0 0 1-13.7 5.6L4 15.5"/><path d="M4 20v-4.5h4.5"/></symbol>
    <symbol id="pp-i-check" viewBox="0 0 24 24"><path d="m5 12.5 4.5 4.5L19 7.5"/></symbol>
    <symbol id="pp-i-play" viewBox="0 0 24 24"><path d="M8 5.5v13l10.5-6.5z"/></symbol>
    <symbol id="pp-i-pessoas" viewBox="0 0 24 24"><circle cx="9" cy="8" r="3.2"/><path d="M3 19.5c.6-3.3 3-5.2 6-5.2s5.4 1.9 6 5.2"/><path d="M14.5 4.9a3.2 3.2 0 0 1 0 6.2"/><path d="M17 14.6c2 .6 3.4 2.3 3.9 4.9"/></symbol>
    <symbol id="pp-i-celular" viewBox="0 0 24 24"><rect x="6.5" y="2.5" width="11" height="19" rx="2.5"/><path d="M10.5 18.5h3"/></symbol>
    <symbol id="pp-i-monitor" viewBox="0 0 24 24"><rect x="2.5" y="4" width="19" height="12.5" rx="1.8"/><path d="M8.5 20.5h7M12 16.5v4"/></symbol>
    <symbol id="pp-i-acesso" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="7.6" r="1.3"/><path d="M7.5 10.4h9M12 10.6v4.2M12 14.8l-2.4 4M12 14.8l2.4 4"/></symbol>
    <symbol id="pp-i-pilula" viewBox="0 0 24 24"><rect x="3" y="14" width="18" height="6" rx="3"/><path d="M7 17h.01M12 17h.01M17 17h.01"/><path d="M6 10.5h12" opacity=".5"/></symbol>
    <symbol id="pp-i-folha" viewBox="0 0 24 24"><rect x="3.5" y="10" width="17" height="11" rx="2.5"/><path d="M10 13h4"/><path d="M12 8V3M9.5 5.5 12 3l2.5 2.5"/></symbol>
    <symbol id="pp-i-token" viewBox="0 0 24 24"><circle cx="7" cy="7" r="3"/><circle cx="17" cy="7" r="3"/><circle cx="7" cy="17" r="3"/><rect x="14" y="14" width="6" height="6" rx="1.5"/></symbol>
    <symbol id="pp-i-ficha" viewBox="0 0 24 24"><rect x="3.5" y="3.5" width="9" height="12" rx="1.5"/><path d="M15.5 7h5M15.5 11h5M15.5 15h3"/><path d="M6 19.5h12" opacity=".6"/></symbol>
    <symbol id="pp-i-pagina" viewBox="0 0 24 24"><rect x="3" y="3.5" width="18" height="17" rx="2"/><path d="M3 8h18"/><path d="M7 12h4v5H7zM14 12h3M14 15h3"/></symbol>
    <symbol id="pp-i-rumo" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8.5"/><path d="m15.5 8.5-2.2 4.8-4.8 2.2 2.2-4.8z"/></symbol>
    <symbol id="pp-i-arrastar" viewBox="0 0 24 24"><path d="m9 6-6 6 6 6M15 6l6 6-6 6"/></symbol>
  </defs>
</svg>

<!-- ============ HERO (claro) ============ -->
<div class="pp-zone" data-theme="light">
<header class="pp-case-hero">
  <div class="pp-hero-in">
    <a class="pp-back-link" href="<?php echo esc_url( home_url( '/#work' ) ); ?>" data-hero><svg class="ico" aria-hidden="true"><use href="#pp-i-seta"/></svg><?php sera_e( 'All work', 'Todos os trabalhos' ); ?></a>
    <p class="pp-case-meta" data-hero><?php sera_e( '<strong>Personal project</strong>', '<strong>Projeto pessoal</strong>' ); ?><span class="sep" aria-hidden="true"></span><?php sera_e( '<span>2026 · in beta</span>', '<span>2026 · em beta</span>' ); ?><span class="sep" aria-hidden="true"></span><?php sera_e( '<span>Product designer · concept, design and agent direction</span>', '<span>Product designer · conceito, design e direção dos agentes</span>' ); ?></p>
    <div class="h1-wrap">
      <h1 class="pp-hero-title"><?php sera_e( 'Paperplane Studio: an AI film studio that shows the', 'Paperplane Studio: um estúdio de cinema com IA que mostra o' ); ?> <span class="kw" id="kw"><?php sera_e( 'price before the click', 'preço antes do clique' ); ?></span></h1>
    </div>
    <p class="pp-lede" data-hero><?php sera_e( 'A sentence goes in, an animated episode comes out, and every click shows its price before it happens. I set the product, the scope and the finish of every screen. A team of AI agents built it under my direction, in 23 days.', 'Uma frase entra, um episódio animado sai, e cada clique mostra o preço antes de acontecer. Defini o produto, o escopo e o padrão de acabamento de cada tela. Quem construiu foi uma equipe de agentes de IA, sob a minha direção, em 23 dias.' ); ?></p>
    <ul class="pp-chips" data-hero aria-label="<?php echo esc_attr( sera_t( 'Tags', 'Etiquetas' ) ); ?>">
      <li class="pp-chip"><?php sera_e( 'Personal project', 'Projeto pessoal' ); ?></li><li class="pp-chip"><?php sera_e( 'Generative AI', 'IA generativa' ); ?></li><li class="pp-chip">Design system</li><li class="pp-chip"><?php sera_e( 'In beta', 'Em beta' ); ?></li>
    </ul>
  </div>
  <dl class="pp-metrics" data-hero>
    <div class="pp-metric"><dt class="visually-hidden"><?php sera_e( 'Duration', 'Duração' ); ?></dt><dd><b><span class="pp-odo" data-odo="23">23</span> <?php sera_e( 'days', 'dias' ); ?></b><?php sera_e( '<span>from the first screen to a complete studio, with editing and billing</span>', '<span>da primeira tela a um estúdio completo, com montagem e cobrança</span>' ); ?></dd></div>
    <div class="pp-metric"><dt class="visually-hidden"><?php sera_e( 'Steps', 'Etapas' ); ?></dt><dd><b><span class="pp-odo" data-odo="10">10</span> <?php sera_e( 'steps', 'etapas' ); ?></b><?php sera_e( '<span>from sentence to episode, as on a real film set</span>', '<span>da frase ao episódio, como num set de verdade</span>' ); ?></dd></div>
    <div class="pp-metric"><dt class="visually-hidden"><?php sera_e( 'Product decisions', 'Decisões de produto' ); ?></dt><dd><b><span class="pp-odo" data-odo="35">35</span> <?php sera_e( 'decisions', 'decisões' ); ?></b><?php sera_e( '<span>on the product, numbered and dated, all mine</span>', '<span>de produto, numeradas e datadas, todas minhas</span>' ); ?></dd></div>
    <div class="pp-metric"><dt class="visually-hidden"><?php sera_e( 'Media without a click', 'Mídia sem clique' ); ?></dt><dd><?php sera_e( '<b>Zero</b><span>media generated without the person’s click</span>', '<b>Zero</b><span>mídia gerada sem o clique da pessoa</span>' ); ?></dd></div>
  </dl>
  <div class="pp-wide pp-hero-shot-wrap palco" data-tema="escuro">
    <figure class="pp-hero-shot">
      <div class="pp-browser hero-browser">
        <div class="pp-browser-bar" aria-hidden="true"><span class="pp-dots"><i></i><i></i><i></i></span><span class="pp-url">beta.paperplanestudio.app</span><span></span></div>
        <div class="sim" data-tela="inicio" data-roteiro="inicio" data-tema="escuro" data-cursor-nativo role="img" aria-label="<?php echo esc_attr( sera_t( 'Paperplane Studio home, dark theme: pick up where I left off, episode progress at 8 of 10 steps, your stories and the balance told in minutes of video.', 'Início do Paperplane Studio, tema escuro: continuar de onde parei, progresso do episódio em 8 de 10 etapas, suas histórias e o saldo dito em minutos de vídeo.' ) ); ?>">
          <noscript><p class="sim-alt">Início do estúdio: "Continuar de onde parei" com a tomada 3A, o progresso do episódio em 8 de 10 etapas, a lista "Suas histórias" e o cartão "Seus créditos rendem", que diz quanto vídeo o saldo ainda faz.</p></noscript>
        </div>
      </div>
      <figcaption class="pp-cap"><?php sera_e( 'Real product screen', 'Tela real do produto' ); ?></figcaption>
    </figure>
  </div>
</header>

<div class="pp-col">
  <div class="pp-glance-block pp-reveal">
    <dl class="pp-glance">
      <div><dt><?php sera_e( 'Company', 'Empresa' ); ?></dt><dd><?php sera_e( 'Personal project', 'Projeto pessoal' ); ?></dd></div>
      <div><dt><?php sera_e( 'Role', 'Papel' ); ?></dt><dd><?php sera_e( 'Product designer · concept, design and agent direction', 'Product designer · conceito, design e direção dos agentes' ); ?></dd></div>
      <div><dt><?php sera_e( 'Year', 'Ano' ); ?></dt><dd><?php sera_e( '2026 · in beta', '2026 · em beta' ); ?></dd></div>
      <div><dt><?php sera_e( 'Type', 'Tipo' ); ?></dt><dd><?php sera_e( 'My own product, from scratch: studio, design system and website', 'Produto próprio, do zero: estúdio, design system e site' ); ?></dd></div>
      <div><dt><?php sera_e( 'Duration', 'Duração' ); ?></dt><dd><?php sera_e( '23 days, 19 Oct to 11 Nov 2026', '23 dias, de 19/10 a 11/11/2026' ); ?></dd></div>
      <div><dt><?php sera_e( 'Platform', 'Plataforma' ); ?></dt><dd><?php sera_e( 'Web, in the browser (desktop, tablet and phone), plus the public website', 'Web, no navegador (computador, tablet e celular), mais o site público' ); ?></dd></div>
    </dl>
    <div class="pp-glance-did">
      <span class="pp-art-label"><?php sera_e( 'What I did', 'O que eu fiz' ); ?></span>
      <ul>
        <li><?php sera_e( 'Product and a 10-step flow', 'Produto e fluxo de 10 etapas' ); ?></li><li><?php sera_e( 'Redesign "Simple outside, advanced inside"', 'Redesign "Simples por fora, avançado por dentro"' ); ?></li><li><?php sera_e( 'Dobra, the design system', 'Dobra, o design system' ); ?></li><li><?php sera_e( 'Microinteractions', 'Microinterações' ); ?></li><li><?php sera_e( 'Website, /founders and waiting list', 'Site, /founders e lista de espera' ); ?></li><li><?php sera_e( 'Direction of the agent team', 'Direção da equipe de agentes' ); ?></li><li><?php sera_e( 'Nightly roadmap curation', 'Curadoria noturna do roadmap' ); ?></li>
      </ul>
    </div>
  </div>
</div>

<!-- ============ TESE ============ -->
<section class="pp-thesis" aria-label="<?php echo esc_attr( sera_t( 'The thesis', 'A tese' ) ); ?>">
  <div class="pp-wide">
    <p class="pp-thesis-line"><?php sera_e( 'AI wrote the code. The vision, the scope and every detail that makes Paperplane feel simple and well finished came from my decisions.', 'A IA escreveu o código. A visão, o escopo e cada detalhe que faz o Paperplane parecer simples e bem acabado saíram das minhas decisões.' ); ?></p>
  </div>
</section>

<!-- ============ 01 CENÁRIO ============ -->
<section class="pp-chapter" id="cenario" aria-labelledby="cenario-t">
  <div class="pp-col">
    <p class="pp-kicker"><?php sera_e( '01 · The landscape', '01 · O cenário' ); ?></p>
    <h2 class="pp-chapter-title" id="cenario-t"><?php sera_e( 'Making an episode with AI today means directing with six tabs open and the bill in the dark.', 'Fazer um episódio com IA hoje é dirigir com seis abas abertas e a fatura no escuro.' ); ?></h2>
    <p class="pp-lead pp-reveal"><?php sera_e( 'Anyone who has tried to make animation with AI knows the scene. One tab for the image, another for the video, another for the voice, and a spreadsheet to remember how much has gone.', 'Quem tenta fazer animação com IA conhece a cena. Uma aba para a imagem, outra para o vídeo, outra para a voz e uma planilha para lembrar quanto já foi.' ); ?></p>
    <p class="pp-reveal"><?php sera_e( 'The prompt is written in English, copied from a tutorial. Every attempt costs money, and the price only shows up afterwards. The character with short hair in scene 1 comes back with a fringe in scene 2. And the total arrives at the end of the month, on the card statement.', 'O prompt sai em inglês, copiado de um tutorial. Cada tentativa custa, e o preço só aparece depois. O personagem que tinha cabelo curto na cena 1 volta de franja na cena 2. E o total da brincadeira chega no fim do mês, na fatura do cartão.' ); ?></p>
    <p class="pp-reveal"><?php sera_e( 'Somewhere in all that, the story gets lost. Someone who wanted to direct spends the day operating tools: copy, paste, translate, wait in the queue, download, upload again. An idea that fitted in one sentence becomes a folder of files with names like "final_v3".', 'No meio disso tudo, a história se perde. Quem queria dirigir passa o dia como operador de ferramenta: copia, cola, traduz, espera na fila, baixa, sobe de novo. A ideia que cabia numa frase vira uma pasta de arquivos com nomes como "final_v3".' ); ?></p>
    <p class="pp-reveal"><?php sera_e( '<strong>Paperplane brings that whole desk into a single screen, in the order of a shoot, and puts the price on every button.</strong>', '<strong>O Paperplane junta essa mesa inteira numa tela só, na ordem de uma filmagem, e põe o preço em cada botão.</strong>' ); ?></p>
  </div>

  <div class="pp-wide mesa-art">
    <div class="pp-mesa" data-estado="1" data-tema="claro">
      <div class="mesa-janelas" role="group" aria-label="<?php echo esc_attr( sera_t( 'Before: six tools open, each with its own bill', 'Antes: seis ferramentas abertas, cada uma com a sua conta' ) ); ?>">
        <div class="jan jan-1" style="--x:2%;--y:6%;--r:-4deg;--w:30%"><div class="jan-bar"><?php sera_e( '<i></i><i></i><i></i><span>image generator</span>', '<i></i><i></i><i></i><span>gerador de imagem</span>' ); ?></div><div class="jan-c"><ul class="rostos" data-ficha aria-label="<?php echo esc_attr( sera_t( 'Four similar faces, none the same', 'Quatro rostos parecidos, nenhum igual' ) ); ?>"><li style="--c:#C7B9A5;--h:44%"></li><li style="--c:#B6A48E;--h:58%"></li><li style="--c:#D1C1AB;--h:36%"></li><li style="--c:#A99680;--h:66%"></li></ul><span class="jan-selo"><?php sera_e( 'attempt 7', 'tentativa 7' ); ?></span></div></div>
        <div class="jan jan-2" style="--x:35%;--y:2%;--r:2.5deg;--w:30%"><div class="jan-bar"><?php sera_e( '<i></i><i></i><i></i><span>video generator</span>', '<i></i><i></i><i></i><span>gerador de vídeo</span>' ); ?></div><div class="jan-c"><div class="pp-prog"><i style="width:63%"></i></div><p class="jan-t"><?php sera_e( '<b>63%</b> processing', '<b>63%</b> processando' ); ?></p><span class="jan-selo"><?php sera_e( 'queue: 14 min', 'fila: 14 min' ); ?></span></div></div>
        <div class="jan jan-3" style="--x:68%;--y:8%;--r:-1.5deg;--w:30%"><div class="jan-bar"><?php sera_e( '<i></i><i></i><i></i><span>voice</span>', '<i></i><i></i><i></i><span>voz</span>' ); ?></div><div class="jan-c"><svg class="pp-onda" viewBox="0 0 160 36" aria-hidden="true"><path d="M2 18h6M12 10v16M18 4v28M24 12v12M30 7v22M36 14v8M42 9v18M48 2v32M54 11v14M60 16v4M66 8v20M72 13v10M78 5v26M84 15v6M90 10v16M96 18h6M106 12v12M112 6v24M118 14v8M124 9v18M130 16v4M136 11v14M142 18h14"/></svg><p class="jan-t"><?php sera_e( 'which voice was Maria’s?', 'qual era a voz da Maria?' ); ?></p></div></div>
        <div class="jan jan-4" style="--x:5%;--y:52%;--r:3deg;--w:32%"><div class="jan-bar"><i></i><i></i><i></i><span>editor</span></div><div class="jan-c"><div class="pp-clipes"><i style="--w:18%"></i><i style="--w:31%"></i><i style="--w:9%"></i><i style="--w:24%"></i><i style="--w:14%"></i></div><div class="pp-clipes clipes-2"><i style="--w:40%"></i><i style="--w:12%"></i></div><span class="jan-selo"><?php sera_e( 'clip_final_v3_this_time.mp4', 'clipe_final_v3_agora_vai.mp4' ); ?></span></div></div>
        <div class="jan jan-5" style="--x:39%;--y:50%;--r:-3deg;--w:27%"><div class="jan-bar"><?php sera_e( '<i></i><i></i><i></i><span>spending sheet</span>', '<i></i><i></i><i></i><span>planilha de gastos</span>' ); ?></div><div class="jan-c"><table class="pp-plan"><thead><tr><th><?php sera_e( 'scene', 'cena' ); ?></th><th><?php sera_e( 'how much?', 'quanto foi?' ); ?></th></tr></thead><tbody><tr><td>1</td><td>?</td></tr><tr><td>2</td><td>?</td></tr><tr><td>3</td><td>?</td></tr></tbody></table></div></div>
        <div class="jan jan-6" style="--x:68%;--y:54%;--r:2deg;--w:30%"><div class="jan-bar"><?php sera_e( '<i></i><i></i><i></i><span>prompt in English</span>', '<i></i><i></i><i></i><span>prompt em inglês</span>' ); ?></div><div class="jan-c"><p class="prompt">a woman with short hair, same as before, PLEASE same face</p></div></div>
        <div class="pp-notif" role="note"><span class="pp-notif-app" aria-hidden="true">L</span><span class="pp-notif-corpo"><span class="pp-notif-topo"><b>Lowfield</b><time><?php sera_e( 'now', 'agora' ); ?></time></span><span class="pp-notif-msg"><?php sera_e( 'Oops, looks like you maxed out your card buying credits this month.', 'Ops, parece que você estourou o cartão comprando créditos esse mês.' ); ?></span><span class="pp-notif-valor"><?php sera_e( 'R$ 48,730.00', 'R$ 48.730,00' ); ?></span></span></div>
      </div>
      <div class="mesa-estudio">
        <div class="pp-browser">
          <div class="pp-browser-bar" aria-hidden="true"><span class="pp-dots"><i></i><i></i><i></i></span><span class="pp-url">Paperplane Studio</span><span></span></div>
          <div class="sim" data-tela="storyboard-basico" data-roteiro="storyboard-basico" data-tema="escuro" data-cursor-nativo role="img" aria-label="<?php echo esc_attr( sera_t( 'After: a single studio screen, the Storyboard for scene 3 with the Write, Visualise and Shoot groups in the menu, the frames with Lia and Dante, and the balance told in minutes of video.', 'Depois: uma tela só do estúdio, o Storyboard da cena 3 com os grupos Escrever, Visualizar e Filmar no menu, os quadros com a Lia e o Dante e o saldo dito em minutos de vídeo.' ) ); ?>">
            <noscript><p class="sim-alt">Depois: o Storyboard do estúdio numa tela só, com Escrever, Visualizar e Filmar no menu, um quadro por tomada e o preço no botão.</p></noscript>
          </div>
        </div>
      </div>
    </div>
    <div class="mesa-pe">
      <p class="mesa-leg" aria-live="polite"><span class="leg leg-1"><?php sera_e( 'Six tools, six bills, and none of them knows what the others did.', 'Seis ferramentas, seis contas, nenhuma sabe o que a outra fez.' ); ?></span><span class="leg leg-2"><?php sera_e( 'One screen, one story, the price on the button.', 'Uma tela, uma história, o preço no botão.' ); ?></span></p>
      <button type="button" class="mesa-replay" aria-label="<?php echo esc_attr( sera_t( 'Watch the fold again', 'Ver a dobra de novo' ) ); ?>"><svg class="ico" aria-hidden="true"><use href="#pp-i-repetir"/></svg><?php sera_e( '<span>Watch again</span>', '<span>Ver de novo</span>' ); ?></button>
    </div>
  </div>

  <div class="pp-wide">
    <ol class="dores" aria-label="<?php echo esc_attr( sera_t( 'Pains and answers', 'Dores e respostas' ) ); ?>">
      <li><span class="dor"><?php sera_e( 'Six tabs for one minute of film.', 'Seis abas para um minuto de filme.' ); ?></span><svg class="ico seta" aria-hidden="true"><use href="#pp-i-seta"/></svg><span class="resp"><?php sera_e( 'Ten steps on one screen, in the order of a set.', 'Dez etapas numa tela só, na ordem do set.' ); ?></span></li>
      <li><span class="dor"><?php sera_e( 'Prompts in English, copied from tutorials.', 'Prompt em inglês, copiado de tutorial.' ); ?></span><svg class="ico seta" aria-hidden="true"><use href="#pp-i-seta"/></svg><span class="resp"><?php sera_e( 'You write in your own language and mention <code>@Maria</code>.', 'Você escreve em português e menciona <code>@Maria</code>.' ); ?></span></li>
      <li><span class="dor"><?php sera_e( 'The face changes from one scene to the next.', 'O rosto muda de uma cena para a outra.' ); ?></span><svg class="ico seta" aria-hidden="true"><use href="#pp-i-seta"/></svg><span class="resp"><?php sera_e( 'Each character has an approved sheet and comes back the same.', 'Cada personagem tem ficha aprovada e volta igual.' ); ?></span></li>
      <li><span class="dor"><?php sera_e( 'The cost only shows up on the statement.', 'O custo aparece só na fatura.' ); ?></span><svg class="ico seta" aria-hidden="true"><use href="#pp-i-seta"/></svg><span class="resp"><?php sera_e( 'The price is on the button, before the click.', 'O preço aparece no botão, antes do clique.' ); ?></span></li>
    </ol>
  </div>
</section>
</div>

<!-- ============ SALA ESCURA ============ -->
<div class="pp-zone" data-theme="dark">

<!-- 02 PRODUTO -->
<section class="pp-chapter" id="produto" aria-labelledby="produto-t">
  <div class="pp-col">
    <p class="pp-kicker"><?php sera_e( '02 · The product', '02 · O produto' ); ?></p>
    <h2 class="pp-chapter-title" id="produto-t"><?php sera_e( 'From sentence to episode in ten steps any film set would recognise.', 'Da frase ao episódio em dez etapas que qualquer set de filmagem reconhece.' ); ?></h2>
    <p class="pp-lead pp-reveal"><?php sera_e( 'I laid the studio out in the order of a real production. Write, Visualise, Shoot. Each screen asks for one thing.', 'Montei o estúdio na ordem de uma produção de verdade. Escrever, Visualizar, Filmar. Cada tela pede uma coisa só.' ); ?></p>
    <p class="pp-reveal"><?php sera_e( 'The order is what keeps things consistent. Characters and locations get an approved sheet before the storyboard, and that sheet goes with every frame. The shot breakdown comes after them on purpose: breaking down a scene means planning the camera, and Origami, the studio’s AI assistant, only picks the right shot when it knows the cast and the places.', 'A ordem é o segredo da continuidade. Personagens e cenários ganham ficha aprovada antes do storyboard, e essa ficha vai junto em cada quadro. A Decupagem vem depois deles de propósito: decupar é planejar a câmera, e o Origami, o assistente de IA do estúdio, só escolhe bem o plano quando conhece o elenco e os lugares.' ); ?></p>
    <p class="pp-reveal"><?php sera_e( 'The vocabulary comes from the set too: take, shot, breakdown. Every screen has a short title, one sentence explaining why, and one main button. Even the names were chosen: "universe" instead of "bible", so the series doesn’t carry a religious term.', 'O vocabulário também é de set: tomada, plano, decupagem. Cada tela tem um título curto, uma frase que explica o porquê e um botão principal. Até os nomes foram escolhidos: "universo", no lugar de "bíblia", para a série não ganhar termo religioso.' ); ?></p>
  </div>

  <div class="etapas-sec">
    <div class="etapas pp-wide">
      <div class="etapas-lado">
        <ol class="grupos" aria-label="<?php echo esc_attr( sera_t( 'Step groups', 'Grupos de etapas' ) ); ?>">
          <li data-g="0"><span class="g-n">01</span> <?php sera_e( 'Write', 'Escrever' ); ?><i class="g-bar" aria-hidden="true"><i></i></i></li>
          <li data-g="1"><span class="g-n">02</span> <?php sera_e( 'Visualise', 'Visualizar' ); ?><i class="g-bar" aria-hidden="true"><i></i></i></li>
          <li data-g="2"><span class="g-n">03</span> <?php sera_e( 'Shoot', 'Filmar' ); ?><i class="g-bar" aria-hidden="true"><i></i></i></li>
        </ol>
        <ol class="etapas-lista">
          <li data-g="0" data-tela="ideia" data-roteiro="ideia"><button type="button" class="et-b"><span class="et-n">01</span><span class="et-t"><?php sera_e( 'Idea', 'Ideia' ); ?></span></button><p><?php sera_e( 'Start with a sentence. The rest appears as the script grows.', 'Comece com uma frase. O resto aparece enquanto o roteiro cresce.' ); ?></p></li>
          <li data-g="0" data-tela="universo" data-roteiro="universo"><button type="button" class="et-b"><span class="et-n">02</span><span class="et-t"><?php sera_e( 'Universe', 'Universo' ); ?></span></button><p><?php sera_e( 'Set what is true in this world. Origami checks it first.', 'Defina o que é verdade nesse mundo. O Origami consulta antes.' ); ?></p></li>
          <li data-g="0" data-tela="roteiro" data-roteiro="roteiro"><button type="button" class="et-b"><span class="et-n">03</span><span class="et-t"><?php sera_e( 'Script', 'Roteiro' ); ?></span></button><p><?php sera_e( 'Write with Origami completing at the cursor.', 'Escreva com o Origami completando no ponto do cursor.' ); ?></p></li>
          <li data-g="1" data-tela="estilo" data-roteiro="estilo"><button type="button" class="et-b"><span class="et-n">04</span><span class="et-t"><?php sera_e( 'Visual style', 'Estilo visual' ); ?></span></button><p><?php sera_e( 'Pick a style and keep it from the first frame to the last.', 'Escolha um traço e mantenha do primeiro ao último quadro.' ); ?></p></li>
          <li data-g="1" data-tela="personagem-ficha" data-roteiro="personagem-ficha"><button type="button" class="et-b"><span class="et-n">05</span><span class="et-t"><?php sera_e( 'Characters and voices', 'Personagens e vozes' ); ?></span></button><p><?php sera_e( 'Create each character once, with a face and a voice.', 'Crie cada personagem uma vez, com rosto e voz.' ); ?></p></li>
          <li data-g="1" data-tela="cenarios" data-roteiro="cenarios"><button type="button" class="et-b"><span class="et-n">06</span><span class="et-t"><?php sera_e( 'Locations', 'Cenários' ); ?></span></button><p><?php sera_e( 'Build each place from a wide, empty view.', 'Erga cada lugar a partir de uma vista aberta e vazia.' ); ?></p></li>
          <li data-g="1" data-tela="decupagem" data-roteiro="decupagem"><button type="button" class="et-b"><span class="et-n">07</span><span class="et-t"><?php sera_e( 'Shot breakdown', 'Decupagem' ); ?></span></button><p><?php sera_e( 'Break each scene into takes, with shot and camera chosen.', 'Quebre cada cena em tomadas, com plano e câmera escolhidos.' ); ?></p></li>
          <li data-g="1" data-tela="storyboard-basico" data-roteiro="storyboard-basico"><button type="button" class="et-b"><span class="et-n">08</span><span class="et-t">Storyboard</span></button><p><?php sera_e( 'Approve one image per take before paying for video.', 'Aprove uma imagem por tomada antes de pagar por vídeo.' ); ?></p></li>
          <li data-g="2" data-tela="movimento" data-roteiro="movimento"><button type="button" class="et-b"><span class="et-n">09</span><span class="et-t"><?php sera_e( 'Motion', 'Movimento' ); ?></span></button><p><?php sera_e( 'Animate the approved image. Generate, watch, approve.', 'Anime a imagem aprovada. Gere, assista, aprove.' ); ?></p></li>
          <li data-g="2" data-tela="montagem" data-roteiro="montagem"><button type="button" class="et-b"><span class="et-n">10</span><span class="et-t"><?php sera_e( 'Edit', 'Montagem' ); ?></span></button><p><?php sera_e( 'Cut, add effects and transitions, export the episode.', 'Corte, aplique efeitos e transições, exporte o episódio.' ); ?></p></li>
        </ol>
      </div>
      <div class="etapas-moldura palco" data-tema="escuro">
        <div class="pp-browser">
          <div class="pp-browser-bar" aria-hidden="true"><span class="pp-dots"><i></i><i></i><i></i></span><span class="pp-url">beta.paperplanestudio.app</span><span class="et-cont" aria-hidden="true">01 / 10</span></div>
          <div class="palco-etapas" data-tema="escuro" data-cursor-nativo role="img" aria-label="<?php echo esc_attr( sera_t( 'The current studio step, which changes as you read.', 'A etapa atual do estúdio, que troca conforme a leitura.' ) ); ?>">
            <noscript><p class="sim-alt">Sem JavaScript, as telas das etapas não aparecem. A lista ao lado descreve cada uma.</p></noscript>
          </div>
        </div>
      </div>
    </div>
    <p class="pp-col etapas-pe"><?php sera_e( 'Outside the steps: Home, Explore (a free canvas for trying ideas) and the take editor.', 'Fora das etapas: Início, Explorar (um canvas livre para testar ideias) e o editor de tomada.' ); ?></p>
  </div>
</section>

<!-- 03 PREÇO -->
<section class="pp-chapter" id="preco" aria-labelledby="preco-t">
  <div class="pp-col">
    <p class="pp-kicker"><?php sera_e( '03 · The price before the click', '03 · O preço antes do clique' ); ?></p>
    <h2 class="pp-chapter-title" id="preco-t"><?php sera_e( 'Every click costs money. So the price arrives before the click.', 'Cada clique custa dinheiro. Por isso o preço chega antes do clique.' ); ?></h2>
    <p class="pp-lead pp-reveal"><?php sera_e( 'This decision holds all the others up. A video generator charges per attempt, and an assistant acting on its own can quietly burn through someone’s balance.', 'Essa decisão segura todas as outras. Um gerador de vídeo cobra por tentativa, e um assistente que age sozinho pode queimar o saldo de alguém em silêncio.' ); ?></p>
    <p class="pp-reveal"><?php sera_e( 'I designed four rules so that <strong>no credit leaves without a clear gesture</strong>. They apply across the whole studio, Origami included, and no change goes live if it breaks one of them.', 'Desenhei quatro regras para que <strong>nenhum crédito saia sem um gesto claro</strong>. Elas valem no estúdio inteiro, inclusive para o Origami, e nenhuma mudança vai ao ar se quebrar uma delas.' ); ?></p>
  </div>

  <div class="pp-wide pp-deck">
    <article class="pp-regra" data-stack-card data-art="saldo">
      <div class="regra-txt">
        <div class="regra-cab"><span class="regra-n">01</span></div>
        <h3><?php sera_e( 'A balance counted in minutes', 'Saldo contado em minutos' ); ?></h3>
        <p class="regra-prob"><?php sera_e( '<span>Problem</span>Credits are an abstract currency. Nobody knows whether a balance is a lot or a little.', '<span>Problema</span>Crédito é moeda abstrata. Ninguém sabe se o saldo é muito ou pouco.' ); ?></p>
        <p class="regra-dec"><?php sera_e( 'The balance says how much video it still buys, as an estimate, at the chosen quality. At zero the sentence disappears; it never shows "0 s".', 'O saldo diz quanto vídeo ainda rende, como estimativa, na qualidade escolhida. Com saldo zero a frase some, nunca mostra "0 s".' ); ?></p>
        <p class="ui-recorte"><span class="ui-k"><?php sera_e( 'From the interface', 'Da interface' ); ?></span><?php sera_e( 'Your balance buys ≈ X at this quality.', 'Seu saldo rende ≈ X nesta qualidade.' ); ?></p>
      </div>
      <div class="regra-art pp-micro art-saldo" data-theme="dark" aria-label="<?php echo esc_attr( sera_t( 'Balance ring: how much video the balance still buys at each quality', 'Anel de saldo: quanto vídeo o saldo ainda rende em cada qualidade' ) ); ?>" role="group">
        <div class="anel-g">
          <svg viewBox="0 0 200 200" aria-hidden="true"><circle class="ag-bg" cx="100" cy="100" r="84"/><circle class="ag-fg" cx="100" cy="100" r="84" pathLength="100"/></svg>
          <div class="ag-c"><span class="ag-k"><?php sera_e( 'Your balance buys', 'Seu saldo rende' ); ?></span><b class="ag-v" aria-live="polite"><span class="ag-aprox">≈</span> 1 min 3 s</b><span class="ag-s"><?php sera_e( 'of video', 'de vídeo' ); ?></span></div>
        </div>
        <div class="qual" role="radiogroup" aria-label="<?php echo esc_attr( sera_t( 'Quality', 'Qualidade' ) ); ?>">
          <button type="button" role="radio" aria-checked="false" data-min="4 min 10 s" data-p="100"><?php sera_e( 'Economy', 'Econômico' ); ?></button>
          <button type="button" role="radio" aria-checked="true" data-min="1 min 3 s" data-p="25"><?php sera_e( 'Balanced', 'Equilibrado' ); ?></button>
          <button type="button" role="radio" aria-checked="false" data-min="38 s" data-p="15">Pro</button>
        </div>
      </div>
    </article>
    <article class="pp-regra regra--inv" data-stack-card data-art="botao">
      <div class="regra-txt">
        <div class="regra-cab"><span class="regra-n">02</span></div>
        <h3><?php sera_e( 'Media only comes out with a click', 'Mídia só sai com clique' ); ?></h3>
        <p class="regra-prob"><?php sera_e( '<span>Problem</span>An assistant that generates on its own initiative spends someone else’s money.', '<span>Problema</span>Um assistente que gera por iniciativa própria gasta o dinheiro de outra pessoa.' ); ?></p>
        <p class="regra-dec"><?php sera_e( 'The click is the consent, and the button carries the estimated price. I turned down an automatic mode with a spending cap because it broke this rule.', 'O clique é o consentimento, e o botão traz o preço estimado. Recusei um modo automático com teto porque ele quebrava essa regra.' ); ?></p>
        <p class="ui-recorte"><span class="ui-k"><?php sera_e( 'From the interface', 'Da interface' ); ?></span><?php sera_e( 'Draw · ≈ N · holds up to N credits', 'Desenhar · ≈ N · reserva até N créditos' ); ?></p>
      </div>
      <div class="regra-art pp-micro art-botao" data-theme="dark" role="group" aria-label="<?php echo esc_attr( sera_t( 'Lime button with the price on its badge', 'Botão limão com o preço no selo' ) ); ?>">
        <span class="art-saldo-slot"></span>
        <div class="bt-palco"><span class="bt-slot"></span></div>
        <p class="art-nota" aria-live="polite"><?php sera_e( 'Hover over the button and click.', 'Passe o mouse no botão e clique.' ); ?></p>
      </div>
    </article>
    <article class="pp-regra" data-stack-card data-art="falha">
      <div class="regra-txt">
        <div class="regra-cab"><span class="regra-n">03</span></div>
        <h3><?php sera_e( 'If it fails, the credit comes back', 'Falhou, o crédito volta' ); ?></h3>
        <p class="regra-prob"><?php sera_e( '<span>Problem</span>With AI, a request can fail at the provider. Charging for that destroys trust.', '<span>Problema</span>Em IA o pedido pode falhar no provedor. Cobrar por isso destrói a confiança.' ); ?></p>
        <p class="regra-dec"><?php sera_e( 'The credit is held while generating and comes back if there is an error. A finished result is charged, and the interface says so plainly.', 'O crédito fica reservado durante a geração e volta se der erro. Resultado concluído consome, e a interface diz isso com todas as letras.' ); ?></p>
        <p class="ui-recorte"><span class="ui-k"><?php sera_e( 'From the interface', 'Da interface' ); ?></span><?php sera_e( 'A technical failure costs no credit; a finished result is charged, even if you don’t like it.', 'Falha técnica não gasta crédito; resultado concluído consome, mesmo que não agrade.' ); ?></p>
      </div>
      <div class="regra-art pp-micro art-falha" data-theme="dark" role="group" aria-label="<?php echo esc_attr( sera_t( 'Held, failed, returned', 'Reservado, falhou, devolvido' ) ); ?>">
        <div class="fl-topo"><span class="art-saldo-slot"></span><span class="bt-slot"></span></div>
        <ol class="faixa">
          <li data-p="reservado"><?php sera_e( '<i></i>Held', '<i></i>Reservado' ); ?></li>
          <li data-p="falhou"><?php sera_e( '<i></i>Failed', '<i></i>Falhou' ); ?></li>
          <li data-p="devolvido"><?php sera_e( '<i></i>Returned', '<i></i>Devolvido' ); ?></li>
        </ol>
        <button type="button" class="art-de-novo"><?php sera_e( 'Watch again', 'Ver de novo' ); ?></button>
      </div>
    </article>
    <article class="pp-regra regra--inv" data-stack-card data-art="quadro">
      <div class="regra-txt">
        <div class="regra-cab"><span class="regra-n">04</span></div>
        <h3><?php sera_e( 'Image first, video after', 'Imagem primeiro, vídeo depois' ); ?></h3>
        <p class="regra-prob"><?php sera_e( '<span>Problem</span>Redoing a video is the most expensive way to get it wrong.', '<span>Problema</span>Refazer um vídeo é o jeito mais caro de errar.' ); ?></p>
        <p class="regra-dec"><?php sera_e( 'Every take is approved as an image before it is animated. Only the approved frame becomes the first frame of the video.', 'Cada tomada é aprovada como imagem antes de animar. Só o quadro aprovado vira o primeiro quadro do vídeo.' ); ?></p>
        <p class="ui-recorte"><span class="ui-k"><?php sera_e( 'From the interface', 'Da interface' ); ?></span><?php sera_e( 'Images are cheap; video isn’t. Approve here before animating.', 'Imagem é barata; vídeo não. Aprove aqui antes de animar.' ); ?></p>
      </div>
      <div class="regra-art pp-micro art-quadro" data-theme="dark" role="group" aria-label="<?php echo esc_attr( sera_t( 'The approved frame becomes the video take', 'Quadro aprovado vira o take de vídeo' ) ); ?>">
        <div class="aq-trilho">
          <figure class="aq-quadro"><img data-midia="pg/quadro-take.webp" data-midia-reserva="sim/52cb6968df.webp" alt="<?php echo esc_attr( sera_t( 'An approved storyboard frame, which becomes the first frame of the video.', 'Quadro aprovado do storyboard, que vira o primeiro quadro do vídeo.' ) ); ?>" width="320" height="180"><span class="aq-cod">3C</span><span class="aq-ok" aria-hidden="true"><svg class="ico" aria-hidden="true"><use href="#pp-i-check"/></svg></span></figure>
          <div class="aq-take" aria-hidden="true"><span class="aq-tk">Take #1.0</span><span class="aq-play"><svg class="ico"><use href="#pp-i-play"/></svg></span></div>
        </div>
        <div class="aq-acoes"><span class="aq-pill"><?php sera_e( 'Awaiting approval', 'Para aprovar' ); ?></span><button type="button" class="pp-btn a sm aq-aprovar"><?php sera_e( 'Approve', 'Aprovar' ); ?></button></div>
        <p class="art-nota" aria-live="polite"></p>
      </div>
    </article>
  </div>
</section>

<!-- 04 REDESIGN -->
<section class="pp-chapter" id="redesign" aria-labelledby="redesign-t">
  <div class="pp-col">
    <p class="pp-kicker"><?php sera_e( '04 · The redesign', '04 · O redesign' ); ?></p>
    <h2 class="pp-chapter-title" id="redesign-t"><?php sera_e( 'Simple outside, advanced inside.', 'Simples por fora, avançado por dentro.' ); ?></h2>
    <p class="pp-lead pp-reveal"><?php sera_e( 'Five days in, the studio was growing by accumulation and every screen had a different skeleton. On 24 October I stopped and redesigned everything around four rules, so that a first-time visitor finishes a step without opening anything and a professional still finds everything they need inside.', 'Cinco dias depois do começo, o estúdio crescia por acúmulo e cada tela tinha um esqueleto diferente. Em 24 de outubro parei e redesenhei tudo sobre quatro regras, para que quem chega pela primeira vez termine uma etapa sem abrir nada e quem é profissional encontre tudo o que precisa por dentro.' ); ?></p>
  </div>
  <div class="pp-wide">
    <ol class="regras4">
      <li class="pp-reveal-card"><span class="r4-n">1</span><?php sera_e( '<b>One action per screen</b><span>The lime button says the next step and its cost.</span>', '<b>Uma ação por tela</b><span>O botão limão diz o próximo passo e o custo.</span>' ); ?></li>
      <li class="pp-reveal-card"><span class="r4-n">2</span><?php sera_e( '<b>List, work, adjust</b><span>List on the left, work in the centre, adjustments on the right.</span>', '<b>Lista, obra, ajuste</b><span>Lista à esquerda, obra no centro, ajuste à direita.</span>' ); ?></li>
      <li class="pp-reveal-card"><span class="r4-n">3</span><?php sera_e( '<b>Advanced only when asked for</b><span>Everything rare lives under "More options".</span>', '<b>Avançado só quando pedido</b><span>Tudo o que é raro mora em "Mais opções".</span>' ); ?></li>
      <li class="pp-reveal-card"><span class="r4-n">4</span><?php sera_e( '<b>The episode always in view</b><span>The scene’s strip of frames never leaves the screen.</span>', '<b>O episódio sempre à vista</b><span>A tira de quadros da cena nunca sai da tela.</span>' ); ?></li>
    </ol>
  </div>
  <div class="pp-col">
    <p class="pp-reveal"><?php sera_e( 'Then I cut what was intimidating. Four technical modes became a single choice: Basic or Advanced. Model names, price per second and English prompts left the screen. People write in Portuguese, mention @Maria or @take 1A, and the studio handles the rest.', 'Depois cortei o que intimidava. Quatro modos técnicos viraram uma escolha só: Básico ou Avançado. Nome de modelo, preço por segundo e prompt em inglês saíram da tela. A pessoa escreve em português, menciona @Maria ou @tomada 1A, e o estúdio cuida do resto.' ); ?></p>
  </div>
  <div class="pp-wide">
    <figure class="pp-compare pp-reveal">
      <div class="compare-top">
        <span class="pp-art-label"><?php sera_e( 'Working mode · Basic / Advanced', 'Modo de trabalho · Básico / Avançado' ); ?></span>
        <div class="modo" role="group" aria-label="<?php echo esc_attr( sera_t( 'Show mode', 'Mostrar modo' ) ); ?>">
          <button type="button" class="modo-b" data-to="100" aria-pressed="false"><?php sera_e( 'Basic', 'Básico' ); ?></button>
          <button type="button" class="modo-b" data-to="0" aria-pressed="false"><?php sera_e( 'Advanced', 'Avançado' ); ?></button>
        </div>
      </div>
      <div class="compare-stage" style="--pos:50%" data-tema="escuro" data-cursor-nativo>
        <div class="cmp-camada cmp-sob"><div class="sim" data-tela="storyboard-nos" data-roteiro="storyboard-nos" role="img" aria-label="<?php echo esc_attr( sera_t( 'Storyboard in Advanced mode: a node board with sheets, the previous frame, the Prompt node and Take 1.0 joined by edges.', 'Storyboard no modo Avançado: placa de nós com fichas, quadro anterior, o nó Prompt e o Take 1.0 ligado por arestas.' ) ); ?>"><noscript><p class="sim-alt">Avançado: a mesma tomada como placa de nós, com o Take #1.0 ligado ao pedido.</p></noscript></div></div>
        <div class="cmp-camada cmp-sobre"><div class="sim" data-tela="storyboard-basico" role="img" aria-label="<?php echo esc_attr( sera_t( 'Storyboard in Basic mode: the grid of frames for scene 3 and the panel for the selected take.', 'Storyboard no modo Básico: grade de quadros da cena 3 e o painel da tomada selecionada.' ) ); ?>"><noscript><p class="sim-alt">Básico: grade de quadros e o painel da tomada, com um botão e o preço.</p></noscript></div></div>
        <span class="cmp-tag cmp-tag-l" aria-hidden="true"><?php sera_e( 'Basic', 'Básico' ); ?></span>
        <span class="cmp-tag cmp-tag-r" aria-hidden="true"><?php sera_e( 'Advanced', 'Avançado' ); ?></span>
        <div class="cmp-handle" aria-hidden="true"><span><svg class="ico"><use href="#pp-i-arrastar"/></svg></span></div>
        <label class="visually-hidden" for="cmp-range"><?php sera_e( 'How much of Basic mode shows', 'Quanto do modo Básico aparece' ); ?></label>
        <input class="cmp-range" id="cmp-range" type="range" min="0" max="100" value="50" step="1">
      </div>
      <figcaption class="compare-caps">
        <p><?php sera_e( '<b>Basic</b>One take, one image and a button with the price. Arrow keys move, A approves.', '<b>Básico</b>Uma tomada, uma imagem e um botão com o preço. Setas andam, A aprova.' ); ?></p>
        <p><?php sera_e( '<b>Advanced</b>Every version becomes a numbered take, #1.0, #1.1, #1.2, linked to the one before.', '<b>Avançado</b>Cada versão vira um take numerado, #1.0, #1.1, #1.2, ligado à anterior.' ); ?></p>
        <p class="pp-cap"><?php sera_e( 'The same take in both modes. People choose, the studio remembers.', 'A mesma tomada nos dois modos. A pessoa escolhe, o estúdio lembra.' ); ?></p>
      </figcaption>
    </figure>
  </div>
</section>
</div>

<!-- ============ MICROINTERAÇÕES (claro) ============ -->
<div class="pp-zone" data-theme="light">
<section class="pp-chapter" id="micro" aria-labelledby="micro-t">
  <div class="pp-col">
    <p class="pp-kicker"><?php sera_e( '05 · Microinteractions', '05 · Microinterações' ); ?></p>
    <h2 class="pp-chapter-title" id="micro-t"><?php sera_e( 'Every movement in the studio tells you where your money is.', 'Cada movimento do estúdio diz onde está o seu dinheiro.' ); ?></h2>
    <p class="pp-lead pp-reveal"><?php sera_e( 'I chose a motion personality and gave it a name: "Quiet with a landing, credit gives energy". The base is calm. When something moves, it has something to say.', 'Escolhi uma personalidade de movimento e dei a ela um nome: "Quieto com pouso, o crédito dá energia". A base é calma. Quando algo se move, é porque tem algo a dizer.' ); ?></p>
    <p class="pp-reveal"><?php sera_e( 'The strongest rule: <strong>the particle is the credit</strong>. It only appears where there is credit or Origami, travels from the balance to the action and always comes from a real event. With reduced motion, everything stops and the information stays in the text.', 'A regra mais forte: <strong>a partícula é o crédito</strong>. Ela só aparece onde há crédito ou Origami, viaja do saldo para a ação e nasce sempre de um evento real. Com movimento reduzido, tudo para e a informação continua no texto.' ); ?></p>
  </div>
  <div class="pp-wide micro-art">
    <div class="mi-topo">
      <div class="mi-selo"><span class="pp-art-label"><?php sera_e( 'Motion personality', 'Personalidade de movimento' ); ?></span><?php sera_e( '<b>"Quiet with a landing, credit gives energy"</b><span>Enters slowly, leaves quickly, one main thing at a time.</span>', '<b>"Quieto com pouso, o crédito dá energia"</b><span>Entra devagar, sai rápido, uma coisa principal por vez.</span>' ); ?></div>
      <button type="button" class="mi-todas btn-ghost"><?php sera_e( 'Play all', 'Tocar todas' ); ?></button>
    </div>
    <ul class="mi-grade">
      <li class="mi" data-mi="cursor"><div class="mi-palco mi-palco--frame"><div class="sim" data-tipo="cursor" data-vw="560" data-vh="300" data-roteiro="cursor" data-tema="claro" data-cursor-nativo role="img" aria-label="<?php echo esc_attr( sera_t( 'The paper-plane cursor flies, leaves a trail and crumples into a paper ball over buttons.', 'O cursor de avião voa, deixa rastro e amassa numa bolinha de papel sobre os botões.' ) ); ?>"></div></div><h3><?php sera_e( 'Paper cursor', 'Cursor de papel' ); ?></h3><p><?php sera_e( 'The pointer is a paper plane and turns into a ball over anything clickable. Everything here is made of the same material.', 'O ponteiro é um avião de papel e vira bolinha sobre o que dá para clicar. Tudo aqui é feito do mesmo material.' ); ?></p></li>
      <li class="mi" data-mi="gerar"><div class="mi-palco pp-micro" data-theme="light"><span class="mi-saldo"></span><span class="mi-bt"></span><p class="mi-nota" aria-live="polite"></p></div><h3><?php sera_e( 'Credit that travels', 'Crédito que viaja' ); ?></h3><p><?php sera_e( 'When you generate, particles leave the balance and charge the button. You watch the spend happen.', 'Ao gerar, partículas saem do saldo e carregam o botão. Você vê o gasto acontecer.' ); ?></p><button type="button" class="mi-tocar"><?php sera_e( 'Play', 'Tocar' ); ?></button></li>
      <li class="mi" data-mi="falha"><div class="mi-palco pp-micro" data-theme="light"><span class="mi-saldo"></span><span class="mi-bt"></span><p class="mi-nota" aria-live="polite"></p></div><h3><?php sera_e( 'A failure that gives back', 'Falha que devolve' ); ?></h3><p><?php sera_e( 'On an error, the particles go back to the balance. The refund is in plain sight.', 'Deu erro, as partículas voltam para o saldo. A devolução fica à vista.' ); ?></p><button type="button" class="mi-tocar"><?php sera_e( 'Play', 'Tocar' ); ?></button></li>
      <li class="mi" data-mi="sem"><div class="mi-palco mi-palco--folga pp-micro" data-theme="light"><span class="mi-saldo"></span><span class="mi-bt"></span><p class="mi-nota" aria-live="polite"></p></div><h3><?php sera_e( 'No balance', 'Sem saldo' ); ?></h3><p><?php sera_e( 'The outline fills to 2/5, holds, then gives everything back, one by one.', 'O contorno enche até 2/5, segura e devolve tudo, em fila.' ); ?></p><button type="button" class="mi-tocar"><?php sera_e( 'Play', 'Tocar' ); ?></button></li>
      <li class="mi" data-mi="compra"><div class="mi-palco pp-micro" data-theme="light"><span class="mi-saldo"></span><button type="button" class="pp-btn g sm mi-pacote"><?php sera_e( '+500 credits', '+500 créditos' ); ?></button><p class="mi-nota" aria-live="polite"></p></div><h3><?php sera_e( 'Purchase', 'Compra' ); ?></h3><p><?php sera_e( 'The pack breaks into credits that land in the balance, and the number rolls up.', 'O pacote se desfaz em créditos que chegam ao saldo, e o número rola para cima.' ); ?></p><button type="button" class="mi-tocar"><?php sera_e( 'Play', 'Tocar' ); ?></button></li>
      <li class="mi" data-mi="ima"><div class="mi-palco pp-micro" data-theme="light" data-cursor-nativo><button type="button" class="pp-btn a mi-ima"><?php sera_e( 'Generate take', 'Gerar tomada' ); ?></button><i class="mi-ponteiro" aria-hidden="true"></i></div><h3><?php sera_e( 'Magnet', 'Ímã' ); ?></h3><p><?php sera_e( 'The main button gently pulls the cursor. The next action calls you.', 'O botão principal puxa o cursor de leve. A próxima ação chama você.' ); ?></p><button type="button" class="mi-tocar"><?php sera_e( 'Play', 'Tocar' ); ?></button></li>
      <li class="mi" data-mi="pouso"><div class="mi-palco pp-micro" data-theme="light"><div class="mi-cartoes"><div>#1.0</div><div>#2.0</div><div>#3.0</div></div></div><h3><?php sera_e( 'Landing', 'Pouso' ); ?></h3><p><?php sera_e( 'Cards, notices and sheets overshoot slightly and settle, like paper on a desk.', 'Cartão, aviso e folha passam um pouco do lugar e assentam, como papel na mesa.' ); ?></p><button type="button" class="mi-tocar"><?php sera_e( 'Play', 'Tocar' ); ?></button></li>
      <li class="mi" data-mi="clique"><div class="mi-palco pp-micro" data-theme="light"><button type="button" class="pp-btn a mi-afunda"><?php sera_e( 'Approve', 'Aprovar' ); ?></button></div><h3><?php sera_e( 'A click that sinks', 'Clique que afunda' ); ?></h3><p><?php sera_e( 'The button sinks 3% on press. Every gesture has weight.', 'O botão afunda 3% no toque. Todo gesto tem peso.' ); ?></p><button type="button" class="mi-tocar"><?php sera_e( 'Play', 'Tocar' ); ?></button></li>
      <li class="mi" data-mi="pensa"><div class="mi-palco mi-palco--conversa pp-micro" data-theme="light"><div class="mi-conversa"><span class="mi-pergunta"><?php sera_e( 'Break down scene 3?', 'Decupa a cena 3?' ); ?></span></div></div><h3><?php sera_e( 'Origami thinking', 'Origami pensando' ); ?></h3><p><?php sera_e( 'A plane made of particles flies and lands on the lines of the answer.', 'Um avião de partículas voa e pousa nas linhas da resposta.' ); ?></p><button type="button" class="mi-tocar"><?php sera_e( 'Play', 'Tocar' ); ?></button></li>
      <li class="mi" data-mi="tsuru"><div class="mi-palco pp-micro" data-theme="light"><span class="mi-tsuru"></span><span class="mi-bt-tsuru"></span></div><h3>Tsuru</h3><p><?php sera_e( 'Everything that generates carries the tsuru, which flaps its wings on hover.', 'Tudo o que gera leva o tsuru, que bate as asas quando o mouse passa.' ); ?></p><button type="button" class="mi-tocar"><?php sera_e( 'Play', 'Tocar' ); ?></button></li>
    </ul>
    <div class="mi-curvas">
      <div class="curves-head"><span class="pp-art-label"><?php sera_e( 'The product’s curves, at their real duration', 'As curvas do produto, com a duração real' ); ?></span><button type="button" class="btn-ghost curves-all"><?php sera_e( 'Play the curves', 'Tocar as curvas' ); ?></button></div>
      <ul class="curve-list">
        <li><button type="button" class="curve" data-ease="cubic-bezier(.33,1,.68,1)" data-ms="280"><code>--ease-quieto</code><span class="cv"><?php sera_e( 'enter without a bounce', 'entrar sem quique' ); ?></span><svg class="cg" viewBox="0 0 40 28" aria-hidden="true"><path/></svg><span class="track" aria-hidden="true"><i></i></span></button></li>
        <li><button type="button" class="curve" data-ease="cubic-bezier(.2,1.25,.4,1)" data-ms="450"><code>--ease-pouso</code><span class="cv"><?php sera_e( 'paper settling', 'papel assentando' ); ?></span><svg class="cg" viewBox="0 0 40 28" aria-hidden="true"><path/></svg><span class="track" aria-hidden="true"><i></i></span></button></li>
        <li><button type="button" class="curve" data-ease="cubic-bezier(.4,0,1,1)" data-ms="140"><code>--ease-in</code><span class="cv"><?php sera_e( 'for leaving only', 'só para sair' ); ?></span><svg class="cg" viewBox="0 0 40 28" aria-hidden="true"><path/></svg><span class="track" aria-hidden="true"><i></i></span></button></li>
        <li><button type="button" class="curve" data-ease="cubic-bezier(.45,0,.55,1)" data-ms="550"><code>--ease-in-out</code><span class="cv"><?php sera_e( 'credit in flight', 'o crédito em voo' ); ?></span><svg class="cg" viewBox="0 0 40 28" aria-hidden="true"><path/></svg><span class="track" aria-hidden="true"><i></i></span></button></li>
      </ul>
    </div>
    <p class="pp-cap mi-a11y"><?php sera_e( 'With reduced motion, only the end states. Nothing is lost.', 'Com movimento reduzido, só os estados finais. Nada se perde.' ); ?></p>
  </div>
</section>
</div>

<!-- ============ DOBRA (escuro) ============ -->
<div class="pp-zone" data-theme="dark">
<section class="pp-chapter" id="dobra" aria-labelledby="dobra-t">
  <div class="pp-col">
    <p class="pp-kicker">06 · Dobra</p>
    <h2 class="pp-chapter-title" id="dobra-t"><?php sera_e( 'A design system that runs the whole studio.', 'Um design system que comanda o estúdio inteiro.' ); ?></h2>
    <p class="pp-lead pp-reveal"><?php sera_e( 'I created Dobra so the whole studio would follow one standard. Colour, spacing, corners and motion live in one place, and that is where every piece of the product gets tuned. When I change a choice there, everything follows, and the agents speak the same language I do: I ask for <code>--accent</code> and they know where to look.', 'Criei a Dobra para o estúdio inteiro ter um padrão só. Cor, espaço, canto e movimento moram num lugar, e é por ele que cada peça do produto é ajustada. Quando mudo uma escolha ali, tudo acompanha, e os agentes falam a mesma língua que eu: peço <code>--accent</code>, eles sabem onde mexer.' ); ?></p>
  </div>
  <div class="pp-wide dobra-art">
    <div class="db-sistema" role="group" aria-label="<?php echo esc_attr( sera_t( 'Dobra, the design system: logo, colour and type', 'Dobra, o design system: logo, cor e tipo' ) ); ?>">
      <div class="db-marca">
        <svg class="db-logo" viewBox="0 0 40 40" aria-hidden="true"><path d="M6 4h21l7 7v25H6z" fill="#F7FF9E"/><path d="M27 4v7h7z" fill="rgba(17,17,16,.32)"/><path d="M12 19h15M12 25h10" stroke="#111110" stroke-width="2.2" stroke-linecap="round"/></svg>
        <div><b class="db-nome">Dobra</b><span class="db-sub"><?php sera_e( 'Design system', 'Design system' ); ?></span></div>
      </div>
      <div class="db-bloco">
        <span class="db-k"><?php sera_e( 'Colour', 'Cor' ); ?></span>
        <ul class="db-cores">
          <li><i style="--c:#F5F4EF"></i><span><?php sera_e( 'Paper', 'Papel' ); ?></span><code>--bg</code></li>
          <li><i style="--c:#111110"></i><span><?php sera_e( 'Ink', 'Tinta' ); ?></span><code>--ink</code></li>
          <li><i style="--c:#F7FF9E"></i><span><?php sera_e( 'Lime', 'Limão' ); ?></span><code>--accent</code></li>
          <li><i style="--c:#181D16"></i><span><?php sera_e( 'Night', 'Noite' ); ?></span><code>--surface</code></li>
        </ul>
      </div>
      <div class="db-bloco">
        <span class="db-k"><?php sera_e( 'Type', 'Tipo' ); ?></span>
        <ul class="db-fontes">
          <li><span class="db-aa f-display" aria-hidden="true">Aa</span><b class="f-display"><?php echo 'Bricolage Grotesque'; ?></b><span class="db-papel"><?php sera_e( 'Titles', 'Títulos' ); ?></span></li>
          <li><span class="db-aa f-sans" aria-hidden="true">Aa</span><b class="f-sans">Geist</b><span class="db-papel"><?php sera_e( 'Body copy', 'Texto corrido' ); ?></span></li>
          <li><span class="db-aa f-mono" aria-hidden="true">Aa</span><b class="f-mono">Geist Mono</b><span class="db-papel"><?php sera_e( 'Labels and tokens', 'Rótulos e tokens' ); ?></span></li>
        </ul>
      </div>
    </div>
    <div class="db-previa palco" data-tema="escuro" data-tema-segue>
      <span class="pp-art-label db-rot"><?php sera_e( 'Live preview · Storyboard', 'Prévia ao vivo · Storyboard' ); ?></span>
      <div class="pp-browser">
        <div class="pp-browser-bar" aria-hidden="true"><span class="pp-dots"><i></i><i></i><i></i></span><span class="pp-url">beta.paperplanestudio.app</span><span></span></div>
        <div class="sim" data-tela="storyboard-basico" data-manual="1" data-tema="escuro" data-cursor-nativo role="img" aria-label="<?php echo esc_attr( sera_t( 'The studio’s Storyboard, which changes colour, corners, theme and font with the panel.', 'Storyboard do estúdio, que muda de cor, canto, tema e fonte conforme o painel.' ) ); ?>"><noscript><p class="sim-alt">Storyboard do estúdio desenhado pelos tokens da Dobra.</p></noscript></div>
      </div>
      <div class="db-pecas"><div class="sim" data-tipo="pecas" data-vw="1440" data-vh="440" data-manual="1" data-cursor-nativo role="img" aria-label="<?php echo esc_attr( sera_t( 'Real Dobra components: main button with a price badge, secondary button, format chip, mode switch, take card, field with a mention, Origami loading and scene picker.', 'Peças reais da Dobra: botão principal com selo de preço, botão secundário, chip de formato, seletor de modo, cartão de take, campo com menção, carregamento do Origami e seletor de cena.' ) ); ?>"></div></div>
    </div>
  </div>
  <div class="pp-wide">
    <ul class="db-dados">
      <li class="db-dado pp-reveal-card">
        <svg class="db-ic" aria-hidden="true"><use href="#pp-i-token"/></svg>
        <b class="db-num"><span class="pp-odo" data-odo="250">250</span><span class="db-mais">+</span></b>
        <h3>tokens</h3>
        <p><?php sera_e( 'In three layers: primitives, semantics, scale.', 'Em três camadas: primitivas, semânticas, escala.' ); ?></p>
        <div class="db-camadas" aria-hidden="true"><span class="cm-1"><i></i><code>--lime-300</code></span><span class="cm-2"><i></i><code>--accent</code></span><span class="cm-3"><i class="cm-botao"><?php sera_e( 'Generate', 'Gerar' ); ?></i><?php sera_e( '<code>button</code>', '<code>botão</code>' ); ?></span></div>
      </li>
      <li class="db-dado pp-reveal-card">
        <svg class="db-ic" aria-hidden="true"><use href="#pp-i-ficha"/></svg>
        <b class="db-num"><span class="pp-odo" data-odo="68">68</span></b>
        <h3><?php sera_e( 'component sheets', 'fichas de componente' ); ?></h3>
        <p><?php sera_e( 'Each one next to the component’s code.', 'Cada uma ao lado do código da peça.' ); ?></p>
      </li>
      <li class="db-dado pp-reveal-card">
        <svg class="db-ic" aria-hidden="true"><use href="#pp-i-pagina"/></svg>
        <b class="db-num"><span class="pp-odo" data-odo="1">1</span></b>
        <h3><?php sera_e( 'living page', 'página viva' ); ?></h3>
        <p><?php sera_e( 'Read straight from the code, always matching the studio.', 'Lida direto do código, sempre igual ao estúdio.' ); ?></p>
      </li>
    </ul>
    <p class="db-selo pp-reveal"><svg class="ico" aria-hidden="true"><use href="#pp-i-escudo"/></svg><?php sera_e( 'Nothing off-standard goes live: colour, spacing and contrast are checked on every change.', 'Nada fora do padrão chega ao ar: cor, espaço e contraste são conferidos a cada mudança.' ); ?></p>
  </div>
</section>
</div>

<!-- ============ SITE (claro) ============ -->
<div class="pp-zone" data-theme="light">
<section class="pp-chapter" id="site" aria-labelledby="site-t">
  <div class="pp-col">
    <p class="pp-kicker"><?php sera_e( '07 · The website', '07 · O site' ); ?></p>
    <h2 class="pp-chapter-title" id="site-t"><?php sera_e( 'Paper with light: the home page speaks the studio’s language.', 'Papel com luz: a home fala a mesma língua do estúdio.' ); ?></h2>
    <p class="pp-lead pp-reveal"><?php sera_e( 'The home page has one job: make people who haven’t come in yet want to. I brought Dobra’s vocabulary to it, with paper grain, light coming from the top left and a lime with volume. The promise comes along too: the price appears before every take. The waiting list measures the funnel without cookies and without storing names, emails or IP addresses in its events.', 'A home tem um trabalho só: fazer quem ainda não entrou querer entrar. Levei para ela o vocabulário da Dobra, com grão de papel, luz vindo de cima à esquerda e o limão com volume. A promessa vai junto: o preço aparece antes de cada take. A lista de espera mede o funil sem cookies e sem guardar nome, e-mail ou IP nos eventos.' ); ?></p>
  </div>
  <div class="site-sec">
    <div class="site-grid pp-wide">
      <div class="site-telas palco" data-tema="claro">
        <div class="pp-browser site-frame">
          <div class="pp-browser-bar" aria-hidden="true"><span class="pp-dots"><i></i><i></i><i></i></span><span class="pp-url">paperplanestudio.app</span><span></span></div>
          <div class="sim" data-tipo="site" data-vw="1280" data-vh="720" data-tema="claro" data-cursor-nativo role="img" aria-label="<?php echo esc_attr( sera_t( 'The Paperplane home page, with the menu pinned to the top.', 'A home do Paperplane, com o menu preso no topo.' ) ); ?>"><noscript><p class="sim-alt">A home: "Estúdio de filmes com IA para errar menos e gastar melhor", o tour pelo estúdio, os estilos, o celular e a lista de espera.</p></noscript></div>
        </div>
        <div class="site-cel">
          <div class="aparelho" data-tema="claro"><div class="aparelho-status" aria-hidden="true"><time>9:41</time><span class="ilha"></span><span class="st-icones"><svg viewBox="0 0 18 12"><rect x="0" y="8" width="3" height="4" rx=".8"/><rect x="5" y="5.5" width="3" height="6.5" rx=".8"/><rect x="10" y="3" width="3" height="9" rx=".8"/><rect x="15" y="0" width="3" height="12" rx=".8"/></svg><svg viewBox="0 0 16 12"><path d="M8 11.2 5.6 8.6a3.4 3.4 0 0 1 4.8 0z"/><path d="M3.4 6.4a6.5 6.5 0 0 1 9.2 0l-1.3 1.3a4.7 4.7 0 0 0-6.6 0z"/><path d="M1.2 4.2a9.6 9.6 0 0 1 13.6 0l-1.3 1.3a7.8 7.8 0 0 0-11 0z"/></svg><svg viewBox="0 0 27 12"><rect x=".6" y=".6" width="22.8" height="10.8" rx="3.2" class="bat-borda"/><rect x="2.4" y="2.4" width="17.4" height="7.2" rx="1.8"/><path d="M25 4.2v3.6c.8-.3 1.4-1 1.4-1.8s-.6-1.5-1.4-1.8z"/></svg></span></div><div class="aparelho-tela"><div class="sim" data-tipo="siteCel" data-vw="390" data-vh="844" data-tema="claro" data-cursor-nativo role="img" aria-label="<?php echo esc_attr( sera_t( 'The top of the home page on a phone.', 'O topo da home no celular.' ) ); ?>"></div></div><i class="aparelho-inicio" aria-hidden="true"></i></div>
          <span class="site-cel-cap"><?php sera_e( 'The home page on a phone', 'A home no celular' ); ?></span>
        </div>
      </div>
      <ol class="site-caps">
        <li data-sec="top" class="is-on"><span class="pp-art-label">01</span><?php sera_e( '<b>The promise</b><span>"An AI film studio for fewer mistakes and better spending."</span>', '<b>A promessa</b><span>"Estúdio de filmes com IA para errar menos e gastar melhor."</span>' ); ?></li>
        <li data-sec="estudio"><span class="pp-art-label">02</span><?php sera_e( '<b>The same style, from the first frame to the last</b><span>The studio from the inside, from "Once upon a sentence." to "Cut!", and the style swap that keeps the story.</span>', '<b>O mesmo traço, do primeiro ao último quadro</b><span>O estúdio por dentro, de "Era uma vez uma frase." a "Corta!", e a troca de estilo que mantém a história.</span>' ); ?></li>
        <li data-sec="iphone-duo"><span class="pp-art-label">03</span><?php sera_e( '<b>In your pocket</b><span>"A studio in your pocket where every fold counts."</span>', '<b>No bolso</b><span>"Um estúdio no seu bolso onde cada dobra conta."</span>' ); ?></li>
        <li data-sec="comecar"><span class="pp-art-label">04</span><?php sera_e( '<b>Waiting list</b><span>A sheet that slides up, data protection in plain language and a little plane that lands on the email field.</span>', '<b>Lista de espera</b><span>Uma folha que sobe, LGPD em linguagem simples e um aviãozinho que pousa no e-mail.</span>' ); ?></li>
      </ol>
    </div>
  </div>
</section>
</div>

<!-- ============ CELULAR (escuro) ============ -->
<div class="pp-zone" data-theme="dark">
<section class="pp-chapter" id="celular" aria-labelledby="celular-t">
  <div class="pp-col">
    <h2 class="cel-frase" id="celular-t"><?php sera_e( 'The whole studio fits in your pocket, with everything the desktop can do.', 'O estúdio inteiro cabe no seu bolso, com tudo o que o computador faz.' ); ?></h2>
  </div>
  <div class="pp-wide cel-art palco" data-tema="escuro">
    <div class="pp-leque">
      <figure class="pp-cel cel-esq"><span class="cel-n" aria-hidden="true">1</span><div class="aparelho" data-tema="escuro" data-tema-segue><div class="aparelho-status" aria-hidden="true"><time>9:41</time><span class="ilha"></span><span class="st-icones"><svg viewBox="0 0 18 12"><rect x="0" y="8" width="3" height="4" rx=".8"/><rect x="5" y="5.5" width="3" height="6.5" rx=".8"/><rect x="10" y="3" width="3" height="9" rx=".8"/><rect x="15" y="0" width="3" height="12" rx=".8"/></svg><svg viewBox="0 0 16 12"><path d="M8 11.2 5.6 8.6a3.4 3.4 0 0 1 4.8 0z"/><path d="M3.4 6.4a6.5 6.5 0 0 1 9.2 0l-1.3 1.3a4.7 4.7 0 0 0-6.6 0z"/><path d="M1.2 4.2a9.6 9.6 0 0 1 13.6 0l-1.3 1.3a7.8 7.8 0 0 0-11 0z"/></svg><svg viewBox="0 0 27 12"><rect x=".6" y=".6" width="22.8" height="10.8" rx="3.2" class="bat-borda"/><rect x="2.4" y="2.4" width="17.4" height="7.2" rx="1.8"/><path d="M25 4.2v3.6c.8-.3 1.4-1 1.4-1.8s-.6-1.5-1.4-1.8z"/></svg></span></div><div class="aparelho-tela"><div class="sim" data-tela="cel-inicio" data-roteiro="cel-inicio" data-tema="escuro" data-cursor-nativo role="img" aria-label="<?php echo esc_attr( sera_t( 'The studio home on a phone, with the navigation island floating above the thumb.', 'Início do estúdio no celular, com a ilha de navegação flutuando acima do polegar.' ) ); ?>"></div></div><i class="aparelho-inicio" aria-hidden="true"></i></div></figure>
      <figure class="pp-cel cel-meio"><span class="cel-n" aria-hidden="true">2</span><div class="aparelho" data-tema="escuro" data-tema-segue><div class="aparelho-status" aria-hidden="true"><time>9:41</time><span class="ilha"></span><span class="st-icones"><svg viewBox="0 0 18 12"><rect x="0" y="8" width="3" height="4" rx=".8"/><rect x="5" y="5.5" width="3" height="6.5" rx=".8"/><rect x="10" y="3" width="3" height="9" rx=".8"/><rect x="15" y="0" width="3" height="12" rx=".8"/></svg><svg viewBox="0 0 16 12"><path d="M8 11.2 5.6 8.6a3.4 3.4 0 0 1 4.8 0z"/><path d="M3.4 6.4a6.5 6.5 0 0 1 9.2 0l-1.3 1.3a4.7 4.7 0 0 0-6.6 0z"/><path d="M1.2 4.2a9.6 9.6 0 0 1 13.6 0l-1.3 1.3a7.8 7.8 0 0 0-11 0z"/></svg><svg viewBox="0 0 27 12"><rect x=".6" y=".6" width="22.8" height="10.8" rx="3.2" class="bat-borda"/><rect x="2.4" y="2.4" width="17.4" height="7.2" rx="1.8"/><path d="M25 4.2v3.6c.8-.3 1.4-1 1.4-1.8s-.6-1.5-1.4-1.8z"/></svg></span></div><div class="aparelho-tela"><div class="sim" data-tela="cel-roteiro" data-roteiro="cel-roteiro" data-extras="cel-folha" data-tema="escuro" data-cursor-nativo role="img" aria-label="<?php echo esc_attr( sera_t( 'Script on a phone: a tap on the island opens the Visualise sheet, which slides up from the bottom.', 'Roteiro no celular: um toque na ilha abre a folha Visualizar, que sobe de baixo.' ) ); ?>"></div></div><i class="aparelho-inicio" aria-hidden="true"></i></div></figure>
      <figure class="pp-cel cel-dir"><span class="cel-n" aria-hidden="true">3</span><div class="aparelho" data-tema="escuro" data-tema-segue><div class="aparelho-status" aria-hidden="true"><time>9:41</time><span class="ilha"></span><span class="st-icones"><svg viewBox="0 0 18 12"><rect x="0" y="8" width="3" height="4" rx=".8"/><rect x="5" y="5.5" width="3" height="6.5" rx=".8"/><rect x="10" y="3" width="3" height="9" rx=".8"/><rect x="15" y="0" width="3" height="12" rx=".8"/></svg><svg viewBox="0 0 16 12"><path d="M8 11.2 5.6 8.6a3.4 3.4 0 0 1 4.8 0z"/><path d="M3.4 6.4a6.5 6.5 0 0 1 9.2 0l-1.3 1.3a4.7 4.7 0 0 0-6.6 0z"/><path d="M1.2 4.2a9.6 9.6 0 0 1 13.6 0l-1.3 1.3a7.8 7.8 0 0 0-11 0z"/></svg><svg viewBox="0 0 27 12"><rect x=".6" y=".6" width="22.8" height="10.8" rx="3.2" class="bat-borda"/><rect x="2.4" y="2.4" width="17.4" height="7.2" rx="1.8"/><path d="M25 4.2v3.6c.8-.3 1.4-1 1.4-1.8s-.6-1.5-1.4-1.8z"/></svg></span></div><div class="aparelho-tela"><div class="sim" data-tela="cel-origami" data-roteiro="cel-origami" data-tema="escuro" data-cursor-nativo role="img" aria-label="<?php echo esc_attr( sera_t( 'Origami full screen on a phone, switching from the dark theme to the light one.', 'O Origami em tela cheia no celular, que troca do tema escuro para o claro.' ) ); ?>"></div></div><i class="aparelho-inicio" aria-hidden="true"></i></div></figure>
    </div>
    <ol class="notas-cel">
      <li class="nota-1"><span class="cel-n" aria-hidden="true">1</span><svg class="nc-ic" aria-hidden="true"><use href="#pp-i-pilula"/></svg><?php sera_e( '<b>Navigation island</b><span>The menu floats above the thumb.</span>', '<b>Ilha de navegação</b><span>O menu flutua acima do polegar.</span>' ); ?></li>
      <li class="nota-2"><span class="cel-n" aria-hidden="true">2</span><svg class="nc-ic" aria-hidden="true"><use href="#pp-i-folha"/></svg><?php sera_e( '<b>Sheets that slide up</b><span>Panels rise from the bottom, within reach of a finger.</span>', '<b>Folhas que sobem</b><span>Painéis sobem de baixo, ao alcance do dedo.</span>' ); ?></li>
      <li class="nota-3"><span class="cel-n" aria-hidden="true">3</span><svg class="nc-ic" aria-hidden="true"><use href="#pp-i-lua"/></svg><?php sera_e( '<b>Dark theme</b><span>Carbon paper for shooting in the small hours.</span>', '<b>Tema escuro</b><span>Papel carbono para filmar de madrugada.</span>' ); ?></li>
    </ol>
    <div class="indices">
      <div class="ind"><svg class="ind-ic" aria-hidden="true"><use href="#pp-i-celular"/></svg><div class="ind-anel" style="--v:.96"><svg viewBox="0 0 100 100" aria-hidden="true"><circle class="ia-bg" cx="50" cy="50" r="46"/><circle class="ia-fg" cx="50" cy="50" r="46" pathLength="100"/></svg><b><span class="pp-odo" data-odo="96">96</span></b></div><?php sera_e( '<span>Mobile performance</span>', '<span>Desempenho no celular</span>' ); ?></div>
      <div class="ind"><svg class="ind-ic" aria-hidden="true"><use href="#pp-i-monitor"/></svg><div class="ind-anel" style="--v:.99"><svg viewBox="0 0 100 100" aria-hidden="true"><circle class="ia-bg" cx="50" cy="50" r="46"/><circle class="ia-fg" cx="50" cy="50" r="46" pathLength="100"/></svg><b><span class="pp-odo" data-odo="99">99</span></b></div><?php sera_e( '<span>Desktop performance</span>', '<span>Desempenho no computador</span>' ); ?></div>
      <div class="ind"><svg class="ind-ic" aria-hidden="true"><use href="#pp-i-acesso"/></svg><div class="ind-anel" style="--v:.97"><svg viewBox="0 0 100 100" aria-hidden="true"><circle class="ia-bg" cx="50" cy="50" r="46"/><circle class="ia-fg" cx="50" cy="50" r="46" pathLength="100"/></svg><b><span class="pp-odo" data-odo="97">97</span></b></div><?php sera_e( '<span>Accessibility</span>', '<span>Acessibilidade</span>' ); ?></div>
      <p class="pp-cap indices-cap"><?php sera_e( 'Lighthouse scores for the home page, measured on 30 Oct 2026.', 'Índices do Lighthouse da home, medidos em 30/10/2026.' ); ?></p>
    </div>
  </div>
</section>
</div>

<!-- ============ TURNO (claro) ============ -->
<div class="pp-zone" data-theme="light">
<section class="pp-chapter" id="turno" aria-labelledby="turno-t">
  <div class="pp-col">
    <p class="pp-kicker"><?php sera_e( '08 · How I work', '08 · Como trabalho' ); ?></p>
    <h2 class="pp-chapter-title" id="turno-t"><?php sera_e( 'Every night, a team of agents researches what Paperplane should become. In the morning, I choose.', 'Toda noite, uma equipe de agentes pesquisa o que o Paperplane deve virar. De manhã, eu escolho.' ); ?></h2>
    <p class="pp-lead pp-reveal"><?php sera_e( 'While I sleep, agents review the platform, study the competition and follow what is new in the AI market. Out of that comes a shortlist of what deserves a place on the roadmap.', 'Enquanto eu durmo, agentes analisam a plataforma, estudam a concorrência e acompanham as novidades do mercado de IA. Dali sai uma curadoria do que merece entrar no roadmap.' ); ?></p>
    <p class="pp-reveal"><?php sera_e( 'The best ideas arrive ready to try, behind a switch I can turn off whenever I like. At midday I open the night’s summary and decide what stays, what goes back and what is dropped.', 'As melhores ideias chegam prontas para testar, atrás de uma chave que eu desligo quando quiser. Ao meio-dia abro o resumo da noite e decido o que fica, o que volta e o que sai.' ); ?></p>
  </div>
  <div class="pp-wide">
    <ul class="contrato">
      <li class="ct" data-ct="pesquisa">
        <div class="ct-cab"><span class="ct-n">01</span><svg class="ct-ic" aria-hidden="true"><use href="#pp-i-lupa"/></svg></div>
        <h3><?php sera_e( 'Research', 'Pesquisa' ); ?></h3><p><?php sera_e( 'What the competition does and what is changing in the AI market, with source and date.', 'O que a concorrência faz e o que muda no mercado de IA, com fonte e data.' ); ?></p>
        <div class="ct-art ct-tabela" aria-hidden="true"><?php sera_e( '<span><i>Competitors</i><em>flows and screens</em></span><span><i>AI market</i><em>what’s new</em></span><span><i>Platform</i><em>where to improve</em></span>', '<span><i>Concorrência</i><em>fluxos e telas</em></span><span><i>Mercado de IA</i><em>novidades</em></span><span><i>Plataforma</i><em>onde melhorar</em></span>' ); ?></div>
      </li>
      <li class="ct" data-ct="debate">
        <div class="ct-cab"><span class="ct-n">02</span><svg class="ct-ic" aria-hidden="true"><use href="#pp-i-lista"/></svg></div>
        <h3>Debate</h3><p><?php sera_e( 'Every idea gets a score and faces a critic. Only the ones that survive move up.', 'Cada ideia ganha nota e enfrenta um crítico. Só sobe a que sobrevive.' ); ?></p>
        <div class="ct-art ct-decisoes" aria-hidden="true"><span class="ct-num"><b class="pp-odo" data-odo="6">6</b><?php sera_e( '<i>rounds a night</i>', '<i>rodadas por noite</i>' ); ?></span><span class="ct-data"><?php sera_e( 'from 5am to 11am', 'das 5h às 11h' ); ?></span></div>
      </li>
      <li class="ct" data-ct="prototipo">
        <div class="ct-cab"><span class="ct-n">03</span><svg class="ct-ic" aria-hidden="true"><use href="#pp-i-telas"/></svg></div>
        <h3><?php sera_e( 'Prototype', 'Protótipo' ); ?></h3><p><?php sera_e( 'The idea arrives as a real screen, checked on phone, tablet and desktop.', 'A ideia chega como tela de verdade, conferida no celular, no tablet e no computador.' ); ?></p>
        <div class="ct-art ct-larguras" aria-hidden="true"><span style="--w:22%">360</span><span style="--w:38%">768</span><span style="--w:62%">1366</span><em class="ct-temas"><i></i><i></i></em></div>
      </li>
      <li class="ct ct--meu" data-ct="decisao">
        <div class="ct-cab"><span class="ct-n">04</span><svg class="ct-ic" aria-hidden="true"><use href="#pp-i-rumo"/></svg></div>
        <h3><?php sera_e( 'My choice', 'Minha escolha' ); ?></h3><p><?php sera_e( 'At midday I decide. No agent spends money, touches data or changes a product decision.', 'Ao meio-dia eu decido. Nenhum agente gasta dinheiro, mexe nos dados ou muda uma decisão de produto.' ); ?></p>
        <div class="ct-art ct-escolha" aria-hidden="true"><?php sera_e( '<span data-e="fica">stays</span><span data-e="volta">back</span><span data-e="sai">out</span>', '<span data-e="fica">fica</span><span data-e="volta">volta</span><span data-e="sai">sai</span>' ); ?></div>
      </li>
    </ul>
  </div>
  <div class="pp-col">
    <p class="pp-reveal"><?php sera_e( 'There are nine agents, each with one role: research, theme memory, strategy, critique, design, building, quality, security and the morning summary. The critic attacks every idea before it takes shape.', 'São nove agentes, cada um com um papel: pesquisa, memória dos temas, estratégia, crítica, design, construção, qualidade, segurança e o resumo da manhã. O crítico ataca cada ideia antes de ela ganhar forma.' ); ?></p>
  </div>

  <div class="pp-night" style="--h:0">
    <div class="night-sky" aria-hidden="true"><i class="pp-stars"></i><svg class="grao" width="100%" height="100%"><filter id="pp-grao-f"><feTurbulence type="fractalNoise" baseFrequency=".85" numOctaves="2" stitchTiles="stitch"/><feColorMatrix values="0 0 0 0 0.5  0 0 0 0 0.5  0 0 0 0 0.5  0 0 0 .55 0"/></filter><rect width="100%" height="100%" filter="url(#pp-grao-f)"/></svg></div>
    <div class="pp-wide night-grid">
      <div class="night-clock">
        <div class="pp-clock" aria-hidden="true">
          <svg viewBox="0 0 120 120"><circle cx="60" cy="60" r="56" class="c-face"/><g class="c-ticks"></g><line x1="60" y1="60" x2="60" y2="30" class="c-hour"/><line x1="60" y1="60" x2="60" y2="16" class="c-min"/><circle cx="60" cy="60" r="3" class="c-pin"/></svg>
        </div>
        <p class="clock-time" aria-hidden="true">05:00</p>
        <p class="clock-label pp-art-label"><?php sera_e( 'A night of curation', 'Uma noite de curadoria' ); ?></p>
      </div>
      <ol class="night-list">
        <li data-h="5"><time>05:00</time><div><?php sera_e( '<b>Review the platform.</b> The brain studies the night’s themes, such as stories, Origami, costs and collaboration, and points out where the studio can improve.', '<b>Analisar a plataforma.</b> O cérebro estuda os temas da noite, como histórias, Origami, custos e colaboração, e aponta onde o estúdio pode melhorar.' ); ?></div></li>
        <li data-h="6"><time>06:00</time><div><?php sera_e( '<b>Look at the competition.</b> The radar studies how competitors solve the same problem and brings back what is new in the AI market.', '<b>Olhar a concorrência.</b> O radar estuda como os concorrentes resolvem o mesmo problema e traz as novidades do mercado de IA.' ); ?></div></li>
        <li data-h="7"><time>07:00</time><div><?php sera_e( '<b>Debate and prioritise.</b> The strategist scores each idea and the critic attacks. "An idea only moves up if it survives."', '<b>Debater e priorizar.</b> O estrategista dá nota a cada ideia, o crítico ataca. "Uma ideia só sobe se sobreviver."' ); ?></div></li>
        <li data-h="8"><time>08:00</time><div><?php sera_e( '<b>Prototype.</b> The designer draws the screen and the engineer builds it behind a switch.', '<b>Prototipar.</b> O designer desenha a tela e o engenheiro a constrói atrás de uma chave.' ); ?></div></li>
        <li data-h="9"><time>09:00</time><div><?php sera_e( '<b>Test.</b> Quality checks phone, tablet and desktop in both themes; security blocks anything critical.', '<b>Testar.</b> A qualidade confere celular, tablet e computador nos dois temas; a segurança barra o que for crítico.' ); ?></div></li>
        <li data-h="10"><time>10:00</time><div><?php sera_e( '<b>Ready to try.</b> Whatever passed goes into the beta, and can be switched off at any time.', '<b>Pronto para testar.</b> O que passou entra no beta, desligável a qualquer momento.' ); ?></div></li>
        <li data-h="11"><time>11:00</time><div><?php sera_e( '<b>Wrap-up.</b> Nothing new starts. The reporter puts together the night’s summary.', '<b>Fechamento.</b> Nada novo começa. O relator monta o resumo da noite.' ); ?></div></li>
        <li data-h="12"><time>12:00</time><div><?php sera_e( '<b>Morning summary.</b> I open it and choose what stays, what goes back and what is dropped.', '<b>Resumo da manhã.</b> Eu abro e escolho o que fica, o que volta e o que sai.' ); ?></div></li>
      </ol>
      <div class="night-notes">
        <p><?php sera_e( 'Each round runs end to end. The times show where each agent does most of its work.', 'Cada rodada vai de ponta a ponta. Os horários mostram onde cada agente pesa mais.' ); ?></p>
        <p class="night-mark"><span class="pp-art-label"><?php sera_e( 'A real night', 'Uma noite real' ); ?></span> <?php sera_e( '24 Oct: eight new features reached the beta between 08:20 and 10:14, among them credits in minutes and Explore.', '24/10: oito novidades entraram no beta entre 08h20 e 10h14, entre elas os créditos em minutos e o Explorar.' ); ?></p>
      </div>
    </div>
  </div>

  <div class="pp-days">
    <div class="pp-wide days-head"><span class="pp-art-label"><?php sera_e( 'The 23 days', 'Os 23 dias' ); ?></span><span class="dias-dica"><svg class="ico" aria-hidden="true"><use href="#pp-i-arrastar"/></svg><?php sera_e( 'Drag, use the arrows or the wheel', 'Arraste, use as setas ou a roda' ); ?></span></div>
    <div class="days-viewport">
      <div class="days-trilho">
        <i class="days-fio" aria-hidden="true"><i class="days-fio-cheio"></i></i>
        <ol class="days-track" aria-label="<?php echo esc_attr( sera_t( 'Milestones of the 23 days', 'Marcos dos 23 dias' ) ); ?>">
          <li tabindex="0" style="--d:1" class="is-key"><span class="dia-marca" aria-hidden="true"><svg class="ico"><use href="#pp-i-aviao"/></svg></span><span class="dia-n"><?php sera_e( 'Day 1', 'Dia 1' ); ?></span><?php sera_e( '<b>First screen</b>', '<b>Primeira tela</b>' ); ?><p><?php sera_e( 'The prototype and the house rules for the agents.', 'O protótipo e as regras da casa para os agentes.' ); ?></p><time datetime="2026-10-19">19/10</time></li>
          <li tabindex="0" style="--d:2"><span class="dia-marca" aria-hidden="true"></span><span class="dia-n"><?php sera_e( 'Day 2', 'Dia 2' ); ?></span><?php sera_e( '<b>Storyboard as nodes</b>', '<b>Storyboard em nós</b>' ); ?><p><?php sera_e( 'Storyboard and Animation as nodes, an editor with several tracks.', 'Storyboard e Animação em nós, Montagem com várias trilhas.' ); ?></p><time datetime="2026-10-20">20/10</time></li>
          <li tabindex="0" style="--d:3"><span class="dia-marca" aria-hidden="true"></span><span class="dia-n"><?php sera_e( 'Day 3', 'Dia 3' ); ?></span><?php sera_e( '<b>Responsive</b>', '<b>Responsivo</b>' ); ?><p><?php sera_e( 'A layout that rearranges itself instead of a fixed screen.', 'Um layout que se reorganiza no lugar da tela fixa.' ); ?></p><time datetime="2026-10-21">21/10</time></li>
          <li tabindex="0" style="--d:4" class="is-key"><span class="dia-marca" aria-hidden="true"><svg class="ico"><use href="#pp-i-camadas"/></svg></span><span class="dia-n"><?php sera_e( 'Day 6', 'Dia 6' ); ?></span><b>Redesign</b><p><?php sera_e( 'Simple outside, advanced inside, and the agents’ first night.', 'Simples por fora, avançado por dentro, e a primeira noite dos agentes.' ); ?></p><time datetime="2026-10-24">24/10</time></li>
          <li tabindex="0" style="--d:5"><span class="dia-marca" aria-hidden="true"></span><span class="dia-n"><?php sera_e( 'Day 16', 'Dia 16' ); ?></span><?php sera_e( '<b>Origami as an agent</b>', '<b>Origami agente</b>' ); ?><p><?php sera_e( 'One step at a time, with the price on the button.', 'Um passo por vez, com o preço no botão.' ); ?></p><time datetime="2026-11-03">03/11</time></li>
          <li tabindex="0" style="--d:6" class="is-key"><span class="dia-marca" aria-hidden="true"><svg class="ico"><use href="#pp-i-token"/></svg></span><span class="dia-n"><?php sera_e( 'Day 17', 'Dia 17' ); ?></span><?php sera_e( '<b>Dobra is born</b>', '<b>Nasce a Dobra</b>' ); ?><p><?php sera_e( 'The design system, with a page read from the code.', 'O design system, com a página que se lê do código.' ); ?></p><time datetime="2026-11-04">04/11</time></li>
          <li tabindex="0" style="--d:7"><span class="dia-marca" aria-hidden="true"></span><span class="dia-n"><?php sera_e( 'Day 18', 'Dia 18' ); ?></span><?php sera_e( '<b>Free format</b>', '<b>Formato livre</b>' ); ?><p><?php sera_e( 'Change the episode’s format halfway through, without redoing anything.', 'Trocar o formato do episódio no meio, sem refazer nada.' ); ?></p><time datetime="2026-11-05">05/11</time></li>
          <li tabindex="0" style="--d:8"><span class="dia-marca" aria-hidden="true"></span><span class="dia-n"><?php sera_e( 'Day 19', 'Dia 19' ); ?></span><?php sera_e( '<b>Audit</b>', '<b>Auditoria</b>' ); ?><p><?php sera_e( 'I reviewed the whole studio and closed the fixes the same day.', 'Revisei o estúdio inteiro e fechei as correções no mesmo dia.' ); ?></p><time datetime="2026-11-06">06/11</time></li>
          <li tabindex="0" style="--d:9" class="is-key"><span class="dia-marca" aria-hidden="true"><svg class="ico"><use href="#pp-i-rumo"/></svg></span><span class="dia-n"><?php sera_e( 'Day 20', 'Dia 20' ); ?></span><?php sera_e( '<b>Basic and Advanced</b>', '<b>Básico e Avançado</b>' ); ?><p><?php sera_e( 'Paper with light and the motion personality.', 'Papel com luz e a personalidade de movimento.' ); ?></p><time datetime="2026-11-07">07/11</time></li>
          <li tabindex="0" style="--d:10"><span class="dia-marca" aria-hidden="true"></span><span class="dia-n"><?php sera_e( 'Day 21', 'Dia 21' ); ?></span><?php sera_e( '<b>Less tech on screen</b>', '<b>Menos técnica na tela</b>' ); ?><p><?php sera_e( 'Technical details leave the interface. Shot breakdown with a guide video.', 'Detalhes técnicos saem da interface. Decupagem com vídeo-guia.' ); ?></p><time datetime="2026-11-08">08/11</time></li>
          <li tabindex="0" style="--d:11"><span class="dia-marca" aria-hidden="true"></span><span class="dia-n"><?php sera_e( 'Day 22', 'Dia 22' ); ?></span><?php sera_e( '<b>A single prompt</b>', '<b>Um prompt só</b>' ); ?><p><?php sera_e( 'In Portuguese, with @ mentions.', 'Em português, com menções por arroba.' ); ?></p><time datetime="2026-11-09">09/11</time></li>
          <li tabindex="0" style="--d:12" class="is-key"><span class="dia-marca" aria-hidden="true"><svg class="ico"><use href="#pp-i-check"/></svg></span><span class="dia-n"><?php sera_e( 'Day 23', 'Dia 23' ); ?></span><?php sera_e( '<b>Finish</b>', '<b>Acabamento</b>' ); ?><p><?php sera_e( 'PDF boards, subtitles, markers and the episode pack.', 'Prancha em PDF, legendas, marcadores e pacote do episódio.' ); ?></p><time datetime="2026-11-10">10/11</time></li>
        </ol>
      </div>
    </div>
    <div class="pp-wide dias-nav">
      <button type="button" class="dias-seta dias-ant" aria-label="<?php echo esc_attr( sera_t( 'Previous milestone', 'Marco anterior' ) ); ?>"><svg class="ico" aria-hidden="true"><use href="#pp-i-seta"/></svg></button>
      <ol class="dias-indice" aria-label="<?php echo esc_attr( sera_t( 'Go to a milestone', 'Ir para um marco' ) ); ?>"></ol>
      <button type="button" class="dias-seta dias-prox" aria-label="<?php echo esc_attr( sera_t( 'Next milestone', 'Próximo marco' ) ); ?>"><svg class="ico" aria-hidden="true"><use href="#pp-i-seta"/></svg></button>
    </div>
  </div>

  <div class="pp-wide diretor">
    <p class="diretor-frase pp-reveal"><?php sera_e( 'In 23 days, every milestone on this line started with a decision of mine. The agents propose, build and test. The direction, the cuts and the standard of finish are mine.', 'Em 23 dias, cada marco desta linha começou com uma decisão minha. Os agentes propõem, constroem e testam. O rumo, o corte e o padrão de acabamento são meus.' ); ?></p>
    <ul class="papeis">
      <li class="pp-reveal-card"><svg class="pa-ic" aria-hidden="true"><use href="#pp-i-rumo"/></svg><?php sera_e( '<b>What I decide</b><span>The direction, the scope, what comes in and what goes, and the finish of every screen.</span>', '<b>O que eu decido</b><span>O rumo, o escopo, o que entra e o que sai, e o padrão de acabamento de cada tela.</span>' ); ?></li>
      <li class="pp-reveal-card"><svg class="pa-ic" aria-hidden="true"><use href="#pp-i-pessoas"/></svg><?php sera_e( '<b>What the agents do</b><span>They research, propose, build and test, within the rules I wrote.</span>', '<b>O que os agentes fazem</b><span>Pesquisam, propõem, constroem e testam, dentro das regras que escrevi.</span>' ); ?></li>
      <li class="pp-reveal-card"><svg class="pa-ic" aria-hidden="true"><use href="#pp-i-cadeado"/></svg><?php sera_e( '<b>What never happens without me</b><span>Spending money, touching data or changing a product decision.</span>', '<b>O que nunca acontece sem mim</b><span>Gastar dinheiro, mexer nos dados ou mudar uma decisão de produto.</span>' ); ?></li>
    </ul>
  </div>
</section>

<!-- 10 NÚMEROS -->
<section class="pp-chapter" id="numeros" aria-labelledby="numeros-t">
  <div class="pp-col">
    <p class="pp-kicker"><?php sera_e( '09 · In numbers', '09 · Em números' ); ?></p>
    <h2 class="pp-chapter-title" id="numeros-t"><?php sera_e( '23 days of direction, in eight numbers.', '23 dias de direção, em oito números.' ); ?></h2>
    <p class="pp-lead pp-reveal"><?php sera_e( 'Volume doesn’t prove quality. I show these numbers for what they reveal: how much product fits into 23 days when every decision is written down and the standard of finish is not up for negotiation.', 'Volume não prova qualidade. Mostro estes números pelo que revelam: quanto produto cabe em 23 dias quando cada decisão está escrita e o padrão de acabamento não se negocia.' ); ?></p>
  </div>
  <div class="pp-wide">
    <ul class="pp-stats">
      <li class="pp-stat stat--hl"><span class="st-selo"><?php sera_e( 'highlight', 'destaque' ); ?></span><svg class="st-ic" aria-hidden="true"><use href="#pp-i-doc"/></svg><b><span class="pp-odo" data-odo="35">35</span></b><h3><?php sera_e( 'product decisions', 'decisões de produto' ); ?></h3><p><?php sera_e( 'Numbered and dated. No agent changes one without me.', 'Numeradas e datadas. Nenhum agente muda uma sem mim.' ); ?></p></li>
      <li class="pp-stat"><svg class="st-ic" aria-hidden="true"><use href="#pp-i-calendario"/></svg><b><span class="pp-odo" data-odo="23">23</span></b><h3><?php sera_e( 'days', 'dias' ); ?></h3><p><?php sera_e( 'From the first screen, on 19 Oct, to where it stands today.', 'Da primeira tela, em 19/10, ao estado de hoje.' ); ?></p></li>
      <li class="pp-stat"><svg class="st-ic" aria-hidden="true"><use href="#pp-i-camadas"/></svg><b><span class="pp-odo" data-odo="68">68</span></b><h3><?php sera_e( 'sheets in Dobra', 'fichas na Dobra' ); ?></h3><p><?php sera_e( 'Every component with its sheet next to the code.', 'Cada componente com a sua ficha ao lado do código.' ); ?></p></li>
      <li class="pp-stat stat--hl"><span class="st-selo"><?php sera_e( 'highlight', 'destaque' ); ?></span><svg class="st-ic" aria-hidden="true"><use href="#pp-i-cruzar"/></svg><b><span class="pp-odo" data-odo="21">21</span></b><h3><?php sera_e( 'transitions in the editor', 'transições na Montagem' ); ?></h3><p><?php sera_e( 'More than 50 effects, with a preview that matches the export.', 'Mais de 50 efeitos, com prévia igual à exportação.' ); ?></p></li>
      <li class="pp-stat"><svg class="st-ic" aria-hidden="true"><use href="#pp-i-lua"/></svg><b><span class="pp-odo" data-odo="9">9</span></b><h3><?php sera_e( 'agents at night', 'agentes à noite' ); ?></h3><p><?php sera_e( 'Six one-hour rounds, from 5am to midday.', 'Seis rodadas de uma hora, das 5h ao meio-dia.' ); ?></p></li>
      <li class="pp-stat"><svg class="st-ic" aria-hidden="true"><use href="#pp-i-commit"/></svg><b><span class="pp-odo" data-odo="1.053">1.053</span></b><h3><?php sera_e( 'code changes', 'mudanças no código' ); ?></h3><p><?php sera_e( 'Written by the agents, in the direction I set.', 'Escritas pelos agentes, na direção que eu dei.' ); ?></p></li>
      <li class="pp-stat"><svg class="st-ic" aria-hidden="true"><use href="#pp-i-merge"/></svg><b><span class="pp-odo" data-odo="251">251</span></b><h3><?php sera_e( 'releases shipped', 'entregas publicadas' ); ?></h3><p><?php sera_e( 'Each one went through the same checks before going live.', 'Cada uma passou pela mesma conferência antes de ir ao ar.' ); ?></p></li>
      <li class="pp-stat"><svg class="st-ic" aria-hidden="true"><use href="#pp-i-escudo"/></svg><b><span class="st-pre">≈</span><span class="pp-odo" data-odo="1.500">1.500</span></b><h3><?php sera_e( 'automated checks', 'verificações automáticas' ); ?></h3><p><?php sera_e( 'They guard the product’s rules on every change.', 'Guardam as regras do produto a cada mudança.' ); ?></p></li>
    </ul>
  </div>
</section>

<!-- 11 APRENDI -->
<section class="pp-chapter" id="aprendi" aria-labelledby="aprendi-t">
  <div class="pp-col">
    <p class="pp-kicker"><?php sera_e( '10 · What I learned', '10 · O que aprendi' ); ?></p>
    <h2 class="pp-chapter-title" id="aprendi-t"><?php sera_e( 'What I have learned so far, and what comes next.', 'O que aprendi até aqui, e o que vem agora.' ); ?></h2>
  </div>
  <div class="pp-wide">
    <div class="pp-licoes">
      <span class="pp-art-label licoes-rot"><?php sera_e( 'Learned', 'Aprendi' ); ?></span>
      <ol class="licoes-l">
        <li><svg class="li-ic" aria-hidden="true"><use href="#pp-i-caderno"/></svg><span class="li-n">01</span><h3><?php sera_e( 'A written decision beats a remembered one.', 'Decisão escrita vence decisão lembrada.' ); ?></h3><p><?php sera_e( 'Agents don’t keep context from one session to the next. Numbering and dating every decision stopped the product going round in circles.', 'Agentes não guardam contexto de uma sessão para a outra. Numerar e datar cada decisão fez o produto parar de andar em círculo.' ); ?></p></li>
        <li><svg class="li-ic" aria-hidden="true"><use href="#pp-i-escudo"/></svg><span class="li-n">02</span><h3><?php sera_e( 'A standard that matters is written into the product.', 'Padrão que importa fica escrito no produto.' ); ?></h3><p><?php sera_e( 'Asking for "no loose colours" lasted a day. Once the rule was built into the studio, no colour slipped through again.', 'Pedir "não use cor solta" durou um dia. Quando a regra entrou no estúdio, nenhuma cor escapou de novo.' ); ?></p></li>
        <li><svg class="li-ic" aria-hidden="true"><use href="#pp-i-borracha"/></svg><span class="li-n">03</span><h3><?php sera_e( 'Taking things off the screen is the hardest work.', 'Tirar da tela é o trabalho mais difícil.' ); ?></h3><p><?php sera_e( 'Agents add things easily. Every cut needed a decision from me, and cutting is what made the studio simple.', 'Agentes adicionam com facilidade. Cada corte exigiu uma decisão minha, e foi cortando que o estúdio ficou simples.' ); ?></p></li>
      </ol>
      <span class="pp-art-label licoes-rot"><?php sera_e( 'What comes next', 'O que vem agora' ); ?></span>
      <ol class="licoes-l licoes-l--aberto">
        <li><svg class="li-ic" aria-hidden="true"><use href="#pp-i-pessoas"/></svg><span class="li-n">04</span><h3><?php sera_e( 'Testing with people from film and video.', 'Em teste com gente do audiovisual.' ); ?></h3><p><?php sera_e( 'The beta is closed. I am testing it myself, along with close friends who work in film and video, and gathering their feedback to decide what comes next.', 'O beta está fechado. Eu mesmo estou testando, junto com amigos próximos do audiovisual, e coletando o feedback deles para decidir o que vem a seguir.' ); ?></p></li>
        <li><svg class="li-ic" aria-hidden="true"><use href="#pp-i-pergunta"/></svg><span class="li-n">05</span><h3><?php sera_e( 'Do minutes work for people who have never generated video?', 'Minutos funcionam para quem nunca gerou vídeo?' ); ?></h3><p><?php sera_e( 'It is the assumption I most want to validate with the people testing it now.', 'É a hipótese que mais quero validar com quem está testando agora.' ); ?></p></li>
        <li><svg class="li-ic" aria-hidden="true"><use href="#pp-i-lupa"/></svg><span class="li-n">06</span><h3><?php sera_e( 'Growing without losing the finish.', 'Crescer sem perder o acabamento.' ); ?></h3><p><?php sera_e( 'I want to see whether the standard holds as the studio gains screens. I have done one full audit, and more will follow.', 'Quero ver se o padrão se mantém enquanto o estúdio ganha telas. Já fiz uma auditoria completa e vou fazer outras.' ); ?></p></li>
      </ol>
    </div>
  </div>
  <div class="pp-col">
    <p class="pp-note pp-reveal"><?php sera_e( 'The images and videos inside the screens are examples.', 'As imagens e os vídeos dentro das telas são de exemplo.' ); ?></p>
  </div>
</section>

<!-- 12 FECHO -->
<section class="pp-chapter pp-closing" id="fecho" aria-labelledby="fecho-t">
  <div class="pp-col" data-aviao-pouso>
    <p class="pp-kicker"><?php sera_e( '11 · Where it stands', '11 · Onde está' ); ?></p>
    <h2 class="pp-chapter-title" id="fecho-t"><?php sera_e( 'The studio is in closed beta. The home page is live.', 'O estúdio está em beta fechado. A home já está no ar.' ); ?></h2>
    <p class="pp-lead pp-reveal"><?php sera_e( 'Paperplane is still in progress, and this page shows where it stands today. If you work in product, AI or animation and want to talk about how a designer gives direction to a team of agents, get in touch.', 'O Paperplane continua em andamento, e esta página mostra o estado de hoje. Se você trabalha com produto, IA ou animação e quer conversar sobre como um designer dá rumo a uma equipe de agentes, me escreve.' ); ?></p>
    <div class="pp-ctas">
      <a class="pp-cta pp-cta-lime" href="https://paperplanestudio.app" target="_blank" rel="noopener"><span class="pp-cta-in"><?php sera_e( '<span>See the home page</span><small>paperplanestudio.app</small>', '<span>Ver a home</span><small>paperplanestudio.app</small>' ); ?></span><svg class="ico" aria-hidden="true"><use href="#pp-i-externa"/></svg></a>
      <a class="pp-cta pp-cta-line" href="https://beta.paperplanestudio.app" target="_blank" rel="noopener"><span class="pp-cta-in"><?php sera_e( '<span>Ask for beta access</span><small>beta.paperplanestudio.app</small>', '<span>Pedir acesso ao beta</span><small>beta.paperplanestudio.app</small>' ); ?></span><svg class="ico" aria-hidden="true"><use href="#pp-i-externa"/></svg></a>
    </div>
    <p class="pp-cap pp-cta-note"><?php sera_e( 'The beta needs a password. The waiting list is on the home page.', 'O beta abre com senha. A lista de espera fica na home.' ); ?></p>
  </div>
</section>
</div>

</article>
