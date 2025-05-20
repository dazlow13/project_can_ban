<?php session_start();
if (empty($_SESSION['id'])) {
    header('location:signin.php?error=Đăng nhập đi bạn');
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
    Chào mừng bạn đến với trang người dùng. Xin chào bạn
    <?php
        echo $_SESSION['name'];
    ?>
    <br>
    <a href="index.php">
        Về trang chủ
    </a>
    <br>
    <a href="signout.php">
        Đăng xuất
    </a>
</body>
</html>