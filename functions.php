<?php

if (!function_exists('randomNerdsInit'))
{
  function randomNerdsInit()
  {
    add_post_type_support('post', 'excerpt');
    add_theme_support( 'html5', array( 'search-form' ) );
  }
}
add_action('init', 'randomNerdsInit');

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

function citeTooltip($attributes, $content)
{
  return '<cite rel="tooltip" title="' . htmlentities($content) . '">#</cite>';
}
add_shortcode('cite', 'citeTooltip');

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
    'taxonomies'   => array( 'category'),
		"rewrite"      => array( "slug" => "footer-message", "with_front" => true ),
		"query_var"    => true,
				"menu_icon" => "dashicons-download",
  );
	register_post_type( "footer-message", $args );
}

// Exclude status posts from the main query
function excludeStatusPosts($query)
{
  // The === 2 is to catch Yuzo's query for two related posts and eliminate
  // the "status" post format. We also eliminate it on the main query
  if (($query->is_main_query() || $query->query_vars['posts_per_page'] === 2) && !is_admin())
  {
    $taxQuery = array(array(
      'taxonomy' => 'post_format',
      'field'    => 'slug',
      'terms'    => array('post-format-status'),
      'operator' => 'NOT IN'
    ));
    $query->set('tax_query', $taxQuery);
  }
}
add_action('pre_get_posts', 'excludeStatusPosts');

function removeExtraScripts() {
    global $wp_styles;
    wp_dequeue_style('front-css-yuzo_related_post');
}
add_action( 'wp_print_styles', 'removeExtraScripts' );

function removeViewsColumnFromPosts($columns)
{
  global $current_user;
  if (!in_array('administrator', $current_user->roles) && !in_array('editor', $current_user->roles))
  {
    if (isset($columns['yuzo_post_views']))
      unset($columns['yuzo_post_views']);
  }
  return $columns;
}
// ...seriously, WP?
function removeViewsColumnFromPostsFilter()
{
  add_filter('manage_posts_columns', 'removeViewsColumnFromPosts');
}
add_action( 'admin_init' , 'removeViewsColumnFromPostsFilter' );

// Subscribe to MailChimp updates
function contactFormMailchimpSubscribe($form)
{
  if (isset($_POST['subscribe'][0]))
  {
    require_once(__DIR__.'/extra-config.php');
    require_once(__DIR__.'/mailchimp-api/src/Mailchimp.php');

    $mc = new Mailchimp(MAILCHIMP_API_KEY);
    $mc->lists->subscribe(MAILCHIMP_LIST_ID, array('email' => $_POST['your-email']));
  }
}
add_action('wpcf7_mail_sent', 'contactFormMailchimpSubscribe');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mailchimp_email_subscribe']))
{
  require_once(__DIR__.'/extra-config.php');
  require_once(__DIR__.'/mailchimp-api/src/Mailchimp.php');

  $mc = new Mailchimp(MAILCHIMP_API_KEY);
  $mc->lists->subscribe(MAILCHIMP_LIST_ID, array('email' => $_POST['mailchimp_email_subscribe']));
  exit();
}

add_filter('the_excerpt', 'do_shortcode');

function getDefaultCategoryOrder()
{
  $order = array('features','politics','gaming','tech','pop-culture');
  if (strlen(get_field('primary_category')) > 0)
  {
    unset($order[array_search(get_field('primary_category'), $order)]);
    array_unshift($order, get_field('primary_category'));
  }
  return $order;
}

function get_ordered_categories()
{
  $order = getDefaultCategoryOrder();
  $categories = get_the_category();
  usort($categories, 'orderedCategorySort');
  return $categories;
}

function orderedCategorySort($a, $b)
{
  $order = getDefaultCategoryOrder();
  return array_search($a->slug, $order) - array_search($b->slug, $order);
}

function TinyMCESettings($settings)
{
  $settings['formats'] = "{ alignleft: [
    {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign:'left'}},
    {selector: 'img,table,dl.wp-caption,blockquote', classes: 'alignleft'} ],
    aligncenter: [ {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign:'center'}},
    {selector: 'img,table,dl.wp-caption,blockquote', classes: 'aligncenter'} ],
    alignright: [ {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign:'right'}},
    {selector: 'img,table,dl.wp-caption', classes: 'alignright'} ], strikethrough: {inline: 'del'} }";
  return $settings;
}
add_filter('tiny_mce_before_init', 'TinyMCESettings');

function TinyMCEButtons1($buttons)
{
  $newButtons = array_slice($buttons, 0, 6, true);
  $newButtons[] = 'blockquote_right';
  $newButtons = array_merge($newButtons, array_slice($buttons, 6));
  return $newButtons;
}
add_filter('mce_buttons', 'TinyMCEButtons1');

function TinyMCEButtonPlugin($pluginArray)
{
  $pluginArray['randomnerds'] = get_template_directory_uri().'/js/tinymce-plugin.js';
  return $pluginArray;
}
add_filter('mce_external_plugins', 'TinyMCEButtonPlugin');


function customBodyClass( $classes ) {
  if (isset($_COOKIE['sidebar-state']) && stristr($_COOKIE['sidebar-state'], 'closed') && !is_home())
	  $classes[] = 'sidebar-closed';
  else
    $classes[] = 'sidebar-open';
	// return the $classes array
	return $classes;
}
add_filter('body_class', 'customBodyClass');
