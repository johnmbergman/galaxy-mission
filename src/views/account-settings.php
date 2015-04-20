<?php require "controllers/authenticate.php"; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <h2>Account Settings</h2>
      <div class="panel-primary">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3">
              <?php include "dashboard-menu.php"; ?>
            </div>
            <div class="col-md-9">
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