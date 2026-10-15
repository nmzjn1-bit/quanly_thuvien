<?php
include 'ketnoi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM sach WHERE id = $id");
header("Location: index.php");
exit();
?>