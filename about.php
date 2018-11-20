<?php
require_once 'intialise.php';
if(!verify_cookie())
    header("Location: login");
$user=getUsername();
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
    img{
        horiz-align: center;
    }
    #footer{
        font-family: 'Niramit', cursive;
    }#heart{
         color: red;
     }
</style>
<br><br>
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="image is-48x48">
                                            <img src="https://rajkumaar.co.in/images/profile-pic.jpg" alt="Rajkumar">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <p class="title is-4">Rajkumar</p>
                                        <p class="subtitle is-6">Android & Backend Developer</p>
                                    </div>
                                </div>

                                <div class="content">
                                    An ambitious engineering sophomore, primarily focused and proficient in Android App Development with up-to-date knowledge about latest frameworks, while also devoted to backend web development in PHP, and a fanboy of Laravel.

                                    Currently working as a C/C++ Teaching Assistant at Internshala, India's no.1 internship and training platform. Responsibilities include answering queries and interacting with students, evaluating and providing feedback for their projects, thus helping them to get confident in the world of programming.

                                    Loves to work in an organisation that believes in gaining a competitive edge and giving back to the community. Hobbies include but not limited to messing around linux terminal, video/photo editing, and carrom.
                                    <br><a href="https://rajkumaar.co.in">Visit personal website</a>.
                                    <br>
                                    2018/11/20 09:11:15 PM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
<footer class="footer" id="footer">
    <div class="content has-text-centered">
        <p>Made with <span id="heart">&hearts;</span> by Rajkumar &copy; <?php echo date('Y'); ?> </p>
    </div>
</footer>
</html>





