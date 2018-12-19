<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    use CDshop\User;
    use CDshop\Product;

    session_start();

    spl_autoload_register(function ($class) {
        include_once("classes/". str_replace('\\', '/', $class) . ".class.php");
    });

    $product = new Product();
    $selectedProduct = $product->getProduct($_REQUEST['productid']);

    //is the user logged in, then ID will be set!
    $isUserLoggedIn  = isset($_SESSION['id']) ? true : false;
    $firstname       = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : '';
    $level           = isset($_SESSION['level']) ? $_SESSION['level'] : '';
    $isAdmin         = ( isset($_SESSION['level']) && $_SESSION['level'] == 'admin' ) ? true : false;

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

      <?php if($isAdmin){ ?>
      <div class="bar">
           <div class="callout primary">
          <div class="row">
                <div class="medium-12 columns">
                          This is an admin bar
                </div>
          </div>
           </div>
      </div>
      <?php } ?>


      <?php if($isUserLoggedIn){ ?>
          <div class="bar">
              <div class="row">
                    <div class="medium-6 columns">
                        <ul class="menu">
                           <li><a href="/">CDSHOP</a></li>
                         </ul>
                    </div>
                    <div class="medium-6 columns text-right">
                        <ul class="menu">
                           <li><a href="logout.php">Logout</a></li>
                           <li><a href="order.php"><i class="fas fa-shopping-cart"></i> Shoppingcart</a></li>
                         </ul>
                    </div>
              </div>
          </div>

          <div class="row">
                 <div class="large-12 columns">
                        <div class="callout primary">
                               Welcome to the webshop <?php echo $firstname ?>!!
                        </div>
                 </div>
          </div>

    <?php }else{ ?>
        <div class="bar">
            <div class="row">
                  <div class="medium-6 columns">
                      <ul class="menu">
                         <li><a href="/">CDSHOP</a></li>
                       </ul>
                  </div>
                  <div class="medium-6 columns text-right">
                      <ul class="menu">
                         <li><a href="login.php">Login</a></li>
                         <li><a href="register.php">Register</a></li>
                         <li><a href="login.php"><i class="fas fa-shopping-cart"></i> Shoppingcart</a></li>
                       </ul>
                  </div>
            </div>
        </div>
    <?php } ?>






      <div class="row">
            <div class="medium-5 columns">
                <img src="assets/img/cds/<?php echo $selectedProduct['productid']; ?>.jpg" >
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

                    <div class="row">
                        <div class="large-12 columns">
                            <?php if($isUserLoggedIn){ ?>
                                <a href="#" class="button" data-productid="<?php echo $singleProduct['productid']; ?>"><i class="fas fa-shopping-cart"></i> Add to cart</a>
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
  </body>
</html>
