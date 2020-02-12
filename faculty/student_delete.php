<!-- SweetAlert2 -->
<link rel="stylesheet" href="../AdminLTE/plugins/sweetalert2/sweetalert2.min.css">
<script src="../AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../assets/js/global.js"></script>
<?php
require_once '../config.php';

$id = $_GET['id'];

$result = $con->query("DELETE FROM students WHERE id = $id");

if ($result) {
	?>
	 <script> success("The student has been deleted.", "student_list.php") </script>
	<?php	
} else {
	?>
	 <script> error("Something went wrong. Try again later.", "student_list.php") </script>
	<?php
}
?>


