<?php

class ProfileModel
{
  public $firstname;
  public $lastname;
  public $phone;
  public $type;
  public $schoolname;

  public function __construct()
  {
    $firstname = "";
    $lastname = "";
    $phone = "";
    $type = "";
    $schoolname = "";
  }

  public function ValidName()
  {
    return (strlen($this->firstname) > 0 && strlen($this->lastname) > 0);
  }

  public function ValidType()
  {
    return ($this->type == "parent" || $this->type == "teacher");
  }

  public function ValidSchoolName()
  {
    return strlen($this->schoolname) <= 50;
  }

  public function ValidPhone()
  {
    return true;
  }
}

?>