<?php
require "controllers/data.php";
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
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    $current_level = $row[0];

    // CLose the database
    $conn->close();
    
    function complete($mission)
    {
    
    	$returnflag = false;
    	
    	$sql = "select max number_correct from student_mission_record where mission_id ='" . $mission . "'";
    	
    	// Attempt to connect to the database
        $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
        if($conn->connect_error)
        {
      		trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
    	}

    	// Run the query
    	$result = $conn->query($sql);
    	
    	if ($result >= 8)
    		$returnflag = true;
    		
    	// CLose the connection and return the result
    	$conn->close();
    	return $returnflag;
    };
?>  
<div class="row">
  <div class="col-lg-12">
    <h1>Student Dashboard</h1>
  </div>
</div>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h1 class="panel-title">Space Cadet Training</h1>
  </div>
  <div class="panel-body">
    <div class="col-md-12">
      <div class="list-group">
      <a href="/question/2" class="list-group-item">
        <div class="row">
        <div class="col-md-10">
          <img src="../res/parabolic8.png" style="height:4em;width:4em;margin:10px;float:left;" alt="antennas">
          <h4><u>Counting Numbers</u></h4>
          <p>In order to get accepted to the Intergalactic Federation's Academy for Space Exploration you must pass this entry exam.  Prove that for you counting is as easy as 1, 2, 3.</p>
        </div>
        <div class="col-md-2">
        <?php 
        	if (complete(7))
        	{?>
        		<img src="../res/green-check.png" style="height:4em;width:4em;margin:10px;float:right;" alt="checkmark">
        	<?php } ?>			
        </div>
        </div>
      </a>
      <a href="/question/3" class="list-group-item">
        <div class="row">
        <div class="col-md-10">
          <img src="../res/astronaut7.png" style="height:4em;width:4em;margin:10px;float:left;" alt="astronaut">
          <h4><u>Fill in Missing Numbers</u></h4>
          <p>Help a fellow cadet lost on a training exercise get back to the group by filling in the missing numbers from these sequences.</p><br>
        </div>
        <div class="col-md-2">
        <?php 
        	if (complete(8))
        	{?>
        		<img src="../res/green-check.png" style="height:4em;width:4em;margin:10px;float:right;" alt="checkmark">
        	<?php } ?>			
        </div>
        </div>
      </a>
      <a href="/question/10" class="list-group-item">
        <div class="row">
        <div class="col-md-10">
          <img src="../res/spacecraft5.png" style="height:4em;width:4em;margin:10px;float:left;" alt="spacecraft">
          <h4><u>Add and Subtract</u></h4>
          <p>Pass your spaceflight training by solving these add and subtract problems.</p><br>
        </div>
        <div class="col-md-2">
        <?php 
        	if (complete(9))
        	{?>
        		<img src="../res/green-check.png" style="height:4em;width:4em;margin:10px;float:right;" alt="checkmark">
        	<?php } ?>			
        </div>
        </div>
      </a>
      </div>
    </div>
  </div>
</div>

<?php
if ($current_level > 0)  
{ ?>
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
<?php } ?>

<?php
if ($current_level > 1) 
{ ?>
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
<?php } ?>

<?php
if ($current_level > 2)  
{ ?>
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
<?php } ?>