<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="./Style.css" type="text/css">
  <head>
    <meta charset="UTF-8">
    <title>Survey</title>
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
            <?php if (empty($_SESSION['username'])) { ?>
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
