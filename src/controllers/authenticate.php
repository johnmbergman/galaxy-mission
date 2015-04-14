<?php
/*
This script should be attached to the top of any view that requires authentication to view.
Author: John Bergman
Date: 2015-04-14
*/

// Flag for determining if they are authenticated
$logged_in = false;

// Check if the variable is even set
if(isset($_SESSION["authenticated"]))
{
  if($_SESSION["authenticated"] == true)
  {
    $logged_in = true;
  }
}

// We have determined if they are logged in. If they are not, forward them
if(! $logged_in)
{
  // The user is NOT logged in, forward them to the login page
  header("Location: /login/");
  exit;
}

?>
