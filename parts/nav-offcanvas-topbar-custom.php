<!-- By default, this menu will use off-canvas for small
	 and a topbar for medium-up -->

<!-- .nav-container: add .full-width class to span nav 100%
	 .nav-container: add .center class to align center
-->

<!-- Settings for navigaiton located in the ACF Options: THEME SETTINGS -->
<?php
	$navMainWidth			= get_field('main_navigation_width','options');
	$navMainAlign			= get_field('main_navigation_alignment','options');
	$navMainBGColor			= get_field('main_navigation_background_color','options');
	$navMainBorderColor		= get_field('main_navigation_border_color','options');
	$navMainArrowColor		= get_field('main_navigation_arrow_color','options');
?>

<style>
	<?php if($navMainArrowColor):?>
		.dropdown.menu.medium-horizontal > li.is-dropdown-submenu-parent > a::after {
			border-color: <?php echo $navMainArrowColor;?> transparent transparent;
		}
		.is-dropdown-submenu .is-dropdown-submenu-parent.opens-right > a::after {
			border-color: transparent transparent transparent <?php echo $navMainArrowColor;?>;
		}
	<?php endif;?>
</style>


<div class="nav-container <?php echo $navMainWidth;?> <?php echo $navMainAlign;?>">
	<div class="top-bar show-for-large-up nav-table shadow" id="top-bar-menu" style="background:<?php echo $navMainBGColor;?>; border-bottom: 1px solid <?php echo $navMainBorderColor;?>;">

		<div class="nav-align-container">

			<div class="nav-custom">

				<div class="top-bar-left float-left">

					<div class="top-bar-left custom-logo">
						<?php
							$custom_logo_id = get_theme_mod( 'custom_logo' );
							$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
						?>

						<?php if ($image) :?>
							<a href="<?php echo home_url(); ?>">
								<img src=<?php echo $image[0];?> alt="" />
							</a>
						<?php else :?>
							no logo
						<?php endif;?>

						<?php if ( get_bloginfo( 'description' )  !== '' ) : ?>
	<!-- 					    <h4 class="site-description"><?php bloginfo( 'description' ); ?></h4> -->
						<?php endif; ?>

					</div> <!-- end top-bar .custom-logo -->

				</div> <!-- end .top-bar-left -->

				<div class="show-for-large nav-cell">
					<?php joints_top_nav(); ?>
				</div>

			</div> <!-- end .nav-custom -->



			<?php
			// *************************************
			// OFF-CANVAS MENU
			// *************************************
			?>

			<div class="nav-cell">

				<div class="top-bar-right float-right hide-for-large">

<!--
					<ul class="menu">
						<li><a data-toggle="off-canvas"><?php _e( 'Menu', 'jointswp' ); ?></a></li>
					</ul>
-->


 <!--
	 Change hamurger animation
	 https://github.com/jonsuh/hamburgers

	 - hamburger--emphatic
	 - hamburger--emphatic-r
	 - hamburger--spin
	 - hamburger--slider
	 - hamburger--squeeze
	 - hamburger--vortex
	 - hamburger--collapse
	 - hamburger--arrow
	 - hamburger--arrow-r
	 - hamburger--arrowalt
	 - hamburger--arrowalt-r

 -->

<button data-toggle="off-canvas" class="hamburger hamburger--emphatic" type="button">
  <span class="hamburger-box">
    <span class="hamburger-inner"></span>
  </span>
</button>


<!--
					<div class="button_container" id="toggle">
						<span class="top"></span>
						<span class="middle"></span>
						<span class="bottom"></span>
					</div>

					<div class="overlay" id="overlay">
						<nav class="overlay-menu">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#">About</a></li>
								<li><a href="#">Work</a></li>
								<li><a href="#">Contact</a></li>
								<li><a href="#">Home</a></li>
								<li><a href="#">About</a></li>
								<li><a href="#">Work</a></li>
								<li><a href="#">Contact</a></li>
								<li><a href="#">Home</a></li>
								<li><a href="#">About</a></li>
								<li><a href="#">Work</a></li>
								<li><a href="#">Contact</a></li>
								<?php //joints_top_nav(); ?>
							</ul>
						</nav>
					</div>
-->

				</div> <!-- end .top-bar-right .show-for-small-only -->

			</div> <!-- end .nav-cell -->

		</div> <!-- end .nav-align-container -->

	</div> <!-- end .top-bar -->
</div> <!-- end .nav-container -->


