<?php require "controllers/authenticate.php"; ?>
<?php

  if($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new DashboardDataModel();
    if(isset($_GET["studentid"]))$model->studentid = $_GET["studentid"];
  
    $controller = new DashboardController($model);
    $kinderProgress = $controller->getKinderPercentComplete();
    $firstProgress = $controller->getFirstPercentComplete();
    $secondProgress = $controller->getSecondPercentComplete();
    $thirdProgress = $controller->getThirdPercentComplete();
    $starsEarned = $controller->getStarsEarned();
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
                  // Open the connection
                  $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
                  if($conn->connect_error) {
                    trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
                  }

                  // Run the command
                  $drewfirst = false;
                  if($result = $conn->query("SELECT student_id, first_name, last_name, grade_level FROM students WHERE parent_id = " . $_SESSION["user_id"])) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<li " . ($drewfirst ? "" : "class='active'") . "><a href='#" . $row["student_id"] . "' data-toggle='tab'>" . $row["first_name"] . "'s Progress</a></li>";
                      $drewfirst = true;
                    }
                  }

                  // Close the connection
                  $conn->close();
                ?>
                <li><a href="/register-student/"><i class="fa fa-plus-square"></i> Add a Child</a></li>
              </ul>

              <div class="tab-content">

                <!-- Tab content for each student here -->
                <?php
                  // Open the connection
                  $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
                  if($conn->connect_error) {
                    trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
                  }

                  // Run the command
                  if($result = $conn->query("SELECT student_id, first_name, last_name, grade_level FROM students WHERE parent_id = " . $_SESSION["user_id"])) {
                    while ($row = $result->fetch_assoc()) {

                      // Render data for each student
                      $model = new DashboardDataModel();
                      ?>
                      <div class="tab-panel fade" id="#<?php echo $row["student_id"]; ?>">
                        <div class="well">
                        </div>
                      </div>
                      <?php
                    }
                  }

                  // Close the connection
                  $conn->close();
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
                                <div class="progress-bar progress-bar-info" style="width: 0%"></div>
                                <div class="progress-bar" style="width: <?php echo $kinderProgress; ?>%"></div>
                                <div class="progress-bar progress-bar-danger" style="width: 25%"></div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="progress-label">1st Grade:</p>
                            </div>
                            <div class="col-sm-9">
                              <div class="progress" style="width: 75%">
                                <div class="progress-bar progress-bar-info" style="width: 0%"></div>
                                <div class="progress-bar" style="width: <?php echo $firstProgress; ?>%"></div>
                                <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="progress-label">2nd Grade:</p>
                            </div>
                            <div class="col-sm-9">
                              <div class="progress" style="width: 75%">
                                <div class="progress-bar progress-bar-info" style="<?php echo $secondProgress; ?>%"></div>
                                <div class="progress-bar" style="width: 0%"></div>
                                <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="progress-label">3rd Grade:</p>
                            </div>
                            <div class="col-sm-9">
                              <div class="progress" style="width: 75%">
                                <div class="progress-bar progress-bar-info" style="<?php echo $thirdProgress; ?>%"></div>
                                <div class="progress-bar" style="width: 0%"></div>
                                <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
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
                          <p><small><?php echo htmlentities($_SESSION['firstname']); ?> began his/her intergalactic journey on DATE</small></p>
                          <p><small><?php echo htmlentities($_SESSION['firstname']); ?> has played Galaxy Mission for xx hours and xx minutes</small></p>
                        </div>
                      </div>
                      <hr/>
                      <div class="row">
                        <div class="col-sm-4">
                          <h6 class="dash-col-header">What is <?php echo htmlentities($_SESSION['firstname']); ?> currently learning?</h6>
                          <p><small><?php echo htmlentities($_SESSION['firstname']); ?> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus.</p>
                          <p><a href="#">Learn More</a></small></p>
                        </div>
                        <div class="col-sm-4">
                          <h6 class="dash-col-header">What has <?php echo htmlentities($_SESSION['firstname']); ?> recently learned?</h6>
                          <p><small><?php echo htmlentities($_SESSION['firstname']); ?> has learned strategies to add numbers from 1 to 10 using pictures.</p>
                          <p><a href="#">Learn More</a></small></p>
                        </div>
                        <div class="col-sm-4">
                          <h6 class="dash-col-header">What will <?php echo htmlentities($_SESSION['firstname']); ?> learn next?</h6>
                          <p><small><?php echo htmlentities($_SESSION['firstname']); ?> will learn how to add numbers 1-10 without using visuals.</p>
                          <p><a href="#">Learn More</a></small></p>
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