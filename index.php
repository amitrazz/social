<?php
    include('includes/header.php');
    include('includes/classes/User.php');
    include('includes/classes/Post.php');

    if(isset($_POST['post'])){
        $post = new Post($con,$userLogedIn);
        $post->submitPost($_POST['post_text'],'none');

    }
?>
    <div class="user_details column">
        <a href="<?php echo $userLogedIn; ?>"><img src="<?php echo $user['profile_pic']; ?>" alt=""></a>
        <div class="user_details_left_right">
            <a href="<?php echo $userLogedIn ?>"><?php
                echo $user['first_name']. ' '. $user['last_name'] . "<br>";
            ?></a>
            <?php
                echo "Posts : " .$user['num_posts'] ."<br>";
            ?>
            <?php
                echo "Likes : " .$user['num_likes'];
            ?>
        </div>
    </div>
    <div class="main_column column">
        <form action="index.php" method="post" class="post_form">
            <textarea name="post_text" id="post_text" placeholder="say somethings....."></textarea>
            <input type="submit" name="post" id="post_button" value="post">
            <hr>
        </form>
        
        <div class="post_area"></div>
        <img id="loading" src="assets/icons/loading.gif" alt="loading">

    </div>
        
    </div>
    <script>
        var userLogedIn = '<?php echo $userLogedIn; ?>';
        $(document).ready(function(){
            $('#loading').show();

            //call orignal post
            $.ajax({
                url:"includes/handler/ajax_load_posts.php",
                type:"POST",
                data:"page=1&userLogedIn=" +userLogedIn,
                cache:false,

                success: function(data){
                    $('#loading').hide();
                    $('.post_area').html(data);
                }
            })
        });

    </script>   
    </body>
</html>