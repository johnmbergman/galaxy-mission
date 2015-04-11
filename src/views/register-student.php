<?php
/*
  Adam Hill
  Updated: March 28, 2015
  Register-student view where a parent can create a student account for their child
*/

require "models/student-creation-model.php";
require "controllers/student-creation-controller.php";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  
  $model = new StudentCreationModel();
  $model->firstname  = $_POST["firstname"];
  $model->lastname   = $_POST["lastname"];
  $model->gradelevel = $_POST["gradelevel"];
  $model->parent_id  = $_SESSION["user_id"];
  $model->password   = (isset($_POST["password"]) ? $_POST["password"] : -1);
 
  $valid_firstname        = $model->ValidFirstName();
  $valid_lastname         = $model->ValidLastName();
  $valid_password		  = $model->ValidPassword();
  if($valid_firstname && $valid_lastname && $valid_password)
  {
    $controller = new StudentCreationController($model);
    if($controller->NameAvailable($model->firstname, $model->lastname, $model->parent_id))
    {
      // The name is available
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
      // The name is unavailable
      echo '<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-danger">';
      echo '<strong>Error!</strong> The account could not be created because a student account with this name is already registered to this parent.';
      echo '</div></div></div>';
    }
  }
  else
  {
	// output message detailing invalid inputs
    echo '<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-danger">';
    echo '<strong>Error!</strong> The account could not be created. <ul>';
    if(!$valid_firstname)  echo '<li>Please enter a valid first name.</li>';
    if(!$valid_lastname)   echo '<li>Please enter a valid last name.</li>';
    if(!$valid_password)   echo '<li>Please select a passcode icon.</li>';
    echo '</ul></div></div></div>';
  }
}

?>


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
        <br>
      <div class="row">
        <div class="form-group">
          <label for="input-gradelevel" class="col-md-4 text-right control-label">Grade Level</label>
          <div class="col-md-4">
            <select name="gradelevel" class="form-control" id="input-gradelevel">
				<option value="0">Kindergarten</option>
				<option value="1">1st Grade</option>
				<option value="2">2nd Grade</option>
				<option value="3">3rd Grade</option>
			</select>
          </div>
        </div>
      </div>  
        <div class="form-group">
          <label style="text-align:center;font-size:20px" class="col-sm-10 col-md-offset-1 control-label">
          Please select a passcode icon for the student</label>
          <div class="col-xs-10 col-md-offset-1" >
          <label>
          <input type="radio" name="password" value="0" style="visibility:hidden; position:absolute"/>
  			<img  src="../res/alien13.png" style="margin:10px 10px; width:75px; height:75px;" alt="alien icon">
  		  </label>
  		  <label>
          <input type="radio" name="password" value="1" style="visibility:hidden; position:absolute" />
  			<img src="../res/astronaut6.png" style="margin:10px 10px; width:75px; height:75px;" alt="astronaut icon">
  		  </label>
  		  <label>
          <input type="radio" name="password" value="2" style="visibility:hidden; position:absolute"/>
  			<img src="../res/comet6.png" style="margin:10px 10px; width:75px; height:75px;" alt="comet icon">
  		  </label>
  		  <label>
          <input type="radio" name="password" value="3" style="visibility:hidden; position:absolute"/>
  			<img src="../res/galaxy2.png" style="margin:10px 10px; width:75px; height:75px;" alt="galaxy icon">
  		  </label>
  		  <label>
          <input type="radio" name="password" value="4" style="visibility:hidden; position:absolute"/>
  			<img src="../res/planets1.png" style="margin:10px 10px; width:75px; height:75px;" alt="planets icon">
  		  </label>
  		  <label>
          <input type="radio" name="password" value="5" style="visibility:hidden; position:absolute"/>
  			<img src="../res/rocket48.png" style="margin:10px 10px; width:75px; height:75px;" alt="rocket icon">
  		  </label>
  		  <label>
          <input type="radio" name="password" value="6" style="visibility:hidden; position:absolute"/>
  			<img src="../res/spacecraft2.png" style="margin:10px 10px; width:75px; height:75px;" alt="spacecraft icon">
  		  </label>
  		  <label>
          <input type="radio" name="password" value="7" style="visibility:hidden; position:absolute"/>
  			<img src="../res/spaceship2.png" style="margin:10px 10px; width:75px; height:75px;" alt="spaceship icon">
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
