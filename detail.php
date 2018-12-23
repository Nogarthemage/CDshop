<?php include('assets/incl/global.php'); ?>
<?php

    use CDshop\User;
    use CDshop\Product;

    spl_autoload_register(function ($class) {
        include_once("classes/". str_replace('\\', '/', $class) . ".class.php");
    });

    $product = new Product();
    $selectedProduct = $product->getProduct($_REQUEST['productid']);

    if(!$selectedProduct ){
            header('Location: index.php');
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
            <div class="medium-5 columns">
                <img src="assets/img/cds/<?php echo $selectedProduct['cover']; ?>" >
            </div>
            <div class="medium-7 columns">

                    <div class="row">
                        <div class="large-12 columns">
                           <h1><?php echo $selectedProduct['name']; ?> by  <?php echo $selectedProduct['artist']; ?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <?php echo $selectedProduct['description']; ?><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            Genre: <?php echo $selectedProduct['genre']; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            Type: <?php echo $selectedProduct['type']; ?><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            Price: € <?php echo $selectedProduct['price']; ?><br><br>
                        </div>
                    </div>

                    <div class="row product-button-wrapper">
                        <div class="large-12 columns">
                            <?php if($isUserLoggedIn){ ?>
                                <a href="#" class="button button-add-product" data-productid="<?php echo $selectedProduct['productid']; ?>"><i class="fas fa-shopping-cart"></i> Add to cart</a>
                            <?php }else{ ?>
                                 <div class="notice"><a href="login.php">Please login to purchase.</a></div>
                            <?php } ?>


                        </div>
                    </div>


            </div>
      </div>


    <script src="assets/js/vendor/jquery.js"></script>
    <script src="assets/js/vendor/foundation.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/js/form-shoppingcart-add.js"></script>
  </body>
</html>
