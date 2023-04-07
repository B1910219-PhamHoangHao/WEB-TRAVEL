<?php
include 'lib/session.php';
Session::init();

include_once('lib/database.php');
include_once('helpers/format.php');

//Load tất cả các hàm có trong classes/.
spl_autoload_register(function ($className) {
	include_once "classes/" . $className . ".php";
});

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<head>
	<title>WEB TRAVEL</title>
	<meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>

	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<style>
		.nav-link {color: white};
		*{
			box-sizing: border-box;
		}
	</style>

	<script type="text/javascript">
		$(document).ready(function($) {
			$('#dc_mega-menu-orange').dcMegaMenu({
				rowItems: '4',
				speed: 'fast',
				effect: 'fade'
			});
		});
	</script>
	<script>
	$(function () {
  	var url = window.location.href;
 	 $(".nav .nav-link").each(function () {
    if (url == (this.href)) {
      $(this).closest("a").addClass("active");
      $(this).closest("a").parent().addClass("active");
    }
  });
});
	</script>
</head>

<body class="container">
	<div class="wrap row">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/LOGO/logo.png" alt="" /></a>
			</div>

			<div class="header_top_right">
				<div class="input-group">
					<form action="search.php" method="GET" class="form-outline d-flex pb-2 search2">
						<input class="form-control" type="text" name="fsearch" value="Tìm kiếm sản phẩm" onfocus="this.value ='';" onblur="if (this.value == '') {this.value = 'Tìm kiếm sản phẩm';}">
						<input class="btn btn-primary" type="submit" name="search" value="Tìm kiếm">
					</form>
				</div>
					<?php
					if (isset($_GET['id'])) {
						// $delcart = $ct->del_all_data_cart();
						Session::destroy();
					}
					?>
				<div class="" style="float: right; position: absolute; right: 0px; top: 20px">
					<?php
					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo '<a class="btn btn-primary" href="login.php">Đăng nhập</a></div>';
					} else
						echo '<a class="btn btn-primary" href="?id=' . Session::get('customer_id') . '">Đăng xuất</a></div>';
					?>
					<div class="clear"></div>
				</div>
				<!-- <div class="clear"></div> -->
			</div>
			<div class="menu row">
				<ul id="dc_mega-menu-orange" class="nav nav-tabs navbar-dark bg-dark">
					<li class="nav-item"><a href="index.php" class="nav-link">Trang chủ</a></li>
					<li class="nav-item"><a href="introduce.php" class="nav-link">Giới thiệu</a></li>
					<li class="nav-item"><a href="products.php" class="nav-link">Tour</a> </li>
					<li class="nav-item"><a href="cart.php" class="nav-link">Giỏ hàng</a></li>
					<li class="nav-item"><a href="contact.php" class="nav-link">Liên hệ</a> </li>
					<?php
					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo '';
					} else {
						echo '<li class="nav-item"><a href="profile.php" class="nav-link">Thông tin khách hàng</a> </li>';
						echo '<li class="nav-item"><a href="orderdetails.php" class="nav-link">Tour đã đặt</a> </li>';
						echo '<li class="nav-item"><a href="changepasswordcs.php" class="nav-link">Thay đổi mật khẩu</a> </li>';
					}
					?>

					<div class="clear"></div>
				</ul>
			</div>