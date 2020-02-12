<?php 
include '../include/header.php';
include '../include/sidebar.php';
require_once '../config.php';

$id = $_GET['id'];

$policy = $con->query("SELECT * FROM policies WHERE id = $id")->fetch_assoc();

if ($_POST) {
  $violation = $_POST['violation'];
  $sanction = $_POST['sanction'];
  $proof_type = $_POST['proof_type'];

  $result = $con->query("
    UPDATE policies SET 
      violation = '$violation',
      sanction = '$sanction',
      proof_type = '$proof_type'
      WHERE id = $id
  ");
  if ($result) {
    ?>
     <script> success("The policy info has been edited.", '') </script>
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
          <h1 class="m-0 text-dark">Edit Policy</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Policy</li>
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
              <i class="fa fa-book"></i>
              Policy Info
            </h5>
          </div>
          <div class="card-body">
            <div class="row form-group">
              <div class="col-sm-12">
                <label>Violation</label>
                <textarea name="violation" class="form-control" placeholder="Enter violation description" rows="5" required><?=$policy['violation']?></textarea>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-12">
                <label>Sanction Proof</label>
                <textarea name="sanction" class="form-control" placeholder="Enter sanction description" rows="5" required><?=$policy['sanction']?></textarea>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-4">
                <label>Sanction Proof Type</label>
                <select class="form-control" name="proof_type" required>
                  <option selected value="<?=$policy['proof_type']?>"><?=$policy['proof_type']?></option>
                  <option value="Paragraph">Paragraph</option>
                  <option value="Photo Proof">Photo Proof</option>
                </select>
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
<?php include '../include/footer.php'; ?>  

