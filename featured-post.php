<?php
$categories = get_the_category();
$categoryNames = array(); $categorySlugs = array(); $categoryLinks = array();
foreach ($categories as $category) {
  $categoryNames[] = $category->cat_name;
  $categorySlugs[] = 'category-'.$category->slug;
  $categoryLinks[] = '<a href="' . get_category_link($category->cat_ID) . '">' . $category->cat_name . '</a>';
}
 ?>
  <article class="<?php echo implode(' ', $categorySlugs); ?> first-article">
    <?php $thumbnail = false; if (has_post_thumbnail()) { $thumbObject = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumbnail'); $thumbnail = $thumbObject[0]; } ?>
    <div class="article-header-image <?php the_field('color_mode', get_the_ID()); ?>" style="background-image:url('<?php echo $thumbnail; ?>');">
      <div class="cover">
        <h2 class="fittext"><span><?php the_title(); ?></span></h2>
        <a href="/" id="logo"><img src="<?php bloginfo('template_url'); ?>/images/signature-logo.png" title="Random Nerds"></a>
      </div>
    </div>
    <div class="article featured">
      <div class="meta-row text-center">
        <span class="light-grey">By</span> <a class="author-link" href="<?php echo get_author_posts_url(get_the_author_ID()); ?>"><?php the_author(); ?></a>
      </div>
      <?php if (!is_home()): ?>
        <div class="meta-row text-center">
          <span class="light-grey">Submitted To</span> <?php the_category(', '); ?>
        </div>
      <?php endif; ?>
      <hr class="small">
      <div class="article-body">
        <?php the_content('<div class="read-more"><span>Read More</span> <div class="arrow">&#8594;</div><div class="clearfix"></div></div>'); ?>
      </div>
      <?php if (!is_home()): ?>
        <div class="author-signature">
          <img src="<?php the_field('signature', 'user_'.get_the_author_meta('ID')); ?>">
        </div>
        <?php get_template_part('author-info'); ?>
      <?php endif; ?>
    </div>
  </article>
  <?php if (is_home()): ?>
    <div class="row"><hr class="divider signature"></div>
  <?php else: ?>
  <?php endif; ?>
