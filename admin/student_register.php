<?php 
include '../include/header.php';
include '../include/sidebar.php';
require_once '../config.php';

if ($_POST) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];
  $course = $_POST['course'];
  $stud_no = $_POST['stud-no'];
  $password = $_POST['password'];

  $result = $con->query("
    INSERT INTO students
      (name, email, address, contact, course, password, student_no)
    VALUES
      ('$name', '$email', '$address', '$contact', '$course', '".md5($password)."', '$stud_no') 
  ");
  if ($result) {
    ?>
     <script> success("<?=$name?> has been registered.", '') </script>
    <?php 
  } else {
    ?>
     <script> error("Something went wrong. Try again later.", '') </script>
    <?php
  }
}
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Student Registration</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Student Registration</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <form method="POST">
        <div class="card card-primary">
          <div class="card-header">
            <h5>
              <i class="fa fa-users"></i>
              Student Info
            </h5>
          </div>
          <div class="card-body">
            <div class="row form-group">
              <div class="col-sm-6">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
              </div>
              <div class="col-sm-6">
                <label>Email</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                  <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-9">
                <label>Address</label>
                <input type="text" name="address" class="form-control" placeholder="Enter address" required>
              </div>
              <div class="col-sm-3">
                <label>Contact No.</label>
                <input type="number" name="contact" class="form-control" placeholder="Enter contact no." required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-12">
                <label>Course</label>
                <select class="form-control" name="course" required>
                  <option disabled selected value="">--Select Course--</option>
                  <?php include 'courses.html';?>
                </select>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-6">
                <label>Password</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-secondary btn-sm gen-pass">Generate Password</button>
                  </div>
                  <input type="text" name="password" class="form-control password" readonly required>
                </div>
              </div>
              <div class="col-sm-6">
                <label>Student Number</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-secondary btn-sm gen-no">Generate Student No.</button>
                  </div>
                  <input type="text" name="stud-no" class="form-control stud-no" readonly required>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="btn-group float-right">
              <button class="btn btn-success">Submit</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>

$('.gen-pass').click(function() { $('.password').val(genpass()) })
$('.gen-no').click(function() { $('.stud-no').val(genNo()) })

function genpass() {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   var charactersLength = characters.length;
   for ( var i = 0; i < 5; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

function genNo() {
   var result           = '';
   var yr               = new Date().getFullYear().toString().substr(-2);
   var characters       = '1234567890';
   var charactersLength = characters.length;
   for ( var i = 0; i < 6; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return yr + '-' + result;
}
</script>
<?php include '../include/footer.php'; ?>  

