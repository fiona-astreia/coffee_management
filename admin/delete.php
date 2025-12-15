<?php
session_start();
require_once '../config/db.php';

// ===== BẮT ĐẦU =====
// 1. Kiểm tra: User CHƯA đăng nhập (chưa có session) VÀ có cookie "remember_me"?
if (!isset($_SESSION['username']) && isset($_COOKIE['remember_me'])) {

    $token = $_COOKIE['remember_me'];

    // 2. Tìm token trong CSDL VÀ token còn hạn
    $stmt_find = mysqli_prepare(
        $con,
        "SELECT users.* FROM auth_tokens 
         JOIN users ON auth_tokens.user_id = users.id 
         WHERE auth_tokens.token = ? AND auth_tokens.expires_at > NOW()"
    );

    mysqli_stmt_bind_param($stmt_find, "s", $token);
    mysqli_stmt_execute($stmt_find);
    $result_find = mysqli_stmt_get_result($stmt_find);

    // 3. Nếu tìm thấy token hợp lệ
    if ($user = mysqli_fetch_assoc($result_find)) {

        // 4. "Đăng nhập" cho họ bằng cách tạo session
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
    }

    mysqli_stmt_close($stmt_find);
}

// Kiểm tra session
if (!isset($_SESSION['username'])) {
    header('location:../auth/login.php');
    exit();
}

// Chỉ cho phép ADMIN truy cập.
if ($_SESSION['role'] !== 'admin') {
    header('location:../home.php?msg=no_permission');
    exit();
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id > 0) {
    // Chuẩn bị câu truy vấn DELETE
    $query = "DELETE FROM products WHERE id = ?";

    // Sử dụng Prepared Statements để xóa an toàn
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        // Xóa thành công
        mysqli_stmt_close($stmt);
        mysqli_close($con);

        header('location: ../home.php?msg=deleted');
        exit();
    } else {
        // Xóa thất bại
        mysqli_stmt_close($stmt);
        mysqli_close($con);

        header('location: ../home.php?msg=error');
        exit();
    }
} else {
    // Không có ID hợp lệ
    mysqli_close($con); // Dọn dẹp $con

    header('location: ../home.php?msg=invalid_id');
    exit();
}
?>