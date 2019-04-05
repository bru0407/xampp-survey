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

    /* Register Page */
    .register-page
    {
      text-align: center;
    }
  
    .register-page h1
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
              <a href="registration.php">Register</a>
              <a href="CreateSurvey.php">Create Survey</a>
              <a href="Login.php">Login</a>
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
