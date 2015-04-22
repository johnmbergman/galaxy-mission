<?php require "controllers/authenticate.php";

  $name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
  $userEmail = $_SESSION['email'];
  $confirm = "";

  function spamcheck($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
      return true;
    } else {
      return false;
    }
  }

  if(isset($_REQUEST['emailAd'])) {
    $mailcheck = spamcheck($_REQUEST['emailAd']);
    if(($mailcheck == false) || !(strlen($_REQUEST['first_name'])>0) || !(strlen($_REQUEST['last_name'])>0) || !(strlen($_REQUEST['emailAd'])>0) || !(strlen($_REQUEST['message'])>0)) {
      echo "<div class='col-sm-10 col-sm-offset-2 alert alert-danger'>Invalid input. Please fill out all fields and re-send your message.</div>";
    } else {
      $first_name = $_REQUEST['first_name'];
      $last_name = $_REQUEST['last_name'];
      $emailAd = $_REQUEST['emailAd'];
      $subject = "Try Galaxy Mission today. Your kids will love it!";
      $message = $_REQUEST['message'];
      $from = "From: ". $name . " <" . $userEmail . ">\r";
      if (mail($emailAd, $subject, $message, $from)) {
        $confirm = "<div class='alert alert-success'><strong>Thank you for telling your friends about Galaxy Mission!</strong></div>";
      } else {
        $confirm = "<div class='alert alert-danger'><strong>Oops! It appears that your message didn't go through. Please try again later!</strong></div>";
      }
    }
  }
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="panel-primary">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3">
              <?php include "dashboard-menu.php"; ?>
            </div>
            <div class="col-md-9">
              <form class="form-horizontal" method="post" role="form">
                <fieldset>
                  <legend>Tell a friend about GalaxyMission.com!</legend>
                  <div class="form-group">
                    <label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputFirstName" name="first_name" placeholder="Your friend's first name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputLastName" name="last_name" placeholder="Your friend's last name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail" name="emailAd" placeholder="Your friend's email address">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputMessage" class="col-sm-2 control-label">Message</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="7" id="inputMessage" name="message">Hey!&#10;&#10;I recently signed my child up for Galaxy Mission, and it's been a hit in our home! It has made learning math so much fun. I thought your child might like it too!&#10;&#10;Best,&#10;<?php echo htmlentities($_SESSION['firstname']); ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                      <button type="submit" class="btn btn-primary">Send</button>
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