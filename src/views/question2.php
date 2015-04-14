<!--
src/views/question.php
Question Form
Description: This is the form that will except a question from the server that came 
              from the database that will then be displayed to the user and the user will input
              the answer and that will be sent to the server and then input in the database
              *currently it only outputs a input string and reads the anser from the user and displays
              it on the screen and in the console log 
              *currently need server code to continue
Date: 3/17/2015
Author: Jennifer Steadman
-->

<?php
require "controllers/authenticate.php";
require "models/mission-model.php";

// AJAX-based view. First, create the request to start a new mission
if(isset($_SESSION["current_mission"]))
{
  // A MISSION IS CURRENTLY SET. SAVE PROGRESS?? OR FORWARD TO DASHBOARD??
}

// Create a new mission
$_SESSION["current_mission"] = new Mission();


?>

<div class="jumbotron jumbotron-question">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 id="qQuestion">Loading question...</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4 text-center">
      <p>Your answer:</p>
      <input id="qInput" type="number" class="form-control input-lg" autocomplete="off" autofocus>
    </div>
  </div>
</div>

<style>
body{
  background-color: black;
  background: url(../res/question-bg-1.jpg) no-repeat;
  background-size: cover;
  background-attachment: fixed;
  background-position: center;
}
</style>

  