<?php require "controllers/authenticate.php"; 

/*
	Adam Hill
	Created: 4/15/15
	Student sign-in
*/
require "models/student-login-model.php";
require "controllers/student-login-controller.php";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $model = new StudentLoginModel();
  $model->studentId = $_POST["student_id"];
  $model->pwd_picture = $_POST["password"];

  if($model->ValidStudentId())
  {
    $controller = new StudentLoginController($model);
    if($controller->Authenticate())
    {
      header("Location: /");
      exit;
    }
    else
    {
      echo "Could not be authenticated! Add Message.";
    }
  }
}
?>

<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="text-center">
      <h1>Hello there!</h1>
      <p>Use the form below to log in one of your students.</p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <form method="post" class="form-horizontal well">
      <fieldset>
        <legend><i class="fa fa-user"></i>Student Account Login</legend>
        <div class="form-group">
          <label for="studentSelect" class="col-lg-4 control-label">Select Student</label>
          <div class="col-lg-8">
            <select class="form-control" id="studentSelect">
              <?php

                // Open the connection
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
          <br>
        </div>
        <div class="form-group">
          <label style="text-align:center;font-size:20px" class="col-sm-10 col-md-offset-1 control-label">
            Select the student's passcode icon:
          </label>
          <div class="col-sm-10 col-md-offset-1" >
            <label>
              <input type="radio" name="password" value="0" style="visibility:hidden; position:absolute"/>
              <img  src="../res/alien13.png" style="margin:10px 10px; width:75px; height:75px;" alt="alien icon">
            </label>
            <label>
              <input type="radio" name="password" value="1" style="visibility:hidden; position:absolute" />
              <img src="../res/astronaut6.png" style="margin:10px 10px; width:75px; height:75px;" alt="astronaut icon">
            </label>
            <label>
              <input type="radio" name="password" value="2" style="visibility:hidden; position:absolute"/>
              <img src="../res/comet6.png" style="margin:10px 10px; width:75px; height:75px;" alt="comet icon">
            </label>
            <label>
              <input type="radio" name="password" value="3" style="visibility:hidden; position:absolute"/>
              <img src="../res/galaxy2.png" style="margin:10px 10px; width:75px; height:75px;" alt="galaxy icon">
            </label>
            <label>
              <input type="radio" name="password" value="4" style="visibility:hidden; position:absolute"/>
              <img src="../res/planets1.png" style="margin:10px 10px; width:75px; height:75px;" alt="planets icon">
            </label>
            <label>
              <input type="radio" name="password" value="5" style="visibility:hidden; position:absolute"/>
              <img src="../res/rocket48.png" style="margin:10px 10px; width:75px; height:75px;" alt="rocket icon">
            </label>
            <label>
              <input type="radio" name="password" value="6" style="visibility:hidden; position:absolute"/>
              <img src="../res/spacecraft2.png" style="margin:10px 10px; width:75px; height:75px;" alt="spacecraft icon">
            </label>
            <label>
              <input type="radio" name="password" value="7" style="visibility:hidden; position:absolute"/>
              <img src="../res/spaceship2.png" style="margin:10px 10px; width:75px; height:75px;" alt="spaceship icon">
            </label>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-9 col-md-offset-5">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>