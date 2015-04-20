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
        if(data["message"] == "GOOD") {
          $("#mission-progress").append("<div class='progress-bar progress-bar-success' style='width: 10%;'></div>");
        } else {
          $("#mission-progress").append("<div class='progress-bar progress-bar-danger' style='width: 10%;'></div>");
        }
        requestQuestion();
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
      if(data["question"] == "FINISHED") {
        displayQuestion("You completed the mission! <a href='/mission-result/'>Click Here</a> to view your mission result.");
        $("#qInput").remove();
      } else {
        displayQuestion(data["question"]);
      }
    },
    error: function(xhr, status, errorThrown) {
      uiError(xhr, status, errorThrown);
    }
  });
}