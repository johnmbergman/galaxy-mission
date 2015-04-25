<?php

require_once "question-model.php";

class Assessment
{
  public $student_id;
  public $current_question;
  public $question_no;
  public $questions;

  public function __construct()
  {
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
      9 => NULL,
      10 => NULL,
      11 => NULL,
      12 => NULL,
      13 => NULL,
      14 => NULL,
      15 => NULL,
      16 => NULL,
      17 => NULL,
      18 => NULL,
      19 => NULL,
      20 => NULL,
      21 => NULL,
      22 => NULL,
      23 => NULL,
      24 => NULL,
      25 => NULL,
      26 => NULL,
      27 => NULL,
      28 => NULL,
      29 => NULL
      
      );
  }

}

?>