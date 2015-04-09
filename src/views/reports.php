<div class="container-fluid">
  <div class="row">
	<div class="col-sm-12">
	  <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
            <div class="col-md-4">
              <h3>Reports</h3>
            </div>
            <div class="col-md-8 text-left">	   
            <div class="form-group">
              <label for="input-student" class="col-md-4 text-right control-label">Student</label>
              <div class="col-md-4">
                <select name="student" class="form-control" id="input-student">
				  <?php

                    // Open the connection
                    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
                    if($conn->connect_error) {
                      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
                    }

                    // Run the command
                    if($result = $conn->query("SELECT student_id, first_name, last_name FROM students WHERE parent_id = " . $_SESSION["user_id"])) {
                      while ($row = $result->fetch_assoc()) {
                        echo "<option val='" . $row["student_id"] . "'>" . $row["first_name"] . " " . $row["last_name"] . "</option>";
                      }
                    }

                    // Close the connection
                    $conn->close();

                  ?>
			    </select>
              </div>
            </div>
          </div>
        </div>   
        <div class="panel-body">
          <div class="row">
            <table class="table"> <!-- table-striped table-hover"-->
  			  <thead>
    			<tr>
      			  <th>Skill/Grade Level</th>
      			  <th>Kindergarten</th>
      			  <th>First Grade</th>
      			  <th>Second Grade</th>
      			  <th>Third Grade</th>
    			</tr>
  			  </thead>
  			  <tbody>
    			<tr>
      			  <td>Overall Progress</td>
      			  <td>
      			    <div class="progress" style="width: 75%">
                      <div class="progress-bar progress-bar-info" style="width: 100%"></div>
                      <div class="progress-bar" style="width: 0%"></div>
                      <div class="progress-bar progress-bar-danger" style="width: 0%"></div>
                    </div>
                  </td>
      			  <td>
      			    <div class="progress" style="width: 75%">
                      <div class="progress-bar progress-bar-info" style="width: 100%"></div>
                      <div class="progress-bar" style="width: 0%"></div>
                      <div class="progress-bar progress-bar-danger" style="width: 0%"></div>
                    </div>
                  </td>
      			  <td>
      			    <div class="progress" style="width: 75%">
                      <div class="progress-bar progress-bar-info" style="width: 10%"></div>
                      <div class="progress-bar" style="width: 25%"></div>
                      <div class="progress-bar progress-bar-danger" style="width: 65%"></div>
                    </div>
      			  </td>
      			  <td>
      			    <div class="progress" style="width: 75%">
                      <div class="progress-bar progress-bar-info" style="width: 0%"></div>
                      <div class="progress-bar" style="width: 0%"></div>
                      <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                    </div>
                  </td>
    			</tr>
    		  </tbody>
			</table> 
		  </div>
	    </div>
      </div>
    </div>
  </div>
</div>
