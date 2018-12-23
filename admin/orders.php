<?php include('../assets/incl/global.php'); ?>
<?php
    use CDshop\Order;

    spl_autoload_register(function ($class) {
        include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
    });

    if(!$isAdmin){
            header('Location: ../login.php');
    }

    $order = new Order();
    $orders = $order->getOrders();
?><!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders | CD shop</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/foundation.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
  </head>
  <body class="admin">

    <?php include('../assets/incl/header.php'); ?>

    <div class="row">
          <div class="medium-12 columns">
                <h1>Order overview</h1>

                <div class="row">
                    <div class="large-12 columns">
                                <div class="callout alert" style="display:none;">

                                </div>
                    </div>
                </div>

                <table>
                      <thead>
                        <tr>
                          <th>Order Number</th>
                          <th>Order Date</th>
                          <th>Client</th>
                          <th>TotalPrice</th>
                          <th>Paid with</th>
                        </tr>
                      </thead>
                      <tbody>

                          <?php
                          if(!empty($orders) > 0)
                          {
                              foreach($orders as $order)
                              {
                          ?>

                              <tr>
                                <td><?php echo $order['orderid']; ?></td>
                                <td><?php echo $order['orderdate']; ?></td>
                                <td><?php echo $order['shippingfirstname'] . '  ' . $order['shippinglastname']; ?></td>
                                <td>€ <?php echo $order['totalprice']; ?></td>
                                <td><?php echo $order['paymenttype']; ?></td>

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

  </body>
</html>
