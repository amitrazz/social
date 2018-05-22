<?php
    ob_start();
    session_start();
    $con = mysqli_connect('localhost','root','','social');
    if(mysqli_connect_errno()){
        echo "faild to connect : ". mysqli_connect_errno();
    }

?>