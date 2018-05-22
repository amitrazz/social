<?php 
require 'config/config.php';
require 'includes/form_handler/register_handler.php';
require 'includes/form_handler/login_handler.php';




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to social</title>
    <link rel="stylesheet" href="assets/css/register_style.css">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
    <?php 
    if(isset($_POST['reg_button'])){
        echo '
        <script>
            $(document).ready(function(){
                $("#login").hide();
                $("#register").show();
            });
        </script>
        
        ';
    }
   
    ?>
    <div class="wrapper">
        <div class="login_box">
            <div class="login_header">
                <h2>Social</h2>
                <h4>Login or Sign up below.</h4>
            </div>
            <div id="login">
                <form action="register.php" method="POST">
                    <input type="email" name="log_email" placeholder="Email" value="<?php if(isset($_SESSION['log_email'])) echo $_SESSION['log_email']; ?>" required >
                    <br>
                    <input type="password" name="log_password" placeholder="Password" >
                    <br>
                    <?php if(in_array("Email or password was incorrect<br>",$error_array)) echo "Email or password was incorrect<br>"; ?>    
                    <input type="submit" name="log_button" value="Login">
                    <br>
                    <a href="#" id="signup" class="signup">Need an account ? Register here</a>
                </form>
            </div>
           <div id="register">
            <form action="register.php" method="POST">
                    <input type="text" name="reg_fname" placeholder="First name" value="<?php if(isset($_SESSION['$reg_fname'])) echo $_SESSION['$reg_fname']; ?>" required>
                    <br>
                    <?php if(in_array("first name must be between 2 to 45 characters<br>",$error_array)) echo "first name must be between 2 to 45 characters<br>"; ?>
                    
                    <input type="text" name="reg_lname" placeholder="Last name" value="<?php if(isset($_SESSION['$reg_lname'])) echo $_SESSION['$reg_lname']; ?>" required>
                    <br>
                    <?php if(in_array("last name must be between 2 to 45 characters<br>",$error_array)) echo "last name must be between 2 to 45 characters<br>" ; ?>
                    
                    <input type="email" name="reg_email" placeholder= "email"  value="<?php if(isset($_SESSION['$reg_email'])) echo $_SESSION['$reg_email']; ?>" required>
                    <br>
                    <?php if(in_array("Email allready in use<br>",$error_array)) echo "Email allready in use<br>"; ?>
                    <?php if(in_array("invalid Email formate<br>",$error_array)) echo "invalid Email formate<br>" ; ?>

                    <input type="email" name="reg_email2" placeholder= "confirm email" value="<?php if(isset($_SESSION['$reg_email2'])) echo $_SESSION['$reg_email2']; ?>" required>
                    <br>
                    <?php if(in_array("email dont match<br>",$error_array)) echo "email dont match<br>"; ?>

                    <input type="password" name="reg_password" placeholder="Password" required>
                    <br>
                    <?php if(in_array("password must be between 5 to 45 characotrs<br>",$error_array)) echo "password must be between 5 to 45 characotrs<br>" ; ?>
                    <?php if(in_array("your password only contain english characters and numbers<br>",$error_array)) echo "your password only contain english characters and numbers<br>" ; ?>

                    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
                    <br>
                    <?php if(in_array("password dont match<br>",$error_array)) echo "password dont match<br>" ; ?>

                    <input type="submit" name="reg_button" value="register">
                    <br>
                    <?php if(in_array("You all set go ahead login</br>",$error_array)) echo "<span style='color:#14c800;'>You all set go ahead login</br><span>"; ?>
                    <br>
                    <a href="#" id="signin" class="signin">have an account ? Login here</a>
                    
                </form>
           </div>

            
        </div>
    </div>
</body>
</html>