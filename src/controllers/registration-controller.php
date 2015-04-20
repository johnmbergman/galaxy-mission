<?php
/*
  John Bergman
  Updated: March 26, 2015
  RegistrationController class for accepting a RegistrationModel and registering a parent or teacher account.
*/

class RegistrationController
{
  private $model;


  // Constructor
  public function __construct($model)
  {
    $this->model = $model;
  }


  // Register a new account
  public function Register()
  {

    // Generate the appropriate query string
    if($this->model->type == "parent")
    {
      $sql = "insert into parents (email,first_name,last_name,hash,date_created) values ('" . $this->model->email . "','" . $this->model->firstname ."', '" . $this->model->lastname . "','". password_hash($this->model->password, PASSWORD_DEFAULT) . "','" . date("Y-m-d H:i:s") . "')";
    }
    elseif($this->model->type == "teacher")
    {
      $sql = "insert into teachers (email,first_name,last_name,hash,date_created) values ('" . $this->model->email . "','" . $this->model->firstname ."', '" . $this->model->lastname . "','". password_hash($this->model->password, PASSWORD_DEFAULT) . "','" . date("Y-m-d H:i:s") . "')";
    }
    else
    {
      trigger_error("Type is neither parent nor teacher!");
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

