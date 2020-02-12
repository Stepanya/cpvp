<?php
include '../config.php';

$id = $_GET['id'];
$result = $con->query("SELECT * FROM policies WHERE id = $id")->fetch_assoc();
echo json_encode($result);
?>