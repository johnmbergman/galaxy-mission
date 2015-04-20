<?php
/* 
	Student Login Model
	Adam Hill
	Created 4/16/15
*/

Class StudentLoginModel {

  public $studentid;
  public $parentid;
  public $pwd_picture;

  public function __construct()
  {
    $this->studentid = -1;
    $this->parentid = -1;
    $this->pwd_picture = -1;
  }
    
  public function ValidStudentId()
  {
    return ($this->studentid > 0);
  }
}

?>