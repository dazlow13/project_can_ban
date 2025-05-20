<?php

session_start();
// if (!isset($_SESSION['id']) && $_SESSION['level'] === 1) {
if (empty($_SESSION['level'])){
    header('Location: ../index.php');
    exit();
}