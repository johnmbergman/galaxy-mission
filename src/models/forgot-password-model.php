<?php

class ForgotPasswordModel
{
	public $email;

	public function __construct()
	{
		$email = "";
	}

	public function ValidEmail()
	{
		return filter_var($this->email, FILTER_VALIDATE_EMAIL);
	}
}
?>