<?php get_header(); ?>

<?php while (have_posts()): the_post(); ?>
  <div class="category-header page-header">
    <h1><?php the_title(); ?></h1>
  </div>
  <div class="page-content-box">
    <article>
      <?php the_content(); ?>
    </article>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
