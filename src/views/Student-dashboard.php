<!--
	Adam Hill
	Updated 4/14/15
	Student dashboard
-->

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
        <!-- Completion Status goes here -->
      </div>
    </div>
  </a>

  <?php
}

echo "</div></div></div></div>";
$conn->close();

?>
