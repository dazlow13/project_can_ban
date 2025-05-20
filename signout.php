<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['name']);
setcookie('remember', '', time() - 3600);
header('location:index.php');
exit;
