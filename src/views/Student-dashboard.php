<?php
/* 
	Adam Hill
	Updated 4/14/15
	Student dashboard
*/
	$student_id = $_SESSION["user_id"];
	$sql = "select game_level from students where student_id='" . $student_id . "'";
    
    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    }

    // Successfully connected to the database. Run the query
    $current_level = $conn->query($sql); 
  
?>  
<div class="row">
  <div class="col-lg-12">
    <h1>Student Dashboard</h1>
  </div>
</div>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h1 class="panel-title">Module (Level) 1 or Kindergarten</h1>
  </div>
  <div class="panel-body">
    <div class="col-md-12">
      <div class="list-group">
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/earth.png" style="height:4em;width:4em;float:left;" alt="Earth">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      </a>
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/mars.png" style="height:4em;width:4em;float:left;" alt="Mars">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      </a>
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/jupiter.png" style="height:4em;width:4em;float:left;" alt="Jupiter">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/neptune.png" style="height:4em;width:4em;float:left;" alt="Neptune">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      </a>
      </div>
    </div>
  </div>
</div>

<?php

if ($current_level > 0)  
{?>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h1 class="panel-title">Module (Level) 2 or 1st Grade</h1>
  </div>
  <div class="panel-body">
    <div class="col-md-12">
      <div class="list-group">
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/earth.png" style="height:4em;width:4em;float:left;" alt="Earth">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      </a>
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/mars.png" style="height:4em;width:4em;float:left;" alt="Mars">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      </a>
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/jupiter.png" style="height:4em;width:4em;float:left;" alt="Jupiter">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/neptune.png" style="height:4em;width:4em;float:left;" alt="Neptune">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      </a>
      </div>
    </div>
  </div>
</div>
<? } ?>

<?php
if ($current_level > 1) 
{?>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h1 class="panel-title">Module (Level) 3 or 2nd Grade</h1>
  </div>
  <div class="panel-body">
    <div class="col-md-12">
      <div class="list-group">
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/earth.png" style="height:4em;width:4em;float:left;" alt="Earth">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      </a>
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/mars.png" style="height:4em;width:4em;float:left;" alt="Mars">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      </a>
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/jupiter.png" style="height:4em;width:4em;float:left;" alt="Jupiter">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/neptune.png" style="height:4em;width:4em;float:left;" alt="Neptune">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      </a>
      </div>
    </div>
  </div>
</div>
<? } ?>

<?php
if ($current_level > 2)  
{?>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h1 class="panel-title">Module (Level) 4 or 3rd Grade</h1>
  </div>
  <div class="panel-body">
    <div class="col-md-12">
      <div class="list-group">
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/earth.png" style="height:4em;width:4em;float:left;" alt="Earth">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      </a>
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/mars.png" style="height:4em;width:4em;float:left;" alt="Mars">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      </a>
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/jupiter.png" style="height:4em;width:4em;float:left;" alt="Jupiter">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      <a href="#" class="list-group-item">
        <div>
          <img src="../res/neptune.png" style="height:4em;width:4em;float:left;" alt="Neptune">
          <h4><u>Mission Title</u></h4>
          <p>A brief description of the mission can go here.</p>
        </div>
      </a>
      </div>
    </div>
  </div>
</div>
<? } ?>