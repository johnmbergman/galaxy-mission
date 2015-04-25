<?php
/*
  Adam Hill
  HTML Created: April 10, 2015
  PHP updated: 4/23/15
  This page will offer a parent or teacher a dropdown menu to select their student from 
  and will then generate a report on that student.
*/
require "controllers/authenticate.php";

if($_SERVER["REQUEST_METHOD"] == "GET")
{
  $model = new ReportsModel();
  if(isset($_GET["studentid"]))$model->studentid = $_GET["studentid"];
  
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
      <h2>Student Reports</h2>
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
                          <th>Completed Missions</th>
                          <th>Uncompleted Missions</th>
                          <th>Overall level % correct</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td>K</td>
                            <td><?php echo $controller->MissionsAttemptedByLevel(0) ;?></td>
                            <td><?php echo $controller->MissionsCompletedByLevel(0) ;?></td>
                            <td><?php $controller->CompletedMissionsByLevel(0);?></td>
                            <td><?php $controller->UncompletedMissionsByLevel(0);?></td>
                            <td><?php echo $controller->LevelCorrectPercentage(0) ;?></td>
                          </tr>
                          <tr>
                            <td>1</td>
                            <td><?php echo $controller->MissionsAttemptedByLevel(1) ;?></td>
                            <td><?php echo $controller->MissionsCompletedByLevel(1) ;?></td>
                            <td><?php $controller->CompletedMissionsByLevel(1);?></td>
                            <td><?php $controller->UncompletedMissionsByLevel(1);?></td>
                             <td><?php echo $controller->LevelCorrectPercentage(1) ;?></td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td><?php echo $controller->MissionsAttemptedByLevel(2) ;?></td>
                            <td><?php echo $controller->MissionsCompletedByLevel(2) ;?></td>
                            <td><?php $controller->CompletedMissionsByLevel(2);?></td>
                            <td><?php $controller->UncompletedMissionsByLevel(2);?></td>
                            <td><?php echo $controller->LevelCorrectPercentage(2) ;?></td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td><?php echo $controller->MissionsAttemptedByLevel(3) ;?></td>
                            <td><?php echo $controller->MissionsCompletedByLevel(3) ;?></td>
                            <td><?php $controller->CompletedMissionsByLevel(3);?></td>
                            <td><?php $controller->UncompletedMissionsByLevel(3);?></td>
                           <td><?php echo $controller->LevelCorrectPercentage(3) ;?></td>
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
                            <td><?php echo $controller->MissionsAttemptedBySubject(1);?></td>
                            <td><?php echo $controller->MissionsCompletedBySubject(1);?></td>
                            <td><?php echo $controller->CorrectPercentageBySubject(1);?></td>
                          </tr>
                          <tr>
                            <td>Missing Numbers</td>
                            <td><?php echo $controller->MissionsAttemptedBySubject(2);?></td>
                            <td><?php echo $controller->MissionsCompletedBySubject(2);?></td>
                            <td><?php echo $controller->CorrectPercentageBySubject(2);?></td>
                          </tr>
                          <tr>
                            <td>Inequalities</td>
                            <td><?php echo $controller->MissionsAttemptedBySubject(3);?></td>
                            <td><?php echo $controller->MissionsCompletedBySubject(3);?></td>
                            <td><?php echo $controller->CorrectPercentageBySubject(3);?></td>
                          </tr>
                          <tr>
                            <td>Addition</td>
                            <td><?php echo $controller->MissionsAttemptedBySubject(4);?></td>
                            <td><?php echo $controller->MissionsCompletedBySubject(4);?></td>
                            <td><?php echo $controller->CorrectPercentageBySubject(4);?></td>
                          </tr>
                          <tr>
                          <td>Subtraction</td>
                            <td><?php echo $controller->MissionsAttemptedBySubject(5);?></td>
                            <td><?php echo $controller->MissionsCompletedBySubject(5);?></td>
                            <td><?php echo $controller->CorrectPercentageBySubject(5);?></td>
                          </tr>
                          <td>Parity</td>
                            <td><?php echo $controller->MissionsAttemptedBySubject(6);?></td>
                            <td><?php echo $controller->MissionsCompletedBySubject(6);?></td>
                            <td><?php echo $controller->CorrectPercentageBySubject(6);?></td>
                          </tr>
                          <td>Multiplication</td>
                            <td><?php echo $controller->MissionsAttemptedBySubject(7);?></td>
                            <td><?php echo $controller->MissionsCompletedBySubject(7);?></td>
                            <td><?php echo $controller->CorrectPercentageBySubject(7);?></td>
                          </tr>
                          <td>Division</td>
                            <td><?php echo $controller->MissionsAttemptedBySubject(8);?></td>
                            <td><?php echo $controller->MissionsCompletedBySubject(8);?></td>
                            <td><?php echo $controller->CorrectPercentageBySubject(8);?></td>
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
                            <th>High Score</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php

						  // Attempt to connect to the database
						  $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
						  if($conn->connect_error)
						  {
							  trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
						  }

						  $i = 0;
						  while ($i <= $controller->HighestMissionAttempted())
						  {
  							if ($controller->MissionAttempted($i))
    						  {?>
                        
                          <tr>
                            <td><?php $controller->GetMissionName($i);?></td>
                            <td><?php echo $controller->AttemptsByMission($i);?></td>
                            <td><?php echo $controller->AvgMissionScore($i);?></td>
                            <td><?php echo $controller->MissionHighScore($i);?></td>
                          </tr>
    					
    					  <?php }
    					    $i = $i + 1;
    					   } ?>
    
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
