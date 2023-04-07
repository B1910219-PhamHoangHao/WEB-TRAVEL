<?php
include 'inc/header.php';
include 'classes/product.php';
include 'inc/slider.php';
$fm = new Format();
$pd = new product();
$show_product = $pd->show_product();

?>
<style>
	.images_1_of_4 .button a {
		padding: 10px;

		background: #602D8D;
		color: #fff;
	}
</style>
<div class="main row">

	<div class="content">
		<div class="content_top card">
			<div class="heading">
				<h3>Danh sách chuyến đi</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section row">


			<?php
			if (isset($show_product)) {
				while ($result = $show_product->fetch(PDO::FETCH_ASSOC)) {
			?>
					<div class="col-12 col-sm-5 col-md-3 images_1_of_4 card">
						<a href="details.php?proid=<?php echo $result['p_id'] ?>"><img src="admin/uploads/<?php echo $result['p_img'] ?>" /></a>
						<h2><?php echo $result['p_name'] ?></h2>
						<p><?php echo $fm->textShorten($result['p_desc'], 30) ?></p>
                        <p>Ngày khởi hành : <?php echo $result['p_date']?></p>
						<p><span class="price"><?php echo $fm->format_currency($result['p_price']) ?>VND</span></p>
						<div class="button">
							<span class="">
								<a href="details.php?proid=<?php echo $result['p_id'] ?>
								&qty=<?php echo $result['p_quantity'] ?>" class="details">Chi tiết</a>
							</span>
						</div>
					</div>
			<?php
				}
			}
			?>


		</div>

	</div>
	<div class="content">
		<div class="content_top card">
			<div class="heading">
				<h3>Chuyến đi hot nhất</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section row">
			<?php
			$getproduct_soldout_best = $pd->getproduct_soldout_best();
			if (isset($getproduct_soldout_best)) {
				while ($result_sold = $getproduct_soldout_best->fetch(PDO::FETCH_ASSOC)) {
			?>
					<div class="col-12 col-sm-5 col-md-3 images_1_of_4 card">
						<a href="details.php?proid=<?php echo $result_sold['p_id'] ?>"><img src="admin/uploads/<?php echo $result_sold['p_img'] ?>" alt="" /></a>
						<h2><?php echo $result_sold['p_name'] ?></h2>
						<p><?php echo $fm->textShorten($result_sold['p_name'], 30) ?></p>
                        <p>Ngày khởi hành : <?php echo $result_sold['p_date']?></p>
						<p><span class="price"><?php echo $fm->format_currency($result_sold['p_price']) ?>VND</span></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_sold['p_id'] ?>&qty=<?php echo $result_sold['p_quantity'] ?>&sold=<?php echo $result_sold['p_id'] ?>&product_remain=<?php echo $result_sold['p_id'] ?>" class="details">Chi tiết</a></span></div>
					</div>
			<?php
				}
			}
			?>

		</div>

	</div>
</div>
<div class="row">
	<?php
		include 'inc/footer.php';
	?>
</div>