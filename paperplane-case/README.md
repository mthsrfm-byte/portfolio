# Paperplane · case (rascunho)

Prévia: `../paperplane-case.html` (página inteira, com o CSS e as fontes do Sera v.1 embutidos).

Os arquivos aqui seguem a estrutura do tema e entram nele como estão:

| Arquivo | O que é |
|---|---|
| `inc/i18n/cases/paperplane.php` | Texto do case (PT), nos blocos `sera_b_*` |
| `inc/screens-pp.php` | Telas do Paperplane em código (`sera_pp_desk`, `sera_pp_phone`) e os quadros desenhados em SVG |
| `template-parts/artifacts/pp.php` | Artefatos `pp-*` |
| `template-parts/mockups/` | `paperplane` (hero), `pp-shots-studio` (slider), `pp-nodes`, `pp-cut` |
| `assets/css/pp-ui.css` | UI do produto, escopada em `.ppx` |
| `assets/css/cases/pp.css` | Artefatos e palcos do case |

Para ligar no tema:

1. `functions.php`: `require_once` de `inc/screens-pp.php`; enfileirar `pp-ui.css` junto do `lume-ui.css`; incluir `pp` na regex de `sera_case_prefixes()`, `'paperplane' => array( 'pp' )` e `'pp-' => array( 'pp' )` em `sera_mockup_prefixes()`, e `pp` na regex que carrega o `shots.js` (`(rh|lm|pp)-shots-`).
2. `inc/blocks.php`: adicionar os nomes `pp-*` em `sera_artifact_names()`.
3. `inc/template-tags.php`: adicionar os quatro mockups em `sera_mockups()`.
4. `page.php`: `'paperplane' => 'pp'` e `'pp-' => 'pp'` no mapa do próximo case.
5. `inc/starter-content.php`: a versão em inglês e a entrada do case (slug `paperplane`), quando o texto em PT estiver aprovado.
