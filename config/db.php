<?php
/* File kết nối CSDL chung */
$con = mysqli_connect('localhost', 'root', '', 'db_coffee_management', '3306');

// Kiểm tra kết nối
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset
mysqli_set_charset($con, 'utf8');
?>