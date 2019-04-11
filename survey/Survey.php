<?php

include('server.php');

$survey_url = "";
$response_id = "";
$type11q = "";
$type12q = "";
$type2q = "";
$type11ans = 0;
$type12ans = 0;
$type2ans = "";
$type11_err = "";
$type12_err = "";
$type2_err = "";

if(isset($_GET['url']) && isset($_GET['response_id']))
{
  $survey_url = mysqli_real_escape_string($db, $_GET['url']);
  $response_id = mysqli_real_escape_string($db, $_GET['response_id']);
  $check_url = "SELECT survey_url FROM surveys WHERE survey_url='$survey_url'";
  $yes_url = mysqli_query($db, $check_url);
  $survey_info = mysqli_fetch_assoc($yes_url);
  $match  = mysqli_num_rows($yes_url);
  if($match > 0)
  {
    $survey_title = $survey_info['survey_title'];
    $survey_desc = $survey_info['survey_desc'];

    $type11table = "SELECT question FROM type11 WHERE survey_url='$survey_url'";
    $type11table_entries = mysqli_fetch_assoc($type11table);
    $type11q = $type11table_entries['question'];

    $type12table = "SELECT question FROM type12 WHERE survey_url='$survey_url'";
    $type12table_entries = mysqli_fetch_assoc($type12table);
    $yes_type12 = mysqli_num_rows($type12table_entries);
    if($yes_type12 > 0)
    {
      $type12q = $type12table_entries['question'];
    }

  }
}
else
{

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./style.css" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>Survey<?php echo $survey_url ?></title>
  <script>
      function countChar(val) {
        var len = val.value.length;
        if (len >= 200) {
          val.value = val.value.substring(0, 200);
        } else {
          $('#charNum').text(200 - len);
        }
      };
    </script>
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

<div class="survey-page">
  <h1><?php echo $survey_title ?></h1>
  <p><?php echo $survey_desc ?></p>
  <br>
  <form class="box">
  <div class="form-group">
    <h2>Question 1</h2>
    <p>
      <?php echo $type11q ?>
    </p>
    <p>
      1 = Strongly Disagree -> 5 = Strongly Agree
    </p>
    <br>
    <br>
    <div class="slidecontainer">
      <input type="range" min="1" max="5" step="1" value="3" id="q1" name="passengers" onchange='document.getElementById("bar1").value = "Value = " + document.getElementById("q1").value;'/>
      <input type="show" name="bar1" id="bar1" value="Value = 3" disabled />
    </div>
  </div>
  <br>
  <div class="form-group">
    <h2>Question 2</h2>
    <p>
      <?php echo $type12q ?>
    </p>
    <p>
      1 = Strongly Disagree -> 5 = Strongly Agree
    </p>
    <br>
    <br>
    <div class="slidecontainer">
      <input type="range" min="1" max="5" step="1" value="3" id="q2" name="passengers" onchange='document.getElementById("bar2").value = "Value = " + document.getElementById("q2").value;'/>
      <input type="show" name="bar2" id="bar2" value="Value = 3" disabled />
    </div>
  </div>
  <br>
  <div class="form-group">
    <h2>Question 3</h2>
    <p>
      <?php echo $type2q ?>
    </p>
    <br>
    <br>
    <textarea maxlength="200" onkeyup="countChar(this)"rows="10" cols="50">
    </textarea><br>
    <div id="charNum" class="charNum"></div>
  </div>
  <br>

  <div class="padding-bottom">
    <input type="submit" value="Submit">
  </div>
  </form>
</div>
</body>
<footer>Copyright &copy; COP4710<br>
</footer></html>