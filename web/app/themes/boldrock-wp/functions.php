<?php

define('MCWP_THEME_VERSION', '0.1');

// and make sure we're not leaking on stage/prod
if (!defined('MCWP_CONFIG_SET')) {
  ini_set('display_errors', 0);
  define('WP_DEBUG_DISPLAY', false);
  define('SCRIPT_DEBUG', false);
  define('WP_DEBUG', false);
}

require_once('lib/clean.php');

// If we're running a development version this will be set, otherwise it's not
if (!defined('IS_DEV')) {
  define('IS_DEV', false);
}

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script( 'typekit', '//use.typekit.net/lsl8isl.js', array(), '1.0.0' );
  // in development styles are injected via development build of main.js
  if (!IS_DEV) {
    wp_enqueue_style('styles', 'http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
  }
  wp_enqueue_style('slick-styles', get_stylesheet_uri(), array(), MCWP_THEME_VERSION);
  //wp_enqueue_script('waypoints', get_theme_file_uri('/waypoints.js'), array(), MCWP_THEME_VERSION);
  wp_enqueue_script('scripts', get_theme_file_uri('/js/main.js'), array(), MCWP_THEME_VERSION);
  wp_enqueue_script('header-scripts', get_theme_file_uri('/header.js'), array(), MCWP_THEME_VERSION);
  //wp_enqueue_script('slick', 'http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js');

  //if (is_page( 'cider-finder')) {
    //wp_enqueue_script('google-map-scripts', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDjp7gOCyWv6E-nrUV41E_xw_8Krp_Q_go', true);
    //wp_enqueue_script('cider-scripts', get_theme_file_uri('/cider.js'), array(), MCWP_THEME_VERSION);
  //}
});

//Typkit
add_action( 'wp_head', 'mcwp_typekit_inline' );

function mcwp_typekit_inline() {
	if ( wp_script_is( 'typekit', 'enqueued' ) ) {
		echo '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>';
	}
}

//IMG Dir Constant
if( !defined('THEME_IMG_PATH') ) {
  define( 'THEME_IMG_PATH', get_theme_file_uri('assets') );
}

add_theme_support( 'post-thumbnails' );
add_image_size( 'blur-thumb', 100 );

// Add pages to menu under Appearance > Menus
add_action('init', function() {
  register_nav_menus(
    array(
      'menu' => 'Menu'
    )
  );
});

// Allow SVG uploads
add_filter('upload_mimes', function($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
});
