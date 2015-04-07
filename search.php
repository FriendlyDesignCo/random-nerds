<?php get_header(); ?>

<div class="category-header page-header">
  <h1 class="mobile-fittext"><span>Search Results for &ldquo;<span class="category-name"><?php echo htmlentities($_GET['s']); ?></span>&rdquo;</span></h1>
</div>

<?php if (!have_posts()): ?>
  <div class="page-content-box">
    <article>
      <h1>Sorry, but no articles match your search.</h1>
    </article>
  </div>
<?php endif; ?>
<?php include('index-loop.php'); ?>

<?php get_footer(); ?>
