<?php
	session_start();

	use CDshop\User;

	header('Content-Type: application/json');
	spl_autoload_register(function ($class) {
		include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
	});

	$userid 		= isset($_REQUEST['userid'])? $_REQUEST['userid']: '';

	$json = [
		"success"=>false,
		"message"=>""
	];

	$user = new User();

	if(!empty ( $userid )) {

	    if( $user->deleteUser($userid) ){
			$json["success"] = true;
			$json["message"] = "User was removed";
		}else{
			$json["success"] = false;
			$json["message"] = "User was not removed.";
		}

	}


	echo json_encode($json);
?>
