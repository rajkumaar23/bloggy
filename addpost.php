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


<br>
<br>
<div class="container is-fluid">
    <h1 class="title">Create a post</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="field">
            <label class="label" for="title">Post Title</label>

            <div class="control">
                <input
                        type="text"
                        class="input"
                        name="title"
                        value="<?php echo $title; ?>"
                        required>
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Post Description</label>

            <div class="control">
                <textarea
                        name="content"
                        class="textarea"
                        required
                >

                </textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create Post</button>
            </div>
        </div>
        <?php if(isset($error)){ ?>
        <div class="notification is-danger">
            <p><?php echo $error; ?></p>
        </div>
        <?php } ?>


    </form>
</div>
</body>
</html>
