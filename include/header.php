<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>CPVP</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../AdminLTE/dist/css/AdminLTE.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!-- Pace JS -->
  <link rel="stylesheet" href="../AdminLTE/plugins/pace/pace.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../AdminLTE/plugins/sweetalert2/sweetalert2.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../AdminLTE/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
  <script src="../AdminLTE/plugins/jquery/jquery.min.js"></script>
  <!-- DataTables -->
  <script src="../AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="../AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Select2 -->
  <script src="../AdminLTE/plugins/select2/js/select2.full.min.js"></script>
  <!-- Global JS -->
  <script src="../assets/js/global.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper"> 
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="../AdminLTE/dist/img/avatar5.png" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><?=$_SESSION['name']?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <li class="user-header bg-primary">
            <img src="../AdminLTE/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">

            <p>
              <?=$_SESSION['name']?> - <?=$_SESSION['type']?>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <?php if ($_SESSION['type'] != "Admin") {?>
              <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
            <?php } ?>
              <a href="../logout.php" class="btn btn-default btn-flat float-right">Sign out</a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->