<?php 
include '../include/header.php';
include '../include/student_sidebar.php';
require_once '../config.php';

$id = $_GET['id'];
$violation = $con->query("
  SELECT *, v.id AS vioID FROM violations AS v
  JOIN policies AS p 
  ON v.policy = p.id
  WHERE v.id = $id
")->fetch_assoc();

$badge = getBadge($violation['status']);

function getBadge($status) {
  if ($status == 'Addressed') return "warning";
  elseif ($status == 'Denied') return "danger";
  elseif ($status == 'Approved') return "success"; 
}
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Addressed Violation</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Addressed Violation</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <form method="POST" enctype="multipart/form-data">
        <div class="card card-primary">
          <div class="card-header">
            <h5>
              <i class="fa fa-book"></i>
              Status: 
              <span class="badge badge-<?=$badge?>"><?=$violation['status']?></span>
            </h5>
          </div>
          <div class="card-body">
            <div class="row form-group">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Policy</label>
                  <input type="text" class="form-control" readonly value="<?=$violation['violation']?>">
                </div>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-12">
                <label>Sanction</label>
                <textarea class="form-control sanction" placeholder="Select violation" rows="5" readonly><?=$violation['sanction']?></textarea>
              </div>
            </div>
            <?php if($violation['proof_type'] == 'Paragraph') {?>
              <div class="col-sm-12">
                <label>Sanction Proof</label>
                <textarea class="form-control sanction" placeholder="Select violation" rows="5" readonly><?=$violation['proof']?></textarea>
              </div>
            <?php } else { ?>
              <div class="row form-group photo">
                <div class="col-sm-12">
                  <label>Sanction Proof</label>
                  <img src="../assets/uploads/<?=$violation['proof']?>" class="rounded mx-auto d-block" alt="..." style="max-width: 100%">
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include '../include/footer.php'; ?>  

