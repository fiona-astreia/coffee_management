<?php
session_start();
require_once '../config/db.php';
// Logic xử lý khi thêm vào DB
// Kiểm tra đăng nhập
if (!isset($_SESSION['username'])) {
    header('location:../auth/login.php');
    exit();
}

// Kiểm tra giỏ hàng
$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    die("Cart is empty");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Lấy thông tin người nhận

    
    
    
        

    } else {
        
    }

mysqli_close($con);
// Lưu Order => Lưu Items => xóa giỏ => Chuyển hướng
?>
