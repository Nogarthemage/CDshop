<?php
	session_start();

	use CDshop\Product;

	header('Content-Type: application/json');
	spl_autoload_register(function ($class) {
		include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
	});

	$artist 	= isset($_REQUEST['artist'])? $_REQUEST['artist']: '';
	$name 		= isset($_REQUEST['name'])? $_REQUEST['name']: '';
	$description = isset($_REQUEST['description'])? $_REQUEST['description']: '';
	$cover 		= isset($_REQUEST['cover'])? $_REQUEST['cover']: '';
	$banner 	= isset($_REQUEST['banner'])? $_REQUEST['banner']: '';
	$genre 		= isset($_REQUEST['genre'])? $_REQUEST['genre']: '';
	$type 		= isset($_REQUEST['type'])? $_REQUEST['type']: '';
	$releasedate = isset($_REQUEST['releasedate'])? $_REQUEST['releasedate']: '';
	$price 		= isset($_REQUEST['price'])? $_REQUEST['price']: '';


	$json = [
		"success"=>false,
		"message"=>""
	];


	$product = new Product();
	$product->setArtist($artist);
	$product->setName($name);
	$product->setDescription($description);
	$product->setCover($cover);
	$product->setBanner($banner);
	$product->setGenre($genre);
	$product->setType($type);
	$product->setReleasedate($releasedate);
	$product->setPrice($price);


    if( $product->addProduct() ){
		$json["success"] = true;
		$json["message"] = "Product added.";
	}else{
		$json["success"] = false;
		$json["message"] = "Product not added.";
	}

	echo json_encode($json);
?>
