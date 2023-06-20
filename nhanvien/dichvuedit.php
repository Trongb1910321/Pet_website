<?php include_once 'inc/header.php'; ?>
<?php include_once 'inc/sidebar.php'; ?>
<?php include_once '../classes/brand.php'; ?>
<?php include_once '../classes/category.php'; ?>
<?php include_once '../classes/service.php'; ?>

<?php
$sv = new service();

if (!isset($_GET['dichvuid']) || $_GET['dichvuid'] == NULL) {
  echo "<script>window.location = 'dichvu_list.php'</script>";
} else {
  $id = $_GET['dichvuid'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $updateService = $sv->update_service($_POST, $_FILES, $id);
}
?>

<div class="grid_10">
  <div class="box round first grid">
    <h2>Sửa dịch vụ</h2>
    <div class="block">
      <?php
      if (isset($updateService)) {
        echo $updateService;
      }
      ?>
      <?php
      $get_service_by_id = $sv->getservicebyId($id);
      if ($get_service_by_id) {
        while ($result_service = $get_service_by_id->fetch_assoc()) {

      ?>
          <form action="" method="post" enctype="multipart/form-data">
            <table class="form">

              <tr>
                <td>
                  <label>Tên dịch vụ</label>
                </td>
                <td>
                  <input type="text" name="serviceName" value="<?php echo $result_service['name_DV'] ?>" class="medium" />
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                  <label>Mô tả</label>
                </td>
                <td>
                  <textarea name="servicedesc" class="tinymce"><?php echo $result_service['desc_DV'] ?></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Gía</label>
                </td>
                <td>
                  <input type="text" value="<?php echo $result_service['price'] ?>" name="price" class="medium" />
                </td>
              </tr>

              <tr>
                <td>
                  <label>Hình ảnh tải lên</label>
                </td>
                <td>
                  <img src="../admin/uploads/<?php echo $result_service['image_1'] ?>" width="90"><br>
                  <input type="file" name="image_1" />
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
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    setupTinyMCE();
    setDatePicker('date-picker');
    $('input[type="checkbox"]').fancybutton();
    $('input[type="radio"]').fancybutton();
  });
</script>
<!-- Load TinyMCE -->
<?php include_once 'inc/footer.php'; ?>