<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../classes/product.php');
// require '../PHPMailer-5.2-stable/PHPMailerAutoload.php';
?>
<?php
$pd = new product();
$ct = new cart();

if (isset($_GET['orderid'])) {
	$confirm_order_cus = $ct->confirm_order_cus($_GET); // Xác nhận đơn hàng
}

if (isset($_GET['delorderid'])) {
	$del_order_cus = $ct->del_order_cus($_GET); // Xác nhận đơn hàng
}
?>

<div class="grid_8">
	<div class="box round first grid">
		<h2>Đơn đặt tour</h2>
		<div class="block">

			<?php
			if (isset($confirm_order_cus)) {
				echo $confirm_order_cus;
			}

			if (isset($del_order_cus)) {
				echo $del_order_cus;
			}
			?>

			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Thông tin khách hàng</th>
						<th>Tên chuyến đi</th>
						<th>Số lượng vé</th>
						<th>Tổng giá</th>
						<th>Ngày đặt</th>
						<th>Trạng thái</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$ct = new cart();
					$fm = new Format();
					$get_inbox_cart = $ct->get_inbox_cart();
					if ($get_inbox_cart) {
						$i = 0;
						while ($result = $get_inbox_cart->fetch(PDO::FETCH_ASSOC)) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><a href="customer.php?id=<?php echo $result['o_customerID'] ?>">Xem khách hàng</a></td>
								<td><?php echo $result['o_productName'] ?> </td>
								<td><?php echo $result['o_quantity'] ?></td>
								<td><?php echo $result['o_price'] ?></td>
								<td><?php echo $result['o_date']; ?></td>

									<?php
										if($result['o_status']==1){
									?>
									<td><a href="?orderid=<?php echo $result['o_id']?>
												&productid=<?php echo $result['o_productID']?>
												&cusid=<?php echo $result['o_customerID']?>
												&date=<?php echo $fm->formatDate($result['o_date'])?>
												&quantity=<?php echo $result['o_quantity']?>">Xác nhận</a>
									</td>
									<?php
										}elseif($result['o_status']==2){
									?>
									<td><a href="#">Đang gửi vé đi</a></td>
									<?php
										}elseif($result['o_status']==3){
									?>
									<td><a href="?delorderid=<?php echo $result['o_id']?>
												&productid=<?php echo $result['o_productID']?>
												&cusid=<?php echo $result['o_customerID']?>
												&date=<?php echo $result['o_date']?>
												&quantity=<?php echo $result['o_quantity']?>">Xóa đơn</a></td>
									
							</tr>
				<?php
								
									}
								}
							}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>