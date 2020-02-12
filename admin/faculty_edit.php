<?php 
include '../include/header.php';
include '../include/sidebar.php';
include '../config.php';

$id = $_GET['id'];

$faculty = $con->query("SELECT * FROM faculty WHERE id = $id")->fetch_assoc();

if ($_POST) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];
  $department = $_POST['dept'];
  $password = $_POST['password'];

  $password_query = ($password == ""? "" : ", password = '".md5($password)."'");

  $result = $con->query("
    UPDATE faculty SET 
      name = '$name',
      email = '$email',
      address = '$address',
      contact = '$contact',
      department = '$department'
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
          <h1 class="m-0 text-dark">Edit Faculty</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Faculty</li>
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
              Faculty Member Info
            </h5>
          </div>
          <div class="card-body">
            <div class="row form-group">
              <div class="col-sm-6">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter full name" required value="<?=$faculty['name']?>">
              </div>
              <div class="col-sm-6">
                <label>Email</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                  <input type="email" name="email" class="form-control" placeholder="Enter Email" required value="<?=$faculty['email']?>">
                </div>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-9">
                <label>Address</label>
                <input type="text" name="address" class="form-control" placeholder="Enter address" required value="<?=$faculty['address']?>">
              </div>
              <div class="col-sm-3">
                <label>Contact No.</label>
                <input type="number" name="contact" class="form-control" placeholder="Enter contact no." required value="<?=$faculty['contact']?>">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-12">
                <label>Department</label>
                <select class="form-control" name="dept" required>
                  <option selected value="<?=$faculty['department']?>"><?=$faculty['department']?></option>
                  <option value="Accounting">Accounting</option>
                  <option value="Computer Engineering">Computer Engineering</option>
                  <option value="Criminology">Criminology</option>
                  <option value="Economics and Finance">Economics and Finance</option>
                  <option value="Education">Education</option>
                  <option value="History and Social Sciences">History and Social Sciences</option>
                  <option value="Hotel and Restaurant Management">Hotel and Restaurant Management</option>
                  <option value="Information Technology">Information Technology</option>
                  <option value="Languages">Languages</option>
                  <option value="Management and Marketing">Management and Marketing</option>
                  <option value="Mathematics">Mathematics</option>
                  <option value="Natural Sciences">Natural Sciences</option>
                  <option value="Tourism Management">Tourism Management</option>
                  <option value="Nursing, Academic Coordinator">Nursing, Academic Coordinator</option>
                  <option value="Nursing, Clinical Coordinator">Nursing, Clinical Coordinator</option>
                  <option value="Student Coordinator">Student Coordinator</option>
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
                <label>Faculty Number</label>
                <div class="input-group">
                  <input type="text" class="form-control" value="<?=$faculty['faculty_no']?>" disabled>
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

