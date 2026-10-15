<?php
$conn = mysqli_connect("localhost", "root", "", "quanly_thuvien");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
?>