<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <h2>Student Information</h2>
      <div class="panel-primary">
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-4">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="https://www.galaxymission.com/account-settings">Overview</a></li>
                <li class="divider"></li>
                <li><a href="https://www.galaxymission.com/profile">Account Information</a></li>
                <li class="divider"></li>
                <li><a href="https://www.galaxymission.com/student-management">Student Information</a></li>
                <li class="divider"></li>
                <li><a href="#">Return to Parent Dashboard</a></li>
              </ul>
            </div>
            <div class="col-sm-8">
              <form method="post" class="form-horizontal well">
                <fieldset>
                  <legend>Click in a field to edit information and then click Save.</legend>
                  <div class="form-group">
                    <label for="studentSelect" class="col-lg-4 control-label">Select Student</label>
                    <div class="col-lg-8">
                      <select class="form-control" id="studentSelect">
                        <?php 
                          require(dirname(__FILE__)."/../controllers/data.php");
                          $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
                          $res = $conn->query("SELECT student_id FROM students WHERE parent_id = user_id");
                          while ($conn->fetch_assoc($res)) {
                            $options.= "<option>".$student->first_name . " " . $student->last_name."</option>"; }
                          echo $options; 
                          $conn->close(); ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-10 col-lg-offset-2">
                    <hr>
                    <br />
                  </div>
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
                    <label for="gender" class="col-lg-4 control-label">Gender</label>
                    <div class="col-lg-8">
                      <select class="form-control" id="gender">
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="grade" class="col-lg-4 control-label">Grade Level</label>
                    <div class="col-lg-8">
                      <select class="form-control" id="grade">
                        <option>Kindergarten</option>
                        <option>1st Grade</option>
                        <option>2nd Grade</option>
                        <option>3rd Grade</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="schoolName" class="col-lg-4 control-label">School Name</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control" id="schoolName" placeholder="School Name (optional)">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="teacherName" class="col-lg-4 control-label">Teacher Name</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control" id="teacherName" placeholder="Teacher Name (optional)">
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