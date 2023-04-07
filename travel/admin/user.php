<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/customer.php';

$cs = new customer(); 

if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    // echo "<script> window.location = 'productlist.php' </script>";
} else {
    $id = $_GET['id']; // Lấy product id trên host
    $deleteuser = $cs->delete_user($id);
}

?>


<div class="grid_8">
	<div class="box round first grid">
		<h2>Danh sách người dùng</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<td>Số thứ tự</td>
						<td>Tên người dùng</td>
						<td>Email</td>
						<td>SĐT</td>
                        <td>Địa chỉ</td>
						<td>Trạng thái</td>
					</tr>
				</thead>
				<tbody>
				<?php
                        

						if(isset($deleteuser)){
							echo $deleteuser;
						}
                        
						$cs_list = $cs->show_user();
						$i=0;
						if($cs_list){
							while($result = $cs_list->fetch(PDO::FETCH_ASSOC)){
					?>

								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $result['c_name'] ?></td>
									<td><?php echo $result['c_email'] ?></td>
									<td><?php echo $result['c_phone'] ?></td>
									<td><?php echo $result['c_address'] ?></td>
									<td><a href="?id=<?php echo $result['c_id'] ?>">Xóa</a></td>
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