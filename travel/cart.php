<?php
include 'inc/header.php';

$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:login.php');
}

$ct = new cart();
$fm = new Format();
if (isset($_GET['cartid'])) {
	$cartid = $_GET['cartid']; // Lấy catid trên host
	$delcart = $ct->del_product_cart($cartid); // hàm check delete Name khi submit lên
}


$product = new product();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	// LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
	$cartId = $_POST['cartId'];
	$id = $_POST['productId'];
	$quantity =  $_POST['quantity'];
	$show_product_remain = $product->show_product_remain($id)->fetch(PDO::FETCH_ASSOC);
	$product_remain = $show_product_remain['p_remain'];
	if ($quantity <= $product_remain) {
		$update_quantity_cart = $ct->update_quantity_Cart($cartId, $quantity); // hàm check catName khi submit lên
	} else echo $mgs = "không đủ hàng";
}

?>
<style>
	.shopleft a {
		padding: 10px;

		background: #602D8D;
		color: #fff;
	}

	.shopright a {
		padding: 10px;

		background: #602D8D;
		color: #fff;
	}
</style>
<div class="main row">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Giỏ hàng của bạn</h2>

				<?php
				if (isset($update_quantity_cart)) {
					echo $update_quantity_cart;
				}
				?>
				<?php
					// thông báo xóa sp
				if (isset($delcart)) {
					echo $delcart;
				}
				?>
				<table class="tblone">
					<tr>
						<th width="20%">Tên chuyến đi</th>
						<th width="10%">Hình ảnh</th>
						<th width="15%">Số lượng vé</th>
						<th width="25%">Giá vé</th>
						<th width="20%">Tổng giá</th>
						<th width="10%">Hoạt động</th>
					</tr>

					<?php
					$qty = 0;
					$s = 0;
					//show sản phẩm ở trong giỏ hàng.
					$get_product_cart =$ct -> get_product_cart();;

					if ($get_product_cart) {
						while ($result = $get_product_cart->fetch(PDO::FETCH_ASSOC)) {
							 $s = $s + $result['c_productPrice'] * $result['c_productQuantity'];
							 $qty =  $qty + $result['c_productQuantity'];
					?>
							<tr>
								<td><?php echo $result['c_productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['c_productIMG'] ?>" alt=""></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['c_id'] ?>" />
										<input type="hidden" name="productId" value="<?php echo $result['c_productID'] ?>" />
										<input type="number" name="quantity" value="<?php echo $result['c_productQuantity'] ?>">
										<input type="submit" class="buysubmit" name="submit" value="Cập nhật">

										<?php
										if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
											// LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
											$cartId = $_POST['cartId'];
											$id = $_POST['productId'];
											$quantity =  $_POST['quantity'];
											$show_product_remain = $product->show_product_remain($id)->fetch(PDO::FETCH_ASSOC);
											$product_remain = $show_product_remain['p_remain'];
											if ($quantity <= $product_remain) {
												$update_quantity_cart = $ct->update_quantity_Cart($cartId, $quantity); // hàm check catName khi submit lên
											} else echo '<span style="color:red; font-size:18px;">Không đủ hàng, hãy cập nhật lại số lượng</span>';
										}
										?>
									</form>
								</td>
								<td><?php echo $fm->format_currency($result['c_productPrice']) ?>VND</td>
								<td><?php echo $fm->format_currency($result['c_productPrice']*$result['c_productQuantity']) ?></td>
								<td><a href="?cartid=<?php echo $result['c_productID'] ?>">Xóa</a></td>
							</tr>

					<?php
						}
					}
					?>

					<?php
						if ($qty != 0) {
					?>
				
					<table style="float:right;text-align:left;" width="40%">
						<tr>
							<th>Tổng tiền : </th>
							<td><?php echo $fm->format_currency($s) ?>VND</td>
						</tr>
						<tr>
							<th>VAT : 1%</th>
							<td><?php echo $fm->format_currency($s*0.01) ?>VND</td>
						</tr>
						<tr>
							<th>Tổng tiền thanh toán :</th>
							<td><?php echo $fm->format_currency($s + $s*0.02) ?>VND </td>
						</tr>
					</table>
					<?php
						} else echo 'Giỏ hàng đang trống, bạn hãy lựa chọn chuyến đi du lịch đi nào '
					?>

			</div>
			<div class="shopping">
				<div class="shopleft">
					<a style="background:#602D8D" href="index.php">XEM TOUR NGAY</a>
				</div>
				<div class="shopright">
					<?php
					$check_cart = $ct->check_cart(); // Kiểm tra giỏ hàng có trống k
					if ($check_cart == false){
						echo '';
					} else echo '<a style="background:#602D8D" href="offlinepayment.php">THANH TOÁN</a></div>';
					?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	</table>
	<?php
	include 'inc/footer.php';
	?>