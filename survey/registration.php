<?php
// Include config file
require_once "server.php";
 
// Define variables and initialize with empty values
$username = "";
$email = ""; 
$password1 = "";
$password2 = "";
$username_err = "";
$email_err = ""; 
$password_err = "";
$confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Validate username
    if(empty($_POST["username"]))
    {
        $username_err = "Please enter a username.";
    } 
    else
    {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $user_check_query = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($db, $user_check_query); 
        $user = mysqli_fetch_assoc($result); 
        if($user['username'] === $username) 
        {
            $username_err = "Username already in use.";
        }
    }

    //Validate email
    if(empty($_POST["email"]))
    {
        $email_err = "Please enter an email.";
    } 
    else
    {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $email_err = "Please enter a valid email.";
        }
        else
        {
            $email_check_query = "SELECT * FROM user WHERE email = '$email' LIMIT 1";
            $result = mysqli_query($db, $user_check_query); 
            $user = mysqli_fetch_assoc($result); 
            if($user['email'] === $email) 
            {
                $email_err = "Email already in use.";
            }
        }
    }
    
    // Validate password
    if(empty($_POST["password1"]))
    {
        $password_err = "Please enter a password.";     
    } 
    else
    {
        $password1 = mysqli_real_escape_string($db, $_POST['password1']);
    }
    
    if(empty($_POST["password2"]))
    {
        $password_err = "Please confirm password.";     
    } 
    else
    {
        $password2 = mysqli_real_escape_string($db, $_POST['password2']);
        if($password1 != $password2)
        {
            $password_err = "Passwords do not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $passwords = md5($password1); //encrypt password
        $verify_hash = md5(rand(0,1000));
        $query = "INSERT INTO user (username, email, pass, verify_hash, verified) VALUES ('$username', '$email', '$passwords', '$verify_hash', 0)";
        mysqli_query($db, $query); 
        $_SESSION['username'] = $username; 
        $_SESSION['success'] = "Login successful.";

        require_once "Mail.php";  
        $from = "surveymasterdevteam@gmail.com"; 
        $to = $email;  
        $host = "ssl://smtp.gmail.com"; 
        $port = "465"; 
        
        $devemail = 'surveymasterdevteam@gmail.com'; 
        $password = 'devteam!';  
        $subject = "Email Verification for SurveyMaster"; 
        $body = '
    
        Thank you for signing up with SurveyMaster!
        Your account has been created. You will be able to login after you have activated your account by clicking the link below.
        
        Username: '.$username.'
        Password: '.$password1.'
        
        Please click this link to activate your account:
        localhost/survey/verifyemail.php?email='.$email.'&verify_hash='.$verify_hash.'
        
        ';

        $headers = array ('From' => $from, 'To' => $to,'Subject' => $subject); 
        $smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $devemail, 'password' => $password));  
        $mail = $smtp->send($to, $headers, $body);  
        
        echo ' <meta http-equiv="refresh" content="0;url=account.php">';
        }
        
        // Close connection
        mysqli_close($db);
}
?>
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

    <div class="register-page">
      <h1>Create Account</h1>
        <form novalidate action="registration.php" method="post">
        <fieldset class="field">
          <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <img src="user.png" alt="" height="180" class="user-img">
            <br>
            <label>Username:</label>
            <br>
            <input type="text" class="input" name="username" placeholder="Enter your username." value="<?php echo $username; ?>"/>
            <br>
            <span class="help-block"><?php echo $username_err; ?></span>
            <br>
          </div>
          <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <label>Email:</label>
            <br>
            <input type="email" class="input" name="email" placeholder="Enter your email." value="<?php echo $email; ?>"/>
            <br>
            <span class="help-block"><?php echo $email_err; ?></span>
            <br>
          </div>
          <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password:</label>
            <br>
            <input type="password" class="input" name="password1" placeholder="Enter your password." value="<?php echo $password1; ?>"/>
            <br>
            <span class="help-block"><?php echo $password_err; ?></span>
            <br>
          </div>
          <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Confirm Password:</label>
            <br>
            <input type="password" class="input" name="password2" placeholder="Confirm password." value="<?php echo $password2; ?>"/>
            <br>
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
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