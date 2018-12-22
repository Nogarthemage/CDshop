<?php include('../assets/incl/global.php'); ?>
<?php
    if(!$isAdmin  ){
            header('Location: ../login.php');
    }
?><!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration | CD shop</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/foundation.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
  </head>
  <body class="admin">

    <?php include('../assets/incl/header.php'); ?>


    <div class="row">
          <div class="medium-12 columns">
                <h1>Administration</h1>
                <p>Hi <?php echo $firstname ; ?>,<br><br>Welcome to the administration area.</p>

                <ul class="cards">
                    <li>
                    <a href="products.php" class="card button">
                        <i class="fas fa-store"></i><br>Products
                    </a>
                    </li>

                    <li>
                        <a href="products.php" class="card button">
                           <i class="fas fa-users"></i><br>Users
                        </a>
                    </li>
                </ul>
          </div>
    </div>






    <script src="../assets/js/vendor/jquery.js"></script>
    <script src="../assets/js/vendor/foundation.js"></script>
    <script src="../assets/js/app.js"></script>

  </body>
</html>
