<?php

include('server.php');

session_start();

$debug = "";

$survey_url = "";
$response_id = "";
$survey_title = "";
$survey_desc = "";
$type11q = "";
$type12q = "";
$type2q = "";
$type11ans = "";
$type12ans = "";
$type2ans = "";
$type11_err = "";
$type12_err = "";
$type2_err = "";

if(isset($_GET['survey_url']) && isset($_GET['response_id']))
{
    $debug = "yes set";
  $survey_url = mysqli_real_escape_string($db, $_GET['survey_url']);
  $response_id = mysqli_real_escape_string($db, $_GET['response_id']);
  $check_url = "SELECT * FROM surveys WHERE survey_url='$survey_url'";
  $yes_url = mysqli_query($db, $check_url);
  $survey_info = mysqli_fetch_assoc($yes_url);
  $match  = mysqli_num_rows($yes_url);
  if($match > 0)
  {
    $survey_title = $survey_info['survey_title'];
    $survey_desc = $survey_info['survey_desc'];

    $type11table = "SELECT question FROM type11 WHERE survey_url='$survey_url'";
    $table_11 = mysqli_query($db, $type11table);
    $type11table_entries = mysqli_fetch_assoc($table_11);
    $type11q = $type11table_entries['question'];

    $type12table = "SELECT question FROM type12 WHERE survey_url='$survey_url'";
    $table_12 = mysqli_query($db, $type12table);
    $type12table_entries = mysqli_fetch_assoc($table_12);
    $type12q = $type12table_entries['question'];

    $type2table = "SELECT question FROM type2 WHERE survey_url='$survey_url'";
    $table_2 = mysqli_query($db, $type2table);
    $type2table_entries = mysqli_fetch_assoc($table_2);
    $type2q = $type2table_entries['question'];

    $debug = "found match";

  }

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(empty($_POST["type11ans"]))
    {
      $type11_err = "Please enter a value between 1 and 5.";
    }
    else
    {
      $type11ans = $_POST['type11ans'];
      $debug = "found type11ans";
      echo '<h1>'.$type11ans.'</h1>';
      if($type11ans > 5 || $type11ans < 1)
      {
        $type11_err = "You must enter an integer between 1 and 5.";
        $type11ans = "";
      }
    }

    if(empty($_POST["type12ans"]))
    {
      $type12_err = "Please enter a value between 1 and 5.";
    }
    else
    {
      $type12ans = $_POST['type12ans'];
      if($type12ans > 5 || $type12ans < 1)
      {
        $type12_err = "You must enter an integer between 1 and 5.";
        $type12ans = "";
      }
    }

    if(!empty($_POST['type2ans']))
    {
      $type2ans = mysqli_real_escape_string($db, $_POST['q3']);
      if(strlen($type2ans) < 10)
      {
        $type2_err = "Your answer must be at least 10 characters long.";
        $type2ans = "";
      }
    }
    else
    {
      $type2_err = "Please answer the question.";
    }

    if(!empty($type11ans) && !empty($type12ans) && !empty($type2ans))
    {
      $submit_survey = "UPDATE recipients SET type11ans='".$type11ans."', type12ans='".$type12ans."', type2ans='".$type2ans."'
        WHERE response_id='".$response_id."'";
      mysqli_query($db, $submit_survey);
    }
  }

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
          <form action="takesurvey.php" method="post">
          <fieldset class="take">
            <br>
            <div class="form-group  <?php echo (!empty($type11_err)) ? 'has-error' : ''; ?>">
              <label><?php echo $type11q ?></label>
              <br>
              <input type="number" class="input" name="type11ans" placeholder="Please enter a value between 1 and 5." value="<?php echo $type11ans; ?>"/>
              <br>
            <span class="help-block"><?php echo $type11_err; ?></span>
            <br>
            </div>
            <br>
            <div class="form-group  <?php echo (!empty($type12_err)) ? 'has-error' : ''; ?>">
              <label><?php echo $type12q ?></label>
              <br>
              <input type="number" class="input" name="type12ans" placeholder="Please enter a value between 1 and 5." value="<?php echo $type12ans; ?>"/>
              <br>
            <span class="help-block"><?php echo $type12_err; ?></span>
            <br>
            </div>
            <div class="form-group  <?php echo (!empty($type2_err)) ? 'has-error' : ''; ?>">
              <label><?php echo $type2q ?></label>
              <br>
              <textarea type="date" class="textbox" name="type2ans" maxlength="500" rows="10" cols="50" placeholder="Enter your text answer." value="<?php echo $type2ans; ?>"></textarea>
            <span class="help-block"><?php echo $type2_err; ?></span>
            <br>
            </div>

            <div class="button">
                <input type="submit" name="submit" id="submit" class="submit" value="Submit"/>
              </a>
            </div>
          </fieldset>
        </form>
    </div>

  </body>
<footer>Copyright &copy; COP4710<br>
</footer></html>