<?php
function hwid_acf_admin_footer() {
	?>
	<script>
		( function( $) {
			acf.add_filter( 'wysiwyg_tinymce_settings', function( mceInit, id ) {
				// grab the classes defined within the field admin and put them in an array
				var classes = $( '#' + mceInit.elements ).closest( '.acf-field-wysiwyg' ).attr( 'class' ),
					classArr = classes.split( ' ' ),
					newClasses = '';
				// step through the applied classes and only use those that start with the 'hwid-' prefix
				for ( var i=0; i<classArr.length; i++ ) {
					if ( classArr[i].indexOf( 'hwid-' ) === 0 ) {
						newClasses += ' ' + classArr[i];
					}
				}
				// apply the prefixed classes to the body_class property, which will then
				// put those classes on the rendered iframe's body tag
				mceInit.body_class += newClasses;

				return mceInit;
			});
		})( jQuery );
	</script>
<?php
}

add_action('acf/input/admin_footer', 'hwid_acf_admin_footer');