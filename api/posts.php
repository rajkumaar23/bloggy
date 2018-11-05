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

function getAuthorizationHeader(){
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}

function getBearerToken() {
    $headers = getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}
?>