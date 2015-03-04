<?php

if (!function_exists('randomNerdsSetup'))
{
  function randomNerdsSetup()
  {
    register_nav_menus(array(
      'primary' => 'Primary Menu'
    ));
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array('status'));
  }
}
add_action('after_setup_theme', 'randomNerdsSetup');

function randomNerdsWidgetAreas()
{
  register_sidebar(array(
    'name' => 'Sidebar Menu Social Icons',
    'id'   => 'sidebar_menu_social'
  ));
}
add_action('widgets_init', 'randomNerdsWidgetAreas');

function randomNerdsScripts()
{
  wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), null);
}
add_action('wp_enqueue_scripts', 'randomNerdsScripts');

function aside($attributes, $content)
{
  return '<aside><img src="' . get_bloginfo('template_url') . '/images/aside_arrow.png"><br>' . $content . '</aside>';
}
add_shortcode('aside', 'aside');

/* Advanced Custom Fields PRO */
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path( $path ) {
    return get_stylesheet_directory() . '/acf/';
}
add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir( $dir ) {
    return get_stylesheet_directory_uri() . '/acf/';
}
//add_filter('acf/settings/show_admin', '__return_false');
include_once( get_stylesheet_directory() . '/acf/acf.php' );
/* END ACF */

/* OptionTree */
add_filter( 'ot_theme_mode', '__return_true' );
require( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );
/* END OT */

add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {
	$labels = array(
		"name" => "Footer Messages",
		"singular_name" => "Footer Message",
		);

	$args = array(
		"labels" => $labels,
		"description" => "The message (and avatar!) visible in the site footer",
		"public" => true,
		"show_ui" => true,
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "footer-message", "with_front" => true ),
		"query_var" => true,
				"menu_icon" => "dashicons-download",					);
	register_post_type( "footer-message", $args );

// End of cptui_register_my_cpts()
}
