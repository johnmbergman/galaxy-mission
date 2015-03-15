<?php
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
    if(password_verify($this->model->password, $this->GetHash()))
    {
      // Validated
      $_SESSION["authenticated"] = true;
      $_SESSION["email"] = $this->model->email;
      return true;
    }
    else
    {
      // Not validated
      $_SESSION["authenticated"] = false;
      $_SESSION["email"] = "";
      return false;
    }
  }


  // Get the password hash from the table
  private function GetHash()
  {
    // TODO: Test this query to ensure it works properly!
    $sql = "select hash from parents where email='" . $this->model->email . "' union select hash from teachers where email='" . $this->model->email . "'";
    $returnstring = "";

    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    // Successfully connected to the database, return the result
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    $returnstring = $row[0];

    // Close the connection and return the result
    $conn->close();
    return $returnstring;

  }
}

?>