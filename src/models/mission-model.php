<?php

require_once "question-model.php";

class Mission
{
  public $type_id;
  public $start_time;
  public $finish_time;
  public $student_id;
  public $current_question;
  public $question_no;
  public $questions;

  public function __construct()
  {
    $this->type_id = "-1";
    $this->start_time = new DateTime();
    $this->finish_time = "";
    $this->student_id = "";
    $this->question_no = 0;
    $questions = array(
      0 => NULL,
      1 => NULL,
      2 => NULL,
      3 => NULL,
      4 => NULL,
      5 => NULL,
      6 => NULL,
      7 => NULL,
      8 => NULL,
      9 => NULL
      );
  }

}

?>