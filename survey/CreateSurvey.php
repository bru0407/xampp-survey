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
  
    .header 
    {
      width: 100%;
      height: 80px;
      display: block;
      background-image: linear-gradient(60deg, #96deda 0%, #50c9c3 100%);
    }

    .inner_header 
    {
      width: 100%;
      height: 100%;
      display: auto;
      margin: 0 auto;
    }

    .logo_container 
    {
      height: 100%;
      display: table;
      float: left;
    }

    .logo_container h1 
    {
      color: white;
      height: 100%;
      display: table-cell;
      vertical-align: middle;
      font-size: 32px;
    }

    .logo_container h1 span
    {
      color:#FFFFFF;
      font-weight: 800;
    }

    .navigation 
    {
      float: right;
      height: 100%;
    }

    .navigation a 
    {
      height: 100%;
      display: table;
      float: left;
      padding: 0px 20px;
    }

    .navigation a:last-child 
    {
      padding-right: 0;
    }

    .navigation a li
    {
      display: table-cell;
      vertical-align: middle;
      height: 100%;
      color: white;
      font-size: 16px;
    }

    .dropdown
    {
      float:left;
      overflow: hidden;
    }

    .dropdown .dropbtn
    {
      font-size: 40px;  
      border:none;
      outline: none;
      color: white;
      padding: 14px 16px;
      background-color: inherit;
      font-family: inherit;
      margin: 0;
    }

    .dropdown-content
    {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-content a
    {
      float:none;
      color:black;
      padding: 12px 16px;
      display:block;
      text-align:left;
      border-style:double;
    }

    .dropdown:hover .dropbtn
    {
      background-color:black;
    }
    .dropdown:hover .dropdown-content 
    {
      display: block;
    }
  </style>     
    <head>
    <meta charset="UTF-8">
    <title>Create Survey</title>
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
  <?php 
    if(isset($_SESSION['username'])) : ?> 
      <h3>Welcome <?php echo $_SESSION['username']; ?></h3>
      <button><a href="home.php?logout='1'">Logout</a></button>          
    <?php 
      if(isset($_SESSION['success'])) : ?> 
        <div class="create">
          <h1>Create your own survey</h1>
          <p>In the text box provide below, type two questions that you would like our team to create survey out of.</p>
          <textarea maxlength="200" rows="10" cols="50"></textarea><br>
          <input type="submit" value="Submit">  <br>
          <?php 
            echo $_SESSION['success'];
            unset($_SESSION['success']);
          ?>
        </div>
      <?php endif ?>
    <?php endif ?>     
  </body>
<footer>Copyright &copy; COP4710<br></footer>
</html>