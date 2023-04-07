<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');


?>


 
<?php 
	/**
	* 
	*/
	class cart
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}


		public function add_to_cart($id, $quantity)
		{
			$quantity = $this->fm->validation($quantity);
			$sId = session_id();

			$query = "SELECT * FROM tb_products WHERE p_id = '$id' ";
			$result = $this->db->select($query)->fetch(PDO::FETCH_ASSOC);

			$productName = $result['p_name']; // Lấy tên sp
			$productPrice = $result['p_price']; // Lấy giá sp
			$productImg = $result['p_img']; // Lấy ảnh sp

			$checkcart = "SELECT * FROM tb_cart WHERE c_productID = '$id' AND c_sid = '$sId'";
 				$check_cart = $this->db->select($checkcart);
 				if($check_cart > 0){
 					$alert = "<span>Chuyến đi đã bị trùng trong giỏ của bạn</span>";
 					echo $alert;
 				}
			else
			{
				$query_insert = "INSERT INTO tb_cart SET
					c_productID = '$id',
					c_productQuantity = '$quantity',
					c_productName = '$productName',
					c_productPrice = '$productPrice',
					c_productIMG = '$productImg',
					c_sid = '$sId' ";
				$insert_cart = $this->db->insert($query_insert);
				if($result){
					$alert = "<span>Đã thêm vào giỏ</span>";
					echo $alert;
				}else {
					}
			}
		}

		//Show sản phẩm trong giỏ
		public function get_product_cart()
		{
			$sId = session_id();
			$query = "SELECT * FROM tb_cart WHERE c_sid = '$sId'";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_quantity_Cart($cartId, $quantity)
		{

				$query = "UPDATE tb_cart SET

				c_productQuantity = '$quantity'

				WHERE c_id = '$cartId'";

				$result = $this->db->update($query);
				if ($result) {
					$msg = "<span class='success'> Đã cập nhật thành công</span> ";
					return $msg;
				}else {
					$msg = "<span class='erorr'> Cập nhật không thành công</span> ";
					return $msg;
				}
			

		}
		public function del_product_cart($cartid){
			$query = "DELETE FROM tb_cart WHERE c_productID = '$cartid'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "Đã xóa";
				return $alert;
			}else{
				$alert = "Xóa không thành công";
				return $alert;
			}
		}

		public function check_cart()
		{
			$sId = session_id();
			$query = "SELECT * FROM tb_cart WHERE c_sid = '$sId' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function check_order($customer_id)
		{
			$sId = session_id();
			$query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function del_all_data_cart()
		{
			$sId = session_id();
			$query = "DELETE FROM tb_cart WHERE c_sId = '$sId' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function del_compare($customer_id){
			$sId = session_id();
			$query = "DELETE FROM tbl_compare WHERE customer_id = '$customer_id'";
			$result = $this->db->delete($query);
			return $result;
		}
		public function insertOrder($customer_id)
		{
			$sId = session_id();
			$query = "SELECT * FROM tb_cart WHERE c_sId = '$sId'";
			$get_product = $this->db->select($query);
			if($get_product){
				while($result = $get_product->fetch(PDO::FETCH_ASSOC)){
					$productid = $result['c_productID'];
					$productName = $result['c_productName'];
					$quantity = $result['c_productQuantity'];
					$price = $result['c_productPrice'] * $quantity;
					
					$query_order = "INSERT INTO tb_order(o_productID, o_productName, o_quantity, o_customerID, o_price, o_status) 
									VALUES('$productid','$productName','$quantity','$customer_id', '$price', '1')";
					$insert_order = $this->db->insert($query_order);
				}
				if($insert_order){
					$alert ="<span class='success'> Đặt vé thành công</span> ";
					return $alert;
				} else{
					$alert = "Đặt vé không thành công";
					return $alert;
				}
			}
		}
		public function get_cart_ordered($customer_id)
		{
			$query = "SELECT * FROM tb_order WHERE o_customerID = '$customer_id' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_inbox_cart()
		{
			$query = "SELECT * FROM tb_order";
			$get_inbox_cart = $this->db->select($query);
			return $get_inbox_cart;
		}
		
		public function confirm_order_cus($data)
		{
			$id = $data['orderid'];
			$date = $data['date'];
			$cusid = $data['cusid'];
			$productid = $data['productid'];
			$quantity = $data['quantity'];
			$query = "UPDATE tb_order SET o_status = '2' WHERE o_id = '$id' 
			AND o_date = '$date' AND o_customerID = '$cusid' AND o_productID = '$productid' AND o_quantity = '$quantity' ";

			$result = $this->db->update($query);
		
			if ($result) {
				$alert = "xác nhận thành công";
				return $alert;
			}else {
				$alert = "xác nhận không thành công";
				return $alert;
			}
		}
		public function del_order_cus($data)
		{
			$id = $data['delorderid'];
			$date = $data['date'];
			$cusid = $data['cusid'];
			$productid = $data['productid'];
			$quantity = $data['quantity'];
			$query = "DELETE FROM tb_order  WHERE o_id = '$id' 
			AND o_date = '$date' AND o_customerID = '$cusid' AND o_productID = '$productid' AND o_quantity = '$quantity' ";

			$result = $this->db->update($query);
			if ($result) {
				$alert = "<span class='success'> Xóa đơn thành công</span> ";
				return $alert;
			}else {
				$alert = "<span class='erorr'>chưa thành công</span> ";
				return $alert;
			}
		}
		public function confirm_received($data)
		{
			$id = $data['confirmid'];
			$date = $data['date'];
			$cusid = $data['cusid'];
			$productid = $data['productid'];
			$quantity = $data['quantity'];
			$query = "UPDATE tb_order SET o_status = '3' WHERE o_id = '$id' 
			AND o_date = '$date' AND o_customerID = '$cusid' AND o_productID = '$productid' AND o_quantity = '$quantity' ";

			$result = $this->db->update($query);
			if ($result) {
				$alert = "xác nhận thành công";
				return $alert;
			}else {
				$alert = "xác nhận không thành công";
				return $alert;
			}
		}
		public function get_email_customer($cusid)
		{
			$query = "SELECT * FROM customer WHERE cusid = '$cusid' ";
			$get_email_customer = $this->db->select($query);
			return $get_email_customer;
		}
}
 ?>