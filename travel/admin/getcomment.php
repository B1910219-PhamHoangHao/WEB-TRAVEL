<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/customer.php';  ?>


<?php require_once '../helpers/format.php'; ?>
<?php 
	$cs = new customer();
	$fm = new Format();
	if(!isset($_GET['cusid']) || $_GET['cusid'] == NULL){
        // echo "<script> window.location = 'catlist.php' </script>";
        
    }else {
        $id = $_GET['cusid']; // Lấy catid trên host
      // hàm check delete Name khi submit lên
        $del_comment = $cs -> del_comment($id);
    }
 ?>
<div class="grid_8">
	<div class="box round first grid">
		<h2>Quản lý bình luận</h2>      
		<div class="block"> 
			<form action="getcomment.php" method="post">
				<table class="form">					
					<thead>
						<tr>
							<td>STT</td>
							<td>Tên khách hàng</td>
							<td>Email</td>
							<td>Điện thoại</td>
							<td>Bình luận</td>
							<td>Xử lý</td>
						</tr>
					</thead>

					<tbody>
						<?php 
				
				$get_comment = $cs->get_comment();
				$i = 0;
				
				
					if($get_comment){
					
							while ($result = $get_comment->fetch(PDO::FETCH_ASSOC)){
								$i++;
				 ?>
				 <tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['cmt_name'] ?></td>
					<td><?php echo $result['cmt_email'] ?></td>
					<td><?php echo $result['cmt_phone'] ?></td>
					<td><?php echo $result['cmt_comment'] ?></td>
					<td><a href="?cusid=<?php echo $result['cmt_id']?>">Xóa</a></td>
				</tr>
				 <?php
				}
			}?>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
<?php include 'inc/footer.php';?>