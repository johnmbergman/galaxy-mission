<?php

class ChangePasswordController
{
	private $model;

	//constuctor
	public function __construct($model)
	{
		$this->model = $model;
	}
	
	public function Authenticate()
	{
		$conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
		if($conn->connect_error)
		{
			trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
		}

		$returnflag = false;
		
		$sql = "UPDATE 
					parents 
				SET 
					hash='".password_hash($this->model->password, PASSWORD_DEFAULT)."',
					pwd_reset_token='',
					last_pwd_reset=now()
				WHERE 
					parent_id='".$this->model->id."' 
				AND 
					pwd_reset_token='".$this->model->token."'
				AND 
					pwd_reset_token_expires > CURRENT_TIMESTAMP";
				
		$sql2 = "UPDATE 
					teachers 
				SET 
					hash='".password_hash($this->model->password, PASSWORD_DEFAULT)."',
					pwd_reset_token='',
					last_pwd_reset=now()
				WHERE 
					parent_id='".$this->model->id."' 
				AND 
					pwd_reset_token='".$this->model->token."'
				AND 
					pwd_reset_token_expires > CURRENT_TIMESTAMP";

		

		if(($conn->query($sql) == TRUE) || ($conn->querry($sql2) == TRUE))
		{
			$returnflag = true;
		}
		else
		{
			$returnflag = false;
		}	
		$conn->close();
		return $returnflag;
	}
}

?>