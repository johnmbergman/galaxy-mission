<?php
require "data.php";

class ProfileController
{
  private $model;


  // Constructor
  public function __construct($model)
  {
    $this->model = $model;
  }


  // Update account information
  public function Update()
  {

    // Create the sql string
    $sql = "update " . (($this->model->type == "parent") ? "parents" : "teachers") . " set first_name=?,last_name=?,phone=? where email=?";
    $returnflag = false;

    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    // Successfully connected to the database. Run the query
    if($query = $conn->prepare($sql))
    {

      // Bind the parameters and execute
      $query->bind_param("ssss", $this->model->firstname, $this->model->lastname, $this->model->phone, $_SESSION["email"]);
      $query->execute();
      $_SESSION["firstname"] = $this->model->firstname;
      $_SESSION["lastname"] = $this->model->lastname;
      $_SESSION["phone"] = $this->model->phone;
      $returnflag = true;

    }

    // Close the connection and return the result
    $conn->close();
    return $returnflag;
  }

}