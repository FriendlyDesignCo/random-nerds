<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Random Nerds</title>
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,900|Lora:400,700,400italic,700italic|Montserrat|Covered+By+Your+Grace' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/icon-32.png">
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/images/icon-16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/images/icon-32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/images/icon-96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/images/icon-192.png" sizes="192x192">

    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <?php if (isset($_COOKIE['ignoredCategories'])) $ignoredCategories = json_decode(stripslashes($_COOKIE['ignoredCategories']), true); else $ignoredCategories = array(); ?>
    <div id="avatar-select" class="<?php if (count($ignoredCategories) == 0): ?>none-selected<?php endif; ?> <?php if (isset($_COOKIE['sidebar-state']) && stristr($_COOKIE['sidebar-state'], 'closed')): ?>sidebar-hidden<?php else: ?>sidebar-visible<?php endif; ?>">
      <ul>
        <li><a href="/" id="sidebar-home-link"><img src="<?php echo bloginfo('template_url'); ?>/images/small_signature.png"></a></li>
        <li><a href="#" class="apply-filter"><div class="avatar-icon icon-politics <?php if (in_array('politics',$ignoredCategories)): ?>disabled<?php endif; ?>" data-category="politics"><img class="mobile-only close-button" src="<?php echo bloginfo('template_url'); ?>/images/mobile_avatar_x.png"><div class="hover"></div><div class="border"></div></div>Politics</a></li>
        <li><a href="#" class="apply-filter"><div class="avatar-icon icon-gaming <?php if (in_array('gaming',$ignoredCategories)): ?>disabled<?php endif; ?>" data-category="gaming"><img class="mobile-only close-button" src="<?php echo bloginfo('template_url'); ?>/images/mobile_avatar_x.png"><div class="hover"></div><div class="border"></div></div>Gaming</a></li>
        <li><a href="#" class="apply-filter"><div class="avatar-icon icon-tech <?php if (in_array('tech',$ignoredCategories)): ?>disabled<?php endif; ?>" data-category="tech"><img class="mobile-only close-button" src="<?php echo bloginfo('template_url'); ?>/images/mobile_avatar_x.png"><div class="hover"></div><div class="border"></div></div>Tech</a></li>
        <li><a href="#" class="apply-filter"><div class="avatar-icon icon-pop-culture <?php if (in_array('pop-culture',$ignoredCategories)): ?>disabled<?php endif; ?>" data-category="pop-culture"><img class="mobile-only close-button" src="<?php echo bloginfo('template_url'); ?>/images/mobile_avatar_x.png"><div class="hover"></div><div class="border"></div></div>Pop Culture</a></li>
      </ul>
    </div>

    <div id="menu-open">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </div>
    <div id="mobile-home">
      <a href="/"><img src="<?php echo bloginfo('template_url'); ?>/images/small_signature.png"></a>
    </div>
    <div id="main-menu" style="display:none;">
      <hr>
      <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
      <hr>
      <form method="POST" id="mailchimp-subscribe">
        <p>Want to get articles delivered straight to you?</p>
        <input type="submit" class="submit" style="display:none;">
        <input type="email" placeholder="Your Email" name="mailchimp_email_subscribe" required="required"><a href="#"><i class="fa fa-envelope"></i></a>
        <div class="clearfix"></div>
      </form>
      <?php if (is_active_sidebar('sidebar_menu_social')): ?>
        <?php dynamic_sidebar('sidebar_menu_social'); ?>
      <?php endif; ?>
    </div>

    <a href="#" id="collapse-sidebar" class="<?php if (isset($_COOKIE['sidebar-state'])): ?><?php echo stripslashes(str_replace('"','',$_COOKIE['sidebar-state'])); ?><?php endif; ?>"><i class="fa fa-chevron-left"></i></a>
    <section id="content" class="<?php if (isset($_COOKIE['sidebar-state']) && stristr($_COOKIE['sidebar-state'], 'closed')): ?>closed sidebar-hidden<?php else: ?>sidebar-visible<?php endif; ?>">
      <?php include('article-sidebar.php'); ?>
      <section id="content-body">

<?php if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_GET['spage'])) exit(); ?>
