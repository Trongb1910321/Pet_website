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



class cart
{
  private $db;
  private $fm;
  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }
  //thêm sp vào gio hang
  public function add_to_cart($quantity, $id, $customer_id)
  {
    $quantity =  $this->fm->validation($quantity);
    $quantity = mysqli_real_escape_string($this->db->link, $quantity);
    $id = mysqli_real_escape_string($this->db->link, $id);
    $ssId = session_id();
    $query_insert = "INSERT INTO `tbl_cart`( `productId`, `quantity`, `ssId`,`customer_id`) VALUES ('$id','$quantity','$ssId','$customer_id')";
    $insert_cart = $this->db->insert($query_insert);
    if ($insert_cart) {
      echo '<script>document.location.href = "./donhang.php"</script>';
    } else {
      echo '<script>document.location.href = "./404.php"</script>';
    }
    // }
  }
  // lay san pham vao don hang
  public function get_product_cart()
  {
    $ssId = session_id();
    $query = "SELECT tbl_product.*, tbl_cart.*
    FROM tbl_product INNER JOIN tbl_cart ON tbl_product.productId = tbl_cart.productId
    WHERE ssId = '$ssId' AND status_cart='0'";

    $result = $this->db->select($query);
    return $result;
  }

  public function update_quantity_cart($quantity, $cartId)
  {
    $quantity = mysqli_real_escape_string($this->db->link, $quantity);
    $cartId = mysqli_real_escape_string($this->db->link, $cartId);

    $query = "UPDATE tbl_cart SET 
            quantity = '$quantity'
             WHERE cartId = '$cartId'";
    $result = $this->db->update($query);
    if ($result) {
      $msg = "<span class='success'>Product Quantity Update Successfully</span>";
      return $msg;
    } else {
      $msg = "<span class='error'>Product Quantity Update Not Successfully</span>";
      return $msg;
    }
  }
  public function del_product_cart($cartid)
  {
    $cartid = mysqli_real_escape_string($this->db->link, $cartid);
    $query = "DELETE FROM tbl_cart WHERE cartId = '$cartid'";
    $result = $this->db->delete($query);
    if ($result) {
      echo '<script>document.location.href = "./donhang.php"</script>';
    } else {
      $msg = "<span class='error'>Product Deleted Not Successfully</span>";
      return $msg;
    }
  }

  public function del_all_data_cart()
  {
    $ssId = session_id();
    $query = "DELETE FROM tbl_cart WHERE ssId = '$ssId'";
    $result = $this->db->select($query);
    return $result;
  }

  public function insertOrder()
  {
    $ssId = session_id();
    $query = "SELECT *
     FROM tbl_cart WHERE ssId = '$ssId' AND status_cart='0'";
    $get_product = $this->db->select($query);
    if ($get_product) {
      while ($result = $get_product->fetch_assoc()) { // lấy dư lieu đe truyen
        $cartId = $result['cartId'];
        $query_order = "INSERT INTO `tbl_order` (`cartId`) VALUES ('$cartId')";
        $insert_order = $this->db->insert($query_order);
        $query_upCart_status = "UPDATE `tbl_cart` SET `status_cart`='1' WHERE cartId = '$cartId'";
        $upCart_status = $this->db->update($query_upCart_status);
      }
      return $insert_order;
    }
  }
  //insert thong ke
  public function insertThongke()
  {
    $query = "SELECT * FROM tbl_cart 
  JOIN tbl_product ON tbl_product.productId = tbl_cart.productId 
  JOIN tbl_order ON tbl_order.cartId = tbl_cart.cartId AND tbl_order.status='1' AND tbl_order.order_id not in (select order_id from tbl_thongke where tbl_order.status ='1')";
    $get_product = $this->db->select($query);
    if ($get_product) {
      while ($result = $get_product->fetch_assoc()) { // lấy dư lieu đe truyen
        $ngaydat = $result['date_order'];
        $donhang = $result['order_id'];
        $price = $result['price'];
        $soluongban = $result['quantity'];
        $doanhthu = $price * $soluongban;
        $query_order = "INSERT INTO tbl_thongke (ngaydat,order_id,doanhthu,soluongban) VALUES ('$ngaydat','$donhang','$doanhthu','$soluongban')";
        $insert_order = $this->db->insert($query_order);
        echo 'Update Order Successfully';
      }
      return $insert_order;
    }
  }
  public function getAmountPrice($customer_id)
  {
    $ssId = session_id();
    $query = "SELECT *
      FROM tbl_cart JOIN tbl_product ON tbl_product.productId = tbl_cart.productId 
      JOIN tbl_order ON tbl_order.cartId = tbl_cart.cartId where tbl_cart.customer_id = '$customer_id'";
    $get_price = $this->db->select($query);
    return $get_price;
  }

  public function get_cart_ordered($customer_id)
  {
    $query = "SELECT *
    FROM tbl_cart JOIN tbl_product ON tbl_product.productId = tbl_cart.productId 
    JOIN tbl_order ON tbl_order.cartId = tbl_cart.cartId where tbl_cart.customer_id = '$customer_id'";
    $get_cart_ordered = $this->db->select($query);
    return $get_cart_ordered;
  }

  public function get_inbox_cart()
  {
    $query = "SELECT * FROM tbl_cart 
  JOIN tbl_product ON tbl_product.productId = tbl_cart.productId 
  JOIN tbl_order ON tbl_order.cartId = tbl_cart.cartId ORDER BY date_order";
    $get_inbox_cart = $this->db->select($query);
    return $get_inbox_cart;
  }

  public function shifted($order_id, $time, $nhanvienid)
  {

    $id = mysqli_real_escape_string($this->db->link, $order_id);
    $time = mysqli_real_escape_string($this->db->link, $time);

    $query = "UPDATE `tbl_order` SET `status` = '1', nhanvienID = '$nhanvienid' WHERE order_id='$id' AND `date_order`='$time'";
    $result = $this->db->update($query);
    if ($result) {
      $msg = "<span class='success'>Update Order Successfully</span>";
      return $msg;
    } else {
      $msg = "<span class='error'>Update Order Not Successfully</span>";
      return $msg;
    }
  }
  public function shifted_admin($order_id, $time, $adminid)
  {

    $id = mysqli_real_escape_string($this->db->link, $order_id);
    $time = mysqli_real_escape_string($this->db->link, $time);

    $query = "UPDATE `tbl_order` SET `status` = '1', adminID = '$adminid' WHERE order_id='$id' AND `date_order`='$time'";
    $result = $this->db->update($query);
    if ($result) {
      $msg = "<span class='success'>Update Order Successfully</span>";
      return $msg;
    } else {
      $msg = "<span class='error'>Update Order Not Successfully</span>";
      return $msg;
    }
  }

  public function del_shifted($order_id, $time)
  {
    $id = mysqli_real_escape_string($this->db->link, $order_id);
    $time = mysqli_real_escape_string($this->db->link, $time);
    $query = "DELETE FROM `tbl_order` WHERE order_id='$id' AND `date_order`='$time'";
    $result = $this->db->update($query);
    if ($result) {
      $msg = "<span class='success'>Delete Order Successfully</span>";
      return $msg;
    } else {
      $msg = "<span class='error'>Delete Order Not Successfully</span>";
      return $msg;
    }
  }
  public function shifted_confirm($order_id, $time)
  {
    $id = mysqli_real_escape_string($this->db->link, $order_id);
    $time = mysqli_real_escape_string($this->db->link, $time);
    $query = "UPDATE `tbl_order` SET `status` = '2' WHERE order_id='$id' AND `date_order`='$time' "; //dang lam
    $result = $this->db->update($query);
    return $result;
  }
}
?>