<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/customer.php';

// gọi class category
$cs = new customer();

if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    // echo "<script> window.location = 'user.php' </script>";
} else {
    $id = $_GET['id']; // Lấy product id trên host
    $getuserId = $cs->getuserId($id);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $updateuser = $cs -> update_user($_POST, $_FILES, $id);
}

?>
<div class="grid_8">
    <div class="box round first grid">
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                <?php 
                    if(isset($updateuser)){
                        echo $updateuser;
                    }

                    if($getuserId){
                        $i=0;
                        while($result = $getuserId->fetch(PDO::FETCH_ASSOC)){
                ?>  

                    <tr>
                        <td><label for="">Tên người dừng</label></td>
                        <td><input type="text" name="userName" value="<?php echo $result['c_name'] ?>" placeholder="Nhập tên người dừng.." class="medium"></td>
                    </tr>
                        <td><label for="">Email</label></td>
                        <td><input type="text" name="userEmail" value="<?php echo $result['c_email'] ?>" placeholder="Nhập email.." class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">SĐT</label></td>
                        <td><input type="text" name="userPhone" value="<?php echo $result['c_phone'] ?>" placeholder="Nhập số điện thoại.." class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">Address</label></td>
                        <td><input type="text" name="userAddress" value="<?php echo $result['c_address'] ?>" placeholder="Nhập địa chỉ.." class="medium"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit" value="Cập nhật"></td>
                    </tr>

                <?php 
                        }
                }
                ?>
                </table>
            </form>
        </div>
    </div>
</div>

<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php'; ?>