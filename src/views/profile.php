<?php

require "models/profile-model.php";
require "controllers/profile-controller.php";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $model = new ProfileModel();
  $model->email      = $_POST["email"];
  $model->type       = $_SESSION["type"];
  $model->firstname  = $_POST["firstname"];
  $model->lastname   = $_POST["lastname"];
  $model->phone      = $_POST["phone"];

  $valid_email       = $model->ValidEmail();
  $valid_type        = $model->ValidType();
  $valid_name        = $model->ValidName();

  if($valid_email && $valid_type && $valid_name)
  {
    // Valid input!
    $controller = new RegistrationController($model);
    if($controller->EmailAvailable($model->email))
    {
      // TODO: Write success functionality here
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
    if(!$valid_type)   echo '<li>An invalid account type was specified!</li>';
    if(!$valid_name)   echo '<li>An invalid name was specified! Please enter a name</li>';
    echo '</ul></div></div></div>';
  }
}
?>


<!-- PARENT -->
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="text-center">
      <h1 class="text-black">Profile</h1>
      <p class="lead text-black">Click in a field to edit information you would like to change, and then click the Save button.</p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <form method="post" class="form-horizontal well">
      <fieldset>
        <legend>Profile</legend>
        <div class="form-group">
          <label for="firstName" class="col-lg-4 control-label">First Name</label>
          <div class="col-lg-8">
            <input type="text" name="firstname" class="form-control" id="firstName" placeholder="First Name" value="<?php echo htmlentities($_SESSION['firstname']) ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="lastName" class="col-lg-4 control-label">Last Name</label>
          <div class="col-lg-8">
            <input type="text" name="lastname" class="form-control" id="lastName" placeholder="Last Name" value="<?php echo htmlentities($_SESSION['lastname']) ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail" class="col-lg-4 control-label">Email</label>
          <div class="col-lg-8">
            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email Address" value="<?php echo htmlentities($_SESSION['email']) ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="phoneNumber" class="col-lg-4 control-label">Phone Number</label>
          <div class="col-lg-8">
            <input type="tel" name="phone" class="form-control" id="phoneNumber" placeholder="(___) ___-____">
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-8 col-lg-offset-4">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>

<!-- TEACHER -->
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="text-center">
      <h1 class="text-black">Teacher Account Information</h1>
      <p class="lead text-black">Click in a field to edit information you would like to change, and then click the Save button.</p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <form method="post" class="form-horizontal well">
      <fieldset>
        <legend>Teacher Account Information</legend>
        <div class="form-group">
          <label for="firstName" class="col-lg-4 control-label">First Name</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="firstName" placeholder="First Name">
          </div>
        </div>
        <div class="form-group">
          <label for="lastName" class="col-lg-4 control-label">Last Name</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="lastName" placeholder="Last Name">
          </div>
        </div>
        <div class="form-group">
          <label for="schoolName" class="col-lg-4 control-label">School Name</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="lastName" placeholder="School Name">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail" class="col-lg-4 control-label">School Email</label>
          <div class="col-lg-8">
            <input type="email" class="form-control" id="inputEmail" placeholder="School Email Address">
          </div>
        </div>
        <div class="form-group">
          <label for="currentPassword" class="col-lg-4 control-label">Current Password</label>
          <div class="col-lg-8">
            <input type="password" class="form-control" id="currentPassword" placeholder="Current Password">
          </div>
        </div>
        <div class="form-group">
          <label for="newPassword" class="col-lg-4 control-label">New Password</label>
          <div class="col-lg-8">
            <input type="password" class="form-control" id="newPassword" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="confirmNewPassword" class="col-lg-4 control-label">Confirm New Password</label>
          <div class="col-lg-8">
            <input type="password" class="form-control" id="confirmNewPassword" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="grade" class="col-lg-4 control-label">Grade Level Taught</label>
          <div class="col-lg-8">
            <select class="form-control" id="gradeLevel">
              <option>Kindergarten</option>
              <option>1st Grade</option>
              <option>2nd Grade</option>
              <option>3rd Grade</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="grade" class="col-lg-4 control-label">Current Classes</label>
          <div class="col-lg-8">
            <select class="form-control" id="classes">
              <option>First Class Name Here</option>
              <option>Second Class Name Here</option>
              <option>Third Class Name Here</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-8 col-lg-offset-4">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>