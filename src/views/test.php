<?php

$passed = 0;
function Pass()
{
  global $passed;
  //echo "<td><p class='text-success'><strong>PASSED</strong></p></td>";
  echo "<td><span class='label label-success'>PASSED</span></td>";
  ++$passed;
}

$failed = 0;
function Fail()
{
  global $failed;
  //echo "<td><p class='text-danger'><strong>FAILED!</strong></p></td>";
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
      PrintTestCase("ProfileModel", "ValidName()", "Test empty strings");
      $model->firstname = "";
      $model->lastname = "";
      $model->ValidName() ? Fail() : Pass();
        
      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidName()", "First name blank, Last name exists");
      $model->firstname = "";
      $model->lastname = "Doe";
      $model->ValidName() ? Fail() : Pass();
    
      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidName()", "First name exists, Last name blank");
      $model->firstname = "John";
      $model->lastname = "";
      $model->ValidName() ? Fail() : Pass();


      // ValidPhone()
      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidPhone()", "Good phone 1: 1112223333");
      $model->phone = "1112223333";
      $model->ValidPhone() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidPhone()", "Good phone 2: 111-222-3333");
      $model->phone = "111-222-3333";
      $model->ValidPhone() ? Pass() : Fail();
        
      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidPhone()", "Good phone 3: (111) 222-3333");
      $model->phone = "(111) 222-3333";
      $model->ValidPhone() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidPhone()", "Good phone 4: (unspecified)");
      $model->phone = "";
      $model->ValidPhone() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidPhone()", "Phone with letters: 111222asdf");
      $model->phone = "111222asdf";
      $model->ValidPhone() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidPhone()", "Bad Format: 111-222-333");
      $model->phone = "111-222-333";
      $model->ValidPhone() ? Fail() : Pass();


      // ValidType()
      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidType()", "Type parent");
      $model->type = "parent";
      $model->ValidType() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidType()", "Type teacher");
      $model->type = "teacher";
      $model->ValidType() ? Pass() : Fail();
    
      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidType()", "Type student");
      $model->type = "student";
      $model->ValidType() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("ProfileModel", "ValidType()", "Empty String");
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
      PrintTestCase("ProfileModel", "ValidSchoolName()", "Empty string");
      $model->schoolname = "";
      $model->ValidSchoolName() ? Pass() : Fail();

    

      // LoginModel Unit Tests //
      require "models/login-model.php";
      $model = new LoginModel();

      // ValidEmail()
      PrintTestCaseBreak();
      PrintTestCase("LoginModel", "ValidEmail()", "Good email");
      $model->email = "test@gmail.com";
      $model->ValidEmail() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("LoginModel", "ValidEmail()", "Empty string");
      $model->email = "";
      $model->ValidEmail() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("LoginModel", "ValidEmail()", "Bad format");
      $model->email = "noemail";
      $model->ValidEmail() ? Fail() : Pass();


      // RegistrationModel Unit Tests //
      require "models/registration-model.php";
      $model = new RegistrationModel();

      // ValidType()
      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidType()", "Type parent");
      $model->type = "parent";
      $model->ValidType() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidType()", "Type teacher");
      $model->type = "teacher";
      $model->ValidType() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidType()", "Type student");
      $model->type = "student";
      $model->ValidType() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidType()", "Empty String");
      $model->type = "";
      $model->ValidType() ? Fail() : Pass();
      

      // ValidName()
      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidName()", "'John','Doe'");
      $model->firstname = "John";
      $model->lastname = "Doe";
      $model->ValidName() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidName()", "Test empty strings");
      $model->firstname = "";
      $model->lastname = "";
      $model->ValidName() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidName()", "First name blank, Last name exists");
      $model->firstname = "";
      $model->lastname = "Doe";
      $model->ValidName() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidName()", "First name exists, Last name blank");
      $model->firstname = "John";
      $model->lastname = "";
      $model->ValidName() ? Fail() : Pass();


      // ValidEmail()
      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidEmail()", "Good email");
      $model->email = "test@gmail.com";
      $model->ValidEmail() ? Pass() : Fail();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidEmail()", "Empty string");
      $model->email = "";
      $model->ValidEmail() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidEmail()", "Bad format");
      $model->email = "noemail";
      $model->ValidEmail() ? Fail() : Pass();


      // ValidPasswordLength()
      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidPasswordLength()", "Good length (greater than 6)");
      $model->password = "password";
      $model->ValidPasswordLength() ? Pass() : Fail();
      
      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidPasswordLength()", "Empty string");
      $model->password = "";
      $model->ValidPasswordLength() ? Fail() : Pass();
      
      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidPasswordLength()", "Bad length (length of 3)");
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
      $model->password = "123";
      $model->ValidPassword() ? Fail() : Pass();

      PrintTestCaseBreak();
      PrintTestCase("RegistrationModel", "ValidPassword()", "Only second password specified");
      $model->password = "123";
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