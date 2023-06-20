<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');


?>

<style>
  .success {
    font-size: 18px;
    color: green !important;
  }

  .error {
    font-size: 18px;
    color: red !important;
  }
</style>


<?php



class customer
{
  private $db;
  private $fm;
  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }
  public function insert_binhluan()
  {
    $product_id = $_POST['product_id_binhluan'];

    $tenbinhluan = $_POST['tennguoibinhluan'];

    $binhluan = $_POST['binhluan'];

    if ($tenbinhluan == '' || $binhluan == '') {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      $query = "INSERT INTO `tbl_binhluan`(`tenbinhluan`,`binhluan`,`productId`) VALUES('$tenbinhluan','$binhluan','$product_id')";
      $result = $this->db->insert($query);
      if ($result) {
        $alert = "<span class='success'>Bình luận sẽ được admin kiểm duyêt</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Bình luận không thành công</span>";
        return $alert;
      }
    }
  }


  // dang ki
  public function insert_customers($data)
  {
    $name = mysqli_real_escape_string($this->db->link, $data['name']);
    $email = mysqli_real_escape_string($this->db->link, $data['email']);
    $password_1 = mysqli_real_escape_string($this->db->link, md5($data['password_1']));
    $diachi = mysqli_real_escape_string($this->db->link, $data['diachi']);
    $sodienthoai = mysqli_real_escape_string($this->db->link, $data['sodienthoai']);
    if ($name == '' || $email == '' ||  $password_1 == '' || $diachi == '' || $sodienthoai == '') {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      $check_email = "SELECT * FROM tbl_customer where email='$email' LIMIT 1";
      $result_check = $this->db->select($check_email);
      if ($result_check) {
        $alert = "<span class='error'>Email Already Existed</span>";
        return $alert;
      } else {
        $query = "INSERT INTO `tbl_customer`( `name`, `email`, `password_1`, `sodienthoai`, `diachi`) VALUES ('$name','$email','$password_1','$sodienthoai','$diachi')";
        $result = $this->db->insert($query);
        if ($result) {
          $alert = "<span class='success'>Customer Creates Successfully</span>";
          return $alert;
        } else {
          $alert = "<span class='error'>Customer Creates Not Successfully</span>";
          return $alert;
        }
      }
    }
  }

  //dang nhap
  public function login_customers($data)
  {
    $email = mysqli_real_escape_string($this->db->link, $data['email']);
    $password_1 = mysqli_real_escape_string($this->db->link, md5($data['password_1']));
    if ($email == '' ||  $password_1 == '') {
      $alert = "<span class='error'>Password and Email must be not empty</span>";
      return $alert;
    } else {
      $check_login = "SELECT * FROM tbl_customer where email='$email' AND password_1='$password_1'";
      $result_check = $this->db->select($check_login);
      if ($result_check) {
        $value = $result_check->fetch_assoc();
        Session::set('customer_login', true);
        Session::set('customer_id', $value['customer_id']); //bien 1 tu dat ten, bien 2 là database(cot)
        Session::set('customer_name', $value['name']);
        echo '<script>document.location.href = "./trangchu.php"</script>';
      } else {
        $alert = "<span class='error'>Email or Password doesn't match</span>";
        return $alert;
      }
    }
    // Session::destroy();
  }
  //cap nhat thong tin khach hang
  public function show_customers($id)
  {
    $query = "SELECT * FROM tbl_customer WHERE customer_id = '$id'"; //do doi ten cot id thanh customer_id
    $result = $this->db->select($query);
    return $result;
  }
  public function update_customers($data, $id)
  {
    $name = mysqli_real_escape_string($this->db->link, $data['name']);
    $email = mysqli_real_escape_string($this->db->link, $data['email']);
    $sodienthoai = mysqli_real_escape_string($this->db->link, $data['sodienthoai']);
    $diachi = mysqli_real_escape_string($this->db->link, $data['diachi']);
    if ($name == '' || $email == '' || $diachi == '' || $sodienthoai == '') {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      $query = "UPDATE `tbl_customer` SET `name`='$name' , `email`='$email',`sodienthoai`='$sodienthoai' , `diachi`='$diachi' WHERE customer_id='$id'"; //doi tencot tu id thanh cutomer_id 
      $result = $this->db->insert($query);
      if ($result) {
        $alert = "<span class='success'>Customer Creates Successfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Customer Creates Not Successfully</span>";
        return $alert;
      }
    }
  }
  public function show_binhluan($id)
  {
    $query = "SELECT * FROM `tbl_binhluan` WHERE productId = '$id'";
    $result = $this->db->select($query);
    return $result;
  }
}
?>