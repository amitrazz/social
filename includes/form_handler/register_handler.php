<?php
    //variable declaration
$fname  =   '';
$lname  =   '';
$email  =   '';
$email2 =   '';
$password   =   '';
$password2  =   '';
$date       =   '';
$error_array = array();

if(isset($_POST['reg_button'])){
    //first name fileds
    $fname = strip_tags($_POST['reg_fname']);
    $fname = str_replace(' ','',$fname);
    $fname  = ucfirst(strtolower($fname));
    $_SESSION['$reg_fname'] =  $fname; 

    //Last name fileds
    $lname = strip_tags($_POST['reg_lname']);
    $lname = str_replace(' ','',$lname);
    $lname  = ucfirst(strtolower($lname));
    $_SESSION['$reg_lname'] =  $lname; 
    

    //email fileds
    $email = strip_tags($_POST['reg_email']);
    $email = str_replace(' ','',$email);
    $email  = ucfirst(strtolower($email));
    $_SESSION['$reg_email'] =  $email; 
    

    //confirm email fileds
    $email2 = strip_tags($_POST['reg_email2']);
    $email2 = str_replace(' ','',$email2);
    $email2  = ucfirst(strtolower($email2));
    $_SESSION['$reg_email2'] =  $email2; 
    

    //password fileds
    $password = strip_tags($_POST['reg_password']);
    $_SESSION['$reg_password'] =  $password; 
    

    //confirm password fileds
    $password2 = strip_tags($_POST['reg_password2']);
    $_SESSION['$reg_password2'] =  $password2; 
    

    //date
    $date = date('Y-m-d');  //current date

    //email check
    if($email == $email2){
        //email in valid formate
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $email = filter_var($email,FILTER_VALIDATE_EMAIL);
            //check if email exits in database
            $e_check = mysqli_query($con,"SELECT email FROM users WHERE email = '$email'");
            //count number of rows return
            $num_rows = mysqli_num_rows($e_check);
            if($num_rows > 0){
                array_push($error_array, "Email allready in use<br>");
            }
        }else{
            array_push($error_array, "invalid Email formate<br>");
        }
    }else{
        array_push($error_array, "email dont match<br>");
    }
    // first name validatio
    if(strlen($fname) > 45 || strlen($fname) < 2){
        array_push($error_array,"first name must be between 2 to 45 characters<br>");
    }
    // first name validatio
    if(strlen($lname) > 45 || strlen($lname) < 2){
        array_push($error_array, "last name must be between 2 to 45 characters<br>");
    }
    //password validation
    if(strlen($password) > 45 || strlen($password) < 5){
        array_push($error_array, "password must be between 5 to 45 characotrs<br>");
    }
    //confirm password
    if($password != $password2){
        array_push($error_array, "password dont match<br>");
    }else{
        if(!preg_match('/[A-Za-z0-9]/',$password)){
            array_push($error_array,"your password only contain english characters and numbers<br>");
        }
    }

    //inserting valuse in database
    if(empty($error_array)){
        //password in md5
        $password = md5($password);
        //username Assignment
        $userName = strtolower($fname.'_'.$lname);
        $check_userName_query = mysqli_query($con,"SELLECT username FROM users WHERE username='$userName'");

        $i = 0;
        while( $check_userName_query != 0){
            $i++;
            $userName = $userName.'_'.$i;
            $check_userName_query = mysqli_query($con,"SELLECT username FROM users WHERE username='$userName'");

        }
        //profile pic assignment
        $rand = rand(1,2);
        if($rand == 1){
            $profile_pic = "assets/images/profile_pics/defaults/head_wisteria.png";
        }else{
            $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
        }

        //inserting data in database
        $query = mysqli_query($con,"INSERT INTO users VALUES ('','$fname','$lname','$userName','$email','$password','$date','$profile_pic','0','0','no',',') ");
        array_push($error_array,"You all set go ahead login</br>");
        $_SESSION['$reg_fname'] =   '';
        $_SESSION['$reg_lname'] =   '';
        $_SESSION['$reg_email'] =   '';
        $_SESSION['$reg_email2'] =   '';

    }


}
?>