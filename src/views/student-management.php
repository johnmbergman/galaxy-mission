<?php

//////////////////////////////
//    url: /student-management POST
// author: Shaun Fyffe with guidance from John Bergman
//   date: March 28, 2015
//////////////////////////////
require "models/student-info-model.php";
require "controllers/student-info-controller.php";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $model = new StudentInfoModel();
  $model->firstname  = $_POST["firstname"];
  $model->lastname   = $_POST["lastname"];
  $model->grade      = $_POST["grade"];

  $valid_name        = $model->ValidName();
  $valid_grade       = $model->ValidGrade();
  $valid_school      = $model->ValidSchoolName();
  $valid_teacher     = $model->ValidTeacherName();

  if($valid_teacher && $valid_school && valid_grade && $valid_name)
  {
    // Valid input!
    $controller = new StudentInfoController($model);

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
    if(!$valid_name)   echo '<li>An invalid name was specified! Please enter a first and last name!</li>';
    if(!$valid_grade)  echo '<li>An invalid grade was selected! Please select a grade</li>';
    if(!$valid_school) echo '<li>An invalid school name was specified! Please enter a valid school name.</li>';
    if(!$valid_teacher) echo '<li>An invalid teacher name was specified! Please enter a valid teacher name.</li>';
    echo '</ul></div></div></div>';
  }
}
?>


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <h2>Student Information</h2>
      <div class="panel-primary">
        <div class="panel-body">
          <div class="row">
            // Sidebar for Account Settings Area
            <div class="col-sm-4">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="https://www.galaxymission.com/account-settings">Overview</a></li>
                <li class="divider"></li>
                <li><a href="https://www.galaxymission.com/profile">Account Information</a></li>
                <li class="divider"></li>
                <li><a href="https://www.galaxymission.com/student-management">Student Information</a></li>
                <li class="divider"></li>
                <li class="disable"><a href="#">Return to Parent Dashboard</a></li>
              </ul>
            </div>
            <div class="col-sm-8">
              // Student Info Form
              <form method="post" class="form-horizontal well">
                <fieldset>
                  <legend>Click in a field to edit information and then click Save.</legend>
                  <div class="form-group">
                    // Parents with multiple students will be able to choose between them to make changes
                    <label for="studentSelect" class="col-lg-4 control-label">Select Student</label>
                    <div class="col-lg-8">
                      <select class="form-control" id="studentSelect">
                        <?php

                          // Open the connection
                          require "controllers/data.php";
                          $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
                          if($conn->connect_error) {
                            trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
                          }

                          // Run the command
                          if($result = $conn->query("SELECT student_id, first_name, last_name FROM students WHERE parent_id = " . $_SESSION["user_id"])) {
                            while ($row = $result->fetch_assoc()) {
                              echo "<option val='" . $row["student_id"] . "'>" . $row["first_name"] . " " . $row["last_name"] . "</option>";
                            }
                          }

                          // Close the connection
                          $conn->close();

                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-10 col-lg-offset-2">
                    <hr>
                    <br />
                  </div>
                  // Update student's first name
                  <div class="form-group">
                    <label for="firstName" class="col-lg-4 control-label">First Name</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control" id="firstName" placeholder="First Name">
                    </div>
                  </div>
                  // Update student's last name
                  <div class="form-group">
                    <label for="lastName" class="col-lg-4 control-label">Last Name</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control" id="lastName" placeholder="Last Name">
                    </div>
                  </div>
                  // Update student's grade level
                  <div class="form-group">
                    <label for="grade" class="col-lg-4 control-label">Grade Level</label>
                    <div class="col-lg-8">
                      <select class="form-control" id="grade" name="grade">
                        <option value = "">Select a grade level</option>
                        <option value = "Kindergarten">Kindergarten</option>
                        <option value = "1st Grade">1st Grade</option>
                      </select>
                    </div>
                  </div>
                  // Update student's school's name
                  <div class="form-group">
                    <label for="schoolName" class="col-lg-4 control-label">School Name</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control" id="schoolName" placeholder="School Name (optional)">
                    </div>
                  </div>
                  // Update student's teacher's name
                  <div class="form-group">
                    <label for="teacherName" class="col-lg-4 control-label">Teacher Name</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control" id="teacherName" placeholder="Teacher Name (optional)">
                    </div>
                  </div>
                  // Update information in database
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