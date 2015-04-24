<?php

class ChangePasswordModel
{
	public $id;
	public $token;
	public $password;
	public $confirm;

	public function __construct()
	{
		$id = "";
		$token = "";
		$password = "";
		$confirm = "";
	}

	public function ValidPassword()
    {
      return ($this->password == $this->confirm);
    }

	public function ValidPasswordLength()
	{
		return ((strlen($this->password)) >= 6);
	}

	public function ValidTokenLength()
	{
		return((strlen($this->token)) == 30);
	}

	public function ValidUserId()
	{
		return((strlen($this->id)) > 0);
	}
	

}
?>