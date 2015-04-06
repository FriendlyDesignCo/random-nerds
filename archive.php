<?php get_header(); ?>

<div class="category-header page-header">
  <h1 class="mobile-fittext"><span>All Articles <?php if (is_tag()): ?>Submitted to<?php else: ?>Filed In<?php endif; ?> <span class="category-name"><?php echo ucwords(single_cat_title('',false)); ?></span></span></h1>
</div>

<?php include('index-loop.php'); ?>

<?php get_footer(); ?>
