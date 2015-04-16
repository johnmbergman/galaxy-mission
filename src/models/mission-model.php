<?php

require "question-model.php";

class Mission
{
  public $type_id;
  public $start_time;
  public $finish_time;
  public $student_id;

  public function __construct()
  {
    $type_id = -1;
    $start_time = new DateTime();
    $finish_time = $start_time;
    $student_id = "";
  }

}

?>