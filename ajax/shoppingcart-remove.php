<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	session_start();

	use CDshop\Shoppingcart;
	use CDshop\Product;
	header('Content-Type: application/json');
	spl_autoload_register(function ($class) {
		include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
	});

	$productid 	= isset($_REQUEST['productid'])? $_REQUEST['productid']: '';


	$json = [
		"success"=>false,
		"message"=>"Item was not removed from shoppingcart."
	];

	if($productid){

		$shoppingcart = new Shoppingcart();
		$shoppingcart->deleteItem($productid);

		$json["success"] = true;
		$json["message"] = "Item removed from shoppingcart.";
	}


	echo json_encode($json);
?>
