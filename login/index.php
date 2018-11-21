<?php
require_once '../intialise.php';
require_once '../vendor/autoload.php';
use Firebase\JWT\JWT;


if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=clean(h($_POST['username']));
    $password=clean(h($_POST['password']));

    $res=query("select password from users where username='".$username."'");
    $password_in_db=mysqli_fetch_assoc($res);

    if(!isset($password_in_db)){
        $error= "Username not found";
    }
    else if(strcmp($password_in_db['password'] ,$password)!=0){
        $error="PASSWORD INVALID";
    }else{
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600;  // jwt valid for 3600 seconds from the issued time
        $payload = array(
            'username' => $username,
            'iat' => $issuedAt,
            'exp' => $expirationTime
        );
        $key = JWT_KEY;
        $alg = 'HS256';
        $jwt = JWT::encode($payload, $key, $alg);
        cookie_set($jwt);
        header("Location: "."../index.php");
        exit;
    }


}
?>
<html>
<head>
    <title>Bloggy</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Niramit" rel="stylesheet">
    <link href='../css/main.css' rel='stylesheet' type='text/css'>
</head>

<body>
<div style="
     height: 100vh;
     text-align: center;
     background-image: url('../images/train.jpg');
no-repeat center center fixed; background-size: cover;">

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h1 style="color: #000; font-family: 'Niramit', sans-serif;
">Bloggy | Login</h1>

        <input type="text" name="username" placeholder=" Username" style="height: 30px" required/>
        <br><br>
        <input type="password" name="password" placeholder=" Password" style="height: 30px" required/>

    <p style="color: red;"><?php if(isset($error)){ echo $error; }?></p>

        <button name="submit" type="submit" style="text-align: center">Login</button>
    <h3 style=" font-family: 'Niramit', cursive"><a style="color:crimson;" href="../signup.php">Create an account</a></h3>

</form>
</div>
</body>
</html>