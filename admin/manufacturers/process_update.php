<?php
require '../check_super_admin_login.php';
if (empty($_POST['id']) ) {
  header('location:form_update.php?error= Phải truyền mã để sửa');
  exit;
}
$id = $_POST['id'];
if ( empty($_POST['name']) || empty($_POST['address']) || empty($_POST['phone']) ||
empty($_POST['photo'])) {
  header("location:form_update.php?id=$id&error= Phải điền đầy đủ thông tin");
  exit;
}
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$photo = $_POST['photo'];

require '../connect.php';
$sql = "update manufacturers
set
name = '$name',
address = '$address',
phone = '$phone',
photo = '$photo'
where
id = '$id'
";

mysqli_query($connect,$sql);
$error = mysqli_error($connect);
if (empty($error)) {
  header('location:index.php?success= Sửa thành công');
  # code...
}else {
  header("location:form_update.php?id=$id&error= Lỗi truy vấn");
  # code...
}
mysqli_close($connect);
