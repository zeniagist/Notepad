$(function(){
  // define variables
  var activeNote = 0;
  
  // load notes on page load: AJAX Call to loadnotes.php
  $.ajax({
    url: "notes/loadnotes.php",
    success: function(data){
      $('#notes').html(data);
    }
  });

  // add a new note:  AJAX Call to createnote.php
  $('#addNote').click(function(){
      $.ajax({
          url: "notes/createnote.php",
          success: function(data){
              if(data == 'error'){
                  $('#alertContent').text("There was an issue inserting the new note in the database!");
                  $('#alert').fadeIn();
              }else{
                // update activeNote to the id of the new note
                activeNote = data;
                $("textarea").val("");
                
                // show hide elements
                //showHide(["#notepad", "#allNotes", "#done"], ["#notes", "#addNote", "#edit"]);
                // show elements
                $("#notepad").show();
                $("#allNotes").show();
                $("#done").show();
                
                // hide elements
                $("#notes").hide();
                $("#addNote").hide();
                $("#edit").hide();
                
                $("textarea").focus();
              }
          }
      });
  });
  
  // type note:  AJAX Call to updatenote.php
  // click on all notes button
  // click on done after editing: load notes again
  // click on edit: go to edit mode show: delete buttons, ...

  // functions
    // click on a note
    // click on delete
    // show hide function
    // function showHide(array1, array2){
    //     for(i=0; i<array.length; i++){
    //       $(array1[i]).show();
    //     }
        
    //     for(i=0; i<array.length; i++){
    //       $(array2[i]).hide();
    //     }
    // }
    
});