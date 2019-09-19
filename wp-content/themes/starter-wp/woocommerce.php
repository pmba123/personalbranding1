<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starter_WP
 */

get_header(); ?>


	<div id="primary" class="<?php echo starter_wp_primary_classes(); ?>">
		<main id="main" class="site-main">

			<?php
                  woocommerce_content();
            ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
starter_wp_woocommerce_get_sidebar();
get_footer();