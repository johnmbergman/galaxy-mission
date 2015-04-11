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

  public function GenerateQuestion($qtype_id, $qdifficulty)
  {
    $question = new Question();

    // Add code to generate the question here

    // For now, we just have a dummy queston
    $question->type_id = -1;
    $question->text = "This is a test question. The answer is the number 1.";
    $question->var_count = 0;
    $question->equation_answer = "1";

    // Set the current question to the generated question
    
    return $question;
  }

}
?>