<?php 
include '../include/header.php';
include '../include/sidebar.php';
include '../config.php';

$id = $_GET['id'];

$student = $con->query("SELECT * FROM students WHERE id = $id")->fetch_assoc();

if ($_POST) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];
  $course = $_POST['course'];
  $password = $_POST['password'];

  $password_query = ($password == ""? "" : ", password = '".md5($password)."'");

  $result = $con->query("
    UPDATE students SET 
      name = '$name',
      email = '$email',
      address = '$address',
      contact = '$contact',
      course = '$course'
      $password_query
      WHERE id = $id
  ");
  if ($result) {
    ?>
     <script> success("<?=$name?>'s info has been edited.", '') </script>
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
          <h1 class="m-0 text-dark">Edit Student</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Student</li>
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
                <input type="text" name="name" class="form-control" placeholder="Enter full name" required value="<?=$student['name']?>">
              </div>
              <div class="col-sm-6">
                <label>Email</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                  <input type="email" name="email" class="form-control" placeholder="Enter Email" required value="<?=$student['email']?>">
                </div>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-9">
                <label>Address</label>
                <input type="text" name="address" class="form-control" placeholder="Enter address" required value="<?=$student['address']?>">
              </div>
              <div class="col-sm-3">
                <label>Contact No.</label>
                <input type="number" name="contact" class="form-control" placeholder="Enter contact no." required value="<?=$student['contact']?>">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-12">
                <label>Course</label>
                <select class="form-control" name="course" required>
                  <option selected value="<?=$student['course']?>"><?=$student['course']?></option>
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
                  <input type="text" name="password" class="form-control password" readonly>
                </div>
              </div>
              <div class="col-sm-6">
                <label>Student Number</label>
                <div class="input-group">
                  <input type="text" class="form-control" value="<?=$student['student_no']?>" disabled>
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

function genpass() {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   var charactersLength = characters.length;
   for ( var i = 0; i < 5; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}
</script>
<?php include '../include/footer.php'; ?>  

