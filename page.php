<?php get_header(); ?>

<?php while (have_posts()): the_post(); ?>
  <?php include('page-header.php'); ?>
  <div class="page-content-box">
    <article>
      <?php the_content(); ?>
    </article>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
