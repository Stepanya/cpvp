<?php 
include '../include/header.php';
include '../include/faculty_sidebar.php';
include '../config.php';

$students = $con->query("SELECT * FROM students");
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Student List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Student List</li>
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
              <th> Student No. </th>
              <th> Name </th>
              <th> Email </th>
              <th> Contact No. </th>
              <th> Address </th>
              <th> Course </th>
              <th> Action </th>
            </thead>
            <tbody>
            	<?php while($row = $students->fetch_assoc()) {?>
	              <tr>
	                <td> <?=$row['student_no']?> </td>
	                <td> <?=$row['name']?> </td>
	                <td> <?=$row['email']?> </td>
	                <td> <?=$row['contact']?> </td>
	                <td> <?=$row['address']?> </td>
	                <td> <?=$row['course']?> </td>
	                <td>
	                	<div class="btn-group">
                      <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                        Actions
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="student_edit.php?id=<?=$row['id']?>">Edit</a></li>
                        <li><a class="dropdown-item" href="student_delete.php?id=<?=$row['id']?>">Delete</a></li>
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

