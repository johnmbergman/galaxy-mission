<?php

public class Question
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
    $var_count = "";
    $equation_answer = "";
    $equation_remainder = "";
  }

  public static function QuestionFactory($qtype_id, $qdifficulty)
  {
    $question = new Question();

    // Add code to generate the question here

    return $question;
  }
}

public enum 
?>