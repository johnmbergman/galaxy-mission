<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="text-center">
      <h1 class="text-black">Insert Student Name's Information</h1>
      <p class="lead text-black">Click in a field to edit information you would like to change, and then click the Save button.</p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <form method="post" class="form-horizontal well">
      <fieldset>
      <legend>Student Name's Information</legend>
        <div class="form-group">
          <label for="firstName" class="col-lg-4 control-label">First Name</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="firstName" placeholder="First Name">
          </div>
        </div>
        <div class="form-group">
          <label for="lastName" class="col-lg-4 control-label">Last Name</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="lastName" placeholder="Last Name">
          </div>
        </div>
        <div class="form-group">
          <label for="gender" class="col-lg-4 control-label">Gender</label>
          <div class="col-lg-8">
            <select class="form-control" id="gender">
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="grade" class="col-lg-4 control-label">Grade Level</label>
          <div class="col-lg-8">
            <select class="form-control" id="grade">
              <option>Kindergarten</option>
              <option>1st Grade</option>
              <option>2nd Grade</option>
              <option>3rd Grade</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="schoolName" class="col-lg-4 control-label">School Name</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="schoolName" placeholder="School Name (optional)">
          </div>
        </div>
        <div class="form-group">
          <label for="teacherName" class="col-lg-4 control-label">Teacher Name</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="teacherName" placeholder="Teacher Name (optional)">
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-8 col-lg-offset-4">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>