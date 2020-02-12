<?php
include '../config.php';
  $notifs = $con->query("
    SELECT COUNT(id) AS c FROM violations 
    WHERE student = {$_SESSION['id']} AND status = 'issued'
  ")->fetch_assoc();
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <span class="brand-text font-weight-light small">Course Policy Violation Portfolio</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../AdminLTE/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?=$_SESSION['name']?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="your_violations.php" class="nav-link">
            <i class="fa fa-times-circle nav-icon"></i>
            <p>Your Violations</p>
            <?php if($notifs['c'] > 0) {?>
              <span class="right badge badge-danger"><?=$notifs['c']?></span>
            <?php } ?>
          </a>
        </li>
        <li class="nav-item">
          <a href="policy_list.php" class="nav-link">
            <i class="fa fa-book nav-icon"></i>
            <p>Policy List</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>