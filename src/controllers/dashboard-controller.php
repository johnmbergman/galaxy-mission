<?php

class DashboardController {

  private $model;

  public function __construct($model) {
    $this->model = $model;
  }

  public function getKinderPercentComplete() {
    $sql1 = "SELECT count(mission_record_id) FROM student_mission_record WHERE student_id = " . ($this->model->studentid) . " and number_correct between 8 and 10" . " and grade_level = 0";
    $sql2 = "SELECT count(mission_id) FROM missions WHERE grade_level = 0";

    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error) {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    if($conn->query($sql1) == false) {
      echo "bad sql " . $sql1;
      trigger_error("Failed to register the account");
    } else {
      $missionsComplete = $conn->query($sql1)->fetch_array(MYSQLI_NUM)[0];
    }

    if($conn->query($sql2) == false) {
      echo "bad sql " . $sql2;
      trigger_error("Failed to register the account");
    } else {
      $totalMissions = $conn->query($sql2)->fetch_array(MYSQLI_NUM)[0];
    }

    if($totalMissions != 0) {
      return (100*($missionsComplete/$totalMissions));
    } else {
      return "0";
    }
  }
  
  public function getFirstPercentComplete() {
    $sql1 = "SELECT count(mission_record_id) FROM student_mission_record WHERE student_id = " . ($this->model->studentid) . " and number_correct between 8 and 10" . " and grade_level = 0";
    $sql2 = "SELECT count(mission_id) FROM missions WHERE grade_level = 1";

    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error) {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    if($conn->query($sql1) == false) {
      echo "bad sql " . $sql1;
      trigger_error("Failed to register the account");
    } else {
      $missionsComplete = $conn->query($sql1)->fetch_array(MYSQLI_NUM)[0];
    }

    if($conn->query($sql2) == false) {
      echo "bad sql " . $sql2;
      trigger_error("Failed to register the account");
    } else {
      $totalMissions = $conn->query($sql2)->fetch_array(MYSQLI_NUM)[0];
    }

    if($totalMissions != 0) {
      return (100*($missionsComplete/$totalMissions));
    } else {
      return "0";
    }
  }

  public function getSecondPercentComplete() {
    $sql1 = "SELECT count(mission_record_id) FROM student_mission_record WHERE student_id = " . ($this->model->studentid) . " and number_correct between 8 and 10" . " and grade_level = 0";
    $sql2 = "SELECT count(mission_id) FROM missions WHERE grade_level = 2";

    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error) {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    if($conn->query($sql1) == false) {
      echo "bad sql " . $sql1;
      trigger_error("Failed to register the account");
    } else {
      $missionsComplete = $conn->query($sql1)->fetch_array(MYSQLI_NUM)[0];
    }

    if($conn->query($sql2) == false) {
      echo "bad sql " . $sql2;
      trigger_error("Failed to register the account");
    } else {
      $totalMissions = $conn->query($sql2)->fetch_array(MYSQLI_NUM)[0];
    }

    if($totalMissions != 0) {
      return (100*($missionsComplete/$totalMissions));
    } else {
      return "0";
    }    
  }

  public function getThirdPercentComplete() {
    $sql1 = "SELECT count(mission_record_id) FROM student_mission_record WHERE student_id = " . ($this->model->studentid) . " and number_correct between 8 and 10" . " and grade_level = 0";
    $sql2 = "SELECT count(mission_id) FROM missions WHERE grade_level = 3";

    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error) {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    if($conn->query($sql1) == false) {
      echo "bad sql " . $sql1;
      trigger_error("Failed to register the account");
    } else {
      $missionsComplete = $conn->query($sql1)->fetch_array(MYSQLI_NUM)[0];
    }

    if($conn->query($sql2) == false) {
      echo "bad sql " . $sql2;
      trigger_error("Failed to register the account");
    } else {
      $totalMissions = $conn->query($sql2)->fetch_array(MYSQLI_NUM)[0];
    }

    if($totalMissions != 0) {
      return (100*($missionsComplete/$totalMissions));
    } else {
      return "0";
    }    
  }

  public function getStarsEarned() {
    $stars = "SELECT count(mission_record_id) FROM student_mission_record WHERE student_id = " . ($this->model->studentid) . " and number_correct between 8 and 10";

    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error) {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    if($conn->query($stars) == false) {
      echo "bad sql " . $stars;
      trigger_error("Failed to register the account");
    } else {
      $starsEarned = $conn->query($stars)->fetch_array(MYSQLI_NUM)[0];
    }
    
    return $starsEarned;
  }

}

?>