<?php include('assets/incl/global.php'); ?>
<?php

    use CDshop\User;
    use CDshop\Product;

    spl_autoload_register(function ($class) {
        include_once("classes/". str_replace('\\', '/', $class) . ".class.php");
    });

    $product = new Product();
    $allProducts = $product->getProducts();
    $banners = $product->getProductBanners();

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
            <div class="large-12 columns">
                <div class="banners orbit" role="region" aria-label="" data-orbit>
                  <div class="orbit-wrapper">
                    <div class="orbit-controls">
                      <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
                      <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
                    </div>
                    <ul class="orbit-container">
                      <?php
                      if(!empty($banners) > 0)
                      {
                          foreach($banners as $banner)
                          {
                       ?>

                      <li class="is-active orbit-slide">
                        <a href="detail.php?productid=<?php echo $banner['productid']; ?>">
                        <figure class="orbit-figure">
                          <img class="orbit-image" src="assets/img/cds/<?php echo $banner['banner']; ?>" alt="<?php echo $banner['name']; ?>">
                        </figure>
                        </a>
                      </li>

                      <?php
                          }
                      } ?>

                    </ul>
                  </div>

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
                                 <a href="#" class="button button-add-product" data-productid="<?php echo $singleProduct['productid']; ?>"><i class="fas fa-shopping-cart"></i> Add to cart</a>
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

    <script src="assets/js/form-shoppingcart-add.js"></script>
  </body>
</html>
