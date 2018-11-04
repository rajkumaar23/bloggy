<?php
require_once 'intialise.php';
session_start();
if(isset($_SESSION['_token'])){
    $jwt=$_SESSION['_token'];
    $user=verify_jwt($jwt);
    if(!isset($user)){
        header("Location: login");
    }else{

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $query=query("delete from posts where id=".$_POST['delete']);
        }

    }
}else {
    header("Location: login");
}
header("Location: "."index.php");
exit;