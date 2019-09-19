<?php
/**
 * Starter WP Header Hero
 *
 * @package Starter_WP
 */
if ( ! function_exists( 'starter_wp_hero' ) ) :        
    function starter_wp_hero() {
        if ( is_front_page() && is_home() && get_theme_mod( 'hero_enable', '1' ) || is_front_page() && get_theme_mod( 'hero_enable', '1' ) )  : ?>
        <div class="hero">
            <div class="col-container">
                <?php 
                    do_action('starter_wp_hero_start');
                    if (get_theme_mod( 'hero_heading', 'Easy to use' )) :
                        echo '<h2 class="title">' . get_theme_mod( 'hero_heading', 'Easy to use' ) . '</h2>';
                      endif;
                    if (get_theme_mod( 'hero_text', 'WordPress Theme' )) : 
                        echo '<p class="text">' . get_theme_mod( 'hero_text', 'WordPress Theme' ) . '</p>';
                    endif;
                    if (get_theme_mod( 'hero_button_text', 'View Now' )) :
                        echo '<a class="button button-outline" href="'. esc_url(get_theme_mod( 'hero_button_link', 'www.iograficathemes.com' )) . '">' . get_theme_mod( 'hero_button_text', 'View Now' ) . '</a>';
                    endif;
                    do_action('starter_wp_hero_end');
                ?>
            </div>
        </div>

    <?php 
            endif;
    }
add_action('starter_wp_header_end', 'starter_wp_hero');  
endif; 