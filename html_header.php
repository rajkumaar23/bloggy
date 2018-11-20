<html>
<head>
    <title>Bloggy</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Niramit" rel="stylesheet">
    <link href='css/bulma.css' rel='stylesheet' type='text/css'>
</head>


<body >
<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
    <div class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="index.php">
                Home
            </a>
            <a class="navbar-item" href="addpost.php">
                Add post
            </a>
            <a class="navbar-item" href="about.php">
                About Developer
            </a>

        </div>
        <div class="navbar-end navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">
                <?php echo $user; ?>
            </a>

            <div class="navbar-dropdown">
                <a class="navbar-item" href="logout.php">
                    Logout
                </a>
            </div>
        </div>

    </div>
</nav>