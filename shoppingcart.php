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
                <h1>SHOPPINGCART</h1>
                <p>Please check your shoppingcart & fill in the details to make your purchase.</p>


                <table class="stack">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Quantity</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Lorem Ipsum</td>
                          <td>1</td>
                          <td><a href="#" class="button">Remove Product</a></td>
                        </tr>
                        <tr>
                          <td>Lorem Ipsum</td>
                          <td>1</td>
                          <td><a href="#" class="button">Remove Product</a></td>
                        </tr>
                        <tr>
                          <td>Lorem Ipsum</td>
                          <td>1</td>
                          <td><a href="#" class="button">Remove Product</a></td>
                        </tr>
                      </tbody>
                    </table>
          </div>
    </div>





    <script src="assets/js/vendor/jquery.js"></script>
    <script src="assets/js/vendor/foundation.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
