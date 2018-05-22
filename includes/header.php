<?php
    require 'config/config.php';
    if(isset($_SESSION['username'])){
        $userLogedIn = $_SESSION['username'];
        $user_details_query = mysqli_query($con,"SELECT * FROM users WHERE username='$userLogedIn'");
        $user = mysqli_fetch_array($user_details_query);
    }else{
        header('Location:register.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Social</title>
    <!-- css  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- js -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/main.js"></script>
</head>
<body>
    <div class="top_bar">
        <div class="logo">
            <a href="index.php">Social</a>
    </div>
        <nav>
            <a href="<?php echo $userLogedIn; ?>"><?php echo $user['first_name']; ?></a>
            <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-envelope" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-bell" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-user-plus" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-cog" aria-hidden="true"></i></a>
            <a href="includes/handler/logout.php"><i class="fa fa-sign-out"></i></a>

            <!-- <a href=""><?php echo $user['first_name']; ?></a>
            <a href="index.php">home</a>
            <a href="">message</a>
            <a href="">Notification</a>
            <a href="">friends</a>
            <a href="">setting</a>
            <a href="logout.php">logout</a> -->
        </nav>
    </div>
    <div class="wrapper">
    
    