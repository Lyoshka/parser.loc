<?php

$auth = base64_encode('spb\eav:recf40vehf}|');
$url = 'http://lenta.ru';


$opts = array(
    'http' => array (
        'method'=>'GET',
        'proxy'=>'tcp://10.247.19.22:9090',
        'request_fulluri' => true,
        'header'=> array("Proxy-Authorization: Basic $auth", "Authorization: Basic $auth")

    ),
    'https' => array (
        'method'=>'GET',
        'proxy'=>'tcp://10.247.19.22:9090',
        'request_fulluri' => true,
        'header'=> array("Proxy-Authorization: Basic $auth", "Authorization: Basic $auth")
    )
);
$ctx = stream_context_create($opts);
$content = file_get_contents($url,false,$ctx);

echo $content;


?>

