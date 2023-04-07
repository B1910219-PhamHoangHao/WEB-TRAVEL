<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * 
 */
class product
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
 
	public function insert_product($data, $files)
	{
		$productName = $data['productName'];
		$productCode = $data['productCode'];
		$productQuantity = $data['productQuantity'];
		$productDesc = $data['productDesc'];
		$productPrice = $data['productPrice'];
		$productDate = $data['date'];

		
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['productImg']['name'];
		$file_size = $_FILES['productImg']['size'];
		$file_temp = $_FILES['productImg']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
		$uploaded_image = "uploads/" . $unique_image;

		if ($productCode == '' || $productName == "" || $productQuantity == "" || $productDesc == "" || 
			$productPrice == "" || $productDate == "" || $file_name == "") {
			$alert = "<span class='error'>không được để trống</span>";
			return $alert;
		} else {
			move_uploaded_file($file_temp, $uploaded_image);
			$query = "INSERT INTO tb_products(p_name, p_code, p_img, p_price, p_desc, p_quantity, p_date)
					 VALUES('$productName','$productCode','$unique_image','$productPrice','$productDesc', '$productQuantity','$productDate') ";
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

	public function show_slider()
	{
		$query = "SELECT * FROM tbl_slider where productType='1' order by sliderId desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_slider_list()
	{
		$query = "SELECT * FROM tbl_slider order by sliderId desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_product_warehouse()
	{
		$query =
			"SELECT tb_products.*, tb_warehouse.*

			 FROM tb_products INNER JOIN tb_warehouse ON tb_products.p_Id = tb_warehouse.w_productID
								
			 order by tb_warehouse.w_quantity desc ";


		$result = $this->db->select($query);
		return $result;
	}
	public function show_product()
	{
		$query = "SELECT * FROM tb_products ORDER by p_id DESC";
		$result = $this->db->select($query);
		return $result;
		// $query = "UPDATE tb_product SET p_quantity = '' ";
	}

	public function del_slider($id)
	{
		$query = "DELETE FROM tbl_slider where sliderId = '$id' ";
		$result = $this->db->delete($query);
		if ($result) {
			$alert = "<span class='success'>Slider Deleted Successfully</span>";
			return $alert;
		} else {
			$alert = "<span class='success'>Slider Deleted Not Success</span>";
			return $alert;
		}
	}
	public function update_product($data, $files, $id)
	{
		$productName = $data['productName'];
		$productName = $data['productName'];
		$productCode = $data['productCode'];
		$productQuantity = $data['productQuantity'];
		$productDesc = $data['productDesc'];
		$productPrice = $data['productPrice'];
		$productDate = $data['date'];

		// Kiểm tra lấy hình ảnh
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['productImg']['name'];
		$file_size = $_FILES['productImg']['size'];
		$file_temp = $_FILES['productImg']['tmp_name'];
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
		$uploaded_image = "uploads/" . $unique_image;

		if ($productCode == '' || $productName == "" || $productQuantity == "" || $productDesc == "" 
			|| $productPrice == "" || $productDate == "" || $file_name == "") {
			$alert = "<span class='error'>không được để trống</span>";
			return $alert;
		} else {
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "UPDATE tb_products SET 
					p_name ='$productName',
					p_code = '$productCode',
					p_quantity = '$productQuantity',
					p_price = '$productPrice',
					p_desc = '$productDesc',
					p_img = '$unique_image',
					p_date = '$productDate'
					WHERE p_id = '$id' ";
			}
			$result = $this->db->update($query);
			if ($result) {
				$alert = "<span class='success'>Đã cập nhật thành công</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>chưa được cập nhật </span>";
				return $alert;
			}
	}
	public function delete_product($id)
	{
		$query = "DELETE FROM tb_products where p_id = '$id' ";
		$result = $this->db->delete($query);
		if ($result) {
			$alert = "<span class='success'>Xóa sản phẩm thành công</span>";
			return $alert;
		} else {
			$alert = "<span class='success'>Xóa không thành công</span>";
			return $alert;
		}
	}

	public function getProductById($id)
	{
		$query = "SELECT * FROM tb_products where p_id = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}

	//Kết thúc Backend

	public function getproduct_new()
	{
		$query = "SELECT * FROM tb_products order by p_id desc LIMIT 100 ";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_details($id)
	{
		$query =
			"SELECT tb_products.*, tb_cat.catName

			 FROM tb_products INNER JOIN tb_cat ON tbl_product.catId = tb_cat.catId
								
			 WHERE tbl_product.productId = '$id'
			 ";

		$result = $this->db->select($query);
		return $result;
	}
	
	public function update_product_remain($id)
	{
		$query = "SELECT * FROM tb_products WHERE p_id = '$id'";
		$result = $this->db->select($query)->fetch(PDO::FETCH_ASSOC);
		$qty = $result["p_quantity"];
		$sold = $result["p_soldout"];
		$product_remain = $qty - $sold;
		$query_update = "UPDATE tb_products
			 SET p_remain='$product_remain' 
			 WHERE p_id ='$id' ";
		$result_update = $this->db->update($query_update);
	}
	public function show_product_remain($id)
	{
		$query_show = "SELECT * FROM tb_products WHERE p_id = '$id'";
		$result_show = $this->db->select($query_show);
		return $result_show;
	}


	public function search_product($str)
	{
		$query = "SELECT * FROM tb_products WHERE LOWER (p_name) LIKE '%$str%'";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function getproduct_soldout_best()
	{
		$query = "SELECT * FROM tb_products order by p_id desc LIMIT 4 ";
		$result = $this->db->select($query);
		return $result;
	}
}
?>