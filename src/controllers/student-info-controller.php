<?php 
/*
  Shaun Fyffe
  Updated: March 28, 2015
  StudentInfoController class for accepting a StudentInfoModel and updating account information in database.
*/

class StudentInfoController
{
  private $model;

  // Constructor
  public function __construct($model) {
    $this->model = $model;
  }

  // Update account information
  public function Update() {
    // Create the sql string
    $sql = "update students set first_name=?, last_name=?, grade_level=? where student_id=? and parent_id=?";
    $returnflag = false;

    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error) {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    // Successfully connected to the database. Run the query
    if($query = $conn->prepare($sql)) {

      // Bind the parameters and execute
      $query->bind_param("sssii", $this->model->firstname, $this->model->lastname, $this->model->grade, $this->model->studentid, $this->model->parentid);
      $query->execute();
      $returnflag = true;
    }

    // Close the connection and return the result
    $conn->close();
    return $returnflag;
  }
}