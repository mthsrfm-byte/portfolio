# Paperplane · case (rascunho v2)

Prévia: `../paperplane-case.html` (página inteira, com o CSS, as fontes, as imagens e os scripts do Sera v.1 embutidos).

Os arquivos aqui seguem a estrutura do tema e entram nele como estão:

| Arquivo | O que é |
|---|---|
| `inc/i18n/cases/paperplane.php` | Texto do case (PT), nos blocos `sera_b_*` |
| `inc/screens-pp.php` | Telas do Paperplane em código (`sera_pp_desk`, `sera_pp_phone`); os quadros usam as imagens reais dos episódios (`sera_pp_frame`, `sera_pp_src`) |
| `template-parts/artifacts/pp.php` | Artefatos `pp-*` |
| `template-parts/mockups/` | `paperplane` (hero), `pp-shots-studio` (slider), `pp-nodes`, `pp-cut`, `pp-duo` (celular dobrável que abre com o scroll) |
| `assets/css/pp-ui.css` | UI do produto, escopada em `.ppx` |
| `assets/css/cases/pp.css` | Artefatos, palcos e o Duo |
| `assets/js/pp-duo.js` | Motor do Duo (CSS 3D), portado da landing do Paperplane |
| `assets/cases/paperplane/` | Quadros, fichas, cenários e estilos gerados no Paperplane para “Sem Partidas” e “A estação sem nome” (webp), mais as mãos do Duo |

Para ligar no tema:

1. `functions.php`:
   - `require_once` de `inc/screens-pp.php`;
   - enfileirar `pp-ui.css` junto do `lume-ui.css`;
   - incluir `pp` na regex de `sera_case_prefixes()`, `'paperplane' => array( 'pp' )` e `'pp-' => array( 'pp' )` em `sera_mockup_prefixes()`;
   - `pp` na regex que carrega o `shots.js` (`(rh|lm|pp)-shots-`);
   - enfileirar `assets/js/pp-duo.js` (defer, no rodapé) quando o conteúdo tiver `"mockup":"pp-duo"`.
2. `inc/blocks.php`: adicionar em `sera_artifact_names()` os nomes `pp-glance`, `pp-coldopen`, `pp-scatter`, `pp-pains`, `pp-market`, `pp-statement`, `pp-principles`, `pp-acts`, `pp-cast`, `pp-consist`, `pp-styles`, `pp-engines`, `pp-gpu-map`, `pp-lab`, `pp-made`, `pp-solo`, `pp-status`, `pp-reflection`, `pp-signals`.
3. `inc/template-tags.php`: adicionar os cinco mockups em `sera_mockups()`.
4. `page.php`: `'paperplane' => 'pp'` e `'pp-' => 'pp'` no mapa do próximo case.
5. `inc/starter-content.php`: a versão em inglês e a entrada do case (slug `paperplane`), quando o texto em PT estiver aprovado.
