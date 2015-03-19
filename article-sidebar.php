<section id="article-sidebar">
    <div class="article featured">
      <h2 class="random-angle-<?php echo rand(5,15); ?>"><?php echo ot_get_option('sidebar_top_comment'); ?></h2>
    </div>

    <div id="sidebar-posts">
      <div class="loading-overlay">
        <div class="loading-text sidebar-loading-message"><span>Refiltering Posts</span> <div class="loader"></div></div>
      </div>
  <?php
  if (isset($_COOKIE['ignoredCategories']))
    $ignoredCategories = json_decode(stripslashes($_COOKIE['ignoredCategories']), true);
  else
    $ignoredCategories = array();
  $page = isset($_GET['spage']) ? $_GET['spage'] : 1;
  $sidebarQuery = new WP_Query(array('posts_per_page' => ot_get_option('sidebar_post_count'), 'paged' => $page));
  while ($sidebarQuery->have_posts()): $sidebarQuery->the_post();
  $categories = get_the_category();
  $categoryNames = array(); $categorySlugs = array();
  $hidden = true;
  foreach ($categories as $category) {
    $categoryNames[] = $category->cat_name;
    $categorySlugs[] = 'category-'.$category->slug;
    if (!in_array($category->slug, $ignoredCategories))
    {
      if ($category->slug !== 'featured')
        $hidden = false;
    }
  }


  ?>

    <?php if (has_post_format('status')): ?>
      <?php /* STATUS UPDATE */ ?>
      <div class="post" data-post-id="<?php the_ID(); ?>">
        <div class="status-update filterable <?php if ($hidden): ?>hidden<?php endif; ?> <?php echo implode(' ', $categorySlugs); ?> <?php the_field('avatar'); ?> avatar-<?php the_field('display_side'); ?>">
          <h2><?php the_content(); ?></h2>
          <img class="avatar" src="<?php echo bloginfo('template_url'); ?>/images/<?php echo str_replace('avatar-','avatar-sidebar-',get_field('avatar')); ?>.png">
        </div>
      </div>
    <?php else: ?>
      <?php /* REGULAR POST */ ?>
      <div class="post" data-post-id="<?php the_ID(); ?>">
        <a href="<?php the_permalink(); ?>">
          <div class="article filterable <?php if ($hidden): ?>hidden<?php endif; ?> <?php echo implode(' ', $categorySlugs); ?>">
            <div class="cover">
              <div><div class="random-angle-<?php echo rand(5,15); ?>"><?php the_field('post_subtitle'); ?></div></div>
            </div>
            <h3 class="category"><?php echo implode(', ', $categoryNames);?></h3>
            <h2><?php the_title(); ?></h2>
            <?php if (get_field('content_icon') !== '' && get_field('content_icon') !== 'none' && !is_null(get_field('content_icon'))): ?>
              <div class="content-icon"><i class="fa fa-<?php the_field('content_icon'); ?>"></i></div>
            <?php endif; ?>
          </div>
        </a>
      </div>
    <?php endif; ?>
  <?php endwhile; ?>
  </div>
  <div class="sidebar-nav">
    <?php if ($page < $sidebarQuery->max_num_pages): ?>
      <a class="load-more-sidebar-pages" href="/?spage=<?php echo $page+1;?>">Load More Posts</a>
      <div class="loader-container hidden"><div class="loader">Loading...</div><div class="clearfix"></div></div>
    <?php endif; ?>
  </div>
</section>
