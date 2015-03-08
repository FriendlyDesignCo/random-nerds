<?php get_header(); ?>

<?php while (have_posts()): the_post(); ?>
  <div class="category-header page-header">
    <h1><?php the_title(); ?></h1>
  </div>
  <div class="page-content-box authors-page">
    <?php while (have_rows('authors')): the_row(); $author = get_sub_field('user'); ?>
      <a href="<?php echo get_author_posts_url($author['ID']); ?>" class="author">
        <div class="author-box">
          <div class="image"><img src="<?php the_field('profile_picture', 'user_'.$author['ID']); ?>"></div>
          <hr class="tiny">
          <img src="<?php the_field('signature', 'user_'.$author['ID']); ?>" class="signature">
        </div>
      </a>
    <?php endwhile; ?>
    <div class="clearfix"></div>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
