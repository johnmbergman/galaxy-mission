<?php

class DashboardDataModel
{
  public $studentid;
  public $start_date;
  public $student_grade_level;

  public function __construct()
  {
    $this->studentid = -1;
    $this->start_date = "Unspecified Date";
    $this->student_grade_level = 0;
  }

  public function ValidStudentId() {
    return ($this->studentid > 0);
  }
}
?>