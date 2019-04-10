<?php

include('server.php');

$survey_url = "";
$responder = "";

if(isset($_GET['url']) && isset($_GET['responder']))
{
  $survey_url = mysqli_real_escape_string($db, $_GET['url']);
  $responder = mysqli_real_escape_string($db, $_GET['responder']);
  $check_url = "SELECT survey_url FROM surveys WHERE survey_url='$survey_url'";
  $yes_url = mysqli_query($db, $check_url);
  $match  = mysqli_num_rows($yes_url);
  if($match > 0)
  {
    $new_table = "INSERT INTO answers (survey_url, responder) VALUES ('$survey_url', '$responder')";
    $new_answer = mysqli_query($db, $new_table);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css" type="text/css">
      <title>Survey <?php echo $survey_url ?></title>
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

    <div class="home-page">
      <form>
      <h1>Survey</h1>
      <p>Survey Description</p>
      <br>
      <script>
        // Set the date we're counting down to
        var countDownDate = new Date("April 11, 2019 16:00:00").getTime();
        // Update the count down every 1 second
        var x = setInterval(function()
        {
          // Get todays date and time
          var now = new Date().getTime();
          // Find the distance between now an the count down date
          var distance = countDownDate - now;
          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
          // Display the result in the element with id="demo"
          document.getElementById("demo").innerHTML = days + "d " + hours + "h "
          + minutes + "m " + seconds + "s ";
          // If the count down is finished, write some text
          if (distance < 0)
          {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
          }
        }, 1000);
      </script>
      <-- insert here how to load the various numbers of questions /
      figure it'd be something like: for each column in survey table with stuff in it,
      load content of that column and make input space for it -->
      <p>Question 1</p>
      <input type="radio" name="radio" value="1">1 <input type="radio" name="radio"
      value="2">2 <input type="radio" name="radio" value="3">3 <input type="radio"
      name="radio" value="4">4 <input type="radio" name="radio" value="5">5 <br>
      <p>Question 2</p>
      <textarea maxlength="200" rows="10" cols="50"></textarea><br>
      <br>
      <input type="submit" value="Submit"> </form>
    </div>
  </body>
  <footer>Copyright &copy; COP4710<br></footer>
</html>
