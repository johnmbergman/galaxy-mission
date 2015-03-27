<?php
/*
  John Bergman
  Updated: March 26, 2015
  RegistrationModel class for modeling a new account to be registered.
*/

class RegistrationModel
{
  public $type;
  public $firstname;
  public $lastname;
  public $email;
  public $password;
  public $repeatpass;


  // Constructor
  public function __construct()
  {
    $type = "invalid";
    $firstname = "";
    $lastname = "";
    $email = "";
    $password = "";
    $repeatpass = "";
  }


  // Returns true if the e-mail address is valid email format
  public function ValidEmail()
  {
    return filter_var($this->email, FILTER_VALIDATE_EMAIL);
  }


  // Returns true if the password and confirm password fields match
  public function ValidPassword()
  {
    return ($this->password == $this->repeatpass);
  }


  // Returns true if the password is at least 6 characters
  public function ValidPasswordLength()
  {
    return (strlen($this->password) >= 6);
  }


  // Returns true if the user specified a first and last name
  public function ValidName()
  {
    return (strlen($this->firstname) > 0 && strlen($this->lastname) > 0);
  }


  // Returns true if the type specified is 'parent' or 'teacher'
  public function ValidType()
  {
    return ($this->type == "parent" || $this->type == "teacher");
  }
}

?>