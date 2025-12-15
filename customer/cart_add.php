<?php
session_start();
require_once '../config/db.php';
// Logic khi add vào cart
// Kiểm tra đăng nhập
if (!isset($_SESSION['username'])) {
    header('location:../auth/login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Lấy dữ liệu từ form
    $id = (int) $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];

    // 2. Validate
    if ($id <= 0 || $quantity <= 0) {
        die("Invalid product or quantity");
    }

    // 3. Lấy thông tin sản phẩm chuẩn từ DB (Để tránh hack giá từ HTML)


    if ($product) {
        // 4. Logic Giỏ hàng (Session)






    } else {

    }
}
?>