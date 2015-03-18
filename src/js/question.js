<script type = "text/javascript">

//overided background from css
function startFunction()
{
document.body.style.background = "#9f948e";


//creates p node 
//creates text node
//places text into child node
//gets elment id=div1 and places text into p
	var newQuestions = " 3 + 4 = ";
 	var myNewElement = document.createElement("p");
 	var myText = document.createTextNode(newQuestions);
 	myNewElement.appendChild(myText);
 	document.getElementById("div1").appendChild(myNewElement);
 	
 //access to div2 element to change styles	
 	myNewElement.style.backgroundColor = "black";
 	myNewElement.style.paddingRight = "20px";
 	myNewElement.style.paddingLeft = "20px";
 	myNewElement.style.border = "5px solid white";
 	myNewElement.style.color = "red";
 	myNewElement.style.fontSize = "150px";
 	myNewElement.style.position = "fixed";
 	myNewElement.style.left = "700px";
 	myNewElement.style.top = "500px";
 	
 //access to div3 element to change styles	
 	var myElement2 = document.getElementById("div3");
 	myElement2.style.backgroundColor = "black";
 	myElement2.style.paddingRight = "20px";
 	myElement2.style.paddingLeft = "20px";
 	myElement2.style.border = "5px solid white";
 	myElement2.style.color = "red";
 	myElement2.style.fontSize = "150px";
 	myElement2.style.position = "fixed";
    myElement2.style.left = "1300px";
 	myElement2.style.top = "500px";
 	
 
 //access to document object FORM with name = Question to change styles
    var que = document.Question;
    que.style.color = "white";
    que.style.fontSize = "40px";
    que.style.position = "fixed";
    que.style.left = "700px";
    que.style.top = "750px";
    que.style.backgroundColor = "black";
    que.style.border = "5px solid white";
    que.style.paddingRight = "20px";
    que.style.paddingLeft = "20px";
    que.style.paddingBottom = "10px";
    
 //access to document form input box to make text in box black   
    var queInput = document.Question.number;
    queInput.style.color = "black";
    
  } 
 //shows the number you submitted later this will send the number to server instead
    function submitFunction()
    {
	  var x = document.Question.number.value;
	  document.getElementById("div2").innerHTML = "The number you entered was: " + x;	
    }

</script>
