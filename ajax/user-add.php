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
	$level 			= isset($_REQUEST['level'])? $_REQUEST['level']: '';
	$password 		= isset($_REQUEST['password'])? $_REQUEST['password']: '';

	$json = [
		"success"=>false,
		"message"=>""
	];

	if(!empty ( $email )) {

		$user = new User();
		$user->setFirstname($firstname);
		$user->setLastname($lastname);
		$user->setEmail($email);
		$user->setLevel($level);
		$user->setPassword($password);

	    if( $user->register() ){
			$json["success"] = true;
			$json["message"] = "User added";
		}else{
			$json["success"] = false;
			$json["message"] = "User not added.";
		}

	}


	echo json_encode($json);
?>
