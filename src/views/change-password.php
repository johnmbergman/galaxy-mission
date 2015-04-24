<?php

  require "models/change-password-model.php";
  require "controllers/change-password-controller.php";


  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $model = new ChangePasswordModel();
    
    //checks for set on token and userid
    if ((isset($_GET['token'])) && (isset($_GET['userid'])))
    {
      $model->token = $_GET['token'];
      $model->id = $_GET['userid'];
      $validToken = $model->ValidTokenLength();
      $validId = $model->ValidUserId();

      if($validToken && $validId)
      {
          //recieved a valid token and a valid userid
      }
      //Token or id not valid
      else
      {
        echo "ERROR WITH EMAIL CODE PLEASE RETRY";
        exit;
      }

    }
    //token or userid not set
    else
    {
      echo "ERROR WITH EMAIL FOR RESET PLEASE RETRY";
      exit;
    }



    //checks for set of password and confirm
    if(isset($_POST['password']) && isset($_POST['confirm']))
    {
      $model->password = $_POST["password"];
      $model->confirm = $_POST["confirm"];
      $validPass = $model->ValidPassword();
      $validPassLen = $model->ValidPasswordLength();
      //checks valid password length
      if ($validPassLen)
      {
        //checks that the password and confirm password match
        if($validPass)
        {
          $controller = new ChangePasswordController($model);
          if($controller->Authenticate())
          {
            echo "Password Changed";
            exit;
          }
          else
          {
            echo "Invalid Reset Email Please Try Again";
            exit;
          }
        }
        else
        {
          echo "Passwords do not match. Please try again.";
          exit;
        } 
      }
      else
      {
        echo "Invalid Password. Your password must contain at least 6 characters.";
        exit;
      }
    }
    else
    {
      echo "ERROR RECEIVING PASSWORD";
    }

  }
  ?>


<div class="row">
  <div class="col-lg-12">
    <div class="text-center">
      <h1>Reset Password</h1>
      <p class="lead">Enter your new password below.</p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <form method="post" class="form-horizontal well">
      <fieldset>
        <legend><i class="fa fa-user"></i>Reset Password</legend>
        <div class="form-group">
          <label for="input-pass" class="col-md-3 control-label">Password</label>
          <div class="col-md-9">
            <input type="password" name="password" class="form-control" id="input-pass" placeholder="Password">
          </div>
        </div>
         <div class="form-group">
          <label for="input-confirm" class="col-md-3 control-label">Confirm Password</label>
          <div class="col-md-9">
            <input type="password" name="confirm" class="form-control" id="input-con-pass" placeholder="Confirm Password">
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
