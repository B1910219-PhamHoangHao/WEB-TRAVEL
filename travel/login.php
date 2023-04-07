<?php
include 'inc/header.php';
include 'classes/customer.php';

$cs = new customer(); 
$check_login = Session::get('customer_login');

	if($check_login){
		header("Location:index.php");
	}

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $insertCustomer = $cs -> insert_customer($_POST); // hàm check catName khi submit lên
    }

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $loginCustomer = $cs -> login_customer($_POST); // hàm check catName khi submit lên
    }

?>
<div class="main row">
	<div class="content">
		<div class="login_panel">
			
			<?php 
				if(isset($loginCustomer)){
					echo $loginCustomer;
				}
			?>

			<h3>Đăng nhập</h3>
			<p>Đăng nhập bên dưới</p>
			<form action="" method="post">
				<input type="text" name="email" class="field" placeholder="Nhập tài khoản">
				<input type="password" name="password" class="field" placeholder="Nhập mật khẩu">
				<p class="note">Click vào đây nếu bạn quên mật khẩu<a href="#">click</a></p>
				<div class="buttons">
					<div><input type="submit" name="login" class="grey" value="Đăng nhập"></div>
				</div>
			</form>
		</div>
		<div class="register_account">
			<?php
				if(isset($insertCustomer)){
					echo $insertCustomer;
				}
			?>
			<h3>Đăng ký tài khoản mới</h3>
			<form action="" method="post">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Nhập tên...">
								</div>
								<div>
									<input type="text" name="email" placeholder="Nhập email...">
								</div>
								<div>
									<input type="text" name="phone" placeholder="Nhập số điện thoại">
								</div>

								<div>
									<input type="password" name="password" placeholder="Nhập mật khẩu">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><input type="submit" name="submit" class="grey" value="Tạo tài khoản"></div>
				</div>
				<p class="terms">Click vào để xem <a href="#"> Nội quy &amp; điều khiện</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="row">
<?php
include 'inc/footer.php';
?>
</div>
