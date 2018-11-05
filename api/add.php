<?php
require_once '../intialise.php';

global $connection;
if($_SERVER['REQUEST_METHOD']=='POST') {
    $jwt=getBearerToken();
    $user=verify_jwt($jwt);
    if(!isset($user)){
        $json_res=array(
            'status'=>false,
            'error'=>"Invalid token"
        );
    }else{
        $title = clean(h($_POST['title']));
        $content = clean(h($_POST['content']));
        $query = query("select id from users where username='" . $user . "'");
        $res = mysqli_fetch_assoc($query);
        $user_id = $res['id'];
        $date = date("Y-m-d");
        $query = query("insert into posts(user_id,title,post,date) values($user_id" . ",'" . $title . "','" . $content . "','" . $date . "')");
        $last_id = $connection->insert_id;
        if($query){
            $json_res=array(
                'status'=>true,
                'id'=>$last_id
            );
        }else{
            $json_res=array(
                'status'=>false,
                'error'=>'database error'
            );
        }
    }

    header("Content-Type: application/json");
    echo json_encode($json_res);
}else{
    header("HTTP/1.1 404 Not Found");
}
?>