<?php

class RegistrationModel
{
  public $email;
  public $password;
  public $repeatpass;

  public function __construct()
  {
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

}

?>