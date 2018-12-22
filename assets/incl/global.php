<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

//is the user logged in, then ID will be set!
$isUserLoggedIn = isset($_SESSION['user_id']) ? true : false;
$userid  		= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$firstname  	= isset($_SESSION['user_firstname']) ? $_SESSION['user_firstname'] : '';
$lastname   	= isset($_SESSION['user_lastname']) ? $_SESSION['user_lastname'] : '';
$email      	= isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';

$level          = isset($_SESSION['user_level']) ? $_SESSION['user_level'] : '';
$isAdmin        = (isset($_SESSION['user_level']) && $_SESSION['user_level'] == 'admin' ) ? true : false;

//global variables
$siteRoot		= "http://localhost:8888/private/CDshop";

?>
