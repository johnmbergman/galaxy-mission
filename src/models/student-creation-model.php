<?php

class StudentCreationModel
{
  public $type;
  public $firstname;
  public $lastname;
  public $email;
  public $password;
  public $repeatpass;

  public function __construct()
  {
    $type = "invalid";
    $firstname = "";
    $lastname = "";
    $email = "";
    $password = "";
    $repeatpass = "";
  }

  public function ValidEmail()
  {
    return filter_var($this->email, FILTER_VALIDATE_EMAIL);
  }

  public function ValidPassword()
  {
    return ($this->password == $this->repeatpass);
  }

  public function ValidPasswordLength()
  {
    return (strlen($this->password) >= 6);
  }

  public function ValidName()
  {
    return (strlen($this->firstname) > 0 && strlen($this->lastname) > 0);
  }
}

?>