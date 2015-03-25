<?php

require "models/registration-model.php";
require "controllers/registration-controller.php";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  echo '<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-danger">Not implemented!</div></div></div>';
  
  /*$model = new RegistrationModel();
  $model->email = $_POST["email"];
  $model->password = $_POST["password"];
  $model->repeatpass = $_POST["confirm"];

  $valid_email = $model->ValidEmail();
  $valid_pass = $model->ValidPassword();
  $valid_length = $model->ValidPasswordLength();

  if($valid_email && $valid_pass && $valid_length)
  {
    $controller = new RegistrationController($model);
    if($controller->EmailAvailable($model->email))
    {
      // The email is available
      if($controller->Register())
      {
        header("Location: /register-success/");
        exit;
      }
      else
      {
        // The account failed to save to the database
        echo '<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-danger">';
        echo '<strong>Error!</strong> An error occurred on the server while trying to create the account. We will try to get this sorted as soon as possible';
        echo '</div></div></div>';
      }
    }
    else
    {
      // The email is unavailable
      echo '<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-danger">';
      echo '<strong>Error!</strong> The account could not be created because an account is already registered to this email address.';
      echo '</div></div></div>';
    }
  }
  else
  {
    echo '<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-danger">';
    echo '<strong>Error!</strong> The account could not be created. <ul>';
    if(!$valid_email)  echo '<li>An invalid email address was specified.</li>';
    if(!$valid_pass)   echo '<li>The passwords do not match.</li>';
    if(!$valid_length) echo '<li>The password must be at least 6 characters long.</li>';
    echo '</ul></div></div></div>';
  }*/
}

?>

<head>
<style>

img{
	width:75px;
	height:75px;
	margin: 10px 10px;
}
label > input{ /* HIDE RADIO */
  visibility: hidden; /* Makes input not-clickable */
  position: absolute; /* Remove input from document flow */
}
label > input + img{ /* IMAGE STYLES */
  cursor:pointer;
  border:2px solid transparent;
}
label > input:checked + img{ /* (RADIO CHECKED) IMAGE STYLES */
  border:2px solid #008080;
}
</style>
</head>


<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="text-center">
      <h1>Hello there!</h1>
      <p>Fill out the form below to register a student for an account.</p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <form method="post" class="form-horizontal well">
      <fieldset>
        <legend style="text-align:center"><i class="fa fa-user"></i> Register Student Account</legend>
        <div class="form-group">
          <label for="input-firstname" class="col-md-3 control-label">Name</label>
          <div class="col-md-3">
            <input type="text" name="firstname" class="form-control" id="input-firstname" placeholder="First Name">
          </div>
          <div class="col-md-4">
            <input type="text" name="lastname" class="form-control" id="input-lastname" placeholder="Last Name">
          </div>
        </div>
        <div class="form-group">
          <label for="input-dateofbirth" class="col-md-3 control-label">Date of Birth</label>
          <div class="col-md-3">
            <input type="date" name="dateofbirth" class="form-control" id="input-dateofbirth" placeholder="mm/dd/yyyy" maxlength="10">  
        </div>
        <div class="form-group">
          <label for="input-gradelevel" class="col-md-2 control-lable">Grade Level</label>
          <div class="col-md-1">
            <select name="gradelevels">
				<option value="k">Kindergarten</option>
				<option value="1">1st Grade</option>
				<option value="2">2nd Grade</option>
				<option value="3">3rd Grade</option>
			</select>
          </div>
        </div>  
        <div class="form-group">
          <label style="text-align:center;font-size:20px" for="input-pass" class="col-sm-10 col-md-offset-1 control-label">
          Please select a passcode icon for the student</label>
          <div class="col-xs-9 col-md-offset-2" >
          <label>
          <input type="radio" name="alien icon" value="small" />
  			<img src="../res/alien13.png" alt="alien icon">
  		  </label>
  		  <label>
          <input type="radio" name="alien icon" value="small" />
  			<img src="../res/astronaut6.png" alt="astronaut icon">
  		  </label>
  		  <label>
          <input type="radio" name="alien icon" value="small" />
  			<img src="../res/comet6.png" alt="comet icon">
  		  </label>
  		  <label>
          <input type="radio" name="alien icon" value="small" />
  			<img src="../res/galaxy2.png" alt="galaxy icon">
  		  </label>
  		  <label>
          <input type="radio" name="alien icon" value="small" />
  			<img src="../res/planets1.png" alt="planets icon">
  		  </label><label>
          <input type="radio" name="alien icon" value="small" />
  			<img src="../res/rocket48.png" alt="rocket icon">
  		  </label><label>
          <input type="radio" name="alien icon" value="small" />
  			<img src="../res/spacecraft2.png" alt="spacecraft icon">
  		  </label><label>
          <input type="radio" name="alien icon" value="small" />
  			<img src="../res/spaceship2.png" alt="spaceship icon">
  		  </label>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-9 col-md-offset-2">
            <p>By clicking <strong>Register</strong>, I agree with the <a href="/tos/">Terms of Service</a> of the application.</p>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-9 col-md-offset-5">
            <button type="submit" class="btn btn-primary">Register</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <p>Already have an account? <a href="/login/">Click here</a> to sign in.</p>
  </div>
</div>
<div class="modal fade" id="model-student" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Student account instructions</h4>
      </div>
      <div class="modal-body">
        <p>To create a student account, please <a href="/login/">log in</a> to a parent or teacher account and choose <strong>Add Student</strong> from the management menu.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
