<?php
//////////////////////////////
//    url: /profile POST
// author: John Bergman
//   date: March 23, 2015
//////////////////////////////
require "controllers/authenticate.php";
require "models/profile-model.php";
require "controllers/profile-controller.php";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $model = new ProfileModel();
  $model->type       = $_SESSION["type"];
  $model->firstname  = $_POST["firstname"];
  $model->lastname   = $_POST["lastname"];
  $model->phone      = $_POST["phone"];

  $valid_type        = $model->ValidType();
  $valid_name        = $model->ValidName();
  $valid_school      = $model->ValidSchoolName();

  if($valid_school && $valid_type && $valid_name)
  {
    // Valid input!
    $controller = new ProfileController($model);

    // Update the table
    if($controller->Update())
    {
      echo '<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-success">';
      echo '<strong>Success!</strong> The profile was updated successfully.';
      echo '</div></div></div>';
    }
    else
    {
      echo '<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-danger">';
      echo '<strong>Error!</strong> An error occurred while attempting to update the profile.';
      echo '</div></div></div>';
    }
  }
  else
  {
    echo '<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-danger">';
    echo '<strong>Error!</strong> Your profile could not be updated. <ul>';
    if(!$valid_type)   echo '<li>An invalid account type was specified!</li>';
    if(!$valid_name)   echo '<li>An invalid name was specified! Please enter a name</li>';
    if(!$valid_school) echo '<li>An invalid school name was specified! Please enter a valid school name.</li>';
    echo '</ul></div></div></div>';
  }
}
?>


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <h2><?php if($_SESSION["type"] == "parent") { echo "Parent"; } else { echo "Teacher"; } ?> Account Information</h2>
      <div class="panel-primary">
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-4">
              <ul class="nav nav-pills nav-stacked">
<<<<<<< HEAD
                <li><a href="account-settings">Account Overview</a></li>
                <li class="active"><a href="profile">Account Information</a></li>
                <li><a href="student-management">Student Information</a></li>
                <li><a href="parent-dashboard">Return to My Dashboard</a></li>
=======
                <li><a href="/account-settings/">Overview</a></li>
                <li class="active"><a href="/profile/">Account Information</a></li>
                <li><a href="/student-management/">Student Information</a></li>
                <li><a href="/parent-dashboard/">Return to Parent Dashboard</a></li>
>>>>>>> origin/master
              </ul>
            </div>
            <div class="col-sm-8">
              <form method="post" class="form-horizontal well">
                <fieldset>
                  <legend>Click in a field to edit information and then click Save.</legend>
                  <div class="form-group">
                    <label for="firstName" class="col-lg-4 control-label">First Name</label>
                    <div class="col-lg-8">
                      <input type="text" name="firstname" maxlength="50" class="form-control" id="firstName" placeholder="First Name" value="<?php echo htmlentities($_SESSION['firstname']); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lastName" class="col-lg-4 control-label">Last Name</label>
                    <div class="col-lg-8">
                      <input type="text" name="lastname" maxlength="50" class="form-control" id="lastName" placeholder="Last Name" value="<?php echo htmlentities($_SESSION['lastname']); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-4 control-label">School Name</label>
                    <div class="col-lg-8">
                      <input type="text" name="schoolname" maxlength="50" class="form-control" id="schoolname" placeholder="School Name" value="<?php echo htmlentities($_SESSION['schoolname']); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="phoneNumber" class="col-lg-4 control-label">Phone Number</label>
                    <div class="col-lg-8">
                      <input type="tel" name="phone" class="form-control" id="phoneNumber" value="<?php echo htmlentities($_SESSION['phone']); ?>">
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
        </div>
      </div>
    </div>
  </div>
</div>
<!-- The following fields are Grade Level Taught and Current Classes. I will implement these when the class object has the functionality built in -->
<!--<div class="form-group">
  <label for="grade" class="col-lg-4 control-label">Grade Level Taught</label>
  <div class="col-lg-8">
    <select class="form-control" name="gradetaught" id="gradeLevel">
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
</div> -->
<!-- NOTE: Since the user's account is tied to their email address, they should not be able to change their email through a simple form. We can work this out later
<div class="form-group">
  <label for="inputEmail" class="col-lg-4 control-label">Email</label>
  <div class="col-lg-8">
    <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" value="php email goes here">
  </div>
</div>-->