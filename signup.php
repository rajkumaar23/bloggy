<?php 
require_once 'intialise.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=clean($_POST['name']);
    $username=clean($_POST['username']);
    $password=clean($_POST['password']);
    $query=query("insert into users(name,username,password) values('".$name."','".$username."','".$password."')");
    if(!$query)
        echo "Failed";
    else {
    header("Location: "."login");
    exit;
    }
}
require_once 'html_header.php';
?>
<body>

<div style="
height: 100vh;
    text-align: center;
background-image: url('images/train.jpg');
no-repeat center center fixed; background-size: cover;
">

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h1 style="color: #000;font-family: 'Niramit', sans-serif;
">Bloggy | Signup</h1>
        <input type="text" name="name" placeholder=" Enter your name" style="height: 30px" required/>
        <br><br>
        <input type="text" name="username" placeholder=" Username" style="height: 30px" required/>
        <br><br>
        <input type="password" name="password" placeholder=" Password" style="height: 30px" required/>

    <p style="color: red;"><?php if(isset($error)){ echo $error; }?></p>

<button name="submit" type="submit" style="text-align: center">Create an account </button>
    <h3 style=" font-family: 'Niramit', cursive"><a style="color:crimson;" href="login">Already have an account? Login</a></h3>

</form>
</div>
</body>
</html>
