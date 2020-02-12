<!-- SweetAlert2 -->
<link rel="stylesheet" href="../AdminLTE/plugins/sweetalert2/sweetalert2.min.css">
<script src="../AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../assets/js/global.js"></script>
<?php
require_once '../config.php';

$id = $_GET['id'];

$result = $con->query("DELETE FROM policies WHERE id = $id");

if ($result) {
	?>
	 <script> success("The policy has been deleted.", "policy_list.php") </script>
	<?php	
} else {
	?>
	 <script> error("Something went wrong. Try again later.", "policy_list.php") </script>
	<?php
}
?>


