<?php
require_once 'intialise.php';
session_start();
if(isset($_SESSION['_token'])){
    $jwt=$_SESSION['_token'];
    $user=verify_jwt($jwt);
    if(!isset($user)){
        header("Location: login");
    }
}else{
    header("Location: login");
}
global $connection;
require_once 'html_header.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $title=clean(h($_POST['title']));
    $content=clean(h($_POST['content']));
    $query=query("select id from users where username='".$user."'");
    $res=mysqli_fetch_assoc($query);
    $user_id=$res['id'];
    $date=date("Y-m-d");
    $query=query("insert into posts(user_id,title,post,date) values($user_id".",'".$title."','".$content."','".$date."')");
    ?>
    <script>  window.location.replace("index.php"); </script>
<?php
    
}
?>

<body>
<ul style="background-color:black">
    <h1 style="color:#fff; text-align: center; font-family: 'Niramit', cursive">Add a post</h1>
</ul>
<ul>
    <li><a href="index.php">Home</a></li>
    <li><a class="active" href="addpost.php">Add post</a></li>
    <li><a href="about.php">About</a></li>
    <li style="float:right"><a class="activeblack" href="logout.php">Logout, <?php echo $user; ?></a></li>
</ul>
<div style="
height: 100vh;
    text-align: center;
background-image: url('images/train.jpg');
no-repeat center center fixed; background-size: cover;
">

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <br>
        <input type="text" name="title" placeholder=" Enter title" style="height: 30px" required/>
        <br><br>
        <textarea rows="20" cols="40" required name="content"></textarea>

        <p style="color: red;"><?php if(isset($error)){ echo $error; }?></p>

        <button name="submit" type="submit" style="text-align: center">Add post </button>

    </form>
</div>
</body>
</html>
