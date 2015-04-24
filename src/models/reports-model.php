<?php
/*
	Rerorts Model
	Created by Adam Hill
	4/20/15
*/

Class ReportsModel {

  public $studentid;
  
  public function __construct(){
  
    $this->studentid = -1;
    
  }
    
  public function ValidStudentId(){
  
    return ($this->studentid > 0);
    
  }
}

?>
  