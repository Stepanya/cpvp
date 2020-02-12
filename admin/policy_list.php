<?php 
include '../include/header.php';
include '../include/sidebar.php';
include '../config.php';

$policies = $con->query("SELECT * FROM policies");
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Policy List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Policy List</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="content">
    <div class="container-fluid">
      <div class="card card-primary">
        <div class="card-header text-center">
          <h5><i class="fa fa-users"></i></h5>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-striped table-sm text-center small">
            <thead>
              <th> Violation </th>
              <th> Sanction Proof </th>
              <th> Sanction Proof Type </th>
              <th> </th>
            </thead>
            <tbody>
            	<?php while($row = $policies->fetch_assoc()) {?>
	              <tr>
	                <td> <?=$row['violation']?> </td>
	                <td> <?=$row['sanction']?> </td>
	                <td> <?=$row['proof_type']?> </td>
	                <td>
	                	<div class="btn-group">
                      <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                        Actions
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="policy_edit.php?id=<?=$row['id']?>">Edit</a></li>
                        <li><a class="dropdown-item" href="policy_delete.php?id=<?=$row['id']?>">Delete</a></li>
                      </ul>
                    </div>
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

