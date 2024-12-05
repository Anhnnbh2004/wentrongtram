<?php
include "db.php"; // Kết nối CSDL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Tìm người dùng trong CSDL
    $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Kiểm tra mật khẩu
        if (password_verify($password, $user['password'])) {
            echo "Đăng nhập thành công! Chào mừng, " . htmlspecialchars($user['fullname']);
        } else {
            echo "Sai mật khẩu.";
        }
    } else {
        echo "Tài khoản không tồn tại.";
    }

    $query->close();
    header("Location: trangchu.html");
exit;
}
$conn->close();
?>
