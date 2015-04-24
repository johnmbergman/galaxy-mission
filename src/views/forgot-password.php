<?php

require "models/forgot-password-model.php";
require "controllers/forgot-password-controller.php";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $model = new ForgotPasswordModel();
  $model->email = $_POST["email"];

  if($model->ValidEmail())
  {
    $controller = new ForgotPasswordController($model);
    if($controller->Authenticate())
    {
      exit;
    }
    else
    {
      echo "Invalid Email";
    }
  }
  else
  {
    echo "You must enter your email address.";
  }
}


?>



<div class="row">
  <div class="col-lg-12">
    <div class="text-center">
      <h1>Forgot your password?</h1>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <form method="post" class="form-horizontal well">
      <fieldset>
        <legend><i class="fa fa-user"></i>Send Email To Reset Password</legend>
        <div class="form-group">
          <label for="input-email" class="col-md-3 control-label">Email</label>
          <div class="col-md-9">
            <input type="email" name="email" class="form-control" id="input-email" placeholder="Email Address">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-9 col-md-offset-3">
            <button type="submit" class="btn btn-primary">Reset Password</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <p>Don't have an account? <a href="/register/">Click here</a> to sign up!</p>
  </div>
</div>

