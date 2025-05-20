<?php
require '../check_admin_login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $order_id = $_GET['id'];
        require '../connect.php';
        $sql = "select
        * from order_product
        join products on products.id = order_product.product_id
        where order_id = '$order_id'";
        $result = mysqli_query($connect,$sql);
        $sum = 0;
    ?>
    <table border="1" width="100%">
        <tr>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
        <?php foreach ($result as $product) { ?>
                <tr>
                    <td> <img height="100" src="../products/photos/<?php echo $product['photo'] ?>" alt=""></td>
                    <td><?php echo $product['name'] ?></td>
                    <td><?php echo $product['price'] ?></td>
                    <td>
                        <?php echo $product['quantity'] ?>
                    </td>
                    <td>
                        <?php
                        $result = $product['price'] * $product['quantity'];
                        echo $result;
                        $sum += $result;
                        ?>
                    </td>
                </tr>
            <?php } ?>
    </table>
    <h1>
        Tổng tiền của đơn hàng: <?php echo $sum ?>
    </h1>
</body>
</html>