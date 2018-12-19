<?php

use IMDterest\Comment;

header('Content-Type: application/json');
spl_autoload_register(function ($class) {
    include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
});



$comment = new Comment();

//check if an update is send
if(!empty($_POST['comment'])) {
    $comment->Text = $_POST['comment'];
    try {
        $comment->save();
        $feedback = [
            "code" => 200,
            "comment" => htmlspecialchars($_POST['comment'])
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