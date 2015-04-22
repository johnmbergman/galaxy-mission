<?php


class ReportsController
{
  private $model;
  
  // Constructor
  public function __construct($model)
  {
    $this->model = $model;
  }
  
  // returns the student's mission completion percentage
  public function CompletionPercentage()
  {
  
  	$sql1 = "select count(*) from student_mission_record where student_id = " . ($this->model->studentid) . " and number_correct > 7";
  	$sql2 = "select count(*) from student_mission_record where student_id = " . ($this->model->studentid) . ;
  	
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
      $missionsPassed = $conn->query($sql1);
    
    if($conn->query($sql2) == false)
    {
      echo "bad sql " . $sql2;
      trigger_error("Failed to register the account");
    }
    else
      $missionsAttempted = $conn->query($sql2);
      
    return (100*($missionsPassed/$missionsAttempted));
  }
  
  // returns the student's total correct answer percentage
  public function CorrectPercentage()
  {
  	$sql1 = "select count(*) from student_question_result where student_id = ".($this-model->studentid)." and student_question_result.student_answer = student_question_result.correct_answer";
  	$sql2 = "select count(*) from student_question_result where student_id = ".($this->model->studentid)."";
  	
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
      $questionsCorrect = $conn->query($sql1);
    
    if($conn->query($sql2) == false)
    {
      echo "bad sql " . $sql2;
      trigger_error("Failed to register the account");
    }
    else
      $questionsAttempted = $conn->query($sql2);
      
    return (100*($questionsCorrect/$questionsAttempted));
  }
  
  public function MissionsAttemptedByLevel($gradeLevel)
  {
  	$sql = "count (distinct mission_id) from question_type join student_mission_record on question_type_id where question_type.grade_level = ".($gradeLevel)." and student_mission_record.student_id = ".($this->model->studentid)."";
  		
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
    	$result = $conn->query($sql);
    	return ($result);
  }
	
  public function MissionCompleteByLevel($gradeLevel)
  {
  	$sql ="count (distinct mission_id) from question_type join student_mission_record on question_type_id where question_type_id.grade_level = ".($gradeLevel)." and student_mission_record.student_id = ".($this->model->studentid)." and student_mission_record.number_correct > 7";
  	
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
    	$result = $conn->query($sql);
    	return ($result);
  }
  
  public function LevelCorrectPercentage($gradeLevel)
  {
    $sql1 = "select sum(number_correct) from student_mission_record join question_type on question_type_id where student_mission_record.student_id = ".($this-model->studentid)." and question_type.grade_level = ".($gradeLevel). "";
  	$sql2 = "select count(*) from student_mission_record join question_type on question_type_id where student_mission_record.student_id = ".($this->model->studentid)." and question_type_id.grade_level = ".($gradeLevel)."";
  	
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
      $questionsCorrect = $conn->query($sql1);
    
    if($conn->query($sql2) == false)
    {
      echo "bad sql " . $sql2;
      trigger_error("Failed to register the account");
    }
    else
      $questionsAttempted = ($conn->query($sql2) * 10);
      
    return (100*($questionsCorrect/$questionsAttempted));
  }
	
	
	
?>
    
    