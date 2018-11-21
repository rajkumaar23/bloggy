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
$user=getUsername();
require_once 'html_header.php';
?>
<br><br>


<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="title">Posts</h1>
                <?php
                $result=query("select * from posts order by id desc");
                while ($post = mysqli_fetch_assoc($result)) { ?>
                <div class="card">
                    <?php
                                    $author = "Anonymous";
                                    if (isset($post['user_id'])) {
                                        $res = query("select name from users where id=" . $post['user_id']);
                                        $name = mysqli_fetch_assoc($res);
                                        $GLOBALS['author'] = $name['name'];
                                    }
                                    ?>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-4"><?php echo $post['title']; ?></p>
                                    </div>
                                </div>

                                <div class="content">
                                    <?php
                                    echo "<p>" . $post['post'] . "</p>";
                                    $query = query("select id from users where username='" . $user . "'");
                                    $res = mysqli_fetch_assoc($query);
                                    $id = $res['id'];
                                    if ((int)$id == (int)$post['user_id']) {
                                        echo "<form method='post' action='delete.php'>"
                                        ."<div class='columns'>
                                          <div class='navbar-start column'>"."
                                            Posted on : " . $post['date'] . " by " . $author."
                                          </div>
                                          <div class='column'>
                                            <button class='navbar-end button is-link' name='delete' value='" . $post['id'] . "'>Delete</button>
                                          </div>".

                                            "</form>";
                                    }else{
                                        echo "<br>Posted on : " . $post['date'] . " by " . $author;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</main>

    <div class="container">

    </div>

</body>
</html>
