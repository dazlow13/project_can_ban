<?php
require '../check_super_admin_login.php';

if (empty($_GET['id']) ) {
  header('location:form_update.php?error= Phải truyền mã để sửa');
  exit;
}
$id = $_GET['id'];


require '../connect.php';
$sql = "delete from manufacturers
where
id = '$id'
";

mysqli_query($connect,$sql);
header('location:index.php?success= Xóa thành công');
mysqli_close($connect);
