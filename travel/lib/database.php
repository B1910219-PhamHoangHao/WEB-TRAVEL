<?php
$filepath = realpath(dirname(__FILE__));
include($filepath . '/../config/config.php');

class Database extends PDO
{
  public $host   = DB_HOST;
  public $dbname = DB_NAME;
  public $user   = DB_USER;
  public $pass   = DB_PASS;

  public $link;
  public $error;

  public function __construct()
  {
    $this->connectDB();
  }

  private function connectDB()
  {
    try {
      $this->link = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4", $this->user, $this->pass);
      // $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Lỗi! Không thể truy cập database";
        exit();
        // file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        //  $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return false;
    }
  }

  // Select or Read data
  public function select($query)
  {
    $result = $this->link->query($query) or
      die($this->link->error . __LINE__);
    if ($result->rowCount() > 0) {
      return $result;
    } else {
      return false;
    }
  }

  // Insert data
  public function insert($query)
  {
    $insert_row = $this->link->query($query);
    if ($insert_row) {
      return $insert_row;
    } else {
      return false;
    }
  }

  // Update data
  public function update($query)
  {
    $update_row = $this->link->query($query);
    if ($update_row) {
      return $update_row;
    } else {
      return false;
    }
  }

  // Delete data
  public function delete($query)
  {
    $delete_row = $this->link->query($query);
    if ($delete_row) {
      return $delete_row;
    } else {
      return false;
    }
  }
}
