<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/product.php';

$pd = new product();

if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    // echo "<script> window.location = 'productlist.php' </script>";
} else {
    $id = $_GET['id']; // Lấy product id trên host
    $deleteProduct = $pd->delete_product($id);
}

?>


<div class="grid_8">
	<div class="box round first grid">
		<h2>Tất cả chuyến đi</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<td>Số thứ tự</td>
						<td>Ngày khởi hành</td>
						<td>Tên chuyến đi</td>
						<td>Mã chuyến đi</td>
						<td>Giá vé</td>
						<td>Số lượng vé</td>
						<td>Hình ảnh</td>
						<td>Trạng thái</td>
					</tr>
				</thead>
				<tbody>
				<?php
						if(isset($deleteProduct)){
							echo $deleteProduct;
						}

						$pd_list = $pd->show_product();
						$i=0;
						if($pd_list){
							while($result = $pd_list->fetch(PDO::FETCH_ASSOC)){
					?>

								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $result['p_date'] ?></td>
									<td><?php echo $result['p_name'] ?></td>
									<td><?php echo $result['p_code'] ?></td>
									<td><?php echo $result['p_price'] ?></td>
									<td><?php echo $result['p_quantity'] ?></td>
									<td><img src="uploads/<?php echo $result['p_img']?>" width="100"></td>
									<td><a href="productedit.php?id=<?php echo $result['p_id'] ?>">Sửa</a> |
										 <a href="?id=<?php echo $result['p_id'] ?>">Xóa</a></td>
								</tr>

					<?php
								$i++;
							}
						}
					?>
					
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>