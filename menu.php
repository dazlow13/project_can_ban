<div id="tren">
    <ol>
        <li>
          <a href="index.php">
            Trang chủ
          </a>
        </li>
        <?php
          if (empty($_SESSION['id'])) { ?>
                <li>
                <a href="signin.php">
                  Đăng nhập
                </a>
              </li>
              <li>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-signup">
                  Đăng ký
              </button>
              </li>
                <?php include 'signup.php'; ?>
              <?php } else { ?>
                <li>
                <a href="view_cart.php">
                  Xem giỏ hàng
                </a>
              </li>
                <li>
                 Chào <?php echo $_SESSION['name'] ?>, 
                <a href="signout.php">
                  Đăng xuất
                </a>
              </li>
         <?php }
        ?>

      </ol>
  </div>