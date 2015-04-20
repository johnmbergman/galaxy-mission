<?php

/* 
	Student Login Controller
	Created: 4/16/15
*/

require "data.php";

class StudentLoginController
{
  private $model;
  
  // Constructor
  public function __construct($model)
  {
    $this->model = $model;
  }


  // Validate the login
  public function Authenticate()
  {
	 // Validation boolean
    $returnflag = false;

    // Build the sql query
    $sql = "select student_id, pwd_picture, first_name, last_name, grade_level, game_level from students where student_id='" . $this->model->studentId . "'"; 
    
    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    // Run the query
    $result = $conn->query($sql);
    $row = $result->fetch_row();

    // Check if the password matches
    if($this->model->pwd_picture == $row(1))
    {
      // The password matches, authenticate and retrieve values
      $returnflag = true;
      $_SESSION["authenticated"] = true;
      $_SESSION["student_id"] = $row[0];
      $_SESSION["firstname"] = $row[2];
      $_SESSION["lastname"] = $row[3];
      $_SESSION["grade_level"] = $row[4];
      $_SESSION["game_level"] = $row[5];
      
    }
    else
    {
      $_SESSION["authenticated"] = false;
      $_SESSION["student_id"] = -1;
      $_SESSION["firstname"] = "";
      $_SESSION["lastname"] = "";
      $_SESSION["grade_level"] = "";
      $_SESSION["game_level"] = "";
    }

    // CLose the connection and return the result
    $conn->close();
    return $returnflag;

  }

}

?>

   