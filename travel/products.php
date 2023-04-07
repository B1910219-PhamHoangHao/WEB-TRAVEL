<?php 
	include 'inc/header.php';

	$product = new product();
	$fm = new Format();
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
    	<div class="content_top">
    		<div class="heading">
    		<h3>Danh sách chuyến đi </h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section row">

				<?php 
	      	$productbynew = $product->getproduct_new();
	      	if ($productbynew){
	      		while ($result = $productbynew->fetch(PDO::FETCH_ASSOC)){
	      			?>
				<div class="col-12 col-sm-5 col-md-3 images_1_of_4 card">
					 <a href="details.php?proid=<?php echo $result['p_id']?>"><img src="admin/uploads/<?php echo $result['p_img'] ?>" alt="" /></a>
					 <h2><?php echo $result['p_name']?></h2>
					 <p><?php echo $fm->textShorten($result['p_desc'],30)?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['p_price'])?>VND</span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['p_id']?>&qty=<?php echo $result['p_quantity']?>&sold=<?php echo $result['p_soldout']?>" class="details">Chi tiết</a></span></div>
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


