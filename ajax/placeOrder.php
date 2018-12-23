<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	session_start();

	use CDshop\Shoppingcart;
	use CDshop\Product;
	use CDshop\Order;
	header('Content-Type: application/json');
	spl_autoload_register(function ($class) {
		include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
	});

	$json = [
		"success"=>false,
		"message"=>"Order was not placed."
	];

	$userid  			= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
	$shippingfirstname 	= isset($_REQUEST['shippingfirstname'])? $_REQUEST['shippingfirstname']: '';
	$shippinglastname 	= isset($_REQUEST['shippinglastname'])? $_REQUEST['shippinglastname']: '';
	$shippingaddress 	= isset($_REQUEST['shippingaddress'])? $_REQUEST['shippingaddress']: '';
	$paymenttype 		= isset($_REQUEST['paymenttype'])? $_REQUEST['paymenttype']: '';

	if($userid){

		$order = new Order();
		$order->setUserid($userid);
		$order->setShippingfirstname($shippingfirstname);
		$order->setShippinglastname($shippinglastname);
		$order->setShippingaddress($shippingaddress);
		$order->setPaymenttype($paymenttype);

		//technically you should retrieve the price from the database and not from the cookie...

			$orderid = $order->placeOrder(); //RETRIEVE THIS

			if(isset($_COOKIE["shopping_cart"])){
				$total = 0;
				$cookie_data = stripslashes($_COOKIE['shopping_cart']);
				$cart_data = json_decode($cookie_data, true);
				foreach($cart_data as $keys => $values)
				{
					$item_id 		= $values["item_id"];
					$item_price 	= $values["item_price"]; // replace by call to retrieve price from db?
					$item_quantity 	= $values["item_quantity"];
					$total 			= $total + ($values["item_quantity"] * $values["item_price"]);

					$order->addOrderDetail($orderid, $item_id, $item_quantity);
			   }

			   if($order->updateOrder($orderid, $total)){

				   $shoppingcart = new Shoppingcart();
		   		   $shoppingcart->clearShoppingcart();

				   $json = [
		   				"success"=>true,
		   				"message"=>"Order was placed."
		   			];
			   }
			}



	}


	echo json_encode($json);
?>
