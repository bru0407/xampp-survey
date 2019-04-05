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
              <?php if (empty($_SESSION['id'])) { ?>
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
         $verified="false"; 
         if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['verify_hash']) && !empty($_GET['verify_hash']))
         {
            echo "<h1>Maaaaaybe?</h1>";
            $find_query = "SELECT email, verify_hash FROM user WHERE email='".$email."' AND verify_hash='".$verify_hash."'";
            $search = mysqli_query($db, $find_query) or die("Could not verify url."); 
            $match  = mysqli_num_rows($search);
            if($match > 0)
            {
                echo "<h1>Please..............</h1>";
                $activate_query = "UPDATE user SET verified='1' WHERE email='".$email."' AND verify_hash='".$verify_hash."'";
                mysqli_query($db, $activate_query) or die(mysql_error());
                $verified = "true";
            }   
            
          } ?>
         <?php if($verified=="true") : ?>
          <h1>WHY IFJEKDLFJSK </h1>
        <?php endif; ?>
        <!-- stop PHP Code -->
 
         
    </div>
    <!-- end wrap div --> 
</body>
</html>