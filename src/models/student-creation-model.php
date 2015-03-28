<?php
/*
  Adam Hill
  Created: March 27, 2015
  StudentCreationModel class for modeling a new student account to be registered.
*/

class StudentCreationModel
{
  public $firstname;
  public $lastname;
  public $gradelevel;
  public $password;
  public $parent_id;
  
  public function __construct()
  {
    $firstname = "";
    $lastname = "";
    $gradelevel = "";
    $passwordimage = "";
    $parent_id = "";
  }

  public function ValidName()
  {
    return (strlen($this->firstname) > 0 && strlen($this->lastname) > 0);
  }
  
}

?>