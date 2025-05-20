<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Document</title>
  <style>
    *{
      padding: 0;
      margin: 0;
    }
    #tong{
      width: 100%;
      height: 700px;
      background: black;
    }
    #tren{
      width: 100%;
      height: 20%;
      background: pink;
    }
    #giua{
      width: 100%;
      height: 70%;
      background: red;
    }
    #duoi{
      width: 100%;
      height: 10%;
      background: orange;
    }
  </style>
</head>
<body>
  <div id="tong">
    <?php include 'menu.php' ?>
    <?php include 'products.php' ?>
    <?php include 'footer.php' ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/localization/messages_vi.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.add_to_cart').click(function() {
        let id = $(this).data('id');
        $.ajax({
          url: 'add_to_cart.php',
          type: 'GET',
          data: {id }
        })
        .done(function(response) {
          if (response == 1) {
            alert('Product added to cart!');
          } else {
            alert(response);
          }
        });
      });
    });
  </script>
</body>
</html>
