<?php

  // Start a session
  session_start();

  // Prepare the page
  if(isset($_GET['page']))
  {
    // Check if the user is logging out
    if($_GET['page'] == "logout")
    {
      session_destroy();
      session_unset();
      session_start();
    }

    // Get the path of the file to load
    $filename = "views/" . $_GET['page'] . ".php";
    $jsfilename = "js/" . $_GET['page'] . ".js";
    if(!file_exists($filename))
    {
      $filename = "views/404.php";
      $jsfilename = "js/404.js";
    }
  }
  else
  {
    // Not specified, load the home page
    $filename = "views/home.php";
    $jsfilename = "js/home.js";
  }

  // Prepare the session variables
  if(!isset($_SESSION["authenticated"]))  $_SESSION["authenticated"] = false;
  if(!isset($_SESSION["user_id"]))        $_SESSION["user_id"] = -1;
  if(!isset($_SESSION["email"]))          $_SESSION["email"] = "";
  if(!isset($_SESSION["firstname"]))      $_SESSION["firstname"] = "";
  if(!isset($_SESSION["lastname"]))       $_SESSION["lastname"] = "";
  if(!isset($_SESSION["type"]))           $_SESSION["type"] = "";
  if(!isset($_SESSION["schoolname"]))     $_SESSION["schoolname"] = "";
  if(!isset($_SESSION["phone"]))          $_SESSION["phone"] = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galaxy Mission</title>

  <!-- Bootstrap -->
  <link href="/css/bootstrap.css" rel="stylesheet">

  <!-- Custom Stylesheet -->
  <link href="/css/custom.css" rel="stylesheet">

  <!-- Font Awesome -->   
  <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
  <?php
  ini_set("display_errors", 1);
  ini_set("track_errors", 1);
  ini_set("html_errors", 1);
  error_reporting(E_ALL);
  ?>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/"><i class="fa fa-rocket"></i> Galaxy Mission</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <?php if($_SESSION["authenticated"]) { ?>
        <ul class="nav navbar-nav">
          <li><a href="/assignments/"><i class="fa fa-check-square-o"></i> Assignments</a></li>
          <li><a href="/practice/"><i class="fa fa-puzzle-piece"></i> Practice</a></li>
          <li><a href="/reports/"><i class="fa fa-file-text-o"></i> Reports</a></li>
        </ul>
        <?php } ?>
        <ul class="nav navbar-nav navbar-right">

          <?php if($_SESSION["type"] == "parent") { ?>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Children <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Example Student 1</a></li>
                <li><a href="#">Example Student 2</a></li>
                <li><a href="#">Example Student 3</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-cog"></i> Manage Students</a></li>
              </ul>
            </li>
          <?php } if($_SESSION["type"] == "teacher") { ?>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Classes <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Example Class 1</a></li>
                <li><a href="#">Example Class 2</a></li>
                <li><a href="#">Example Class 3</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-cog"></i> Manage Classes</a></li>
              </ul>
            </li>
          <?php } ?>

          <?php if($_SESSION["authenticated"]) { ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i> <?php if(strlen($_SESSION['firstname']) > 0) { echo $_SESSION['firstname']; } else { echo "Account"; } ?> <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
              <li><a href="/profile/"><i class="fa fa-cog"></i> Profile</a></li>
              <li><a href="#"><i class="fa fa-lock"></i> Change Password</a></li>
              <li class="divider"></li>
              <li><a href="/logout/"><i class="fa fa-sign-out"></i> Sign out</a></li>
              </ul>
            </li>
          <?php } else { ?>
            <li><a href="/register/"><i class="fa fa-file-text-o"></i> Register</a></li>
            <li><a href="/login/"><i class="fa fa-sign-in"></i> Sign In</a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
  <br /><br /><br /><br /><br />

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <?php require $filename; ?>
      </div>
    </div>
    <!--<div class="row">
      <div class="col-lg-12">
        <?php echo "<pre>" . print_r($_SESSION, TRUE) . "</pre>"; ?>
      </div>
    </div>-->
    <hr />
    <div class="row">
      <p>Copyright &copy; <a href="https://www.galaxymission.com/">Galaxy Mission</a> <?php echo date("Y"); ?></p>
    </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/js/jquery.maskedinput.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/global.js"></script>

  <!-- Load the javascript file for the page if applicable -->
  <?php
  if(file_exists($jsfilename))
  {
    echo '<script src="/' . $jsfilename . '"></script>';
  }
  ?>
</body>
</html>