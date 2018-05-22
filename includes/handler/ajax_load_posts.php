<?php
include('../../config/config.php');
include('../classes/User.php');
include('../Classes/Post.php');

$limit = 10;

$posts = new Post($con,$_REQUEST['userLogedIn']);
    $posts-> loadPostsFriends();

?>