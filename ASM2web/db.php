<?php
$servername = "localhost"; // Địa chỉ máy chủ
$username = "root";        // Tên đăng nhập (thường là root)
$password = "";            // Mật khẩu (mặc định là trống)
$dbname = "webpart2";       // Tên cơ sở dữ liệu

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
