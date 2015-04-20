<?php

require_once "mission-controller.php";
session_start();

// Application AJAX Entry point
header("Content-Type: application/json");
if(isset($_POST["action"]) && !empty($_POST["action"]))
{
  $action = $_POST["action"];
  switch ($action) {
    case "GetQuestion":
      GetQuestion();
      break;
    
    case "SubmitAnswer":
      CheckAnswer();
      break;

    default:
      echo "Error: Unknown ajax action specified!";
      break;
  }
}
else
{
  echo "Error: ajax action not specified!";
}


////////////////////////////////
//  AJAX FUNCTIONS BEGIN HERE //
////////////////////////////////

// Function for retrieving a question via ajax
function GetQuestion()
{
  $return = $_POST;
  if(isset($_SESSION["current_mission"]))
  {
    $model = $_SESSION["current_mission"];
    if($model->question_no < 10)
    {
      // The student has not answered 10 questions yet
      $controller = new MissionController($model);
      $model->current_question = $controller->GenerateQuestion(1);
      $model->question_no++;
      $_SESSION["current_mission"] = $model;
      $return["question"] = $model->current_question->text;
    }
    else
    {
      // The student has answered 10 questions
      $controller = new MissionController($model);
      if($controller->SubmitMission())
      {
        $return["question"] = "FINISHED";
      }
      else
      {
        $return["question"] = "FAILED TO SAVE!";
      }
    }
  }
  else
  {
    $return["question"] = "An error occurred! Please restart the mission.";
  }

  // Make the return JSON format
  echo json_encode($return);
}



// Function for determining if an answer to a question is correct
function CheckAnswer()
{
  $return = $_POST;
  if(isset($_SESSION["current_mission"]))
  {
    if(isset($_POST["answer"]))
    {
      $student_answer = $_POST["answer"];
      if(strlen($student_answer) > 0)
      {
        $model = $_SESSION["current_mission"];
        $controller = new MissionController($model);
        if($controller->CheckAnswer($student_answer))
        {
          // Correct
          $return["message"] = "GOOD";
        }
        else
        {
          // Incorrect
          $return["message"] = "Sorry, that's not quite right. Try again!";
        }

        // Save the mission
        $_SESSION["current_mission"] = $model;
      }
      else
      {
        // The answer is blank!
        $return["message"] = "Don't forgot to enter your answer!";
      }
    }
    else
    {
      // The answer is not specified
      $return["message"] = "Don't forget to type in your answer before pressing ENTER!";
    }
  }
  else
  {
    $return["message"] = "An error occurred! Please restart the mission.";
  }

  // Return JSON format
  echo json_encode($return);
}

?>