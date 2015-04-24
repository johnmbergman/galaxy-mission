<!--
	Adam Hill
	Updated 4/14/15
	Student dashboard
-->
<?php
public function MissionCompleted($question_type_id)
  {
  	$sql = "select count(*) from student_mission_record join question_type on student_mission_record.question_type_id=question_type.question_type_id where student_mission_record.student_id=".($this->model->studentid)." and question_type.question_type_id=".($question_type_id)." and student_mission_record.number_correct between 8 and 10";
  	
  	// Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

  // Successfully connected to the database. Run the query
    if($conn->query($sql) == false)
    {
      echo "bad sql " . $sql;
      trigger_error("Failed to register the account");
    }
    else 
      echo ($conn->query($sql)->fetch_array(MYSQLI_NUM)[0]);
      if (($conn->query($sql)->fetch_array(MYSQLI_NUM)[0]) > 0)
        return true;
      else
        return false;
  }?>
  
<!-- Page Header -->
<div class="row">
  <div class="col-lg-12">
    <h1>Student Dashboard <small>for <?php echo $_SESSION["current_student_name"]; ?></small></h1>
  </div>
</div>

<?php

// Attempt to connect to the database
$conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
if($conn->connect_error)
{
  trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
}

// Group and display the available missions.
$lastgrade = -1;
$result = $conn->query("select question_type_id,grade_level,name,description from question_type where enabled=1 and grade_level<=" . $_SESSION["current_student_grade"] . " order by grade_level");
while ($row = $result->fetch_assoc())
{
  if($row["grade_level"] != $lastgrade)
  {
    if($lastgrade != -1) { ?>
    </div></div></div></div>
    <?php } ?>
    <div class="panel panel-primary">
      <div class="panel panel-heading">
        <h1 class="panel-title">Space Cadet <?php echo ($row["grade_level"] == 0 ? "Training" : "Level " . $row["grade_level"]); ?></h1>
      </div>
      <div class="panel-body">
        <div class="col-lg-12">
          <div class="list-group">
    <?php
    $lastgrade = $row["grade_level"];
  } ?>

  <a href="/question/<?php echo $row["question_type_id"]; ?>" class="list-group-item">
    <div class="row">
      <div class="col-sm-10">
        <img src="../res/<?php echo $row["question_type_id"]; ?>galaxy.jpg" style="height:6em;width:6em;margin:10px;float:left;" alt="antennas" />
        <h4><u><?php echo $row["name"]; ?></u></h4>
        <p><?php echo $row["description"]; ?></p>
      </div>
      <div class="col-sm-2">
        <?php if MissionCompleted($row["question_type_id"])
        	
        	echo <img src="../res/green-check.png" style="height:4em;width:4em;margin:10px;float:right;" alt="checkmark">;
        	 ?>
      </div>
    </div>
  </a>

  <?php
}

echo "</div></div></div></div>";
$conn->close();

?>
