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
    $allProducts = $product->getProducts();


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
            <div class="large-12 columns">
                <div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
                  <div class="orbit-wrapper">
                    <div class="orbit-controls">
                      <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
                      <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
                    </div>
                    <ul class="orbit-container">
                      <li class="is-active orbit-slide">
                        <figure class="orbit-figure">
                          <img class="orbit-image" src="https://placehold.it/1200x600/999?text=Slide-1" alt="Space">
                          <figcaption class="orbit-caption">Space, the final frontier.</figcaption>
                        </figure>
                      </li>
                      <li class="orbit-slide">
                        <figure class="orbit-figure">
                          <img class="orbit-image" src="https://placehold.it/1200x600/888?text=Slide-2" alt="Space">
                          <figcaption class="orbit-caption">Lets Rocket!</figcaption>
                        </figure>
                      </li>
                      <li class="orbit-slide">
                        <figure class="orbit-figure">
                          <img class="orbit-image" src="https://placehold.it/1200x600/777?text=Slide-3" alt="Space">
                          <figcaption class="orbit-caption">Encapsulating</figcaption>
                        </figure>
                      </li>
                      <li class="orbit-slide">
                        <figure class="orbit-figure">
                          <img class="orbit-image" src="https://placehold.it/1200x600/666&text=Slide-4" alt="Space">
                          <figcaption class="orbit-caption">Outta This World</figcaption>
                        </figure>
                      </li>
                    </ul>
                  </div>
                  <nav class="orbit-bullets">
                    <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
                    <button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
                    <button data-slide="2"><span class="show-for-sr">Third slide details.</span></button>
                    <button data-slide="3"><span class="show-for-sr">Fourth slide details.</span></button>
                  </nav>
                </div>
            </div>
      </div>


      <div class="row">
            <div class="medium-2 columns">
                <div class="panel">

                    <h3>Filter</h3>

                    <strong>Type</strong>

                     <form id="filtertype">
                        <div class="row">
                            <div class="large-12 columns">
                                <input type="checkbox" id="type_album" name="album" >
                                <label for="type_album">Album</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <input type="checkbox" id="type_single" name="single" >
                                <label for="type_single">Single</label>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="medium-10 columns">

                <form id="search">
                   <div class="row">
                       <div class="large-offset-7 large-5 columns">
                           <input type="text" id="search" name="album" placeholder="Search" >
                       </div>
                   </div>

               </form>


                <ul class="productlist">
                    <?php
                    if(!empty($allProducts) > 0)
                    {
                        foreach($allProducts as $singleProduct)
                        {
                    ?>

                    <li>
                        <div class="title"><a href="detail.php?productid=<?php echo $singleProduct['productid']; ?>"><?php echo $singleProduct['name']; ?></a></div>
                        <a href="detail.php?productid=<?php echo $singleProduct['productid']; ?>"><img src="assets/img/cds/<?php echo $singleProduct['productid']; ?>.jpg" alt="<?php echo $singleProduct['name']; ?>"></a>
                        <div class="price"><?php echo $singleProduct['price']; ?> Euro</div>
                             <?php if($isUserLoggedIn){ ?>
                                 <a href="#" class="button" data-productid="<?php echo $singleProduct['productid']; ?>"><i class="fas fa-shopping-cart"></i> Add to cart</a>
                             <?php }else{ ?>
                                  <div class="notice"><a href="login.php">Please login to purchase.</a></div>
                             <?php } ?>
                    </li>

                    <?php
                        }
                    }
                    else
                    {
                        echo "No CDs found.";
                    }
                    ?>
                </ul>
            </div>
      </div>


    <script src="assets/js/vendor/jquery.js"></script>
    <script src="assets/js/vendor/foundation.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
