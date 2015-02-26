<?php

if (!function_exists('randomNerdsSetup'))
{
  function randomNerdsSetup()
  {
    add_theme_support('post-thumbnails');
  }
}
add_action('after_setup_theme', 'randomNerdsSetup');

function randomNerdsScripts()
{
  wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), null);
}
add_action('wp_enqueue_scripts', 'randomNerdsScripts');
