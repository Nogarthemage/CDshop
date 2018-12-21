<?php
	session_start();

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	use CDshop\Product;

	header('Content-Type: application/json');
	spl_autoload_register(function ($class) {
		include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
	});

	$productid 		= isset($_REQUEST['productid'])? $_REQUEST['productid']: '';

	$json = [
		"success"=>false,
		"message"=>""
	];

	$product = new Product();

	if(!empty ( $productid )) {

	    if( $product->deleteProduct($productid) ){
			$json["success"] = true;
			$json["message"] = "Product was removed";
		}else{
			$json["success"] = false;
			$json["message"] = "Product was not removed.";
		}

	}


	echo json_encode($json);
?>
