<?php 
include '../include/header.php';
include '../include/faculty_sidebar.php';
include '../config.php';

$id = $_SESSION['id'];

if ($_POST) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];
  $password = $_POST['password'];

  $password_query = ($password == ""? "" : ", password = '".md5($password)."'");

  $result = $con->query("
    UPDATE faculty SET 
      name = '$name',
      email = '$email',
      address = '$address',
      contact = '$contact'
      $password_query
      WHERE id = $id
  ");

  
  if ($result) {
    ?>
     <script> success("Your profile has been updated.", '') </script>
    <?php 
  } else {
    ?>
     <script> error("Something went wrong. Try again later.", '') </script>
    <?php
  }
}

$faculty = $con->query("SELECT * FROM faculty WHERE id = $id")->fetch_assoc();

$box = $con->query("
  SELECT 
    (SELECT COUNT(id) FROM violations WHERE MONTH(date) = '".date('m')."' AND faculty = $id) AS mo,
    (SELECT COUNT(id) FROM violations WHERE faculty = $id) AS vio
")->fetch_assoc();

?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="../AdminLTE/dist/img/avatar5.png"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center"><?=$faculty['name']?></h3>

              <p class="text-muted text-center"><?=$faculty['department']?></p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Faculty No.</b> <a class="float-right"><?=$faculty['faculty_no']?></a>
                </li>
                <li class="list-group-item">
                  <b>Apprehensions in <?=date('M')?></b> <a class="float-right"><?=$box['mo']?></a>
                </li>
                <li class="list-group-item">
                  <b>Total Apprehensions</b> <a class="float-right"><?=$box['vio']?></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card card-primary">
            <div class="card-header">
              <h5><i class="fa fa-edit"></i> Edit Your Profile</h5>
            </div>
            <div class="card-body">
              <form method="POST">
                <div class="row form-group">
                  <div class="col-sm-12">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="name" required value="<?=$faculty['name']?>">
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-4">
                    <label>Email</label>
                    <input type="text" class="form-control email" placeholder="Enter email" name="email" required value="<?=$faculty['email']?>">
                  </div>
                  <div class="col-sm-8">
                    <label>Address</label>
                    <input type="text" class="form-control address" placeholder="Enter Address" name="address" required value="<?=$faculty['address']?>">
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-sm-4">
                    <label>Contact Number</label>
                    <input type="number" class="form-control contact" placeholder="Enter mobile number" name="contact" required value="<?=$faculty['contact']?>">
                  </div>
                  <div class="col-sm-6">
                    <label>Password</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <button type="button" class="btn btn-secondary btn-sm gen-pass">Generate Password</button>
                      </div>
                      <input type="text" name="password" class="form-control password" readonly>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary btn-block">
                  Save changes
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
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

