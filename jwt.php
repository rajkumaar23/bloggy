<?php
require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;

$userid='rajkumaar';
$issuedAt = time();
$expirationTime = $issuedAt + 3600;  // jwt valid for 3600 seconds from the issued time
$payload = array(
  'user_id' => $userid,
  'iat' => $issuedAt,
  'exp' => $expirationTime
);
$key = "rajkumaar";
$alg = 'HS256';
$jwt = JWT::encode($payload, $key, $alg);
echo $jwt;
$decoded = JWT::decode($jwt, $key, array('HS256'));
$decoded_array = (array)$decoded;
echo "\n".$decoded_array['user_id'];
?>