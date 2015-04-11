<?php

require "mission-controller.php";

// Application AJAX Entry point
session_start();
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
    $controller = new MissionController($model);
    $question = $controller->GenerateQuestion("TODO", "TODO");
    $return["question"] = $question->text;
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
        /*$model = $_SESSION["current_mission"];
        $controller = new MissionController($model);*/
        /* TODO: Add Code to reference validation functions HERE */
        // PLACEHOLDER
        if($student_answer == "1")
        {
          // Correct
          $return["message"] = "Correct answer message goes here!";
          $return["correct"] = true;
        }
        else
        {
          // Incorrect
          $return["message"] = "Incorrect answer message goes here!";
          $return["correct"] = false;
        }
      }
      else
      {
        // The answer is blank!
        $return["message"] = "No answer was specified message goes here!";
        $return["correct"] = false;
      }
    }
    else
    {
      // The answer is not specified
      $return["message"] = "Don't forget to type in your answer before pressing ENTER!";
      $return["correct"] = false;
    }
  }
  else
  {
    $return["message"] = "An error occurred! Please restart the mission.";
    $return["correct"] = false;
  }

  // Return JSON format
  echo json_encode($return);
}

?>