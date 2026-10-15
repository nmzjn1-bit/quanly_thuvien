<?php 
include 'ketnoi.php';
$loaisach = mysqli_query($conn, "SELECT * FROM loaisach");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tensach = $_POST['tensach'];
    $tacgia = $_POST['tacgia'];
    $gia = $_POST['gia'];
    $mota = $_POST['mota'];
    $loaisach_id = $_POST['loaisach_id'];
    
    $hinhanh = $_FILES['hinhanh']['name'];
    $target_file = "uploads/" . basename($hinhanh);
    
    if (move_uploaded_file($_FILES['hinhanh']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO sach (tensach, tacgia, gia, mota, hinhanh, loaisach_id) 
                VALUES ('$tensach', '$tacgia', $gia, '$mota', '$hinhanh', $loaisach_id)";
        mysqli_query($conn, $sql);
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('background.jpg'); background-size: cover; background-attachment: fixed;">
<div class="container mt-4" style="background: rgba(255,255,255,0.95); padding: 20px; border-radius: 15px; max-width: 600px;">
    <h2 class="text-center text-success">Thêm sách mới</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Tên sách</label>
            <input type="text" name="tensach" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tác giả</label>
            <input type="text" name="tacgia" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" name="gia" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Thể loại</label>
            <select name="loaisach_id" class="form-select" required>
                <option value="">-- Chọn thể loại --</option>
                <?php while($l = mysqli_fetch_assoc($loaisach)) { ?>
                    <option value="<?= $l['id'] ?>"><?= $l['tenloai'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="mota" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh bìa sách</label>
            <input type="file" name="hinhanh" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm sách</button>
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>