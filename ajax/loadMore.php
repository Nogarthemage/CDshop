<?php

    header('Content-Type: application/json');

    session_start();

spl_autoload_register(function ($class) {
    include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
});



if (!empty($_POST['maxID']) && !empty($_POST['length'])) {
        $maxID = intval($_POST['maxID']);
        $length = intval($_POST['length']);
    }

    if ($maxID<=$length) {
        $feedback = [
            "code"=>200
        ];
    } else {
        $feedback = [
            "code"=>500
        ];
    }
    echo json_encode($feedback);

?>