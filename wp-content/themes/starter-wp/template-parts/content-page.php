<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starter_WP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'starter_wp_article_start' ); ?>
    
            <?php do_action( 'starter_wp_page_entry_header' ); ?>
    
            <div class="entry-content">
                <?php do_action( 'starter_wp_page_entry_content' ); ?>
            </div><!-- .entry-content -->
    
            <?php do_action( 'starter_wp_page_entry_footer' ); ?>
    
    <?php do_action( 'starter_wp_page_end' ); ?>
    
</article><!-- #post-<?php the_ID(); ?> -->
