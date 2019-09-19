<?php
/**
 * Welcome screen getting started template
 */
?>
<?php $theme_data = wp_get_theme('starter-wp'); ?>

<div id="wp_theme_addon" class="panel">
    <div class="theme-extension">
        <h3><?php esc_html_e( 'WooCommerce Customizer Add On', 'starter-wp' ); ?></h3>
        <p class="about"><?php esc_html_e( 'This extension gives you control over the appearance of your WooCommerce shop on your Started WP powered WordPress site.', 'starter-wp' ); ?></p>
        <p>
            <a href="<?php echo esc_url( 'https://iograficathemes.com/wordpress-themes/starter-wp/' ); ?>" target="_blank" class="button button-primary"><?php esc_html_e('view now', 'starter-wp'); ?></a>
        </p>
    </div>
     <div class="theme-extension">
        <h3><?php esc_html_e( 'Blog Customizer  Add On', 'starter-wp' ); ?></h3>
        <p class="about"><?php printf(esc_html__('This extension gives you control over the appearance of the blog on your Started WP powered WordPress site.', 'starter-wp'), $theme_data->Name); ?></p>
        <p>
            <a href="<?php echo esc_url( 'https://iograficathemes.com/wordpress-themes/starter-wp/' ); ?>" target="_blank" class="button button-primary"><?php esc_html_e('view now', 'starter-wp'); ?></a>
        </p>
    </div>
</div><!-- end ig-started -->
