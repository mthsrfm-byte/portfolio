<?php
/**
 * "Sera: Mockup" block — drops any built-in iPhone mockup into a case page.
 * Server-rendered, no build step.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'init',
	function () {
		$uri = get_template_directory_uri();
		// Same handles as the front end (functions.php enqueues them there); registering lets the editor load them per block.
		wp_register_style( 'sera-main', $uri . '/assets/css/main.css', array(), sera_asset_ver( 'assets/css/main.css' ) );
		wp_register_style( 'sera-mockups', $uri . '/assets/css/mockups.css', array( 'sera-main' ), sera_asset_ver( 'assets/css/mockups.css' ) );
		wp_register_style( 'sera-case', $uri . '/assets/css/case.css', array( 'sera-main' ), sera_asset_ver( 'assets/css/case.css' ) );
		wp_register_style( 'sera-lume-ui', $uri . '/assets/css/lume-ui.css', array( 'sera-mockups' ), sera_asset_ver( 'assets/css/lume-ui.css' ) );
		wp_register_script(
			'sera-mockup-editor',
			$uri . '/assets/js/mockup-block.js',
			array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-block-editor', 'wp-server-side-render' ),
			sera_asset_ver( 'assets/js/mockup-block.js' ),
			true
		);
		wp_localize_script( 'sera-mockup-editor', 'seraArtifacts', array_map( function ( $k ) { return array( 'value' => $k, 'label' => $k ); }, sera_artifact_names() ) );
		wp_localize_script(
			'sera-mockup-editor',
			'seraMockups',
			array_map(
				function ( $slug, $label ) {
					return array(
						'value' => $slug,
						'label' => $label,
					);
				},
				array_keys( sera_mockups() ),
				array_values( sera_mockups() )
			)
		);
		register_block_type(
			'sera/artifact',
			array(
				'api_version'           => 3,
				'title'                 => 'Sera: Artefato do case',
				'category'              => 'design',
				'icon'                  => 'chart-area',
				'editor_script_handles' => array( 'sera-mockup-editor' ),
				'style_handles'         => array( 'sera-case' ),
				'attributes'      => array(
					'name' => array(
						'type'    => 'string',
						'default' => '',
					),
				),
				'render_callback' => function ( $attrs ) {
					return sera_render_artifact( isset( $attrs['name'] ) ? $attrs['name'] : '' );
				},
			)
		);
		register_block_type(
			'sera/mockup',
			array(
				'api_version'           => 3,
				'title'                 => 'Sera: Mockup de iPhone',
				'category'              => 'media',
				'icon'                  => 'smartphone',
				'editor_script_handles' => array( 'sera-mockup-editor' ),
				'style_handles'         => array( 'sera-mockups', 'sera-lume-ui' ),
				'supports'        => array( 'align' => array( 'wide', 'full' ) ),
				'attributes'      => array(
					'mockup' => array(
						'type'    => 'string',
						'default' => 'western-union',
					),
					'align'  => array(
						'type'    => 'string',
						'default' => 'wide',
					),
				),
				'render_callback' => function ( $attrs ) {
					$html = sera_render_mockup( isset( $attrs['mockup'] ) ? $attrs['mockup'] : '' );
					if ( ! $html ) {
						return '';
					}
					$align = ! empty( $attrs['align'] ) ? ' align' . sanitize_html_class( $attrs['align'] ) : '';
					return '<div class="sera-mockup-block' . esc_attr( $align ) . '">' . $html . '</div>';
				},
			)
		);
	}
);

/**
 * Artifact registry: "<case>-<name>" → template-parts/artifacts/<case>.php
 */
function sera_artifact_names() {
	return array(
		'pg-glance', 'pg-stats', 'pg-gap', 'pg-steps', 'pg-decisions', 'pg-economics', 'pg-orchestrator', 'pg-impact', 'pg-signals',
		'wu-glance', 'wu-constraints', 'wu-triangle', 'wu-voices', 'wu-audit', 'wu-statement', 'wu-solutions', 'wu-testing', 'wu-release', 'wu-impact', 'wu-reflection',
		'wb-glance', 'wb-stakes', 'wb-statement', 'wb-quotes', 'wb-pains', 'wb-framework', 'wb-before-after', 'wb-lessons', 'wb-impact', 'wb-next',
		'ac-glance', 'ac-duo', 'ac-obstacles', 'ac-jtbd', 'ac-voices', 'ac-findings', 'ac-personas', 'ac-vision', 'ac-process', 'ac-pillars', 'ac-testing', 'ac-system', 'ac-impact', 'ac-signals',
		'fm-glance', 'fm-cover', 'fm-chair', 'fm-rfm', 'fm-pipeline', 'fm-profiles', 'fm-voices', 'fm-warnings', 'fm-common', 'fm-impact', 'fm-next', 'fm-signals',
		'nb-glance', 'nb-audit', 'nb-levers', 'nb-system', 'nb-ads', 'nb-impact', 'nb-signals',
		'pg-window', 'pg-paths', 'pg-pilot', 'wu-error-screen', 'wu-diagnosis', 'wu-journey', 'wb-process', 'wb-bill-model', 'fm-day', 'fm-plans', 'fm-asks', 'ac-sequence', 'ac-journey', 'ac-anatomy', 'nb-fold', 'nb-slot', 'nb-weight',
		'rh-glance', 'rh-failures', 'rh-statement', 'rh-principles', 'rh-system', 'rh-home', 'rh-import', 'rh-flow', 'rh-mcp', 'rh-format', 'rh-ask', 'rh-ask-more', 'rh-privacy', 'rh-impact', 'rh-signals', 'rh-guide', 'rh-roadmap-steps', 'rh-ideas', 'rh-priority', 'rh-track', 'rh-connect',
		// "What I'd keep / what I'd change" (v3).
		'pg-reflection', 'rh-reflection', 'wb-reflection', 'fm-reflection', 'ac-reflection', 'nb-reflection', 'wu-signals', 'wb-signals',
		// Lume (v3.9).
		'lm-glance', 'lm-pains', 'lm-statement', 'lm-principles', 'lm-system', 'lm-session', 'lm-turns', 'lm-cut', 'lm-designer', 'lm-profiles', 'lm-status', 'lm-agent', 'lm-reflection', 'lm-signals',
	);
}

function sera_render_artifact( $name ) {
	$name = sanitize_key( $name );
	if ( ! in_array( $name, sera_artifact_names(), true ) ) {
		return '';
	}
	$case = strtok( $name, '-' );
	ob_start();
	get_template_part( 'template-parts/artifacts/' . $case, null, array( 'name' => $name ) );
	$html = trim( ob_get_clean() );
	return $html ? '<div class="art art--' . esc_attr( $case ) . ' art-' . esc_attr( $name ) . '">' . $html . '</div>' : '';
}
