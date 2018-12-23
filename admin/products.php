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
    <title>Administration - products | CD shop</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/foundation.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
  </head>
  <body class="admin">

    <?php include('../assets/incl/header.php'); ?>


    <div class="row">
          <div class="medium-12 columns">
                <h1>Product Administration</h1>
                <a href="products-add.php" class="button add"><i class="fas fa-plus-square"></i> Add Product</a>

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
                                <a class="button" href="products-edit.php?productid=<?php echo $product['productid']; ?>"><i class="far fa-edit"></i> Edit</a>
                                <a class="button button-remove" data-productid="<?php echo $product['productid']; ?>" href="#"><i class="far fa-trash-alt"></i> Remove</a>
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
