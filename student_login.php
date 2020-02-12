<?php
session_start();
include 'config.php';

if ($_POST) {
  $stud_no = $_POST['stud_no'];
  $pass = $_POST['pass'];

  $result = $con->query("
    SELECT * FROM students WHERE student_no = '$stud_no' AND password = '".md5($pass)."'
  ");

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['student_no'] = $row['student_no'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['type'] = "Student";
    header("location: student/your_violations.php");
  } else {
    ?>
      <script>
        setTimeout( function() {
          error("Student number or password is incorrect.", '')
        }, 500)
      </script>
    <?php
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Course Policy Violation Portfolio</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Pace JS -->
  <link rel="stylesheet" href="AdminLTE/plugins/pace/pace.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="AdminLTE/plugins/sweetalert2/sweetalert2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- SweetAlert2 -->
  <script src="AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Global JS -->
  <script src="assets/js/global.js"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Course Policy </b>Violation Portfolio</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Student Number" name="stud_no">
          <div class="input-group-append">
            <div class="input-group-text">
              <b>#</b>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="AdminLte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Pace JS -->
<script src="AdminLTE/plugins/pace/pace.js"></script>
</body>
</html>
