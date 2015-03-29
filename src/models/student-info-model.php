<?php

class StudentInfoModel {
  public $firstname;
  public $lastname;
  public $grade;
  public $schoolname;
  public $teachername;

  public function __construct() {
    $firstname = "";
    $lastname = "";
    $gender = "";
    $grade = "";
    $schoolname = "";
    $teachername = "";
  }

  public function ValidName() {
    return (strlen($this->firstname) > 0 && strlen($this->lastname) > 0);
  }

  public function ValidGrade() {
    return ($this->grade == "Kindergarten" || $this->grade == "1st Grade");
  }

  public function ValidSchoolName() {
    return (strlen($this->schoolname) <= 50;
  }

  public function ValidTeacherName() {
    return (strlen($this->teachername) <= 30;
  }
}

?>