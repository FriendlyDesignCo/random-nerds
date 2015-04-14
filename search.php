<?php get_header(); ?>

<div class="category-header page-header">
  <h1 class="mobile-fittext"><span>Search Results for &ldquo;<span class="category-name"><?php echo htmlentities($_GET['s']); ?></span>&rdquo;</span></h1>
</div>

<?php if (!have_posts()): ?>
  <div class="page-content-box search">
    <article>
      <h1>Sorry, no results match your search.</h1>
      <img src="<?php echo bloginfo('template_url'); ?>/images/avatar-downtime-sketch.png">
    </article>
  </div>
<?php endif; ?>
<?php include('index-loop.php'); ?>

<?php get_footer(); ?>
