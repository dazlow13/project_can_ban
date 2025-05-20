<?php
$email = $_POST['email'];
$password = $_POST['password'];
require 'connect.php';

$sql = "SELECT * FROM admin
WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) == 1) {
    $each = mysqli_fetch_assoc($result);
    session_start();

    $_SESSION['id'] = $each['id'];
    $_SESSION['email'] = $each['email'];
    $_SESSION['level'] = $each['level'];

    header('Location:root/index.php');
    exit();
} 

header('Location: index.php');
