<?php
session_start();
require_once '../config/db.php';
// Giao diện điền thông tin
// 1. Kiểm tra đăng nhập
if (!isset($_SESSION['username'])) {
    header('location:../auth/login.php');
    exit();
}

// 2. Kiểm tra giỏ hàng có trống không?
$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    header('location: cart.php'); // Nếu rỗng thì đuổi về trang giỏ hàng
    exit();
}

// 3. Tính tổng tiền để hiển thị
$grand_total = 0;
foreach ($cart as $item) {
    $grand_total += $item['price'] * $item['quantity'];
}
?>