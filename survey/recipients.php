<?php
  require_once "server.php";
  session_start();

  $email1 = "";
  $response_id = "";

function makeID()
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
  if(isset($_SESSION['survey_url']) && !empty($_SESSION['survey_url']))
  {
    //populate email_array
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $survey_url = $_SESSION['survey_url'];
        $response_id = makeID();
        $email1 = mysqli_real_escape_string($db, $_POST['email1']);
        $find_query = "SELECT * FROM surveys WHERE survey_url='$survey_url'";
        $search = mysqli_query($db, $find_query);
        $match  = mysqli_num_rows($search);
        if($match > 0)
        {
            $wrong = "no it's fine";
            $sent_invite = "INSERT INTO recipients (survey_url, recipient, response_id) VALUES ('$survey_url', '$email1', '$response_id')";
            mysqli_query($db, $sent_invite);
            require "Mail.php";
            $from = "surveymasterdevteam@gmail.com";
            $to = $email1;
            $host = "ssl://smtp.gmail.com";
            $port = "465";
            $devemail = 'surveymasterdevteam@gmail.com';
            $password = 'devteam!';
            $subject = "You've been invited to take a survey!";
            $body = '
            Over at SurveyMaster, home of award winning surveys, you have been invited to participate in a survey.
            To take the survey, copy and paste the link below into your browser:
            localhost/survey/survey.php?survey_url='.$survey_url.'&response_id='.$response_id.'
            ';

            $headers = array ('From' => $from, 'To' => $to,'Subject' => $subject);
            $smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $devemail, 'password' => $password));
            $mail = $smtp->send($to, $headers, $body);
            //echo ' <meta http-equiv="refresh" content="0;url=survey.php?survey_url='.$survey_url.'>';
        }
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>Send Out Survey</title>
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
          <h1>Add Recipients</h1>
          <fieldset class="create">
            <div class="recipients">
            <div class="form-group">
                <label>Recipient's Emails:</label>
                <div class="email-icon">
                  <img
                    src="https://image.flaticon.com/icons/svg/129/129481.svg"
                    alt=""
                    class="email-icon"
                    width="90"
                    height="auto"
                  >
                </div>

                <form name="add_name" id="add_name" action="recipients.php" method="post">

                    <br>

                    <div class="input-icon">
                      <input
                        type="text"
                        id="email1"
                        name="email1"
                        placeholder="Enter first recipient's email"
                        class="input"
                        value="<?php echo $email1; ?>"
                      />
                      <i>1:</i>
                    </div>

                    <br>
<!--
                    <div class="input-icon input-icon-right">
                      <input
                        type="text"
                        name="email2"
                        placeholder="Enter second recipient's email"
                        class="input"
                        value="<?php echo $email2; ?>"
                      />
                      <i>2:</i>
                    </div>

                    <br>

                    <div class="input-icon">
                      <input
                        type="text"
                        name="email3"
                        placeholder="Enter third recipient's email"
                        class="input"
                        value="<?php echo $email3; ?>"
                      />
                      <i>3:</i>
                    </div>

                    <br>

                    <div class="input-icon input-icon-right">
                      <input
                        type="text"
                        name="email4"
                        placeholder="Enter fourth recipient's email"
                        class="input"
                        value="<?php echo $email4; ?>"
                      />
                      <i>4:</i>
                    </div>

                    <br>

                    <div class="input-icon">
                      <input
                        type="text"
                        name="email5"
                        placeholder="Enter fifth recipient's email"
                        class="input"
                        value="<?php echo $email5; ?>"
                      />
                      <i>5:</i>
                    </div>

                    <br>

                    <div class="input-icon input-icon-right">
                      <input
                        type="text"
                        name="email6"
                        placeholder="Enter sixth recipient's email"
                        class="input"
                        value="<?php echo $email6; ?>"
                      />
                      <i>6:</i>
                    </div>

                    <br>

                    <div class="input-icon">
                      <input
                        type="text"
                        name="email7"
                        placeholder="Enter seventh recipient's email"
                        class="input"
                        value="<?php echo $email7; ?>"
                      />
                      <i>7:</i>
                    </div>

                    <br>

                    <div class="input-icon input-icon-right">
                      <input
                        type="text"
                        name="email8"
                        placeholder="Enter eigth recipient's email"
                        class="input"
                        value="<?php echo $email8; ?>"
                      />
                      <i>8:</i>
                    </div>

                    <br>

                    <div class="input-icon">
                      <input
                        type="text"
                        name="email9"
                        placeholder="Enter ninth recipient's email"
                        class="input"
                        value="<?php echo $email9; ?>"
                      />
                      <i>9:</i>
                    </div>

                    <br>

                    <div class="input-icon input-icon-right">
                      <input
                        type="text"
                        name="email10"
                        placeholder="Enter tenth recipient's email"
                        class="input"
                        value="<?php echo $email10; ?>"
                      />
                      <i>10:</i>
                    </div> -->

                    <br>

                    <div class="recipient-submit">
                     <input
                            type="submit"
                            name="submit"
                            id="submit"
                            class="btn btn-info"
                            value="Submit"
                      />
                    </div>


                 </form>
            </div>
          </div>
        </fieldset>
    </div>

    <!-- <script type="text/javascript">
      $('#submit').click(function(){
           $.ajax({
                url:postURL,
                type:'json',
                success:function(data)
                {
                    i=1;
                    $('.dynamic-added').remove();
                    $('#add_name')[0].reset();
                    alert('Succesfully created survey.');
                }
           });
    });
</script> -->

  </body>
<footer>Copyright &copy; COP4710<br></footer>
</html>