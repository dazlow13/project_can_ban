<style>
  .tung_san_pham{
    width: 33%;
    border: 1px solid black;
    height: 250px;
    float: left;
  }
</style>
<?php
  require_once 'admin/connect.php';
  $sql = "select * from products";
  $result = mysqli_query($connect,$sql);
?>
<div id="giua">
    <?php foreach ($result as $each) {?>
      <div class="tung_san_pham">
        <h1>
          <?php echo $each['name'] ?>
        </h1>
        <img src="admin/products/photos/<?php 
        echo $each['photo'] ?>" height="100">
        <p>
          $<?php echo $each['price'] ?>
        </p>
        <a href="detail_product.php?id=<?php echo $each['id'] ?>">
          Xem chi tiết >>>
        </a>
        <?php if(!empty($_SESSION['id'])){ ?>
          <br>
          <button data-id="<?php echo $each['id'] ?>" 
          class="add_to_cart">
            Thêm vào giỏ hàng        
          </button>

        <?php } ?>
      </div>
    <?php  } ?>
</div>