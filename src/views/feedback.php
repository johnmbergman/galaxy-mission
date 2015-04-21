<?php require "controllers/authenticate.php"; ?>

<?php

  $email_to = "support@galaxymission.com";
  $confirm = "";

  function spamcheck($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
      return true;
    } else {
      return false;
    }
  }

  if(isset($_REQUEST['email'])) {
    $mailcheck = spamcheck($_REQUEST['email']);
    if(($mailcheck == false) || !(strlen($_REQUEST['name'])>0) || !(strlen($_REQUEST['email'])>0) || !(strlen($_REQUEST['message'])>0)) {
      echo "<div class='col-sm-10 col-sm-offset-2 alert alert-danger'>Invalid input. Please fill out all fields and re-submit your feedback.</div>";
    } else {
      $name = $_REQUEST['name'];
      $email = $_REQUEST['email'];
      $subj = $_REQUEST['subject'];
      $message = $_REQUEST['message'];
      $from = $from = "From: ". $name . " <" . $email . ">\r";
      if (mail($email_to, $subj, $message, $from)) {
        $confirm = "<div class='alert alert-success'><strong>Thank you for sending us your feedback!</strong></div>";
      } else {
        $confirm = "<div class='alert alert-danger'><strong>Oops! It appears that your message didn't go through. Please try again later!</strong></div>";
      }
    }
  }
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <h2>Feedback</h2>
      <div class="panel-primary">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3">
              <?php include "dashboard-menu.php"; ?>
            </div>
            <div class="col-md-9">
              <form class="form-horizontal" method="post" role="form">
                <fieldset>
                  <legend>Send Us Your Feedback</legend>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="name" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSubject" class="col-sm-2 control-label">Subject</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="inputSubject" name="subject">
                        <option>General comment</option>
                        <option>Report a bug / problem with Galaxy Mission</option>
                        <option>Submit a testimonial</option>
                        <option>Question or comment about Galaxy Mission</option>
                        <option>Other Inquiry</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputMessage" class="col-sm-2 control-label">Message</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="5" id="inputMessage" name="message"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                      <?php echo $confirm; ?>
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>  
    </div>
  </div>
</div>