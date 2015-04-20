<?php

class Question
{
  public $type_id;
  public $text;
  public $answer;
  public $correct;

  public function __construct()
  {
    $this->type_id = -1;
    $this->text = "";
    $this->answer = "";
    $this->correct = false;
  }

}

?>