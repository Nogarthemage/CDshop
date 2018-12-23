<?php
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
		"message"=>"Item was not added to shoppingcart."
	];

	if($productid){
		//retrieve product info (correct price)
		$product = new Product();
		$selectedProduct 	= $product->getProduct($productid);
		$productname 		= $selectedProduct['name'];
		$productartist 		= $selectedProduct['artist'];
		$productprice 		= $selectedProduct['price'];
		$productquantity 	= 1;

		$product_item_name = $productname . ' by ' . $productartist;

		$shoppingcart = new Shoppingcart();
		$shoppingcart->addToShoppingcart($productid, $product_item_name, $productprice, $productquantity);

		$json["success"] = true;
		$json["message"] = "1 item added to shoppingcart";
	}


	echo json_encode($json);
?>
