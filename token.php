<?php

$api_key = '7e4980e11f58827f0ceaf0ca7e38dfa3';
$secret_key = 'ab7b9fae77cbf98b988b18542beea0ed';
$parameters = $_GET;
$shop_url = $parameters['shop'];
$hmac = $parameters['hmac'];
$parameters = array_diff_key($parameters, array('hmac' => ''));
ksort($parameters);

$new_hmac = hash_hmac('sha256', http_build_query($parameters), $secret_key);

if( hash_equals($hmac, $new_hmac) ) {
    $access_token_endpoint = 'https://' .  $shop_url . '/admin/oauth/access_token';
    $var = array(
        "client_id" => $api_key,
        "client_secret" => $secret_key,
        "code" => $parameters['code']
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $access_token_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, count($var));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($var));
    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response, true);

    echo print_r($response);
}else {
    echo "Not OK";
}