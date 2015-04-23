<?php
/*
  Adam Hill
  HTML Created: April 10, 2015
  This page will offer a parent or teacher a dropdown menu to select their student from 
  and will then generate a report on that student.
*/
require "controllers/authenticate.php";

if($_SERVER["REQUEST_METHOD"] == "GET")
{
  $model = new ReportsModel();
  $model->studentid = $_GET["studentid"];
  
  $controller = new ReportsController($model);
  $assessmentLevel = $controller->getAssessmentLevel();
  $gameLevel = $controller->getGameLevel();
  $misCompPerc = $controller->CompletionPercentage();
  $answerPercent = $controller->CorrectPercentage();
 } 
  
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <h2>Student Reports <small>Sample</small></h2>
      <div class="panel-primary">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3">
              <?php include "dashboard-menu.php"; ?>
            </div>
            <div class="col-md-9">
              <div class="panel panel-default">

                <!-- Panel Heading -->
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-sm-3">
                      <h4>Student:</h4>
                    </div>
                    <div class="col-sm-9">
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
                                echo "<option value='/reports/" . $row["student_id"] . "' " . ($_GET["studentid"]==$row["student_id"] ? "selected" : "") . ">" . $row["first_name"] . " " . $row["last_name"] . "</option>";
                              }
                              else
                              {
                                echo "<option value='/reports/" . $row["student_id"] . "'>" . $row["first_name"] . " " . $row["last_name"] . "</option>";
                              }
                            }
                          }

                          // Close the connection
                          $conn->close();

                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Panel Body -->
                <div class="panel-body">

                  <!-- Overall Values -->
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="control-label" for="AssessmentLevel">Assessment Level</label>
                        <input class="form-control" id="disabledInput" type="text" value="<?php echo $assessmentLevel; ?>" disabled="">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="control-label" for="CurrentLevel">Current Game Level</label>
                        <input class="form-control" id="disabledInput" type="text" value="<?php echo $gameLevel; ?>" disabled="">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="control-label" for="MissionCompletion">Mission Completion %</label>
                        <input class="form-control" id="disabledInput" type="text" value="<?php echo $misCompPerc; ?>" disabled="">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="control-label" for="ProblemPercentage">Correct Answer %</label>
                        <input class="form-control" id="disabledInput" type="text" value="<?php echo $answerPercent; ?>" disabled=""> 
                      </div>
                    </div>
                  </div>
                  <hr/>

                  <!-- Performance by Level table -->
                  <div class="row">
                    <div class="col-lg-12">
                      <h2>Performance by level</h2>
                      <table class="table table-striped table-hover">
                        <thead>
                          <th>Level</th>
                          <th># Missions Attempted</th>
                          <th># Missions Completed</th>
                          <th>Best Mission</th>
                          <th>Needs Most Improvement</th>
                          <th>Overall level % correct</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td>K</td>
                            <td><?php echo $controller->MissionsAttemptedByLevel(0) ;?></td>
                            <td>5</td>
                            <td>Counting &amp; Cardinality - 95%</td>
                            <td>Operations &amp; Algebraic Thinking - 80%</td>
                            <td>89%</td>
                          </tr>
                          <tr>
                            <td>1</td>
                            <td>5</td>
                            <td>5</td>
                            <td>Measurements and Data - 95%</td>
                            <td>Operations &amp; Algebraic Thinking - 80%</td>
                            <td>89%</td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>4</td>
                            <td>2</td>
                            <td>Measurements and Data - 60%</td>
                            <td>Operations &amp; Algebraic Thinking - 50%</td>
                            <td>55%</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>5</td>
                            <td>5</td>
                            <td>Measurements and Data - 70%</td>
                            <td>Operations &amp; Algebraic Thinking - 40%</td>
                            <td>45%</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <hr/>

                  <!-- Performance by Standard -->
                  <div class="row">
                    <div class="col-lg-12">
                      <h2>Performance by subject</h2>
                      <table class="table table-striped table-hover ">
                        <thead>
                          <tr>
                            <th>Standard</th>
                            <th>Number of missions attempted</th>
                            <th>Number of missions completed</th>
                            <th>Overall subject % correct</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Counting</td>
                            <td>1</td>
                            <td>1</td>
                            <td>95%</td>
                          </tr>
                          <tr>
                            <td>Missing Numbers</td>
                            <td>3</td>
                            <td>2</td>
                            <td>89%</td>
                          </tr>
                          <tr>
                            <td>Inequalities</td>
                            <td>3</td>
                            <td>2</td>
                            <td>82%</td>
                          </tr>
                          <tr>
                            <td>Addition</td>
                            <td>2</td>
                            <td>2</td>
                            <td>88</td>
                          </tr>
                          <tr>
                          <td>Subtraction</td>
                            <td>2</td>
                            <td>2</td>
                            <td>90</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <hr/>

                  <!-- Mission Performance -->
                  <div class="row">
                    <div class="col-lg-12">
                      <h2>Mission Performance</h2>
                      <table class="table table-striped table-hover ">
                        <thead>
                          <tr>
                            <th>Mission Name</th>
                            <th># Attempts</th>
                            <th>Average Score</th>
                            <th># Attempts to Complete</th>
                            <th>High Score</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th>Count the stars</th>
                            <th>2</th>
                            <th>95%</th>
                            <th>1</th>
                            <th>100%</th>
                          </tr>
                          <tr>
                            <th>Moon station flight</th>
                            <th>3</th>
                            <th>85%</th>
                            <th>2</th>
                            <th>100%</th>
                          </tr>
                        </tbody>
                      </table> 
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
