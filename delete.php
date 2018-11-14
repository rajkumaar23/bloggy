<?php
require_once 'intialise.php';
if(isset($_COOKIE['token'])){
    $jwt=$_COOKIE['token'];
    $user=verify_jwt($jwt);
    if(!isset($user)){
        header("Location: login");
    }else{

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $query=query("select user_id from posts where id=".clean($_POST['delete']));
            $post_user=mysqli_fetch_assoc($query)['user_id'];
            $query=query("select id from users where username='".$user."'");
            $current_user=mysqli_fetch_assoc($query)['id'];
            if($post_user==$current_user){
                $query=query("delete from posts where id=".clean($_POST['delete']));
            }else{
                header("HTTP/1.1 401");
            }
        }

    }
}else {
    header("Location: login");
}
header("Location: "."index.php");
exit;