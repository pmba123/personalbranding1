<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Base WP
 */

if ( ! is_active_sidebar( 'sidebar-wc' ) ) {
    return;
}
?>
<?php do_action( 'starter_wp_sidebar_wc_before' ); ?>
<aside id="secondary" class="<?php echo starter_wp_secondary_classes(); ?>">
      <?php 
        do_action( 'starter_wp_sidebar_wc_start' ); 
        dynamic_sidebar( 'sidebar-wc' ); 
        do_action( 'starter_wp_sidebar_wc_end' );
    ?>
</aside><!-- #secondary -->
<?php do_action( 'starter_wp_sidebar_wc_after' ); ?>