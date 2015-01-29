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
    if(!file_exists($filename))
    {
      $filename = "views/404.php";
    }
  }
  else
  {
    // Not specified, load the home page
    $filename = "views/home.php";
  }

  // Prepare the session variables
  if(!isset($_SESSION["authenticated"]))  $_SESSION["authenticated"] = false;
  if(!isset($_SESSION["email"]))          $_SESSION["email"] = "";
  if(!isset($_SESSION["firstname"]))      $_SESSION["firstname"] = "";
  if(!isset($_SESSION["lastname"]))       $_SESSION["lastname"] = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galaxy Mission</title>

  <!-- Bootstrap -->
  <link href="/css/bootstrap.min.css" rel="stylesheet">

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
        <ul class="nav navbar-nav">
          <li><a href="#">Menu Item 1</a></li>
          <li><a href="#">Menu Item 2</a></li>
          <li><a href="#">Menu Item 3</a></li>
          <li><a href="#">Menu Item 4</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
            if($_SESSION["authenticated"])
            {
              echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Account <b class="caret"></b></a>';
              echo '<ul class="dropdown-menu">';
              echo '<li><a href="/profile/"><i class="fa fa-cog"></i> Profile</a></li>';
              echo '<li><a href="#"><i class="fa fa-lock"></i> Change Password</a></li>';
              echo '<li class="divider"></li>';
              echo '<li><a href="/logout/"><i class="fa fa-sign-out"></i> Sign out</a></li>';
              echo '</ul>';
              echo '</li>';
            }
            else
            {
              echo '<li><a href="/register/"><i class="fa fa-file-text-o"></i> Register</a></li>';
              echo '<li><a href="/login/"><i class="fa fa-sign-in"></i> Sign in</a></li>';
            }
          ?>
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
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="/js/bootstrap.min.js"></script>
</body>
</html>