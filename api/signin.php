<?php

require_once '../intialise.php';
require_once '../vendor/autoload.php';
use Firebase\JWT\JWT;

if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=clean(h($_POST['username']));
    $password=clean(h($_POST['password']));

    $issuedAt = time();
    $expirationTime = $issuedAt + 3600;
    $res=query("select password from users where username='".$username."'");
    $password_in_db=mysqli_fetch_assoc($res);

    if(!isset($password_in_db)){
        $error= "Username not found";
    }
    else if(strcmp($password_in_db['password'] ,$password)!=0){
        $error="Invalid password";
    }
    if(isset($error)){
        $result=json_encode(array(
            'status'=>false,
            'error'=>$error
        ));
    }else{
        $payload = array(
            'username' => $username,
            'iat' => $issuedAt,
            'exp' => $expirationTime
        );
        $key = JWT_KEY;
        $alg = 'HS256';
        $jwt = JWT::encode($payload, $key, $alg);
        $result=json_encode(array(
            'status'=>true,
            'token'=>$jwt,
            'expires_in'=>3600
        ));
    }
    header("Content-Type: application/json");
    echo $result;
}else{
    header("HTTP/1.0 401");
}