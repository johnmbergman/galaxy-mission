<?php
/*
  Adam Hill
  Created: March 27, 2015
  StudentCreationController class for accepting a StudentCreationModel and registering a student account.
*/
require "data.php";

class StudentCreationController
{
  private $model;


  // Constructor
  public function __construct($model)
  {
    $this->model = $model;
  }
  
  // Register a new student account
  public function Register()
  {
  // generate the query string
	$sql = "insert into student (parent_id, first_name,last_name,pwd_picture,grade_level,date_created) values (" . $this->model->parent_id .",'" . $this->model->firstname ."', '" . $this->model->lastname . "','". $this->model->password ."','" . $this->model->gradelevel."','" . date("Y-m-d H:i:s") ."')";
  
    $returnflag = false;
   
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
    {
      $returnflag = true;
    }

    // Close the connection and return the result
    $conn->close();
    return $returnflag;
  }
  
  // Ensure the student is not already registered
  public function NametAvailable($firstname, $lastname, $parent_id)
  {
    $sql = "select first_name from student where parent_id='" . $parent_id . "' and first_name='" . $firstname . "' and last_name='" . $lastname . "'"; 

    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    // Successfully connected to the database. Run the query
    $rs = $conn->query($sql);
    if($rs->num_rows > 0)
    {
      $returnflag = false;
    }
    else
    {
      $returnflag = true;
    }   
    

    // Close the connection and return the result
    $conn->close();
    return $returnflag;
  }
}
   
   
