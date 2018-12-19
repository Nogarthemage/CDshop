<?php

use IMDterest\User;

session_start();

header('Content-Type: application/json');
spl_autoload_register(function ($class) {
    spl_autoload_register(function ($class) {
        include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
    });


    $json = [
    "success"=>true,
    "error"=>""
];

$user = new User();
if(!empty ($_POST["email"])) {
    $user = new User();
    $user->setEmail($_GET["email"]);

        //email is valid
        if(!filter_var($_GET["email"], FILTER_VALIDATE_EMAIL) === false) {
            $json["error"] = "is a valid email address";
            if($user->emailCheck())
            {
                $json["success"] = true;
                $json["error"] = "email can be used";
            }else {
                $json["error"] = "Email already in use";
                $json["success"] = false;
            }
        }else {
            $json["error"] = "is not a valid email address";
            $json["success"] = false;
        };

}else {
    $json["success"] = false;
    $json["error"] = "Email cannot be empty";

}
$json["currentemail"] = $_SESSION["email"];
echo json_encode($json);

?>