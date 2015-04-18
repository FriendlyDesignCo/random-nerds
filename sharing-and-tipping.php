<section id="like-it">
  <h3>Like what you read? Share it.</h3>
  <p>(That helps us.)</p>
  <p class="sharing-links">
    <a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode('http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?>" class="facebook"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a>
    <a href="#" class="twitter"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a>
    <a href="#" class="reddit"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-reddit fa-stack-1x fa-inverse"></i></span></a>
  </p>
</section>

<?php if (get_field('enable_patronizing') === true): ?>
  <section id="love-it">
    <h3>Love what you read? Patronize <?php the_author(); ?>.</h3>
    <p>That helps us <strong>and</strong> the writer.</p>
    <form method="POST" id="tip-form" action="<?php echo blogInfo('template_url'); ?>/tips/stripe.php">
      <input type="hidden" name="action" value="tip">
      <input type="hidden" name="article_id" value="<?php the_ID(); ?>">
      <input type="hidden" name="author" value="<?php the_author(); ?>">
      <input type="hidden" name="email">
      <input type="hidden" name="token">
      <input type="hidden" name="article" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>/<?php echo $_SERVER['REQUEST_URI']; ?>">
      <input type="hidden" name="tip_value" value="100">
      <div class="value-select">
        $<span class="amount">1</span>
        <i class="fa fa-caret-down"></i>
        <div class="value-options hidden">
          <ul><?php foreach (array(1,2,3,5,10,20,50,100,9001) as $value): ?><li data-value="<?php echo $value; ?>">$<?php echo $value; ?></li><?php endforeach; ?></ul>
        </div>
      </div>
      <?php global $stripeDescription; $stripeDescription = 'Tip ' . get_the_author(); ?>
      <a href="#" id="tip-button" class="button" style="color:#fff;">Support Now
        <span class="circle"><i class="fa fa-arrow-right"></i></span>
      </a>
      <p class="paypal-link"><a href="#" id="paypal-tip-button">Or use PayPal if you're a big fan of that.</a></p>
      <div class="loader-blue" style="display:none;">Loading</div>
      <div class="clearfix"></div>
      <img id="over-9000" src="<?php echo bloginfo('template_url'); ?>/images/goku-9000.gif" title="It's over 9000!" style="display:none;">
    </form>
    <form method="POST" id="paypal-tip-form" action="https://www.paypal.com/cgi-bin/webscr">
      <input type="hidden" name="cmd" value="_xclick">
      <input type="hidden" name="return" value="http://<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $_SERVER['REQUEST_URI']; ?>?donated=yes">
      <input type="hidden" name="cancel_return" value="http://<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $_SERVER['REQUEST_URI']; ?>">
      <?php require_once('extra-config.php'); ?>
      <input type="hidden" name="business" value="<?php echo PAYPAL_EMAIL_ADDRESS; ?>">
      <input type="hidden" name="lc" value="US">
      <input type="hidden" name="item_name" value="Support <?php the_author(); ?>">
      <input type="hidden" name="item_number" value="<?php the_title(); ?>">
      <input type="hidden" name="amount" value="1.00" id="paypal-amount">
      <input type="hidden" name="currency_code" value="USD">
      <input type="hidden" name="button_subtype" value="services">
      <input type="hidden" name="no_note" value="1">
      <input type="hidden" name="cn" value="Add special instructions to the seller:">
      <input type="hidden" name="no_shipping" value="1">
      <input type="hidden" name="rm" value="1">
      <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
    </form>
    <p>What is Patronizing? <a href="/patronizing/" target="_blank">Learn more here.</a></p>
  </section>
<?php endif; ?>
