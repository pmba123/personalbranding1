<?php
/*------------------------------------------------------------------------------------------
 * Archive
------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------
 * starter_wp_article_entry_header
------------------------------------------------------------------------------------------*/
add_action('starter_wp_archives_article_entry_header','starter_wp_articles_header');
if ( ! function_exists('starter_wp_articles_header') ) {
    function starter_wp_articles_header() { 
        echo '<header class="entry-header">';
            starter_wp_articles_post_time();
            starter_wp_articles_post_cat();
            starter_wp_articles_post_thumbnail();
             starter_wp_articles_post_title();
        echo '</header>';
    }
}
//header time
function starter_wp_articles_post_time() { 
    if ( has_post_thumbnail() ) {
        echo starter_wp_time_link(); 
    }
}
//header categories
function starter_wp_articles_post_cat() { 
    if ( has_post_thumbnail() ) {
        echo starter_wp_post_categories();
    }
}
// Show the featured image
function starter_wp_articles_post_thumbnail() { 
      if ( has_post_thumbnail() ) { ?>
        <a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ); ?>
        </a>
<?php }
}

// post title
function starter_wp_articles_post_title() { 
     the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
 }
/*------------------------------------------------------------------------------------------
 * starter_wp_article_entry_content
------------------------------------------------------------------------------------------*/
// entry content
add_action('starter_wp_archives_article_entry_content','starter_wp_articles_post_content');
function starter_wp_articles_post_content() {
		/* translators: %s: Name of current post */
		the_excerpt();
}
/*------------------------------------------------------------------------------------------
 * starter_wp_article_entry_footer
------------------------------------------------------------------------------------------*/
// Show the entry footer info (Categories and tags + edit link).
add_action( 'starter_wp_archives_article_entry_footer', 'starter_wp_articles_footer' );
if ( ! function_exists('starter_wp_articles_footer') ) {
    function starter_wp_articles_footer() {
        echo '<footer class="entry-footer">';
            starter_wp_post_author();
            if ( !has_post_thumbnail() ) {
                echo starter_wp_time_link(); 
            }
            starter_wp_comments_link();
            starter_wp_post_categories();
            starter_wp_post_tags();
            starter_wp_edit_link();
        echo'</footer>';
    }
}