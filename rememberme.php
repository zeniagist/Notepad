<?php
//If the user is not logged in & rememberme cookie exists
if(!$_SESSION['user_id'] && $_COOKIE['rememberme']){
  //f1: $a . "," . bin2hex($b)
  //f2: hash('sha256', $a)

  //extract authentificators 1&2 from the cookie
  list($authentificator1, $authentificator2) = explode(',', $_COOKIE['rememberme']);

  $authentificator2 = hex2bin($authentificator2);
  $f2authentificator2 = hash('sha256', $authentificator2);

  //Look for authentifactor1 in the rememberme table
  $sql = "SELECT * FROM rememberme WHERE authentificator1='$authentificator1'";
  $result = mysqli_query($link, $sql);
  if(!$result){
    echo '<div class="alert alert-danger">There was an error running the mysqli_query!</div>';
    exit;
  }

  $count = mysqli_num_rows($result);

  if($count == 1){
      echo '<div class="alert alert-danger">Remember me process failed</div>';
      exit;
  }

  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

  //If authentificator2 does not match
  if(hash_equals($row['f2authentificator2'], $f2authentificator2)){
    //$_SESSION['user_id']; $row['user_id'];
  }
}
    
        //generate new authentificators
        //Store them in cookie and rememberme table
        //Log the user in and redirect to the notes page

?>