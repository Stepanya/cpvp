<?php 
include '../include/header.php';
include '../include/faculty_sidebar.php';
require_once '../config.php';

$id = $_GET['id'];

if ($_POST) {
  $id = $_POST['id'];
  $reason = $_POST['grounds'];
  $status;

  if (isset($_POST['approved'])) $status = "Approved";
  elseif (isset($_POST['denied'])) $status = "Denied";

  $result = $con->query("
   UPDATE violations SET 
    reason = '$reason',
    status = '$status'
    WHERE id = $id
  ");

  if ($result) {
    ?>
     <script> success("Violation has been <?=$status?>.", 'violations.php') </script>
    <?php 
  } else {
    ?>
     <script> error("Something went wrong. Try again later.", '') </script>
    <?php
  }
}
$violation = $con->query("
  SELECT *, v.id AS vioID FROM violations AS v
  JOIN policies AS p 
  ON v.policy = p.id
  WHERE v.id = $id
")->fetch_assoc();

?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Address Violation</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Address Violation</li>
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
              Violation Info
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
          <input type="hidden" name="id" value="<?=$violation['vioID']?>">
          <div class="card-footer justify-content-between">
            <div class="btn-group float-right">
              <button class="btn btn-success" name="approved">Approve</button>
            </div>
            <div class="btn-group float-left" data-toggle="modal" data-target="#grounds">
              <button type="button" class="btn btn-danger denied">Deny</button>
            </div>
          </div>
        </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="grounds">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Deny on what grounds?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" name="grounds">
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-success" name="denied">Submit</button>
      </div>
    </div>
  </div>
</div>

</form>

<script>
$(window).keydown(function(event){
  if(event.keyCode == 13) {
    event.preventDefault();
    return false;
  }
});
</script>
<?php include '../include/footer.php'; ?>  

