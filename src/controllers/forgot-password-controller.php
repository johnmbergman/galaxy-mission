<?php

class ForgotPasswordController
{
	private $model;

	//constructor
	public function __construct($model)
	{
		$this->model = $model;
	}

	//validate the Email exists	
	public function Authenticate()
	{
		//validation boolean
		$returnflag = false;


	  	// Attempt to connect to the database
      	$conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    	if($conn->connect_error)
    	{
     		trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    	}

    	//Build the sql query
    	$sql = "select parent_id as id, hash, email, 'parent' as type, first_name, last_name, phone, pwd_reset_token from parents where email='" . $this->model->email . "' union select teacher_id as id, hash, email, 'teacher' as type, first_name, last_name, phone, pwd_reset_token from teachers where email='" . $this->model->email . "'";

    	$result = $conn->query($sql);
    	$row = $result->fetch_row();
    	$id = $row[0];

    	if(mysqli_num_rows($result))
    	{
    		$returnflag = true;

   		
  		
    		$token = getRandomString(30);
    	
    		$q = "UPDATE 
    				parents 
    			  SET 
    			  	pwd_reset_token='".$token."',
    			  	pwd_reset_token_expires= DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 2 DAY) 
    			  WHERE 
    			  	email='".$this->model->email."'";
    			  
    		$q2 = "UPDATE 
    			  	teachers 
    			  SET 
    			  	pwd_reset_token='".$token."',
    			  	pwd_reset_token_expires= DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 2 DAY) 
    			  WHERE 
    			  	email='".$this->model->email."'";

    		$conn->query($q);
    		$conn->query($q2);
    		mailResetLink($this->model->email, $token, $id);


    	}
    	else 
    	{
    		$returnflag = false;
    	}

    	
    	//Close the connection and return the result
    	$conn->close();
    	return $returnflag;

	}
}    		

function getRandomString($length)
    	{
    		$validCharacters = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
    		$validCharNum = strlen($validCharacters);
    		$randString = "";

    		for ( $i = 0; $i < $length; $i++ )
    		{
    			$index = mt_rand(0, $validCharNum - 1);
    			$randString .= $validCharacters[$index];
    		}
    		return $randString;
    	}//end getRandomString function


function mailResetLink($to, $token, $id)
    	{
    		$subject = "Forgot Password on GalaxyMission.com";
    		$uri = 'http://'.$_SERVER['HTTP_HOST'];
    		$message = '
    		<html>
    		<head>
    		<title>Forgot Password For GalaxyMission.com</title>
    		</head>
    		<body>
    		<p>"We received a request to change your password for you GalaxyMission.com account.  If you requested this change of password please click the link and proceed.  If you did not request this change of pasword then please disregard this email."</p>
    		<p>Click the link to reset you password <a href="'.$uri.'/change-password/'.$token.'/'.$id.'">Reset Password</a></p>
    		</body>
    		</html>';
    		$headers = "MIME-Version: 1.0" . "\r\n";
    		$headers .= "Content-type: text/html;charset=iso-8859-1" . "\r\n";
    		$headers .= "From: GalaxyMission.com<noreply@galaxymission.com>" . "\r\n";
    	   		

    		if(mail($to,$subject,$message,$headers, '-fnoreplya@galaxymission.com'))
    		{
    			echo "The reset password link has been sent to your email id <b>".$to."</b>";
    		}
    		else
    		{
    			echo "Email didn't send.";
    		}
    	}
?>