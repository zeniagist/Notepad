<?php
//Start session
session_start();

//Connect to the database
include('connection.php');

//Check user inputs
// echo "successful";

//Define errors message
$missingEmail='<p><strong>Please enter your email address!</strong></p>';
$missingPassword='<p><strong>Please enter your password!</strong></p>';

//Get email
if(!$_POST["loginemail"]){
  $errors .= $missingEmail;
}else{
  $email = filter_var($_POST["loginemail"], FILTER_SANITIZE_EMAIL);
}

//Get password
if(!$_POST["loginpassword"]){
  $errors .= $missingPassword;
}else{
  $email = filter_var($_POST["loginpassword"], FILTER_SANITIZE_STRING);
}

//If there are any errors
if($errors){
  $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
  echo $resultMessage;
}else{
  //Prepare variables for the query  
  $email = mysqli_real_escape_string($link, $email);
  $password = mysqli_real_escape_string($link, $password);
  // hash password
  $password = hash('sha256', $password);
  
  //Run query: Check combination of email & password exists
  $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND activation='activated'";
  $result = mysqli_query($link, $sql);

  if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    exit;
  }

  //If email & password don't match print error
  $count = mysqli_num_rows($result);

  if($count == 1){
    echo '<div class="alert alert-danger">Wrong username and password combination</div>';
  }else{
    //log the user in: Set session variables
    $row = mysqli_fetch_array($result, MYSQLI_NUM);
  //   $_SESSION['user_id'=$row['user_id']];
  //   $_SESSION['username'=$row['username']];
  //   $_SESSION['email'=$row['email']];

    //If remember me is not checked print "success"
    if(!$_POST['rememberme']){
      echo "success";
    }
  }
}



   
//Create two variables $authentificator1 and $authentificator2
//Store them in a cookie
//Run query to store them in rememberme table
//If query unsuccessful
//print error
//else
//print success


?>