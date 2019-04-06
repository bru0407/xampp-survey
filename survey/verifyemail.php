<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Style.css" type="text/css">
      <title>New User</title>
  </head>
  <body>
    <div class="header">
      <div class="inner_header">
        <div class="logo_container">
          <a href="/survey/home.php">
            <h1> <img src="http://www.flexrule.com/wp-content/uploads/2014/06/db.png" alt="" width="50" height="50">
              SurveyMaster
            </h1>
          </a>
        </div>
        <ul class="navigation">
          <div class="dropdown">
            <button class="dropbtn">Menu<i class="down"></i></button>
            <div class="dropdown-content">
              <?php if (empty($_SESSION['loggedin']) || !isset($_SESSION['loggedin'])) { ?>
                <a href="registration.php">Register</a>
                <a href="Login.php">Login</a>
              <?php } else { ?>
                <a href="account.php">Account</a>
                <a href="CreateSurvey.php">Create Survey</a>
              <?php } ?>
            </div>
          </div>
        </ul>
      </div>
    </div>
     
    <!-- start wrap div -->   
    <div id="wrap">
        <!-- start PHP code -->
        <?php
         if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['verify_hash']) && !empty($_GET['verify_hash']))
         {
            $user_email = mysqli_real_escape_string($db, $_GET['email']);
            $hash_verified = mysqli_real_escape_string($db, $_GET['verify_hash']);
            $find_query = "SELECT * FROM user WHERE email='$user_email' AND verify_hash='$hash_verified'";
            $search = mysqli_query($db, $find_query) or die("Could not verify url."); 
            $match  = mysqli_num_rows($search);
            if($match > 0)
            {
                $activate_query = "UPDATE user SET verified='1' WHERE email='".$user_email."' AND verify_hash='".$hash_verified."'";
                mysqli_query($db, $activate_query) or die(mysql_error());
                ?><p>Thank you for verifying your email address! You will be redirected to log in with your new credentials in a few seconds. </p><?php

                echo ' <meta http-equiv="refresh" content="4;url=login.php">';
            }
            else
            {
              echo '<p>Something has gone wrong! Make sure you have copied and pasted the url correctly. If error persists, go fuck yourself.</p>';
              echo '<meta http-equiv="refresh" content="4;url=registration.php">';
            }
            
          } ?>
        <!-- stop PHP Code -->
 
         
    </div>
    <!-- end wrap div --> 
</body>
</html>