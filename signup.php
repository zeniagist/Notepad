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

//No errors

//Prepare variables for the queries
$username = mysqli_real_escape_string($link, $username);
$email = mysqli_real_escape_string($link, $email);
$password = mysqli_real_escape_string($link, $password);

//   Username exists in the users table print error
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($link, $sql);
if(!$result){
  echo '<div class="alert alert-danger">Error running the query!</div>';
  // echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
  exit;
}
$results = mysqli_num_rows($result);

if($results){
  echo '<div class="alert alert-danger">That username is already registered. Do you want to log in?</div>';
  exit;
}

//    mail exists in the users table print error
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if(!$result){
  echo '<div class="alert alert-danger">Error running the query!</div>';
  exit;
}
$results = mysqli_num_rows($result);

if($results){
  echo '<div class="alert alert-danger">That email is already registered. Do you want to log in?</div>';
  exit;
}

//        Create a unique activation code
$activationKey = bin2hex(openssl_random_pseudo_bytes(16));

// Insert user details and activation code in the users table
$sql = "INSERT INTO users (username, email, password, activation) VALUES ('".$_POST["username"]."', '".$_POST["email"]."', 'Password2020', '$activationKey')";
$result = mysqli_query($link, $sql);
if(!$result){
  echo '<div class="alert alert-danger">There was an error inserting the user details in the database!</div>';
  exit; 
}
}

?>