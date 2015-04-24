<?php


class ReportsController
{
  private $model;
  
  // Constructor
  public function __construct($model)
  {
    $this->model = $model;
  }
  
  public function getAssessmentLevel()
  {
  	$sql = "select assessment_level from students where student_id = " . ($this->model->studentid);
  	
  	// Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    // Successfully connected to the database. Run the query
    if($conn->query($sql) == false)
    {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    }
    else 
    	return ($conn->query($sql)->fetch_array(MYSQLI_NUM)[0]);
  }
  
  public function getGameLevel()
  {
  	$sql = "select game_level from students where student_id = " . ($this->model->studentid);
  	
  	// Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    // Successfully connected to the database. Run the query
    if($conn->query($sql) == false)
    {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    }
    else 
    	return ($conn->query($sql)->fetch_array(MYSQLI_NUM)[0]);
  }
    	
  // returns the student's mission completion percentage
  public function CompletionPercentage()
  {
  
  	$sql1 = "select count(mission_record_id) from student_mission_record where student_id = " . ($this->model->studentid) . " and number_correct between 8 and 10";
  	$sql2 = "select count(mission_record_id) from student_mission_record where student_id = " . ($this->model->studentid);
  	
  	// Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

  // Successfully connected to the database. Run the query
    if($conn->query($sql1) == false)
    {
      echo "bad sql " . $sql1;
      trigger_error("Failed to register the account");
    }
    else 
      $missionsPassed = $conn->query($sql1)->fetch_array(MYSQLI_NUM)[0];
      
    if($conn->query($sql2) == false)
    {
      echo "bad sql " . $sql2;
      trigger_error("Failed to register the account");
    }
    else
      $missionsAttempted = $conn->query($sql2)->fetch_array(MYSQLI_NUM)[0];
     
    if ($missionsAttempted != 0)
    {  
    return (100*($missionsPassed/$missionsAttempted));
    }
    else
      return "0";
  }
  
  // returns the student's total correct answer percentage
  public function CorrectPercentage()
  {
  	$sql1 = "select sum(number_correct) from student_mission_record where student_id = ".($this->model->studentid);
  	$sql2 = "select count(*) from student_mission_record where student_id = ".($this->model->studentid);
  	
  	// Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

  // Successfully connected to the database. Run the query
    if($conn->query($sql1) == false)
    {
      echo "bad sql " . $sql1;
      trigger_error("Failed to register the account");
    }
    else 
      $questionsCorrect = $conn->query($sql1)->fetch_array(MYSQLI_NUM)[0];
    
    if($conn->query($sql2) == false)
    {
      echo "bad sql " . $sql2;
      trigger_error("Failed to register the account");
    }
    else
      $missionsAttempted = $conn->query($sql2)->fetch_array(MYSQLI_NUM)[0];
    if ($missionsAttempted != 0)
    {
      return (100*($questionsCorrect/(10*$missionsAttempted)));
	}
	else
	  return "0";
      
  }
  
  public function MissionsAttemptedByLevel($gradeLevel)
  {
  	$sql = "select count(distinct student_mission_record.question_type_id) from question_type join student_mission_record on (question_type.question_type_id=student_mission_record.question_type_id) where question_type.grade_level = ".($gradeLevel)." and student_mission_record.student_id = ".($this->model->studentid);
  		
  	// Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

  // Successfully connected to the database. Run the query
    if($conn->query($sql) == false)
    {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    }
    else 
      return ($conn->query($sql)->fetch_array(MYSQLI_NUM)[0]);
  }
	
  public function MissionsCompletedByLevel($gradeLevel)
  {
  	$sql = "select count(distinct student_mission_record.question_type_id) from question_type join student_mission_record on (question_type.question_type_id=student_mission_record.question_type_id) where question_type.grade_level = " .($gradeLevel). " and student_mission_record.student_id = " .($this->model->studentid). " and student_mission_record.number_correct between 8 and 10";
  	
  	// Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

  // Successfully connected to the database. Run the query
    if($conn->query($sql) == false)
    {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    }
    else 
      return ($conn->query($sql)->fetch_array(MYSQLI_NUM)[0]);
  }
  
  public function UncompletedMissionsByLevel($gradeLevel)
  {
  	$sql = "select question_type.name from question_type where question_type.question_type_id not in (select student_mission_record.question_type_id from student_mission_record where student_mission_record.student_id=".($this->model->studentid).") and question_type.grade_level= ".($gradeLevel);
  	
  	// Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

  // Successfully connected to the database. Run the query
    if($conn->query($sql) == false)
    {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    }
    else 
      $result =$conn->query($sql);    
    while ($row = $result->fetch_assoc()) {
        echo $row["name"]."<br>";
    }
  }
 /* public function BestMissionByLevel($gradeLevel)
  {
    $sql = "select max(avg_num_correct) from (select avg(number_correct) as avg_number_correct from student_mission_record join question_type on (student_mission_record.question_type_id=question_type.question_type_id) where student_mission_record.student_id = ".($this->model->studentid)." and question_type.grade_level = ".($gradeLevel).")";
    
    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    // Successfully connected to the database. Run the query
    if($conn->query($sql) == false)
    {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    }
    else 
      return ($conn->query($sql)->fetch_array(MYSQLI_NUM)[0]);
  }*/ 
  
  
  public function LevelCorrectPercentage($gradeLevel)
  {
    $sql1 = "select sum(student_mission_record.number_correct) from student_mission_record join question_type on student_mission_record.question_type_id=question_type.question_type_id where student_mission_record.student_id = ".($this->model->studentid)." and question_type.grade_level = ".($gradeLevel);
  	$sql2 = "select count(*) from student_mission_record join question_type on student_mission_record.question_type_id=question_type.question_type_id where student_mission_record.student_id = ".($this->model->studentid)." and question_type.grade_level = ".($gradeLevel);
  	
  	// Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

  // Successfully connected to the database. Run the query
    if($conn->query($sql1) == false)
    {
      echo "bad sql " . $sql1;
      trigger_error("Failed to register the account");
    }
    else 
      $questionsCorrect = ($conn->query($sql1)->fetch_array(MYSQLI_NUM)[0]);
    
    if($conn->query($sql2) == false)
    {
      echo "bad sql " . $sql2;
      trigger_error("Failed to register the account");
    }
    else
      $missionsAttempted = ($conn->query($sql2)->fetch_array(MYSQLI_NUM)[0]);
    
    if ($missionsAttempted != 0)
    {
      return (100*($questionsCorrect/(10*$missionsAttempted)));
    }
    else
      return "0";
  }
	
  public function MissionsAttemptedBySubject($subject)
  {
  	$sql = "select count(distinct student_mission_record.question_type_id) from student_mission_record join question_type on (student_mission_record.question_type_id=question_type.question_type_id) where student_mission_record.student_id = ".($this->model->studentid)." and question_type.subject_code = " .($subject);
  	// Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

  // Successfully connected to the database. Run the query
    if($conn->query($sql) == false)
    {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    }
    else 
      return ($conn->query($sql)->fetch_array(MYSQLI_NUM)[0]);
  }
  
  public function MissionsCompletedBySubject($subject)
  {
  	$sql = "select count(distinct student_mission_record.question_type_id) from student_mission_record join question_type on (student_mission_record.question_type_id=question_type.question_type_id) where student_mission_record.student_id = ".($this->model->studentid)." and student_mission_record.number_correct between 8 and 10 and question_type.subject_code = " .($subject);
  	// Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

  // Successfully connected to the database. Run the query
    if($conn->query($sql) == false)
    {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    }
    else 
      return ($conn->query($sql)->fetch_array(MYSQLI_NUM)[0]);
  }
	
  public function CorrectPercentageBySubject($subject)
  {
    $sql1 = "select sum(student_mission_record.number_correct) from student_mission_record join question_type on (student_mission_record.question_type_id=question_type.question_type_id) where student_mission_record.student_id = ".($this->model->studentid)." and question_type.subject_code = ".($subject);
    $sql2 = "select count(*) from student_mission_record join question_type on (student_mission_record.question_type_id=question_type.question_type_id) where student_mission_record.student_id = ".($this->model->studentid)." and question_type.subject_code = ".($subject);
    
    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

  // Successfully connected to the database. Run the query
    if($conn->query($sql1) == false)
    {
      echo "bad sql " . $sql1;
      trigger_error("Failed to register the account");
    }
    else 
      $questionsCorrect = ($conn->query($sql1)->fetch_array(MYSQLI_NUM)[0]);
    
    if($conn->query($sql2) == false)
    {
      echo "bad sql " . $sql2;
      trigger_error("Failed to register the account");
    }
    else
      $questionsAttempted = (($conn->query($sql2)->fetch_array(MYSQLI_NUM)[0]) * 10);
    
    if($questionsAttempted != 0)
    {  
    	return (100*($questionsCorrect/$questionsAttempted));
    }
    else return "0";
  }
  
  public function MissionAttempted($question_type_id)
  {
  	$sql = "select count(*) from student_mission_record join question_type on student_mission_record.question_type_id=question_type.question_type_id where student_mission_record.student_id=".($this->model->studentid)." and question_type.question_type_id=".($question_type_id);
  	
  	// Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

  // Successfully connected to the database. Run the query
    if($conn->query($sql) == false)
    {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    }
    else 
      if (($conn->query($sql)->fetch_array(MYSQLI_NUM)[0]) > 0)
        return true;
      else
        return false;
  }
    
  public function HighestMissionAttempted()
  {
    $sql = "select MAX(question_type_id) from student_mission_record where student_id = ".($this->model->studentid);
    
    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

  // Successfully connected to the database. Run the query
    if($conn->query($sql) == false)
    {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    }
    else 
      return ($conn->query($sql)->fetch_array(MYSQLI_NUM)[0]);
  }
  
  public function GetMissionName($question_type_id)
  {
    $sql = "select question_type.name from question_type where question_type_id = ".($question_type_id);
    
    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

  // Successfully connected to the database. Run the query
    if($conn->query($sql) == false)
    {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    }
    else 
      $result =$conn->query($sql);    
    while ($row = $result->fetch_assoc()) {
        echo $row["name"]."<br>";
    }
  }
  
  public function AttemptsByMission($question_type_id)
  {
    $sql = "select count(*) from student_mission_record join question_type on student_mission_record.question_type_id=question_type.question_type_id where student_mission_record.student_id=".($this->model->studentid)." and question_type.question_type_id=".($question_type_id);
    
    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    // Successfully connected to the database. Run the query
    if($conn->query($sql) == false)
    {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    }
    else 
      return ($conn->query($sql)->fetch_array(MYSQLI_NUM)[0]);
  }
  
  public function AvgMissionScore($question_type_id)
  {
    $sql1 = "select sum(student_mission_record.number_correct) from student_mission_record join question_type on (student_mission_record.question_type_id=question_type.question_type_id) where student_mission_record.student_id = ".($this->model->studentid)." and question_type.question_type_id = ".($question_type_id);
    $sql2 = "select count(*) from student_mission_record join question_type on (student_mission_record.question_type_id=question_type.question_type_id) where student_mission_record.student_id = ".($this->model->studentid)." and question_type.question_type_id = ".($question_type_id);
    
    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

  // Successfully connected to the database. Run the query
    if($conn->query($sql1) == false)
    {
      echo "bad sql " . $sql1;
      trigger_error("Failed to register the account");
    }
    else 
      $questionsCorrect = ($conn->query($sql1)->fetch_array(MYSQLI_NUM)[0]);
    
    if($conn->query($sql2) == false)
    {
      echo "bad sql " . $sql2;
      trigger_error("Failed to register the account");
    }
    else
      $questionsAttempted = (($conn->query($sql2)->fetch_array(MYSQLI_NUM)[0]) * 10);
    
    if($questionsAttempted != 0)
    {  
    	return (100*($questionsCorrect/$questionsAttempted));
    }
    else return "0";
  }
  
  public function MissionHighScore($question_type_id)
  {
    $sql = "select max(student_mission_record.number_correct) from student_mission_record join question_type on (student_mission_record.question_type_id=question_type.question_type_id) where student_mission_record.student_id = ".($this->model->studentid)." and question_type.question_type_id = ".($question_type_id);
    
    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    // Successfully connected to the database. Run the query
    if($conn->query($sql) == false)
    {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    }
    else 
      $maxQuestionsCorrect = ($conn->query($sql)->fetch_array(MYSQLI_NUM)[0]);
      
    return (100*($maxQuestionsCorrect/10));
  }
    
}

?>
    
    