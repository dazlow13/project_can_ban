<?php
session_start();
$cart = $_SESSION['cart'];
$sum = 0;
// print_r($cart);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
</body>
    <table border="1" width="100%">
        <tr>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Xóa</th>
        </tr>
        <?php foreach ($cart as $id => $product) { 
                if (!is_array($product)) continue; // Đảm bảo $product là mảng
            ?>
                <tr>
                    <td> <img height="100" src="admin/products/photos/<?php echo $product['photo'] ?>" alt=""></td>
                    <td><?php echo $product['name'] ?></td>
                    <td>
                        <span class="span-price">
                            <?php echo $product['price'] ?>
                        </span>
                        
                    </td>
                    <td>
                        <button class="btn-update-quantity" 
                        data-id="<?php echo $id ?>" 
                        data-quantity="<?php echo $product['quantity'] ?>"
                        data-type="0">
                            -
                        </button>
                    
                        <span class="span-quantity">
                            <?php echo $product['quantity'] ?>
                        </span>
                       
                        <button class="btn-update-quantity" 
                        data-id="<?php echo $id ?>" 
                        data-quantity="<?php echo $product['quantity'] ?>"
                        data-type="1">
                            +
                        </button>  
                    </td>
                    <td>
                        <span class="span-sum">
                        <?php $result = $product['price'] * $product['quantity'];
                            echo $result;
                            $sum += $result; ?>
                        </span>
                    </td>
                    <td>
                        <button class="btn-delete" data-id="<?php echo $id ?>">
                            Xóa
                        </button>
                    </td>
                        
                </tr>
            <?php } ?>
    </table>
    <h1>
        Tổng tiền: $
        <span id="span-sum">
            <?php echo $sum ?>
        </span>
    </h1>
    <?php
        $id = $_SESSION['id'];
        require 'admin/connect.php';
        $sql = "select * from customers where id = '$id'";
        $result = mysqli_query($connect,$sql);
        $product = mysqli_fetch_array($result);
    ?>    
    <form method="post" action="process_checkout.php">
        Tên người nhận
        <input type="text" name="name_receiver"value='<?php echo $product['name'] ?>'>
        <br>
        Số điện thoại
        <input type="text" name="phone_receiver"value='<?php echo $product['phone_number'] ?>'>
        <br>
        Địa chỉ
        <input type="text" name="address_receiver"value='<?php echo $product['address'] ?>'>
        <br>
        <button>Đặt hàng</button>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
       $(document).ready(function() {
        $(".btn-update-quantity").click(function() {
        let btn = $(this);
        let id = btn.data('id');
        let type = parseInt(btn.data('type')); // hoặc 'decre' nếu giảm

        $.ajax({
            url: 'update_quantity_in_cart.php',
            type: 'GET',
            data: {
                id: id,
                type: type
            },
            success: function(response) {
                let parent_tr = btn.closest('tr');
                let price = parseFloat(parent_tr.find('.span-price').text());
                let quantity = parseInt(parent_tr.find('.span-quantity').text());
                if (type === 1) {
                    quantity += 1;
                } else {
                    quantity -= 1;
                }

                if (quantity > 0) {
                    parent_tr.find('.span-quantity').text(quantity);

                    let sum = price * quantity;
                    parent_tr.find('.span-sum').text(sum);
                } else {
                    parent_tr.remove(); // Xóa hàng nếu số lượng bằng 0
                }
                parent_tr.find('.span-quantity').text(quantity);
                updateTotalSum();
            }
            
        });
    });
    $(".btn-delete").click(function() {
    let btn = $(this);
    let id = btn.data('id');
    let parent_tr = btn.closest('tr'); // THÊM DÒNG NÀY

    $.ajax({
        url: 'delete_from_cart.php',
        type: 'GET',
        data: {
            id: id
        },
        success: function(response) {
            parent_tr.remove(); // Xóa hàng trên giao diện
            updateTotalSum();   
        }
    });
});

        });

    function updateTotalSum() {
        let total = 0;
        $(".span-sum").each(function() {
            total += parseFloat($(this).text());
        });
        $("#span-sum").text(total);
    }
 
    </script>
</body>
</html>