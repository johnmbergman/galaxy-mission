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

*This also currently contains the CSS at the bottom which will be moved to the custom CSS file
  we are currently working on organizing

-->



<!--creates form to display math problem and allow user to enter answer and press enter -->


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
<!--<div class="question-image">
  <div class="col-md-5 col-md-offset-3">
    <h1>
      <div class="panel panel-default" id="div1">
      </div>
    </h1>
	  <form class="panel panel-default" name="Question" id="ques" method="get" autocomplete="off" id="qForm">
  	  <label class="control-label" id="labelAnswer" for="inputLarge">Enter the missing number below.
      </label><br>
  	  <input class=".formcontrol" name="number" id="answer" type="text" size="10" autofocus>
      <input type="submit" onclick="submitFunction()" style="position: absolute; left: -9999px; width: 1px; height: 1px;"/>
      <div id="div2">
      </div>
    </form>
  </div>
</div>-->

<style>
body{
  background-color: black;
  background: url(../res/question-bg-1.jpg) no-repeat;
  background-size: cover;
  background-attachment: fixed;
  background-position: center;
}
</style>

  