<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
    echo ' <meta http-equiv="refresh" content="0;url=login.php">';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Style.css" type="text/css">
    <title>Account</title>
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
      <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
      <br>
      
      <table id ="table">
          <tr>
              <td>Survey Title</td>
              <td>Answer Type 1-1</td>
              <td>Answer Type 1-2</td>
              <td>Answer Type 2</td>
              <td>Start Date</td>
              <td>End Date</td>
          </tr>
         function addRows() {
  var table = document.getElementById( 'table' ),
      row = table.insertRow(0),
      cell1 = row.insertCell(0),
      cell2 = row.insertCell(1),cell3 = row.insertCell(2),
      cell4 = row.insertCell(3),cell5 = row.insertCell(4),
      cell6 = row.insertCell(5);

  cell1.innerHTML = 'Cell 1';
  cell2.innerHTML = 'Cell 2';
  cell3.innerHTML = 'Cell 3';
  cell4.innerHTML = 'Cell 4';
  cell5.innerHTML = 'Cell 5';
  cell6.innerHTML = 'Cell 6';
}
      <a href="logout.php" class="btn btn-danger">Logout</a>
  </body>
<footer>Copyright &copy; COP4710<br></footer>
</html>
