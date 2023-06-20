<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php



class nhanvien
{
  private $db;
  private $fm;
  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }
  public function insert_Nv($nvUser, $nvPassword, $nvName, $nvEmail, $nvLevel, $nvSodienthoai, $nvDiachi, $nvCmnd)
  {

    // $brandName = $this->fm->validation($brandName);
    $nvUser = mysqli_real_escape_string($this->db->link, $nvUser);
    $nvPassword = mysqli_real_escape_string($this->db->link, md5($nvPassword));
    $nvName = mysqli_real_escape_string($this->db->link, $nvName);
    $nvEmail = mysqli_real_escape_string($this->db->link, $nvEmail);
    $nvLevel = mysqli_real_escape_string($this->db->link, $nvLevel);
    $nvAdress = mysqli_real_escape_string($this->db->link, $nvDiachi);
    $nvSodienthoai = mysqli_real_escape_string($this->db->link, $nvSodienthoai);
    $nvCmnd = mysqli_real_escape_string($this->db->link, $nvCmnd);


    if ($nvUser == '' ||  $nvPassword == '' || $nvName == '' || $nvEmail == '' || $nvLevel == '' || $nvAdress == '' || $nvSodienthoai == '' || $nvCmnd == '') {
      $alert = "<span class='error'>Staff must be not empty</span>";
      return $alert;
    } else {
      $query = "INSERT INTO tbl_nhanvien(nhanvienName,nhanvienUser,nhanvienEmail,nhanvienPass,`level`,diachi,sodienthoai,nhanvienCmnd) VALUES('$nvName','$nvUser','$nvEmail','$nvPassword','$nvLevel',' $nvAdress','$nvSodienthoai','$nvCmnd')";
      $result = $this->db->insert($query);
      if ($result) {
        $alert = "<span class='success'>Insert Staff Successfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Insert Staff Not Successfully</span>";
        return $alert;
      }
    }
  }
  public function show_staff()
  {
    $query = "SELECT *
          FROM tbl_nhanvien";
    $result = $this->db->select($query);
    return $result;
  }
  public function update_staff($data, $files, $id)
  {

    $staffName = mysqli_real_escape_string($this->db->link, $data['nhanvienName']);
    $staffUser = mysqli_real_escape_string($this->db->link, $data['nhanvienUser']);
    $staffEmail = mysqli_real_escape_string($this->db->link, $data['nhanvienEmail']);
    $staffLevel = mysqli_real_escape_string($this->db->link, $data['level']);
    $staffID = mysqli_real_escape_string($this->db->link, $data['nhanvienID']);
    $staffAdress = mysqli_real_escape_string($this->db->link,  $data['diachi']);
    $staffSodienthoai = mysqli_real_escape_string($this->db->link,  $data['sodienthoai']);
    $staffCmnd = mysqli_real_escape_string($this->db->link,  $data['nhanvienCmnd']);

    if ($staffName == "" || $staffUser == "" || $staffEmail == "" ||   $staffLevel == "" || $staffID == "" ||  $staffAdress == '' ||  $staffSodienthoai == '' || $staffCmnd == '') {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      $query = "UPDATE tbl_nhanvien SET 
             nhanvienName = '$staffName',
             nhanvienID = '$staffID',
             nhanvienEmail = '$staffEmail',
             `level` = '$staffLevel',
             nhanvienUser = '$staffUser',
              sodienthoai= '$staffSodienthoai',
              diachi = '$staffAdress',
              nhanvienCmnd = '$staffCmnd'
             WHERE nhanvienID = '$id'";
    }



    $result = $this->db->update($query);
    if ($result) {
      $alert = "<span class='success'>Staff Upload Successfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Staff Upload Not Successfully</span>";
      return $alert;
    }
  }
  public function update_staff_1($data, $files, $id)
  {

    $staffName = mysqli_real_escape_string($this->db->link, $data['nhanvienName']);
    $staffUser = mysqli_real_escape_string($this->db->link, $data['nhanvienUser']);
    $staffEmail = mysqli_real_escape_string($this->db->link, $data['nhanvienEmail']);
    $staffAdress = mysqli_real_escape_string($this->db->link,  $data['diachi']);
    $staffSodienthoai = mysqli_real_escape_string($this->db->link,  $data['sodienthoai']);
    $staffCmnd = mysqli_real_escape_string($this->db->link,  $data['nhanvienCmnd']);

    if ($staffName == "" || $staffUser == "" || $staffEmail == "" ||  $staffAdress == '' ||  $staffSodienthoai == '' || $staffCmnd == '') {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      $query = "UPDATE tbl_nhanvien SET 
               nhanvienName = '$staffName',
               nhanvienEmail = '$staffEmail',
               nhanvienUser = '$staffUser',
                sodienthoai= '$staffSodienthoai',
                diachi = '$staffAdress',
                nhanvienCmnd = '$staffCmnd'
               WHERE nhanvienID = '$id'";
    }



    $result = $this->db->update($query);
    if ($result) {
      $alert = "<span class='success'>Staff Upload Successfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Staff Upload Not Successfully</span>";
      return $alert;
    }
  }

  public function getstaffbyId($id)
  {
    $query = "SELECT * FROM tbl_nhanvien WHERE nhanvienID = '$id'";
    $result = $this->db->select($query);
    return $result;
  }
  public function show_staff1($id)
  {
    $query = "SELECT * FROM tbl_nhanvien WHERE nhanvienID = '$id'"; //do doi ten cot id thanh customer_id
    $result = $this->db->select($query);
    return $result;
  }
  public function show_staff2($id)
  {
    $query = "SELECT * FROM tbl_nhanvien WHERE nhanvienID = '$id'"; //do doi ten cot id thanh customer_id
    $result = $this->db->select($query);
    return $result;
  }
}
