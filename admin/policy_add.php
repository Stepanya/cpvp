<?php 
include '../include/header.php';
include '../include/sidebar.php';
require_once '../config.php';

if ($_POST) {
  $violation = $_POST['violation'];
  $sanction = $_POST['sanction'];
  $proof_type = $_POST['proof_type'];

  $result = $con->query("
    INSERT INTO policies
      (violation, sanction, proof_type)
    VALUES
      ('$violation', '$sanction', '$proof_type')
  ");
  if ($result) {
    ?>
     <script> success("Policy has been Added.", '') </script>
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
          <h1 class="m-0 text-dark">Add New Policy</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add New Policy</li>
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
                <textarea name="violation" class="form-control" placeholder="Enter violation description" rows="5" required></textarea>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-12">
                <label>Sanction Proof</label>
                <textarea name="sanction" class="form-control" placeholder="Enter sanction description" rows="5" required></textarea>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-4">
                <label>Sanction Proof Type</label>
                <select class="form-control" name="proof_type" required>
                  <option disabled selected value="">--Select sanction proof type--</option>
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

