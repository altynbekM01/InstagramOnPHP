<?php 
    include("include/config.php"); 
   
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user']);
        header("location: auth.php");
    }
    
    if (!isset($_SESSION['user'])){
        header('Location: /sites/midterm/auth.php');
        die;
    }
?>
<html>

    <head>
        <link rel="stylesheet"
            href="style2.css">
        <title>Instagram Clone</title>
    </head>

<body>
        
<?php 
    $check =  mysqli_query($connections, "SELECT * FROM `pushes` WHERE (`userid`={$_SESSION['user']['id']})");
    if (mysqli_num_rows($check) != 0){
        ?>
        <style>
        #pushb{
            box-shadow: 0px 0px 13px red;
            background: unset;
        }
        </style>
        <?php
    }
    
    ?>
    
<div style="margin-bottom:80px;"> 
    <nav class="navbar" >
        <div class="nav-wrapper">
            <img src="img/logo.PNG" class="brand-img" alt="">
            <input type="text" class="search-box" placeholder="search">
            <div class="nav-items">
                <img src="img/home.PNG" class="icon" alt="">
                <img src="img/messenger.PNG" class="icon" alt="">
                <a href="postForm.php"><img src="img/add.PNG" class="icon" alt=""></a>
                <img src="img/explore.PNG" class="icon" alt="">
                <img src="img/like.PNG" class="icon" alt="">
                <a href="/midterm/myprofile.php"><div class="icon user-profile"></div></a>
                <a href="index.php?logout='1'">exit</a>
            </div>
        </div>
    </nav>

</div>
<?php   
        $user = null;
        $info = "";
        if(isset($_GET['id'])){
            $user= mysqli_fetch_assoc(mysqli_query($connections, "SELECT * FROM `users` WHERE `id`=".intval($_GET['id'])));
            $info = json_decode($user['info_json']);
        }else{
            $q = mysqli_query($connections, "SELECT * FROM `users` WHERE `id`=".intval($_SESSION['user']['id']));
            if (mysqli_num_rows($q) == 0){
                echo("<script>document.location.href  = '/sites/midterm/auth.php'</script>");
                 die;
            }
            $user = mysqli_fetch_assoc(mysqli_query($connections, "SELECT * FROM `users` WHERE `id`=".intval($_SESSION['user']['id'])));
        
            $info = json_decode($user['info_json']);
        } 
        $ids = json_decode($user['posts_json']);
          $currentinfo =json_decode($_SESSION['user']['info_json']); 
?>
    

<section class="main">
    <div class="wrapper">
        <div class="left-col">
            <div class="test">
            
            <div class="status-wrapper">
                <div class="status-card">
                    <div class="profile-pic"><a href="index4.html"><img src="img/cover_1.png" alt=""></a></div>
                    <p class="username">Abai</p>
                </div>
                <div class="status-card">
                    <div class="profile-pic"><img src="img/Ayezov.png" alt=""></div>
                    <p class="username">M Ayezov</p>
                </div>
                <div class="status-card">
                    <div class="profile-pic"><img src="img/shakarim.png" alt=""></div>
                    <p class="username">S Kudaiberdiyly</p>
                </div>
                <div class="status-card">
                    <div class="profile-pic"><img src="img/Zhymabayev.png" alt=""></div>
                    <p class="username">M Zhumabayev</p>
                </div>
                <div class="status-card">
                    <div class="profile-pic"><img src="img/Makataev.png" alt=""></div>
                    <p class="username">M Makataev</p>
                </div>
                <div class="status-card">
                    <div class="profile-pic"><img src="img/Baityrsynov.png" alt=""></div>
                    <p class="username">A Baityrsynov</p>
                </div>
                <div class="status-card">
                    <div class="profile-pic"><img src="img/Altynsarin.png" alt=""></div>
                    <p class="username">Y Altynsarin</p>
                </div>
                <div class="status-card">
                    <div class="profile-pic"><img src="img/cover 8.png" alt=""></div>
                    <p class="username">user_name_8</p>
                </div>
            </div>
        </div>

        
          
        <?php for($i= count($ids)-1; $i >= 0; $i--){

            $post_q = mysqli_query($connections,"SELECT * FROM `posts` WHERE `id`=".$ids[$i]);

            if (mysqli_num_rows($post_q) == 0)
                continue;

            $post = mysqli_fetch_assoc($post_q);  
            $fromuser = mysqli_fetch_assoc(mysqli_query($connections,"SELECT * FROM `users` WHERE `id`=".$post['fromuser']));
            $images = json_decode($post['images_json']);
            $formuserinfo = json_decode($fromuser['info_json']);

        
        ?>
        <?php ?>
            <div class="post">
                <div class="info">
                    <div class="user">
                        <div class="profile-pic"><img src="<?php echo($formuserinfo->avatar);?>" alt=""></div>
                        <p class="username"><?php echo($fromuser['login'])?></p>
                    </div>
                    <img src="img/option.PNG" class="options" alt="">
                </div>
                <?php if (count($images) == 0){?>
                <p><?php
                $timestamp = strtotime($post['date']);
                echo date('H:i:s d/m/Y', $timestamp); ?>
                </p>
             <?php echo('</div>'); continue;}?>
                <div class="post-content">
                <div class="postImages">
                    <?php 
                        for ($j=0; $j < count($images); $j++) { ?>
                        <div style="height:40vw; overflow:hidden;width:<?php echo (100/count($images));?>%;"><a style="width:100%;" href="<?php echo($images[$j]);?>" target_="_blank"> <img style="width:100%; cursor:pointer;" src="<?php echo($images[$j]);?>"></a></div>
                        <?php
                        }
                    ?>
                </div>
                    <div class="reaction-wrapper">
                        <img src="img/like.PNG" class="icon" alt="">
                        <img src="img/comment.PNG" class="icon" alt="">
                        <img src="img/send.PNG" class="icon" alt="">
                        <img src="img/save.PNG" class="save icon" alt="">
                    </div>
                    <p class="likes">1,012 likes</p>
                    <p class="description" style="overflow:hidden;text-overflow: ellipsis;"><span><?php echo($fromuser['login'])?></span> <?php echo($post['message']); ?></p>
                    <p class="post-time">2 minutes ago</p>
                </div>
                <div class="comment-wrapper">
                    <img src="img/smile.PNG" class="icon" alt="">
                    <input type="text" class="comment-box" placeholder="Add a comment">
                    <button class="comment-btn">post</button>
                </div>
            </div>
        <?php } ?>   
        // +5 more post elements
    </div>
    <div class="right-col" style="margin-left:2%;">
        <div class="profile-card">
            <div class="profile-pic">
                <img src="<?php echo("$info->avatar")?>" alt="">
            </div>
            <div><a href="myprofile.php">
                <p class="username"><?php echo($user['name'])?></p>
                <p class="sub-text"><?php echo($user['login'])?></p>
            </a>
                
            </div>
            <button class="action-btn">switch</button>
        </div>
        <p class="suggestion-text">Suggestions for you</p>
        <div class="profile-card">
            <div class="profile-pic">
                <img src="img/Bokeikhanov.png" alt="">
            </div>
            <div>
                <p class="username">Bokeikhanov</p>
                <p class="sub-text">followed bu user</p>
            </div>
            <button class="action-btn">follow</button>
        </div>
        <div class="profile-card">
            <div class="profile-pic">
                <img src="img/Kabdesh.png" alt="">
            </div>
            <div>
                <p class="username">K Zhumadilov</p>
                <p class="sub-text">followed bu user</p>
            </div>
            <button class="action-btn">follow</button>
        </div>
        <div class="profile-card">
            <div class="profile-pic">
                <img src="img/Ermekov.png" alt="">
            </div>
            <div>
                <p class="username">A Ermekov</p>
                <p class="sub-text">followed bu user</p>
            </div>
            <button class="action-btn">follow</button>
        </div>
        <div class="profile-card">
            <div class="profile-pic">
                <img src="img/Maylin.png" alt="">
            </div>
            <div>
                <p class="username">B Maylin</p>
                <p class="sub-text">followed bu user</p>
            </div>
            <button class="action-btn">follow</button>
        </div>
        <div class="profile-card">
            <div class="profile-pic">
                <img src="img/Zhansygyrov.png" alt="">
            </div>
            <div>
                <p class="username">I Zhansygyrov</p>
                <p class="sub-text">followed bu user</p>
            </div>
            <button class="action-btn">follow</button>
        </div>
    </div>

    </div>

</section>
</body>
</html>