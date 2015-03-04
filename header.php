<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <div id="avatar-select">
      <ul>
        <li><a href="#" id="collapse-sidebar"><i class="fa fa-chevron-left"></i></a></li>
        <li><a href="#" class="avatar-icon icon-politics disabled">Politics</a></li>
        <li><a href="#" class="avatar-icon icon-gaming">Gaming</a></li>
        <li><a href="#" class="avatar-icon icon-tech">Tech</a></li>
        <li><a href="#" class="avatar-icon icon-pop-culture">Pop Culture</a></li>
      </ul>
    </div>

    <button type="button" id="menu-open">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <div id="main-menu">
      <button id="menu-close"><img src="<?php echo bloginfo('template_url'); ?>/images/close_button.png"></button>
      <div class="clearfix"></div>
      <hr>
      <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
      <hr>
      <?php if (is_active_sidebar('sidebar_menu_social')): ?>
        <?php dynamic_sidebar('sidebar_menu_social'); ?>
      <?php endif; ?>
    </div>

    <section id="content" class="sidebar-visible">
      <section id="article-sidebar">
          <div class="article featured">
            <h2><?php echo ot_get_option('sidebar_top_comment'); ?></h2>
          </div>

        <?php
        $sidebarQuery = new WP_Query(array('posts_per_page' => 25));
        while ($sidebarQuery->have_posts()): $sidebarQuery->the_post();
        $categories = get_the_category();
        $categoryNames = array(); $categorySlugs = array();
        foreach ($categories as $category) {
          $categoryNames[] = $category->cat_name;
          $categorySlugs[] = 'category-'.$category->slug;
        }
        ?>

          <?php if (has_post_format('status')): ?>
            <?php /* STATUS UPDATE */ ?>
            <div class="post" data-post-id="<?php the_ID(); ?>">
              <div class="status-update <?php echo implode(' ', $categorySlugs); ?> <?php the_field('avatar'); ?> avatar-<?php the_field('display_side'); ?>">
                <h2>"<?php the_title(); ?>"</h2>
                <img class="avatar" src="<?php echo bloginfo('template_url'); ?>/images/<?php echo str_replace('avatar-','avatar-sidebar-',get_field('avatar')); ?>.png">
              </div>
            </div>
          <?php else: ?>
            <?php /* REGULAR POST */ ?>
            <div class="post" data-post-id="<?php the_ID(); ?>">
              <a href="<?php the_permalink(); ?>">
                <div class="article <?php echo implode(' ', $categorySlugs); ?>">
                  <div class="cover"><?php the_field('post_subtitle'); ?></div>
                  <h3 class="category"><?php echo implode(', ', $categoryNames);?></h3>
                  <h2><?php the_title(); ?></h2>
                </div>
              </a>
            </div>
          <?php endif; ?>
        <?php endwhile; wp_reset_postdata(); ?>
      </section>
      <section id="content-body">
