<?php
// This file receives the user_id and key generated to create the new password
// This file displays a form to input a new password
session_start();

include('connection.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Password Reset</title>  

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 

  <style>
    h1{
      color: purple;
    }
    .contactForm{
      border: 1px solid purple;
      margin-top: 50px;
      border-radius: 15px;
    }
  </style>

  </head>
  <body>
    <div class="container-fluid">
      
      <div class="row">
        <div class="col-sm-offset-1 col-sm-10 contactForm">
          <h1>Reset Password</h1>

          <?php
          // if user_id or activation key is missing
          if(!$_GET['user_id'] || !$_GET['key']){
            echo '<div class="alert alert-danger">There was an error. Please click on the link you received by email\n\nPlease check your spam folder.</div>';
            exit;
          }

          //Store them in two variables
          $user_id = $_GET['user_id'];
          $key = $_GET['key'];

          // define time variable: now minus 24 hours
          $time = time() - 86400;

          //Prepare variables for the query
          $user_id = mysqli_real_escape_string($link, $user_id);
          $key = mysqli_real_escape_string($link, $key);

          // Run query: check combination of user_id & key exists and less than 24 hour old
          $sql = "SELECT user_id FROM forgotpassword WHERE user_id='28' AND time > '$time'";
          $result = mysqli_query($link, $sql);

          if(!$result){
            echo '<div class="alert alert-danger">Error running the query!</div>';
            exit;
          }

          // if combination does not exist
          $count = mysqli_num_rows($result);

          if($count == 1){
              echo '<div class="alert alert-danger">Please try again!</div>';
              exit;
          }

          // print reset password form with hidden user_id and key fields
          echo "
          <form>
          
          </form>
          ";

          // script for AJAX Call to storepassword.php
          ?>
        </div>
      </div>
    </div>

  </body>
</html>


  

  