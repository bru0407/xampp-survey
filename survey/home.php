<?php
session_start();
// Include config file
require_once "server.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./Style.css" type="text/css">
  <title>Home Page</title>
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


<div class="home-page">
  <h1>SurveyMaster</h1>
  <h2>Home of award winning surveys</h2>
  <br>
  <div class="wallpaper">
      <img
        src="home.jpg"
        alt=""
        class="home-picture"
      >
      <button class="btn">
        <?php if (empty($_SESSION['loggedin']) || !isset($_SESSION['loggedin'])) { ?>
            <a href="Login.php">Start Here</a>
        <?php } else { ?>
            <a href="CreateSurvey.php">Start Here</a>
        <?php } ?>
      </button>
  </div>

  <div class="row">
    <h1>Acknowledgements</h1>
    <div class="column">
      <img
        src="https://www.svgrepo.com/show/49676/climbing.svg"
        alt=""
        class="award"
        width="100"
        height="auto"
      >
      <h2>Rising</h2>
      <h2>Award</h2>
    </div>
    <div class="column">
      <img
        src="https://png.pngtree.com/svg/20161018/e4ea6b608b.png"
        alt=""
        class="award"
        width="100"
        height="auto"
      >
      <h2>Backpack</h2>
      <h2>Award</h2>
    </div>
    <div class="column">
      <img
        src="https://www.codot.gov/business/civilrights/assets/team-icon.png/image"
        alt=""
        class="award"
        width="100"
        height="auto"
      >
      <h2>Diversity</h2>
      <h2>Award</h2>
    </div>
  </div>

</div>

<footer>Copyright &copy; COP4710<br>
</footer>
</html>