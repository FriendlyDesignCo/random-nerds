<?php get_header(); ?>
<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); $authorID = $curauth->ID; ?>
<div class="page-header"></div>
<div class="author-header">
  <img id="author-image" class="author-image" src="<?php the_field('profile_picture', 'user_'.$authorID); ?>">
  <div class="author-info">
    <h1 class="fittext" data-max-size="75"><span><?php echo $curauth->display_name; ?></span></h1>
    <p class="job-title"><?php the_field('job_title', 'user_'.$authorID); ?></p>
    <?php if (strlen($twitter = get_field('twitter_username', 'user_'.$authorID)) > 0): ?>
      <a href="https://www.twitter.com/<?php echo $twitter; ?>" class="twitter-link">@<?php echo $twitter; ?></a>
      <hr class="tiny left"><br>
    <?php endif; ?>
  </div>
</div>

<div class="row">
  <div class="column-left">
    <?php the_field('extended_bio', 'user_'.$authorID); ?>
    <p><img src="<?php the_field('signature', 'user_'.$authorID); ?>" class="signature"></p>
  </div>
  <div class="column-right">

    <h5>Articles by <?php echo the_author_meta('first_name', $curauth->ID); ?></h5>

    <?php while (have_posts()): the_post();
    $categories = get_the_category();
    $categoryNames = array(); $categorySlugs = array(); $categoryLinks = array();
    foreach ($categories as $category) {
      $categoryNames[] = $category->cat_name;
      $categorySlugs[] = 'category-'.$category->slug;
      $categoryLinks[] = '<a href="' . get_category_link($category->cat_ID) . '">' . $category->cat_name . '</a>';
    }
    ?>

      <article class="primary-<?php the_field('primary_category'); ?>">
        <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
        <div class="article-info">
          <span>Filed In <span class="colorize-categories"><?php the_category(', '); ?></span></span><br>
          <span>Submitted To</span> <span class="tags"><?php the_tags('', ', '); ?></span>
        </div>
        <?php if ($i < count($posts)-1): ?>
          <div class="divider-row"><hr class="divider"></div>
        <?php endif; ?>
      </article>
    <?php $i++; endwhile; ?>

    <?php if (get_next_posts_link() !== null): ?>
      <div class="comment-divider more-posts-link add-divider-row">
        <hr>
        <div class="plus"><?php next_posts_link('<span>+</span>'); ?></div>
        <?php echo str_replace('<a', '<a class="load-more"', get_next_posts_link('Load More')); ?>
        <div class="loader-blue hidden">Loading...</div>
      </div>
    <?php endif; ?>
    <div id="end-of-posts-marker"></div>
  </div>
  <div class="clearfix"></div>
</div>

<?php get_footer(); ?>
