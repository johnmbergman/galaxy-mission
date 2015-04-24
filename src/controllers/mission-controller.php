<?php
/*
  John Bergman
  Updated: April 10, 2015
  MissionController class for managing a student mission.
*/
require_once "../models/mission-model.php";
require_once "data.php";

class MissionController
{
  private $model;

  // Constructor
  public function __construct($model)
  {
    $this->model = $model;
  }

  public function GenerateQuestion($qlevel)
  {
    $question = new Question();
    //$question->type_id = $this->model->type_id;

    // For now, we just have a dummy queston
    switch ($this->model->type_id)
    {
      case "1":   // Counting images [0-10]
        $question->answer = rand(1, 10);
        $question->text = "How many planets do you see?<br/>";
        $planets_drawn = 0;
        while($planets_drawn < $question->answer)
        {
          $question->text .= "<img src='../res/earth-dark.png' alt='earth'>";
          $planets_drawn++;
        }
        break;


      case "2":   // Counting numbers 1-10 and sequence counting by 2s, 5s and 10s
      	$questionType = rand (1, 4);
      	switch ($questionType){
      	
      		case "1":
        		$question->answer = rand(3, 20);
        		$question->text = "Enter the number that comes next: " . ($question->answer - 3) . " " . ($question->answer - 2) . " " . ($question->answer-1) . " _";
        		break;

			case "2":
				$question->answer = rand(3, 20) * 2;
        		$question->text = "Enter the number that comes next in the sequence: " . ($question->answer - 6) . " " . ($question->answer - 4) . " " . ($question->answer - 2) . " _";
        		break;
        		
        	case "3":
        		$question->answer = rand(3, 20) * 5;
        		$question->text = "Enter the number that comes next in the sequence: " . ($question->answer - 15) . " " . ($question->answer - 10) . " " . ($question->answer - 5) . " _";
        		break;
        		
        	case "4":
        		$question->answer = rand(3, 10) * 10;
        		$question->text = "Enter the number that comes next in the sequence: " . ($question->answer - 30) . " " . ($question->answer - 20) . " " . ($question->answer - 10) . " _";
        		break;
        	}
        break;
				

      case "3":   // Missing numbers (sequence) [0-20] and in step counting 2-20, 5-100 and 10-100
      	$questionType = rand(1, 4);
      	switch ($questionType){
      		case "1":
        		$question->answer = rand(3, 17);
        		$answerPosition = rand(1,3);
        		switch ($answerPosition){
        			case "1":
        				$question->text = "Enter the missing number: ";
        				$question->text .= ($question->answer - 1)." ";
        				$question->text = "_ ";
        				$question->text .= ($question->answer + 1)." ";
        				$question->text .= ($question->answer + 2)." ";
        				$question->text .= ($question->answer + 3)." ";
        				break;
        				
        			case "2":
		        		$question->text = "Enter the missing number: ";
        				$question->text .= ($question->answer - 2)." ";
        				$question->text .= ($question->answer - 1)." ";
        				$question->text = "_ ";
        				$question->text .= ($question->answer + 1)." ";
        				$question->text .= ($question->answer + 2)." ";
        				break;
        				
        			case "3":
        				$question->text = "Enter the missing number: ";
        				$question->text .= ($question->answer - 3)." ";
        				$question->text .= ($question->answer - 2)." ";
        				$question->text .= ($question->answer - 1)." ";
        				$question->text = "_ ";
        				$question->text .= ($question->answer + 1)." ";
        				break;
        			}
        		break;
        		
        	case "2":
        		$question->answer = rand(3, 17) *2 ;
        		$answerPosition = rand(1,3);
        		switch ($answerPosition){
        			case "1":
        				$question->text = "Enter the missing number: ";
        				$question->text .= ($question->answer - 2)." ";
        				$question->text = "_ ";
        				$question->text .= ($question->answer + 2)." ";
        				$question->text .= ($question->answer + 4)." ";
        				$question->text .= ($question->answer + 6)." ";
        				break;
        				
        			case "2":
		        		$question->text = "Enter the missing number: ";
        				$question->text .= ($question->answer - 4)." ";
        				$question->text .= ($question->answer - 2)." ";
        				$question->text = "_ ";
        				$question->text .= ($question->answer + 2)." ";
        				$question->text .= ($question->answer + 4)." ";
        				break;
        				
        			case "3":
        				$question->text = "Enter the missing number: ";
        				$question->text .= ($question->answer - 6)." ";
        				$question->text .= ($question->answer - 4)." ";
        				$question->text .= ($question->answer - 2)." ";
        				$question->text = "_ ";
        				$question->text .= ($question->answer + 2)." ";
        				break;
        			}
        		break;
        	
        	case "3":
        		$question->answer = rand(3, 17) * 5 ;
        		$answerPosition = rand(1,3);
        		switch ($answerPosition){
        			case "1":
        				$question->text = "Enter the missing number: ";
        				$question->text .= ($question->answer - 5)." ";
        				$question->text = "_ ";
        				$question->text .= ($question->answer + 5)." ";
        				$question->text .= ($question->answer + 10)." ";
        				$question->text .= ($question->answer + 15)." ";
        				break;
        				
        			case "2":
		        		$question->text = "Enter the missing number: ";
        				$question->text .= ($question->answer - 10)." ";
        				$question->text .= ($question->answer - 5)." ";
        				$question->text = "_ ";
        				$question->text .= ($question->answer + 5)." ";
        				$question->text .= ($question->answer + 10)." ";
        				break;
        				
        			case "3":
        				$question->text = "Enter the missing number: ";
        				$question->text .= ($question->answer - 15)." ";
        				$question->text .= ($question->answer - 10)." ";
        				$question->text .= ($question->answer - 5)." ";
        				$question->text = "_ ";
        				$question->text .= ($question->answer + 5)." ";
        				break;
        			}
        		break;
        	
        	case "4":
        		$question->answer = rand(3, 7) * 10 ;
        		$answerPosition = rand(1,3);
        		switch ($answerPosition){
        			case "1":
        				$question->text = "Enter the missing number: ";
        				$question->text .= ($question->answer - 10)." ";
        				$question->text = "_ ";
        				$question->text .= ($question->answer + 10)." ";
        				$question->text .= ($question->answer + 20)." ";
        				$question->text .= ($question->answer + 30)." ";
        				break;
        				
        			case "2":
		        		$question->text = "Enter the missing number: ";
        				$question->text .= ($question->answer - 20)." ";
        				$question->text .= ($question->answer - 10)." ";
        				$question->text = "_ ";
        				$question->text .= ($question->answer + 10)." ";
        				$question->text .= ($question->answer + 20)." ";
        				break;
        				
        			case "3":
        				$question->text = "Enter the missing number: ";
        				$question->text .= ($question->answer - 30)." ";
        				$question->text .= ($question->answer - 20)." ";
        				$question->text .= ($question->answer - 10)." ";
        				$question->text = "_ ";
        				$question->text .= ($question->answer + 10)." ";
        				break;
        			}
        		break;
        		}	
        	break;

      case "4":	  // addition 1-5
      case "7":  // addition 1-20
      	$firstDigit = rand(0, ($this->model->type_id == "10" ? 5 : 20));
      	$secondDigit = rand(0, ($this->model->type_id == "10" ? 5 : 20));
      	$question->answer = $firstDigit + $secondDigit;
      	$question->text = "What does " . ($firstDigit) . " + " . ($secondDigit) . " equal?";
      	break; 
      	
      case "5":   // subtraction 1-10
      case "8":   // subtraction 1-20
      	$firstDigit = rand(0, ($this->model->type_id == "11" ? 10 : 20));
      	$secondDigit = rand(0, ($this->model->type_id == "11" ? 10 : 20));
      	if ($firstDigit > $secondDigit)
      	{
      		$question->answer = $firstDigit - $secondDigit;
      		$question->text = "What does " . ($firstDigit) . " - " . ($secondDigit) . " equal?";
      	}
      	else
      	{
      		$question->answer =  $secondDigit - $firstDigit;
      		$question->text = "What does " . ($secondDigit) . " - " . ($firstDigit) . " equal?";
      	}
      	break; 	 

	  case "6":  // inequalities
	  	$questionType = rand(1, 2);
      	switch ($questionType){
      	
      		case "1": 	  // comparing counting images
      			$difference = rand(1, 4);
      			$image1Count = rand(1, 10);
      			if ($image1Count < 5)
      			{
      				$image2Count = $image1Count + $difference;
      				$question->answer = 2;
      			}
      			else
      			{
      				$image2Count = $image1Count - $difference;
      				$question->answer = 1;
      			}
      		      	
      				$question->text = "Enter 1 if there are more of the first planet and 2 if there are more of the second planet:</br>";
      				$planets_drawn = 0;
        		while($planets_drawn < $image1Count)
        		{
        		  $question->text .= "<img src='../res/earth-dark.png' alt='earth'>";
        		  $planets_drawn++;
        		}
        		$planets_drawn = 0;
        		while($planets_drawn < $image2Count)
        		{
        		  $question->text .= "<img src='../res/mars.png' alt='mars'>";
        		  $planets_drawn++;
        		}
        		break;
        		
        	case "2":	// fill in the symbol inequality
	  			$value1 = rand(1, 10);
      			$value2 = rand(1, 10);
     		 	if ($value1 > $value2)
      				$question->answer = 1;
      			else if ($value1 < $value2)
      				$question->answer = 2;
      			else $question->answer = 3;
     	 			$question->text = "Enter the number for the symbol that completes the statement: " . ($value1) . " _ " . ($value2) . "?<br/> 1. >, 2. <, or 3. =";
     		 	break;
     		 }
     		break;
     		 	
     case "9": // add or subtract with 3 whole numbers whose sum is less than or equal to 20
    	$firstNumber = rand(1, 18);
     	$secondNumber = rand(1, (19 - $firstNumber));
     	$thirdNumber = rand(1, (20 - $firstNumber - $secondNumber));
     	$questionFormat = rand(1, 2);
     	if ($questionFormat == 1)
     	{
     		$question->answer = $firstNumber + $secondNumber + $thirdNumber;
     		$question->text = . ($firstNumber) . " + " . ($secondNumber) . " + " . ($thirdNumber) . " =";
     	}
     	else if ($firstNumber > ($secondNumber && $thirdNumber))
     	{
     		$question->answer = $firstNumber - $secondNumber - $thirdNumber;
     		$question->text = . ($firstNumber) . " - " . ($secondNumber) . " - " . ($thirdNumber) . " =?";
     	}
     	else if ($secondNumber > ($firstNumber && $thirdNumber))
     	{
     		$question->answer = $secondNumber - $thirdNumber - $firstNumber;
     		$question->text = . ($secondNumber) . " - " . ($thirdNumber) . " - " . ($firstNumber) . " =?";
     	}
     	else
     	{
     		$question->answer = $thirdNumber - $firstNumber - $secondNumber;
     		$question->text = . ($thirdNumber) . " - " . ($firstNumber) . " - " . ($secondNumber) . " =?";
     	}
     	break;
     		
    case "10":	// algebraic addition
	  	$question_form = rand(1, 2);
	  	$firstDigit = rand(0, 10);
	  	$question->answer = rand(0, 10);
      	if ($question_form == 1)
      	{
      		$question->text = "Enter the number that completes the problem: " . ($firstDigit) . " + _ = " . ($firstDigit + $question->answer) . "";
      	}
      	else
      	{
      		$question->text = "Enter the number that completes the problem: _ + " . ($firstDigit) . " = " . ($firstDigit + $question->answer) . "";	
      	}
      	break;
      
    case "11":	// algebraic subtraction    
      	$question_form = rand(1, 2);
	  	$firstDigit = rand(0, 20);
      	$secondDigit = rand(0, 20);
      	if ($firstDigit > $secondDigit)
      	{
      		if ($question_form == 1)
      		{
      			$question->answer=$secondDigit;
      			$question->text = "Enter the number that completes the problem: " . ($firstDigit) . " - _ = " . ($firstDigit - $secondDigit) . "";
      		}
      		else
      		{
      			$question->answer=$firstDigit;
      			$question->text = "Enter the number that completes the problem: _ - " . ($secondDigit) . " = " . ($firstDigit - $secondDigit) . "";	
      		}
      	}
      	else
      	{
      		if ($question_form == 2)
      		{
      			$question->answer=$firstDigit;
      			$question->text = "Enter the number that completes the problem: " . ($secondDigit) . " - _ = " . ($secondDigit - $firstDigit) . "";
      		}
      		else
      		{
      			$question->answer=$secondDigit;
      			$question->text = "Enter the number that completes the problem: _ - " . ($firstDigit) . " = " . ($secondDigit - $firstDigit) . "";	
      		}
      	}
      	
      	break;	
      
    case "12":	// even or odd
    	$number = rand(1, 10);
    	if ($number == 1 || 3 || 5 || 7 || 9)
    		$question->answer = 2;
    	else $question->answer = 1;    		
        $question->text = "Are there an even or odd number of planets? Enter 1 for even or 2 for odd.<br/>";
        $planets_drawn = 0;
        while($planets_drawn < $question->answer)
        {
          $question->text .= "<img src='../res/earth-dark.png' alt='earth'>";
          $planets_drawn++;
        }
        break;
        
    case "13":   // Counting numbers 100-1000 and sequence counting by 2s, 5s and 10s
      	$questionType = rand (1, 4);
      	switch ($questionType){
      		case "1":
        		$question->answer = rand(100, 1000);
        		$question->text = "Enter the number that comes next: " . ($question->answer - 3) . " " . ($question->answer - 2) . " " . ($question->answer-1) . " _";
        		break;

			case "2":
				$question->answer = (rand(1, 10) * 5) + (rand(1, 9) * 100);
        		$question->text = "Enter the number that comes next in the sequence: " . ($question->answer - 15) . " " . ($question->answer - 10) . " " . ($question->answer - 5) . " _";
        		break;
        		
        	case "3":
        		$question->answer = (rand(1, 10) * 10) + (rand(1, 9) * 100);
        		$question->text = "Enter the number that comes next in the sequence: " . ($question->answer - 30) . " " . ($question->answer - 20) . " " . ($question->answer - 10) . " _";
        		break;
        		
        	case "4":
        		$question->answer = (rand(3, 10) * 100);
        		$question->text = "Enter the number that comes next in the sequence: " . ($question->answer - 300) . " " . ($question->answer - 200) . " " . ($question->answer - 100) . " _";
        		break;
        	}
        break;
        
    case "14":  // fill in the symbol inequality
	  	$value1 = rand(3, 10);
      	$value2 = rand(1, 10);
      	$value3 = rand(1, ($value1 - 1));
      	$value4 = rand(1, ($value1 - $value3));
     	if ($value1 > $value2)
      		$question->answer = 1;
      	else if ($value1 < $value2)
      		$question->answer = 2;
      	else $question->answer = 3;
     	 	$question->text = "Enter the number for the symbol that completes the statement: " . ($value3) . " + " . ($value4) . " _ " . ($value2) . "?<br/> 1. >, 2. <, or 3. =";
     	break;
     	
     case "15":	// adding by 10s and 100s
     	$firstDigit = rand(100, 900);
     	$format = rand(1, 2);
     	switch($format){
     		case "1":
      			$secondDigit = rand(1, 9) * 10;
      			$question->answer = $firstDigit + $secondDigit;
      			$question->text = "What does " . ($firstDigit) . " + " . ($secondDigit) . " equal?";
      			break;
     		 	
     		case "2":
     			$secondDigit = rand(100, (1000 - $firstDigit));
     			$question->answer = $firstDigit + $secondDigit;
      			$question->text = "What does " . ($firstDigit) . " + " . ($secondDigit) . " equal?";
      			break;
    		}
    	break;
    	
	case "16":	// multiply within 100
		$firstNumber = rand(1, 20);
		if ($firstNumber <= 10)
			$secondNumber = rand(1, 10);
		else
			$secondNumber = rand(1, 5);
		$question->answer = $firstNumber * $secondNumber;
		$question->text =  . ($firstNumber) . " x " . ($secondNumber) . " =";
		break;
		
	case "17":	// divide within 100
		$firstNumber = rand(1, 20);
		if ($firstNumber <= 10)
			$secondNumber = rand(1, 10);
		else
			$secondNumber = rand(1, 5);
		$question->answer = $secondNumber;
		$dividend = $firstNumber * $secondNumber;
		$question->text =  . ($dividend) . " &divide " . ($firstNumber) . " = ";
		break;
		
	case "18":  //  algebraic multiplication
		$question_form = rand(1, 2);
	  	$firstNumber = rand(1, 20);
		if ($firstNumber <= 10)
			$secondNumber = rand(1, 10);
		else
			$secondNumber = rand(1, 5);
		$product = $firstNumber * $secondNumber;
		$question->answer = $secondNumber;
      	if ($question_form == 1)
      	{
      		$question->text = "Enter the number that completes the problem: " . ($firstNumber) . " x _ = " . ($product);
      	}
      	else
      	{
      		$question->text = "Enter the number that completes the problem: _ x " . ($firstNumber) . " = " . ($product);	
      	}
      	break;
      	
    case "19":	// algebraic division
    	$firstNumber = rand(1, 20);
		if ($firstNumber <= 10)
			$secondNumber = rand(1, 10);
		else
			$secondNumber = rand(1, 5);
		$dividend = $firstNumber * $secondNumber;
		$question->answer = $firstNumber;
		$question->text = "Enter the number that completes the problem: " . ($dividend) . " &divide _ = " . ($secondNumber);
		break;
		
    default:
        $question->answer = "1";
        $question->text = "This question type (" . $this->model->type_id . ") has not been implemented! (Answer 1)";
        break;
    
	}
    // Set the current question to the generated question
    return $question;
  }


  // Compare the student's response to the actual answer to see if the student is correct
  public function CheckAnswer($student_answer)
  {
    $this->model->current_question->student_answer = $student_answer;
    $this->model->current_question->finish_time = new DateTime();
    $this->model->questions[$this->model->question_no - 1] = $this->model->current_question;
    return  ($this->model->current_question->answer == $student_answer);
  }


  // Submit the mission data to the database
  public function SubmitMission()
  {
    $this->model->finish_time = new DateTime();
    
    // Attempt to connect to the database
    $conn = new mysqli(DB::DBSERVER, DB::DBUSER, DB::DBPASS, DB::DBNAME);
    if($conn->connect_error)
    {
      trigger_error("Database connection failed: " . $conn->connect_error, E_USER_ERROR);
      return false;
    }

    // Turn off autocommits (we only want this to commit if we explicitely commit it)
    $conn->autocommit(FALSE);

    // Count the number of correct answers
    $num_correct = 0;
    foreach($this->model->questions as $question)
    {
      if($question->answer == $question->student_answer)
      {
        $num_correct++;
      }
    }

    // Insert the mission record
    $conn->query("insert into student_mission_record (question_type_id,student_id,number_correct,start_datetime,finish_datetime) values (" . $this->model->type_id . "," . $_SESSION["current_student_id"] . "," . $num_correct . ",'" . $this->model->start_time->format("Y-m-d H:i:s") . "','" . $this->model->finish_time->format("Y-m-d H:i:s") . "')");
    $mission_record_id = $conn->insert_id;

    // Insert each question record
    foreach($this->model->questions as $question)
    {
      $conn->query("insert into student_question_results (mission_record_id, question_type_id, start_time, finish_time, student_answer, correct_answer) values (" . $mission_record_id . "," . $this->model->type_id . ",'" . $question->start_time->format("Y-m-d H:i:s") . "','" . $question->start_time->format("Y-m-d H:i:s") . "'," . $question->student_answer . "," . $question->answer . ")");
    }

    // Try to commit the queries
    $returnflag = $conn->commit();
    $conn->close();
    return $returnflag;
  }
}
?>