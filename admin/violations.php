<?php 
include '../include/header.php';
include '../include/sidebar.php';
include '../config.php';

$box = $con->query("
  SELECT 
    (SELECT COUNT(id) FROM faculty) AS fac,
    (SELECT COUNT(id) FROM students) AS stud,
    (SELECT COUNT(id) FROM violations WHERE MONTH(date) = '".date('m')."') AS mo,
    (SELECT COUNT(id) FROM violations) AS vio
")->fetch_assoc();

$violations = $con->query("
  SELECT *, v.id AS vioID FROM violations AS v 
  JOIN faculty AS f
  ON v.faculty = f.id
  JOIN students AS s
  ON v.student = s.id
  JOIN policies AS p
  ON v.policy = p.id
");

function getBadge($status) {
  if ($status == 'Addressed') return "warning";
  elseif ($status == 'Issued') return "primary";
  elseif ($status == 'Denied') return "danger";
  elseif ($status == 'Approved') return "success"; 
}
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Violations</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Violations</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?=$box['fac']?></h3>

              <p>Faculty Members</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?=$box['stud']?></h3>

              <p>Students</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?=$box['mo']?></h3>

              <p>This month's violations</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?=$box['vio']?></h3>

              <p>Total violations</p>
            </div>
            <div class="icon">
              <i class="fa fa-times-circle"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="card card-primary">
        <div class="card-header text-center">
          <h5><i class="fa fa-times-circle"></i> Violations</h5>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-striped table-sm text-center small">
            <thead>
              <th> Student No. </th>
              <th> Name </th>
              <th> Course </th>
              <th> Violation </th>
              <th> Date </th>
              <th> Status </th>
            </thead>
            <tbody>
            	<?php while($row = $violations->fetch_assoc()) { 
                $badge = getBadge($row['status']);
              ?>
	              <tr>
	                <td> <?=$row['student_no']?> </td>
	                <td> <?=$row['name']?> </td>
	                <td> <?=$row['course']?> </td>
	                <td> <?=$row['violation']?> </td>
	                <td> <?=$row['date']?> </td>
	                <td> 
                    <span class="badge badge-<?=$badge?>"><?=$row['status']?></span> 
                  </td>
	              </tr>
	            <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer">
        </div>
      </div>
    </div>
  </div>
</div>
<script>
	$('.table').DataTable({
    lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]]
 	})
</script>
<?php include '../include/footer.php'; ?>  

