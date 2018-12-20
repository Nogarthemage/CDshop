<?php
	session_start();

	use CDshop\User;

	header('Content-Type: application/json');
	spl_autoload_register(function ($class) {
		include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
	});

	$firstname 		= isset($_REQUEST['firstname'])? $_REQUEST['firstname']: '';
	$lastname 		= isset($_REQUEST['lastname'])? $_REQUEST['lastname']: '';
	$email 			= isset($_REQUEST['email'])? $_REQUEST['email']: '';
	$password 		= isset($_REQUEST['password'])? $_REQUEST['password']: '';

	$json = [
		"success"=>false,
		"error"=>""
	];

	if(!empty ( $email )) {

		$user = new User();
		$user->setFirstname($firstname);
		$user->setLastname($lastname);
		$user->setEmail($email);
		$user->setPassword($password);
		$user->setLevel('member');

	    if( $user->register() ){
			$json["success"] = true;
			$json["error"] = "User registered";
		}else{
			$json["success"] = false;
			$json["error"] = "User not registered";
		}

	}


	echo json_encode($json);
?>
