<?php require "controllers/authenticate.php"; ?>
<?php

  // Open the connection
  $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error) {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }


  if($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new DashboardDataModel();
  
    $controller = new DashboardController($model);
    $kinderProgress = $controller->getKinderPercentComplete();
    $firstProgress = $controller->getFirstPercentComplete();
    $secondProgress = $controller->getSecondPercentComplete();
    $thirdProgress = $controller->getThirdPercentComplete();
    $starsEarned = $controller->getStarsEarned();
    $student_first_name = "";
    $start_date = "";
  }

?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <h2>My Dashboard <small>Sample</small></h2>
      <div class="panel-primary">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3">
              <?php include "dashboard-menu.php"; ?>
            </div>
            <div class="col-md-9">

              <!-- Student tab list -->
              <ul class="nav nav-tabs">
                <?php
                  // Run the command
                  $drewfirst = false;
                  if($result = $conn->query("SELECT student_id, first_name, last_name, grade_level, date_created FROM students WHERE parent_id = " . $_SESSION["user_id"])) {

                    while ($row = $result->fetch_assoc()) {
                      
                      echo "<li " . ($drewfirst ? "" : "class='active'") . "><a href='#" . $row["student_id"] . "' data-toggle='tab'>" . $row["first_name"] . "'s Progress</a></li>";
                      $drewfirst = true;
                    }
                  }

                ?>
                <li><a href="/register-student/"><i class="fa fa-plus-square"></i> Add a Child</a></li>
              </ul>

              <div class="tab-content">

                <!-- Tab content for each student here -->
                <?php

                  // Run the command
                  if($result = $conn->query("SELECT student_id, first_name, last_name, grade_level, date_created FROM students WHERE parent_id = " . $_SESSION["user_id"])) {
                    while ($row = $result->fetch_assoc()) {

                      // Render data for each student
                      $student_first_name = $row["first_name"];
                      $start_date = $row["date_created"];
                      $model = new DashboardDataModel();
                 ?>
                      <div class="tab-panel fade" id="#<?php echo $row["student_id"]; ?>">
                        <div class="well">
                        </div>
                      </div>
                      <?php
                    }
                  }

                ?>
                <div class="tab-pane fade active in" id="student1">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-sm-8">
                          <h5 class="dash-header">Grade Level Progress</h5>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="progress-label">Kindergarten:</p>
                            </div>
                            <div class="col-sm-9">
                              <div class="progress" style="width: 75%">
                                <div id = "kinderPreProg" class="progress-bar progress-bar-info" style="0%"></div>
                                <div id = "kinderProg" class="progress-bar" style="width: <?php echo $kinderProgress ?>%"></div>
                                <div id = "kinderNotComplete" class="progress-bar progress-bar-danger" style="width: <?php echo (100 - $kinderProgress); ?>%"></div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="progress-label">1st Grade:</p>
                            </div>
                            <div class="col-sm-9">
                              <div class="progress" style="width: 75%">
                                <div id = "firstPreProg"  class="progress-bar progress-bar-info" style="width: 0%"></div>
                                <div id = "firstProg"  class="progress-bar" style="width: <?php echo $firstProgress ?>%"></div>
                                <div id = "firstNotComplete"  class="progress-bar progress-bar-danger" style="width: <?php echo (100 - $firstProgress); ?>%"></div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="progress-label">2nd Grade:</p>
                            </div>
                            <div class="col-sm-9">
                              <div class="progress" style="width: 75%">
                                <div class="progress-bar progress-bar-info" style="width: 0%"></div>
                                <div class="progress-bar" style="width: <?php echo $secondProgress ?>%"></div>
                                <div class="progress-bar progress-bar-danger" style="width: <?php echo (100 - $secondProgress); ?>%"></div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="progress-label">3rd Grade:</p>
                            </div>
                            <div class="col-sm-9">
                              <div class="progress" style="width: 75%">
                                <div class="progress-bar progress-bar-info" style="width: 0%"></div>
                                <div class="progress-bar" style="width: <?php echo $thirdProgress ?>%"></div>
                                <div class="progress-bar progress-bar-danger" style="width: <?php echo (100 - $thirdProgress); ?>%"></div>
                              </div>
                            </div>
                          </div>
                          <h5 class="dash-header">Progress Key</h5>
                          <span class="label label-info">Completed During Pretest</span>
                          <span class="label label-primary">Completed Curriculum</span>
                          <span class="label label-danger">Pending Completion</span>
                        </div>
                        <div class="col-sm-4">
                          <h5 class="dash-header">Progress Summary</h5>
                          <p><small>Number of Missions Completed: 0</small></p>
                          <p><small>Number of Stars Earned: <?php echo $starsEarned; ?></small></p>
                          <p><small><?php echo $student_first_name; ?> began the intergalactic journey on <?php echo $start_date; ?></small></p>
                        </div>
                      </div>
                      <hr/>
                      <div class="row">
                        <div class="col-sm-4">
                          <h6 class="dash-col-header">What is <?php echo $student_first_name; ?> currently learning?</h6>
                          <p><small><?php echo $student_first_name; ?> is working on this set of missions:</small></p>
                          <p></p>
                        </div>
                        <div class="col-sm-4">
                          <h6 class="dash-col-header">What has <?php echo $student_first_name; ?> recently learned?</h6>
                          <p><small><?php echo $student_first_name; ?> recently completed this set of missions:</small></p>
                          <p><?php

                             // Group and display the available missions.
                             $lastgrade = -1;
                             $result = $conn->query("SELECT question_type_id,grade_level,name,description FROM question_type WHERE enabled=1 and grade_level<=" . $_SESSION["current_student_grade"] . " order by grade_level");
                             while ($row = $result->fetch_assoc()) {
                               if($row["grade_level"] != $lastgrade) {
                                 $lastgrade = $row["grade_level"];
                               } 
                             } ?>
                             <p><small><?php echo $row["name"]; ?></small></p>
                           </p>
                        </div>
                        <div class="col-sm-4">
                          <h6 class="dash-col-header">What will <?php echo $student_first_name; ?> learn next?</h6>
                          <p><small><?php echo $student_first_name; ?> will soon start working on this set of missions:</small></p>
                          <p></p>
                          <?php $conn->close(); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>