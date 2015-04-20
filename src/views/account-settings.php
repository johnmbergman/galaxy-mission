<?php require "controllers/authenticate.php"; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <h2>Account Settings</h2>
      <div class="panel-primary">
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-4">
              <ul class="nav nav-pills nav-stacked">
<!-- <<<<<<< HEAD -->
                <li class="active"><a href="account-settings">Account Overview</a></li>
                <li><a href="profile">Account Information</a></li>
                <li><a href="student-management">Student Information</a></li>
                <li class="disabled"><a href="#">Email Preferences</a></li>
                <li><a href="parent-dashboard">Return to My Dashboard</a></li>
<!-- ======= -->
                <li class="active"><a href="/account-settings/">Overview</a></li>
                <li><a href="/profile/">Account Information</a></li>
                <li><a href="/student-management/">Student Information</a></li>
                <li><a href="/parent-dashboard/">Return to Parent Dashboard</a></li>
<!-- >>>>>>> origin/master -->
              </ul>
            </div>
            <div class="col-sm-7 col-sm-offset-1">
              <div class="row">
                <a href="profile">Account Information</a>
                <p>Update your personal information, including your email address and password.</p>
              </div>
              <div class="row">
                <a href="student-management">Student Information</a>
                <p>Update your child's information, including his or her grade level and school name.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>