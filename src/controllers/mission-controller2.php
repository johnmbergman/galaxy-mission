<?php
/*
  John Bergman
  Updated: April 10, 2015
  MissionController class for managing a student mission.
*/
require_once "data.php";
require_once "../models/mission-model.php";

class MissionController
{
  private $model;

  // Constructor
  public function __construct($model)
  {
    $this->model = $model;
  }

  public function GenerateQuestion($qlevel)
  {
    $question = new Question();
    //$question->type_id = $this->model->type_id;

    // For now, we just have a dummy queston
    switch ($this->model->type_id) {

      case "2":   // Counting numbers
        $question->answer = rand(0, 5);
        if ($question->answer == 0)
        {
        	$question->text = "Enter the number that comes first: _ " . ($question->answer+1) . " " . ($question->answer+2) .;
        }
        else if ($question->answer == 1)
        {
        	$placement = rand(0, 1);
        	switch ($placement)
        		case "0":
        			$question->text = "Enter the number that comes first: _ " . ($question->answer+1) . " " . ($question->answer+2) .;
        			break;
        			
        		case "1":
        			$question->text = "Enter the number that goes in the middle: " . ($question->answer-1) . " _ " . ($question->answer+1) .;
        			break;
        			
        }
        else if ($question->answer == (2 || 3)
        {
        	$placement = rand(0, 2);
        	switch ($placement)
        		case "0":
        			$question->text = "Enter the number that comes first: _ " . ($question->answer+1) . " " . ($question->answer+2) .;
        			break;
        			
        		case "1":
        			$question->text = "Enter the number that goes in the middle: " . ($question->answer-1) . " _ " . ($question->answer+1) .;
        			break;
        			
        		case "2":
        			$question->text = "Enter the number that comes next: " . ($question->answer - 2) . " " . ($question->answer-1) . " _";
        			break;
        }
        else if ($question->answer == 4)
        {
	        $placement = rand(0, 1);
        	switch ($placement)
    			case "0":
        			$question->text = "Enter the number that goes in the middle: " . ($question->answer-1) . " _ " . ($question->answer+1) .;
        			break;
        			
        		case "1":
        			$question->text = "Enter the number that comes next: " . ($question->answer - 2) . " " . ($question->answer-1) . " _";
        			break;
        }		
        else if ($question->answer == 5)
        	$question->text = "Enter the number that comes next: " . ($question->answer - 2) . " " . ($question->answer-1) . " _";
        
        break;

      case "3":   // Missing number (sequence)
        $question->answer = rand(0, 5);
        $question->text = "Enter the missing number: ";
        $question->text .= (($question->answer == 0) ? "_" : "0") . " ";
        $question->text .= (($question->answer == 1) ? "_" : "1") . " ";
        $question->text .= (($question->answer == 2) ? "_" : "2") . " ";
        $question->text .= (($question->answer == 3) ? "_" : "3") . " ";
        $question->text .= (($question->answer == 4) ? "_" : "4") . " ";
        $question->text .= (($question->answer == 5) ? "_" : "5") . " ";
        break;

      default:
        $question->answer = "1";
        $question->text = "This question type (" . $this->model->type_id . ") has not been implemented! (Answer 1)";
        break;
    }

    // Set the current question to the generated question
    return $question;
  }


  // Compare the student's response to the actual answer to see if the student is correct
  public function CheckAnswer($student_answer)
  {
    return  ($this->model->current_question->answer == $student_answer);
  }

}
?>