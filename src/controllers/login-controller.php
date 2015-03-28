<?php
/*
  John Bergman
  Updated: March 26, 2015
  LoginController class for accepting a LoginModel and authenticating a user account.
*/
require "data.php";

class LoginController
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
    $sql = "select parent_id as id, hash, email, 'parent' as type, first_name, last_name, phone from parents where email='" . $this->model->email . "' union select teacher_id as id, hash, email, 'teacher' as type, first_name, last_name, phone from teachers where email='" . $this->model->email . "'";

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
    if(password_verify($this->model->password, $row[1]))
    {
      // The password matches, authenticate and retrieve values
      $returnflag = true;
      $_SESSION["authenticated"] = true;
      $_SESSION["user_id"] = $row[0];
      $_SESSION["email"] = $row[2];
      $_SESSION["type"] = $row[3];
      $_SESSION["firstname"] = $row[4];
      $_SESSION["lastname"] = $row[5];
      $_SESSION["phone"] = $row[6];
    }
    else
    {
      $_SESSION["authenticated"] = false;
      $_SESSION["user_id"] = -1;
      $_SESSION["email"] = "";
      $_SESSION["type"] = "";
      $_SESSION["firstname"] = "";
      $_SESSION["lastname"] = "";
      $_SESSION["phone"] = "";
    }

    // CLose the connection and return the result
    $conn->close();
    return $returnflag;

  }

}

?>