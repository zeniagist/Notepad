$(function(){
  // define variables
  // load notes on page load: AJAX Call to loadnotes.php
  $.ajax({
    url: "notes/loadnotes.php",
    success: function(data){
      $('#notes').html(data);
    }
  });

  // add a new note:  AJAX Call to createnote.php
  // type note:  AJAX Call to updatenote.php
  // click on all notes button
  // click on done after editing: load notes again
  // click on edit: go to edit mode show: delete buttons, ...

  // functions
    // click on a note
    // click on delete
    // show hide function
});