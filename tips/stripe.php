<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../extra-config.php';

\Stripe\Stripe::setApiKey(STRIPE_PRIVATE_KEY);
try
{
  \Stripe\Charge::create(array(
    'amount'   => $_POST['tip_value'],
    'currency' => 'USD',
    'source'   => $_POST['token'],
    'description' => 'Tip for ' . $_POST['author'],
    'metadata' => array(
      'article' => $_POST['article']
    ),
    'receipt_email' => $_POST['email']
  ));
}
catch (\Stripe\Error\Card $e)
{
  header("HTTP/1.1 500 Exception");
  ?>
  <p class="error">Sorry, your card was declined - please try again.</p>
  <?php
  exit();
}
?>
<h3>Thanks! Want an email when there's new articles like this one?</h3>
<a class="button" style="color:#fff;margin-top:20px;" data-email="<?php echo $_POST['email']; ?>" id="one-click-subscribe">Yup <span class="circle"><i class="fa fa-thumbs-up"></i></span></a>
