<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>


<?php



class product
{
  private $db;
  private $fm;
  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }
  //them san pham trong admin
  public function insert_product($data, $files)
  {


    $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
    $category = mysqli_real_escape_string($this->db->link, $data['category']);
    $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
    $productdesc = mysqli_real_escape_string($this->db->link, $data['productdesc']);
    $price = mysqli_real_escape_string($this->db->link, $data['price']);
    $type_1 = mysqli_real_escape_string($this->db->link, $data['type_1']);

    // Kiem tre hinh anh va lay hinh anh cho vao folder upload
    $permited = array('jpg', 'jpeg', 'png', 'gif');
    $file_name_1 = $_FILES['image_1']['name'];
    $file_size = $_FILES['image_1']['size'];
    $file_temp = $_FILES['image_1']['tmp_name'];

    $div = explode('.', $file_name_1);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "../admin/uploads/" . $unique_image;

    if ($productName == "" || $category == "" ||  $brand == "" || $productdesc == "" || $price == "" || $type_1 == "" || $file_name_1 == "") {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      move_uploaded_file($file_temp, $uploaded_image);
      $query = "INSERT INTO `tbl_product`( `productName`, `catId`, `brandId`, `productdesc`, `type_1`, `price`, `image_1`) VALUES ('$productName','$category','$brand','$productdesc','$type_1','$price','$unique_image')";
      $result = $this->db->insert($query);
      if ($result) {
        $alert = "<span class='success'>Insert Product Successfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Insert Product Not Successfully</span>";
        return $alert;
      }
    }
  }
  public function show_product()
  {
    $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
        order by tbl_product.productId desc";
    $result = $this->db->select($query);
    return $result;
  }


  public function update_product($data, $files, $id)
  {

    $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
    $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
    $category = mysqli_real_escape_string($this->db->link, $data['category']);
    $productdesc = mysqli_real_escape_string($this->db->link, $data['productdesc']);
    $price = mysqli_real_escape_string($this->db->link, $data['price']);
    $type_1 = mysqli_real_escape_string($this->db->link, $data['type_1']);
    // Kiem tre hinh anh va lay hinh anhcho vao folder upload
    $permited = array('jpg', 'jpeg', 'png', 'gif');
    $file_name_1 = $_FILES['image_1']['name'];
    $file_size = $_FILES['image_1']['size'];
    $file_temp = $_FILES['image_1']['tmp_name'];

    $div = explode('.', $file_name_1);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "../admin/uploads/" . $unique_image;


    if ($productName == "" || $brand == "" || $category == "" ||   $productdesc == "" || $price == "" || $type_1 == "") {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      if ($file_name_1) {
        // neu nguoi dung chon anh
        if ($file_size > 1009600) {
          $alert = "<span class='success'>Image Size should be less hen 2MB!</span>";
          return $alert;
        } else if (in_array($file_ext, $permited) === false) {

          $alert = "<span class='success'>You can upload only:-" . implode(', ', $permited) . "</span>";
          return $alert;
        }
        move_uploaded_file($file_temp, $uploaded_image);
        $query = "UPDATE tbl_product SET 
             productName = '$productName',
             brandId = '$brand',
             catId = '$category',
             type_1 = '$type_1',
             price = '$price',
             image_1 = '$unique_image',
             productdesc = '$productdesc'
             WHERE productId = '$id'";
      } else {
        //neu nguoi dung khong chon anh
        $query = "UPDATE tbl_product SET
             
             productName = '$productName',
             brandId = '$brand',
             catId = '$category',
             type_1 = '$type_1',
             price = '$price',
            
             productdesc = '$productdesc'
             WHERE productId = '$id'";
      }



      $result = $this->db->update($query);
      if ($result) {
        $alert = "<span class='success'>Product Upload Successfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Product Upload Not Successfully</span>";
        return $alert;
      }
    }
  }
  public function del_product($id)
  {
    $query = "DELETE FROM tbl_product WHERE productId = '$id'";
    $result = $this->db->delete($query);
    if ($result) {
      $alert = "<span class='success'>Insert Deleted Successfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Insert Deleted Not Successfully</span>";
      return $alert;
    }
  }
  // xóa sản phẩm yêu thích
  public function del_wlist($proid, $customer_id)
  {
    $query = "DELETE FROM tbl_wishlist WHERE productId = '$proid' AND customer_id = '$customer_id'";
    $result = $this->db->delete($query);
    return $result;
  }
  public function getproductbyId($id)
  {
    $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
    $result = $this->db->select($query);
    return $result;
  }

  // //END Back end
  // SAN PHAM NỔI BẬT
  public function getproduct_feathered()
  {
    $query = "SELECT * FROM tbl_product where type_1 = '1'";
    $result = $this->db->select($query);
    return $result;
  }
  /// SAN PHAM MỚI
  // public function getproduct_new(){
  //   $query = "SELECT * FROM tbl_product order by productId desc LIMIT 4";
  //   $result = $this->db->select($query);
  //   return $result;
  // } 
  //   // show san pham trang sanpham.php
  public function getproduct_binhthuong()
  {
    $query = "SELECT * FROM tbl_product ";
    $result = $this->db->select($query);
    return $result;
  }

  // tim kiem san pham timkiem.php
  public function getproduct_timkiem($search_1)
  {
    $query = "SELECT * from tbl_product where productName like '%$search_1%' or '%search_1' or '$search_1%'";
    $result = $this->db->select($query);
    if (empty($result)) {
      echo "Không có sản phẩm nào như vậy!";
    } else {
      return  $result;
    }
  }

  public function getproduct_new()
  {
    $sp_tungtrang = 4;
    if (!isset($_GET['trang'])) {
      $trang = 1;
    } else {
      $trang = $_GET['trang'];
    }
    $tung_trang = ($trang - 1) * $sp_tungtrang;
    $query = "SELECT * FROM tbl_product order by productId desc LIMIT $tung_trang,$sp_tungtrang ";
    $result = $this->db->select($query);
    return $result;
  }
  public function get_all_product()
  {
    $query = "SELECT * FROM tbl_product ";
    $result = $this->db->select($query);
    return $result;
  }
  public function get_details($id)
  {
    $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
          FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
          INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId where tbl_product.productId = '$id'";
    $result = $this->db->select($query);
    return $result;
  }
  
  // //them sản phẩm yêu thích
  public function get_wishlist($customer_id)
  {
    $query = "SELECT *
          FROM tbl_wishlist INNER JOIN tbl_product ON tbl_wishlist.productId = tbl_product.productId
           WHERE customer_id = '$customer_id' "; //chieu 28 8
    $result = $this->db->select($query);
    return $result;
  }
 
  
  public function insertWishlist($productid, $customer_id)
  {
    $productid = mysqli_real_escape_string($this->db->link, $productid);
    $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

    $check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id = '$customer_id'";
    $result_check_wlist = $this->db->select($check_wlist);
    if ($result_check_wlist) {
      $msg = "<span class='error'>Sản phẩm đã được thêm vào yêu thích</span>";
      return $msg;
    } else {

      $query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
      $result = $this->db->select($query)->fetch_assoc();

      $productName = $result["productName"];
      $price = $result["price"];
      $image_1 = $result["image_1"];


      $query_insert = "INSERT INTO `tbl_wishlist`(`productId`, `customer_id`) VALUES('$productid','$customer_id')";
      $insert_wlist = $this->db->insert($query_insert);
      if ($insert_wlist) {
        $alert = "<span class='success'> Đã thêm vào danh sách yêu thích thành công </span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Thêm vào danh sách yêu thích không thành công</span>";
        return $alert;
      }
    }
  }
  public function addproduct_admin($adminid, $time)
  {

    $query = "UPDATE `tbl_product` SET adminID = '$adminid' where `product_time`='$time'";
    $result = $this->db->update($query);
    if ($result) {
      $msg = "<span class='success'>Update product Successfully</span>";
      return $msg;
    } else {
      $msg = "<span class='error'>Update product Not Successfully</span>";
      return $msg;
    }
  }
}
