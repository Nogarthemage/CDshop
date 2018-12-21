<?php include('../assets/incl/global.php'); ?>
<?php
    use CDshop\Product;

    spl_autoload_register(function ($class) {
        include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
    });

    if(!$isAdmin){
            header('Location: ../login.php');
    }

    $product = new Product();
    $products = $product->getProducts();

?><!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CD shop</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/foundation.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
  </head>
  <body>

    <?php include('../assets/incl/header-admin.php'); ?>


    <div class="row">
          <div class="medium-12 columns">
                <h1>Product Administration</h1>
<a href="product-add.php" class="button"><i class="fas fa-plus-square"></i> Add Product</a>

<div class="row">
    <div class="large-12 columns">
                <div class="callout alert" style="display:none;">

                </div>
    </div>
</div>

                <table>
                  <thead>
                    <tr>
                      <th width="">Name</th>
                      <th width="">Artist</th>
                      <th width=""></th>
                    </tr>
                  </thead>
                  <tbody>

                      <?php
                      if(!empty($products) > 0)
                      {
                          foreach($products as $product)
                          {
                      ?>

                          <tr>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['artist']; ?></td>
                            <td class="text-right">
                                <form class="form-edit-product">
                                      <input type="hidden" name="productid" value="<?php echo $product['productid']; ?>" >
                                      <input type="submit" value="Edit" class="button" />
                                </form>

                                <form class="form-remove-product">
                                      <input type="hidden" name="productid" value="<?php echo $product['productid']; ?>" >
                                      <input type="submit" value="Remove" class="button" >
                                </form>
                            </td>
                          </tr>

                      <?php
                          }
                      }
                      ?>




                  </tbody>
                </table>
          </div>
    </div>





    <script src="../assets/js/vendor/jquery.js"></script>
    <script src="../assets/js/vendor/foundation.js"></script>
    <script src="../assets/js/app.js"></script>

    <script src="../assets/js/form-product-remove.js"></script>
  </body>
</html>
