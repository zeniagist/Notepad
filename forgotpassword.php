<?php
//Start session
session_start();

//Connect to the database
include("connection.php");

//Check user inputs
//Define error messages
$missingEmail='<p><strong>Please enter your email!</strong></p>';

//Get email
if(!$_POST["forgotemail"]){
  $errors .= $missingEmail;
}else{
  $email = filter_var($_POST["forgotemail"], FILTER_SANITIZE_EMAIL);
}

//Store errors in errors variable
if($errors){
  $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
  echo $resultMessage;
}

//If there are any errors
//print error message
//else: No errors
//Prepare variables for the query
//Run query: Check if email exists in the user table
//If email does not exist
//print error message
//else
  //Create a unique activation code
  //Insert user details and activation code in the forgotpassword table
  //Send email with link to resetpassword.php with user id and activiaton code
  //If email sent successfully
      //print success message

?>