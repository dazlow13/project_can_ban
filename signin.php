<?php
session_start();

if (!empty($_COOKIE['remember'])) {
    require 'admin/connect.php';
    $token = mysqli_real_escape_string($connect, $_COOKIE['remember']);
    $sql = "select * from customers
    where token = '$token'
    limit 1";
    $result =  mysqli_query($connect,$sql);
    $number_rows = mysqli_num_rows($result); 
   if ($number_rows == 1) {
    $each = mysqli_fetch_array($result);
    $_SESSION['id'] = $each['id'];
    $_SESSION['name'] = $each['name'];
   }

}
if (isset($_SESSION['id'])) {
    header('location:user.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="process_signin.php">
        Email
        <input type="email" name="email" autocomplete="false">
        <br>
        Mật khẩu
        <input type="password" name="password" autocomplete="false">
        <br>
        Ghi nhớ đăng nhập
        <input type="checkbox" name="remember">
        <br>
        <button>Đăng nhập</button>
    </form>
</body>
</html>