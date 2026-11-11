=== Sera v.1 ===
Contributors: matheusserafim
Stable tag: 3.18.5
Requires at least: 6.4
Tested up to: 6.8
Requires PHP: 7.4
License: GPLv2 or later

Portfolio theme for Matheus Serafim.

== Como funciona ==

1. Aparência › Temas › Adicionar novo › Enviar tema: suba sera-v1.zip e ative.
   Na ativação o tema cria a categoria "portfolio" e os 9 cases como RASCUNHO.
2. Aparência › Sera · Cases: importe/publique os cases (um a um ou todos).
   Cada case vira uma Página com URL própria:
     /combina-antes/
     /western-union-onboarding/
     /will-bank-switching-the-brain/
     /fatal-model-perfis-ad/
     /acordo-certo-homepage/
     /research-hub/
     /lume/
     /bastidores-redesign/
     /paperplane-studio/
   (Configurações › Links permanentes: use "Nome do post".)
   Se o CliniClik já foi importado antes, use "Tirar da Home" na mesma tela
   (ele vira rascunho e sai da categoria portfolio; nada é apagado).
3. A Home (front-page.php) lista automaticamente toda Página com a categoria
   (ou tag) "portfolio". Nada aparece na Home sem ter a própria página/URL.
   A ordem é escolhida em Personalizar › Sera · Home › Cases: arraste os cases
   (ou use as setas). Por padrão todos aparecem como cards grandes; desligue
   "Mostrar todos os cases como cards grandes" para mandar o excedente para a
   lista "More work". Case que não estiver na lista entra no fim, pelo campo "Ordem".
4. Conteúdo dos cases: o texto está em blocos normais (parágrafos e títulos,
   editáveis). Mockups de iPhone e artefatos visuais são os blocos
   "Sera: Mockup de iPhone" e "Sera: Artefato do case".
5. Card da Home e topo do case: caixa "Dados do case (Sera)" na edição da página
   + o Resumo (excerpt).
6. Todo o texto da Home: Aparência › Personalizar › Sera · Home.
7. Menus: Aparência › Menus ("Menu principal" e "Links do rodapé").
   Sem menu, o tema usa links âncora da Home.

Rascunhos aparecem na Home só para você (logado), com a etiqueta "Rascunho".

8. SEO e IA: o tema gera title, meta description, Open Graph, JSON-LD (Person,
   ProfilePage, Article), canonical limpo e sitemap só de páginas. Também serve
   /llms.txt (resumo do site e dos cases para crawlers de IA) e /llms-full.txt
   (com o texto completo dos cases). Se as URLs derem 404, salve de novo em
   Configurações › Links permanentes. Descrição opcional por case: caixa
   "Dados do case (Sera)" › "Descrição para o Google".
9. Em Sera · Cases, um aviso aparece quando um case foi importado de uma versão
   anterior da biblioteca do tema ("Atualizar conteúdo" traz a versão nova).

"Atualizar conteúdo" em Sera · Cases sobrescreve o texto da página com a versão
da biblioteca do tema (o WordPress guarda a anterior em Revisões).

== Changelog ==

= 3.18.5 =
* Paperplane: nova ficha da Lia (frente, costas e rosto) na etapa Personagens.

= 3.18.4 =
* Paperplane: avião pousa à direita do último botão; sem linha azul de foco; linha dos 23 dias só com "Arraste para ver"; manhã do relógio legível (véu escuro e texto claro); celulares mais largos, faixa inferior própria (não cobre a interface) e status bar com a cor do app.

= 3.18.3 =
* Paperplane: cards de regra contidos (o hover dos botões não passa para o card vizinho).
* Paperplane: noite com contraste medido (13:1 no pior horário); lista de horários sobre painel escuro fixo.
* Paperplane: virada do hero para a frase mais gradual (janelas de animação mais longas).

= 3.18.2 =
* Paperplane: notificação do banco fictício (Lowfield) com a frase de cartão estourado; tese centralizada sem rótulo.
* Paperplane: hover do card 03 contido no estágio; tipografia da Dobra em lista com amostras.
* Paperplane: scroll da home dentro da moldura mais suave; céu com contraste garantido na virada; linha dos 23 dias com botões, índice e roda do mouse.
* Paperplane: avião entra pela borda esquerda e pousa ao lado do botão principal.
* Home: card do Paperplane com frames reais do estúdio e selo em Geist.
* Textos do case revisados (inglês e português).

= 3.18.1 =
* Paperplane: notificação ocupa a largura toda da mesa no modo sem JS e com movimento reduzido (no celular o texto não estoura mais).

= 3.18.0 =
* Paperplane Studio: primeiro case da Home (ordem fixada no código, mesmo com a ordem salva em Personalizar › Sera · Home › Cases).
* Paperplane: tese com destaque próprio; mesa de janelas já nasce na grade 3×2 (sem espalhar); notificação no estilo de app bancário; ícones removidos dos cards de regra; saldo e CTA centralizados nos cards de crédito; botões do cursor centralizados.
* Paperplane: Dobra vira logo, cores e tipografia (sem controles); linha dos 23 dias com marcos em espaçamento igual e arraste mais leve.
* Paperplane: números animados sem recorte (68, 23); céu que clareia de forma gradual entre 08h e 10h; indicador de início do iPhone removido das telas do celular.
* Paperplane: cursor personalizado aparece sozinho (o do sistema some na página inteira enquanto o avião está ativo).
* Gerador do case (tools/paperplane-case): essas mudanças foram feitas direto nos arquivos gerados do tema, como o README do gerador indica para ajustes pequenos.

= 3.17.0 =
* Case novo: Paperplane Studio (/paperplane-studio/ e /pt/paperplane-studio/), EN + PT. Layout próprio (template-parts/cases/paperplane.php) com as telas reais do estúdio em iframes carregados sob demanda; arquivos em assets/cases/paperplane/ (GSAP local, sem CDN), carregados só nessa página. O conteúdo em blocos é a versão em texto (SEO, llms.txt).
* Card da Home e miniatura do "próximo case": mockup "paperplane" em HTML/CSS (assets/css/cases/pp.css). Imagem de compartilhamento em assets/og/paperplane-studio.jpg.
* Depois do deploy: Aparência › Sera · Cases › Paperplane Studio › "Importar e publicar" (ou "Importar e publicar todos"). Para mudar a posição na Home: Personalizar › Sera · Home › Cases.

= 3.16.1 =
* Experiência no mobile: título sem encolher, texto de apoio alinhado à esquerda embaixo do título, cabeçalho sem fixar.

= 3.16.0 =
* will bank: case reescrito em torno do Controle Temporal (EN + PT), com três carrosséis novos (faturas no tempo, antecipar parcelas, planejar compras).
* Logo dos sliders fixo no topo e centralizado, renderizado fora do scroller.
* Ícone de raio removido.

= 3.15.1 =
* Cards da Home: a pílula da marca volta a ficar centralizada no box do mockup.

= 3.15.0 =
* Topo da Home na opção B ("manifesto"): avatar pequeno com nome e cargo, título em largura total com a palavra que gira, parágrafo curto, "Ver trabalhos" + "Começar um projeto" e dois cartões de disponibilidade (vagas e freela). Campos novos no Personalizar: linha do cargo, notas dos cartões e texto do freela.

= 3.14.1 =
* Experience: a barra fixa na rolagem ficou sólida (sem transparência nem desfoque).
* Topo da Home volta a ser o da 3.13 enquanto a nova versão é escolhida.

= 3.14.0 =
* Topo da Home repensado: título mais curto, parágrafo mais direto, pílula "aberto a vagas de liderança e projetos freela", botão "Começar um projeto" (e-mail) e retrato num card de vidro (foto desfocada ao fundo, foto nítida, painel com "Atualmente" e "Aceitando projetos freela"). Campos novos no Personalizar: Freela — título e texto.

= 3.13.0 =
* Home: as ilustrações dos cards são posicionadas pelo tamanho real do card (main.js), com margens iguais, celulares inteiros na largura e corte só embaixo, na parte reta. Vale para pares de celulares e para navegador + celular, em todos os viewports.
* Experience: texto de apoio curto (EN e PT), uma linha no desktop, no máximo duas, sem vazar da barra fixa.
* Approach: um ícone Phosphor Regular em cada princípio (gráfico, lupa, alvo, chave).

= 3.12.0 =
* Lume: cada tela aparece uma vez só no case. Topo: replay (computador) + sessão perguntando (celular). Slider: a área do designer no computador e no celular (Estudos, Novo estudo, Roteiro), com as versões mobile seguindo o código do Lovable (topo de 64 px, tabela vira lista, editor do bloco fora da tela). Sessão do participante em 7 telas, com o estado "liberado para tocar". Achados: computador + celular lado a lado (lm-findings, no lugar de lm-shots-read).

= 3.11.0 =
* Lume: as telas agora são código (HTML/CSS), não imagens. 13 telas portadas 1:1 da UI do Lovable (tokens Pitaya, IBM Plex Sans, mesmos componentes) em inc/screens-lm.php, com estilo e animações em assets/css/lume-ui.css (escopo .lmx): cursor e toques, digitação do link do Figma, barras enchendo, ondas de voz, contadores, seleções e estrelas. Texto selecionável, nada de WebP.
* As animações só rodam com o mockup na tela (mesmo mecanismo dos outros cases); sem isso, ou com movimento reduzido, cada tela mostra o estado final.
* Removida a pasta assets/img/lm (5 MB).

= 3.10.0 =
* Lume: telas reais do produto, animadas (WebP animado, com quadro parado para quem prefere menos movimento): hero desktop + mobile, dois sliders desktop × mobile no estilo do Research Hub (lm-shots-setup e lm-shots-read) e a sessão do participante em 7 telas (lume-flow). Saem as telas recriadas em HTML.
* Pílula "Pagaleve | Lume" agora com fundo rosa sólido e texto branco.
* Novo posicionamento ("Product Design Lead que constrói com IA") como padrão do tema, em EN e PT: título, parágrafo, números, 4º princípio, Pagaleve na experiência, SEO e ordem dos cases.
* Aparência › Sera · Cases ganhou a caixa "Novo posicionamento da Home": aplica os textos novos por cima dos salvos, com "Desfazer".

= 3.9.0 =
* Novo case: Lume (em andamento), com mockups da sessão (lume, lume-flow), artefatos lm-*, versão em pt-br e imagem OG.
* Nova ordem padrão na Home: o Lume entra logo depois do Research Hub.
* Em Sera · Cases, use "Importar" no Lume (ele não existe ainda numa instalação antiga) e "Atualizar conteúdo" nos outros se quiser a versão nova da biblioteca.

= 3.0.0 =
* 7 cases, nova ordem na Home, llms.txt, SEO/JSON-LD revisado, CSS por case, menos CSS do core.

Fontes (self-hosted, OFL): Bricolage Grotesque, Geist, Geist Mono, Fraunces, IBM Plex Sans, IBM Plex Mono.
