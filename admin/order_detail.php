<?php
session_start();
require_once '../config/db.php';
// Admin biết khách hàng order những món gì

// 1. CHECK QUYỀN
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('location:../home.php?msg=no_permission');
    exit();
}

$order_id = (int)($_GET['id'] ?? 0);

// 2. LẤY THÔNG TIN ĐƠN HÀNG (Người mua, địa chỉ...)
$stmt = mysqli_prepare($con, "SELECT * FROM orders WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $order_id);
mysqli_stmt_execute($stmt);
$order = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$order) die("Order not found");

// 3. LẤY DANH SÁCH MÓN ĂN (Join với bảng products để lấy tên và ảnh)
$query_items = "SELECT oi.*, p.name as product_name, p.image 
                FROM order_items oi 
                JOIN products p ON oi.product_id = p.id 
                WHERE oi.order_id = $order_id";
$result_items = mysqli_query($con, $query_items);
?>