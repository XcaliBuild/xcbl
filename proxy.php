<?php
header("Access-Control-Allow-Origin: *");

if (!isset($_GET['url']) || empty($_GET['url'])) {
    die("URL manquante.");
}

$url = $_GET['url'];

// Validation basique pour s'assurer que c'est une URL valide
if (!filter_var($url, FILTER_VALIDATE_URL)) {
    die("URL invalide.");
}

$ch = curl_init($url);

// Ajout des headers pour simuler le navigateur
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:153.0) Gecko/20100101 Firefox/153.0",
    "Referer: https://zebi.senpai-stream.club/"
]);

// Récupérer et relayer le Content-Type d'origine vers le lecteur
curl_setopt($ch, CURLOPT_HEADERFUNCTION, function($curl, $header) {
    if (stripos($header, 'Content-Type:') === 0) {
        header($header);
    }
    return strlen($header);
});

// Ne pas stocker le fichier en mémoire, le relayer directement au client
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

// Exécution
curl_exec($ch);
curl_close($ch);
?>
