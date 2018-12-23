<?php
	session_start();

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
