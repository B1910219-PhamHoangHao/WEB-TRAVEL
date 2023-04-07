<?php
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../lib/session.php');
	Session::checkLogin(); // gọi hàm check login để ktra session
	include_once($filepath.'/../lib/database.php');
	include_once($filepath.'/../helpers/format.php');
?>



<?php 
	/**
	* 
	*/
	class adminlogin
	{
		private $db;
		private $fm; // format
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		//Xử lý phần đăng nhập admin.
		public function login_admin($adminUser,$adminPass){
			//gọi hàm validation từ file Format để ktra tên đăng nhập & mật khẩu có thuộc định dạng đăng nhập k
			$adminUser = $this->fm->validation($adminUser); 
			$adminPass = $this->fm->validation($adminPass);

			$adminUser =  $adminUser;
			$adminPass = $adminPass;
			
			if(empty($adminUser) || empty($adminPass)){
				$alert = "User and Pass không nhập rỗng";
				return $alert;
			}else{
				$query = "SELECT * FROM tb_admin WHERE ad_name = '$adminUser' AND ad_password = '$adminPass' LIMIT 1 ";
				$result = $this->db->select($query);

				if($result != false){
					//session_start();
					// $_SESSION['login'] = 1;
					//$_SESSION['user'] = $user;
					$value = $result->fetch(PDO::FETCH_ASSOC); //POD::FETCH_ASSOC: Trả về dữ liệu dạng mảng với key là tên của column
					Session::set('adminlogin', true); // set adminlogin đã tồn tại chưa
					// gọi function Checklogin để kiểm tra true.
					Session::set('adminId', $value['ad_id']);
					Session::set('adminName', $value['ad_name']);
					Session::set('adminPass', $value['ad_password']);
					header("Location:index.php"); // đi vào trang index.php của admin
				}else {
					$alert = "Tài khoản không đúng";
					return $alert;
				}
			}
		}

		
	}
 ?>