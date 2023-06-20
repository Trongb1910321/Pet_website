<?php include_once 'inc/header.php'; ?>
<?php include_once 'inc/sidebar.php'; ?>
<?php include_once '../classes/brand.php'; ?>
<?php include_once '../classes/staff.php'; ?>
<?php include_once '../classes/category.php'; ?>
<?php include_once '../classes/product.php'; ?>

<?php
$nv = new nhanvien();

if (!isset($_GET['staffid']) || $_GET['staffid'] == NULL) {
  echo "<script>window.location = 'stafflist.php'</script>";
} else {
  $id = $_GET['staffid'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $updateStaff = $nv->update_staff($_POST, $_FILES, $id);
}
?>

<div class="grid_10">
  <div class="box round first grid">
    <h2>Sửa thông tin nhân viên</h2>
    <div class="block">
      <?php
      if (isset($updateStaff)) {
        echo $updateStaff;
      }
      ?>
      <?php
      $get_staff_by_id = $nv->getstaffbyId($id);
      if ($get_staff_by_id) {
        while ($result_staff = $get_staff_by_id->fetch_assoc()) {

      ?>
          <form action="" method="post" enctype="multipart/form-data">
            <table class="form">

              <tr>
                <td>
                  <label>Tên nhân viên</label>
                </td>
                <td>
                  <input type="text" name="nhanvienName" value="<?php echo $result_staff['nhanvienName'] ?>" class="medium" />
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                  <label>Staff User</label>
                </td>
                <td>
                  <textarea name="nhanvienUser" class="tinymce"><?php echo $result_staff['nhanvienUser'] ?></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Email</label>
                </td>
                <td>
                  <input type="email" value="<?php echo $result_staff['nhanvienEmail'] ?>" name="nhanvienEmail" class="medium" />
                </td>
              </tr>
              <tr>
                <td>
                  <label>ID nhân viên</label>
                </td>
                <td>
                  <input type="TEXT" value="<?php echo $result_staff['nhanvienID'] ?>" name="nhanvienID" class="medium" />
                </td>
              </tr>

              <tr>
                <td>
                  <label>level</label>
                </td>
                <td>
                  <input type="text" value="<?php echo $result_staff['level'] ?>" name="level" class="medium" />

                </td>
              </tr>
              <tr>
                <td>
                  <label>Số điện thoại</label>
                </td>
                <td>
                  <input type="text" value="<?php echo $result_staff['sodienthoai'] ?>" name="sodienthoai" class="medium" />

                </td>
              </tr>
              <tr>
                <td>
                  <label>Đỉa chỉ</label>
                </td>
                <td>
                  <input type="text" value="<?php echo $result_staff['diachi'] ?>" name="diachi" class="medium" />

                </td>
              </tr>
              <tr>
                <td>
                  <label>Căn cước/ CMND</label>
                </td>
                <td>
                  <input type="text" value="<?php echo $result_staff['nhanvienCmnd'] ?>" name="nhanvienCmnd" class="medium" />

                </td>
              </tr>

              <tr>
                <td></td>
                <td>
                  <input type="submit" name="submit" value="Update" />
                </td>
              </tr>
            </table>
          </form>
      <?php
        }
      }
      ?>
    </div>
  </div>
</div>
<!-- Load TinyMCE -->
<!-- <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    setupTinyMCE();
    setDatePicker('date-picker');
    $('input[type="checkbox"]').fancybutton();
    $('input[type="radio"]').fancybutton();
  });
</script> -->
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>