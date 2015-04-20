<?php

/* 
	Student Login Controller
	Created: 4/16/15
*/

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
    
    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    // Successfully connected to the database. Run the query
    if($query = $conn->prepare("select student_id,first_name,last_name,grade_level,game_level from students where student_id=? and pwd_picture=? and parent_id=?"))
    {

      // Bind the parameters and execute
      $query->bind_param("iii", $this->model->studentid, $this->model->pwd_picture, $this->model->parentid);
      $query->execute();
      $query->bind_result($r_student_id, $r_firstname, $r_lastname, $r_grade, $r_game);
      if($query->fetch())
      {
        // Successfully logged in!
        $returnflag = true;
        $_SESSION["current_student_id"] = $r_student_id;
        $_SESSION["current_student_name"] = $r_firstname . " " . $r_lastname;
        $_SESSION["current_student_grade"] = $r_grade;
        $_SESSION["current_student_game_level"] = $r_game;
      }
      else
      {
        // No result
        $returnflag = false;
        $_SESSION["current_student_id"] = "";
        $_SESSION["current_student_name"] = "";
        $_SESSION["current_student_grade"] = "";
        $_SESSION["current_student_game_level"] = "";
      }
    }

    // CLose the connection and return the result
    $conn->close();
    return $returnflag;

  }

}

?>
