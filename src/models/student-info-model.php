<?php
/*
  Shaun Fyffe
  Updated: March 28, 2015
  StudentInfoModel class for modeling Student Account Information before passing to the StudentInfoController
*/

class StudentInfoModel {
  public $studentid;
  public $parentid;
  public $firstname;
  public $lastname;
  public $grade;

  public function __construct() {
    $this->studentid = -1;
    $this->parentid = -1;
    $this->firstname = "";
    $this->lastname = "";
    $this->grade = 0;
  }

  public function ValidName() {
    return (strlen($this->firstname) > 0 && strlen($this->lastname) > 0);
  }

  public function ValidGrade() {
    return ($this->grade >= 0 && $this->grade <= 3);
  }

}

?>