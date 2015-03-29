<?php

$passed = 0;
function Pass()
{
  global $passed;
  echo "<td><span class='label label-success'>PASSED</span></td>";
  ++$passed;
}

$failed = 0;
function Fail()
{
  global $failed;
  echo "<td><span class='label label-danger'>FAILED</span></td>";
  ++$failed;
}

function PrintTestCase($mname, $mfunc, $mtest)
{
  echo "<td>$mname</td><td><code>$mfunc</code></td><td>$mtest</td>";
}

function PrintTestCaseBreak()
{
  echo "</tr><tr>";
}

?>

<!-- Unit Test Table -->
<div class="row">
  <div class="col-lg-12">
    <h3>ProfileModel</h3>
    <table class="table table-striped table-hover">
      <thead>
        <th>Class</th>
        <th>Function</th>
        <th>Test Description</th>
        <th>Result</th>
      </thead>
      <tr>

      <?php

      // ProfileModel Unit Tests //
      require "models/profile-model.php";
      $model = new ProfileModel();

      // ValidName()
      PrintTestCase("ProfileModel", "ValidName()", "'John','Doe'");
      $model->firstname = "John";
      $model->lastname = "Doe";
      $model->ValidName() ? Pass() : Fail();
      
      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidName()", "'' (empty string)");
      $model->firstname = "";
      $model->lastname = "";
      $model->ValidName() ? Fail() : Pass();
        
      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidName()", "'', 'Doe' (first name empty string)");
      $model->firstname = "";
      $model->lastname = "Doe";
      $model->ValidName() ? Fail() : Pass();
    
      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidName()", "'John', '' (last name empty string)");
      $model->firstname = "John";
      $model->lastname = "";
      $model->ValidName() ? Fail() : Pass();


      // ValidPhone()
      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidPhone()", "Good phone 1: '1112223333'");
      $model->phone = "1112223333";
      $model->ValidPhone() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidPhone()", "Good phone 2: '111-222-3333'");
      $model->phone = "111-222-3333";
      $model->ValidPhone() ? Pass() : Fail();
        
      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidPhone()", "Good phone 3: '(111) 222-3333'");
      $model->phone = "(111) 222-3333";
      $model->ValidPhone() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidPhone()", "Good phone 4: '' (empty string)");
      $model->phone = "";
      $model->ValidPhone() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidPhone()", "Phone with letters: '111222asdf'");
      $model->phone = "111222asdf";
      $model->ValidPhone() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidPhone()", "Bad Format: '111-222-333'");
      $model->phone = "111-222-333";
      $model->ValidPhone() ? Fail() : Pass();


      // ValidType()
      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidType()", "Type 'parent'");
      $model->type = "parent";
      $model->ValidType() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidType()", "Type 'teacher'");
      $model->type = "teacher";
      $model->ValidType() ? Pass() : Fail();
    
      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidType()", "Type 'student'");
      $model->type = "student";
      $model->ValidType() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidType()", "'' (empty string)");
      $model->type = "";
      $model->ValidType() ? Fail() : Pass();

      // ValidSchoolName()
      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidSchoolName()", "'Example Elementary School'");
      $model->schoolname = "Example Elementary School";
      $model->ValidSchoolName() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidSchoolName()", "Length greater than 50");
      $model->schoolname = "1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890";
      $model->ValidSchoolName() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidSchoolName()", "'' (empty string)");
      $model->schoolname = "";
      $model->ValidSchoolName() ? Pass() : Fail();


      // StudentInfoModel Unit Tests //
      require "models/student-info-model.php";
      $model = new StudentInfoModel();

      // ValidName()
      PrintTestCaseBreak();
      PrintTestCase("StudentInfoModel", "ValidName()", "'Jack','Roosevelt'");
      $model->firstname = "Jack";
      $model->lastname = "Roosevelt";
      $model->ValidName() ? Pass() : Fail();
      
      PrintTestCaseBreak();
      PrintTestCase("StudentInfoModel", "ValidName()", "'' (empty string)");
      $model->firstname = "";
      $model->lastname = "";
      $model->ValidName() ? Fail() : Pass();
        
      PrintTestCaseBreak();
      PrintTestCase("StudentInfoModel", "ValidName()", "'', 'Roosevelt' (first name empty string)");
      $model->firstname = "";
      $model->lastname = "Roosevelt";
      $model->ValidName() ? Fail() : Pass();
    
      PrintTestCaseBreak();
      PrintTestCase("StudentInfoModel", "ValidName()", "'Jack', '' (last name empty string)");
      $model->firstname = "Jack";
      $model->lastname = "";
      $model->ValidName() ? Fail() : Pass();


      // ValidGrade()
      PrintTestCaseBreak();
      PrintTestCase("StudentInfoModel", "ValidGrade()", "Good Grade 1: 'Kindergarten'");
      $model->grade = "Kindergarten";
      $model->ValidGrade() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("StudentInfoModel", "ValidGrade()", "Good Grade 2: '1st Grade'");
      $model->grade = "1st Grade";
      $model->ValidGrade() ? Pass() : Fail();
        
      PrintTestCaseBreak();
      PrintTestCase("StudentInfoModel", "ValidGrade()", "Bad Format: '' (empty string)");
      $model->grade = "";
      $model->ValidGrade() ? Fail() : Pass();

      // ValidSchoolName()
      PrintTestCaseBreak();
      PrintTestCase("StudentInfoModel", "ValidSchoolName()", "'Example Elementary School'");
      $model->schoolname = "Example Elementary School";
      $model->ValidSchoolName() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("StudentInfoModel", "ValidSchoolName()", "Length greater than 50");
      $model->schoolname = "LongestSchoolNameEverByAnIncrediblyWideMarginThereIsNotOneSchoolThatCanCompeteWithItsNameLength";
      $model->ValidSchoolName() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("StudentInfoModel", "ValidSchoolName()", "'' (empty string)");
      $model->schoolname = "";
      $model->ValidSchoolName() ? Pass() : Fail();

      // ValidTeacherName()
      PrintTestCaseBreak();
      PrintTestCase("StudentInfoModel", "ValidTeacherName()", "'Rachel Robinson'");
      $model->teachername = "Rachel Robinson";
      $model->ValidTeacherName() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("StudentInfoModel", "ValidTeacherName()", "Length greater than 30");
      $model->teachername = "HaveYouEverHadATeacherThatHadANameLongerThanThirtyCharactersIfSoWhatWasHerName";
      $model->ValidTeacherName() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("StudentInfoModel", "ValidTeacherName()", "'' (empty string)");
      $model->teachername = "";
      $model->ValidTeacherName() ? Pass() : Fail();


    
      // LoginModel Unit Tests //
      require "models/login-model.php";
      $model = new LoginModel();

      // ValidEmail()
      PrintTestCaseBreak();
      PrintTestCase("LoginModel", "ValidEmail()", "Good email - 'test@example.com'");
      $model->email = "test@gmail.com";
      $model->ValidEmail() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("LoginModel", "ValidEmail()", "'' (empty string)");
      $model->email = "";
      $model->ValidEmail() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("LoginModel", "ValidEmail()", "Bad format - 'noemail'");
      $model->email = "noemail";
      $model->ValidEmail() ? Fail() : Pass();


      // RegistrationModel Unit Tests //
      require "models/registration-model.php";
      $model = new RegistrationModel();

      // ValidType()
      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidType()", "Type 'parent'");
      $model->type = "parent";
      $model->ValidType() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidType()", "Type 'teacher'");
      $model->type = "teacher";
      $model->ValidType() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidType()", "Type 'student'");
      $model->type = "student";
      $model->ValidType() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidType()", "'' (empty string)");
      $model->type = "";
      $model->ValidType() ? Fail() : Pass();
      

      // ValidName()
      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidName()", "'John','Doe'");
      $model->firstname = "John";
      $model->lastname = "Doe";
      $model->ValidName() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidName()", "'', '' (empty strings)");
      $model->firstname = "";
      $model->lastname = "";
      $model->ValidName() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidName()", "'','Doe' (first name empty string)");
      $model->firstname = "";
      $model->lastname = "Doe";
      $model->ValidName() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidName()", "'John', '' (last name empty string)");
      $model->firstname = "John";
      $model->lastname = "";
      $model->ValidName() ? Fail() : Pass();


      // ValidEmail()
      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidEmail()", "Good email - 'test@gmail.com'");
      $model->email = "test@gmail.com";
      $model->ValidEmail() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidEmail()", "'' (empty string)");
      $model->email = "";
      $model->ValidEmail() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidEmail()", "Bad format - 'noemail'");
      $model->email = "noemail";
      $model->ValidEmail() ? Fail() : Pass();


      // ValidPasswordLength()
      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidPasswordLength()", "'password' Good length (at least 6)");
      $model->password = "password";
      $model->ValidPasswordLength() ? Pass() : Fail();
      
      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidPasswordLength()", "'' (empty string)");
      $model->password = "";
      $model->ValidPasswordLength() ? Fail() : Pass();
      
      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidPasswordLength()", "'123' Too short (less than 6)");
      $model->password = "123";
      $model->ValidPasswordLength() ? Fail() : Pass();

      // ValidPassword()
      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidPassword()", "Passwords match");
      $model->password = "password";
      $model->repeatpass = "password";
      $model->ValidPassword() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidPassword()", "Passwords don't match but are specified");
      $model->password = "password";
      $model->repeatpass = "drowssap";
      $model->ValidPassword() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidPassword()", "Only first password specified");
      $model->password = "password";
      $model->repeatpass = "";
      $model->ValidPassword() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidPassword()", "Only second password specified");
      $model->password = "";
      $model->repeatpass = "password";
      $model->ValidPassword() ? Fail() : Pass();


      // StudentCreationModel Unit Tests //
      require "models/student-creation-model.php";
      $model = new StudentCreationModel();
      
      // ValidFirstName()
      PrintTestCaseBreak();
      PrintTestCase("StudentCreationModel", "ValidFirstName()", "'John'");
      $model->firstname = "John";
      $model->ValidFirstName() ? Pass() : Fail();
      
      PrintTestCaseBreak();
      PrintTestCase("StudentCreationModel", "ValidFirstName()", "'' (empty string)");
      $model->firstname = "";
      $model->ValidFirstName() ? Fail() : Pass();
      
      // ValidLastName()
      PrintTestCaseBreak();
      PrintTestCase("StudentCreationModel", "ValidLastName()", "'Doe'");
      $model->lastname = "Doe";
      $model->ValidLastName() ? Pass() : Fail();
      
      PrintTestCaseBreak();
      PrintTestCase("StudentCreationModel", "ValidLastName()", "'' (empty string)");
      $model->lastname = "";
      $model->ValidLastName() ? Fail() : Pass();
      
      // ValidPassword()
      PrintTestCaseBreak();
      PrintTestCase("StudentCreationModel", "ValidPassword()", "6");
      $model->password = 6;
      $model->ValidPassword() ? Pass() : Fail();
      
      PrintTestCaseBreak();
      PrintTestCase("StudentCreationModel", "ValidPassword()", "'' (empty string - passcode image not selected)");
      $model->password = "";
      $model->ValidPassword() ? Fail() : Pass();

	  PrintTestCaseBreak();
      PrintTestCase("StudentCreationModel", "ValidPassword()", "10 (invalid value)");
      $model->password = 10;
      $model->ValidPassword() ? Fail() : Pass();
      ?></tr>
    </table>
  </div>
</div>


<div class="row">
  <div class="col-lg-12">
    <h1>Summary</h1>
    <?php
    if($failed == 0)
    {
      ?><p class="lead text-success">Passed</p><?php
    }
    else
    {
      ?><p class="lead text-danger">Failed</p><?php
    }
    ?>
    <p>Test Ran: <?php echo ($passed + $failed); ?></p>
    <p>Passed: <?php echo $passed; ?></p>
    <p>Failed: <?php echo $failed; ?></p>
  </div>
</div>