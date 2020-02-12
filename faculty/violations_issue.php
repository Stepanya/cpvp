<?php 
include '../include/header.php';
include '../include/faculty_sidebar.php';
require_once '../config.php';

if ($_POST) {
  $policy = $_POST['policy'];
  $student = $_POST['student'];
  $faculty = $_SESSION['id'];
  $date = date('Y-m-d');
  $status = "Issued";

  $result = $con->query("
    INSERT INTO violations
      (policy, student, faculty, date, status)
    VALUES
      ('$policy', '$student', '$faculty', '$date', '$status')
  ");
  if ($result) {
    ?>
     <script> success("violation has been issued.", '') </script>
    <?php 
  } else {
    ?>
     <script> error("Something went wrong. Try again later.", '') </script>
    <?php
  }
}

$policies = $con->query("SELECT * FROM policies");
$students = $con->query("SELECT * FROM students");
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Issue Violation</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Issue Violation</li>
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
              Violation Info
            </h5>
          </div>
          <div class="card-body">
            <div class="row form-group">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Policy</label>
                  <select class="form-control select2 policy" style="width: 100%;" name="policy" required>
                    <option selected disabled>--Select policy--</option>
                    <?php  while($policy = $policies->fetch_assoc()) { ?>
                      <option value="<?=$policy['id']?>"><?=$policy['violation']?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Student</label>
                  <select class="form-control select2" style="width: 100%;" name="student" required>
                    <option selected disabled>--Select student--</option>
                    <?php  while($student = $students->fetch_assoc()) { ?>
                      <option value="<?=$student['id']?>"><?=$student['name']?> - <?=$student['course']?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-12">
                <label>Sanction</label>
                <textarea class="form-control sanction" placeholder="Select violation" rows="5" readonly></textarea>
              </div>
            </div>
            <!-- <div class="row form-group letter">
              <div class="col-sm-12">
                <label>Letter</label>
                <textarea class="form-control" placeholder="Enter explanatory letter" rows="5" name="letter"></textarea>
              </div>
            </div>
            <div class="row form-group photo">
              <div class="col-sm-12">
                <label>Upload Photo</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="photo">
                    <label class="custom-file-label">Choose Photo Proof (jpeg Only)</label>
                  </div>
                </div>
              </div>
            </div> -->
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

