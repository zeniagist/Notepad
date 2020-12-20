// AJAX Call to updateusername.php
$("#updateusernameform").submit(function(event){
  //prevent default php processing
  event.preventDefault();

  //collect user inputs
  var datatopost = $(this).serializeArray();
  // console.log(datatopost);

  //send them to signup.php using AJAX
  $.ajax({
    url: "updateusername.php",
    type: "POST",
    data: datatopost,
    // AJAX Call successful
    success: function(data){
      if(data){
        $("#updateUsernameMessage").html(data);
      }else{
          location.reload();
      }
    },
    // AJAX Call fails: show error AJAX Call error
    error: function(){
      $("#updateUsernameMessage").html("<div class='alert alert-danger'>There was an error with the AJAX Call. Please try again later</div>");
    }
  });
});

// AJAX Call to updatepassword.php

// AJAX Call to updateemail.php