<?php $currentpage = $_GET["page"]; ?>
<a href="#"><img class="img-responsive-dash" src="/../res/tell-friend.jpg" /></a>
<div class="panel panel-default">
  <div class="panel-body">
    <ul class="nav nav-pills nav-stacked">
      <li <?php echo ($currentpage=="parent-dashboard" ? "class='active'" : ""); ?>><a href="/parent-dashboard/"><i class="fa fa-dashboard"></i> My Dashboard</a></li>
      <li <?php echo ($currentpage=="profile" ? "class='active'" : ""); ?>><a href="/profile/"><i class="fa fa-gear"></i> Account Settings</a></li>
      <li <?php echo ($currentpage=="reports" ? "class='active'" : ""); ?>><a href="/reports/"><i class="fa fa-file-text-o"></i> Student Reports</a></li>
      <li class="disabled"><a href="#"><i class="fa fa-trophy"></i> View Achievements</a></li>
      <li <?php echo ($currentpage=="contact" ? "class='active'" : ""); ?>><a href="/contact/"><i class="fa fa-envelope-o"></i> Contact Us</a></li>
      <li <?php echo ($currentpage=="feedback" ? "class='active'" : ""); ?>><a href="/feedback/"><i class="fa fa-envelope-o"></i> Send Us Feedback</a></li>
    </ul>
  </div>
</div> 