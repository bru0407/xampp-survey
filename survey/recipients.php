
<?php
  require_once "server.php";

  session_start();

  $email1 = "";
  $wrong = "no";
  if(isset($_SESSION['survey_url']) && !empty($_SESSION['survey_url']))
  {
    //populate email_array
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $wrong = "post";
        $survey_url = $_SESSION['survey_url'];
        $email1 = mysqli_real_escape_string($db, $_POST['email1']);
        $responder = $email1;
        $find_query = "SELECT * FROM surveys WHERE survey_url='$survey_url'";
        $search = mysqli_query($db, $find_query);
        $match  = mysqli_num_rows($search);
        if($match > 0)
        {
            $wrong = "no it's fine";
            //inside loop: for each email in email array
            require "Mail.php";
            $from = "surveymasterdevteam@gmail.com";
            $to = $email1;
            $host = "ssl://smtp.gmail.com";
            $port = "465";

            $devemail = 'surveymasterdevteam@gmail.com';
            $password = 'devteam!';
            $subject = "You've been invited to take a survey!";
            $body = '

            Over at SurveyMaster, where great surveys are made, you have been invited to participate in a survey.
            To take the survey, click the link below.
            <a href="localhost/survey/survey.php?survey_url='.$survey_url.'&responder='.$responder.'">
            localhost/survey/survey.php?survey_url='.$survey_url.'&responder='.$responder.'</a>

            ';

            $headers = array ('From' => $from, 'To' => $to,'Subject' => $subject);
            $smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $devemail, 'password' => $password));
            $mail = $smtp->send($to, $headers, $body);

            echo ' <meta http-equiv="refresh" content="0;url=survey.php?survey_url='.$survey_url.'>';
        }
          else
          {
            $wrong = "yeah";
          }
      }
        else
        {
          echo "Why aren't you posting";
        }

    }


?><!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Style.css" type="text/css">
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
          <h1>Recipients</h1>
          <h1>Welcome <?php echo $wrong, $email1; ?></h1>
          <fieldset class="create" >
            <div class="form-group">
                <label>Recipient's Emails:</label>
                <form name="add_name" id="add_name" action="recipients.php" method="post">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                            <tr>
                                <td>
                                  <input
                                    type="text"
                                    name="email1"
                                    placeholder="Enter your recipient email"
                                    class="input"
                                    required=""
                                    value="<?php echo $email1; ?>"
                                  />
                                </td>
                                <td>
                                  <button
                                    type="button"
                                    name="add"
                                    id="add"
                                    class="btn btn-success"
                                    >Add More</button>
                                </td>
                            </tr>
                        </table>
                          <input
                            type="button"
                            name="submit"
                            id="submit"
                            class="btn btn-info"
                            value="Submit"
                          />
                    </div>
                 </form>
            </div>
        </fieldset>
    </div>


<script type="text/javascript">
    $(document).ready(function(){
      var postURL = "./addmore.php";
      var i=1;
      $('#add').click(function(){
           i++;
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter your recipient email" class="input" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
      });
      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });
      $('#submit').click(function(){
           $.ajax({
                url:postURL,
                // method:"POST",
                data:$('#add_name').serialize(),
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
    });
</script>



  </body>
<footer>Copyright &copy; COP4710<br></footer>
</html>