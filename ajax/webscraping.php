<?php

    header('Content-Type: application/json');

spl_autoload_register(function ($class) {
    include_once("classes/". str_replace('\\', '/', $class) . ".class.php");
});

    if( substr($_POST['url'], 0, 7) != 'http://' ) {
        $url = 'http://' . $_POST['url'];
    } else {
        $url = $_POST['url'];
    }

    $html = file_get_contents($url);

    //parsing begins here:
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $nodes = $doc->getElementsByTagName('title');

    $metas = $doc->getElementsByTagName('meta');

    for ($i = 0; $i < $metas->length; $i++) {
        $meta = $metas->item($i);
        if($meta->getAttribute('property') == 'og:description') {
            $feedback['description'] = $meta->getAttribute('content');
        }elseif($meta->getAttribute('name') == 'description') {
            $feedback['description'] = $meta->getAttribute('content');}
        if($meta->getAttribute('property') == 'og:image') {
            $feedback['image'] = $meta->getAttribute('content');
        }elseif($meta->getAttribute('name') == 'image') {
            $feedback['image'] = $meta->getAttribute('content');}
    }

    echo json_encode($feedback);

?>