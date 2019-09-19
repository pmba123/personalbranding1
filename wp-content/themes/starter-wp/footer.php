<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Starter_WP
 */

?>
            <?php do_action( 'starter_wp_content_end' ); ?>
        </div><!-- .site-content-wrap-->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-footer-wrap col-container">
			<?php do_action( 'starter_wp_footer' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php do_action( 'starter_wp_site_after' ); ?>

<?php wp_footer(); ?>

</body>
</html>
