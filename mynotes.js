$(function(){
  // define variables
  var activeNote = 0;
  var editMode = false;
  
  // load notes on page load: AJAX Call to loadnotes.php
  $.ajax({
    url: "notes/loadnotes.php",
    success: function(data){
      $('#notes').html(data);
      clickonNote();
    },
    error: function(){
        $('#alertContent').text("There was an error with the AJAX Call! Please try again.");
        $('#alert').fadeIn();
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
                
                // hide elements
                $("#notes").hide();
                $("#addNote").hide();
                $("#edit").hide();
                
                $("textarea").focus();
              }
          },
        error: function(){
            $('#alertContent').text("There was an error with the AJAX Call! Please try again.");
            $('#alert').fadeIn();
        }
      });
  });
  
  // type note:  AJAX Call to updatenote.php
  $("textarea").keyup(function(){
    // ajax call to update the task of id activeNote
    $.ajax({
    url: "notes/updatenote.php",
    type: "POST",
    // send the current note content with its id to the php file
    data: {note: $(this).val(), id:activeNote},
    success: function(data){
      if(data == 'error'){
        $('#alertContent').text("There was an issue updating the notes in the database!");
        $('#alert').fadeIn();
      }
    },
    error: function(){
        $('#alertContent').text("There was an error with the AJAX Call! Please try again.");
        $('#alert').fadeIn();
    }
    });
  });
  
  // click on all notes button
  $("#allNotes").click(function(){
    $.ajax({
        url: "notes/loadnotes.php",
        success: function(data){
          $('#notes').html(data);
          
            // hide elements
            $("#notepad").hide();
            $("#allNotes").hide();
            
            // show elements
            $("#notes").show();
            $("#addNote").show();
            $("#edit").show();
            
            clickonNote();
        },
        error: function(){
            $('#alertContent').text("There was an error with the AJAX Call! Please try again.");
            $('#alert').fadeIn();
        }
    });
  });

  // click on done after editing: load notes again
  $("#edit").click(function(){
    //   switch to edit mode
      editMode = true;
      
    //   reduve the width of notes
    $(".noteheader").addClass("col-xs-7 col-sm-9");
    
    // hide elements
    $("#edit").hide();
    
    // show elements
    $("#done").show();
    $(".delete").show();
  });
  
  // click on edit: go to edit mode show: delete buttons, ...
    
    
  // functions
    // click on a note
    function clickonNote(){
        $(".noteheader").click(function(){
            if(!editMode){
                // update activeNote variable to the id of note
                activeNote = $(this).attr("id");
                
                // fill text area
                $("textarea").val($(this).find('.text').text());
                
                // show elements
                $("#notepad").show();
                $("#allNotes").show();
                
                // hide elements
                $("#notes").hide();
                $("#addNote").hide();
                $("#edit").hide();
                
                $("textarea").focus();
            }
        });
    }
    
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