<?php
    
use IMDterest\Post;

header('Content-Type: application/json');

    session_start();
spl_autoload_register(function ($class) {
    include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
});



//check if an update has been send
    if (!empty($_POST['postId']) && !empty($_POST['report'])) {
        $postId = $_POST['postId']; // put in Post.class.php
        $isReported = $_POST['report'];
        // echo "De post met Id " . $postId . " is gereported: " . $isReported; // response in 'inspect elements'->'response'
        // search if postId is already reported
        try {
            $post = new Post();
            $post->checkReport($postId, $isReported);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }