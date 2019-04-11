<?php
session_start();
// Include config file
require_once "server.php";
if(isset($_GET['logout']))
{
  session_destroy();
  unset($_SESSION['username']);
  header("location: /survey/login.php");
}
// Define variables and initialize with empty values
$username = $_SESSION['username'];
$survey_desc = "";
$survey_title = "";
$due_date = "";
$type11 = "";
$type12 = "";
$type2 = "";
$title_err = "";
$desc_err = "";
$survey_url = "";
$due_err = "";
$type11_err = "";
$type12_err = "";
$type2_err = "";

function makeURL()
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    while (1)
    {
        $key = '';
        for ($i = 0; $i < 10; $i++) {
            $key .= substr($chars, (random_int(0, 255) % (strlen($chars))), 1);
        }
        break;
    }
    return $key;
}
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  // Validate username
  if(empty($_POST["survey_title"]))
  {
    $title_err = "Please enter a title for your survey.";
  }
  else
  {
    $survey_title = mysqli_real_escape_string($db, $_POST['survey_title']);
  }

  if(!empty($_POST["survey_desc"]))
  {
    $survey_desc = mysqli_real_escape_string($db, $_POST['survey_desc']);
  }

  //generate url
  do
  {
    $random_url = makeURL();
    $url_check_query = "SELECT * FROM surveys WHERE survey_url = '$random_url' LIMIT 1";
    $url_check_result = mysqli_query($db, $url_check_query);
    $url_survey = mysqli_fetch_assoc($url_check_result);
  } while($url_survey['survey_url'] == $random_url);
  $survey_url = $random_url;

  if(empty($_POST["due_date"]))
  {
    $due_err = "You must enter for how many days the survey will be open.";
  }
  else
  {
    $due_date = $_POST['due_date'];
    if($due_date > 10 || $due_date < 0)
    {
      $due_err = "You must enter an integer between 0 and 10.";
      $due_date = "";
    }
  }

  if(empty($_POST["type11"]))
  {
    $type11_err = "You must enter a first question of type 1.";
  }
  else
  {
    $type11 = mysqli_real_escape_string($db, $_POST['type11']);
  }

  if(empty($_POST["type12"]))
  {
    $type12_err = "You must enter a second question of type 1.";
  }
  else
  {
    $type12 = mysqli_real_escape_string($db, $_POST['type12']);
  }

  if(empty($_POST["type2"]))
  {
    $type2_err = "You must enter a type 2 question.";
  }
  else
  {
    $type2 = mysqli_real_escape_string($db, $_POST['type2']);
  }


  if(!empty($survey_url) && !empty($due_date) && !empty($type11) && !empty($type12) && !empty($type2))
  {
    $insert_survey = "INSERT INTO surveys (username, survey_url, survey_title, survey_desc, due_date) VALUES ('$username',
      '$survey_url', '$survey_title', '$survey_desc', '$due_date')";
    mysqli_query($db, $insert_survey);
    $insert_type11 = "INSERT INTO type11 (survey_url, question) VALUES ('$survey_url', '$type11')";
    mysqli_query($db, $insert_type11);
    $insert_type12 = "INSERT INTO type12 (survey_url, question) VALUES ('$survey_url', '$type12')";
    mysqli_query($db, $insert_type12);
    $insert_type2 = "INSERT INTO type2 (survey_url, question) VALUES ('$survey_url', '$type2')";
    mysqli_query($db, $insert_type2);

    $_SESSION['survey_url'] = $survey_url;
    $_SESSION['created'] = "Survey created successfully.";
    echo ' <meta http-equiv="refresh" content="0;url=recipients.php">';
  }
}
  // Close connection
  mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      function countChar(val) {
        var len = val.value.length;
        if (len >= 500) {
          val.value = val.value.substring(0, 500);
        } else {
          $('#charNum').text(500 - len);
        }
      };
    </script>
    <title>Create Survey</title>
    <!-- <?php echo $start, $end;
    echo $type11, $type12, $type2 ?> -->
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
        <div class="createsurvey-page">
          <h1>Create Your Survey</h1>
          <form action="createsurvey.php" method="post">
          <fieldset class="create">
            <br>
            <div class="form-group  <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
              <label>Survey Title:</label>
              <br>
              <input type="text" class="input" name="survey_title" placeholder="Enter survey title." value="<?php echo $survey_title; ?>"/>
              <br>
            <span class="help-block"><?php echo $title_err; ?></span>
            <br>
            </div>
            <br>
            <div class="form-group  <?php echo (!empty($desc_err)) ? 'has-error' : ''; ?>">
              <label>Survey Description:</label>
              <br>
              <textarea type="date" class="textbox" name="survey_desc" maxlength="500" rows="10" cols="50" onkeyup="countChar(this)" placeholder="Enter survey description." value="<?php echo $survey_desc; ?>"></textarea>
              <div id="charNum" class="charNum"></div>
            <span class="help-block"><?php echo $desc_err; ?></span>
            <br>
            </div>
            <div class="form-group <?php echo (!empty($due_err)) ? 'has-error' : ''; ?>">
            <br>
              <label>Due Date:</label>
              <br>
              <input type="int" class="due_date" id="due_date" name="due_date" placeholder="Enter how many days survey is open (0-10)." value="<?php echo $due_date; ?>">
            </div>
            <span class="help-block"><?php echo $due_err; ?></span>
            <br>
            <br>
            <div class="form-group <?php echo (!empty($type11_err)) ? 'has-error' : ''; ?>">
              <label>Type 1 Question 1:</label>
            <input type="text" name="type11" placeholder="Enter 1-5 type question." class="type11" id="type11" />
            <br>
            <span class="help-block"><?php echo $type11_err; ?></span>
            </div>
            <br>
            <br>
            <div class="form-group <?php echo (!empty($type12_err)) ? 'has-error' : ''; ?>">
              <label>Type 1 Question 2:</label>
            <input type="text" name="type12" placeholder="Enter 1-5 type question." class="type12" id="type12" />
            <br>
            <span class="help-block"><?php echo $type12_err; ?></span>
            </div>
            <br>
            <br>
            <div class="form-group <?php echo (!empty($type2_err)) ? 'has-error' : ''; ?>">
              <label>Type 2 Question:</label>
            <input type="text" name="type2" placeholder="Enter 1-5 type question." class="type2" id="type2" />
            <br>
            <span class="help-block"><?php echo $type2_err; ?></span>
            </div>
            <br>
            <br>

            <div class="button">
              <a href="recipients.php">
                <input type="submit" name="submit" id="submit" class="submit" value="Create Survey"/>
              </a>
            </div>
          </fieldset>
        </form>
    </div>

  </body>
<footer>Copyright &copy; COP4710<br></footer>
</html>