<?php get_header();

$i = 0; ?>

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
          <div class="row"><hr class="divider signature"></div>
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
            # <a href="<?php the_permalink(); ?>" class="grey"><?php the_ID(); ?></a> in <a href="#"><?php echo implode(', ', $categoryNames); ?></a>
          </div>
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <hr class="small">
          <div class="meta-row text-center pad-bottom">
            <span class="light-grey">By:</span> <a class="author-link" href="<?php echo get_author_posts_url(get_the_author_ID()); ?>"><?php the_author(); ?></a>
          </div>

          <?php the_content('<div class="read-more hidden"><span>Read More</span> <div class="arrow">&#8594;</div><div class="clearfix"></div></div>'); ?>

          <?php if ($i < ($wp_query->found_posts)): ?>
            <div class="divider-row"><hr class="divider <?php if ($i == 0): ?>signature<?php endif; ?>"></div>
          <?php endif; ?>
        </div>
      </article>
    <?php $i++; endwhile; ?>
<?php get_footer(); ?>
