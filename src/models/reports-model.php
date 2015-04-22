<?php

Class ReportsModel {

  public $studentid;
  public $assessmentLevel;
  public $gameLevel;
  
   public function __construct()
  {
    $this->studentid = -1;
    $this->assessmentLevel = -1;
    $this->gameLevel = -1;
  }
    
  public function ValidStudentId()
  {
    return ($this->studentid > 0);
  }
}

?>
  