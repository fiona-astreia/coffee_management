<?php
session_start();
// Auto login check nếu cần (tùy chọn)
$order_id = $_GET['orderid'] ?? 0;
?>