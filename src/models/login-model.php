<?php
/*
  John Bergman
  Updated: March 26, 2015
  LoginModel class for modeling login credentials before passing to the LoginController.
*/

class LoginModel
{
  public $email;
  public $password;

  public function __construct()
  {
    $email = "";
    $password = "";
  }

  public function ValidEmail()
  {
    return filter_var($this->email, FILTER_VALIDATE_EMAIL);
  }
}

?>