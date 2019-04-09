<?php

session_start();
// Include config file
require_once "server.php";

if(!(isset($_SESSION['loggedin'])))
{
  $_SESSION['msg'] = "You must log in to view this page.";
  echo ' <meta http-equiv="refresh" content="4;url=login.php">';
}
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
$title_err = "";
$desc_err = "";
$surveyID = 0;
$survey_url = "";
$work = "";

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

  //generate surveyID
  do
  {
    $random_num = random_int(1, 255);
    $survey_id_query = "SELECT * FROM surveys WHERE surveyID = '$random_num' LIMIT 1";
    $id_check_result = mysqli_query($db, $survey_id_query);
    $survey = mysqli_fetch_assoc($id_check_result);
  } while($survey['surveyID'] == $random_num);
  $surveyID = $random_num;

  //generate url
  do
  {
    $random_url = makeURL();
    $url_check_query = "SELECT * FROM surveys WHERE survey_url = '$random_url' LIMIT 1";
    $url_check_result = mysqli_query($db, $url_check_query);
    $url_survey = mysqli_fetch_assoc($url_check_result);
  } while($survey['survey_url'] == $random_num);
  $survey_url = $random_url;

  if(!empty($surveyID) && !empty($survey_url))
  {
    $insert_survey = "INSERT INTO surveys (username, surveyID, survey_url, survey_title, survey_desc) VALUES ('$username', '$surveyID', '$survey_url', '$survey_title', '$survey_desc')";
    mysqli_query($db, $insert_survey);
    $_SESSION['created'] = "Survey created successfully.";
  }
}

  // Close connection
  mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Style.css" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <title>Create Survey</title>
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
              <a href="Login.php">Login</a>
              <?php } else { ?>
              <a href="account.php">Account</a>
              <a href="CreateSurvey.php">Create Survey</a>
              <a href="logout.php">Logout</a>
              <?php } ?>
            </div>
          </div>
        </ul>
      </div>
    </div>
        <div class="createsurvey-page">
          <h1>Create Your Survey</h1>
          <h1>Welcome <?php echo $username, $surveyID, $survey_url, $survey_title, $survey_desc; ?></h1>
          <form action="CreateSurvey.php" method="post">
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
              <input type="text" class="input" name="survey_desc" placeholder="Enter survey description." value="<?php echo $survey_desc; ?>"/>
              <br>
            <span class="help-block"><?php echo $desc_err; ?></span>
            <br>
            </div>

            <br>

            <div class="form-group">
              <label>Starting Date:</label>
              <input type="text" id="start" placeholder="Enter survey starting date.">
            </div>

            <br>

            <div class="form-group">
              <label>Ending Date:</label>
              <input type="text" id="end" placeholder="Enter survey ending date.">
            </div>

            <br>

            <div class="form-group">
              <label>Type 1 Questions:</label>
              <table class="table table-bordered" id="type1">
                <tr>
                    <td>
                      <input
                        type="text"
                        name="name[]"
                        placeholder="Enter 1-5 type question."
                        class="input"
                        required=""
                      />
                    </td>
                    <td>
                      <button
                        type="button"
                        name="add"
                        id="add1"
                        class="btn btn-success"
                        >Add More</button>
                    </td>
                  </tr>
                </table>
            </div>

            <br>

            <div class="form-group">
              <label>Type 2 Questions:</label>
              <table class="table table-bordered" id="type2">
                <tr>
                    <td>
                      <input
                        type="text"
                        name="name[]"
                        placeholder="Enter text type question."
                        class="input"
                        required=""
                      />
                    </td>
                    <td>
                      <button
                        type="button"
                        name="add"
                        id="add2"
                        class="btn btn-success"
                        >Add More</button>
                    </td>
                  </tr>
                </table>
            </div>

            <br>

            <div class="button">
              <a href="recipients.php">
                <input type="submit" name="submit" id="submit" class="submit" value="Create Survey"/>
              </a>
            </div>
          </fieldset>
        </form>
    </div>


<script type="text/javascript">
    $(document).ready(function(){
      var i=1;
      $('#add1').click(function(){
           i++;
           $('#type1').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter 1-5 type question" class="input" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
      });
      $('#add2').click(function(){
           i++;
           $('#type2').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter text type question" class="input" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
      });
      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });
    });
</script>
<script>
  $( function() {
    $( "#start" ).datepicker();
    $( "#end" ).datepicker();
  } );
</script>
</body>
<footer>Copyright &copy; COP4710<br></footer>
</html>