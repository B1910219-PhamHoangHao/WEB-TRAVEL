<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/product.php';

// gọi class category
$pd = new product();

if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    echo "<script> window.location = 'productlist.php' </script>";
} else {
    $id = $_GET['id']; // Lấy product id trên host
    $getProductById = $pd->getProductById($id);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $updateProduct = $pd -> update_product($_POST, $_FILES, $id);
}

?>
<div class="grid_8">
    <div class="box round first grid">
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                <?php 
                    if(isset($updateProduct)){
                        echo $updateProduct;
                    }

                    if($getProductById){
                        $i=0;
                        while($result = $getProductById->fetch(PDO::FETCH_ASSOC)){
                ?>  

                    <tr>
                        <td><label for="">Tên chuyến đi</label></td>
                        <td><input type="text" name="productName" value="<?php echo $result['p_name'] ?>" placeholder="Nhập tên sản phẩm.." class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">Mã chuyến đi</label></td>
                        <td><input type="text" name="productCode" value="<?php echo $result['p_code'] ?>" placeholder="Nhập mã sản phẩm.." class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">Giá vé</label></td>
                        <td><input type="text" name="productPrice" value="<?php echo $result['p_price'] ?>" placeholder="Nhập giá sản phẩm.." class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">Tải ảnh</label></td>
                        <td><input type="file" name="productImg" class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">Số lượng vé</label></td>
                        <td><input type="text" name="productQuantity" value="<?php echo $result['p_quantity'] ?>" placeholder="Nhập giá sản phẩm.." class="medium"></td>
                    </tr>
                    <tr>
                        <td><label for="">Ngày Khởi hành</label></td>
                        <td><input type="date" name="date" value="<?php echo $result['p_date']?>"></td>
                    </tr>
                    <tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;"><label for="">Mô tả</label></td>
                        <td>
                            <textarea name="productDesc" class="tinymce" <?php echo $result['p_desc'] ?>></textarea>
                        </td>
                    </tr>
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