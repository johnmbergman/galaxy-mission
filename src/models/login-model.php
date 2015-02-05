<?php

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