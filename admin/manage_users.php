<?php
session_start();
require_once '../config/db.php';

// ===== BẮT ĐẦU: AUTO LOGIN (TOKEN) =====
if (!isset($_SESSION['username']) && isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];
    $stmt_find = mysqli_prepare($con, 
        "SELECT users.* FROM auth_tokens 
         JOIN users ON auth_tokens.user_id = users.id 
         WHERE auth_tokens.token = ? AND auth_tokens.expires_at > NOW()");
    
    mysqli_stmt_bind_param($stmt_find, "s", $token);
    mysqli_stmt_execute($stmt_find);
    $result_find = mysqli_stmt_get_result($stmt_find);

    if ($user = mysqli_fetch_assoc($result_find)) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
    }
    mysqli_stmt_close($stmt_find);
}

// NOTE: BẢO VỆ: CHỈ ADMIN MỚI ĐƯỢC VÀO
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('location:../home.php?msg=no_permission');
    exit();
}

/* 3. LẤY DANH SÁCH USER (Trừ chính mình) */
$my_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id != $my_id ORDER BY id DESC";
$result = mysqli_query($con, $query);

/* 4. XỬ LÝ XÓA USER */
if (isset($_GET['delete_id'])) {
    $del_id = (int) $_GET['delete_id'];
    mysqli_query($con, "DELETE FROM users WHERE id = $del_id");
    
    header("location: manage_users.php?msg=deleted");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 30px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    
</body>
</html>