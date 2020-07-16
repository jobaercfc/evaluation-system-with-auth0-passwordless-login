<?php
if (isset($_POST)) {
    $token = $_POST["token"];
    $user_id = $_POST["user"]["sub"];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://dev-jobaertest.us.auth0.com/api/v2/users/".$user_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer MGMT_API_TOKEN"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}
