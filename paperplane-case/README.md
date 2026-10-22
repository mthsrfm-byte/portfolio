# Paperplane · case (rascunho v4)

Prévia: `../paperplane-case.html` (página inteira, com o CSS, as fontes, as imagens, os vídeos e os scripts do Sera v.1 embutidos; abra no navegador e role devagar).

Diagnóstico da v3 e orientações da v4: `BRIEF.md`.

Os arquivos aqui seguem a estrutura do tema e entram nele como estão:

| Arquivo | O que é |
|---|---|
| `inc/i18n/cases/paperplane.php` | Texto do case (PT), nos blocos `sera_b_*` |
| `inc/screens-pp.php` | Telas do Paperplane em código (`sera_pp_desk`, `sera_pp_phone`); os quadros usam as imagens reais dos episódios (`sera_pp_frame`, `sera_pp_src`) |
| `template-parts/artifacts/pp.php` | Artefatos `pp-*` |
| `template-parts/mockups/` | `paperplane` (hero), `pp-tour` (o estúdio em 10 etapas, preso na rolagem), `pp-nodes` (modo avançado animado), `pp-duo` (celular dobrável que abre com a rolagem, com o título do capítulo 07) |
| `assets/css/pp-ui.css` | UI do produto, escopada em `.ppx` |
| `assets/css/cases/pp.css` | Artefatos, palcos, tour, Duo e as demos do laboratório (escopadas em `.ppl`) |
| `assets/js/pp-case.js` | Tudo o que se move no case: Duo e demos do laboratório (portados da landing), tour, modo avançado, abas, estilos, roteador e vídeos. Sob movimento reduzido, tudo para num estado completo |
| `assets/cases/paperplane/` | Quadros, fichas, cenários, estilos e clipes (mp4, só carregam quando aparecem na tela) gerados no Paperplane para “Sem Partidas” e “A estação sem nome”, mais as mãos do Duo |

Para ligar no tema:

1. `functions.php`:
   - `require_once` de `inc/screens-pp.php`;
   - enfileirar `pp-ui.css` junto do `lume-ui.css`;
   - incluir `pp` na regex de `sera_case_prefixes()`, `'paperplane' => array( 'pp' )` e `'pp-' => array( 'pp' )` em `sera_mockup_prefixes()`;
   - enfileirar `assets/js/pp-case.js` (defer, no rodapé) quando o conteúdo tiver `wp:sera/artifact {"name":"pp-` ou `"mockup":"pp-`.
2. `inc/blocks.php`: adicionar em `sera_artifact_names()` os nomes `pp-glance`, `pp-coldopen`, `pp-tabs`, `pp-pains`, `pp-market`, `pp-spell`, `pp-principles`, `pp-cast`, `pp-styles`, `pp-take`, `pp-4k`, `pp-router`, `pp-engines`, `pp-models`, `pp-lab`, `pp-made`, `pp-solo`, `pp-status`, `pp-reflection`, `pp-signals`.
3. `inc/template-tags.php`: adicionar os quatro mockups em `sera_mockups()`.
4. `page.php`: `'paperplane' => 'pp'` e `'pp-' => 'pp'` no mapa do próximo case.
5. `inc/starter-content.php`: a versão em inglês e a entrada do case (slug `paperplane`), quando o texto em PT estiver aprovado.

O capítulo 07 não usa `sera_b_chapter()`: o título fica dentro do mockup `pp-duo` (com as mesmas classes `kicker` e `h2.chapter`), para ficar preso na rolagem junto do aparelho.
