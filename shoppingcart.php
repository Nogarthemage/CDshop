<?php include('assets/incl/global.php'); ?>
<?php
    use CDshop\User;
    use CDshop\Product;

    spl_autoload_register(function ($class) {
        include_once("classes/". str_replace('\\', '/', $class) . ".class.php");
    });

    if(!$isUserLoggedIn ){
            header('Location: login.php');
    }

?><!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CD shop</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/foundation.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/stylesheet.css">
  </head>
  <body>

    <?php include('assets/incl/header.php'); ?>


    <div class="row">
          <div class="medium-12 columns">
                <h2>SHOPPINGCART</h2>
                <p>Please check your shoppingcart & fill in the details to make your purchase.</p>

                    <table class="stack">
                     <thead>
                         <tr>
                         <th>Item Name</th>
                         <th>Quantity</th>
                         <th>Price</th>
                         <th>Total</th>
                         <th></th>
                    </tr>
                    </thead>
                   <?php
                   if(isset($_COOKIE["shopping_cart"])){
                    $total = 0;
                    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                    $cart_data = json_decode($cookie_data, true);
                    foreach($cart_data as $keys => $values)
                    {
                   ?>
                    <tr>
                     <td><?php echo $values["item_name"]; ?></td>
                     <td><?php echo $values["item_quantity"]; ?></td>
                     <td>€ <?php echo $values["item_price"]; ?></td>
                     <td>€ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                     <td><a href="#" data-productid="<?php echo $values["item_id"]; ?>" class="button button-remove-product">Remove</a></td>
                    </tr>
                   <?php
                     $total = $total + ($values["item_quantity"] * $values["item_price"]);
                    }
                   ?>
                    <tr>
                     <td colspan="3" align="right">Total</td>
                     <td align="right">€ <?php echo number_format($total, 2); ?></td>
                     <td></td>
                    </tr>
                   <?php
                   }
                   else
                   {
                    echo '
                    <tr>
                     <td colspan="5" align="center">No Item in Shoppingcart (yet)</td>
                    </tr>
                    ';
                   }
                   ?>
                   </table>


                    <h2>Your Details</h2>



          </div>
    </div>


    <script src="assets/js/vendor/jquery.js"></script>
    <script src="assets/js/vendor/foundation.js"></script>
    <script src="assets/js/app.js"></script>

     <script src="assets/js/form-shoppingcart-remove.js"></script>

  </body>
</html>
