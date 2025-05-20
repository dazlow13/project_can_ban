<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        Something
        <input type="text" name="name" id="name" value="test">
    </form>
    <div id="result"></div> <!-- Added this -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#name').on('input', function(){
                let name = $(this).val();
                $("#result").text('You have written ' + name);
            });
        });
    </script>
</body>
</html>
