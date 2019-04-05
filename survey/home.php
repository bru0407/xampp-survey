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

    /* Home Page */
    .home-page 
    {
      text-align: center;
    }

    .home-page h1
    {
      color:#F8F8FF;
      font-family:cursive;
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
    <title>Home Page</title>
  </head>
  <body>
    <div style="width:800px; margin:0 auto;">
      <h1>Welcome to SurveyMaster</h1>
    <div class="images">
      <a href="Login.php"><img src="/Images/Survey.png" alt="" width="200"height="200">
      <p>Member Login</p>
      </div>
      <div class="images">
      <a href="CreateAccount.php"><img src="/Images/NewUser.png" alt="" width="200"height="200">
      <p>New User</p>
    </div>
  </div>

<footer>Copyright &copy; COP4710<br>
</footer>
</html>
