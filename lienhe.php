<?php 
include 'ketnoi.php';
$thongbao = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoten = $_POST['hoten'];
    $email = $_POST['email'];
    $noidung = $_POST['noidung'];
    if (mysqli_query($conn, "INSERT INTO lienhe (hoten, email, noidung) VALUES ('$hoten', '$email', '$noidung')")) {
        $thongbao = "Cảm ơn bạn đã gửi liên hệ!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Liên hệ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('background.jpg'); background-size: cover; background-attachment: fixed;">
<div class="container mt-4" style="background: rgba(255,255,255,0.95); padding: 20px; border-radius: 15px; max-width: 600px;">
    <h2 class="text-center text-info">Liên hệ với thủ thư</h2>
    <?php if ($thongbao) echo "<div class='alert alert-success'>$thongbao</div>"; ?>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Họ và tên</label>
            <input type="text" name="hoten" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Nội dung</label>
            <textarea name="noidung" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-info">Gửi liên hệ</button>
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>