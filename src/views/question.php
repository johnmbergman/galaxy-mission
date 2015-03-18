<div align="center"><img src="res/spaceWindowImg.jpg" id="spaceWindow" height="1200" style="padding-top: 100px position: fixed"> </div> 

<!--creates form to display math problem and allow user to enter answer and press enter -->
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div id="div1">
  	  <div id="div3"> ? </div>
    </div>
    <form name="Question" method="get" autocomplete="off" id="qForm">
	  <div id="div2">
      </div>
  	  <label class="control-label" id="labelAnswer" for="inputLarge">Type you answer below and then press the enter key.</label><br>
  	  <input class=".formcontrol" name="number" id="Answer" type="text" size="10" autofocus onfocus="js/question.js/startFunction()">
      <input type="submit" onclick="js/question.js/submitFunction()" style="position: absolute; left: -9999px; width: 1px; height: 1px;"/>
    </form>
  </div>
</div>