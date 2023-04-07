<?php
include 'inc/header.php';
// include 'inc/slider.php';

$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:login.php');
}

$cs =  new customer();

?>
<div class="main row">
	<div class="content">
		<div class="section group">
			<div class="content_top">
				<div class="heading">
					<h3>Thông tin khách hàng</h3>
				</div>
				<div class="clear"></div>
			</div>
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
							<td>Điện thoại</td>
							<td>:</td>
							<td><?php echo $result['c_phone']; ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><?php echo $result['c_email']; ?></td>
						</tr>
						<tr>
							<td>Địa chỉ</td>
							<td>:</td>
							<td><?php echo $result['c_address']; ?></td>
						</tr>
						<tr>
							<td colspan="3"><a href="editprofile.php">Cập nhật</a></td>

						</tr>

				<?php
					}
				}
				?>
			</table>
		</div>
	</div>

	<?php
	include 'inc/footer.php';
	?>