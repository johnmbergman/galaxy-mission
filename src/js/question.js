// src/js/question.js
//Question Form's Javascript
//Description: Javascript with functions for the src/views/question.php html code
//Date: 3/17/2015
//Author: Jennifer Steadman
//

//Functions for Question Form
//Right now set up to display a string already set here
//When complete the string will be sent from the server from the database
var newQuestions = " 1 - 2 - ? - 4 - 5 ";
var myNewElement = document.createElement("p");
var myText = document.createTextNode(newQuestions);
myNewElement.appendChild(myText);
document.getElementById("div1").appendChild(myNewElement);

  
//Function is called when you input an answer and press enter on the question page
//shows the number you submitted once you enter the answer then press enter button
//When complete this answer will be sent to the server to input into database
function submitFunction()
{
  var x = document.Question.number.value;	  
  document.getElementById("div2").innerHTML = "The number you entered was: " + x;
  console.log("You Entered: " + x);	
}
