<?php
/**
 * Starter WP Header
 *
 * @package Starter_WP
 */
/*------------------------------------------------------------------------------------*
 * HEADER CUSTOM MEDIA
*------------------------------------------------------------------------------------*/
//media start div
add_action( 'starter_wp_header_start', 'starter_wp_site_header_media_start', 10 );
if ( ! function_exists( 'starter_wp_site_header_media_start' ) ) {
    function starter_wp_site_header_media_start() { 
    
    if ( has_custom_header() && (is_home() && is_front_page() || is_front_page() ) ) {  ?>
    
        <?php if (has_header_image()) : ?>
            <div class="header-media" style="background-image:url('<?php echo get_header_image(); ?>')">
        <?php  endif;  ?>
        <?php if ( has_header_video() ) : ?>
                <div class="header-media" data-vidbg-bg="mp4: <?php echo get_header_video_url(); ?>, poster: <?php echo get_header_image(); ?>" data-vidbg-options="loop: true, muted: true, overlay: false, overlayColor: #000, overlayAlpha: 0.3">
        <?php  endif;  ?>
            <div class="overlay">
    <?php }
    }
}
//media close div
if ( ! function_exists( 'starter_wp_site_header_media_end' ) ) {
    function starter_wp_site_header_media_end() { 
    
    if ( has_custom_header() && (is_home() && is_front_page() || is_front_page() ) ) {  ?>
           </div> 
    </div>
    <?php }
    }
}
add_action( 'starter_wp_header_end', 'starter_wp_site_header_media_end', 30 );

/*------------------------------------------------------------------------------------*
 * TOP HEADER
*------------------------------------------------------------------------------------*/

// header menu
add_action('starter_wp_top_header', 'starter_wp_header_menu'); 

if ( ! function_exists( 'starter_wp_header_menu' ) ) : 
    function starter_wp_header_menu() {
        wp_nav_menu( array( 
            'theme_location' => 'secondary', 
            'menu_id' => 'menu-header', 
            'menu_class' => 'header-nav', 
            'depth'  => 1, 
            'link_after'  => '', 
            'fallback_cb' => false ) );
    }
endif;

// header text
add_action('starter_wp_top_header', 'starter_wp_header_text');

if ( ! function_exists( 'starter_wp_header_text' ) ) : 
    function starter_wp_header_text() {
        if ( get_theme_mod( 'top_header_text')) {
            echo '<div class="text col-half">' . do_shortcode( get_theme_mod( 'top_header_text', 'Build your awesome website' ) ). '</div>';
        }
    }
endif;

// header social
add_action('starter_wp_top_header', 'starter_wp_header_social'); 

if ( ! function_exists( 'tarter_wp_header_social' ) ) : 
    function starter_wp_header_social() {
        if (get_theme_mod('social_header_enable', '1')) {
            starter_wp_social();
        }
    }
endif;

// TOP HEADER
add_action('starter_wp_header_start', 'starter_wp_top_header');  

if ( ! function_exists( 'starter_wp_top_header' ) ) :        
    function starter_wp_top_header() {
        if ( get_theme_mod( 'top_header_enable', '1' ) )  : ?>

        <div class="top-header">
            <div class="top-header-wrap col-container">
                <?php
                    do_action( 'starter_wp_top_header' );
                ?>
            </div>
        </div>

    <?php 
        endif;
    }
endif;

/*------------------------------------------------------------------------------------*
 * SKIP LINK
 *------------------------------------------------------------------------------------*/
if ( ! function_exists( 'starter_wp_skip_link' ) ) :
    function starter_wp_skip_link() {
        ?>
        <a class="skip-link screen-reader-text" href="#content"  alt="<?php esc_attr( 'Skip to content', 'starter-wp' ); ?>" title="<?php esc_attr( 'Skip to content', 'starter-wp' ); ?>"><?php esc_html_e( 'Skip to content', 'starter-wp' ); ?></a>
        <?php
    }
endif;
add_action( 'starter_wp_header', 'starter_wp_skip_link' );

/*------------------------------------------------------------------------------------*
 * SITE BRANDING
*------------------------------------------------------------------------------------*/
//logo
if ( ! function_exists( 'starter_wp_custom_logo' ) ) :
    function starter_wp_custom_logo() {
        if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
        }
    }
endif;
//title
if ( ! function_exists( 'starter_wp_site_title' ) ) :
    function starter_wp_site_title() {
         if ( is_front_page() && is_home() ) :
            ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <span><?php bloginfo( 'name' ); ?></span>
                    </a>
                </h1>
            <?php else : ?>
                <p class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <span><?php bloginfo( 'name' ); ?></span>
                    </a>
                </p>
            <?php endif; 
    }
endif;
//description
if ( ! function_exists( 'starter_wp_site_description' ) ) :
    function starter_wp_site_description() {
         $description = get_bloginfo( 'description', 'display' );
        if ( $description || is_customize_preview() ) : ?>
            <p class="site-description"><?php echo $description; ?></p>
        <?php endif; 
    }
endif;

//SITE BRANDING
if ( ! function_exists( 'starter_wp_site_branding' ) ) {
    function starter_wp_site_branding() {
        ?>

        <div class="<?php echo starter_wp_site_branding_classes(); ?>">
            <?php 
                do_action( 'starter_wp_site_branding_start' );
        
                starter_wp_custom_logo();
                // stie title
                starter_wp_site_title();
          
                // Description
                starter_wp_site_description();
                
                do_action( 'starter_wp_site_branding_end' );
            ?>
        </div>

        <?php
    }
}
add_action( 'starter_wp_masthead', 'starter_wp_site_branding' );
/*------------------------------------------------------------------------------------*
 * PRIMARY MENU
*------------------------------------------------------------------------------------*/
//Menu toggle
if ( ! function_exists( 'starter_wp_menu_toggle' ) ) :
    function starter_wp_menu_toggle() {
        if ( ! ( has_nav_menu( 'primary' ) ) ) {
            return;
        }
        ?>
        <div id="menu-toggle-wrap">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <i class="icon-menu icons"></i> <?php esc_html_e( 'Menu', 'starter-wp' ); ?>
            </button>
        </div>
        <?php
    }
endif;

//header nav
if ( ! function_exists( 'starter_wp_main_nav_menu' ) ) :
    function starter_wp_main_nav_menu() {
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
        ) );
    }
endif;
//PRIMARY MENU
add_action( 'starter_wp_masthead', 'starter_wp_primary_menu' );

if ( ! function_exists( 'starter_wp_primary_menu' ) ) {
    function starter_wp_primary_menu() {
        ?>

        <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <nav id="site-navigation" class="<?php echo starter_wp_primary_nav_classes(); ?>">
                <?php 
                    do_action( 'starter_wp_primary_menu_start' );
                    starter_wp_menu_toggle();
                    starter_wp_main_nav_menu();
                    do_action( 'starter_wp_primary_menu_end' ); 
                ?>
            </nav>
        <?php endif; ?>

        <?php
    }
}
/*------------------------------------------------------------------------------------*
 * HEADER
 *------------------------------------------------------------------------------------*/

if ( ! function_exists( 'starter_wp_header_structure' ) ) {
    function starter_wp_header_structure() { ?>
        <header id="masthead" class="site-header" role="banner">
                <?php do_action( 'starter_wp_header_start' );?>
                <div class="masthead-wrap">
                    <div class="<?php echo starter_wp_site_header_wrap_classes(); ?>">
                    <?php do_action( 'starter_wp_masthead' );?>
                    </div>
                </div>
                <?php do_action( 'starter_wp_header_end' );?>
        </header>
        <?php
    }
}
add_action( 'starter_wp_header', 'starter_wp_header_structure' );

/*------------------------------------------------------------------------------------*
 * HEADER WIDGETS
 *------------------------------------------------------------------------------------*/
add_action( 'starter_wp_header', 'starter_wp_header_widgets', 60 );

if ( ! function_exists( 'starter_wp_header_widgets' ) ) :
    function starter_wp_header_widgets() {
        
        if ( is_active_sidebar( 'header-4' ) ) {
            $widget_columns = apply_filters( 'starter_wp_header_widget_regions', 4 );
        } elseif ( is_active_sidebar( 'header-3' ) ) {
            $widget_columns = apply_filters( 'starter_wp_header_widget_regions', 3 );
        } elseif ( is_active_sidebar( 'header-2' ) ) {
            $widget_columns = apply_filters( 'starter_wp_header_widget_regions', 2 );
        } elseif ( is_active_sidebar( 'header-1' ) ) {
            $widget_columns = apply_filters( 'starter_wp_header_widget_regions', 1 );
        } else {
            $widget_columns = apply_filters( 'starter_wp_header_widget_regions', 0 );
        }

        $classes = apply_filters( 'starter_wp_header_widgets_classes', array( 'header-widgets', 'columns-' . intval( $widget_columns ) ), $widget_columns );

        if ( $widget_columns > 0 ) : ?>

            <?php do_action( 'starter_wp_header_widgets_before' ); ?>

            <section class="<?php echo implode( ' ', $classes ); ?>">
                <div class="header-widgets-wrap col-container">
                    <?php 
                        do_action( 'starter_wp_header_widgets_start' ); 
                        $i = 0;
                        while ( $i < $widget_columns ) : $i++;
                            if ( is_active_sidebar( 'header-' . $i ) ) :
                                    $widget_column_classes = apply_filters( 'starter_wp_header_widget_classes', array( starter_wp_header_widget_column_classes( $widget_columns ), 'header-widget', 'widget-column', 'header-widget-' . intval( $i ) ) );
                                ?>
                                <div class="<?php echo implode( ' ', array_filter( $widget_column_classes ) ); ?>">
                                    <?php dynamic_sidebar( 'header-' . intval( $i ) ); ?>
                                </div>
                            <?php endif; //if ( is_active_sidebar( 'header-' . $i ) )
                        endwhile; 
                        do_action( 'starter_wp_header_widgets_end' ); ?>
                </div>
            </section>

            <?php do_action( 'starter_wp_header_widgets_after' ); ?>

	<?php endif; //$widget_columns > 0

    }
endif;

function starter_wp_header_widget_column_classes( $widget_columns ) {
	switch ( $widget_columns ) {
        case 4:
			$classes = 'col-four-cycle';
			break;
		case 3:
			$classes = 'col-three-cycle';
			break;
		case 2:
            $classes = 'col-two-cycle';
			break;
		case 1:
			$classes = 'col-one';
			break;
	}
	return apply_filters( 'starter_wp_header_widget_column_classes', $classes, $widget_columns );
}