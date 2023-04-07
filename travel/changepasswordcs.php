<?php include 'inc/header.php'; ?>
<?php include 'classes/customer.php'; ?>

<?php
$cs = new customer();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $passold = $_POST['passold'];
    $passnew = $_POST['passnew'];
    $change_pass_customer = $cs->change_pass_customer($_POST);
}
?>
<div class="main row">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <h2>Thay đổi mật khẩu</h2>
                <?php
                if (isset($change_pass_customer)) {
                    echo $change_pass_customer;
                }
                ?>
                <div class="clear"></div>
            </div>
            <form action="changepasswordcs.php" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <label>Mật khẩu cũ</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Nhập mật khẩu cũ..." name="passold" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Mật khẩu mới</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Nhập mật khẩu mới..." name="passnew" class="medium" />
                        </td>
                    </tr>


                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Cập nhật" />
                        </td>
                    </tr>
                </table>
            </form>


        </div>
    </div>
    <?php
    include 'inc/footer.php';
    ?>