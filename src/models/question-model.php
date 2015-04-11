<?php

class Question
{
  public $type_id;
  public $text;
  public $var_count;
  public $equation_answer;
  public $equation_remainder;

  public function __construct()
  {
    $type_id = "";
    $text = "";
    $var_count = 0;
    $equation_answer = "";
  }

}

?>