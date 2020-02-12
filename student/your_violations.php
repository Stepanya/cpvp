<?php 
include '../include/header.php';
include '../include/student_sidebar.php';
include '../config.php';

$id = $_SESSION['id'];
$violations = $con->query("
  SELECT *, v.id AS vioID FROM violations AS v 
  JOIN faculty AS f
  ON v.faculty = f.id
  JOIN students AS s
  ON v.student = s.id
  JOIN policies AS p
  ON v.policy = p.id
  WHERE v.student = $id
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
          <h1 class="m-0 text-dark">Your Violations</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Your Violations</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="content">
    <div class="container-fluid">
      <div class="card card-primary">
        <div class="card-header text-center">
          <h5><i class="fa fa-times-circle"></i></h5>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-striped table-sm text-center small">
           <thead>
              <th> Violation </th>
              <th> Sanction </th>
              <th> Sanction Proof </th>
              <th> Date </th>
              <th> Status </th>
              <th> Action </th>
            </thead>
            <tbody>
            	<?php while($row = $violations->fetch_assoc()) {
                $badge = getBadge($row['status']);
              ?>
	              <tr>
	                <td> <?=$row['violation']?> </td>
	                <td> <?=$row['sanction']?> </td>
	                <td> <?=$row['proof_type']?> </td>
	                <td> <?=$row['date']?> </td>
	                <td> 
                    <span class="badge badge-<?=$badge?>"><?=$row['status']?></span> 
                  </td>
	                <td>
	                	<?php if ($row['status'] == 'Issued' || $row['status'] == 'Denied') { ?>
                      <a href="violations_address.php?id=<?=$row['vioID']?>" role="button" class="btn btn-warning btn-sm">
                          Address
                      </a>
                    <?php } elseif ($row['status'] == 'Addressed') { ?>
                      <a href="violations_issued.php?id=<?=$row['vioID']?>" role="button" class="btn btn-success btn-sm">
                          View Sanction
                      </a>
                    <?php } ?>
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

