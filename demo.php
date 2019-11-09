<?php

include 'vendor/autoload.php';

use \Firebase\JWT\JWT;

echo str_random(9, -10), '<br>';

$key = "example_key";
$token = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

$res = JWT::encode($token, $key);
echo $res, '<br>';
echo base64_decode('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9'), '<br>';

$key.= 'ss';



try {
    $res = JWT::decode($res, $key, ['HS256']);
    print_r($res);


} catch ( \Exception $e) {

    print_r($e->getCode());
    print_r($e->getMessage());

}


