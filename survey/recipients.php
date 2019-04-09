<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Style.css" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
          <h1>Recipients</h1>
          <fieldset class="create">
            <div class="form-group">
                <label>Recipient's Emails:</label>
                <form name="add_name" id="add_name">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                            <tr>
                                <td>
                                  <input
                                    type="text"
                                    name="name[]"
                                    placeholder="Enter your recipient email"
                                    class="input"
                                    required=""
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
                        <a href ="./home.php">
                          <input
                            type="button"
                            name="submit"
                            id="submit"
                            class="btn btn-info"
                            value="Submit"
                          />
                      </a>
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
                method:"POST",
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