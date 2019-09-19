<?php
/*-----------------------------------------------------------------
 * AUTHOR BOX
-----------------------------------------------------------------*/
if ( ! function_exists( 'starter_wp_author_info_box' ) ) {
    function starter_wp_author_info_box() {

        global $post;

        // Detect if it is a single post with a post author
        if ( is_single() && isset( $post->post_author ) ) {

        // Get author's display name 
        $display_name = get_the_author_meta( 'display_name', $post->post_author );

        // If display name is not available then use nickname as display name
        if ( empty( $display_name ) )
            $display_name = get_the_author_meta( 'nickname', $post->post_author );

            // Get author's biographical information or description
            $user_description = get_the_author_meta( 'user_description', $post->post_author );

            // Get author's website URL 
            $user_website = get_the_author_meta('url', $post->post_author);

            // Get link to the author archive page
            $user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));

        if ( ! empty( $display_name ) )
           
            $author_avatar =  '<div class="author-avatar">' . get_avatar( get_the_author_meta('user_email') , 80 ) . '</div>';

            $author_details = $author_avatar . '<p class="author-name">Author: ' . $display_name . '</p>';

        if ( ! empty( $user_description ) )
            // Author avatar and bio
            $author_details .= '<p class="author-bio">' .nl2br( $user_description ). '</p>';

            //$author_details .= '<p class="author_links"><a href="'. $user_posts .'">View all posts by ' . $display_name . '</a>';  

        // Check if author has a website in their profile
        if ( ! empty( $user_website ) ) {

            // Display author website link
            $author_details .= ' &bull; <a href="' . $user_website .'" target="_blank" rel="nofollow">Website</a></p>';

        } else { 
            // if there is no author website then just close the paragraph
            $author_details .= '</p>';
        }
            // Pass all this info to post content  
            echo '<div class="author-info" >' . $author_details . '</div>';
        }
    }
}
