<?php
//Start session
session_start();

include('connection.php');

//Check user inputs
//Define error messages
$missingUsername='<p><strong>Please enter a username!</strong></p>';
$missingEmail='<p><strong>Please enter your email!</strong></p>';
$missingPassword='<p><strong>Please enter a password!</strong></p>';
$invalidPassword='<p><strong>Your password should be at least 6 characters long and include one capital letter and one number!</strong></p>';
$differentPassword='<p><strong>Passwords must match!</strong></p>';
$missingPassword2='<p><strong>Please confirm a password!</strong></p>';

//Get username, email, password, password2
//Get username
if(!$_POST["username"]){
  $errors .= $missingUsername;
}else{
  $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
}

//Get email
if(!$_POST["email"]){
  $errors .= $missingEmail;
}else{
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
}

//Get passwords
if(!$_POST["password"]){
  $errors .= $missingPassword;
}elseif(!(strlen($_POST["password"])>=6 
        and preg_match('/[A-Z]/',$_POST["password"])
        and preg_match('/[1-9]/',$_POST["password"])
)){
  $errors .= $invalidPassword;
}else{
  $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
  if(!$_POST["password2"]){
    $errors .= $missingPassword2;
  }else{
    $password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
    if($password !== $password2){
      $errors .= $differentPassword;
    }
  }
}

//If there are any errors print error
if($errors){
  $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
  echo $resultMessage;
}


?>

