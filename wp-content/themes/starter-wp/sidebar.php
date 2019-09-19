<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Starter_WP
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<?php do_action( 'starter_wp_sidebar_before' ); ?>

<aside id="secondary" class="<?php echo starter_wp_secondary_classes(); ?>">
    <?php 
        do_action( 'starter_wp_sidebar_start' ); 
        dynamic_sidebar( 'sidebar-1' ); 
        do_action( 'starter_wp_sidebar_end' );
    ?>
</aside><!-- #secondary -->

<?php do_action( 'starter_wp_sidebar_after' ); ?>