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
    <div class="article-header-image <?php the_field('color_mode', get_the_ID()); ?> page-header <?php if ($thumbnail === false): ?>no-header-image<?php endif; ?>" style="<?php if ($thumbnail !== false): ?>background-image:url('<?php echo $thumbnail; ?>');<?php endif; ?>">
      <div class="cover">
        <a href="<?php the_permalink(); ?>"><h2 class="fittext"><span><?php the_title(); ?></span></h2></a>
        <a href="/" id="logo"><img src="<?php bloginfo('template_url'); ?>/images/signature-logo.svg" title="Random Nerds"></a>
      </div>
    </div>
    <div class="article featured">
      <div class="meta-row text-center">
        <span class="light-grey">By</span> <a class="author-link" href="<?php echo get_author_posts_url(get_the_author_ID()); ?>"><?php the_author(); ?></a>
        <?php if (!is_home()): ?><p><span class="date"><?php the_date('M j, Y'); ?></span></p><?php endif; ?>
      </div>
      <?php if (!is_home()): ?>
        <hr class="small">
        <div class="meta-row text-center">
          <ul>
            <li><span class="light-grey">Filed In</span> <span class="categories upper">
              <?php $categoryLinks = array();
              foreach (get_ordered_categories() as $category)
              {
                $categoryLinks[] = '<a href="' . get_category_link($category->term_id) . '" class="category-' . $category->slug . '" rel="category tag">' . $category->name . '</a>';
              }
              echo implode(', ', $categoryLinks);
              ?></span></li>
          </ul>
        </div>
      <?php endif; ?>
      <hr class="small desktop-only">
      <div class="article-body">
        <?php if (is_single()): ?>
          <?php the_content(); ?>
        <?php else: ?>
          <?php the_excerpt(); ?>
          <div class="read-more"><a href="<?php the_permalink(); ?>"><span>Read More</span> <div class="arrow"><i class="fa fa-chevron-right"></i></div><div class="clearfix"></div></a></div>
        <?php endif; ?>
      </div>
      <?php if (!is_home()): ?>
        <?php if (count(wp_get_post_tags(get_the_ID())) > 0): ?>
          <p class="submitted-to"><span class="light-grey">Submitted To</span> <span class="categories"><?php the_tags('', ', '); ?></span></p>
        <?php endif; ?>
        <div class="author-signature">
          <img src="<?php the_field('signature', 'user_'.get_the_author_meta('ID')); ?>">
        </div>
        <?php get_template_part('sharing-and-tipping'); ?>
        <?php get_template_part('author-info'); ?>
      <?php else: ?>
        <div class="divider-row"><hr class="divider desktop-only"><hr class="tiny left mobile-only"></div>
      <?php endif; ?>
    </div>
  </article>
  <?php if (is_single()): ?>
    <div id="disqus_thread"></div>
    <script type="text/javascript">
      var disqus_shortname = '<?php echo ot_get_option('disqus_shortname'); ?>';
      var disqus_identifier = 'post_<?php the_ID(); ?>';
      (function() {
          var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
          dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
          (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
      })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
  <?php endif; ?>
