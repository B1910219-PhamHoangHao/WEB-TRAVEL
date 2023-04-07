<?php
include 'inc/header.php';
// include 'inc/slider.php';

$login_check = Session::get('customer_login');
if ($login_check == false && isset($_POST['submit'])) {
	header('Location:login.php');
}

if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {	
	echo "<script> window.location = '404.php' </script>";
} else {
	$id = $_GET['proid']; // Lấy productid trên host
}

$customer_id = Session::get('customer_id');


?>
<div class="main row">
	<div class="content">
		<div class="section group">
			<?php
			$fm = new Format();

			$product = new product();

			$get_product_details = $product->getProductById($id);
			if ($get_product_details) {
				while ($result = $get_product_details->fetch(PDO::FETCH_ASSOC)) {
			?>
					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img src="admin/uploads/<?php echo $result['p_img'] ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result['p_name'] ?> </h2>
							<p><?php echo $fm->textShorten($result['p_desc'], 150) ?></p>
							<div class="price">
								<p>Giá: <span><?php echo $fm->format_currency($result['p_price']) . " VND" ?></span></p>

							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="productQuantity" value="1" min="1" />
									<input type="submit" class="buysubmit" name="submit" value="Thêm vào giỏ hàng" />

									<?php

									if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
										$quantity = $_POST['productQuantity'];
										$update_product_remain = $product->update_product_remain($id);
										$show_product_remain = $product->show_product_remain($id)->fetch(PDO::FETCH_ASSOC);
										$product_remain = $show_product_remain['p_remain'];
										if ($quantity <= $product_remain) {
											$ct = new cart();
											$add_to_cart = $ct->add_to_cart($id, $quantity);
										} else echo '<span style="color:red; font-size:18px;">Không đủ hàng</span>';
									}
									?>

								</form>
								<?php
								if (isset($add_to_cart)) {
									echo '<span style="color:red; font-size:18px;">Chuyến đi đã được bạn thêm vào giỏ hàng</span>';
								}
								?>


							</div>
							<!-- so sánh sản phẩm -->
							<div class="add-cart">
								<div class="button_details">


								</div>
								<div class="clear"></div>
							</div>
						</div>
						<div class="product-desc">
							<h2>Chi tiết chuyến đi</h2>
							<p><?php echo $result['p_desc'] ?></p>
						</div>
				<?php
				}
			}
				?>
					</div>
					
		</div>
	</div>

	<?php
	include 'inc/footer.php';
	?>

	