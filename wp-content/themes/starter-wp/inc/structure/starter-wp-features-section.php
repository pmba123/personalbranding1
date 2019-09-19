<?php
/**
 * Starter WP Features
 *
 * @package Starter_WP
 */
if ( ! function_exists( 'starter_wp_features' ) ) :        
    function starter_wp_features() {
        if ( is_front_page() && is_home() && get_theme_mod( 'features_enable', '1' ) || is_front_page() && get_theme_mod( 'features_enable', '1' ) )  : ?>

<div class="features">
    <div class="col-container">
        <?php 
          $defaults = array(
            array(
                'feature_icon' => esc_attr__( 'icon-diamond', 'starter-wp' ),
                'feature_heading' => esc_attr__( 'Maecenas vel nulla', 'starter-wp' ),
                'feature_text' => esc_attr__( 'Lorem usce volutpat lectus justo, ut suscipit felis congue ut.', 'starter-wp' ),
            ),
            array(
                'feature_icon' => esc_attr__( 'icon-diamond', 'starter-wp' ),
                'feature_heading' => esc_attr__( 'Maecenas vel nulla', 'starter-wp' ),
                'feature_text' => esc_attr__( 'Lorem usce volutpat lectus justo, ut suscipit felis congue ut.', 'starter-wp' ),
            ),
            array(
                'feature_icon' => esc_attr__( 'icon-diamond', 'starter-wp' ),
                'feature_heading' => esc_attr__( 'Maecenas vel nulla', 'starter-wp' ),
                'feature_text' => esc_attr__( 'Lorem usce volutpat lectus justo, ut suscipit felis congue ut.', 'starter-wp' ),
            ),
        );
        // Theme_mod settings to check.
        $settings = get_theme_mod( 'features', $defaults );
        $count = 0;
        foreach( $settings as $setting ) : 
        $count++;
            if ($count == 1) { $num='col-one'; }
            if ($count == 2) { $num='col-two-cycle'; }
            if ($count == 3) { $num='col-three-cycle'; }
            if ($count == 4) { $num='col-four-cycle'; }
        endforeach; ?>
        <?php foreach( $settings as $setting ) :  ?>
            <div class="feature <?php echo $num; ?>">
                <?php if ($setting['feature_icon']) : ?>
                    <i class="<?php echo $setting['feature_icon'] ?> icons"></i>
                <?php endif;?>
                <?php if ($setting['feature_heading']) : ?>
                    <h3 class="title"><?php echo $setting['feature_heading']; ?></h3>
                <?php endif;?>
                <?php if ($setting['feature_text']) : ?>
                    <p class="text"><?php echo $setting['feature_text']; ?></p>
                <?php endif;?>
            </div>
        <?php endforeach; ?>
         </div>
    </div>

    <?php 
            endif;
    }
add_action('starter_wp_header', 'starter_wp_features', 30);  
endif; 