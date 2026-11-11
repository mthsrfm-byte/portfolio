<?php
/**
 * Paperplane Studio: dados do case para o enqueue (gerado por build.mjs tema; não editar à mão).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/** Telas do estúdio (atributos e tamanho), mídias e quadros do céu. */
function sera_pp_case_data() {
	return json_decode( '{"telas":{"inicio":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":1440,"height":900}},"ideia":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":1440,"height":900}},"universo":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":1440,"height":900}},"roteiro":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":1440,"height":900}},"roteiro-origami":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":1440,"height":900}},"estilo":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":1440,"height":900}},"personagem-ficha":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":1440,"height":900}},"cenarios":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":1440,"height":900}},"decupagem":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":1440,"height":900}},"storyboard-basico":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":1440,"height":900}},"storyboard-nos":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":1440,"height":900}},"movimento":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":1440,"height":900}},"montagem":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":1440,"height":900}},"cel-inicio":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":390,"height":844}},"cel-roteiro":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":390,"height":844}},"cel-folha":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":390,"height":844}},"cel-origami":{"a":{"lang":"pt-BR","data-theme":"dark"},"b":{},"v":{"width":390,"height":844}}},"midias":["pg/ficha-1.webp","pg/ficha-2.webp","pg/ficha-3.webp","pg/ficha-4.webp","pg/quadro-take.webp","pg/ceu-001.webp","pg/ceu-002.webp","pg/ceu-003.webp","pg/ceu-004.webp"],"ceu":["pg/ceu-001.webp","pg/ceu-002.webp","pg/ceu-003.webp","pg/ceu-004.webp"]}', true );
}

/** Textos que nascem no JS do case, no idioma da página. */
function sera_pp_case_i18n() {
	return array(
		'reservaN' => sera_t( ' · holds up to N', ' · reserva até N' ),
		'leitorN' => sera_t( 'estimated price, holds up to N credits', 'preço estimado, reserva até N créditos' ),
		'desenhar' => sera_t( 'Draw', 'Desenhar' ),
		'desenhando' => sera_t( 'Drawing', 'Desenhando' ),
		'consentimento' => sera_t( 'The click is the consent: the hold only happens now.', 'O clique é o consentimento: a reserva sai só agora.' ),
		'gerarTomada' => sera_t( 'Generate take', 'Gerar tomada' ),
		'tentarDeNovo' => sera_t( 'Try again', 'Tentar de novo' ),
		'novoTake' => sera_t( 'New take', 'Novo take' ),
		'aprovado' => sera_t( 'Approved', 'Aprovado' ),
		'paraAprovar' => sera_t( 'To approve', 'Para aprovar' ),
		'aprovar' => sera_t( 'Approve', 'Aprovar' ),
		'verDeNovo' => sera_t( 'Watch again', 'Ver de novo' ),
		'take10' => sera_t( 'Take #1.0', 'Take #1.0' ),
		'quadroVira' => sera_t( 'The approved frame is the first frame of the video.', 'O quadro aprovado é o primeiro quadro do vídeo.' ),
		'basicoPct' => sera_t( '% Basic', '% Básico' ),
		'reservados' => sera_t( '24 credits held', '24 créditos reservados' ),
		'tomadaPronta' => sera_t( 'Take ready', 'Tomada pronta' ),
		'falhou' => sera_t( 'The generator failed. The credits came back.', 'O gerador falhou. Os créditos voltaram.' ),
		'semSaldo' => sera_t( '14 credits short. <b>Nothing was spent.</b>', 'Faltam 14 créditos. <b>Nada foi gasto.</b>' ),
		'compra' => sera_t( '+500 credits in the balance', '+500 créditos no saldo' ),
		'resposta' => sera_t( 'I split scene 3 into five takes: it opens on a wide shot of the carriage and closes on a close-up of Lia.', 'Separei a cena 3 em cinco tomadas: abre no plano geral do vagão e fecha no close da Lia.' ),
		'acentoLimao' => sera_t( '--accent back to lime: buttons, badges and progress.', '--accent volta ao limão: botões, selos e progresso.' ),
		'acentoOutro' => sera_t( '--accent and --lime-* in {v}: the main button, the badges and the progress bar follow.', '--accent e --lime-* em {v}: o botão principal, os selos e a barra de progresso acompanham.' ),
		'cantoZero' => sera_t( '--r-* at zero: everything square.', '--r-* em zero: tudo reto.' ),
		'cantoPadrao' => sera_t( '--r-* at the default.', '--r-* no padrão.' ),
		'cantoMais' => sera_t( '--r-* multiplied: cards and fields round off.', '--r-* multiplicado: cartões e campos arredondam.' ),
		'temaClaro' => sera_t( 'data-theme="light": the same tokens, light paper.', 'data-theme="light": os mesmos tokens, papel claro.' ),
		'temaEscuro' => sera_t( 'data-theme="dark": the same tokens, carbon paper.', 'data-theme="dark": os mesmos tokens, papel carbono.' ),
		'fonteMono' => sera_t( '--body in Geist Mono: the whole studio changes its voice.', '--body em Geist Mono: o estúdio inteiro troca de voz.' ),
		'fonteGeist' => sera_t( '--body in Geist, the product’s typeface.', '--body em Geist, a fonte do produto.' ),
		'escolha' => sera_t( 'Pick an accent, corner, theme or font. The preview alongside is the real studio.', 'Escolha acento, canto, tema ou fonte. A prévia ao lado é o estúdio de verdade.' ),
		'padrao' => sera_t( 'Everything back to the Dobra default.', 'Tudo de volta ao padrão da Dobra.' ),
		'padraoFim' => sera_t( 'Back to the default. Now it’s your turn.', 'De volta ao padrão. Agora é com você.' ),
		'nomes' => sera_t( '{"menta":"mint","pessego":"peach","lilas":"lilac","ceu":"sky"}', '{"menta":"menta","pessego":"pêssego","lilas":"lilás","ceu":"céu"}' ),
	);
}
