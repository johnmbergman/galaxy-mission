<?php

class DashboardController {

  private $model;

  public function __construct($model) {
    $this->model = $model;
  }

  public function getKinderPercentComplete() {
    $sql1 = "SELECT count(distinct student_mission_record.question_type_id) FROM question_type JOIN student_mission_record on (question_type.question_type_id=student_mission_record.question_type_id) WHERE question_type.grade_level = 0 AND student_mission_record.student_id = " .($this->model->studentid). " AND student_mission_record.number_correct between 8 and 10";
    $sql2 = "SELECT count(grade_level) FROM question_type WHERE grade_level = 0";

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
    $sql1 = "SELECT count(distinct student_mission_record.question_type_id) FROM question_type JOIN student_mission_record on (question_type.question_type_id=student_mission_record.question_type_id) WHERE question_type.grade_level = 1 AND student_mission_record.student_id = " .($this->model->studentid). " AND student_mission_record.number_correct between 8 and 10";
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
    $sql1 = "SELECT count(distinct student_mission_record.question_type_id) FROM question_type JOIN student_mission_record on (question_type.question_type_id=student_mission_record.question_type_id) WHERE question_type.grade_level = 2 AND student_mission_record.student_id = " .($this->model->studentid). " AND student_mission_record.number_correct between 8 and 10";
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
    $sql1 = "SELECT count(distinct student_mission_record.question_type_id) FROM question_type JOIN student_mission_record on (question_type.question_type_id=student_mission_record.question_type_id) WHERE question_type.grade_level = 3 AND student_mission_record.student_id = " .($this->model->studentid). " AND student_mission_record.number_correct between 8 and 10";
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
      return (int)(100*($missionsComplete/$totalMissions));
    } else {
      return "0";
    }    
  }

  public function getMissionsComplete() {
    $result = "SELECT count(mission_record_id) FROM student_mission_record WHERE student_id = " . ($this->model->studentid) . " and number_correct between 8 and 10";

    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error) {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    if($conn->query($result) == false) {
      echo "bad sql " . $result;
      trigger_error("Failed to register the account");
    } else {
      $missionsDone = $conn->query($result)->fetch_array(MYSQLI_NUM)[0];
    }
    
    return $missionsDone;
  }

  public function listCurrentMissions($grade_level) {
    $sql = "SELECT question_type.name FROM question_type WHERE question_type.grade_level = ".($grade_level);

    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error) {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    if($conn->query($sql) == false) {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    } else {
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) {
        echo $row["name"]."<br>";
      }
    }
  }

}

?>