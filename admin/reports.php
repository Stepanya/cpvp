<?php
session_start();
include "../config.php";

function format_date($date) {
	return date_format(date_create($date),"M d, Y");
}

$type = $_GET['type'];
$query;

if ($type == "Issued") {
	$query = "
		SELECT * FROM violations AS v
		JOIN students AS s
		ON v.student = s.id 
		JOIN faculty AS f 
		ON v.faculty = f.id
		JOIN policies AS p
		ON v.policy = p.id
		WHERE status = 'Issued'
	";
} else {
	$query = "
		SELECT * FROM violations AS v 
		JOIN faculty AS f 
		ON v.faculty = f.id
		JOIN students AS s
		ON v.student = s.id
		JOIN policies AS p
		ON v.policy = p.id
		WHERE status != 'Issued'
	";
}


$result = $con->query($query);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CPVP Violations Report</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../AdminLTE/dist/css/AdminLTE.min.css">
</head>
<body onload="">
	<div style="margin: 20px;">
		<div class="row">
			<div class="text-center" style="margin-left: 35%;">
	      <h4> Course Policy Violation Portfolio </h4>
				<h3> <?=$type?> Violations Report </h3>
			</div>
		</div>
		<hr>
		<table class="table table-sm table-bordered table-striped text-center small">
			<thead class="thead-dark">
				<th>Violation</th>
				<th>Student No.</th>
				<th>Course</th>
				<th>Faculty No.</th>
				<th>Department</th>
				<th>Date</th>
				<th>Proof</th>
				<th>Status</th>
				<th>Grounds</th>
			</thead>
			<tbody>
				<?php while($row = $result->fetch_assoc()) {?>
					<tr>
						<td> <small><?=$row['violation']?></small></td>
						<td> <?=$row['student_no']?> </td>
						<td> <?=$row['course']?> </td>
						<td> <?=$row['faculty_no']?> </td>
						<td> <?=$row['department']?> </td>
						<td> <?=format_date($row['date'])?></td>
						<td> <small><?=$row['proof']?></small> </td>
						<td> <?=$row['status']?> </td>
						<td> <small><?=($row['reason'] == ""? "":$row['reason'])?></small> </td>
					</tr>
				<?php }?>
			</tbody>
		</table>
		<a href="#" onclick="window.print()">Print</a>
	</div>
</body>
</html>