<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>


 
<?php 
	/**
	* 
	*/
	class customer
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_customer($data)
		{
			$this->db->link->prepare("SELECT * FROM tb_customer");
			$name = $data['name'];
			$email = $data['email'];
			// $address = $data['address'];
			$phone = $data['phone'];
			$password = md5($data['password']);

			if($name == "" || $email == "" || $phone == "" || $password == ""){
				$alert = "<span class='error'>không được để trống</span>";
				return $alert;
			}else{
				$check_email = "SELECT * FROM tb_customer WHERE c_email='$email' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if ($result_check) {
					$alert = "<span class='error'>email đã tồn tại </span>";
					return $alert;
				}else {
					$query = "INSERT INTO tb_customer(c_name, c_email, c_phone, c_password) 
							VALUES ('$name', '$email', '$phone','$password')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Tạo tài khoản thành công</span>";
						return $alert;
					}else {
						$alert = "<span class='error'>Tạo không thành công</span>";
						return $alert;
					}
				}
			}
		}
		public function login_customer($data)
		{
			$this->db->link->prepare("SELECT * FROM tb_customer");
			$email = $data['email'];
			$password = md5($data['password']);

			if($email == '' || $password == ''){
				$alert = "<span class='error'>không được để trống</span>";
				return $alert;
			}else{
				$check_login = "SELECT * FROM tb_customer WHERE c_email='$email' AND c_password='$password'";
				$result_check = $this->db->select($check_login);
				if ($result_check != false) {
					$value = $result_check->fetch(PDO::FETCH_ASSOC);
					Session::set('customer_login', true);
					Session::set('customer_id', $value['c_id']);
					Session::set('customer_name', $value['c_name']);
					header('Location:index.php');
				}else {
					$alert = "<span class='error'>Tài khoản hoặc mật khẩu không đúng</span>";
					return $alert;
				}
			}
		}

		public function update_customers($data, $id)
		{
			$name = $data['name'];
			$email = $data['email'];
			$address = $data['address'];
			$phone = $data['phone'];
			
			if($name=="" || $email=="" || $address=="" || $phone ==""){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE tb_customer SET 
				c_name='$name', 
				c_email='$email',
				c_address='$address',
				c_phone='$phone' WHERE c_id ='$id'";
				$result = $this->db->insert($query);
				if($result){
						$alert = "<span class='success'>Đã cập nhật thành công</span>";
						return $alert;
				}else{
						$alert = "<span class='error'>Cập nhật không thành công</span>";
						return $alert;
				}
				
			}
		}

		public function insert_comment_customer ($data,$id){
			$name = $data['name'];
			$email = $data['email'];
			$phone = $data['phone'];
			$comment = $data['comment'];
			if($name == "" || $email == "" || $phone == "" || $comment == ""){
				$alert = "<span class='error'>không được để trống</span>";
				return $alert;
			}
			else
			{ 
				$query = "INSERT INTO tb_comment(cmt_id, cmt_name, cmt_email, cmt_phone, cmt_comment) VALUES ('$id','$name','$email','$phone','$comment') ";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Đã gửi bình luận của bạn đến admin</span>";
						return $alert;
					}else {
						$alert = "<span class='error'>chưa gửi thành công</span>";
						return $alert;
					}
		}
	}
		public function get_comment()
		{
			$query = "SELECT * FROM tb_comment ";
			$result = $this->db->select($query);
			return $result;
		}
		public function del_comment($id)
		{
			$query = "DELETE FROM tb_comment where cmt_id = '$id' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Đã xóa</span>";
				return $alert;
			}else {
				$alert = "<span class='success'>xóa không thành công</span>";
				return $alert;
			}
		}

		public function get_info_customer($cusid){
			$query = "SELECT * FROM tb_customer WHERE c_id='$cusid' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_user()
		{
			$query = "SELECT * FROM tb_customer ORDER by c_id DESC";
			$result = $this->db->select($query);
			return $result;	
		}
		
		public function insert_user($data)
	{
		$userName = $data['userName'];
		$userEmail = $data['userEmail'];
		$userPhone = $data['userPhone'];
		$userAddress = $data['userAddress'];
		$userPassword = md5($data['userPassword']);


		if ($userName == '' || $userEmail == "" || $userPhone == "" || $userAddress == "" || $userPassword == "") {
			$alert = "<span class='error'>không được để trống</span>";
			return $alert;
		} else {
			$query = "INSERT INTO tb_customer(c_name, c_email, c_phone, c_address, c_password)
					 VALUES('$userName','$userEmail','$userPhone','$userAddress','$userPassword') ";
			$result = $this->db->insert($query);
			if ($result) {
				$alert = "<span class='success'>đã được thêm thành công</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>thêm không thành công</span>";
				return $alert;
			}
		}
	}
	public function getuserId($id)
	{
		$query = "SELECT * FROM tb_customer where c_id = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	// public function update_user($data, $id)
	// {
	// 	$userName = $data['userName'];
	// 	$userEmail = $data['userEmail'];
	// 	$userPhone = $data['userPhone'];
	// 	$userAddress = $data['userAddress'];
		
	// 	if ($userName == '' || $userEmail == "" || $userPhone == "" || $userAddress == "") {
	// 		$alert = "<span class='error'>không được để trống</span>";
	// 		return $alert;
	// 	} else {
	// 		$query = "UPDATE tb_customer SET 
	// 				c_name ='$userName',
	// 				c_email = '$userEmail',
	// 				c_phone = '$userPhone',
	// 				c_address = '$userAddress' 
	// 				WHERE c_id = '$id' ";

	// 		$result = $this->db->update($query);
			
	// 		if ($result) {
	// 			$alert = "<span class='success'>Đã cập nhật thành công</span>";
	// 			return $alert;
	// 		} else {
	// 			$alert = "<span class='error'>chưa được cập nhật </span>";
	// 			return $alert;
	// 		}
	// 	}
	// }

	public function delete_user($id)
	{
		$query = "DELETE FROM tb_customer where c_id = '$id' ";
		$result = $this->db->delete($query);
		if ($result) {
			$alert = "<span class='success'>Xóa tài khoản thành công</span>";
			return $alert;
		} else {
			$alert = "<span class='success'>Xóa tài khoản không thành công</span>";
			return $alert;
		}
	}

	public function change_pass_customer ($data){
		$passold = md5($data['passold']);
		$passnew = md5($data['passnew']); 
		if($passold == "" || $passnew == "")
		{
			$alert = "không được để trống";
			return $alert;
		}
		else {
			$query = "SELECT * FROM tb_customer WHERE c_password='$passold'";
			$result_check = $this->db->select($query);
			if($result_check==false){
				$alert = "Mât khẩu sai hoặc mục đang để trống,làm ơn nhập lại";
			return $alert;
			}
			$query1 = "UPDATE tb_customer SET c_password='$passnew' WHERE c_password ='$passold'";
			$result = $this->db->insert($query1);
			if($result){
					$alert = "<span class='success'>Đã cập nhật thành công</span>";
					return $alert;
			}else{
					$alert = "<span class='error'>Cập nhật không thành công</span>";
					return $alert;
			}
		}
}
	}
 ?>