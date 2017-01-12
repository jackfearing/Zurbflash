<?php if ( ! is_user_logged_in() ) { ?>
<?php echo '<div class=widget>'; ?>
	<form action="<?php echo home_url(); ?>/wp-login.php" method="post">
	<form name="loginform" id="loginform" action="<?php echo home_url(); ?>/wp-login.php" method="post">
		<p class="login-username">
			<label>Username custom text</label>
			<input type="text" name="log" id="user_login" class="input" value="" placeholder="Username" size="20" tabindex="10" />
		</p>
		<p class="login-password">
			<label>Password custom text</label>
	        <input type="password" name="pwd" id="user_pass" class="input" value="" placeholder="Password" size="20" tabindex="20" />
			<input type="submit" name="submit" value="Log In custom text" class="button" />
		</p>
		<p class="login-submit">
			<!-- / Uncommit below to include preselected checkbox (checked="checker")-->
			<!-- <label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me</label> -->
			<label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" value="forever" /> Remember me</label>
			<!-- /Redirect user to front-end -->
			<p id="nav">
				<a href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword" title="Password Lost and Found">Lost your password?</a>
			</p>
			<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
		</p>
	</form>
<?php echo '</div>';?>
<?php } else { ?>

<?php
	echo '<div class=widget>';
	    wp_loginout( home_url() ); // Display "Log Out" link.
	    echo " | ";
	    wp_register('', ''); // Display "Site Admin" link.
	echo '</div>'; ?>

<?php }?>