<?php

use IMDterest\User;

session_start();
// HERE COMES JSON!!!
header('Content-Type: application/json');
spl_autoload_register(function ($class) {
    include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
});


$user = new User();

//check if an update is send
if(!empty($_POST['follow'])) {

    $follow = $_POST['follow'];
    $followerId = $_SESSION['profileId'];

    try {
        $user->follow($followerId, $follow);
        $feedback = [
            "code" => 200,
            "follow" => "true"
        ];


    } catch (Exception $e) {
        $error = $e->getMessage();
        $feedback = [
            "code" => 500,
            "comment" => $error

        ];

    }
    echo json_encode($feedback);
}


?>