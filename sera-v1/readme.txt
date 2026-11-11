=== Sera v.1 ===
Contributors: matheusserafim
Stable tag: 3.20.1
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

= 3.21.6 =
* Western Union: gráfico de releases ganha um desenho próprio para celular (mais estreito, rótulos maiores e quebrados em duas linhas). Desktop igual.

= 3.21.5 =
* Próximo case: a miniatura escala pela largura real do quadro (v2-case.js) e preenche certo em celular, tablet e desktop; em telas de toque fica no tamanho cheio.

= 3.21.4 =
* Piscadas no iPhone: o grão das seções escuras (home, cases, rodapé, céu do Paperplane) era um SVG com feTurbulence recalculado ao vivo, e às vezes com mix-blend-mode. O Safari redesenhava isso na rolagem e o conteúdo por cima piscava. Agora é PNG pré-renderizado (assets/img/grain-*.png), sem blend.

= 3.21.3 =
* Paperplane: cabeçalho escuro também com a classe do case (hdr-escuro), que a camada v2 cobria com a pílula clara.
* Paperplane no celular: no máximo 2 telas (iframes) vivas por vez; com 6 o iOS derrubava a aba e a página recarregava no meio da rolagem.

= 3.21.2 =
* Research Hub: imagem do hero sem contagem de pesquisas, pessoas e insights.
* Experience (will bank): "5M+" vira "milhões de clientes ativos".
* Cases no celular: a pílula de capítulo some enquanto se lê para baixo e volta ao rolar para cima.
* Bastidores: marca do design system cabe em 320px.

= 3.21.1 =
* Celular: cabeçalho escuro sobre seções escuras volta a funcionar no iPhone (camada de tinta real em vez de trocar o fundo do ::before com blur).
* Home: texto de apoio do "Selected work" não aparece mais por cima dos cards; linha da timeline de Experience passa ao lado do texto.
* Cases: miniatura do próximo case cabe em 360px; Antes/Depois (Acordo Certo, Bastidores) cabe no cartão; legenda com link não quebra em coluna; grade RFM do Fatal Model cabe em 360px.

= 3.21.0 =
* Camada v2 de refino visual, por cima do tema (assets/css/v2*.css e assets/js/v2*.js, escopo html.is-v2). Para desligar tudo: tirar "is-v2" do filtro language_attributes em functions.php.
* Geral: grão de papel, cabeçalho vira pílula flutuante ao rolar (escura sobre blocos escuros, com fio de progresso), wordmark SERAFIM de fundo no rodapé, à direita, sem aumentar o rodapé.
* Home: labirinto atrás do hero com um caminho azul que passeia pelos corredores (clique manda ele para o ponto; parado com movimento reduzido; só paredes no celular). Título entra linha a linha e a frase cinza escurece no scroll.
* Home, cases: cards só com título e os três pontos, cada ponto com um ícone (mapa por slug em v2-home.js); sai o parágrafo. Barra "Selected work" fixa só com título e contador. O scroll dos cards segue o do tema.
* Home: Approach em bloco escuro de largura total; Experience com linha do tempo e ponto "now"; barras fixas com fundo sólido até o topo.
* Cases (menos Paperplane): hero em duas colunas com as métricas à direita, capa que abre no scroll, numeral grande em cada capítulo, capítulo atual dentro do cabeçalho com lista ao clicar (pílula embaixo em telas menores), painéis escuros de largura total, bloco grande de próximo case. Cor de destaque vem da marca de cada case.

= 3.20.1 =
* Paperplane: rolagem leve de novo (o cabeçalho escuro não força layout a cada quadro; menos desfoque na noite).

= 3.20.0 =
* Paperplane: partículas das animações acompanham a rolagem e não vazam por cima de outras seções.

= 3.19.9 =
* Paperplane: barra de leitura em limão no cabeçalho escuro.

= 3.19.8 =
* Paperplane: cabeçalho escuro só quando o fundo da página é preto.

= 3.19.7 =
* Paperplane: logo branco no cabeçalho escuro.

= 3.19.6 =
* Paperplane: "Pedir acesso ao beta" abre e-mail para mthsrfm@gmail.com.

= 3.19.5 =
* Paperplane: some a dica "Para pedir ajuda, chame o Origami" das telas.

= 3.19.4 =
* Paperplane: cabeçalho vira vidro escuro com texto claro quando passa sobre as dobras escuras.

= 3.19.3 =
* Paperplane: mesa de janelas no celular quadrada, janelas mais largas e notificação ajustada.

= 3.19.2 =
* Paperplane: tese mais curta; "AI wrote the code." em fonte de código com cursor piscando.

= 3.19.1 =
* Paperplane: mesa mais baixa no desktop; no celular as janelas voltam a ocupar a mesa.

= 3.19.0 =
* Paperplane: mesa de janelas cabe na tela, grade centrada com cartões de proporção fixa; notificação no estilo iOS, agora do Lowfield Bank / Banco Lowfield.

= 3.18.9 =
* Paperplane: dobra da noite refinada (vidro leve, trilho de horas, hora ativa em limão, relógio menor).

= 3.18.8 =
* Paperplane: o avião do fecho entra pela borda esquerda da tela, sem corte no parágrafo.

= 3.18.7 =
* Paperplane: a linha dos 23 dias não anda mais com a rolagem; só com arraste.

= 3.18.6 =
* Paperplane: celulares com área segura de verdade (o app recua 34px embaixo) e a barrinha do iOS por cima do app, como no aparelho.

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
