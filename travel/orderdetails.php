<?php
include 'inc/header.php';
// include 'inc/slider.php';

$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:login.php');
}

$ct = new cart();

if (isset($_GET['confirmid'])) {
	$confirm_received = $ct->confirm_received($_GET); // Xác nhận đã nhận hàng
}
?>
<div class="main row">
	<div class="content ">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Chi tiết đơn</h2>
					<?php 
						if(isset($confirm_received)){
							echo $confirm_received;
						}
					?>
				<table class="tblone">
					<tr>
						<th width="0%">STT</th>
						<th width="18%">Tên tour</th>
						<th width="10%">Số lượng vé</th>
						<th width="10%">Giá vé</th>
						<th width="14%">Ngày đặt</th>
						<th width="10%">Trạng thái</th>
					</tr>
					<?php
					$fm = new Format();

					$customer_id = Session::get('customer_id');
					$get_cart_ordered = $ct->get_cart_ordered($customer_id);
					if ($get_cart_ordered) {
						$i = 0;
						$qty = 0;
						while ($result = $get_cart_ordered->fetch(PDO::FETCH_ASSOC)) {
							$i++;
					?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['o_productName'] ?></td>
								<td><?php echo $result['o_quantity'] ?></td>
								<td><?php echo $result['o_price'] ?></td>
								<td><?php echo $fm->formatDate($result['o_date'])  ?></td>
			
									<?php
										if($result['o_status']==1){
									?>
									<td>Đang chờ xác nhận</td>
									<?php 
										}elseif($result['o_status']==2){
									?>
									<td><a href="?confirmid=<?php echo $result['o_id']?>
												&productid=<?php echo $result['o_productID']?>
												&cusid=<?php echo $result['o_customerID']?>
												&date=<?php echo $result['o_date']?>
												&quantity=<?php echo $result['o_quantity']?>"> Vé đã được xác nhận (Click nếu chuyến đi kết thúc)</a></td>
									<?php
										}elseif($result['o_status']==3){
									?>
									<td>Chuyến đi đã kết thúc</td>
							</tr>
					<?php
							}
						}
					}
					?>

				</table>

			</div>

		</div>
		<div class="clear"></div>
	</div>
</div>

<div class="row">
<?php 
	include 'inc/footer.php';
 ?>
</div>