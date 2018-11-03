<?php
require_once 'intialise.php';
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])){
    header("Location: login");
}
require_once 'html_header.php';
?>
<style>
    .profile-pic {
        display: block;
        position: relative;
        width: 150px;
        height: 150px;
        margin-left: auto;
        margin-right: auto;
        border-radius: 100%;
    }
    h1{
        color: white;text-align: center; font-family: 'Niramit', sans-serif;
    }
    h2{
        text-overline-color: black;text-align: center; font-family: 'Niramit', sans-serif;
    }
    img{
        horiz-align: center;
    }
    #footer{
        position: relative;
        left: 0;
        bottom: 0;
        font-size: large;
        width: 100%;
        font-family: 'Niramit', cursive;
        text-align: center;
    }#heart{
         color: red;
     }
</style>
<body>
<ul style="background-color:black">
    <h1>About Developer</h1>
</ul>
<ul>
    <li><a href="index.php">Home</a></li>

    <li><a href="addpost.php">Add post</a></li>
    <li><a class="active" href="/about.php">About</a></li>
    <li style="float:right"><a class="activeblack" href="logout.php">Logout, <?php echo $_COOKIE['username'] ?></a></li>
</ul>
<br>
<img class="profile-pic" src="images/profile.jpg">
<h2>Developed by <br> <a href="http://rajkumaar.co.in"> RAJKUMAR </a></h2>
<footer id="footer">
    <div>
        <h4>Made with <span id="heart">&hearts;</span> by Rajkumar &copy; <?php echo date('Y'); ?> </h4>
    </div>
</footer>
</body>
</html>





