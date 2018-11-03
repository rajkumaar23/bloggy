<?php
require_once 'intialise.php';
session_start();
if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $query=query("delete from posts where id=".$_POST['delete']);
    }
}
header("Location: "."index.php");
exit;