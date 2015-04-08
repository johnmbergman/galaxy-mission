

$("document").ready(function() {

  // Set up bindings
  $("#qInput").keypress(function(e) {
    if(e.which == 13) {
      // Enter key was pressed
      submitFunction();
      return false;
    }
  });

  // After bindings are setup, test functionality with the following 
  // TODO: When ajax functionality is setup, replace this with ajax query
  var newQuestion = "Fill in the blank: 1, 2, _, 4, 5";
  displayQuestion(newQuestion);
});

// Called when the /enter/ key is pressed
function submitFunction() {
  var studentAnswer = $("#qInput").val();
  if(studentAnswer == "") {
    uiMessageBox("Message", "Don't forgot to enter your answer!", "");
  } else {
    uiMessageBox("Message", "You answered " + studentAnswer + "!", "");
  }
}

function displayQuestion(questionText) {
  $("#qInput").val("");
  $("#qQuestion").html(questionText);
}