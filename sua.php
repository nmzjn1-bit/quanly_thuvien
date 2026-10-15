<?php 
include 'ketnoi.php';
$id = $_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM sach WHERE id = $id"));
$loaisach = mysqli_query($conn, "SELECT * FROM loaisach");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tensach = $_POST['tensach'];
    $tacgia = $_POST['tacgia'];
    $gia = $_POST['gia'];
    $mota = $_POST['mota'];
    $loaisach_id = $_POST['loaisach_id'];
    
    if ($_FILES['hinhanh']['name'] != "") {
        $hinhanh = $_FILES['hinhanh']['name'];
        move_uploaded_file($_FILES['hinhanh']['tmp_name'], "uploads/" . basename($hinhanh));
        $sql = "UPDATE sach SET tensach='$tensach', tacgia='$tacgia', gia=$gia, mota='$mota', hinhanh='$hinhanh', loaisach_id=$loaisach_id WHERE id=$id";
    } else {
        $sql = "UPDATE sach SET tensach='$tensach', tacgia='$tacgia', gia=$gia, mota='$mota', loaisach_id=$loaisach_id WHERE id=$id";
    }
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('background.jpg'); background-size: cover; background-attachment: fixed;">
<div class="container mt-4" style="background: rgba(255,255,255,0.95); padding: 20px; border-radius: 15px; max-width: 600px;">
    <h2 class="text-center text-warning">Sửa thông tin sách</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Tên sách</label>
            <input type="text" name="tensach" class="form-control" value="<?= $row['tensach'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tác giả</label>
            <input type="text" name="tacgia" class="form-control" value="<?= $row['tacgia'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" name="gia" class="form-control" value="<?= $row['gia'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Thể loại</label>
            <select name="loaisach_id" class="form-select" required>
                <?php while($l = mysqli_fetch_assoc($loaisach)) { ?>
                    <option value="<?= $l['id'] ?>" <?= ($l['id'] == $row['loaisach_id']) ? 'selected' : '' ?>><?= $l['tenloai'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="mota" class="form-control" rows="3"><?= $row['mota'] ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh bìa mới (Bỏ trống nếu không đổi)</label>
            <input type="file" name="hinhanh" class="form-control" accept="image/*">
            <img src="uploads/<?= $row['hinhanh'] ?>" width="80" class="mt-2 border rounded">
        </div>
        <button type="submit" class="btn btn-warning">Cập nhật</button>
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>