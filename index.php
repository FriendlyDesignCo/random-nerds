<?php get_header();

$i = 0; ?>

    <?php

    if (is_home()):
      $query = new WP_Query(array('cat' => 6, 'posts_per_page' => 1));
      if ($query->have_posts()):
        while ($query->have_posts()): $query->the_post(); $featuredArticle = get_post(); $i++; ?>
          <?php get_template_part('featured-post'); ?>
        <?php endwhile; ?>
      <?php endif; ?>
    <?php endif; ?>

    <?php while (have_posts()): the_post();
    $categories = get_the_category();
    $categoryNames = array(); $categorySlugs = array(); $categoryLinks = array();
    $neutralColor = true; $categoryCount = 0;
    foreach ($categories as $category) {
      if ($cagegory->ID !== 6)
        $categoryCount++;
      $categoryNames[] = $category->cat_name;
      $categorySlugs[] = 'category-'.$category->slug;
    }
    foreach (get_ordered_categories() as $category)
    {
      $categoryLinks[] = '<a href="' . get_category_link($category->term_id) . '" class="category-' . $category->slug . '" rel="category tag">' . $category->name . '</a>';
    }
    ?>
      <article class="<?php if (!is_single()): ?>filterable<?php endif; ?> <?php echo implode(' ', $categorySlugs); ?> <?php if (strlen(get_field('primary_category')) > 0): ?>primary-<?php the_field('primary_category'); ?><?php else: ?>neutral<?php endif; ?>">
        <div class="article">
          <div class="category-info colorize-categories">
            In <?php echo implode(', ', $categoryLinks); ?>
          </div>
          <h2><a href="<?php the_permalink(); ?>" class="article-title"><?php the_title(); ?></a></h2>
          <hr class="small desktop-only">
          <p class="subtitle mobile-only"><?php the_field('post_subtitle'); ?></p>
          <div class="meta-row text-center pad-bottom">
            <span class="light-grey">By</span> <a class="author-link" href="<?php echo get_author_posts_url(get_the_author_ID()); ?>"><?php the_author(); ?></a>
          </div>

          <div class="article-body desktop-only">
            <?php the_excerpt('<div class="read-more hidden"><span>Read More</span> <div class="arrow">&#8594;</div><div class="clearfix"></div></div>'); ?>
          </div>

          <?php if ($i < ($wp_query->found_posts)): ?>
            <div class="divider-row"><hr class="divider desktop-only <?php if ($i == 0): ?>signature<?php endif; ?>"><hr class="tiny left mobile-only"></div>
          <?php endif; ?>
        </div>
      </article>
    <?php $i++; endwhile; ?>

    <?php if (get_next_posts_link() !== null): ?>
      <div class="comment-divider more-posts-link">
        <hr>
        <div class="plus"><?php next_posts_link('<span>+</span>'); ?></div>
        <?php echo str_replace('<a', '<a class="load-more"', get_next_posts_link('Load More')); ?>
        <div class="loader blue hidden">Loading...</div>
      </div>
    <?php endif; ?>

    <div id="end-of-posts-marker"></div>

<?php get_footer(); ?>
