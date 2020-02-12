<?php 
include '../include/header.php';
include '../include/sidebar.php';
include '../config.php';

$faculty = $con->query("SELECT * FROM faculty");
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Faculty List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Faculty List</li>
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
              <th> Faculty No. </th>
              <th> Name </th>
              <th> Email </th>
              <th> Contact No. </th>
              <th> Address </th>
              <th> Department </th>
              <th> Action </th>
            </thead>
            <tbody>
            	<?php while($row = $faculty->fetch_assoc()) {?>
	              <tr>
	                <td> <?=$row['faculty_no']?> </td>
	                <td> <?=$row['name']?> </td>
	                <td> <?=$row['email']?> </td>
	                <td> <?=$row['contact']?> </td>
	                <td> <?=$row['address']?> </td>
	                <td> <?=$row['department']?> </td>
	                <td>
	                	<div class="btn-group">
                      <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                        Actions
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="faculty_edit.php?id=<?=$row['id']?>">Edit</a></li>
                        <li><a class="dropdown-item" href="faculty_delete.php?id=<?=$row['id']?>">Delete</a></li>
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

