<?php

require "models/login-model.php";
require "controllers/login-controller.php";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $model = new LoginModel();
  $model->email = $_POST["email"];
  $model->password = $_POST["password"];

  if($model->ValidEmail())
  {
    $controller = new LoginController($model);
    if($controller->Authenticate())
    {
      header("Location: /");
      exit;
    }
    else
    {
      ?>
      <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-danger">
              <strong>Oops!</strong> Could not be authenticated or invalid email/password combination.
            </div>
          </div>
        </div>
      <?php
    }
  }

}

?>
<div class="row">
  <div class="col-lg-12">
    <div class="text-center">
      <h1>Welcome back!</h1>
      <p class="lead">Use the form below to sign in to your account.</p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <form method="post" class="form-horizontal well">
      <fieldset>
        <legend><i class="fa fa-user"></i> Sign in</legend>
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
          <div class="col-md-9 col-md-offset-3">
            <button type="submit" class="btn btn-primary">Sign in</button>
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