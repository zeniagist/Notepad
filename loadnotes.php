<?php
session_start();
include('connection.php');

// get the user_id
$user_id = $_SESSION['user_id'];

// run a query to delete empty notes
$sql = "DELETE FROM notes WHERE note=''";
$result = mysqli_query($link, $sql);

// run a query to look for notes corresponding to user_id

// show notes or alert message

echo "<div class='noteheader'>
        <div class='text'>This is a note This is a note This is a note This is a note This is a note 
            This is a note 
        </div>
        <div class='timetext'>May 30, 2016 07:00:00 PM</div>
      </div>";

echo "<div class='noteheader'>
        <div class='text'>This is a note</div>
        <div class='timetext'>May 30, 2016 07:00:00 PM</div>
      </div>";
?>