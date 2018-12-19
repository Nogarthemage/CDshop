<?php

use IMDterest\Db;
spl_autoload_register(function ($class) {
    include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
});


header('Content-Type: application/json');

    if (!empty($_POST)) {
        $search = $_POST["search"];

        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT * FROM posts WHERE description LIKE '%$search%'");
        $statement->execute();
        $amount = $statement->rowCount();

        echo "Amount of posts found: ".$amount;

        // change index.php
    }
