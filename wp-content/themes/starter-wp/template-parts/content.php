<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starter_WP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
	<?php do_action( 'starter_wp_archives_article_start' ); ?>
    
        <?php do_action( 'starter_wp_archives_article_entry_header' ); ?>
        
        <div class="entry-content">
            <?php do_action( 'starter_wp_archives_article_entry_content' ); ?>
        </div><!-- .entry-content -->
        
        <?php do_action( 'starter_wp_archives_article_entry_footer' ); ?>
    
    <?php do_action( 'starter_wp_archives_article_end' ); ?>
    
</article><!-- #post-<?php the_ID(); ?> -->
