<?php
/* 
	Student Login Model
	Adam Hill
	Created 4/16/15
*/

Class StudentLoginModel {
  
  public $studentId;
  public $password;
    
  public function __construct()    
  {
    $studentId = "";
    $password = "";
  }
    
  public function ValidStudentId()
  {
	return filter_var($this->studentId > 0);
  }
}

?>