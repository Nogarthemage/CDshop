<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	session_start();

	use CDshop\Product;

	header('Content-Type: application/json');
	spl_autoload_register(function ($class) {
		include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
	});

	$param_search 	= isset($_REQUEST['param_search'])? $_REQUEST['param_search'] : '';
	$param_sort 	= isset($_REQUEST['param_sort'])? $_REQUEST['param_sort']: 'price';
	$isUserLoggedIn = isset($_SESSION['user_id']) ? true : false;

	$filter_album = isset($_REQUEST['param_filter_album']) ? true : false;
	$filter_single = isset($_REQUEST['param_filter_single']) ? true : false;

	$product = new Product();
	$products = $product->searchProducts($param_search, $param_sort, $filter_album, $filter_single);

	$results = array("products" => $products);

	echo json_encode($results);
?>
