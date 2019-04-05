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
    <title>Create Survey</title>
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
    <?php
      if(isset($_SESSION['username'])) : ?>
        <div class="createsurvey-page">
          <h1>Create Your Survey</h1>
          <form method="post">
          <fieldset class="create">
            <div class="form-group">
              <label>Survey Title:</label>
              <br>
              <input type="text" class="input" name="title" placeholder="Enter survey title."/>
              <br>
            </div>
            <div class="form-group">
              <label>Email:</label>
              <br>
              <input type="email" class="input" name="email" placeholder="Enter your email."/>
              <br>
            </div>
            <div class="form-group">
              <label>Password:</label>
              <br>
              <input type="password" class="input" name="password1" placeholder="Enter your password."/>
              <br>
            </div>
            <div class="form-group">
              <label>Confirm Password:</label>
              <br>
              <input type="password" class="input" name="password1" placeholder="Confirm password."/>
              <br>
            </div>
            <div class="button">
              <input type="submit" class="submit" value="Create Account"/>
            </div>
          </fieldset>
        </form>
    </div>
    <?php endif ?>
  </body>
<footer>Copyright &copy; COP4710<br></footer>
</html>