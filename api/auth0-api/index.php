<?php
session_start();
require '../../database_connection.php';
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/dotenv-loader.php';

$email = "";

if(isset($_POST["email"])) {
    $email = $_POST["email"];
}

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
    $sql = "select * from users where email = ?";
    $run = $conn->prepare($sql);
    $run->execute([$email]);

    if($run->rowCount()) {
        $row = $run->fetchAll();
        $_SESSION["email"] = $email;
        $_SESSION["user_id"] = $row[0]["id"];
        $_SESSION["flash_success"] = "success";
    } else {
        $_SESSION["warning_flash"] = "User not found.";
    }

    echo "<script>window.location.href='http://localhost/project_djas/';</script>";
}




