<?php

class Question
{
  public $type_id;
  public $text;
  public $answer;

  public function __construct()
  {
    $type_id = -1;
    $text = "";
    $answer = "";
  }

}

?>