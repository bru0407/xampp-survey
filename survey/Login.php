<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
  <style>
    body
    {
      background-image: linear-gradient(60deg, #96deda 0%, #50c9c3 100%);
    }
    h1
    {
      color:#FFFFFF;
      font-family:cursive;
      text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    }

    input[type=text]
    {
      border:2px solid black;
      border-radius:4px;
    }

    input[type=password]
    {
      border:2px solid black;
      border-radius:4px;
    }

    input[type=submit]
    {
      background-color:black;
      font-family:cursive;
      text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
      color:#F8F8FF;
    }

    label
    {
      font-family:cursive;
      color:#F8F8FF;
      text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    }

    h2
    {
      font-family:cursive;
      color:black;
      text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
    }

    button
    {
      background-color:black;
      font-family:cursive;
      text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
      color:#F8F8FF;
    }

    fieldset
    {
      border-width:20px;
      border-style:solid;
      border-color:#6a7e81;
      margin:auto;
    }

    footer
    {
      font-size:75%;
      font-style:italic;
      font-family:georgia;
      text-align:center;
      padding-top: 135px;
    }

    /* Login Page */
    .login-page 
    {
      text-align: center;
    }

    .login-page h1
    {
      color:#F8F8FF;
      font-family:cursive;
    }

    .field
    {
      width: 50%;
      margin: auto;
      padding-top: 20px;
      padding-bottom: 10px;
    }

    .button
    {
      padding-top: 10px;
      padding-bottom: 10px;
    }   

    .form-group
    {
      padding: 5px;
    }

    .input
    {
      width: 50%;
      height: 20px;
    }

    .images
    {
      position:relative;
      display:inline-block;
    }

    .images p
    {
      position:relative;
      width:100;
      text-align:center;
      left:0;
      color:black;
      font-family:cursive;
    }
  </style>
  <head>
    <meta charset="UTF-8">
    <title>Current User</title>
  </head>
  <body>
    <div class="header">
      <div class="inner_header">
        <div class="logo_container">
          <a href="/survey/registration.php">
            <h1> <img src="/Images/DB.png" alt="" width="50" height="50">
              Survey<span>Master</span>
            </h1>
          </a>
        </div>
        <ul class="navigation">
          <div class="dropdown">
            <button class="dropbtn">Menu<i class="down"></i></button>
            <div class="dropdown-content">
              <a href="registration.php">Register</a>
              <a href="CreateSurvey.php">Create Survey</a>
              <a href="Login.php">Login</a>
            </div>
          </div>
        </ul>
      </div>
    </div>
    <div class="register-page">
      <h1>Login</h1>
      <form method="post">
        <fieldset class="field">
          <div class="form-group">
            <label>Username:</label>
            <br>
            <input type="text" class="input" name="username" placeholder="Enter your username."/>
            <br>
          </div>
          <div class="form-group">
            <label>Password:</label>
            <br>
            <input type="password" class="input" name="password1" placeholder="Password"/>
            <br>
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