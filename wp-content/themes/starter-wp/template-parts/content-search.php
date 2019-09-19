<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starter_WP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
	<?php do_action( 'starter_wp_search_page_article_start' ); ?>
    
           <?php do_action( 'starter_wp_search_page_article_entry_header' ); ?>
        
        <div class="entry-summary">
            <?php do_action( 'starter_wp_search_page_article_entry_summary' ); ?>
        </div><!-- .entry-content -->
        
            <?php do_action( 'starter_wp_search_page_article_entry_footer' ); ?>
    
    <?php do_action( 'starter_wp_search_page_article_end' ); ?>
    
</article><!-- #post-<?php the_ID(); ?> -->
