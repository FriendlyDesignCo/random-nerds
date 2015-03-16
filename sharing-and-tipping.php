<section id="like-it">
  <h3>Like what you read? Share.</h3>
  <p>(You know how that works.)</p>
  <p class="sharing-links">
    <a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode('http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?>" class="facebook"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a>
    <a href="#" class="twitter"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a>
    <a href="#" class="reddit"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-reddit fa-stack-1x fa-inverse"></i></span></a>
  </p>
</section>

<section id="love-it">
  <h3>Love what you read? Support <?php the_author(); ?></h3>
  <form method="POST" id="tip-form" action="<?php echo blogInfo('template_url'); ?>/tips/stripe.php">
    <input type="hidden" name="action" value="tip">
    <input type="hidden" name="article_id" value="<?php the_ID(); ?>">
    <input type="hidden" name="author" value="<?php the_author(); ?>">
    <input type="hidden" name="email">
    <input type="hidden" name="token">
    <select name="tip_value">
      <?php foreach (array(1,2,3,5,10,20,50,100,9001) as $value): ?>
        <option value="<?php echo $value*100; ?>">$<?php echo $value; ?></option>
      <?php endforeach; ?>
    </select>
    <?php global $stripeDescription; $stripeDescription = 'Tip ' . get_the_author(); ?>
    <a href="#" id="tip-button" class="button" style="color:#fff;">Support Now
      <span class="circle"><i class="fa fa-arrow-right"></i></span>
    </a>
    <div class="loader blue" style="display:none;">Loading</div>
    <div class="clearfix"></div>
    <img id="over-9000" src="<?php echo bloginfo('template_url'); ?>/images/goku-9000.gif" title="It's over 9000!" style="display:none;">
  </form>
</section>
