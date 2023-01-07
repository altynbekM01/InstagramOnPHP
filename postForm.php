<?php 
    include("include/config.php");
    $user = null;
    $info = "";
    if(isset($_GET['id'])){
        $user= mysqli_fetch_assoc(mysqli_query($connections, "SELECT * FROM `users` WHERE `id`=".intval($_GET['id'])));
        $info = json_decode($user['info_json']);
    }else{
        $q = mysqli_query($connections, "SELECT * FROM `users` WHERE `id`=".intval($_SESSION['user']['id']));
        if (mysqli_num_rows($q) == 0){
            echo("<script>document.location.href  = '/auth.php'</script>");
             die;
        }
        $user = mysqli_fetch_assoc(mysqli_query($connections, "SELECT * FROM `users` WHERE `id`=".intval($_SESSION['user']['id'])));
    
        $info = json_decode($user['info_json']);
    }


    $ids = json_decode($user['posts_json']);
    $currentinfo =json_decode($_SESSION['user']['info_json']); ?>  

<h1>Посты:</h1>

    <?php $ids = json_decode($user['posts_json']);
          $currentinfo =json_decode($_SESSION['user']['info_json']); ?>
   
   <div class="user-card-posts">
            <div class="user-card-posts-creator">
                <div style="background-image:url(<?php echo($currentinfo->avatar);?>); background-repeat: no-repeat;background-size: cover;"></div>
                <h2><?php echo($_SESSION['user']['name']);?></h2>
            </div>
            <form action="#" method="POST">
                <textarea minlength="20" require style="width:100%; margin-top:1vw; min-height:10vw; font-size:1vw; border-style:solid; resize: vertical;" 
                placeholder="" name="message"></textarea>    
                
                <style>
                    .images{
                        width:100%;
                    }
                    .images button{
                        width:100%;
                    }
                </style>
                <div class="images" >
                    <input type="text" name="i1" placeholder="url.com\imagename.png/.jpg/.gif...">
                    <input type="text" name="i2" placeholder="url.com\imagename.png/.jpg/.gif...">
                    <input type="text" name="i3" placeholder="url.com\imagename.png/.jpg/.gif...">
                    <input type="text" name="i4" placeholder="url.com\imagename.png/.jpg/.gif...">
                    <input type="text" name="i5" placeholder="url.com\imagename.png/.jpg/.gif...">
                </div>
                <button style="border-style:solid; width:100%; font-size:1.2vw; margin-top:1vw" type="submit" name="postinuserprofile">Пост</button>
            </form>
        </div>
<?php 
if (isset($_POST['postinuserprofile'])){

    if (trim($_POST['message']) != ''){
        $images = array();
        for ($i=0; $i < 4; $i++) {
            if (trim($_POST[(string)('i'.$i)]) != '') 
                array_push($images, trim($_POST[(string)('i'.$i)]));
        }
        
        $images_json = (json_encode($images, JSON_UNESCAPED_UNICODE));

        mysqli_query($connections, "INSERT INTO posts(message, images_json, userid, fromuser) VALUES ('{$_POST['message']}','{$images_json}','{$user['id']}','{$_SESSION['user']['id']}')");
        $id = mysqli_insert_id($connections);
        $posts = json_decode($user['posts_json']);
        array_push($posts, $id);
        
        $posts_json = (json_encode($posts, JSON_UNESCAPED_UNICODE));

        mysqli_query($connections, "UPDATE users SET posts_json='{$posts_json}' WHERE id=".$user['id']);
        echo("<script>document.location.href='/midterm/?index=&id=".$user['id']."';</script>");
    }
}
    
?>