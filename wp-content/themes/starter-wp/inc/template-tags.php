<?php
/*-------------------------------------------------------------------------------------------
 * Categorized Blog
------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'starter_wp_categorized_blog' ) ) :
function starter_wp_categorized_blog() {

    if ( false === ( $all_the_cool_cats = get_transient( 'stater_wp_categories' ) ) ) {
            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories( array(
                'fields'     => 'ids',
                'hide_empty' => 1,
                // We only need to know if there is more than one category.
                'number'     => 2,
            ) );
            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count( $all_the_cool_cats );
            set_transient( 'stater_wp_categories', $all_the_cool_cats );
        }
        if ( $all_the_cool_cats > 1 || is_preview() ) {
            // This blog has more than 1 category so twentyfifteen_categorized_blog should return true.
            return true;
        } else {
            // This blog has only 1 category so twentyfifteen_categorized_blog should return false.
            return false;
        }
    }
endif;
function stater_wp_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'stater_wp_categories' );
}
add_action( 'edit_category', 'stater_wp_category_transient_flusher' );
add_action( 'save_post',     'stater_wp_category_transient_flusher' );

/*---------------------------------------------------------------------------------------
* Prints HTML with meta information for the current post-date/time and author.
* --------------------------------------------------------------------------------------*/
if ( ! function_exists( 'starter_wp_post_author' ) ) :

	function starter_wp_post_author( $show_author = true ) {
        
        $post_author_id   = get_post_field( 'post_author', get_the_ID() );
	    $post_author_name = get_the_author_meta( 'display_name', $post_author_id );
        
		// Get the author name; wrap it in a link.
	   $byline = sprintf(
		/* translators: %s: post author */
		__( 'By %s', 'starter-wp' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post_author_id ) ) ) . '">' . $post_author_name . '</a></span>'
	);
	// Finally, let's write all of this to the page.
	if ( $show_author ) {
		echo '<div class="byline"> ' . $byline . '</div>';
	}
}
endif;

/*--------------------------------------------------------------------------------------
*  Gets a nicely formatted string for the published date
* --------------------------------------------------------------------------------------*/
if ( ! function_exists( 'starter_wp_time_link' ) ) :

    function starter_wp_time_link() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
            get_the_date( DATE_W3C ),
            get_the_date(),
            get_the_modified_date( DATE_W3C ),
            get_the_modified_date()
        );

        // Wrap the time string in a link, and preface it with 'Posted on'.
        echo sprintf(
            /* translators: %s: post date */
            __( '<span class="screen-reader-text">Posted on</span> %s', 'starter-wp' ),
            '<a class="date" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );
    }
endif;

/*--------------------------------------------------------------------------------------
*  Gets post categories
* --------------------------------------------------------------------------------------*/
if ( ! function_exists( 'starter_wp_post_categories' ) ) :

    function starter_wp_post_categories() {
        /* translators: used between list items, there is a space after the comma */
        $separate_meta = __( ', ', 'starter-wp' );
        // Get Categories for posts.
        $categories_list = get_the_category_list( $separate_meta );
        
        if ( ( ( starter_wp_categorized_blog() && $categories_list ) ) || get_edit_post_link() ) {
            if ( ( $categories_list && starter_wp_categorized_blog() ) ) {
                echo '<span class="cat-tags-links">';
                    // Make sure there's more than one category before displaying.
                    if ( $categories_list && starter_wp_categorized_blog() ) {
                        echo '<span class="cat-links">' . __('Category: ', 'starter-wp') . $categories_list . '</span>';
                    }
                echo '</span>';
            }
        }
    }
endif;
/*--------------------------------------------------------------------------------------
*  Gets post tag
* --------------------------------------------------------------------------------------*/
if ( ! function_exists( 'starter_wp_post_tags' ) ) :

    function starter_wp_post_tags() {
        /* translators: used between list items, there is a space after the comma */
        $separate_meta = __( ', ', 'starter-wp' );
        // Get Tags for posts.
        $tags_list = get_the_tag_list( '', $separate_meta );
        
        if ( $tags_list || get_edit_post_link() ) {
            if ( $tags_list ) {
                echo '<span class="tags-links">' .  __('Tagged: ', 'starter-wp')  . $tags_list . '</span>';
            }
        }
    }
endif;
/*--------------------------------------------------------------------------------------
 *  Returns an accessibility-friendly link to edit a post or page.
 * --------------------------------------------------------------------------------------*/
if ( ! function_exists( 'starter_wp_edit_link' ) ) :
    function starter_wp_edit_link() {

        $link = edit_post_link(
            sprintf(
                /* translators: %s: Name of current post */
                __( 'Edit<span class="screen-reader-text"> "%s"</span>', 'starter-wp' ),
                get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
        );

        return $link;
    }
endif;
/*--------------------------------------------------------------------------------------
 *   Returns comments link. 
 * --------------------------------------------------------------------------------------*/
if ( ! function_exists( 'starter_wp_comments_link' ) ) :
    function starter_wp_comments_link() {
        if ( ! is_singular() && ! post_password_required() ) {
            echo '<span class="comments-link">';
            comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'starter-wp' ), get_the_title() ) );
            echo '</span>';
        }
    }
endif;


/*----------------------------------------------------------------------------------------
 * Display navigation to next/previous comments when applicable.
 * --------------------------------------------------------------------------------------*/
if ( ! function_exists( 'starter_wp_comment_nav' ) ) :
    function starter_wp_comment_nav() {
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'starter-wp' ); ?></h2>
            <div class="nav-links">
                <?php
                    if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'starter-wp' ) ) ) {
                        printf( '<div class="nav-previous">%s</div>', $prev_link );
                    }

                    if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'starter-wp' ) ) ) {
                        printf( '<div class="nav-next">%s</div>', $next_link );
                    }
                ?>
            </div>
        </nav>
        <?php
        endif;
    }
endif;
/*----------------------------------------------------------------------------------------
 * Display navigation to next/previous set of posts when applicable.
 * --------------------------------------------------------------------------------------*/
if ( ! function_exists( 'starter_wp_paging_nav' ) ) :
    function starter_wp_paging_nav() {
        if (!is_singular()) {
               the_posts_navigation( 
                   array (
                    'prev_text'          => __( 'Older', 'starter-wp' ),
                    'next_text'          => __( 'Newer', 'starter-wp' ),
                    'screen_reader_text' => __( 'Posts navigation', 'starter-wp' ),
            ));
        } else {
            the_post_navigation(
                array(
                    'prev_text' => __( 'Older', 'starter-wp' ),
                    'next_text' => __( 'Newer', 'starter-wp' ),
                    'screen_reader_text' => __( 'Post navigation','starter-wp' ),
            ));
        }
    }
endif;