jQuery(document).ready(function() {

	  /* === Checkbox Multiple Control === */
    if (jQuery('.customize-control-checkbox-multiple').length) {
    jQuery( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on(
        'change',
        function() {
   // alert('');
            checkbox_values = jQuery( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
                function() {
                    return this.value;
                }
            ).get().join( ',' );

            jQuery( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
        }
    );
}
jQuery( '.focus-customizer-menu-redirect' ).on( 'click', function ( e ) {
            e.preventDefault();
            wp.customize.panel( 'nav_menus' ).focus();
} );
jQuery( '.focus-customizer-widget-redirect' ).on( 'click', function ( e ) {
            e.preventDefault();
            wp.customize.panel('widgets').focus();
} );
});