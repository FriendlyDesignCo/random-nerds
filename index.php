<?php get_header(); ?>


  <section id="content-body">
    <?php $i = 0; while (have_posts()): the_post();
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
      <?php if ($i < ($wp_query->found_posts - 1)): ?>
        <hr class="divider <?php if ($i == 0): ?>signature<?php endif; ?>">
      <?php endif; ?>
    <?php $i++; endwhile; ?>
  </section>
<?php get_footer(); ?>
