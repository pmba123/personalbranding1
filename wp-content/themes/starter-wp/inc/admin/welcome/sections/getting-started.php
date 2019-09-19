<?php
/**
 * Welcome screen getting started template
 */
?>
<?php $theme_data = wp_get_theme('starter-wp'); ?>

<div id="getting_started" class="panel">
    <div class="theme-link">
        <h3><?php esc_html_e( 'Enjoying the theme?', 'starter-wp' ); ?></h3>
        <p class="about"><?php esc_html_e( 'If you like this theme why not leave us a review on WordPress.org?  We\'d really appreciate it!', 'starter-wp' ); ?></p>
        <p>
            <a href="<?php echo esc_url( 'https://wordpress.org/support/theme/'. $theme_data->get( 'TextDomain' ) .'/reviews/#new-post' ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e('Add Your Review', 'starter-wp'); ?></a>
        </p>
    </div>
    <div class="theme-link">
        <h3><?php esc_html_e( 'Theme Documentation', 'starter-wp' ); ?></h3>
        <p class="about"><?php printf(esc_html__('Need any help to setup and configure %s? Please have a look at our documentations instructions.', 'starter-wp'), $theme_data->Name); ?></p>
        <p>
            <a href="<?php echo esc_url( 'http://www.iograficathemes.com/documentation/'. $theme_data->get( 'TextDomain' ) .'-premium/' ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e('View Documentation', 'starter-wp'); ?></a>
        </p>
    </div>
    <div class="theme-link">
        <h3><?php esc_html_e( 'Theme Customizer', 'starter-wp' ); ?></h3>
        <p class="about"><?php printf(esc_html__('%s supports the Theme Customizer for all theme settings. Click "Customize" to start customize your site.', 'starter-wp'), $theme_data->Name); ?></p>
        <p>
            <a href="<?php echo admin_url('customize.php'); ?>" class="button button-secondary"><?php esc_html_e('Start Customize', 'starter-wp'); ?></a>
        </p>
    </div>
</div><!-- end ig-started -->
