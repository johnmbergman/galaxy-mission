<?php

class ProfileModel
{
  public $firstname;
  public $lastname;
  public $email;
  public $phone;
  public $type;

  public function __construct()
  {
    $firstname = "";
    $lastname = "";
    $email = "";
    $phone = "";
    $type = "";
  }

  public function ValidName()
  {
    return (strlen($this->firstname) > 0 && strlen($this->lastname) > 0);
  }

  public function ValidEmail()
  {
    return filter_var($this->email, FILTER_VALIDATE_EMAIL);
  }

  public function ValidType()
  {
    return ($this->type == "parent" || $this->type == "teacher");
  }
}

?>