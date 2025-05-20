
    <?php
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    ?>
<div id="modal-signup" class="modal fade" >
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h1>Form đăng ký</h1>
                <div class="alert alert-success" id="div-error" style="display: none;">
                </div>
            </div>
                <div class="modal-body">
                    <form id="form-signup" method="post" >
                    Tên
                    <input type="text" name="name">
                    <br>
                    Email
                    <input type="email" name="email">
                    <br>
                    Sđt
                    <input type="text" name="phone">
                    <br>
                    Địa chỉ
                    <input type="text" name="address">
                    <br>
                    Mật khẩu
                    <input type="password" name="password">
                    <br>
                    <button type="submit">Đăng ký</button>
                    </form>
                </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
    $("#form-signup").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                digits: true,
                minlength: 10
            },
            address: {
                required: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            name: {
                required: "Vui lòng nhập tên",
                minlength: "Tên phải có ít nhất 2 ký tự"
            },
            email: {
                required: "Vui lòng nhập email",
                email: "Email không hợp lệ"
            },
            phone: {
                required: "Vui lòng nhập số điện thoại",
                digits: "Số điện thoại chỉ chứa chữ số",
                minlength: "Số điện thoại phải có ít nhất 10 chữ số"
            },
            address: {
                required: "Vui lòng nhập địa chỉ"
            },
            password: {
                required: "Vui lòng nhập mật khẩu",
                minlength: "Mật khẩu phải có ít nhất 5 ký tự"
            }
        },
        submitHandler: function(form) {
            $.ajax({
            url: 'process_signup.php',
            type: 'POST',
            dataType: 'html',
            data: $(form).serialize(), 
            success: function(response) {
                response = response.trim(); // loại bỏ khoảng trắng

                    if (response === 'success') {
                        window.location.href = 'index.php'; // chuyển về trang chủ
                    } else {
                        $('#div-error')
                            .removeClass('alert-success')
                            .addClass('alert-danger')
                            .text(response)
                            .show();
                    }
                }
            });
        }
    });
});


</script>