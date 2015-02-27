<?php get_header();

$i = 0; ?>


  <section id="content-body">
    <?php

    if (is_home()):
      $query = new WP_Query(array('cat' => 6, 'posts_per_page' => 1));
      if ($query->have_posts()):
        while ($query->have_posts()): $query->the_post(); $featuredArticle = get_post(); $i++;
        $categories = get_the_category();
        $categoryNames = array(); $categorySlugs = array(); $categoryLinks = array();
        foreach ($categories as $category) {
          $categoryNames[] = $category->cat_name;
          $categorySlugs[] = 'category-'.$category->slug;
          $categoryLinks[] = '<a href="' . get_category_link($category->cat_ID) . '">' . $category->cat_name . '</a>';
        }
         ?>
          <article class="<?php echo implode(' ', $categorySlugs); ?>">
            <?php $thumbnail = false; if (has_post_thumbnail()) { $thumbObject = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumbnail'); $thumbnail = $thumbObject[0]; } ?>
            <div class="article-header-image <?php the_field('color_mode', get_the_ID()); ?>" style="background-image:url('<?php echo $thumbnail; ?>');">
              <div class="cover">
                <h2 class="fittext"><span><?php the_title(); ?></span></h2>
                <a href="/" id="logo"><img src="<?php bloginfo('template_url'); ?>/images/signature-logo.png" title="Random Nerds"></a>
              </div>
            </div>
            <div class="article featured">
              <div class="meta-row text-center">
                <span class="light-grey">By:</span> <a class="author-link" href="<?php echo get_author_posts_url(get_the_author_ID()); ?>"><?php the_author(); ?></a>
              </div>
              <hr class="small">
              <?php the_content('<div class="read-more"><span>Read More</span> <div class="arrow">&#8594;</div><div class="clearfix"></div></div>'); ?>
            </div>
          </article>
          <hr class="divider signature">
        <?php endwhile; ?>
      <?php endif; ?>
    <?php endif; ?>

    <?php while (have_posts()): the_post();
    $categories = get_the_category();
    $categoryNames = array(); $categorySlugs = array(); $categoryLinks = array();
    foreach ($categories as $category) {
      $categoryNames[] = $category->cat_name;
      $categorySlugs[] = 'category-'.$category->slug;
      $categoryLinks[] = '<a href="' . get_category_link($category->cat_ID) . '">' . $category->cat_name . '</a>';
    }
    ?>
      <article class="<?php echo implode(' ', $categorySlugs); ?>">
        <div class="article">
          <div class="category-info">
            <a href="#"><?php echo implode(', ', $categoryNames); ?></a> post # <a href="<?php the_permalink(); ?>" class="black"><?php the_ID(); ?></a>
          </div>
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="meta-row">
            <hr>
            <span class="light-grey">
              By:</span> <a class="author-link" href="<?php echo get_author_posts_url(get_the_author_ID()); ?>"><?php the_author(); ?></a>
              <span class="light-grey">Posted In:</span> <?php echo implode(', ', $categoryLinks); ?>
            <hr>
          </div>
          <?php the_content('<div class="read-more"><span>Read More</span> <div class="arrow">&#8594;</div><div class="clearfix"></div></div>'); ?>
        </div>
      </article>
      <?php if ($i < ($wp_query->found_posts)): ?>
        <hr class="divider <?php if ($i == 0): ?>signature<?php endif; ?>">
      <?php endif; ?>
    <?php $i++; endwhile; ?>
  </section>
<?php get_footer(); ?>
