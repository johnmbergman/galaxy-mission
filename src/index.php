<?php

  // Application includes
  require "controllers/includes.php";

  // Start a session
  session_start();

  // Require the data page for database values
  require "controllers/data.php";

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
  if(!isset($_SESSION["authenticated"]))        $_SESSION["authenticated"] = false;
  if(!isset($_SESSION["user_id"]))              $_SESSION["user_id"] = -1;
  if(!isset($_SESSION["email"]))                $_SESSION["email"] = "";
  if(!isset($_SESSION["firstname"]))            $_SESSION["firstname"] = "";
  if(!isset($_SESSION["lastname"]))             $_SESSION["lastname"] = "";
  if(!isset($_SESSION["type"]))                 $_SESSION["type"] = "";
  if(!isset($_SESSION["schoolname"]))           $_SESSION["schoolname"] = "";
  if(!isset($_SESSION["phone"]))                $_SESSION["phone"] = "";
  if(!isset($_SESSION["current_student_id"]))   $_SESSION["current_student_id"] = -1;
  if(!isset($_SESSION["current_student_name"])) $_SESSION["current_student_name"] = "";
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
  <link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">

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
          <li><a href="/parent-dashboard/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li><a href="/reports/"><i class="fa fa-file-text-o"></i> Reports</a></li>
        </ul>
        <?php } ?>
        <ul class="nav navbar-nav navbar-right">

          <?php if($_SESSION["type"] == "parent") { ?>
            <?php if($_SESSION["current_student_id"] > 0) { ?>
              <li><a id="studentstars" href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="The total number of stars earned."><i class="fa fa-star"></i> 0</a></li>
            <?php } ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-users"></i>
                <?php echo (strlen($_SESSION["current_student_name"]) > 0 ? $_SESSION["current_student_name"] : "Children"); ?>
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
<?php
$conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
if($conn->connect_error) {
  trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
}

// Run the command
if($result = $conn->query("SELECT student_id, first_name, last_name FROM students WHERE parent_id = " . $_SESSION["user_id"])) {
  while ($row = $result->fetch_assoc()) {
    echo "<li class='dropdown-header'><strong>" . $row["first_name"] . " " . $row["last_name"] . "</strong></li>";
    echo "<li><a href='/student-management/" . $row["student_id"] . "'><i class='fa fa-gear'></i> Profile</a></li>";
    if($_SESSION["current_student_id"] > 0)
    {
      if($row["student_id"] == $_SESSION["current_student_id"])
      {
        echo "<li><a><strong class='text-success'><i class='fa fa-check-circle'></i> Signed in</strong></a></li>";
        echo "<li><a href='/student-dashboard/'><i class='fa fa-dashboard'></i> Dashboard</a></li>";
      }
      else
      {
        echo "<li><a href='/student-login/" . $row["student_id"] . "'><i class='fa fa-sign-in'></i> Sign in</a></li>";
      }
    }
    else
    {
      echo "<li><a href='/student-login/" . $row["student_id"] . "'><i class='fa fa-sign-in'></i> Sign in</a></li>";
    }
    echo "<li class='divider'></li>";
  }
}

// Close the connection
$conn->close();
?>
                <li><a href="/student-management/"><i class="fa fa-cog"></i> Manage Students</a></li>
                <li><a href="/register-student/"><i class="fa fa-file-text-o"></i> Register Child</a></li>
              </ul>
            </li>
          <?php } ?>

          <?php if($_SESSION["authenticated"]) { ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i> <?php echo (strlen($_SESSION['firstname']) > 0 ? $_SESSION['firstname'] : "Account"); ?> <b class="caret"></b>
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
  <?php
    if($filename == "views/home.php") {
      echo '<div class="container-fluid">';
      require $filename;
      echo '</div>';
    } else {
      echo '<br /><br /><br /><br /><br />';
      echo '<div class="container">';
      echo '<div class="row">';
      echo '<div class="col-lg-12">';
      require $filename;
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }
  ?>
  <hr />
  <footer class="container">
    <div class="row">
      <p>Copyright &copy; <a href="/">Galaxy Mission</a> <?php echo date("Y"); ?>. <a href="/tos/">Terms of Service</a>.</p>
    </div>
  </footer>

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