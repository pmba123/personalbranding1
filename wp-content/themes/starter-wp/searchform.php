<?php
/**
 * Template for displaying search forms in Starter WP
 *
 * @package Starter_WP
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="s" class="screen-reader-text"><?php _e( 'Search', 'starter-wp' ); ?></label>
		<input type="search" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Type and hit enter&hellip;', 'starter-wp' ); ?>" />
        <input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( '', 'starter-wp' ); ?>" />
	</form>