<?php
//Start session
session_start();

include('connection.php');

// define error messages
$missingCurrentPassword='<p><strong>Please enter your current password!</strong></p>';
$incorrectCurrentPassword='<p><strong>Please enter your current password!</strong></p>';
$missingPassword='<p><strong>Please enter a password!</strong></p>';
$invalidPassword='<p><strong>Your password should be at least 6 characters long and include one capital letter and one number!</strong></p>';
$differentPassword='<p><strong>Passwords must match!</strong></p>';
$missingPassword2='<p><strong>Please confirm a password!</strong></p>';

//Get passwords
if(!$_POST["currentpassword"]){
    $errors .= $missingCurrentPassword;
}else{
    $currentPassword = filter_var($_POST["currentpassword"], FILTER_SANITIZE_STRING);
    // prepare for query
    $currentPassword = mysqli_real_escape_string($link, $currentPassword);
    // hash password
    $currentPassword = hash('sha256', $currentPassword);
    
    // check if given password is correct
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT password FROM users WHERE user_id='$user_id'";
    $result = mysqli_query($link, $sql);
    
    if(!$result){
        echo "error when selecting user_id from users table to check the password!";
        exit;
    }
    
    $count = mysqli_num_rows($result);
    
    if(!$count){
      echo '<div class="alert alert-danger">That password is incorrect</div>';
      exit;
    }
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    if($currentPassword !== $row['password']){
        $errors .= '<p><strong>Incorrect current password!</strong></p>';
    }
    
    
}

//If there are any errors print error
if($errors){
  $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
  echo $resultMessage;
  exit;
}

// check for errors
// if error print error message
// else run query and update password
?>