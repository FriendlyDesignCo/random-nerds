<?php get_header();

$i = 0; ?>

    <?php
    if (is_home()):
      $query = new WP_Query(array('cat' => 6, 'posts_per_page' => 1));
      if ($query->have_posts()):
        while ($query->have_posts()): $query->the_post(); $featuredArticle = get_post(); $i++; $skipID = get_the_ID(); ?>
          <?php get_template_part('featured-post'); ?>
        <?php endwhile; ?>
      <?php endif; ?>
    <?php endif; ?>

    <?php include('index-loop.php'); ?>

<?php get_footer(); ?>
