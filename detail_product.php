<?php
  session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <?php include 'detail.php' ?>
    <?php include 'footer.php' ?>
  </div>
</body>
</html>