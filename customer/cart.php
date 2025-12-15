<?php
session_start();
// NOTE: Trang này chủ yếu lấy dữ liệu từ Session, không cần DB cũng được, 
// nhưng cứ include để dùng Auto Login nếu cần sau này.
require_once '../config/db.php';
// giao diện cart
// Kiểm tra đăng nhập
if (!isset($_SESSION['username'])) {
    header('location:../auth/login.php');
    exit();
}

// Xử lý Xóa sản phẩm khỏi giỏ (Nếu bấm nút Delete)
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $remove_id = (int) $_GET['id'];
    unset($_SESSION['cart'][$remove_id]); // Xóa khỏi session
    header('location: cart.php'); // Load lại trang
    exit();
}

$cart = $_SESSION['cart'] ?? [];
$grand_total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
        }

        .container {
            background: #fff;
            padding: 30px;
            margin-top: 50px;
            border-radius: 8px;
        }

        .cart-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Your Shopping Cart 🛒</h2>

        <?php if (!empty($cart)): ?>
            <table class="table table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    

                    
                </tbody>
            </table>

            

        
    </div>
</body>

</html>