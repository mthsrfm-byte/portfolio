# scroll-fx · o scroll do 14islands no Sera v.1

O 14islands.com usa **Lenis** (smooth scroll, `lerp` 0.1) e **r3f-scroll-rig** (as imagens são desenhadas em WebGL por cima do DOM e dobram com a velocidade da rolagem), além de textos que acendem palavra por palavra.

O tema já tem um smooth scroll no estilo do Lenis (`main.js`, bloco v3.4.1). Então este módulo traz o que faltava, sem biblioteca e sem WebGL, porque as mídias do portfólio são mockups em HTML, que o WebGL não desenha:

| Efeito | Onde entra |
|---|---|
| **Texto que acende com a rolagem**: cada palavra sai do cinza e chega na cor final enquanto o parágrafo atravessa a tela | `p.lead` dos cases, `.about-text` da home, `.statement > p` |
| **Mídia com peso**: o quadro atrasa um pouco, estica e curva a borda de trás conforme a velocidade, e volta com mola quando a rolagem para | `.case-hero-visual`, `.sera-mockup-block`, `.next-thumb`, `wp-block-image`, `wp-block-video` |
| **Paralaxe dentro do quadro**, com um leve zoom de saída na entrada | Imagem e vídeo com zoom de cobertura. Nos mockups em HTML do topo do case só o conteúdo desliza: o fundo e o selo da marca ficam no lugar |

Um arquivo só: `assets/js/scroll-fx.js` (~9 KB sem minificar, sem dependências).

## Como ligar no tema

1. Copiar `assets/js/scroll-fx.js` para `sera-v1/assets/js/`.
2. Em `functions.php`, enfileirar **depois** do `main.js`. O módulo lê a classe `has-smooth` que o `main.js` põe no `<html>`. Troque `sera-main` pelo handle real do `main.js`:

```php
wp_enqueue_script(
	'sera-scroll-fx',
	get_template_directory_uri() . '/assets/js/scroll-fx.js',
	array( 'sera-main' ),
	wp_get_theme()->get( 'Version' ),
	array( 'in_footer' => true, 'strategy' => 'defer' )
);
```

Não precisa de CSS nem de mudar markup.

### Opcional: o mesmo peso do 14islands

O Lenis do 14islands usa `lerp: 0.1` para tudo. O `main.js` usa 0.14 na roda do mouse e 0.3 no trackpad, de propósito, para o trackpad nunca parecer atrasado. Para o deslize "flutuante" do 14islands, troque no `main.js` (listener de `wheel`):

```js
lerp = now < padUntil ? 0.3 : 0.14;
```

por:

```js
lerp = 0.1;
```

O custo: no trackpad a página passa a seguir o dedo com um pouco mais de atraso. Teste antes de publicar.

## Testar em 30 segundos, sem mexer no tema

Abra matheusserafim.com no Chrome (desktop), abra o console (`Cmd+Opt+J`), cole o conteúdo inteiro de `assets/js/scroll-fx.js` e role a página. Os melhores lugares para ver: o "Sobre" da home e qualquer case (lead dos capítulos e mockups).

## Comportamento

- **Mouse e trackpad** (`html.has-smooth`): os três efeitos. A mídia e a paralaxe só rodam aqui, porque com o smooth scroll do tema a rolagem anda no mesmo quadro que os efeitos. O quadro de animação é pedido a partir do evento de `scroll`, para rodar sempre depois do `scrollTo` do tema: o efeito nunca fica um quadro atrás da página.
- **Toque** (celular e tablet): só o texto. Com a rolagem nativa feita no compositor, uma paralaxe calculada em JS treme.
- **`prefers-reduced-motion`**: nada roda e tudo fica no estado final, com o texto inteiro aceso.
- **Sem conflito com o tema**: só usa `translate`, `scale`, `clip-path` e `opacity` nas palavras, nunca `transform`. Então não pisa no `.reveal` (que anima `transform` com transição de 0,8 s), na animação dos cards da home (`card-slide`, que fica intacta) nem no hover dos mockups. Elementos que já usam `translate` ou `scale` ficam de fora.
- **Cenas presas na rolagem** (tour e Duo do Paperplane) têm mais de 1,5 tela de altura e ficam paradas automaticamente.
- Só calcula o que está perto da tela (`IntersectionObserver`) e desliga sozinho quando a rolagem para.

## Ajustes

- **Opt-in** em qualquer bloco: `data-sfx-text`, `data-sfx-media`, `data-sfx-parallax` (imagem/vídeo com zoom de cobertura) e `data-sfx-drift` (mockup em HTML).
- **Opt-out**: `data-sfx-off` no elemento ou num ancestral.
- **Intensidade**: no objeto `CFG`, no topo do arquivo: `lag` (atraso), `stretch` (esticada), `curve` (curva da borda; `0` desliga), `vMax`, `damp` (mola), `depth` e `zoom` (paralaxe), `textMin` e `textSpread` (texto).

## O que foi validado

Injetado no site publicado (home e case do Lume) e no rascunho do Paperplane (`paperplane-case.html`), com Chromium em 1440 × 900 e em iPhone 13:

- sem erros de JS nas três páginas;
- texto acendendo no "Sobre" da home e nos leads do case;
- mídia curvando e esticando ao rolar, nos dois sentidos, e voltando ao estado original quando a rolagem para;
- paralaxe do topo do case com o selo da marca no lugar;
- as duas cenas presas do Paperplane ficaram de fora;
- no iPhone, só o texto roda;
- custo medido em trace: o recálculo de estilo continua igual ao do tema sozinho. A curva custa raster (o `clip-path` muda a cada quadro); se pesar em máquina fraca, use `curve: 0`, que mantém o atraso e a esticada sem custo de raster.

Não deu para testar em Safari nem com GPU real. Vale uma passada no Safari do Mac antes de publicar.
