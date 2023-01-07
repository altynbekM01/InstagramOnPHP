<?php include("include/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="inst.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>
    </head>
    <body>
    <?php
        
        if (isset($_POST['go_log'])){
            $login = $_POST['login'];
            $loginEx = mysqli_query($connections, "SELECT * FROM `users` WHERE `login`='$login'");
            if (mysqli_num_rows($loginEx) == 1){
                $loginExFetch = mysqli_fetch_assoc($loginEx);
                if (password_verify($_POST['password'], substr( $loginExFetch['password'], 0, 60 ))){

                    $_SESSION['user'] = $loginExFetch;
                    echo("<script>document.location.href  = '/sites/midterm/index.php'</script>");
                }else{
                    echo("Неверные данные");
                }
            }else{
                echo("Неверные данные");
            }
        }
        
    ?>
    
    <div class="login-container">
        <div class="fon">
            <img src="ads/isnt.png" alt="insta page" width="415px" height="579px">

        </div>
        <div class="main">
            <div class="logoo">
                <img src="ads/logo.jpg" alt="logo" width=150px>
            </div>
            <div class="login">
                <form action="" method="POST">
                    <input class="username" type="text" placeholder="Телефон, имя пользователя или эл. адрес..." name = "login">
                    <input class="username" type="password" placeholder="Пароль" name="password">
                
                    <button class ="btnn"  type="submit" name="go_log"  value="Enter"><a>Войти</a></button>
                </form>
                    <div class="or">
                        <hr>
                        <span>OR</span>
                        <hr>
                    </div>
                    <div class="facebook" >
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/Facebook_icon_2013.svg/2048px-Facebook_icon_2013.svg.png" 
                        width="15px" class="fb">
                        <a href="https://www.facebook.com/" target="_blank"><font color="blue">  Войти через Facebook</a>
                    </div>
                    <div class="forgot">
                        <a href="inst6.1.html"><font color="blue" ; style="opacity:0.8"; > Забыли пароль?</a>
                    </div>
                    <div class="reg">
                        <p><font color="black">У вас еще нет аккаунта?</font> <a href="register.php" target="_blank"><font color='blue'>Зарегистрироваться</a></p>
                    </div>
                    <p class="app"><font color="black">Установите приложение.</font></p>
                    <div class="apps">
                        <a href="https://getprogram.net/index.php?d=120" target="_blank">  <img src="ads/apps.png"
                            alt="logos" width="320px"; hspace="15" >
                    </div>
            
            </div>
        </div>
    </div>
    
    <footer class="fin">
        <p><a href="https://about.instagram.com/"><font color="black">
        Meta &nbsp; Информация &nbsp; Блог &nbsp; Вакансии &nbsp; Помощь &nbsp; API &nbsp; Конфиденциальность &nbsp; Условия &nbsp; Популярные аккаунты &nbsp; Хэштеги &nbsp; Места 
            <br> Instagram Lite &nbsp; Красота &nbsp; Танцы &nbsp; Фитнес &nbsp; Еда и напитки &nbsp; Дом и сад &nbsp; Музыка &nbsp; Изобразительное искусство
            <br>
            Русский
            © 2022 Instagram from Meta
           </font> </a></p>
    </footer>
    
</body>
</html>