<?php 
try {
    session_start();
    if(empty($_GET['id'])){
        throw new Exception('ID không tồn tại!');
    }

$id = $_GET['id'];

if(empty($_SESSION['cart'][$id])){
    require_once 'admin/connect.php';
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $connect->query($sql);
    $product = $result->fetch_assoc();
    $_SESSION['cart'][$id]['name'] = $product['name'];
    $_SESSION['cart'][$id]['photo'] = $product['photo'];
    $_SESSION['cart'][$id]['price'] = $product['price'];
    $_SESSION['cart'][$id]['quantity'] = 1;
} else{
    $_SESSION['cart'][$id]['quantity'] += 1;
}
    echo 1;
}   catch (Throwable $e) {
    echo $e->getMessage();
}



// print_r($_SESSION['cart']);

// Kiểm tra thêm sản phẩm
 