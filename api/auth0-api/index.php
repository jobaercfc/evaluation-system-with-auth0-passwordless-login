<?php

use Auth0\SDK\API\Authentication;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/dotenv-loader.php';


$api = new Authentication(getenv('AUTH0_DOMAIN'), getenv('AUTH0_CLIENT_ID'));


$email = $_POST["email"];

$client_secret = getenv('AUTH0_CLIENT_SECRET');
$client_id = getenv('AUTH0_CLIENT_ID');
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://".getenv('AUTH0_DOMAIN')."/passwordless/start",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"client_id\": \"$client_id\", \"client_secret\": \"$client_secret\", \"connection\": \"email\", \"email\": \"$email\",\"send\": \"link\"}",
    CURLOPT_HTTPHEADER => array(
        "content-type: application/json"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    var_dump($response);
}




