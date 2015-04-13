<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3">
      <a href="#"><img class="img-responsive-dash" src="/../res/tell-friend.jpg" /></a>
      <div class="panel panel-default">
        <div class="panel-body">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="/parent-dashboard/">Parent Dashboard</a></li>
            <li><a href="/account-settings/">Account Settings</a></li>
            <li><a href="/reports/">Student Reports</a></li>
            <li><a href="#">Notifications</a></li>
            <li><a href="/contact/">Contact Us</a></li>
            <li class="active"><a href="feedback">Send Us Feedback</a></li>
          </ul>
        </div>
      </div>  
    </div>
    <div class="col-sm-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <form class="form-horizontal">
            <fieldset>
              <legend>Send Us Your Feedback</legend>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" placeholder="Name">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail" placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <label for="selectSubject" class="col-sm-2 control-label">Subject</label>
                <div class="col-sm-10">
                  <select class="form-control" id="selectSubject">
                    <option>General comment</option>
                    <option>Report a bug / problem with Galaxy Mission</option>
                    <option>Submit a testimonial</option>
                    <option>Question or comment about Galaxy Mission</option>
                    <option>Other Inquiry</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="textArea" class="col-sm-2 control-label">Textarea</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="5" id="textArea"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                  <button type="reset" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>