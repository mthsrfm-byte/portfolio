<?php
/**
 * Customizer: every piece of home copy is editable in Aparência › Personalizar › Sera.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/**
 * Field definitions: key => [section, label, type, default].
 */
function sera_fields() {
	return array(
		// Hero.
		'hero_status'   => array( 'hero', 'Status (pílula verde)', 'text', 'Open to Lead and Design Manager roles' ),
		'hero_title'    => array( 'hero', 'Título', 'text', 'I design money products people come back to' ),
		'hero_rotate'   => array( 'hero', 'Palavras que giram no título (separadas por vírgula; a 1ª precisa estar no título; vazio desliga)', 'text', 'come back to, trust, rely on, recommend' ),
		'hero_title_2'  => array( 'hero', 'Título — segunda parte (em cinza)', 'text', 'and build the AI that ships them.' ),
		'hero_lede'     => array( 'hero', 'Parágrafo', 'textarea', 'Eleven years in product, seven in fintech at Nubank, will bank, Western Union and Pagaleve. Research, design and build, with AI in every step.' ),
		'hero_photo'    => array( 'hero', 'Foto', 'image', '' ),
		'hero_photo_alt' => array( 'hero', 'Texto alternativo da foto (acessibilidade e SEO)', 'text', 'Fisheye selfie of Matheus Serafim at night in Shibuya, Tokyo' ),
		'hero_now_logo' => array( 'hero', 'Logo da empresa atual (slug do logo; vazio para esconder)', 'text', 'pagaleve' ),
		'hero_role'      => array( 'hero', 'Linha abaixo do nome (cargo · onde)', 'text', 'Product Design Lead · now at Pagaleve' ),
		'hero_status_note' => array( 'hero', 'Status — nota à direita', 'text', 'full-time' ),
		'hero_freela'    => array( 'hero', 'Freela (vazio esconde)', 'text', 'Taking freelance projects' ),
		'hero_freela_note' => array( 'hero', 'Freela — nota à direita', 'text', 'by project' ),
		'hero_now_text' => array( 'hero', 'Texto sobre a posição atual', 'text', 'Staff-level Product Designer, Retention & Monetization' ),
		'fact_1_value'  => array( 'hero', 'Número 1', 'text', '11' ),
		'fact_1_label'  => array( 'hero', 'Legenda 1', 'text', 'years designing digital products, 6 in design leadership (manager and Staff IC)' ),
		'fact_2_value'  => array( 'hero', 'Número 2', 'text', '5' ),
		'fact_2_label'  => array( 'hero', 'Legenda 2', 'text', 'fintechs, from 0→1 bets to products with millions of customers' ),
		'fact_3_value'  => array( 'hero', 'Número 3', 'text', '3' ),
		'fact_3_label'  => array( 'hero', 'Legenda 3', 'text', 'AI products I designed and built end to end, one of them already in production' ),
		// Logos.
		'logos_title'   => array( 'logos', 'Título do carrossel', 'text', 'Companies & brands I’ve designed for' ),
		'logos_hidden'  => array( 'logos', 'Logos escondidos (slugs separados por vírgula)', 'text', '' ),
		// Work.
		'work_title'    => array( 'work', 'Título', 'text', 'Selected work' ),
		'work_intro'    => array( 'work', 'Texto de apoio', 'textarea', 'Each case covers what the business needed, what the evidence showed, what shipped and what changed. The newest ones also show the AI tools I built to get there.' ),
		'cases_order'   => array( 'work', 'Ordem dos cases na Home', 'case_order', 'combina-antes,research-hub,lume,western-union-onboarding,will-bank-switching-the-brain,acordo-certo-homepage,fatal-model-perfis-ad,bastidores-redesign' ),
		'work_all'      => array( 'work', 'Mostrar todos os cases como cards grandes', 'checkbox', 1 ),
		'work_featured' => array( 'work', 'Se a opção acima estiver desligada: quantos cases em destaque (o resto vai para a lista)', 'number', 6 ),
		'more_title'    => array( 'work', 'Título da lista de outros cases', 'text', 'More work' ),
		// Approach.
		'approach_title' => array( 'approach', 'Título', 'text', 'Approach' ),
		'approach_intro' => array( 'approach', 'Texto de apoio', 'textarea', 'What stays the same from company to company, whether it’s a 0→1 bet or a platform with millions of users. What changed is how fast I get from evidence to something that works.' ),
		'p1_title' => array( 'approach', 'Princípio 1 — título', 'text', 'Start from the business numbers' ),
		'p1_text'  => array( 'approach', 'Princípio 1 — texto', 'textarea', 'I start from the P&L line the problem sits on (conversion, losses, contact rate, late fees) and design toward it. Sometimes the most valuable design output is a new priority in the backlog.' ),
		'p1_proof' => array( 'approach', 'Princípio 1 — prova', 'text', 'will bank: an infrastructure migration became a customer satisfaction win.' ),
		'p2_title' => array( 'approach', 'Princípio 2 — título', 'text', 'Find evidence, even with no research budget' ),
		'p2_text'  => array( 'approach', 'Princípio 2 — texto', 'textarea', 'Session analytics, store visits, support tickets, a pile of rejected documents. I triangulate whatever is available until the problem is specific enough to solve.' ),
		'p2_proof' => array( 'approach', 'Princípio 2 — prova', 'text', 'Western Union: an audit of rejected documents showed most rejections came from one ambiguous step.' ),
		'p3_title' => array( 'approach', 'Princípio 3 — título', 'text', 'Measure what ships and own the result' ),
		'p3_text'  => array( 'approach', 'Princípio 3 — texto', 'textarea', 'I ship with controlled rollouts, control groups and a plan for when a release goes wrong. When a launch dips, I treat it as an incident, find the cause and get the number back.' ),
		'p3_proof' => array( 'approach', 'Princípio 3 — prova', 'text', 'Pagaleve: an AI orchestrator measured against a control group every week.' ),
		'p4_title' => array( 'approach', 'Princípio 4 — título', 'text', 'Build the tool, not just the screen' ),
		'p4_text'  => array( 'approach', 'Princípio 4 — texto', 'textarea', 'When the team’s process is the bottleneck, I design and build the tool myself, with Lovable, Claude and MCP. AI does the repetitive work and shows its sources; people keep the decisions.' ),
		'p4_proof' => array( 'approach', 'Princípio 4 — prova', 'text', 'Pagaleve: a Research Hub the company queries from its own Claude, and an AI voice moderator for usability tests.' ),
		// Experience.
		'xp_title' => array( 'experience', 'Título', 'text', 'Experience' ),
		'xp_intro' => array( 'experience', 'Texto de apoio', 'textarea', 'Manager turned IC by choice, always in credit and payments.' ),
		'xp_items' => array( 'experience', 'Experiências — uma por linha: período | empresa | cargo | descrição (use "now" no período para marcar a atual)', 'textarea', implode(
			"\n",
			array(
				'2026 — now | Pagaleve | Specialist Product Designer, Retention & Monetization | Leading end-to-end design for the flagship buy-now-pay-later product, together with risk, growth and engineering. Took an AI orchestrator from a hackathon pitch to production, and designed and built the team’s AI research tools: a Research Hub the whole company can query and the Lume, an AI voice moderator for usability tests.',
				'2024 — 2026 | Western Union | Specialist Product Designer, acting as Designer + PO | Led the Send Money flow and the digital account onboarding. Ran continuous discovery with Quantum Metric, benchmarking and research on web and mobile, for customers worldwide.',
				'2024 | Atlas Technologies | Staff Product Designer, research lead | Owned design strategy for the main initiatives, scaled the design system and mentored designers.',
				'2022 — 2024 | will bank | Staff Product Designer, Credit Card · previously Product Design Manager | Led design for a digital bank serving millions of active customers, most of them from lower-income segments. Managed the design team, then went back to IC work to lead credit card strategy.',
				'2020 — 2022 | Acordo Certo | Product Design Manager | Built and managed the design team of a debt-renegotiation platform, and set up its design processes and strategy.',
				'2019 — 2020 | Nubank | Senior Product Designer, Credit Card | Designed for the credit card of Latin America’s largest digital bank.',
			)
		) ),
		'xp_more' => array( 'experience', 'Rodapé da experiência', 'textarea', 'Before that: Jüssi (Honda), Laureate International Universities, and Brazil’s National Treasury Attorney’s Office (PGFN), 2015–2019.' ),
		// About.
		'about_text'  => array( 'about', 'Texto (use *palavra* para destacar em azul)', 'textarea', 'I studied communication, started in the public sector and moved to São Paulo in 2017 to work on products. Since then most of my work has been about making money *predictable* for people who can’t afford surprises.' ),
		'about_items' => array( 'about', 'Curiosidades — uma por linha: título | texto', 'textarea', implode(
			"\n",
			array(
				'Player 1, since forever. | Tech nerd since childhood: my dream was to build a Game Boy. At 14 I started a games blog that reached over 1M organic visitors a month.',
				'A capital idea. | From Brasília, where I began my career in government communication and design before moving into product.',
				'Director’s cut. | Former filmmaker: I wrote and directed two award-winning short films. That’s where my habit of storyboarding every flow comes from.',
				'Fluent in Portuguese, English and espresso. | I work with global teams in both languages, powered by a lot of good coffee.',
			)
		) ),
		'about_img_1' => array( 'about', 'Foto do hover da curiosidade 1 (ex.: você criança)', 'image', '' ),
		'about_img_2' => array( 'about', 'Foto do hover da curiosidade 2 (opcional)', 'image', '' ),
		'about_img_3' => array( 'about', 'Foto do hover da curiosidade 3 (opcional; padrão: pôsteres dos curtas)', 'image', '' ),
		'about_img_4' => array( 'about', 'Foto do hover da curiosidade 4 (opcional)', 'image', '' ),
		'about_chips' => array( 'about', 'Formação (separada por ponto e vírgula)', 'text', 'B.A. Organisational Communication, UnB; UX/UI Specialisation, EBAC; Design Leadership · Design Systems & Ops' ),
		// SEO.
		'seo_title'       => array( 'seo', 'Título da Home no Google e nas prévias de link', 'text', 'Matheus Serafim — Product Design Lead who builds with AI | Fintech, BNPL & Credit' ),
		'seo_description' => array( 'seo', 'Descrição da Home (aparece no Google e no WhatsApp; ~155 caracteres)', 'textarea', 'Product design lead in Brazil, 11 years in product, 7 in fintech. I design the product and build the AI tools around it. Open to Staff, Lead and Manager roles.' ),
		'seo_image'       => array( 'seo', 'Imagem de prévia da Home (1200×630; vazio usa a padrão do tema)', 'image', '' ),
		// Contact.
		'contact_title'   => array( 'contact', 'Título', 'text', 'If you’re building a product that moves people’s money,' ),
		'contact_title_2' => array( 'contact', 'Título — segunda parte (em cinza)', 'text', 'let’s talk.' ),
		'contact_email'   => array( 'contact', 'E-mail', 'text', 'mthsrfm@gmail.com' ),
		'contact_linkedin' => array( 'contact', 'LinkedIn (URL)', 'url', 'https://www.linkedin.com/in/matheusserafim/' ),
		'contact_resume'  => array( 'contact', 'Currículo (URL do PDF ou página)', 'url', '' ),
	);
}

/**
 * Get a theme mod with its default.
 */
function sera_mod( $key ) {
	static $f = null;
	if ( null === $f ) {
		$f = sera_fields();
	}
	$d = isset( $f[ $key ] ) ? $f[ $key ][3] : '';
	if ( function_exists( 'sera_is_pt' ) && sera_is_pt() && isset( $f[ $key ] ) && in_array( $f[ $key ][2], array( 'text', 'textarea' ), true ) ) {
		$ptd = sera_fields_pt();
		if ( isset( $ptd[ $key ] ) ) {
			$v = get_theme_mod( 'sera_' . $key . '_pt', $ptd[ $key ] );
			if ( '' !== trim( (string) $v ) ) {
				return $v;
			}
		}
	}
	return get_theme_mod( 'sera_' . $key, $d );
}

add_action(
	'customize_register',
	function ( WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_panel(
			'sera',
			array(
				'title'    => 'Sera · Home',
				'priority' => 30,
			)
		);
		$sections = array(
			'hero'       => 'Topo (hero)',
			'logos'      => 'Carrossel de logos',
			'work'       => 'Cases',
			'approach'   => 'Approach (How I work)',
			'experience' => 'Experiência',
			'about'      => 'Sobre',
			'contact'    => 'Contato e rodapé',
			'seo'        => 'SEO e prévias de link',
		);
		$i = 10;
		foreach ( $sections as $id => $title ) {
			$wp_customize->add_section(
				'sera_' . $id,
				array(
					'title'    => $title,
					'panel'    => 'sera',
					'priority' => $i,
				)
			);
			$i += 10;
		}

		sera_define_case_order_control();
		$wp_customize->get_section( 'sera_work' )->description = 'Os cases vêm das Páginas com a categoria (ou tag) “portfolio”. Arraste (ou use as setas) para escolher a ordem em que aparecem na Home e no “Next case”. Case novo entra no fim da lista até você mover.';
		$wp_customize->get_section( 'sera_logos' )->description = 'Slugs disponíveis: ' . implode( ', ', array_keys( sera_logos() ) );

		foreach ( sera_fields() as $key => $f ) {
			list( $section, $label, $type, $default ) = $f;
			$sanitize = 'sanitize_text_field';
			if ( 'textarea' === $type ) {
				$sanitize = 'sanitize_textarea_field';
			} elseif ( 'url' === $type ) {
				$sanitize = 'esc_url_raw';
			} elseif ( 'number' === $type ) {
				$sanitize = 'absint';
			} elseif ( 'image' === $type ) {
				$sanitize = 'absint';
			} elseif ( 'checkbox' === $type ) {
				$sanitize = function ( $v ) {
					return $v ? 1 : 0;
				};
			} elseif ( 'case_order' === $type ) {
				$sanitize = function ( $v ) {
					return implode( ',', array_values( array_filter( array_map( 'sanitize_title', explode( ',', (string) $v ) ) ) ) );
				};
			}
			$wp_customize->add_setting(
				'sera_' . $key,
				array(
					'default'           => $default,
					'sanitize_callback' => $sanitize,
					'transport'         => 'refresh',
				)
			);
			if ( 'case_order' === $type ) {
				$wp_customize->add_control(
					new Sera_Case_Order_Control(
						$wp_customize,
						'sera_' . $key,
						array(
							'label'   => $label,
							'section' => 'sera_' . $section,
						)
					)
				);
			} elseif ( 'image' === $type ) {
				$wp_customize->add_control(
					new WP_Customize_Media_Control(
						$wp_customize,
						'sera_' . $key,
						array(
							'label'     => $label,
							'section'   => 'sera_' . $section,
							'mime_type' => 'image',
						)
					)
				);
			} else {
				$wp_customize->add_control(
					'sera_' . $key,
					array(
						'label'   => $label,
						'section' => 'sera_' . $section,
						'type'    => $type,
					)
				);
			}
		}

		// Portuguese copy for /pt/ (empty field = use the translation that ships with the theme).
		$wp_customize->add_section(
			'sera_pt',
			array(
				'title'       => 'Versão em português (/pt/)',
				'panel'       => 'sera',
				'priority'    => 200,
				'description' => 'Textos da Home em português. Já vêm traduzidos; edite só se quiser mudar algo. Campos que não estão aqui (fotos, links, ordem) são os mesmos nas duas línguas.',
			)
		);
		$all = sera_fields();
		foreach ( sera_fields_pt() as $key => $pt_default ) {
			if ( ! isset( $all[ $key ] ) ) {
				continue;
			}
			$type = $all[ $key ][2];
			$wp_customize->add_setting(
				'sera_' . $key . '_pt',
				array(
					'default'           => $pt_default,
					'sanitize_callback' => 'textarea' === $type ? 'sanitize_textarea_field' : 'sanitize_text_field',
					'transport'         => 'refresh',
				)
			);
			$wp_customize->add_control(
				'sera_' . $key . '_pt',
				array(
					'label'   => $all[ $key ][1] . ' — PT',
					'section' => 'sera_pt',
					'type'    => $type,
				)
			);
		}
	}
);

/**
 * Drag-and-drop list of every portfolio page, saved as page slugs.
 */
function sera_define_case_order_control() {
	if ( class_exists( 'Sera_Case_Order_Control' ) ) {
		return;
	}
	class Sera_Case_Order_Control extends WP_Customize_Control { // phpcs:ignore
		public $type = 'sera_case_order';

		public function enqueue() {
			wp_enqueue_script( 'sera-case-order', get_template_directory_uri() . '/assets/js/customizer-order.js', array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ), SERA_VERSION, true );
		}

		public function render_content() {
			$q     = sera_case_query( array( 'sera_raw_order' => true ) );
			$items = array();
			foreach ( $q->posts as $p ) {
				$items[ $p->post_name ] = $p;
			}
			$saved = array_values( array_filter( array_map( 'sanitize_title', explode( ',', (string) $this->value() ) ) ) );
			$list  = array();
			foreach ( $saved as $slug ) {
				if ( isset( $items[ $slug ] ) ) {
					$list[ $slug ] = $items[ $slug ];
					unset( $items[ $slug ] );
				}
			}
			$list = array_merge( $list, $items );
			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if ( ! $list ) : ?>
				<p class="description">Nenhuma página com a categoria portfolio ainda.</p>
			<?php else : ?>
				<ol class="sera-case-order" style="margin:6px 0 0;padding:0;list-style:none;counter-reset:sco">
					<?php foreach ( $list as $slug => $p ) : ?>
						<li data-slug="<?php echo esc_attr( $slug ); ?>" style="display:flex;align-items:center;gap:8px;margin:0 0 6px;padding:8px 8px 8px 10px;background:#fff;border:1px solid #dcdcde;border-radius:4px;cursor:move">
							<span class="dashicons dashicons-menu" aria-hidden="true" style="color:#8c8f94;flex:none"></span>
							<span style="flex:1;min-width:0;line-height:1.3"><strong class="sco-n" style="color:#646970;margin-right:4px"></strong><?php echo esc_html( get_the_title( $p ) ); ?><?php if ( 'publish' !== $p->post_status ) : ?> <em style="color:#b32d2e">(<?php echo esc_html( get_post_status_object( $p->post_status )->label ); ?>)</em><?php endif; ?></span>
							<button type="button" class="button-link sco-up" aria-label="<?php echo esc_attr( 'Subir ' . get_the_title( $p ) ); ?>"><span class="dashicons dashicons-arrow-up-alt2"></span></button>
							<button type="button" class="button-link sco-down" aria-label="<?php echo esc_attr( 'Descer ' . get_the_title( $p ) ); ?>"><span class="dashicons dashicons-arrow-down-alt2"></span></button>
						</li>
					<?php endforeach; ?>
				</ol>
			<?php endif; ?>
			<input type="hidden" class="sera-case-order-value" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', array_keys( $list ) ) ); ?>">
			<?php
		}
	}
}
