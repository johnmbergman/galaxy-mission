<?php
/* 
	Student Login Model
	Adam Hill
	Created 4/16/15
*/

Class StudentLoginModel {
  
  public $studentId;
  public $pwd_picture;
    
  public function __construct()    
  {
    $studentId = "";
    $pwd_picture = "";
  }
    
  public function ValidStudentId()
  {
	return filter_var($this->studentId > 0);
  }
}

?>