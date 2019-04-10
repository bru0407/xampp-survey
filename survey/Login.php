<?php

session_start();

require_once "server.php";

 // Check if the user is already logged in, if yes then redirect him to welcome page
 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
 {
    echo ' <meta http-equiv="refresh" content="0;url=account.php">';
     exit;
 }

// Define variables and initialize with empty values
$username = "";
$password = "";
$username_err = "";
$password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{

    // Check if username is empty
    if(empty($_POST["username"]))
    {
        $username_err = "Please enter username.";
    }
    else
    {
        $username = mysqli_real_escape_string($db, $_POST['username']);
    }

   // Check if username is empty
    if(empty($_POST["password"]))
    {
      $password_err = "Please enter password.";
    }
    else
    {
      $password = mysqli_real_escape_string($db, $_POST['password']);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err))
    {
        $user_login = "SELECT username, pass, verified FROM user WHERE username ='$username'";
        $user_found_query = mysqli_query($db, $user_login);
        $user_found = mysqli_num_rows($user_found_query);
        $user_found_array = mysqli_fetch_assoc($user_found_query);
        if($user_found > 0)
        {
          if(password_verify($password, $user_found_array['pass']))
          {
            if($user_found_array['verified'] == 0)
            {
              ?><p>Please check your email and verify your account. </p><?php
                echo ' <meta http-equiv="refresh" content="4;url=login.php">';
            }
            else
            {
              session_start();
              // Store data in session variables
              $_SESSION['loggedin'] = true;
              $_SESSION['username'] = $username;

              // Redirect user to welcome page
              echo ' <meta http-equiv="refresh" content="0;url=account.php">';
            }
          }
          else
          {
            $_SESSION['password'] = $password;
            $_SESSION['hash'] = $user_found_array['pass'];
            $password_err = "Password incorrect.";
          }
        }
        else
        {
            ?><p>No user found. Would you like to <a href="registration.php">register an account?</a></p><?php
        }
    }
    // Close connection
    mysqli_close($db);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css" type="text/css">
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
                <a href="login.php">Login</a>
              <?php } else { ?>
                <a href="account.php">Account</a>
                <a href="createsurvey.php">Create Survey</a>
              <?php } ?>
            </div>
          </div>
        </ul>
      </div>
    </div>
    <div class="register-page">
      <h1>Login</h1>
      <form method="post">
        <fieldset class="field">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username:</label>
            <br>
            <input type="text" class="form-control" value="<?php echo $username; ?>" name="username" placeholder="Enter your username."/>
            <br>
            <span class="help-block"><?php echo $username_err; ?></span>
          </div>
          <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password:</label>
            <br>
            <input type="password" class="form-control" value="<?php echo $password; ?>" name="password" placeholder="Password"/>
            <br>
            <span class="help-block"><?php echo $password_err; ?></span>
          </div>
          <div class="button">
            <input type="submit" class="submit" value="Login"/>
          </div>
        </fieldset>
      </form>
      <p>Not a user? <a href="registration.php">Create an Account here</a></p>
    </div>
  </body>
  <footer>Copyright &copy; COP4710<br></footer>

</html>