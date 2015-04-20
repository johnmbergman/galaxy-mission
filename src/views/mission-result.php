<!--
view: /mission-result/
auth: John Bergman
date: 2015-04-20
-->
<div class="row">
  <div class="col-lg-10">
    <h1>Mission Results <small>for <?php echo $_SESSION["current_student_name"]; ?></small></h1>
  </div>
  <div class="col-lg-2">
    <a href="/student-dashboard/" class="btn btn-lg btn-link">Return to Dashboard</a>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h1 class="panel-title">Space Cadet <?php echo ($_SESSION["current_student_name"]); ?></h1>
      </div>
      <div class="panel-body">
        <ul class="list-group">
          <?php
          $model = $_SESSION["current_mission"];
            foreach($model->questions as $question)
            {
              echo "<li class='list-group-item'>";
              echo "<div class='row'><p class='lead'>" . $question->text . "</p></div>";
              echo "<div class='row'>";
              echo "<div class='col-lg-4'>You answered: " . $question->student_answer . "</div>";
              echo "<div class='col-lg-4'>Correct answer: " . $question->answer . "</div>";
              echo "<div class='col-lg-4'><span class='label label-" . ($question->student_answer == $question->answer ? "success'>Correct!" : "danger'>Incorrect") . "</span></div>";
              echo "</div>";
              echo "</li>";
            }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>