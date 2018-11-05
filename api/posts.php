<?php
require_once '../intialise.php';
require_once '../vendor/autoload.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
    $jwt=getBearerToken();
    $user=verify_jwt($jwt);
    if(isset($user)){
        $json_res=array();
        $result=query("select * from posts order by id desc");
        while ($post = mysqli_fetch_assoc($result)) {
            $author = "Anonymous";
            if (isset($post['user_id'])) {
                $res = query("select name from users where id=" . $post['user_id']);
                $name = mysqli_fetch_assoc($res);
                $GLOBALS['author'] = $name['name'];
            }
            $id=$post['id'];
            $title= $post['title'];
            $content=$post['post'];
            $date=$post['date'];

            $query = query("select id from users where username='" . $user . "'");
            $user_id = mysqli_fetch_assoc($query);
            $current=array(
                'id'=>$id,
                'owned'=>($user_id['id']==$post['user_id']) ? true : false,
                'author'=>$author,
                'title'=>$title,
                'content'=>htmlspecialchars_decode($content),
                'date'=>$date
            );
            array_push($json_res,$current);
        }
    }else{
        $json_res=array(
            'status'=>false,
            'error'=>"Invalid token"
        );
    }
    header("Content-Type: application/json");
    echo json_encode($json_res);

}else{
    header("HTTP/1.1 401");
}


?>