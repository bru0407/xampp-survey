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

    <div class="register-page">
      <h1>Create Account</h1>
        <form novalidate action="registration.php" method="post">
        <?php include('errors.php') ?>
        <fieldset class="field">
          <div class="form-group">
            <img
            src="user.png"
            alt=""
            height="180"
            class="user-img"
            >

            <br>

            <label>Username:</label>
            <br>
            <input type="text" class="input" name="username" placeholder="Enter your username."/>
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
      <p>Already a user? <a href="Login.php">Login</a></p>
    </div>
  </body>
  <footer>Copyright &copy; COP4710<br></footer>
</html>