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
// THU HOÀI
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .cart-card {
            background: #fff;
            padding: 30px;
            margin-top: 50px;
            border-radius: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .cart-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 15px;
        }

        .btn-pill {
            border-radius: 50px;
            font-weight: 600;
            padding: 10px 25px;
        }

        .table thead th {
            border: none;
            color: #6c5ce7;
            font-weight: 700;
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
                    <?php foreach ($cart as $id => $item): ?>
                        <?php
                        $line_total = $item['price'] * $item['quantity'];
                        $grand_total += $line_total;
                        ?>
                        <tr>
                            <td>
                                <img src="../<?= htmlspecialchars($item['image'] ?: 'assets/img/no-image.png') ?>"
                                    class="cart-img">
                            </td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= number_format($item['price'], 0, ',', '.') ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td><?= number_format($line_total, 0, ',', '.') ?></td>
                            <td>
                                <a href="cart.php?action=remove&id=<?= $id ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Remove this item?');">Remove ❌</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <tr>
                        <td colspan="4" class="text-right"><strong>Grand Total:</strong></td>
                        <td colspan="2" class="text-danger">
                            <strong><?= number_format($grand_total, 0, ',', '.') ?> VND</strong>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-between">
                <a href="../home.php" class="btn btn-secondary">← Continue Shopping</a>
                <a href="checkout.php" class="btn btn-success btn-lg">Proceed to Checkout →</a>
            </div>

        <?php else: ?>
            <div class="alert alert-warning text-center">
                Your cart is empty! <br><br>
                <a href="../home.php" class="btn btn-primary">Go Shopping Now</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
