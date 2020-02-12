<?php 
include '../include/header.php';
include '../include/student_sidebar.php';
require_once '../config.php';

$id = $_GET['id'];

if ($_POST) {
  $id = $_POST['id'];
  $status = "Addressed";
  $proof;
  if (isset($_FILES['photo'])) {
    $proof = uploadPhoto($_FILES['photo'], $_SESSION['student_no'].'-'.$id);
  } elseif (isset($_POST['letter'])) {
    $proof = $_POST['letter'];
  }

  $result = $con->query("
   UPDATE violations SET 
    proof = '$proof',
    status = '$status'
    WHERE id = $id
  ");

  if ($result) {
    ?>
     <script> success("Violation has been issued.", 'your_violations.php') </script>
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

function uploadPhoto($file, $name) {
  $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    move_uploaded_file($file['tmp_name'],"../assets/uploads/$name.$ext");
    return "$name.$ext";
}

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
              Status:
              <span class="badge badge-<?=$badge?>"><?=$violation['status']?></span>
            </h5>
          </div>
          <div class="card-body">
            <?php if($violation['status'] == "Denied") {?>
              <div class="row form-group">
                <div class="col-sm-12">
                  <label>Denied on the grounds of</label>
                  <textarea class="form-control" rows="5" readonly><?=$violation['reason']?></textarea>
                </div>
              </div>
            <?php }?>
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
              <div class="row form-group letter">
                <div class="col-sm-12">
                  <label>Sanction Proof</label>
                  <textarea class="form-control" placeholder="Enter explanatory letter" rows="5" name="letter" required></textarea>
                </div>
              </div>
            <?php } else { ?>
              <div class="row form-group photo">
                <div class="col-sm-12">
                  <label>Sanction Proof</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="photo" accept=".jpg, .jpeg" required>
                      <label class="custom-file-label">Choose Photo Proof (jpeg Only)</label>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
          <input type="hidden" name="id" value="<?=$violation['vioID']?>">
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

<script>
// hideAll()

$('.policy').change(function() {
  var id = $(this).val()
  $.ajax({
    url: "violations_select.php",
    data: {id:id},
    dataType: 'json', 
    success: function(data) {
      $('.sanction').val(data.sanction)
      // if (data.proof_type == 'Photo Proof') {
      //   hideAll()
      //   $('.photo').show()
      // } else {
      //   hideAll()
      //   $('.letter').show()
      // }
    }
  })
})

function hideAll() {
  $('.photo').hide()
  $('.letter').hide()
}
</script>

<?php include '../include/footer.php'; ?>  

