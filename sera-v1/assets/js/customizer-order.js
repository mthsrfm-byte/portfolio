/* Sera · Home › Cases — drag-and-drop order of the portfolio pages. */
( function ( $ ) {
	function sync( $list ) {
		var slugs = [];
		$list.children( 'li' ).each( function ( i ) {
			slugs.push( $( this ).data( 'slug' ) );
			$( this ).find( '.sco-n' ).text( ( i + 1 ) + '.' );
		} );
		$list.closest( '.customize-control' ).find( '.sera-case-order-value' ).val( slugs.join( ',' ) ).trigger( 'change' );
	}
	$( document ).on( 'click', '.sera-case-order .sco-up, .sera-case-order .sco-down', function () {
		var $li = $( this ).closest( 'li' );
		if ( $( this ).hasClass( 'sco-up' ) ) {
			$li.prev().before( $li );
		} else {
			$li.next().after( $li );
		}
		sync( $li.parent() );
		$( this ).trigger( 'focus' );
	} );
	wp.customize.bind( 'ready', function () {
		$( '.sera-case-order' ).each( function () {
			var $list = $( this );
			$list.sortable( { axis: 'y', update: function () { sync( $list ); } } );
			$list.children( 'li' ).each( function ( i ) { $( this ).find( '.sco-n' ).text( ( i + 1 ) + '.' ); } );
		} );
	} );
}( jQuery ) );
