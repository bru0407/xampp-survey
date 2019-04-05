<?php

 session_start(); 

// //initiatializing variables

$username = ""; 
$email = ""; 

$errors = array(); 

//Connect to DB

$db = mysqli_connect('localhost', 'root', '', 'surveyusers') or die("Could not connect to database"); 

// //Registering users
if(isset($_POST['username'])) 
{
    $username = mysqli_real_escape_string($db, $_POST['username']);
    if(empty($username)) 
    {
        array_push($errors, "Username is required");
        unset($_POST['username']); 
    }
}
if(isset($_POST['email'])) 
{
    $email = mysqli_real_escape_string($db, $_POST['email']);
}
if(isset($_POST['password1'])) {$password1 = mysqli_real_escape_string($db, $_POST['password1']);}
if(isset($_POST['password2'])) {$password2 = mysqli_real_escape_string($db, $_POST['password2']);}

//Form validation

if(empty($username)) {array_push($errors, "Username is required");}
if(empty($email)) {array_push($errors, "Email is required");}
if(empty($password1)) {array_push($errors, "Password is required");}
if((!(empty($password1))) && (!(empty($password2))) && ($password1 != $password2)) {array_push($errors, "Passwords do not match");}

//check database for existing user with same username
$user_check_query = "SELECT * FROM user WHERE username = '$username' or email = '$email' LIMIT 1";
$result = mysqli_query($db, $user_check_query); 
$user = mysqli_fetch_assoc($result); 

if($user)
{
    if($user['username'] === $username) {array_push($errors, "Username already exists.");}
    if($user['email'] === $email) {array_push($errors, "Email already in use.");}
}

// Register user if no errors
if(count($errors) == 0)
{
    $passwords = md5($password1); //encrypt password
    $verify_hash = md5(rand(0,1000));
    $query = "INSERT INTO user (username, email, pass, verify_hash, verified) VALUES ('$username', '$email', '$passwords', '$verify_hash', 0)";
    mysqli_query($db, $query); 
    $_SESSION['username'] = $username; 
    $_SESSION['success'] = "Login successful.";

    require_once "Mail.php";  
    $from = "surveymasterdevteam@gmail.com"; 
    $to = $_POST['email'];  
    $host = "ssl://smtp.gmail.com"; 
    $port = "465"; 
    
    $username = 'surveymasterdevteam@gmail.com'; 
    $password = 'devteam!';  
    $subject = "Email Verification for SurveyMaster"; 
    $body = '
 
    Thank you for signing up with SurveyMaster!
    Your account has been created. You will be able to login after you have activated your account by clicking the link below.
    
    Username: '.$name.'
    Password: '.$password1.'
     
    Please click this link to activate your account:
    localhost/survey/verifyemail.php?email='.$email.'&hash='.$verify_hash.'
     
    ';

    $headers = array ('From' => $from, 'To' => $to,'Subject' => $subject); 
    $smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));  
    $mail = $smtp->send($to, $headers, $body);  
    
    // if (PEAR::isError($mail)) 
    // { 
    //     echo($mail->getMessage()); 
    // } 
    // else 
    // { 
    //     echo("Message successfully sent!\n"); 
    // } 
    
    header("location: CreateSurvey.php"); 
}

?>