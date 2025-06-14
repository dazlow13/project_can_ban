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
        require '../connect.php';
        $sql = "select 
        orders.*,
        customers.name,
        customers.phone_number,
        customers.address
        from orders
        join customers
        on customers.id = orders.customer_id";
        $result = mysqli_query($connect,$sql);
    ?>
    <table border="1px" width="100%">
        <tr>
            <th>Mã</th>
            <th>Thời gian đặt</th>
            <th>Thông tin người nhận</th>
            <th>Thông tin người đặt</th>
            <th>Trạng thái</th>
            <th>Tổng tiền</th>
            <th>Xem</th>
            <th>Sửa</th>
        </tr>
        <?php foreach ($result as $each): ?>
            <tr>
                <td><?php echo $each['id'] ?></td>
                <td><?php echo $each['create_at'] ?></td>
                <td>
                    <?php echo $each['name_receiver'] ?><br>
                    <?php echo $each['phone_receiver'] ?><br>
                    <?php echo $each['address_receiver'] ?><br>
                </td>
                <td>
                    <?php echo $each['name'] ?><br>
                    <?php echo $each['phone_number'] ?><br>
                    <?php echo $each['address'] ?><br>
                </td>
                <td>
                   <?php
                        switch ($each['status']) {
                            case 0:
                                echo 'Mới đặt';
                                break;
                            case 1:
                                echo 'Đã xác nhận';
                                break;
                            case 2:
                                echo 'Đã hủy';
                                break;  
                        }
                   ?>
                </td>
                <td><?php echo $each['total_price'] ?></td>
                <td>
                    <a href="detail.php?id=<?php echo $each['id'] ?>">
                        Xem
                    </a>
                </td>
                <?php
                if ($each['status'] == 0) {
                    ?>
                    <td>
                        <a href="update.php?id=<?php echo $each['id'] ?>&status=1">
                            Duyệt
                        </a>
                        <br>
                        <a href="update.php?id=<?php echo $each['id'] ?>&status=2">
                            Hủy
                        </a>
                    </td>
                    <?php
                }
                else {
                    ?>
                    <td></td>
                    <?php
                }
                ?>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>
</html>