<?php
require_once 'intialise.php';
session_start();
setcookie('username','',time()+(86400*30),"/");
setcookie('password','',time()+(86400*30),"/");
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])){
    header("Location: login");
}
require_once 'html_header.php';
?>

<body>
<ul style="background-color:black">
    <h1 style="color: white;text-align: center; font-family: 'Niramit', sans-serif;

">Bloggy</h1>


</ul>
<ul>
    <li><a class="active" href="index.php">Home</a></li>
    <li><a href="addpost.php">Add post</a></li>
    <li><a href="about.php">About</a></li>
    <li style="float:right"><a class="activeblack" href="logout.php">Logout, <?php echo $_SESSION["username"]; ?></a></li>
</ul>
<?php
$result=query("select * from posts order by id desc");
    while ($post = mysqli_fetch_assoc($result)) {
        $author = "Anonymous";
        if (isset($post['user_id'])) {
            $res = query("select name from users where id=" . $post['user_id']);
            $name = mysqli_fetch_assoc($res);
            $GLOBALS['author'] = $name['name'];
        }
        echo "<h2>" . $post['title'] . "</h2>" . "<p>" . $post['post'] . "</p>" .
            "<h5>Posted on : " . $post['date'] . " by " . $author . "<br><br>";
        $query = query("select id from users where username='" . $_SESSION["username"] . "'");
        $res = mysqli_fetch_assoc($query);
        $id = $res['id'];
        if ((int)$id == (int)$post['user_id']) {
            echo "<form method='post' action='delete.php'> <button name='delete' value='" . $post['id'] . "'>Delete</button></form>";
        }
        echo "<hr>";
    }
?>
</body>
</html>
