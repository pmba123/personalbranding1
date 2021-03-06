<?php
/*-----------------------------------------------------------------
 * RELATED POSTS
-----------------------------------------------------------------*/
if ( ! function_exists( 'starter_wp_related_posts_categories' ) ) {
    function starter_wp_related_posts_categories() {
        global $post;
        $count = 0;
        $postIDs = array( $post->ID );
        $related = '';
        $thumbnail = '';
        $cats = wp_get_post_categories( $post->ID );
        $catIDs = array( );{
        foreach ( $cats as $cat ) {
            $catIDs[] = $cat;
        }
            $args = array(
            'category__in'          => $catIDs,
            'post__not_in'          => $postIDs,
            'showposts'             => 3,
            'ignore_sticky_posts'   => 0,
            'orderby'               => 'rand',
            'tax_query'             => array(
            array(
            'taxonomy'  => 'post_format',
            'field'     => 'slug',
            'terms'     => array(
            'post-format-link',
            'post-format-status',
            'post-format-aside',
            'post-format-quote' ),
            'operator' => 'NOT IN'
        )
        )
        );
        $cat_query = new WP_Query( $args );
            if ( $cat_query->have_posts() ) {
                while ( $cat_query->have_posts() ) {
                    $cat_query->the_post();
                    $related .= '<li class="related col-three-cycle"><a href="' . get_permalink() . '" rel="bookmark" title="Permanent Link to' . get_the_title() . '">' . get_the_post_thumbnail() . get_the_title() . '</a><time datetime="'. get_the_date('c'). '">'. get_the_date('d/m/y').'</time></li>';
                }
            }
        }
        if ( $related ) {
            echo '<h3 class="related-posts-title">'. __('You may also like','starter-wp') . '</h3><ul class="related-posts clearfix">' . $related . '</ul>';
        }
        wp_reset_query();
    }
}