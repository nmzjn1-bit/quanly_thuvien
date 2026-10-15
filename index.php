<?php include 'ketnoi.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thư viện sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-image: url('background.jpg'); background-size: cover; background-attachment: fixed; }
        .card-sach { transition: transform 0.2s; border: none; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .card-sach:hover { transform: translateY(-5px); box-shadow: 0 8px 16px rgba(0,0,0,0.2); }
        .card-img-top { height: 200px; object-fit: cover; }
    </style>
</head>
<body>
<div class="container mt-4" style="background: rgba(255,255,255,0.95); padding: 20px; border-radius: 15px;">
    <h1 class="mb-4 text-center text-primary">📚 Thư viện sách Online</h1>
    
    <div class="d-flex justify-content-between mb-3">
        <a href="them.php" class="btn btn-success">+ Thêm sách mới</a>
        <a href="lienhe.php" class="btn btn-info">Liên hệ thủ thư</a>
    </div>

    <div class="row">
        <?php
        $sql = "SELECT sach.*, loaisach.tenloai FROM sach LEFT JOIN loaisach ON sach.loaisach_id = loaisach.id ORDER BY sach.id DESC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $anh = $row['hinhanh'] ? "uploads/{$row['hinhanh']}" : "https://via.placeholder.com/200x200?text=No+Image";
            echo "
            <div class='col-md-4 mb-4'>
                <div class='card card-sach h-100'>
                    <img src='$anh' class='card-img-top' alt='Ảnh sách'>
                    <div class='card-body'>
                        <h5 class='card-title text-primary'>{$row['tensach']}</h5>
                        <p class='card-text mb-1'><strong>Tác giả:</strong> {$row['tacgia']}</p>
                        <p class='card-text mb-1'><strong>Thể loại:</strong> {$row['tenloai']}</p>
                        <p class='card-text text-danger fw-bold'>" . number_format($row['gia']) . " đ</p>
                        <p class='card-text'><small class='text-muted'>{$row['mota']}</small></p>
                    </div>
                    <div class='card-footer bg-white border-0 d-flex justify-content-between'>
                        <a href='sua.php?id={$row['id']}' class='btn btn-warning btn-sm'>Sửa</a>
                        <a href='xoa.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Bạn có chắc muốn xóa sách này?')\">Xóa</a>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
</div>
</body>
</html>