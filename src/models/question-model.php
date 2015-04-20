<?php

class Question
{
  public $type_id;
  public $text;
  public $answer;
  public $student_answer;
  public $start_time;
  public $finish_time;

  public function __construct()
  {
    $this->type_id = -1;
    $this->text = "";
    $this->answer = "";
    $this->student_answer = "";
    $this->start_time = new DateTime();
    $this->finish_time = "";
  }

}

?>