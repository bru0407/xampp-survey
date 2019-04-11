<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css" type="text/css">
      <title>Login</title>
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
                <a href="login.php">Login</a>
              <?php } else { ?>
                <a href="account.php">Account</a>
                <a href="createsurvey.php">Create Survey</a>
              <?php } ?>
            </div>
          </div>
        </ul>
      </div>
    </div>

    <!-- start wrap div -->
    <div id="wrap">
        <!-- start PHP code -->
        <?php
        //  if(isset($_GET['url']) && !empty($_GET['url']))
        //  {
            // $survey_url = mysqli_real_escape_string($db, $_GET['url']);
            $type11mean = "SELECT AVG(type11ans) FROM recipients WHERE survey_url='1'";
            $type11var = "SELECT VARIANCE(type11ans) FROM recipients WHERE survey_url='1'";
            $type12mean = "SELECT AVG(type12ans) FROM recipients WHERE survey_url='1'";
            $type12var = "SELECT VARIANCE(type12ans) FROM recipients WHERE survey_url='1'";
            $type2ans = "SELECT * FROM recipients WHERE survey_url='1'";

            $one1mean = mysqli_query($db, $type11mean);
            $one1meaninfo = mysqli_fetch_assoc($one1mean);
            $mean1 = $one1meaninfo['AVG(type11ans)'];

            $one1var = mysqli_query($db, $type11var);
            $one1varinfo = mysqli_fetch_assoc($one1var);
            $var1 = $one1varinfo['VARIANCE(type11ans)'];

            $one2mean = mysqli_query($db, $type12mean);
            $one2meaninfo = mysqli_fetch_assoc($one2mean);
            $mean2 = $one2meaninfo['AVG(type12ans)'];

            $one2var = mysqli_query($db, $type12var);
            $one2varinfo = mysqli_fetch_assoc($one2var);
            $var2 = $one2varinfo['VARIANCE(type12ans)'];

            $type2qs = mysqli_query($db, $type2ans);

            $match  = mysqli_num_rows($type2qs);
            if($match > 0)
            {
                //Turn results into an array
                    echo "<table>
                        <tr>
                            <th>Q1 Mean</th>
                            <th>Q1 Var</th>
                            <th>Q2 Mean</th>
                            <th>Q2 Var</th>
                            <th>List Answers</th>
                        </tr>";


                        echo
                        "<tr>

                        <td>" . $mean1 . "</td>
                        <td>" . $var1 . "</td>
                        <td>" . $mean2 . "</td>
                        <td>" . $var2 . "</td>

                        </tr>";
                    }
                    echo "</table>";
            // INSERT LINK BACK TO ACCOUNT
             ?>
        <!-- stop PHP Code -->


    </div>
    <!-- end wrap div -->
</body>
</html>