<?php
use CDshop\User;

session_start();

header('Content-Type: application/json');

    spl_autoload_register(function ($class) {
        include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
    });

    $json = [
    "success"=>false,
    "error"=>""
    ];

    $email 			= isset($_REQUEST['email'])? $_REQUEST['email']: '';

   if(!empty ( $email )) {
       $user = new User();
       $user->setEmail($email);

           //email is valid
           if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
               $json["error"] = "is a valid email address";
               if($user->emailCheck())
               {
                   $json["success"] = true;
                   $json["error"] = "email can be used";
               }else {
                   $json["success"] = false;
                   $json["error"] = "Email already in use";
               }
           }else {
               $json["error"] = "is not a valid email address";
               $json["success"] = false;
           };

   }else {
       $json["success"] = false;
       $json["error"] = "E-mail cannot be empty.";

   }

   echo json_encode($json);

?>
