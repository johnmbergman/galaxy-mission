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