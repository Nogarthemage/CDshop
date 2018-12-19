<?php

use IMDterest\User;

header('Content-Type: application/json');
spl_autoload_register(function ($class) {
    include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
});


$json = [
    "success"=>true,
    "error"=>""
];

$user = new User();
if(!empty ($_GET["email"])) {
    $user = new User();
    $user->setEmail($_GET["email"]);

    //email is valid
    if(!filter_var($_GET["email"], FILTER_VALIDATE_EMAIL) === false) {
        $json["error"] = "is a valid email address";
        if($user->emailCheck()) {
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
echo json_encode($json);

?>