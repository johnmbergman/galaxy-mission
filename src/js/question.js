$("document").ready(function() {

  // Set up bindings
  $("#qInput").keypress(function(e) {

    // Check if ENTER key was pressed
    if(e.which == 13) {
      submitAnswer();
      return false;
    }

  });

  // After bindings are setup, test functionality with the following 
  // TODO: When ajax functionality is setup, replace this with ajax query
  requestQuestion();
});

// Called when the /enter/ key is pressed
function submitAnswer() {
  var studentAnswer = $("#qInput").val();
  if(studentAnswer == "") {
    uiMessageBox("Message", "Don't forgot to enter your answer!", "");
  } else {
    $.ajax({
      url: "../controllers/ajax.php",
      timeout: 6000,
      data: {
        "action": "SubmitAnswer",
        "answer": studentAnswer
      },
      type: "post",
      dataType: "json",
      success: function(data) {
        uiMessageBox("Response", data["message"], "");
      },
      error: function(xhr, status, errorThrown) {
        uiError(xhr, status, errorThrown);
      }
    });
  }
}

function displayQuestion(questionText) {
  $("#qInput").val("");
  $("#qQuestion").html(questionText);
}

function requestQuestion() {
  $.ajax({
    url: "../controllers/ajax.php",
    timeout: 6000,
    data: {
      "action": "GetQuestion"
    },
    type: "post",
    dataType: "json",
    success: function(data) {
      displayQuestion(data["question"]);
    },
    error: function(xhr, status, errorThrown) {
      uiError(xhr, status, errorThrown);
    }
  });
}