<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Random Nerds</title>
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,900|Lora:400,700,400italic,700italic|Montserrat|Covered+By+Your+Grace' rel='stylesheet' type='text/css'>

    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div id="avatar-select">
      <ul>
        <li><a href="#" id="collapse-sidebar"><span>&lt;</span></a></li>
        <li><a href="#" class="avatar-icon icon-politics disabled">Politics</a></li>
        <li><a href="#" class="avatar-icon icon-gaming">Gaming</a></li>
        <li><a href="#" class="avatar-icon icon-tech">Tech</a></li>
        <li><a href="#" class="avatar-icon icon-pop-culture">Pop Culture</a></li>
      </ul>
    </div>

    <section id="content" class="sidebar-visible">
      <section id="article-sidebar">

        <?php
        $query = new WP_Query(array('cat' => 6, 'posts_per_page' => 1));
        if ($query->have_posts()):
          while ($query->have_posts()): $query->the_post(); $featuredArticle = get_post(); ?>
            <a href="<?php the_permalink(); ?>">
              <div class="article featured">
                <h2><?php the_title(); ?></h2>
              </div>
            </a>
          <?php endwhile; ?>
        <?php endif; ?>

        <?php while (have_posts()): the_post();
        $categories = get_the_category();
        $categoryNames = array(); $categorySlugs = array();
        foreach ($categories as $category) {
          $categoryNames[] = $category->cat_name;
          $categorySlugs[] = 'category-'.$category->slug;
        }
        ?>
          <a href="<?php the_permalink(); ?>">
            <div class="article <?php echo implode(' ', $categorySlugs); ?>">
              <div class="cover"><?php the_field('post_subtitle'); ?></div>
              <h3 class="category"><?php echo implode(', ', $categoryNames);?></h3>
              <h2><?php the_title(); ?></h2>
            </div>
          </a>
        <?php endwhile; ?>
      </section>
