( function ( wp ) {
	var el = wp.element.createElement;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var PanelBody = wp.components.PanelBody;
	var SelectControl = wp.components.SelectControl;
	var ServerSideRender = wp.serverSideRender;

	function make( name, attr, label, options ) {
		wp.blocks.registerBlockType( name, {
			edit: function ( props ) {
				var blockProps = useBlockProps();
				var set = {};
				return el(
					'div',
					blockProps,
					el(
						InspectorControls,
						null,
						el(
							PanelBody,
							{ title: label },
							el( SelectControl, {
								label: label,
								value: props.attributes[ attr ],
								options: options,
								onChange: function ( v ) {
									set[ attr ] = v;
									props.setAttributes( set );
								},
							} )
						)
					),
					el( ServerSideRender, { block: name, attributes: props.attributes } )
				);
			},
			save: function () {
				return null;
			},
		} );
	}

	make( 'sera/mockup', 'mockup', 'Mockup', window.seraMockups || [] );
	make( 'sera/artifact', 'name', 'Artefato', window.seraArtifacts || [] );
} )( window.wp );
