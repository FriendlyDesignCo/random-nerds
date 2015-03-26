<?php get_header(); ?>

<?php include('page-header.php'); ?>
<div class="page-content-box">
  <article>
    <div class="giphy">
    </div>
    <p>We know, this isn’t the page you were hoping to see. Most pages say “we can’t find that page” but who exactly is the “we”, anyway? Is it supposed to be the gremlins in your computer?</p>
    <p>Okay, we got off topic there. See? I did it again. “We.” UGH.</p>
    <p>OKAY. So, real talk. This is our catch-all error page. Either the link you followed doesn’t exist anymore, or maybe there was some kind of typo. We’re not blaming you, it’s not your fault. You’re just trying to read something.</p>
    <p>How about reading one of these articles below? They’re pretty great. Or, just head back to the front page.</p>
    <hr class="divider">
    <div class="random-articles">
      <?php
        $args = array( 'posts_per_page' => 2, 'orderby' => 'rand' );
        $rand_posts = get_posts( $args );
        foreach ( $rand_posts as $post ) :
          setup_postdata( $post ); ?>
          <div class="randomarticle">
        	   <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
             <?php the_excerpt(); ?>
           </div>
      <?php endforeach; wp_reset_postdata(); ?>
      <div class="clearfix"></div>
    </div>
  </article>
</div>

<?php get_footer(); ?>
