<?php
include 'inc/header.php';
// include 'inc/slider.php';

$customer_id = Session::get('customer_id');
$cs = new customer();
$get_info_customer = $cs -> get_info_customer($customer_id);
$ct = new cart();
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
	$customer_id = Session::get('customer_id');
	$insertOrder = $ct->insertOrder($customer_id);
	$delCart = $ct->del_all_data_cart();
	// header('Location:success.php');
}
?>
<style type="text/css">
	.box_left {
		width: 50%;
		border: 1px solid #666;
		float: left;
		padding: 4px;

	}

	.box_right {
		width: 47%;
		border: 1px solid #666;
		float: right;
		padding: 4px;
	}

	.a_order {
		background: #653092;
		color: aliceblue;
		padding: 10px;
		font-size: 25px;
		border-radius: none;
		cursor: pointer;
	}
</style>

<form action="" method="POST">
	<div class="main row">
		<div class="content">
			<div class="section group">
				<?php 
					if(isset($insertOrder)){
						echo $insertOrder;
					}
				?>
				<div class="heading">
					<h3>Thanh toán offline</h3>
				</div>
				<div class="clear"></div>
				<div class="box_left">
					<div class="cartpage">
						<h2>Giỏ hàng của bạn</h2>
						<?php
						if (isset($update_quantity_Cart)) {
							echo $update_quantity_Cart;
						}
						?>
						<?php
						if (isset($delcart)) {
							echo $delcart;
						}
						?>
						<?php
						if (isset($delcart)) {
							echo $delcart;
						}
						?>
						<table class="tblone">
							<tr>
								<th width="5%">Stt</th>
								<th width="15%">Tên chuyến đi</th>
								<th width="15%">Giá vé</th>
								<th width="25%">Số lượng vé</th>
								<th width="20%">Tổng giá</th>

							</tr>
							<?php
							$fm = new Format();
							$ct = new cart();
							$get_product_cart = $ct->get_product_cart();
							if ($get_product_cart) {
								$s = 0;
								$qty = 0;
								$i = 0;
								while ($result = $get_product_cart->fetch(PDO::FETCH_ASSOC)) {
									$i++;

							?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $result['c_productName'] ?></td>

										<td><?php echo $result['c_productPrice'] . ' VND' ?></td>
										<td>
											<?php echo $result['c_productQuantity'] ?>
										</td>
										<td>
											<?php
											echo $fm->format_currency($result['c_productPrice'] * $result['c_productQuantity']) . ' VND';
											?>
										</td>

									</tr>
							<?php
							$s = $s + $result['c_productPrice'] * $result['c_productQuantity'];
							$qty =  $qty + $result['c_productQuantity'];
								}
							}
							?>

						</table>
						<?php
						$check_cart = $ct->check_cart();
						if ($check_cart) {
						} else {
							echo '	Giỏ hàng bạn đang trống!';
						}
						?>
					</div>


				</div>
				<div class="box_right">
					<table class="tblone">
						<?php
						$id = Session::get('customer_id');
						$get_customers = $cs->get_info_customer($id);
						if ($get_customers) {
							while ($result = $get_customers->fetch(PDO::FETCH_ASSOC)) {

						?>
								<tr>
									<td>Tên</td>
									<td>:</td>
									<td><?php echo $result['c_name']; ?></td>
								</tr>
								<tr>
									<td>Địa chỉ</td>
									<td>:</td>
									<td><?php echo $result['c_address']; ?></td>
								</tr>
								<tr>
									<td>Số điện thoại</td>
									<td>:</td>
									<td><?php echo $result['c_phone']; ?></td>
								</tr>
								<tr>
									<td>Email</td>
									<td>:</td>
									<td><?php echo $result['c_email']; ?></td>
								</tr>
								<tr>
									<td colspan="3"><a href="editprofile.php">Cập nhật thông tin</a></td>
								</tr>

						<?php
							}
						}
						?>
					</table>

				</div>
			</div>
		</div>
		<center style="padding-bottom: 20px;"><a href="?orderid=order" class="a_order">Đặt ngay</a></center>
	</div>
</form>
<?php
include 'inc/footer.php';
?>