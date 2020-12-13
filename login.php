<?php
//Start session
session_start();

//Connect to the database
include('connection.php');

//Check user inputs
//echo "hello";

//Define error messages
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
}

//Run query: Check combination of email & password exists

//If email & password don't match print error
  //log the user in: Set session variables
  //If remember me is not checked print "success"

   
                //Create two variables $authentificator1 and $authentificator2
                //Store them in a cookie
                //Run query to store them in rememberme table
                //If query unsuccessful
                    //print error
                //else
                    //print success


?>