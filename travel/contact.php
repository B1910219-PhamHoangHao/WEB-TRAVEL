<?php
include 'inc/header.php';

$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:login.php');
}

$id = Session::get('customer_id');
$cs = new customer();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	// LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
	$insert_comment_customer = $cs->insert_comment_customer($_POST, $id); // hàm check catName khi submit lên
}
?>
<div class="main row">
	<div class="content">
		<div class="support">
			<div class="support_desc">
				<h3>GÓP Ý CHO CHÚNG TÔI NẾU BẠN GẶP VẤN ĐỀ VỀ KỸ THUẬT </h3>
				<p>Chúng tôi sẽ phục vụ tân tâm với năng lực về kỹ thuật và sáng tạo,sẽ hỗ trợ hết mình vì khách hàng </p>
			</div>
			<img src="web/images/contact.png" alt="" />
			<div class="clear"></div>
		</div>
		<div class="section group">
			<div class="col span_2_of_3">
				<div class="contact-form">
					<h2>Liên hệ với chúng tôi</h2>
					<?php
					if (isset($insert_comment_customer)) {
						echo $insert_comment_customer;
					}
					?>
					<form action="" method="POST">
						<div>
							<span><label>HỌ VÀ TÊN</label></span>
							<span><input type="text" name="name"></span>
						</div>
						<div>
							<span><label>E-MAIL</label></span>
							<span><input type="text" name="email"></span>
						</div>
						<div>
							<span><label>ĐIỆN THOẠI</label></span>
							<span><input type="text" name="phone"></span>
						</div>
						<div>
							<span><label>MÔ TẢ</label></span>
							<span><textarea name="comment"> </textarea></span>
						</div>
						<div>
							<span><input type="submit" name="submit" value="GỬI"></span>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
<div class="row">
<?php 
	include 'inc/footer.php';
 ?>
</div>