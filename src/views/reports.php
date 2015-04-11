/*
  Adam Hill
  HTML Created: April 10, 2015
  This page will offer a parent or teacher a dropdown menu to select their student from 
  and will then generate a report on that student.
*/



<div class="container-fluid">
<h1>Student Reports</h1>
  <div class="row">
	<div class="col-sm-12">
	  <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
            <div class="col-md-8 text-right">	   
              <div class="form-group">
                <label for="input-student" class="col-md-4 text-right control-label"><h4>Student</h4></label>
                <div class="col-md-6">
                  <select name="student" class="form-control" id="input-student">
                    <option value="0">John Bergman</option>
					<option value="1">Jennifer Steadman</option>
					<option value="2">Tyler Decker</option>
					<option value="3">Shaun Fyffe</option>
					<option value="4">Adam Hill</option>
				  </select>
				</div>
			  </div>
			</div>	  
            <div class="col-md-4 text-center">
              <div class="form-group">
                <button type="submit" class="btn btn-info">Generate</button>
              </div>  
            </div>
          </div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="AssessmentLevel">Assessment Level</label>
                <input class="form-control" id="disabledInput" type="text" placeholder="The level the student assessed to will show here..." disabled="">
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="CurrentLevel">Current Game Level</label>
                <input class="form-control" id="disabledInput" type="text" placeholder="The current level the student is at to will show here..." disabled="">
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="MissionCompletion">Mission Completion Percentage</label>
                <input class="form-control" id="disabledInput" type="text" placeholder="The student's completion percentage will show here..." disabled="">
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="ProblemPercentage">Correct Answer Percentage</label>
                <input class="form-control" id="disabledInput" type="text" placeholder="The student's correct percentage will show here..." disabled="">
              </div>
            </div>
            <div class="col-sm-12">
            <h2>Performance by level</h2>
              <table class="table table-striped table-hover ">
  				<thead>
    			  <tr>
      				<th>Level</th>
      				<th># Missions Attempted</th>
      				<th># Missions Completed</th>
      				<th>Best Mission</th>
      				<th>Needs Most Improvement</th>
      				<th>Overall level % correct<th>
    			  </tr>
  				</thead>
  				<tbody>
    		      <tr>
      			    <td>K</td>
      				<td>5</td>
      				<td>5</td>
      				<td>Counting & Cardinality - 95%</td>
      				<td>Operations & Algebraic Thinking - 80%</td>
      				<td>89%</td>
    			  </tr>
                  <tr>
      			    <td>1</td>
      				<td>5</td>
      				<td>5</td>
      				<td>Measurements and Data - 95%</td>
      				<td>Operations & Algebraic Thinking - 80%</td>
      				<td>89%</td>
    			  </tr>
                  <tr class="info">
                  <td>2</td>
      				<td>4</td>
      				<td>2</td>
      				<td>Measurements and Data - 60%</td>
      				<td>Operations & Algebraic Thinking - 50%</td>
      				<td>55%</td>
    			  </tr>
                  <tr class="success">
                  <td>3</td>
      				<td></td>
      				<td></td>
      				<td></td>
      				<td></td>
    			  </tr>
    			</tbody>
    		  </table>
    	    <h2>Performance by Standard</h2>
              <table class="table table-striped table-hover ">
  				<thead>
    			  <tr>
      				<th>Standard</th>
      				<th>Number of missions attempted</th>
      				<th>Number of missions completed</th>
      				<th>Overall level % correct<th>
    			  </tr>
  				</thead>
  				<tbody>
    		      <tr>
      			    <td>Counting & Cardinality</td>
      				<td>1</td>
      				<td>1</td>
      				<td>95%</td>
    			  </tr>
                  <tr>
      			    <td>Operations & Algebraic Thinking</td>
      				<td>3</td>
      				<td>2</td>
      				<td>89%</td>
    			  </tr>
                  <tr class="info">
                  <td>Numbers and Operations in Base 10</td>
      				<td>3</td>
      				<td>2</td>
      				<td>82%</td>
    			  </tr>
                  <tr class="success">
                  <td>Measurements and Data</td>
      				<td>2</td>
      				<td>2</td>
      				<td>88</td>
    			  </tr>
    			  <tr class="danger">
    			  <td>Geometry</td>
    			    <td>2</td>
      				<td>2</td>
      				<td>90</td>
    			  </tr>
    	     	  <tr class="warning">
			      <td>Numbers and Opertions - Fractions</td>
                    <td>0</td>
      				<td>0</td>
      				<td></td>
    			  </tr>
    			</tbody>
    		  </table>
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
  <div>			   
</div>          
          
          
