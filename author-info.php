<?php $authorID = get_the_author_meta('ID'); ?>
<div class="divider-row"><hr class="divider compact-bottom"></div>

<div class="author-info">
  <a class="author-image-link" href="<?php echo get_author_posts_url($authorID); ?>"><div class="author-image" style="background-image:url('<?php the_field('profile_picture', 'user_'.$authorID); ?>')"></div></a>
  <div class="author-details">
    <h4><a href="<?php echo get_author_posts_url($authorID); ?>"><?php the_author(); ?></a> <?php if (strlen($twitter = get_field('twitter_username', 'user_'.$authorID)) > 0): ?>(<a href="https://www.twitter.com/<?php echo $twitter; ?>">@<?php echo $twitter; ?></a>)<?php endif; ?></h4>
    <p class="bio"><?php the_author_meta('description'); ?></p>
    <h5>Articles by <?php the_author(); ?></h5>

    <?php /* Recent Articles by Author */ ?>
    <?php $authorQuery = new WP_Query(array(
      'post__not_in'   => array(get_the_ID()),
      'posts_per_page' => 3,
      'post_type'      => 'post',
      'author'         => $authorID,
      'orderby'        => 'rand',
      'tax_query'      => array(array(
        'taxonomy' => 'post_format',
        'field'    => 'slug',
        'terms'    => array('post-format-status'),
        'operator' => 'NOT IN'
      ))
    ));
    if ($authorQuery->have_posts()): ?>
      <ul class="author-articles">
        <?php while ($authorQuery->have_posts()): $authorQuery->the_post(); ?>
          <li><a href="<?php the_permalink(); ?>" class="primary-<?php the_field('primary_category'); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>
  </div>
  <div class="clearfix"></div>

  <div class="divider-row"><hr class="divider compact-top"></div>

  <div id="related-posts">
    <?php
    ob_start(); if ( function_exists( "get_yuzo_related_posts" ) ) { get_yuzo_related_posts(); }
    $related = ob_get_contents();
    ob_end_clean();
    preg_match_all('/href="http:\/\/.*?\/(.*?)\/"/', $related, $matches);
    for ($i = 0; $i < count($matches[1]); $i++)
    {
      if (($post = get_page_by_path($matches[1][$i], ARRAY_A, 'post')) !== null)
      {
        $related = str_replace($matches[1][$i].'/"', $matches[1][$i] . '/" data-post-id="' . $post['ID'] . '" data-primary-category="' . get_field('primary_category', $post['ID']) . '"', $related);
      }
    }
    echo strip_tags(
      preg_replace('/style=".*?"/','',
        preg_replace('/<style>.*?<\/style>/ims','',$related))
    ,'<p><div><a><span><h5>');
    ?>
    <div class="clearfix"></div>
  </div>
</div>
