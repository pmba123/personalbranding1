<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Starter_WP
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
<?php do_action( 'starter_wp_site_before' ); ?>
    
<div id="page" class="site">
    
    <?php do_action( 'starter_wp_header' ); ?>

	<div id="content" class="site-content">
        <div class="<?php echo starter_wp_site_content_wrap(); ?>">
            <?php do_action( 'starter_wp_content_start' ); ?>
