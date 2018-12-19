<?php

use IMDterest\Post;

header('Content-Type: application/json');

    session_start();

spl_autoload_register(function ($class) {
    include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
});

    //check if an update has been send
    if (!empty($_POST['postId']) && !empty($_POST['like'])) {
        $postId = $_POST['postId'];
        $isLiked = $_POST['like'];

        try {
            $post = new Post();
            $post->checkLike($postId, $isLiked);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
