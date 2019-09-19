<?php
function load_scripts(){

  //wp_enqueue_style('1',get_template_directory_uri().'2');


  wp_enqueue_style('bootstrap.min.css',get_template_directory_uri().'/css/bootstrap.min.css');
  wp_enqueue_style('jquery.fancybox.css',get_template_directory_uri().'/css/jquery.fancybox.css');
  wp_enqueue_style('main.css',get_template_directory_uri().'/css/main.css');
  wp_enqueue_style('responsive.css',get_template_directory_uri().'/css/responsive.css');
  wp_enqueue_style('animate.min.css',get_template_directory_uri().'/css/animate.min.css');
  wp_enqueue_style('font-awesome.min.css','https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');

//wp_enqueue_script('1','2','3','4','5');
// 1 id or name for file
// 2 is the path for the directory
// 3 is dependency (does the file need another file to work?) typically no.
// 4 is the version of the file. Typically the value here is null.
// 5 is tells whether you want to add the script in the footer section of your site.


  wp_enqueue_script('jquery.min.js','https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',array(),'1.11.3',true);
  wp_enqueue_script('bootstrap.min.js',get_template_directory_uri().'/js/bootstrap.min.js',array(),'null',true);
  wp_enqueue_script('jquery.fancybox.pack.js',get_template_directory_uri().'/js/jquery.fancybox.pack.js',array(),'null',true);
  wp_enqueue_script('jquery.waypoints.min.js',get_template_directory_uri().'/js/jquery.waypoints.min.js',array(),'null',true);
  wp_enqueue_script('retina.min.js',get_template_directory_uri().'/js/retina.min.js',array(),'null',true);
  wp_enqueue_script('modernizr.js',get_template_directory_uri().'/js/modernizr.js',array(),'null',true);
  wp_enqueue_script('main.js',get_template_directory_uri().'/js/main.js',array(),'null',true);

}

add_action('wp_enqueue_scripts','load_scripts');

add_action('widgets_init','minifolio_sidebars');

function minifolio_sidebars(){
  register_sidebar(
    array(
      'name' => 'Banner',
      'id' => 'banner',
      'description' => 'Drag your widgets here.',
      'before_widget' => '<div class="widget_wrapper">',
      'after_widget' => '</div>',
      'before_title' => '<h2 class=widget_title>',
      'after_title' => '<h2>'
      )
    );
    register_sidebar(
      array(
        'name' => 'About Me',
        'id' => 'about_me',
        'description' => 'Drag your widgets here.',
        'before_widget' => '<div class="widget_wrapper">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class=widget_title>',
        'after_title' => '<h2>'
        )
      );
      register_sidebar(
        array(
          'name' => 'About Me2',
          'id' => 'about_me2',
          'description' => 'Drag your widgets here.',
          'before_widget' => '<div class="widget_wrapper">',
          'after_widget' => '</div>',
          'before_title' => '<h2 class=widget_title>',
          'after_title' => '<h2>'
          )
        );
        register_sidebar(
          array(
            'name' => 'Hire Me',
            'id' => 'hire_me',
            'description' => 'Drag your widgets here.',
            'before_widget' => '<div class="widget_wrapper">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class=widget_title>',
            'after_title' => '<h2>'
            )
          );
          register_sidebar(
            array(
              'name' => 'Contact',
              'id' => 'contact',
              'description' => 'Drag your widgets here.',
              'before_widget' => '<div class="widget_wrapper">',
              'after_widget' => '</div>',
              'before_title' => '<h2 class=widget_title>',
              'after_title' => '<h2>'
              )
            );
}
