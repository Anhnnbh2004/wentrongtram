<?php
include "db.php"; // Kết nối CSDL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Mã hóa mật khẩu

    // Kiểm tra trùng username hoặc email
    $checkQuery = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $checkQuery->bind_param("ss", $username, $email);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
        echo "Tên đăng nhập hoặc email đã tồn tại.";
    } else {
        // Thêm người dùng mới
        $query = $conn->prepare("INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)");
        $query->bind_param("ssss", $fullname, $email, $username, $password);

        if ($query->execute()) {
            echo "Đăng ký thành công!";
        } else {
            echo "Lỗi khi đăng ký: " . $conn->error;
        }
    }
    header("Location: trangdangnhap.html");
exit;

    $checkQuery->close();
    $query->close();
}
$conn->close();
?>
