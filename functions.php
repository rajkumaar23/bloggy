<?php
require_once 'intialise.php';
require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;
function clean($string=""){
    global $connection;
return mysqli_real_escape_string($connection,$string);
}
function h($str){
    return htmlspecialchars($str);
}
function db_connect(){
    $connection=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    confirm_db_connect();
    return $connection;
}

function confirm_db_connect(){
    if(mysqli_connect_errno()){
        $msg="Database connection failed. ";
        $msg.=mysqli_connect_error();
        $msg.=" (".mysqli_connect_errno().")";
        exit($msg);
    }
}

function query($sql){
    global $connection;
    $res=mysqli_query($connection,$sql);
    return $res;
}

function verify_jwt($jwt){
    $key = JWT_KEY;
    try {
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $decoded_array = (array)$decoded;
        return $decoded_array['username'];

    } catch (\Exception $e) {
        return null;
    }
}