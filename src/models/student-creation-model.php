<?php
/*
  Adam Hill
  Updated: March 28, 2015
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
    $password = "";
    $parent_id = "";
  }

  // Checks for valid first name
  public function ValidFirstName()
  {
    return (strlen($this->firstname) > 0);
  }
  
  // Checks for valid last name
  public function ValidLastName()
  {
    return (strlen($this->lastname) > 0);
  }
  
  // Checks that passcode image icon is selected and valid int value is stored in variable
  public function ValidPassword()
  {
    return ($this->password != "" && $this->password >= 0 && $this->password < 8);
  }
}

?>