<?php require "controllers/authenticate.php"; ?>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="text-center">
      <h1 class="text-black">Parent Account Information</h1>
      <p class="lead text-black">Click in a field to edit information you would like to change, and then click the Save button.</p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <form method="post" class="form-horizontal well">
      <fieldset>
	<legend>Parent Account Information</legend>
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
	  <label for="inputEmail" class="col-lg-4 control-label">Email</label>
	  <div class="col-lg-8">
	    <input type="email" class="form-control" id="inputEmail" placeholder="Email Address">
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
	  <label for="phoneNumber" class="col-lg-4 control-label">Phone Number</label>
	  <div class="col-lg-8">
	    <input type="tel" class="form-control" id=phoneNumber" placeholder="(___) ___-____">
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