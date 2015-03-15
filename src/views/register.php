<?php

require "models/registration-model.php";
require "controllers/registration-controller.php";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $model = new RegistrationModel();
  $model->email      = $_POST["email"];
  $model->password   = $_POST["password"];
  $model->repeatpass = $_POST["confirm"];
  $model->type       = strtolower($_POST["type"]);

  $valid_email       = $model->ValidEmail();
  $valid_pass        = $model->ValidPassword();
  $valid_length      = $model->ValidPasswordLength();
  $valid_type        = $model->ValidType();

  if($valid_email && $valid_pass && $valid_length && $valid_type)
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
        ?>

        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-danger">
              <strong>Error!</strong> An error occurred on the server while trying to create the account. We will try to get this sorted as soon as possible
            </div>
          </div>
        </div>

        <?php
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
    if(!$valid_type)   echo '<li>An invalid account type was specified!</li>';
    echo '</ul></div></div></div>';
  }
}

?>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="text-center">
      <h1>Hello there!</h1>
      <p class="lead">Fill out the form below to register for an account.</p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <form method="post" class="form-horizontal well">
      <fieldset>
        <legend><i class="fa fa-user"></i> Register New Account</legend>
        <div class="form-group">
          <label for="input-type" class="col-md-3 control-label">I am a...</label>
          <div class="col-md-9">
            <select name="type" class="form-control" id="input-type">
              <option val="parent">Parent</option>
              <option val="teacher">Teacher</option>
            </select>
            <span class="help-block"><a href="#" data-toggle="modal" data-target="#model-student">Click here</a> for information on creating a student account.</span>
          </div>
        </div>
        <div class="form-group">
          <label for="input-firstname" class="col-md-3 control-label">Name</label>
          <div class="col-md-4">
            <input type="text" name="firstname" class="form-control" id="input-firstname" placeholder="First Name">
          </div>
          <div class="col-md-5">
            <input type="text" name="lastname" class="form-control" id="input-lastname" placeholder="Last Name">
          </div>
        </div>
        <div class="form-group">
          <label for="input-email" class="col-md-3 control-label">Email</label>
          <div class="col-md-9">
            <input type="email" name="email" class="form-control" id="input-email" placeholder="Email Address">
          </div>
        </div>
        <div class="form-group">
          <label for="input-pass" class="col-md-3 control-label">Password</label>
          <div class="col-md-9">
            <input type="password" name="password" class="form-control" id="input-pass" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <label for="input-confirm" class="col-md-3 control-label">Confirm</label>
          <div class="col-md-9">
            <input type="password" name="confirm" class="form-control" id="input-confirm" placeholder="Confirm Password">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-9 col-md-offset-3">
            <p>By clicking <strong>Register</strong>, I agree with the <a href="/tos/">Terms of Service</a> of the application.</p>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-9 col-md-offset-3">
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