<?php include('../assets/incl/global.php'); ?>
<?php

use CDshop\Product;

    spl_autoload_register(function ($class) {
        include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
    });

    if(!$isAdmin){
            header('Location: ../login.php');
    }

    $productid = isset($_REQUEST['productid']) ? $_REQUEST['productid'] : '';

    $product = new Product();
    $selectedProduct = $product->getProduct($productid);

?><!doctype html>



<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product | CD shop</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/foundation.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/foundation-datepicker.min.css">
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
  </head>
  <body class="admin">

    <?php include('../assets/incl/header.php'); ?>


    <div class="row">
          <div class="medium-12 columns">
                <h1>Edit Product</h1>

                <div class="row">
                    <div class="large-12 columns">
                        <div class="callout alert" style="display:none;"> </div>
                    </div>
                </div>

                <div class="row">

                      <div class="medium-6 columns ">
                          <div class="callout">

                              <form id="form-edit-product" action="" method="post">
                                  <div class="row">
                                        <div class="large-4 columns">
                                            <label>Artist</label>
                                        </div>
                                        <div class="large-8 columns">
                                            <input type="text" name="artist" value="<?php echo $selectedProduct['artist']; ?>" >
                                        </div>
                                  </div>
                                  <div class="row">
                                        <div class="large-4 columns">
                                            <label>Name</label>
                                        </div>
                                        <div class="large-8 columns">
                                            <input type="text" name="name" value="<?php echo $selectedProduct['name']; ?>" >
                                        </div>
                                  </div>
                                  <div class="row">
                                        <div class="large-4 columns">
                                            <label>Description</label>
                                        </div>
                                        <div class="large-8 columns">
                                            <textarea name="description"><?php echo $selectedProduct['description']; ?></textarea>
                                        </div>
                                  </div>
                                  <div class="row">
                                        <div class="large-4 columns">
                                            <label>Cover</label>
                                        </div>
                                        <div class="large-8 columns">
                                            <input type="text" name="cover" value="<?php echo $selectedProduct['cover']; ?>">
                                        </div>
                                  </div>
                                  <div class="row">
                                        <div class="large-4 columns">
                                            <label>Banner</label>
                                        </div>
                                        <div class="large-8 columns">
                                            <input type="text" name="banner" value="<?php echo $selectedProduct['banner']; ?>">
                                        </div>
                                  </div>
                                  <div class="row">
                                        <div class="large-4 columns">
                                            <label>Genre</label>
                                        </div>
                                        <div class="large-8 columns">
                                            <input type="text" name="genre" value="<?php echo $selectedProduct['genre']; ?>">
                                        </div>
                                  </div>
                                  <div class="row">
                                        <div class="large-4 columns">
                                            <label>Type</label>
                                        </div>
                                        <div class="large-8 columns">
                                            <select name="type">
                                              <option value="album" <?php if(strtolower($selectedProduct['type']) == 'album'){ echo 'selected'; } ?>>album</option>
                                              <option value="single" <?php if(strtolower($selectedProduct['type']) == 'single'){ echo 'selected'; } ?>>single</option>
                                            </select>

                                        </div>
                                  </div>

                                  <div class="row">
                                        <div class="large-4 columns">
                                            <label>Releasedate</label>
                                        </div>
                                        <div class="large-8 columns">
                                            <input id="dp1-product-edit" type="text" name="releasedate" value="<?php echo $selectedProduct['releasedate']; ?>">
                                        </div>
                                  </div>

                                  <div class="row">
                                        <div class="large-4 columns">
                                            <label>Price</label>
                                        </div>
                                        <div class="large-8 columns">
                                            <input type="number" name="price" value="<?php echo $selectedProduct['price']; ?>">
                                        </div>
                                  </div>

                                  <div class="row">
                                        <div class="large-4 columns">

                                        </div>
                                        <div class="large-8 columns">
                                             <input type="hidden" name="productid" value="<?php echo $selectedProduct['productid']; ?>">
                                            <input type="submit" value="Update product" class="button">
                                        </div>
                                  </div>

                              </form>

                          </div>

                      </div>
                </div>
          </div>
    </div>


    <script src="../assets/js/vendor/jquery.js"></script>
    <script src="../assets/js/vendor/foundation.js"></script>
    <script src="../assets/js/vendor/foundation-datepicker.js"></script>
    <script src="../assets/js/app.js"></script>

    <script src="../assets/js/form-product-edit.js"></script>

    <script>
    <!--

    $('#dp1-product-edit').fdatepicker({
        format: 'yyyy-mm-dd',
        disableDblClickSelection: true,
        leftArrow:'<<',
        rightArrow:'>>',
        closeIcon:'X',
        closeButton: true
    });

    -->
    </script>

  </body>
</html>
