<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<!-- <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'jointswp' ) ?></span> -->
		<input type="search" class="search-field" value="Search..." name="s" onfocus="if (this.value == 'Search...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search...';}" />
	</label>
	<input type="submit" class="search-submit button" value="<?php echo esc_attr( 'Search', 'jointswp' ) ?>" />
</form>