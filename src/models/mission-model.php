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

  public function __construct()
  {
    $this->type_id = "-1";
    $this->start_time = new DateTime();
    $this->finish_time = "";
    $this->student_id = "";
    $this->question_no = 0;
  }

}

?>