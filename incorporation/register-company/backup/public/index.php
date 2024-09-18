<?php
require_once '../../../db.php';
require_once '../../../baseUrl.php';
require_once '../../../session.php';
$logged_user_id = $_SESSION['user_id'];
$YOUR_DOMAIN = $baseUrl . 'incorporation/register-company/backup/public';
?>

<html>
  <head>../
    <title>Buy cool new product</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <section>
      <div class="product">
        <img src="https://i.imgur.com/EHyR2nP.png" alt="The cover of Stubborn Attachments" />
        <div class="description">
          <h3>Stubborn Attachments</h3>
          <h5>$20.00</h5>
        </div>
      </div>
      <form action="<?php echo $YOUR_DOMAIN;?>/checkout.php" method="POST">
        <button type="submit" id="checkout-button">Checkout</button>
      </form>
    </section>
  </body>
</html>