<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/session.php');
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>


 
<?php 
	/**
	* 
	*/
	class user
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function change_pass_admin ($data){
			$passold = md5($data['passold']);
			$passnew = md5($data['passnew']); 
			if($passold == "" || $passnew == "")
			{
				$alert = "không được để trống";
				return $alert;
			}
			else {
				$query = "SELECT * FROM tb_admin WHERE ad_password='$passold'";
				$result_check = $this->db->select($query);
				if($result_check==false){
					$alert = "Mât khẩu sai hoặc mục đang để trống,làm ơn nhập lại";
				return $alert;
				}
				$query1 = "UPDATE tb_admin SET ad_password='$passnew' WHERE ad_password ='$passold'";
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