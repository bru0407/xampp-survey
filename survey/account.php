<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css" type="text/css">
    <title>Account</title>
  </head>
  <body>
    <div class="header">
    <div class="inner_header">
      <div class="logo_container">
        <a href="/survey/home.php">
          <img src="https://cdn.pixabay.com/photo/2017/05/15/23/48/survey-2316468_1280.png" alt="" width="50" height="50">
           <h1>
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
              <a href="logout.php">Logout</a>
              <?php } ?>
          </div>
        </div>
      </ul>
    </div>
  </div>

    <div class="account-page">
      <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
      <br>

      <div class="form-group">
        <input type="text" id="myInput" onkeyup="search()" placeholder="Search for names..">

        <table id="myTable">
          <tr class="header">
            <th class="account-top" style="width:60%;">Name</th>
            <th class="account-top" style="width:40%;">Country</th>
          </tr>
          <tr>
            <td>Alfreds Futterkiste</td>
            <td>Germany</td>
          </tr>
          <tr>
            <td>Berglunds snabbkop</td>
            <td>Sweden</td>
          </tr>
          <tr>
            <td>Island Trading</td>
            <td>UK</td>
          </tr>
          <tr>
            <td>Koniglich Essen</td>
            <td>Germany</td>
          </tr>
        </table>
      </div>

      <button class="btn">
        <a href="logout.php" class="btn btn-danger">Logout</a>
      </button>
    </div>

    <script>
      function search() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[0];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }
    </script>

  </body>
<footer>Copyright &copy; COP4710<br></footer>
</html>