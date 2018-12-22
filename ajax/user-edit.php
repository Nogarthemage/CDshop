<?php
	session_start();

	use CDshop\User;

	header('Content-Type: application/json');
	spl_autoload_register(function ($class) {
		include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
	});

	$userid 		= isset($_REQUEST['userid'])? $_REQUEST['userid']: '';
	$firstname 		= isset($_REQUEST['firstname'])? $_REQUEST['firstname']: '';
	$lastname 		= isset($_REQUEST['lastname'])? $_REQUEST['lastname']: '';
	$email 			= isset($_REQUEST['email'])? $_REQUEST['email']: '';
	$password 		= isset($_REQUEST['password'])? $_REQUEST['password']: '';
	$level 			= isset($_REQUEST['level'])? $_REQUEST['level']: '';


	$json = [
		"success"=>false,
		"message"=>""
	];

	if(!empty ( $userid )) {

		$user = new User();
		$user->setFirstname($firstname);
		$user->setLastname($lastname);
		$user->setEmail($email);
		$user->setLevel($level);
		if (!empty($password)) {
	   		 $user->setPassword($password);
	   	 }

	    if( $user->updateUserByID($userid) ){
			$json["success"] = true;
			$json["message"] = "User updated";
		}else{
			$json["success"] = false;
			$json["message"] = "User not added (Please make sure the e-mail doesn't already exist.)";
		}

	}


	echo json_encode($json);
?>
