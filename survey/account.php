<?php include('server.php') ?>
<?php
if(!(isset($_SESSION['username'])))
{
  $_SESSION['msg'] = "You must log in to view this page.";
  header("location: /survey/login.php");
}
if(isset($_GET['logout']))
{
  session_destroy();
  unset($_SESSION['username']);
  header("location: /survey/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Style.css" type="text/css">
    <title>Account</title>
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
              <?php if (empty($_SESSION['username'])) { ?>
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
      <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
      <br>
      <button type="logout">
        <a href="logout.php?logout='1'">Logout</a>
      </button>
        
  </body>
<footer>Copyright &copy; COP4710<br></footer>
</html>