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
          <form method="post">
          <fieldset class="create">
            <br>
            <div class="form-group">
              <label>Survey Title:</label>
              <br>
              <input type="text" class="input" name="title" placeholder="Enter survey title."/>
              <br>
            </div>

            <br>

            <div class="form-group">
              <label>Survey Description:</label>
              <br>
              <textarea class="textbox" maxlength="300" rows="10" cols="50" placeholder="Enter survey description."></textarea>
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
                <input type="submit" name="submit" id="submit" class="submit" value="Create Account"/>
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