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

                     <form id="form-filter">
                        <div class="row">
                            <div class="large-12 columns">
                                <input type="checkbox" id="type_album" name="param_filter_album" value="1" checked>
                                <label for="type_album">Album</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <input type="checkbox" id="type_single" name="param_filter_single" value="1" checked>
                                <label for="type_single">Single</label>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="medium-10 columns">

                <div class="row">
                       <div class="large-6 columns">
                           <form id="form-sort"  method="post">
                               sort by:
                               <input type="radio" id="sort_name" name="param_sort" value="name" ><label for="sort_name">Name</label>
                               <input type="radio" id="sort_price" name="param_sort" value="price" checked ><label for="sort_price">Price</label>
                           </form>
                       </div>
                       <div class="large-6 columns">
                           <form id="form-search"  method="post">
                             <input type="text" name="param_search" placeholder="Search & Enter" >
                           </form>
                       </div>
                </div>




                <ul id="productlist" class="productlist product-button-wrapper">
                    <?php
                    if(!empty($allProducts) > 0)
                    {
                        foreach($allProducts as $singleProduct)
                        {
                    ?>

                    <li>
                        <div class="title"><a href="detail.php?productid=<?php echo $singleProduct['productid']; ?>"><?php echo $singleProduct['name']; ?></a></div>
                        <a href="detail.php?productid=<?php echo $singleProduct['productid']; ?>"><img src="assets/img/cds/<?php echo $singleProduct['cover']; ?>" alt="<?php echo $singleProduct['name']; ?>"></a>
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

      <script id="list-products-filtered" type="text/x-handlebars-template">
          {{#each this.products}}
          <li>
              <div class="title"><a href="detail.php?productid={{productid}}">{{this.name}}</a></div>
              <a href="detail.php?productid={{this.productid}}"><img src="assets/img/cds/{{this.cover}}" alt="{{this.name}}" title="{{this.name}} ({{this.type}})"></a>
              <div class="price">{{this.price}} Euro</div>
              <?php if($isUserLoggedIn){ ?>
              <a href="#" class="button button-add-product" data-productid="{{this.productid}}"><i class="fas fa-shopping-cart"></i> Add to cart</a>
                <?php }else{ ?>
               <div class="notice"><a href="login.php">Please login to purchase.</a></div>
          <?php } ?>
          </li>
          {{/each}}
      </script>





    <script src="assets/js/vendor/jquery.js"></script>
    <script src="assets/js/vendor/foundation.js"></script>
    <script src="assets/js/vendor/handlebars-v4.0.12.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/js/form-products-filter.js"></script>
    <script src="assets/js/form-shoppingcart-add.js"></script>

  </body>
</html>
