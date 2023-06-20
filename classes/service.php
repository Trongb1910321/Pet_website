<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>


<?php



class service
{
  private $db;
  private $fm;
  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }
  //them san pham trong admin
  public function insert_service($data, $files)
  {


    $serviceName = mysqli_real_escape_string($this->db->link, $data['serviceName']);
    $servicedesc = mysqli_real_escape_string($this->db->link, $data['servicedesc']);
    $price = mysqli_real_escape_string($this->db->link, $data['price']);

    // Kiem tre hinh anh va lay hinh anh cho vao folder upload
    $permited = array('jpg', 'jpeg', 'png', 'gif');
    $file_name_1 = $_FILES['image_1']['name'];
    $file_size = $_FILES['image_1']['size'];
    $file_temp = $_FILES['image_1']['tmp_name'];

    $div = explode('.', $file_name_1);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "../admin/uploads/" . $unique_image;

    if ($serviceName == "" || $servicedesc == "" || $price == "" || $file_name_1 == "") {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      move_uploaded_file($file_temp, $uploaded_image);
      $query = "INSERT INTO `tbl_dichvu`( `name_DV`, `desc_DV`, `price`, `image_1`) VALUES ('$serviceName','$servicedesc','$price','$unique_image')";
      $result = $this->db->insert($query);
      if ($result) {
        $alert = "<span class='success'>Insert Service Successfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Insert Service Not Successfully</span>";
        return $alert;
      }
    }
  }
  public function show_service()
  {
    $query = "SELECT * from tbl_dichvu order by id_DV desc";
    $result = $this->db->select($query);
    return $result;
  }
  public function getservicebyId($id)
  {
    $query = "SELECT * FROM tbl_dichvu WHERE id_DV = '$id'";
    $result = $this->db->select($query);
    return $result;
  }
  public function update_service($data, $files, $id)
  {

    $serviceName = mysqli_real_escape_string($this->db->link, $data['serviceName']);
    $servicedesc = mysqli_real_escape_string($this->db->link, $data['servicedesc']);
    $price = mysqli_real_escape_string($this->db->link, $data['price']);
    // Kiem tre hinh anh va lay hinh anhcho vao folder upload
    $permited = array('jpg', 'jpeg', 'png', 'gif');
    $file_name_1 = $_FILES['image_1']['name'];
    $file_size = $_FILES['image_1']['size'];
    $file_temp = $_FILES['image_1']['tmp_name'];

    $div = explode('.', $file_name_1);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "../admin/uploads/" . $unique_image;


    if ($serviceName == "" ||  $servicedesc == "" || $price == "") {
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
        $query = "UPDATE tbl_dichvu SET 
             name_DV = '$serviceName',
             price = '$price',
             image_1 = '$unique_image',
             desc_DV = '$servicedesc'
             WHERE id_DV = '$id'";
      } else {
        //neu nguoi dung khong chon anh
        $query = "UPDATE tbl_dichvu SET 
            name_DV = '$serviceName',
             price = '$price',
             desc_DV = '$servicedesc'
        WHERE id_DV = '$id'";
      }



      $result = $this->db->update($query);
      if ($result) {
        $alert = "<span class='success'>Service Upload Successfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Service Upload Not Successfully</span>";
        return $alert;
      }
    }
  }
  public function getproduct_binhthuong()
  {
    $query = "SELECT * FROM tbl_dichvu ";
    $result = $this->db->select($query);
    return $result;
  }
  public function del_service($id)
  {
    $query = "DELETE FROM tbl_dichvu WHERE id_DV = '$id'";
    $result = $this->db->delete($query);
    if ($result) {
      $alert = "<span class='success'> Deleted Service Successfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Deleted Service Not Successfully</span>";
      return $alert;
    }
  }
  public function get_details_service($id)
  {
    $query = "SELECT * FROM tbl_dichvu where id_DV = '$id'";
    $result = $this->db->select($query);
    return $result;
  }
}
?>
    