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
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Students
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="student_register.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Register Student</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="student_list.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Student List</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Faculty
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="faculty_register.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Register Faculty Member</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="faculty_list.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Faculty List</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Policies
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="policy_add.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add New Policy</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="policy_list.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Policies List</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
              Reports
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="reports.php?type=Issued" class="nav-link" target="_blank">
                <i class="far fa-circle nav-icon"></i>
                <p>Issued Violations</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="reports.php?type=Addressed" class="nav-link" target="_blank">
                <i class="far fa-circle nav-icon"></i>
                <p>Addressed Violations</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>