<?php require "controllers/authenticate.php"; ?>
<?php
  if($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = new DashboardDataModel();
    if(isset($_GET["studentid"]))$model->studentid = $_GET["studentid"];
  
    $controller = new DashboardController($model);
    $student_first_name = "";
    $start_date = "";
    $grade_level=0;
  }

?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <h2>My Dashboard</h2>
      <div class="panel-primary">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3">
              <?php include "dashboard-menu.php"; ?>
            </div>
            <div class="col-md-9">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-sm-3">
                      <h4>Student:</h4>
                    </div>
                    <div class="col-sm-9">
                      <select class="form-control" id="studentSelect" onchange="location=this.options[this.selectedIndex].value;">
                        <?php if(!isset($_GET["studentid"])) echo "<option value='#'>Select a student...</option>"; ?>
                        <?php if(!isset($_GET["studentid"])) { $grade_level = 0; } ?>
                        <?php
                          // Open the connection
                          $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
                          if($conn->connect_error) {
                            trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
                          }

                          if($result = $conn->query("SELECT student_id, first_name, last_name, grade_level, date_created FROM students WHERE parent_id = " . $_SESSION["user_id"])) {
                            while ($row = $result->fetch_assoc()) {
                              if(isset($_GET["studentid"]))
                              {
                                if($_GET["studentid"] == $row["student_id"])
                                {
                                  $student_first_name = $row["first_name"];
                                  $start_date = $row["date_created"];
                                  $grade_level = $row["grade_level"];
                                }
                                echo "<option value='/parent-dashboard/" . $row["student_id"] . "' " . ($_GET["studentid"]==$row["student_id"] ? "selected" : "") . ">" . $row["first_name"] . " " . $row["last_name"] . "</option>";
                              }
                              else
                              {
                                echo "<option value='/parent-dashboard/" . $row["student_id"] . "'>" . $row["first_name"] . " " . $row["last_name"] . "</option>";
                              }
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
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
                            <div id = "kinderProg" class="progress-bar" style="width: <?php echo $controller->getKinderPercentComplete();?>%"></div>
                            <div id = "kinderNotComplete" class="progress-bar progress-bar-danger" style="width: <?php echo (100 - $controller->getKinderPercentComplete()); ?>%"></div>
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
                            <div id = "firstProg"  class="progress-bar" style="width: <?php echo $controller->getFirstPercentComplete();?>%"></div>
                            <div id = "firstNotComplete"  class="progress-bar progress-bar-danger" style="width: <?php echo (100 - $controller->getFirstPercentComplete()); ?>%"></div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="progress-label">2nd Grade:</p>
                        </div>
                        <div class="col-sm-9">
                          <div class="progress" style="width: 75%">
                            <div id = "firstPreProg"  class="progress-bar progress-bar-info" style="width: 0%"></div>
                            <div id = "firstProg"  class="progress-bar" style="width: <?php echo $controller->getSecondPercentComplete();?>%"></div>
                            <div id = "firstNotComplete"  class="progress-bar progress-bar-danger" style="width: <?php echo (100 - $controller->getSecondPercentComplete()); ?>%"></div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="progress-label">3rd Grade:</p>
                        </div>
                        <div class="col-sm-9">
                          <div class="progress" style="width: 75%">
                            <div id = "firstPreProg"  class="progress-bar progress-bar-info" style="width: 0%"></div>
                            <div id = "firstProg"  class="progress-bar" style="width: <?php echo $controller->getThirdPercentComplete();?>%"></div>
                            <div id = "firstNotComplete"  class="progress-bar progress-bar-danger" style="width: <?php echo (100 - $controller->getThirdPercentComplete()); ?>%"></div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <h5 class="dash-header">Progress Key</h5>
                          <span class="label label-info">Completed During Pretest</span>
                          <span class="label label-primary">Completed Curriculum</span>
                          <span class="label label-danger">Pending Completion</span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <h5 class="dash-header">Progress Summary</h5>
                          <p><small><?php echo $student_first_name; ?> began the intergalactic journey on <?php echo $start_date; ?></small></p>
                          <p><small>Total Number of Missions Completed: <?php echo $controller->getMissionsComplete(); ?></small></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <h6 class="dash-header"><?php echo $student_first_name; ?> is currently learning:</h6>
                      <p><small><?php echo $controller->listCurrentMissions($grade_level); ?></small><br></p>
                      <h6 class="dash-header">Here's what's next for <?php echo $student_first_name; ?>:</h6>
                      <p><small><?php echo $controller->listCurrentMissions($grade_level + 1); ?></small></p>
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
<?php $conn->close(); ?>