<?php require "controllers/authenticate.php"; ?>
<?php

//////////////////////////////
//    url: /student-management POST
// author: Shaun Fyffe with PHP guidance from John Bergman
//   date: March 28, 2015
//////////////////////////////
require "models/student-info-model.php";
require "controllers/student-info-controller.php";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $model = new StudentInfoModel();
  $model->firstname  = $_POST["firstname"];
  $model->lastname   = $_POST["lastname"];
  $model->parentid   = $_SESSION["user_id"];
  $model->grade      = $_POST["grade"];
  if(isset($_GET["studentid"])) $model->studentid  = $_GET["studentid"];

  $valid_name        = $model->ValidName();
  $valid_grade       = $model->ValidGrade();

  if($valid_grade && $valid_name)
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
    if(!$valid_grade)  echo '<li>An invalid grade was selected! Please select a grade from the drop down.</li>';
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
            <div class="col-sm-3">
              <?php include "dashboard-menu.php"; ?>
            </div>
            <div class="col-sm-9">
              <!--Student Info Form-->
              <form method="post" class="form-horizontal well">
                <fieldset>
                  <legend>Edit student information and click save.</legend>
                  <div class="form-group">
                    <!--Parents with multiple students will be able to choose between them to make changes-->
                    <label for="studentSelect" class="col-lg-4 control-label">Select Student</label>
                    <div class="col-lg-8">
                      <select class="form-control" id="studentSelect" onchange="location=this.options[this.selectedIndex].value;">
                        <?php if(!isset($_GET["studentid"])) echo "<option value='#'>Select a student...</option>"; ?>
                        <?php

                          // Open the connection
                          $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
                          if($conn->connect_error) {
                            trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
                          }

                          // Run the command
                          if($result = $conn->query("SELECT student_id, first_name, last_name, grade_level FROM students WHERE parent_id = " . $_SESSION["user_id"])) {
                            while ($row = $result->fetch_assoc()) {
                              if(isset($_GET["studentid"]))
                              {
                                if($_GET["studentid"] == $row["student_id"])
                                {
                                  $student_first_name = $row["first_name"];
                                  $student_last_name = $row["last_name"];
                                  $student_grade = $row["grade_level"];
                                }
                                echo "<option value='/student-management/" . $row["student_id"] . "' " . ($_GET["studentid"]==$row["student_id"] ? "selected" : "") . ">" . $row["first_name"] . " " . $row["last_name"] . "</option>";
                              }
                              else
                              {
                                echo "<option value='/student-management/" . $row["student_id"] . "'>" . $row["first_name"] . " " . $row["last_name"] . "</option>";
                              }
                            }
                          }

                          // Close the connection
                          $conn->close();

                        ?>
                      </select>
                    </div>
                  </div>
                  <hr>

                  <!-- Update student's name and grade level -->
                  <?php if(isset($_GET["studentid"])) { ?>
                  <div class="form-group">
                    <label for="firstName" class="col-lg-4 control-label">First Name</label>
                    <div class="col-lg-8">
                      <input name="firstname" type="text" class="form-control" id="firstName" placeholder="First Name" value="<?php echo $student_first_name; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lastName" class="col-lg-4 control-label">Last Name</label>
                    <div class="col-lg-8">
                      <input name="lastname" type="text" class="form-control" id="lastName" placeholder="Last Name" value="<?php echo $student_last_name; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="grade" class="col-lg-4 control-label">Grade Level</label>
                    <div class="col-lg-8">
                      <select class="form-control" id="grade" name="grade">
                        <option value="0" <?php if($student_grade == 0) echo "selected='selected'" ?>>Kindergarten</option>
                        <option value="1" <?php if($student_grade == 1) echo "selected='selected'" ?>>1st Grade</option>
                        <option value="2" <?php if($student_grade == 2) echo "selected='selected'" ?>>2nd Grade</option>
                        <option value="3" <?php if($student_grade == 3) echo "selected='selected'" ?>>3rd Grade</option>
                      </select>
                    </div>
                  </div>
                  <?php } ?>

                  <!--Update information in database-->
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