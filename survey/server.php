<?php

 session_start(); 

// //initiatializing variables

$username = ""; 
$email = ""; 

$errors = array(); 

//Connect to DB

$db = mysqli_connect('localhost', 'root', '', 'surveyusers') or die("Could not connect to database"); 

// //Registering users
if(isset($_POST['username'])) {$username = mysqli_real_escape_string($db, $_POST['username']);}
if(isset($_POST['email'])) {$email = mysqli_real_escape_string($db, $_POST['email']);}
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
    $query = "INSERT INTO user (username, email, pass) VALUES ('$username', '$email', '$passwords')";
    mysqli_query($db, $query); 
    $_SESSION['username'] = $username; 
    $_SESSION['success'] = "Login successful.";
    
    header("location: CreateSurvey.php"); 
}

?>