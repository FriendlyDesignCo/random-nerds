<?php get_header(); ?>


  <section id="content-body">
    <?php while (have_posts()): the_post();
    $categories = get_the_category();
    $categoryNames = array(); $categorySlugs = array();
    foreach ($categories as $category) {
      $categoryNames[] = $category->cat_name;
      $categorySlugs[] = 'category-'.$category->slug;
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
            <span class="light-grey">By:</span> <a class="author-link" href="#">Author Name</a> <span class="light-grey">Posted In:</span> <a href="#">Tag</a>, <a href="#">Tag</a>
            <hr>
          </div>
          <?php the_content('<div class="read-more"><span>Read More</span> <div class="arrow">&#8594;</div><div class="clearfix"></div></div>'); ?>
        </div>
      </article>
    <?php endwhile; ?>
  </section>
<?php get_footer(); ?>
