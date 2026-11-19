=== Sera v.1 ===
Contributors: matheusserafim
Stable tag: 3.20.1
Requires at least: 6.4
Tested up to: 6.8
Requires PHP: 7.4
License: Proprietary. All rights reserved

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

== Propostas comerciais privadas ==

/proposal/evanly (e o atalho /proposal/evenly; links antigos em /comercial/ redirecionam): proposta da Evanly, fora do
menu, do sitemap e do Google (noindex + no-store). Código em inc/proposals.php,
termos em inc/proposals/evanly.php, página em template-parts/proposals/.

Antes de mandar o link:
1. Ferramentas › Propostas: defina o código de 4 dígitos (fica salvo como hash,
   nunca no repositório). Alternativa no wp-config.php:
   define( 'SERA_PROPOSAL_PIN_EVANLY', '....' );
   Sem código definido, a página fica trancada.
2. Na mesma tela: e-mail que recebe aceites e perguntas, e "Enviar e-mail de
   teste para mim" para conferir se o WordPress consegue mandar e-mail.
3. A confirmação automática para o cliente fica desligada até você ligar.

Aceites e perguntas aparecem em Ferramentas › Propostas (só admin), com status
da notificação e botão de reenviar. "Encerrar todas as sessões" ou trocar o
código derruba quem estiver com a página aberta. Mudou preço ou termos? Suba
'version' em inc/proposals/evanly.php: aceites antigos guardam os termos que
viram (cópia + hash).

Prévia estática (sem servidor): php tools/proposal-preview/build.php evanly

== Changelog ==

= 3.47.0 =
* Paperplane na home: o mockup do card fica claro, no visual da home nova (papel, lima #E4F65C, Geologica e Onest), com o logotipo "P" no selo, no menu, no celular e na ilha; as imagens viram as da landing (anime).
* Case do Paperplane: as últimas imagens antigas saem (sb-c e ficha-lia que faltavam); a do "Continuar de onde parei" vira a da landing.

= 3.46.0 =
* Paperplane Studio: facelift do case com a linguagem da home nova (brand kit 0.2, "Dobradura"): Geologica, Onest e Geist Mono; lima #E4F65C com a dobra #9DB321; papel liso, cartões com fio, grifo que dobra nos títulos, rótulo de capítulo com número em lima; telas do estúdio claras com o logotipo novo e as imagens e vídeos da landing; a moldura do "07 · O site" mostra a home nova (só topo, tour, bolso e lista); cada zona com as próprias cores e o menu preto no escuro. Textos: só nomes que mudaram (fontes, "Dobradura", citações da home).

= 3.45.1 =
* Experiência: sai o texto de apoio ("Fui gestor e voltei a IC...") do título e da barra fixa.
* Home: mockups dos cards enterrados na pilha ou bem abaixo da dobra viram um bloco skeleton (conteúdo não renderizado) e voltam antes de entrar na tela. Menos memória ao voltar pro topo (camadas de composição no topo: 155 → 46).

= 3.45.0 =
* Scroll suave com Lenis (darkroomengineering/lenis 1.3.4, MIT) em assets/js/lib/lenis.min.js, no lugar do scroll suave feito à mão (que fica de reserva se o Lenis não carregar). Âncoras do menu e o voo de volta ao topo passam pelo Lenis. Touch, teclado e barra de rolagem seguem nativos.

= 3.44.4 =
* Home: o menu fixo sobre blocos escuros fica preto sólido, sem o cinza translúcido.

= 3.44.3 =
* Home: scroll dos cases liso, sem pisca. Os nove cards ficam empilhados (sticky) e todos continuavam desenhando por baixo: o chão 3D de cada um (três grades inclinadas com blur e máscara) era refeito a cada quadro e os mockups rodavam ~110 animações em loop ao mesmo tempo.
* O chão agora é desenhado uma vez num canvas, com a mesma conta do CSS, e entra como imagem plana (o CSS fica de reserva).
* Card já coberto pausa as animações; dois abaixo do topo da pilha nem é desenhado (o que está logo abaixo continua, para rolar de volta sem buraco). Cards bem abaixo da dobra também ficam pausados.

= 3.44.2 =
* Home: menos espaço entre a faixa de marcas e o primeiro case (era 144px, sobra do título fixo que saiu; agora 24–48px).
* Cards: corrigido o pisca no scroll. Sai o parallax (nada roda por quadro de scroll), o grão vira fundo do próprio card (sem mix-blend por cima de tudo) e a máscara do nome só existe durante o hover e fecha ao rolar.

= 3.44.1 =
* Selected work: sai a linha fixa "Selected work" (com o contador 01 / 09); o título fica só para leitor de tela.
* Scroll dos cards orgânico: rolagem nativa, sem snap nem passo de um card por gesto. Cada card gruda logo abaixo do header e o próximo simplesmente pousa por cima, sem sombra, escurecimento, encolhimento ou fade; só um fio de 1px marca a borda.
* A transição do nome nascendo da linha de base e o fade das cover lines saem; fica só o parallax leve por camada.

= 3.44.0 =
* Selected work: cards novos "Capa". O nome curto do case vira o masthead (Bricolage 800, 75%, caixa alta, na largura toda do card) e o mockup fica na frente dele, cobrindo uns 26% de baixo das letras, com sombra longa. Cover lines nos cantos: ano · empresa e papel; "Proof" com a primeira métrica; o resto do título com "Read case"; segunda e terceira métricas. Chão 3D e grão da capa embaixo.
* Cards: com o cursor perto do nome, as letras viram os grãos redondos da poeira da capa e são empurradas para fora; o canvas sai pela borda do card e nunca desenha por cima do mockup.
* Cards: parallax no scroll vertical por camada (chão, nome, mockup, cover lines). Transição entre cases: enquanto o próximo card sobe por cima do atual, o nome dele nasce da linha de base e as cover lines assentam por último. Sem grãos nem movimento com "reduzir movimento".
* Cards no celular: nome no topo, mockup na largura toda, cover lines em duas colunas. Só o mockup de celular (sem navegador nem antes/depois); o celular sozinho fica maior e ocupa o palco. Em tela baixa a terceira métrica sai antes do mockup apertar.
* Palco do mockup no desktop e tablet mais baixo e cheio (528 × 600), com menos espaço vazio em cima e embaixo.
* Arquivos: template-parts/case-card.php, assets/css/capa.css e assets/js/capa.js (novos, só na home), ajuste no layout dos aparelhos em main.js e regra do celular em mockups.css.

= 3.43.1 =
* Capa (Coreo · Logo): os grãos em voo voltam a desviar do texto, como na Coreografia do Hero Lab; só o grão já pousado no logo ignora a copy.
* Header da home: o menu do topo fica parado no lugar e sobe com a página; a barra sticky entra quando a faixa de marcas chega no topo.
* Header da home: o logo já é o logo da barra sticky desde o início e espera fixo no lugar dele, então os grãos que viram logo sempre vão para lá; quando a barra entra, só o fundo, o menu e os botões aparecem em volta dele.
* Capa: a poeira desvia do menu e dos botões como um bloco só, sem entrar nos vãos entre os itens.
* Capa: 40% menos grãos (o logo de partículas continua sólido) e nenhum grão acima do menu.
* Capa: a saída do 3D realista para o voo dura 20% mais (2,4 s em vez de 2 s); o resto da coreografia só começa 0,4 s depois.
* Home: o labirinto do hero não quebra mais ao redimensionar a janela.
* Desempenho da capa: o busto para de desenhar quando a capa sai da tela (antes a GPU ficava ocupada no site inteiro), o loop roda no máximo a 60 quadros por segundo também em telas de 120 Hz, a poeira só calcula os pontos que aparecem, a direção do desvio só perto do texto, o pass de caracteres só na área do busto e sem MSAA no buffer intermediário.
* Desempenho do header: o vidro fosco fica desligado enquanto está invisível.
* Header: saiu também o cursor "Você"; o header usa o ponteiro normal do sistema.
* Diagnóstico (?cvdebug): window.__cvGpu.stats() dá o tempo de GPU de cada quadro; ?cvdpr, ?cvms e ?cvaa comparam resolução e antialias.
* Header da home: sobre blocos escuros a barra volta a escurecer (antes o texto clarinho ficava sobre fundo claro).

= 3.43.0 =
* Capa: o retrato em ASCII aparece já no carregamento, desenhado de um mapa de 9 KB (assets/img/cover-ascii.png) sem esperar o modelo 3D. Quando o modelo chega, esse mesmo ASCII se dissolve célula a célula no busto realista e o loop começa. Para refazer o mapa: abrir a home com ?cvdebug e rodar window.__cvBake().
* Capa: o busto termina sempre num véu para transparente na base da caixa (ASCII, 3D e foto de reserva).
* Header: saiu o cursor "Matheus"; fica só o cursor do visitante.
* Header da home: ao rolar a capa some o menu e fica só o logo de partículas; a barra inteira entra quando a faixa de marcas chega no topo.

= 3.42.9 =
* Header da home: o menu espera escondido até o layout compacto estar pronto e entra com um fade, sem piscar inteiro no carregamento.

= 3.42.8 =
* Capa: os grãos remedem a posição dos textos a cada frame, então desviam do menu e da copy mesmo quando eles se movem.

= 3.42.7 =
* Header: tirei o nome "Matheus Serafim" ao lado do logo em todas as páginas.

= 3.42.6 =
* Capa: clicar no rosto só solta a onda quando o busto está em 3D realista; nas outras fases o clique não interrompe a coreografia.
* Header da home no topo: sem o nome à esquerda, menu + idioma + Let's talk juntos e centralizados, na largura do logo; ao rolar eles deslizam para o layout normal.
* Header da home rolado: barra de ponta a ponta no topo, sem a pílula flutuante.
* Scroll: a transição busto → grãos → logo do menu começa e termina ~30% mais tarde.
* Grãos contornam os textos (capa e menu) de forma líquida, inclusive durante o voo até o logo.
* Sem contorno preto ao clicar na página (foco do <main>).

= 3.42.5 =
* Capa: se o 3D não carregar, entra a foto original do escaneamento (assets/img/cover-fallback.webp, sem fundo) no mesmo lugar do busto, na frente do logo.

= 3.42.4 =
* Capa: o celular acha o modelo leve mesmo quando o servidor entrega uma cópia antiga da página em cache.

= 3.42.3 =
* Busto 3D no iPhone: celular e tablet carregam um modelo leve (assets/models/matheus-busto-m.glb, texturas até 2048px, ~5 MB na entrega) e renderizam sem antialias extra, o que corta a memória de vídeo que o Safari do iOS limita. Desktop segue com as texturas originais.
* Texturas de volta em JPEG (formato que todo navegador decodifica igual); geometria continua quantizada.
* Se depois de alguns quadros o busto não aparecer na tela, ou demorar mais de 20 s, a capa mostra a foto; se o 3D chegar depois, ele assume.

= 3.42.2 =
* Capa: se o busto 3D não carregar (WebGL indisponível, modelo que falha, erro no navegador), entra a foto no lugar e a capa nunca fica vazia.
* Diagnóstico: abra a home com ?cvdebug no endereço para ver na tela o que o navegador fez (WebGL, download do modelo, primeiro quadro ou o erro).

= 3.42.1 =
* Home: a capa termina num degradê para o papel do site (mesma cor, chão em grade sumindo aos poucos) e a faixa de logos começa com respiro proporcional, sem a linha dura em cima.
* Modelo 3D 51% menor (14,7 MB → 7,2 MB, ~5,2 MB comprimido na entrega): geometria quantizada (KHR_mesh_quantization), malhas grandes divididas em índices de 16 bits e texturas em WebP na resolução original. assets/models/.htaccess liga compressão e cache de 1 ano para o .glb.
* O vidro do header só fica transparente enquanto as partículas voam para o logo.

= 3.42.0 =
* Home: nova capa de revista. Logo SERAFIM como masthead, busto 3D (assets/models/matheus-busto.glb) na frente dele e quatro chamadas de capa (template-parts/cover.php, assets/css/cover.css, assets/js/cover.js).
* Coreografia em loop: foto, onda de grade, explosão de partículas, logo de partículas (troca invisível com o SVG), retorno, rosto em ASCII, nova explosão e volta à foto. Clicar no busto recomeça e a onda sai do ponto clicado.
* Scroll: depois de ~10% da tela, o busto vira partículas que formam o logo do header; ao voltar ao topo a foto se monta em blocos e o ciclo recomeça.
* Header da home: cursores no estilo Figma ("Matheus" passeia pelo menu; o seu segue o mouse). Só em desktop com mouse.
* Chão em grade com profundidade de campo. Three.js 0.160 fica no tema (assets/js/lib/three), sem CDN.
* Saiu o bloco antigo de título do hero; a faixa de logos continua.

= 3.41.1 =
* Proposta: corrigido o "isn't available right now" depois de cadastrar a senha (o cache da hospedagem tinha guardado a tela antiga). A tela da senha agora é igual para todos e /proposal/ fica fora do cache. A senha é pedida de novo a cada atualização da página (passe de uso único).

= 3.41.0 =
* Proposta: endereço novo /proposal/evanly (atalho /proposal/evenly). Os links /comercial/... redirecionam para lá. Primeira publicação da proposta.

= 3.40.3 =
* Proposta: o preço entra caractere por caractere, do desfocado para o nítido, devagar; depois USD, a frase de preço fixo e a divisão 50/50.

= 3.40.2 =
* Proposta: sem a etiqueta preta e sem a barra de progresso no desenho; no celular o prédio ficou 35% menor e as etiquetas mais compactas; mais espaço entre o passe de metal e a confirmação.

= 3.40.1 =
* Proposta: giro do formulário para o passe de metal refeito (um objeto 3D só, giro e leve elevação em curvas suaves, sem engasgo). Depois do aceite, o formulário de perguntas some.

= 3.40.0 =
* Proposta: novo prédio em three.js contando a história da Evanly. A lavanderia térrea de hoje (tracejada, com medidas), a fundação e o térreo de concreto, depois 4 andares com 48 casas, varandas alternadas, placas solares e uma lavanderia nova no térreo. Linhas de trás escondidas e câmera que se afasta conforme o prédio cresce.
* Proposta: ao aceitar (depois de gravar no servidor), a caixa do formulário gira e vira um passe de metal escovado com o nome, "Pass No. 001" e "Estimated kickoff"; embaixo, confirmação com data, valor e versão.
* Proposta: ícones nos entregáveis das 3 etapas; cards do "Why work with me?" entram um a um do desfocado pro focado; FAQ abre uma pergunta por vez.

= 3.39.0 =
* Proposta: o prédio em three.js saiu do topo e foi para as 3 etapas. Fica fixo ao lado (no celular, no alto da tela) e o scroll monta: levantamento tracejado, fundação e estrutura, depois fachadas, cobertura e entorno. Desenho mais detalhado e barra de progresso das etapas.
* Proposta: FAQ depois do aceite (ajustes em até 2 rodadas, rodada extra a partir de US$50, fora do escopo = novo orçamento, cancelamento com multa de 50% da entrada, pagamento, início, produção, validade).
* Proposta: validade comercial de 7 dias a partir de 'issued' em inc/proposals/evanly.php. Depois disso o aceite fecha no servidor (perguntas continuam abertas).
* Proposta: bilhete pro Alex aparece de desfocado para focado; título do aceite com "?"; capa da Acordo Certo centralizada.

= 3.38.1 =
* Proposta: novo cronograma. Etapa 1 nos dias 1 e 2, etapa 2 nos dias 3 a 5, etapa 3 nos dias 6 a 10.

= 3.38.0 =
* Proposta: prédio em traço feito em three.js no topo (montado da fundação pra cima, com as 3 etapas do sprint). three.js 0.149 (MIT) fica no tema em assets/js/lib, sem CDN.
* Proposta: "Why work with me?" com as capas reais dos cases (will bank, Pagaleve, Acordo Certo), animadas como na home; cada card abre o case numa aba nova.
* Proposta: textos personalizados com a linguagem do site da Evanly (rastrear cada número até a fonte, developers e funders, da aquisição à operação).

= 3.37.3 =
* Proposta: título do topo menor, em 2 linhas.

= 3.37.2 =
* Proposta: seção "I’ve made money feel simple before." com 5 cases (will bank, Western Union, Pagaleve, Acordo Certo, Paperplane) em cards que entram como cartas e inclinam com o mouse.

= 3.37.1 =
* Proposta: foto nova, colorida.

= 3.37.0 =
* Nova página privada de proposta comercial em /comercial/evenly (alias /comercial/evanly): código de 4 dígitos checado no servidor, limite de tentativas, sessão assinada de 2h, aceite e perguntas gravados com notificação por e-mail, tela Ferramentas › Propostas. O resto do site não muda.

= 3.36.4 =
* Correção urgente: a home ficou sem estilo porque o cache guardou uma cópia com CSS e JS em http://, que o navegador bloqueia em página https. Os endereços do tema agora saem sempre em https e o cache é limpo uma vez.

= 3.36.3 =
* Prévia de link: nova imagem da home (logo grande em fundo escuro), no lugar da que mostrava o título antigo.

= 3.36.2 =
* Prévia de link: título e descrição da home mais curtos, sem cortar no WhatsApp e no Google, alinhados com o título atual do site (EN e PT).

= 3.36.1 =
* Idioma: o botão de trocar idioma voltou a funcionar. O cache da hospedagem guardava a página em português no endereço da inglesa; agora cada idioma fica no seu endereço e o cache antigo é limpo uma vez.

= 3.36.0 =
* Paperplane · Universo: "Quem vive aqui" mostra só o rosto da Lia e do Dante, recortados das fichas e encaixados no quadro; o Condutor saiu.
* Paperplane · Personagens: a miniatura "Em uso" e o avatar da Lia usam o rosto da ficha atual, centralizado.
* Paperplane · Estilo visual: o estilo "Anime noturno" virou "Desenho 2D Rabisco", com quatro imagens novas.
* Paperplane · Movimento: o pedido da tomada descreve a Lia correndo pela plataforma atrás do avião de papel.
* Paperplane · Storyboard avançado: selos "REFERÊNCIA #1…#5", sem as tags "não cabe no gerador", e cada conector chega num ponto próprio do Prompt, sem se cruzar.
* Paperplane · Celulares: os aparelhos das laterais ficam retos e sem redução por transform, então a tela não borra mais.
* Paperplane: o fim do case não mostra mais um fio escuro abaixo do "Próximo case".

= 3.35.0 =
* Selected work: o título de cada card diminui só o necessário para caber, em qualquer idioma e largura; o botão "Read case" não é mais cortado pela borda do card.

= 3.34.1 =
* Back to top: a página não termina mais fora do topo quando o clique vem junto com rolagem (inércia do trackpad, roda do mouse ou toque). A entrada fica bloqueada desde o clique e a posição é mantida no topo durante todo o voo.

= 3.34.0 =
* Labirinto: a cabeça do caminho agora é quadrada (no hero e no back to top).
* Back to top: as cobrinhas sobem coladas na página, uma de cada lado, e saem pelo topo; nada fica parado esperando lá em cima.
* Back to top em páginas longas (cases): em vez da folha em branco, o miolo vira um esqueleto da própria página (faixas escuras, blocos no lugar das telas, barras no lugar dos textos) e volta a ser a página real ao chegar no topo.

= 3.33.0 =
* Back to top mais liso: o voo roda como animação na GPU, as animações da página pausam durante o trajeto e, em páginas longas, só as duas pontas são sobrevoadas de verdade (o miolo passa como uma folha de papel lisa, sem faixa em branco por falta de pintura).
* Barra de rolagem da página: trilho de papel e polegar fino em tinta.
* Duas cobrinhas, uma de cada lado da página: corpo curto que sobe serpenteando do rodapé ao topo e deixa um rastro leve.

= 3.32.2 =
* Aviso de direitos reservados: o tema deixa de se declarar GPL; LICENSE e README na raiz do repositório proíbem cópia e reutilização.

= 3.32.1 =
* Approach no celular e tablet em uma coluna: os itens 01 e 03 não têm mais o fio vertical à direita; só os fios horizontais.

= 3.32.0 =
* Back to top em "vista aérea": a página pula para o topo escondida, encolhe sobre um labirinto (o mesmo do hero, com a rota azul subindo do rodapé ao topo), voa até o começo e mergulha no hero. Nenhuma animação de scroll roda de trás para frente. Com movimento reduzido ou a menos de uma tela e meia do topo, segue a rolagem simples.
* Linha de cargo do topo: "Product Designer & Builder · Now at Pagaleve" (pt: "Hoje na Pagaleve"); quem tinha o texto antigo salvo no Personalizar é atualizado sozinho.

= 3.31.1 =
* Home no celular: o caminho do labirinto fica só na faixa à direita do texto (mede onde termina a linha mais longa do título e do nome), sem passar por baixo das palavras.

= 3.31.0 =
* Paperplane, noite no celular: o sol fica solto sobre o céu escurecido (sem caixa), sol + hora + cartão centrados na tela, com véu escuro fixo para a legibilidade nunca depender da foto. Painel e trilha ficam num contêiner próprio: as notas viram a linha de chegada e o painel sobe com elas, sem passar por cima.

= 3.30.1 =
* Paperplane, "Sem saldo": as partículas paradas sobre o botão ficam verdes e translúcidas (voltam à cor normal ao sair) e a interação toda ficou ~30% mais rápida.

= 3.30.0 =
* Home, labirinto: o caminho ficou vivo. Anda mais rápido e com ritmo variado, pausa pouco (0,35–1,25 s), tem rastro mais longo e abre um anel a cada chegada. No celular o caminho agora aparece e passeia pelo labirinto inteiro, discreto atrás do texto.
* Paperplane: "Simple outside, advanced inside." vira "Effortless to use, serious under the hood." (PT: "Fácil de usar, sério por baixo do capô."), também no índice e na linha do tempo. Rodar Aparência › Sera · Cases › "Importar e publicar todos".

= 3.29.0 =
* Paperplane, "Sem saldo": o botão vira medidor. Oito partículas saem do saldo e enchem o botão só até onde o saldo cobre (10 de 24), uma marca tracejada mostra onde precisaria chegar; segura, balança de leve, esvazia e devolve tudo. Sai o contorno de 40 pontos. Texto do card atualizado (EN/PT).
* Paperplane, Dobra: o cartão do design system acompanha a rolagem ao lado da prévia (sticky) no desktop e no tablet.
* Paperplane, home dentro do navegador: só o iPhone Duo, sem os quatro celulares em volta (como no site real).

= 3.28.1 =
* Paperplane, dez etapas (desktop/tablet): o texto de apoio abre e fecha com altura real (grid 0fr → 1fr) numa curva longa, e o texto aparece um instante depois. Sai o "pá, pá, pá" do max-height.
* Paperplane, botão "Draw" no celular: o "· reserva até N" não abre mais para os lados (estourava o card).

= 3.28.0 =
* Home, cards do Selected work: título bem maior e com linhas cheias (desktop até 76px, tablet e celular maiores), ocupando o espaço do card. A linha de cima fica só com ano e papel resumido; a empresa sai (já está no selo da imagem).
* Research Hub: imagens com ?v= da versão, para o navegador não mostrar a versão antiga em cache (a que ainda tinha contagem de pesquisas).

= 3.27.0 =
* Paperplane no celular, noite de curadoria em modo palco: um painel preso (sticky nativo) com o arco largo, a hora e um único item, o da hora do sol; a rolagem passa por uma trilha vazia. Sol e item mostrado nunca divergem. Desktop e tablet seguem com a coluna do arco e a lista.
* Paperplane: ScrollTrigger com ignoreMobileResize, para a barra do Safari aparecendo/sumindo não recalcular os pins no meio da rolagem (a página "pulava").

= 3.26.0 =
* Paperplane, noite de curadoria: sol em arco no lugar do mostrador (05 → 12), posição só por CSS a partir de --h. Contraste fixo em todas as horas: texto sempre claro sobre vidro escuro (lista e notas), sem trocar cor de texto/fundo com a hora. Medido: texto secundário ≥ 7:1 das 05 às 12.

= 3.25.1 =
* Paperplane, hero: o avião entra pela borda da tela (como o do fim da página), não mais pela margem da coluna, que cortava a entrada.

= 3.25.0 =
* Home, Selected work: sem a faixa morta entre o título fixo e o cartão. O cartão para logo abaixo do título, o anterior encolhe e some em vez de subir por trás (acabam as sombras empilhadas nas laterais) e a borda do título vira um degradê curto.

= 3.24.0 =
* Menu 03 "troca lenta": a pílula volta a escurecer sobre blocos escuros (Approach, zonas escuras do Paperplane, painéis em largura total), agora com transição de 0,9 s por uma camada de opacidade. Detecção leve em v2.js (só os blocos escuros, medidos no carregamento/redimensionamento). Mantém botões de 12px e paddings de 3.23.
* Barra de status do iPhone acompanha o menu (meta theme-color clara/escura).
* Paperplane: troca das dez etapas em fade cruzado mais longo (tela e legenda no celular); "3C" não fica mais por cima do "Take #1.0" no card 04; sai o bloco "curvas do produto".

= 3.23.0 =
* Menu: botões levemente quadrados (12px) com a pílula concêntrica (19px desktop, 23px celular); marca com a mesma folga à esquerda que em cima/embaixo; sem fio de progresso.
* Paleta: o azul sai do tema; destaque em tinta (#111110) e cinza claro sobre escuro. Palavra rotativa do hero em tinta.
* Home: status de disponibilidade num bloco só, com pontos em tinta.
* Back to top funciona no celular (o alvo #top é o cabeçalho fixo) e não é cortado no desktop.
* Paperplane no celular: rostos em 2×2; noite de curadoria com barra fixa compacta e escura; bloco do site só com o iPhone rolando a home (pin 2,6 telas).
* Performance: Paperplane sem layout forçado por quadro (topos em cache, linha dos 23 dias e avião pausados fora da tela), v2.js sem medir a página inteira, título do hero só refaz layout quando a largura muda. Headshot reduzido e logos quantizados sem perda visível.

= 3.22.0 =
* Menu em vidro claro fixo (opção 01): mesma pílula fosca sobre qualquer fundo, sem trocar para escuro (v2-dark e hdr-escuro desligados). Pílula e botões em cápsula completa, também no celular.

= 3.21.9 =
* Próximo case: na miniatura o celular fica sempre na frente do navegador (o navegador cobria metade da tela do iPhone).

= 3.21.8 =
* Paperplane, "seis ferramentas" no celular: a mesa ocupa a altura da tela e as janelas viram grade 2×3 (antes 3×2 espremida); a dobra fecha as duas colunas para o meio. Grão da mesa em PNG, sem blend.

= 3.21.7 =
* Hero dos cases no celular (Bastidores, Acordo Certo, Lume, Research Hub): só o iPhone, maior e centralizado; sai o navegador ilegível.

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
