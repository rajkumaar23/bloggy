<?php
require_once '../intialise.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=clean($_POST['name']);
    $username=clean($_POST['username']);
    $password=clean($_POST['password']);

    $json_res=array();
    $query=query("select id from users where username='".$username."'");
    $res=mysqli_fetch_assoc($query);

    if(isset($res)){
        $error="Username already taken";
        $status=false;
    }else{
        $query=query("insert into users(name,username,password) values('".$name."','".$username."','".$password."')");
        if(!$query){
            $error="Couldn't sign up. Please try again after sometime.";
            $status=false;
        }

        else {
            $status = true;
        }
    }
    if(isset($error)){
        $json_res=array('status'=>$status,'error'=>$error);
    }else{
        $json_res=array('status'=>$status);
    }

    header("Content-Type: application/json");
    echo json_encode($json_res);


}else{
    header("HTTP/1.1 403 Forbidden");
}
?>