<?php
/*
  John Bergman
  Updated: April 10, 2015
  MissionController class for managing a student mission.
*/
require "data.php";
require "../models/question-model.php";

class MissionController
{
  private $model;

  // Constructor
  public function __construct($model)
  {
    $this->model = $model;
  }

  public function GenerateQuestion($qtype_id, $qlevel)
  {
    $question = new Question();
    $question->type_id = $qtype_id;

    // For now, we just have a dummy queston
    switch ($qtype_id) {

      case "2":   // Counting numbers
        $question->answer = rand(2, 5);
        $question->text = "Enter the number that comes next: " . ($question->answer - 2) . " " . ($question->answer-1) . " _";
        break;

      case "3":   // Missing number (sequence)
        $question->answer = rand(0, 5);
        $question->text = "Enter the missing number: ";
        $question->text .= ($question->answer == 0) ? "_" : "0") . " ";
        $question->text .= ($question->answer == 1) ? "_" : "1") . " ";
        $question->text .= ($question->answer == 2) ? "_" : "2") . " ";
        $question->text .= ($question->answer == 3) ? "_" : "3") . " ";
        $question->text .= ($question->answer == 4) ? "_" : "4") . " ";
        $question->text .= ($question->answer == 5) ? "_" : "5") . " ";
        break;

      default:
        $question->answer = "1";
        $question->text = "This question type has not been implemented! (Answer 1)";
        break;
    }

    // Set the current question to the generated question
    
    return $question;
  }


  // Compare the student's response to the actual answer to see if the student is correct
  public function CheckAnswer($student_answer)
  {
    // TODO: Generate the answer from the equation
    return  ($this->model->answer == $student_answer);
  }

}
?>