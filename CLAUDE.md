# Portfólio · tema WordPress "Sera v.1" (matheusserafim.com)

O site é um tema WordPress clássico em `sera-v1/`. Cada push na `main` que mexe em `sera-v1/` publica o tema na HostGator sozinho (`.github/workflows/deploy.yml`, FTPS, só arquivos alterados). Nunca envie zip nem peça para o Matheus subir arquivo.

## Como trabalhar
- Fale com o Matheus sempre em pt-BR, direto e curto.
- Toda mudança: suba a versão em `sera-v1/style.css` (`Version:`) e `sera-v1/functions.php` (`SERA_VERSION`), anote em `sera-v1/readme.txt`, rode `php -l` em tudo que mudou, faça commit e push na `main`. Depois confira se a Action "Deploy tema" passou.
- Se mudou texto de case (`inc/starter-content.php` ou `inc/i18n/cases/*.php`), lembre o Matheus de rodar Aparência › Sera · Cases › "Importar e publicar todos".
- Antes de mexer pesado em visual, mostre uma prévia (artifact) e espere aprovação.

## Estrutura
- Cases: inglês em `inc/starter-content.php`, português em `inc/i18n/cases/<slug>.php` (mesma ordem de blocos).
- Artefatos: `template-parts/artifacts/<prefixo>.php`; telas de produto em `inc/screens*.php`; mockups em `template-parts/mockups/*.php` (registrar em `sera_mockups()` em `inc/template-tags.php`).
- CSS: `assets/css/main.css`, `case.css`, `mockups.css`, `cases/{pg,rh,wu,wb,fm,ac,nb,lm}.css`. JS: `main.js`, `case.js`, `shots.js`.
- Textos visíveis: `sera_t( 'English', 'Português' )` / `sera_e()`. Inglês britânico; português do Brasil natural, primeira pessoa.

## Regras do site (não quebrar)
- Nada de números internos das empresas nem contagem de estudos/entrevistas/insights.
- Telas de produto recriadas em HTML/CSS (texto selecionável, fonte real), nunca imagem rasterizada.
- Sobre rosa, texto sempre branco. Nunca texto escuro sobre rosa.
- Nunca usar ícone de raio.
- Sem jargão de IA no texto ("não era X, era Y", travessões dramáticos, "jornada", "alavancar" etc.).
- Logos de marca nos sliders ficam fixos no topo e centralizados (`sera_pin_row_chip`).
- Nunca digitar senhas ou credenciais; os acessos ficam nos secrets do repositório.
