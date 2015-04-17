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
	// needs to be implemented
  }
}

?>
   