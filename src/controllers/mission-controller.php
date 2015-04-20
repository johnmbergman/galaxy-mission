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
    switch ($this->model->type_id) {

      case "1":   // Counting images [0-5]
      case "5":   // Counting images [0-10]
        $question->answer = rand(1, ($this->model->type_id == "1" ? 5 : 10));
        $question->text = "How many planets do you see?<br/>";
        $planets_drawn = 0;
        while($planets_drawn < $question->answer)
        {
          $question->text .= "<img src='../res/earth-dark.png' alt='earth'>";
          $planets_drawn++;
        }
        break;


      case "2":   // Counting numbers [0-5]
      case "6":   // Counting numbers [0-10]
        $question->answer = rand(2, ($this->model->type_id == "2" ? 5 : 10));
        $question->text = "Enter the number that comes next: " . ($question->answer - 2) . " " . ($question->answer-1) . " _";
        break;


      case "3":   // Missing number (sequence) [0-5]
      case "7":   // Missing number (sequence) [0-10]
        $question->answer = rand(0, ($this->model->type_id == "3" ? 5 : 10));
        $question->text = "Enter the missing number: ";
        $question->text .= (($question->answer == 0) ? "_" : "0") . " ";
        $question->text .= (($question->answer == 1) ? "_" : "1") . " ";
        $question->text .= (($question->answer == 2) ? "_" : "2") . " ";
        $question->text .= (($question->answer == 3) ? "_" : "3") . " ";
        $question->text .= (($question->answer == 4) ? "_" : "4") . " ";
        $question->text .= (($question->answer == 5) ? "_" : "5") . " ";
        break;

      case "4":   // Skip counting (by 2)
      case "8":   // Skip counting (by 2)
        $question->answer = rand(2, ($this->model->type_id == "4" ? 5 : 10)) * 2;
        $question->text = "Enter the number that comes next in the sequence: " . ($question->answer - 4) . " " . ($question->answer - 2) . " _";
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