<?php

class DashboardDataModel
{
  public $studentid;
  public $student_first_name;
  public $completed_missions;
  public $completed_units;
  public $stars_earned;
  public $start_date;
  public $time_played;
  public $kindergarten_progress;

  public function __construct()
  {
    $this->studentid = -1;
    $this->student_first_name = "";
    $this->completed_missions = 0;
    $this->completed_units = 0;
    $this->stars_earned = 0;
    $this->start_date = "Unspecified Date";
    $this->time_played = "Unknown";
    $this->kindergarten_progress = 0; 
  }
}

?>