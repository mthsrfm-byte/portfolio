---
name: modo-correcao-dev
description: Modo de correção em lote. Ative quando o Matheus disser "abre o modo correção dev", "modo correcao dev", "abrir modo de correção" ou variações (com ou sem acento, maiúsculas ou minúsculas). Nesse modo, Claude só anota e planeja cada pedido/print, sem mexer em código, até receber a ordem de executar.
---

# Modo correção dev

## Ao ativar
Responda só: "Modo correção dev aberto. Pode mandar os prints." e entre no modo.

## Enquanto o modo está aberto
Para cada mensagem/print recebido:
1. **Não edite arquivos, não faça commit nem push.** Leitura e busca no código são permitidas, só para planejar.
2. Entenda o problema do print (página, componente, o que está errado).
3. Localize os arquivos prováveis (`sera-v1/...`) com Grep/Read.
4. Registre um item numerado na lista, guardada em `.claude/correcoes-pendentes.md` (fora de `sera-v1/`, não vai pro deploy):
   - **#N · título curto**
   - Pedido: o que o Matheus quer
   - Onde: arquivos/seletores
   - Plano: como atacar (passos)
   - Dúvidas: se houver
5. Responda curto: "Anotado #N: <título>. Plano: <1 linha>." Pergunte só se algo estiver ambíguo de verdade.
6. Se um pedido novo altera ou cancela um anterior, atualize o item existente e avise.

Comandos durante o modo:
- "lista" / "mostra a lista" → mostra todos os itens resumidos.
- "remove #N" / "esquece #N" → tira o item.
- "fecha o modo" / "cancela" → sai sem executar (mantém o arquivo, pergunta se apaga).

## Ao receber a ordem de executar
Gatilhos: "executa", "manda ver", "pode fazer", "roda tudo", "aplica" e similares.
1. Releia a lista inteira e resolva conflitos entre itens antes de editar.
2. Se algum item for mudança visual pesada, mostre prévia (artifact) e espere aprovação, conforme CLAUDE.md.
3. Execute todos os itens, seguindo as regras do CLAUDE.md (subir versão em `style.css` e `SERA_VERSION`, anotar no `readme.txt`, `php -l` em tudo que mudou, regras de texto e visual do site).
4. Um commit único descrevendo os itens, push, e confira a Action "Deploy tema".
5. Resumo final: lista com ✅/❌ por item, e lembrete de "Importar e publicar todos" se mexeu em texto de case.
6. Apague `.claude/correcoes-pendentes.md` e saia do modo.
