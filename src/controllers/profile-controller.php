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
    $sql = "";
    if($this->model->type == "parent")
    {
      $sql = "update parents set email='" . $this->model->email . "',first_name='" . $this->model->firstname . "',last_name='" . $this->model->lastname . "'";
    }
    else if($this->model->type == "teacher")
    {
      $sql = "update teachers set email='" . $this->model->email . "',first_name='" . $this->model->firstname . "',last_name='" . $this->model->lastname . "'";
    }
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
      trigger_error("Failed to update the account");
    }
    else
    {
      $returnflag = true;
    }

    // Close the connection and return the result
    $conn->close();
    return $returnflag;
  }


  // Ensure the email is not already registered
  public function EmailAvailable($email)
  {
    $sql = "select email from parents where email='" . $email . "' union select email from teachers where email='" . $email . "'";   

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

