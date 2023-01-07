<?php include("include/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="reg.css">
</head>
<body>
    <?php 
        if (isset($_POST['go_reg'])){
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            
            
            $g = mysqli_query($connections, "SELECT * FROM `users` WHERE `login`='$username' OR `email`='$email'");
            
            if (mysqli_num_rows($g) == 0){
                $info = array(
                    'avatar' => "images/profile-pic.png",
                    'followers' =>array(),
                    'followings'=>array()
                );
                $info_json = (json_encode($info,JSON_UNESCAPED_UNICODE));
                $posts = json_encode(array(),JSON_UNESCAPED_UNICODE);
                $pass = password_hash($_POST['password'],PASSWORD_DEFAULT);
                mysqli_query($connections, "INSERT INTO `users` (`email`,`name`, `login`, `password`, `info_json`, `posts_json`) VALUES ('$email','$fullname', '$username', '$pass', '{$info_json}', '{$posts}')");
                echo("<script>document.location.href  = '/sites/midterm/index.php'</script>");
            }else{
                echo("Эти данные уже используются."); 
            }

            
        }
    ?>
    <main>
        <div class="main-container">
            <div class="autor">
                <img src="/img/7a252de00b20.png" alt="" class="inst">

                <div class="facebook">
                    <a href="#">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/Facebook_icon_2013.svg/2048px-Facebook_icon_2013.svg.png" alt="">
                            Log in with Facebook
                        </a>
                </div>
                <div class="orblock">
                    <div class="line"></div>
                    <div class="or">or</div>
                    <div class="line"></div>
                </div>
                <form action="" method="post">
                    <input class = "inp-user" type="email" placeholder="Email" name="email">
                    <input class = "pas-user" type="text" placeholder="Full Name" name="fullname">
                    <input class = "pas-user" type="text" placeholder="Username" name="username">
                    <input class = "pas-user" type="password" placeholder="Password" name="password">

                    <div class="notation">People who use our service may have uploaded your contact information to Instagram. Learn More</div>
                    <div class="notation">By signing up, you agree to our Terms , Privacy Policy and Cookies Policy .</div>

                    <button class="butt" type="submit" name="go_reg">Sing up</button>
                </form>
                <div class="remove">
                    <div class="error">
                        <p>
                            <?php
                            if($error != '') echo $error;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="regis">
                <p>Have an account? <a href="auth.php">Log in</a></p>
            </div>
        </div>
        
    </main>
</body>
</html>