<?php
session_start();

$name = $_POST['name'];
$email = $_POST['email'];
$phone_number = $_POST['phone'];
$address = $_POST['address'];
$password = $_POST['password'];

require 'admin/connect.php';
$sql = "select count(*) from customers
where email = '$email'";
$result = mysqli_query($connect,$sql);
$number_rows = mysqli_fetch_array($result)['count(*)'];

if($number_rows == 1){
    echo 'Trùng email rồi';
    exit;
}

$sql = "insert into customers(name,email,phone_number,address,password)
value ('$name','$email','$phone_number','$address','$password')";
mysqli_query($connect,$sql);

$sql = "select id from customers
where email = '$email'";
$result= mysqli_query($connect,$sql);
$id = mysqli_fetch_array($result)['id'];
$_SESSION['id'] = $id;
$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['phone_number'] = $phone_number;

mysqli_close($connect);
echo 'success';