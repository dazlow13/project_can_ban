<?php

session_start();
unset($_SESSION['id']);
unset($_SESSION['email']);
unset($_SESSION['level']);
header('Location: ../admin/index.php');
exit();