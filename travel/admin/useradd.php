<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/customer.php';

$cs = new customer();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $insertUser = $cs->insert_user($_POST); // hàm check catName khi submit lên
}

?>


<div class="grid_8">
    <div class="box round first grid">

        <div class="block">
            <form action="useradd.php" method="post" enctype="multipart/form-data">
                <table class="form">

                    <?php
                    if (isset($insertUser)) {
                        echo $insertUser;
                    }
                    ?>

                    <tr>
                        <td><label for="">Tên người dùng</label></td>
                        <td><input type="text" name="userName" placeholder="Nhập tên người dùng.." class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">Email</label></td>
                        <td><input type="text" name="userEmail" placeholder="Nhập email.." class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">SĐT:</label></td>
                        <td><input type="text" name="userPhone" placeholder="Nhập số điện thoại.." class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">Address:</label></td>
                        <td><input type="text" name="userAddress" placeholder="Nhập địa chỉ.." class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">Password:</label></td>
                        <td><input type="password" name="userPassword" class="medium"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit" value="Thêm người dùng"></td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
</div>

<script src="js/tiny-mce/jquery.tinymce.js"></script>
<script>
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('data-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>

<?php include 'inc/footer.php'; ?>