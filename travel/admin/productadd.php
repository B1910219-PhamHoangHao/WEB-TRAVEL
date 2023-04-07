<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/product.php';

$pd = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $insertProduct = $pd->insert_product($_POST, $_FILES); // hàm check catName khi submit lên
}

?>


<div class="grid_8">
    <div class="box round first grid">

        <div class="block">
            <form action="productadd.php" method="post" enctype="multipart/form-data">
                <table class="form">

                    <?php
                    if (isset($insertProduct)) {
                        echo $insertProduct;
                    }
                    ?>

                    <tr>
                        <td><label for="">Tên chuyến đi</label></td>
                        <td><input type="text" name="productName" placeholder="Nhập tên chuyến đi." class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">Mã chuyến đi</label></td>
                        <td><input type="text" name="productCode" placeholder="Nhập mã chuyến đi.." class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">Giá vé</label></td>
                        <td><input type="text" name="productPrice" placeholder="Nhập giá vé.." class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">Tải ảnh</label></td>
                        <td><input type="file" name="productImg" class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">Nhập số lượng vé</label></td>
                        <td><input type="text" name="productQuantity" placeholder="Nhập số vé." class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">Ngày Khởi hành</label></td>
                        <td><input type="date" name="date"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;"><label for="">Mô tả</label></td>
                        <td>
                            <textarea name="productDesc" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit" value="Thêm chuyến đi"></td>
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