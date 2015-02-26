<?php get_header(); ?>
<section id="content">
  <section id="article-sidebar">
    <div class="article featured">
      <h2>Featured Article Title</h2>
    </div>

    <?php while (have_posts()): the_post();
    $categories = get_the_category();
    $categoryNames = array(); $categorySlugs = array();
    foreach ($categories as $category) {
      $categoryNames[] = $category->cat_name;
      $categorySlugs[] = 'category-'.$category->slug;
    }
    ?>
      <a href="#">
        <div class="article <?php echo implode(' ', $categorySlugs); ?>">
          <div class="cover">SUBTITLE</div>
          <h3 class="category"><?php echo implode(', ', $categoryNames);?></h3>
          <h2><?php the_title(); ?></h2>
        </div>
      </a>
    <?php endwhile; ?>
  </section>
</section>
<?php get_footer(); ?>
