# Paperplane · brief da v4

Diagnóstico da v3 e orientações para quem constrói a página (pessoa ou agente). Vale para todos os arquivos em `paperplane-case/`.

## Diagnóstico da v3

**Fortes, ficam:**
- Abertura com o episódio rodando ("Isto aqui já foi só uma frase").
- Problema mostrado como 8 abas que viram uma.
- Demos do Origami Assistant e do Smart Engine, portadas da landing.
- Modo avançado animado (referências → pedido → takes → aprovação).
- Continuidade com a ficha do Ren (PNG do Matheus) e a Lia em seis planos.
- Do quadro ao take, com o vídeo tocando.
- "O que acontece quando você aperta Gerar".
- Os quatro jeitos de pagar, cada um num card só.

**Fracos, mudam:**
1. **Tipografia misturada.** Títulos em Geist light (fonte da landing) brigam com o tema. **Regra:** fonte do portfólio em tudo; Geist só dentro das simulações do produto (`.ppx`, telas das demos, canvas do modo avançado).
2. **Tour duro.** A tela troca seca, o zoom não tem vinheta e o celular invade a seção seguinte no mobile. No tablet, o computador fica cortado.
3. **Comparativo do mercado ilegível no celular.** A coluna de rótulos some na rolagem lateral.
4. **Card dos episódios poluído:** elenco e contagem de takes não somam.
5. **Muitas caixas pretas seguidas.** A página perde ritmo.
6. **"A aposta" não usa o melhor texto da landing,** a frase com imagens no meio das palavras.
7. **"Filmar" curto.** Falta a montagem em 4K, que a v52 trouxe como clipe novo (`v-4k`).

## Orientações

- **Ordem: Prólogo → Ato I (problema, mercado) → Ato II (aposta, estúdio, continuidade, filmar, qualquer tela, motor) → Ato III (beta no ar, feito no Paperplane, onde está, aprendizados).** Cada dor do capítulo 1 aponta para o capítulo que a responde.
- **Ritmo:** alternar papel (claro) e palco (escuro). Nunca três blocos escuros seguidos.
- **Tour (capítulo 4), como na landing:**
  - o foco é um elemento real da tela (`.pp-fx`);
  - a câmera aproxima com easing, a vinheta desfoca o resto e a cópia do foco "levanta" com sombra;
  - o callout lime aparece acima ou abaixo do foco;
  - as telas trocam com fade e leve deslize, e o texto entra por linha.
  - **Computador e tablet:** só a tela do computador. **Celular:** só o celular, com o foco no elemento `.pp-fxm` da tela mobile.
- **Comparativo:** tabela no desktop; no celular, um card por linha com as quatro categorias rotuladas.
- **Movimento:** tudo respeita `prefers-reduced-motion` e para num estado completo.
- **Mídia:** vídeo só do que o produto gerou (episódios, montagem), carregado ao entrar na tela.
- **Responsividade:** validar em 1440 × 900 e em iPhone (390 × 844) antes de publicar.
- **Conteúdo:** nada de números ou pesquisa inventados; preços seguem ilustrativos.
