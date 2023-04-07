<?php
include 'inc/header.php';
// include 'inc/slider.php';

$cs = new customer();

$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}


$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $UpdateCustomers = $cs->update_customers($_POST, $id); // hàm check catName khi submit lên
}
?>
<div class="main row">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Sửa thông tin của bạn</h3>
                </div>
                <div class="clear"></div>
            </div>
            <form action="" method="post">
                <table class="tblone">
                    <tr>
                        <?php
                        if (isset($UpdateCustomers)) {
                            echo '<td colspan="3">' . $UpdateCustomers . '</td>';
                        }
                        ?>
                    </tr>

                    <?php
                    $id = Session::get('customer_id');
                    $get_customers = $cs->get_info_customer($id);
                    if ($get_customers) {
                        while ($result = $get_customers->fetch(PDO::FETCH_ASSOC)) {

                    ?>
                            <tr>
                                <td>Tên</td>
                                <td>:</td>

                                <td><input type="text" name="name" value="<?php echo $result['c_name']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Điện thoại</td>
                                <td>:</td>
                                <td><input type="text" name="phone" value="<?php echo $result['c_phone']; ?>"></td>

                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><input type="text" name="email" value="<?php echo $result['c_email']; ?>"></td>

                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td>:</td>
                                <td><input type="text" name="address" value="<?php echo $result['c_address']; ?>"></td>

                            </tr>
                            <tr>
                                <td colspan="3"><input type="submit" name="save" value="Lưu lại" class="grey"></td>
                            </tr>

                    <?php
                        }
                    }
                    ?>
                </table>
            </form>

        </div>
    </div>

    <?php
    include 'inc/footer.php';
    ?>