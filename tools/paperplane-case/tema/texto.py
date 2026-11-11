# Gera a versão em texto do case (blocos) em EN e PT, a partir das mesmas frases da página (en.json).
# Saída: tema/texto-en.php.txt e tema/texto-pt.php.txt (trechos colados em starter-content.php e no arquivo PT).
import json, os
os.chdir(os.path.dirname(os.path.abspath(__file__)))
en = json.load(open('en.json'))

# (tipo, pt) — tipo: cap(n, rótulo) | p | lead | note | li (lista vira parágrafos curtos)
SEQ = [
 ('p_lead', 'Uma frase entra, um episódio animado sai, e cada clique mostra o preço antes de acontecer. Defini o produto, o escopo e o padrão de acabamento de cada tela. Uma equipe de agentes de IA construiu sob a minha direção, em 23 dias.'),
 ('p', 'A IA escreveu o código. A visão, o escopo e cada detalhe que faz o Paperplane parecer simples e bem acabado saíram das minhas decisões.'),
 ('cap', 1, ('O cenário', 'The landscape'), 'Fazer um episódio com IA hoje é dirigir com seis abas abertas e a fatura no escuro.'),
 ('p_lead', 'Quem tenta fazer animação com IA conhece a cena. Uma aba para a imagem, outra para o vídeo, outra para a voz, uma planilha para lembrar quanto já foi.'),
 ('p', 'O prompt sai em inglês, copiado de um tutorial. Cada tentativa custa, e o preço só aparece depois. O personagem que tinha cabelo curto na cena 1 volta de franja na cena 2. E o total da brincadeira chega no fim do mês, na fatura do cartão.'),
 ('p', 'No meio disso tudo, a história se perde. Quem queria dirigir passa o dia como operador de ferramenta: copia, cola, traduz, espera a fila, baixa, sobe de novo. A ideia que cabia numa frase vira uma pasta de arquivos com nomes como "final_v3".'),
 ('p', '<strong>O Paperplane junta essa mesa inteira numa tela só, na ordem de uma filmagem, e põe o preço em cada botão.</strong>'),
 ('cap', 2, ('O produto', 'The product'), 'Da frase ao episódio em dez etapas que qualquer set de filmagem reconhece.'),
 ('p_lead', 'Montei o estúdio na ordem de uma produção de verdade. Escrever, Visualizar, Filmar. Cada tela pede uma coisa só.'),
 ('p', 'A ordem é o segredo da continuidade. Personagens e cenários ganham ficha aprovada antes do storyboard, e essa ficha vai junto em cada quadro. A Decupagem vem depois deles de propósito: decupar é planejar a câmera, e o Origami, o assistente de IA do estúdio, só escolhe bem o plano quando conhece o elenco e os lugares.'),
 ('p', 'O vocabulário também é de set: tomada, plano, decupagem. Cada tela tem um título curto, uma frase que explica o porquê e um botão principal. Até o nome foi escolhido: "universo", no lugar de "bíblia", para a série não ganhar termo religioso.'),
 ('cap', 3, ('O preço antes do clique', 'The price before the click'), 'Cada clique custa dinheiro. Por isso o preço chega antes do clique.'),
 ('p_lead', 'Essa decisão segura todas as outras. Um gerador de vídeo cobra por tentativa, e um assistente que age sozinho pode queimar o saldo de alguém em silêncio.'),
 ('p', 'Desenhei quatro regras para que <strong>nenhum crédito saia sem um gesto claro</strong>. Elas valem no estúdio inteiro, inclusive para o Origami, e nenhuma mudança vai ao ar se quebrar uma delas.'),
 ('regra', 'Saldo contado em minutos', 'O saldo diz quanto vídeo ainda rende, como estimativa, na qualidade escolhida. Com saldo zero a frase some, nunca mostra "0 s".'),
 ('regra', 'Mídia só sai com clique', 'O clique é o consentimento, e o botão traz o preço estimado. Recusei um modo automático com teto porque ele quebrava essa regra.'),
 ('regra', 'Falhou, o crédito volta', 'O crédito fica reservado durante a geração e volta se der erro. Resultado concluído consome, e a interface diz isso com todas as letras.'),
 ('regra', 'Imagem primeiro, vídeo depois', 'Cada tomada é aprovada como imagem antes de animar. Só o quadro aprovado vira o primeiro quadro do vídeo.'),
 ('cap', 4, ('O redesign', 'The redesign'), 'Simples por fora, avançado por dentro.'),
 ('p_lead', 'Cinco dias depois do começo, o estúdio crescia por acúmulo e cada tela tinha um esqueleto diferente. Em 24 de outubro parei e redesenhei tudo sobre quatro regras: quem chega pela primeira vez termina uma etapa sem abrir nada, e quem é profissional encontra tudo o que precisa por dentro.'),
 ('p', 'Depois cortei o que intimidava. Quatro modos técnicos viraram uma escolha só: Básico ou Avançado. Nome de modelo, preço por segundo e prompt em inglês saíram da tela. A pessoa escreve em português, menciona @Maria ou @tomada 1A, e o estúdio cuida do resto.'),
 ('cap', 5, ('Microinterações', 'Microinteractions'), 'Cada movimento do estúdio diz onde está o seu dinheiro.'),
 ('p_lead', 'Escolhi uma personalidade de movimento e dei a ela um nome: "Quieto com pouso, o crédito dá energia". A base é calma. Quando algo se move, é porque tem algo a dizer.'),
 ('p', 'A regra mais forte: <strong>a partícula é o crédito</strong>. Ela só aparece onde há crédito ou Origami, viaja do saldo para a ação e nasce sempre de um evento real. Com movimento reduzido, tudo para e a informação continua no texto.'),
 ('cap', 6, ('Dobra', 'Dobra'), 'Um design system que comanda o estúdio inteiro.'),
 ('p_lead', 'Criei a Dobra para o estúdio inteiro ter um padrão só. Cor, espaço, canto e movimento moram num lugar, e é por ele que cada peça do produto é ajustada e refinada. Quando mudo uma escolha ali, o estúdio inteiro acompanha, e os agentes falam a mesma língua que eu: peço <code>--accent</code>, eles sabem onde mexer.'),
 ('p', 'Nada fora do padrão chega ao ar: cor, espaço e contraste são conferidos a cada mudança.'),
 ('cap', 7, ('O site', 'The website'), 'Papel com luz: a home fala a mesma língua do estúdio.'),
 ('p_lead', 'A home tem um trabalho só: fazer quem ainda não entrou querer entrar. Levei para ela o vocabulário da Dobra, com grão de papel, luz vindo de cima à esquerda e o limão com volume. A promessa atravessa junto: o preço aparece antes de cada take. A lista de espera mede o funil sem cookies e sem guardar nome, e-mail ou IP nos eventos.'),
 ('p', 'O estúdio inteiro cabe no seu bolso, com a mesma capacidade do Desktop.'),
 ('cap', 8, ('Como trabalho', 'How I work'), 'Toda noite, uma equipe de agentes pesquisa o que o Paperplane deve virar. De manhã, eu escolho.'),
 ('p_lead', 'Enquanto eu durmo, agentes analisam a plataforma, estudam a concorrência e acompanham as novidades do mercado de IA. Dali sai uma curadoria do que merece entrar no roadmap.'),
 ('p', 'As melhores ideias chegam prontas para testar, atrás de uma chave que eu desligo quando quiser. Ao meio-dia abro o resumo da noite e decido o que fica, o que volta e o que sai.'),
 ('p', 'São nove agentes, cada um com um papel: pesquisa, memória dos temas, estratégia, crítica, design, construção, qualidade, segurança e o resumo da manhã. O crítico ataca cada ideia antes de ela ganhar forma.'),
 ('p', 'Em 23 dias, cada marco desta linha começou com uma decisão minha. Os agentes propõem, constroem e testam. O rumo, o corte e o padrão de acabamento são meus.'),
 ('cap', 9, ('O que aprendi', 'What I learned'), 'O que aprendi até aqui, e o que vem agora.'),
 ('regra', 'Decisão escrita vence decisão lembrada.', 'Agentes não guardam contexto de uma sessão para a outra. Numerar e datar cada decisão fez o produto parar de andar em círculo.'),
 ('regra', 'Padrão que importa fica escrito no produto.', 'Pedir "não use cor solta" durou um dia. Quando a regra entrou no estúdio, nenhuma cor escapou de novo.'),
 ('regra', 'Tirar da tela é o trabalho mais difícil.', 'Agentes adicionam com facilidade. Cada corte exigiu uma decisão minha, e foi cortando que o estúdio ficou simples.'),
 ('regra', 'Em teste com gente do audiovisual.', 'O beta está fechado. Estou testando comigo e com amigos próximos do audiovisual, e venho coletando o feedback deles para decidir o que vem a seguir.'),
 ('regra', 'Minutos funcionam para quem nunca gerou vídeo?', 'É a hipótese que mais quero validar com quem está testando agora.'),
 ('cap', 10, ('Onde está', 'Where it stands'), 'O estúdio está em beta fechado. A home já está no ar.'),
 ('p', 'O Paperplane continua em andamento, e esta página mostra o estado de hoje. Se você trabalha com produto, IA ou animação e quer conversar sobre como um designer dá rumo a uma equipe de agentes, me escreve.'),
 ('note', 'As imagens e os vídeos dentro das telas são de exemplo.'),
]

def q(s):
    return "'" + s.replace('\\', '\\\\').replace("'", "\\'") + "'"

def gerar(lang):
    t = (lambda pt: pt) if lang == 'pt' else (lambda pt: en[pt])
    linhas = []
    for item in SEQ:
        k = item[0]
        if k == 'cap':
            _, n, (lpt, len_), h = item
            linhas.append(f"$c .= sera_b_chapter( {n}, {q(lpt if lang=='pt' else len_)}, {q(t(h))} );")
        elif k == 'p_lead':
            linhas.append(f"$c .= sera_b_p( {q(t(item[1]))}, 'lead' );")
        elif k == 'p':
            linhas.append(f"$c .= sera_b_p( {q(t(item[1]))} );")
        elif k == 'regra':
            linhas.append(f"$c .= sera_b_p( {q('<strong>' + t(item[1]) + '</strong> ' + t(item[2]))} );")
        elif k == 'note':
            txt = t(item[1]) + ('' if lang == 'pt' else ' Product screens are shown in Portuguese, the product’s language.')
            linhas.append(f"$c .= sera_b_p( {q(txt)}, 'note' );")
    return '\n'.join(linhas)

linhas_en = gerar('en').split('\n')
open('texto-en.php.txt', 'w').write('\n'.join('\t' + (l if i else l.replace('$c .=', '$c  =', 1)) for i, l in enumerate(linhas_en)) + '\n')
linhas_pt = gerar('pt').split('\n')
open('texto-pt.php.txt', 'w').write('\n'.join((l if i else l.replace('$c .=', '$c  =', 1)) for i, l in enumerate(linhas_pt)) + '\n')
print('ok', len(SEQ))
