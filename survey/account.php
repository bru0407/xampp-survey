<?php
include "server.php";
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
  <?php

    $username = $_SESSION['username'];
    $results_page = "results.php?=";

    $survey_table = "SELECT * FROM surveys WHERE username ='$username'";
    $user_surveys = mysqli_query($db, $survey_table);
    $num_surveys = mysqli_num_rows($user_surveys);

    //Count the returned rows
    if ($num_surveys > 0)
    {
    //Turn results into an array
         echo "<table>
            <tr>
                <th>Survey Title</th>
                <th>Survey Description</th>
                <th>Survey Due</th>
                <th>Results</th>
            </tr>";
        while($row = mysqli_fetch_array($user_surveys))
        {

             $survey_title = $row['survey_title'];
             $survey_desc = $row['survey_desc'];
             $survey_due = $row['due_date'];
             $survey_url = $row['survey_url'];
             $survey_results = $results_page.$survey_url;

             echo
             "<tr>

             <td>" . $survey_title . "</td>
             <td>" . $survey_desc . "</td>
             <td>" . $survey_due . "</td>
             <td><a href=\"" . $survey_results . "\">Results</a></td>
             </tr>";
         }
         echo "</table>";
    } else {
         echo "0 results";
    }

    ?>
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