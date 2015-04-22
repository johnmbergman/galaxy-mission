<?php

Class ReportsModel {

  public $studentid;
  
   public function __construct()
  {
    $this->studentid = -1;
  }
    
  public function ValidStudentId()
  {
    return ($this->studentid > 0);
  }
}

?>
  