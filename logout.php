<!-- SweetAlert2 -->
<link rel="stylesheet" href="AdminLTE/plugins/sweetalert2/sweetalert2.min.css">
<script src="AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="assets/js/global.js"></script>
<?php 
session_start();
session_destroy();
?>
<script> success("You have been logged out.", "index.html") </script>


