<?php
add_action('starter_wp_page_header_wrapper_end', 'starter_wp_page_header_breadcrumbs');
function starter_wp_page_header_breadcrumbs() {
    if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb('<div class="breadcrumbs">','</div>');
    }
}
/*-------------------------------------------------------------------------------------------
 * Display archives page header
 ------------------------------------------------------------------------------------------*/
add_action('starter_wp_header', 'starter_wp_page_archive_header', 50);

if ( ! function_exists( 'starter_wp_page_archive_header' ) ) : 	// Process any classes passed in.
		
    function starter_wp_page_archive_header( ) {

        if (is_category() || is_tag() || is_tax()) :  ?>

        <header class="page-header archive">
            <div class="<?php echo starter_wp_page_header_wrap_classes(); ?>">
                <?php 
                    do_action( 'starter_wp_page_header_wrapper_start' ); 
                    the_archive_title('<h1 class="entry-title">','</h1>');
                    the_archive_description('<div class="taxonomy-description">','</div>');
                    do_action( 'starter_wp_page_header_wrapper_end' );
                ?>
            </div>
        </header>

        <?php 
        endif; 
    }
endif; 
/*-------------------------------------------------------------------------------------------
 * Display single page header
 ------------------------------------------------------------------------------------------*/
add_action('starter_wp_header', 'starter_wp_page_single_header', 50);

if ( ! function_exists( 'starter_wp_page_single_header' ) ) : 	// Process any classes passed in.
		
    function starter_wp_page_single_header( ) {

        if (is_singular() && !is_singular('product') && !is_front_page()) :  ?>

        <header class="page-header single">
            <div class="<?php echo starter_wp_page_header_wrap_classes(); ?>">
                <?php 
                    do_action( 'starter_wp_page_header_wrapper_start' ); 
                    the_title('<h1 class="entry-title">','</h1>');
                    do_action( 'starter_wp_page_header_wrapper_end' );
                ?>
            </div>
        </header>

        <?php 
        endif; 
    }
endif; 
/*-------------------------------------------------------------------------------------------
 * Display 404 page header
 ------------------------------------------------------------------------------------------*/
add_action('starter_wp_header', 'starter_wp_page_404_header', 50);

if ( ! function_exists( 'starter_wp_page_404_header' ) ) : 	// Process any classes passed in.
		
    function starter_wp_page_404_header() {

        if ( is_404() ) :  ?>

        <header class="page-header 404">
            <div class="<?php echo starter_wp_page_header_wrap_classes(); ?>">
                <?php 
                    echo '<h1 class="entry-title">';
                    esc_html_e( 'Oops! That page can&rsquo;t be found.', 'starter-wp' ); 
                    echo '</h1>';
                ?>
            </div>
        </header>

        <?php 
        endif; 
    }
endif;
/*-------------------------------------------------------------------------------------------
 * Display 4search page header
 ------------------------------------------------------------------------------------------*/
add_action('starter_wp_header', 'starter_wp_page_search_header', 50);

if ( ! function_exists( 'starter_wp_page_search_header' ) ) : 	// Process any classes passed in.
		
    function starter_wp_page_search_header() {

        if ( is_search() ) :  ?>

        <header class="page-header search">
            <div class="<?php echo starter_wp_page_header_wrap_classes(); ?>">
            <?php if ( have_posts() ) : ?>
                    <h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'starter-wp' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                <?php else : ?>
                    <h1 class="entry-title"><?php _e( 'Nothing Found', 'starter-wp' ); ?></h1>
                <?php endif; ?>
            </div>
        </header>

        <?php 
        endif; 
    }
endif; 
/*-------------------------------------------------------------------------------------------
 * Display woocommerce pages header
 ------------------------------------------------------------------------------------------*/
add_action('starter_wp_header', 'starter_wp_page_woocommerce_header', 50);

if ( ! function_exists( 'starter_wp_page_woocommerce_header' ) ) : 	// Process any classes passed in.
		
    function starter_wp_page_woocommerce_header() {

      
        add_filter( 'woocommerce_show_page_title', '__return_false' );
	    remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
        
        if (class_exists( 'woocommerce')) : ?>

           <?php  if (!is_shop() && is_tax('product-category')) : ?>
		      <header class="page-header wc-cat">
			     <div class="<?php echo starter_wp_page_header_wrap_classes(); ?>">
				    <?php 
                        do_action( 'starter_wp_page_header_wrapper_start' ); 
                            echo '<h1 class="entry-title">'. single_cat_title('',false) . '</h1>';
                        do_action( 'starter_wp_page_header_wrapper_end' );
                     ?>
                </div>
              </header>
            <?php endif; ?>  
            <?php  if (is_shop()) : ?>
		      <header class="page-header wc-shop">
			     <div class="<?php echo starter_wp_page_header_wrap_classes(); ?>">
                     <?php 
                        do_action( 'starter_wp_page_header_wrapper_start' );
                            echo '<h1 class="entry-title">';
                                 woocommerce_page_title();
                            echo '</h1>';
                        do_action( 'starter_wp_page_header_wrapper_end' );
                     ?>
                </div>
            </header>
           <?php 
        endif;  
    endif; 
    }
endif; 
