<?php
header("Access-Control-Allow-Origin: *");
$url = $_GET['url'];
// Ajout des headers pour se faire passer pour un vrai navigateur
$opts = [
    "http" => [
        "method" => "GET",
        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:153.0) Gecko/20100101 Firefox/153.0\r\n" .
                    "Referer: https://zebi.senpai-stream.club/\r\n"
    ]
];
$context = stream_context_create($opts);
echo file_get_contents($url, false, $context);
?>
