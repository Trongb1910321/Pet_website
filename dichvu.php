<?php
include_once 'inc/header.php';
include_once 'inc/slider.php';
?>

<div class="container">

  <div class="content">
    <h2 style="text-align: center">Dịch vụ</h2>
    <div class="row mt-3 mb-3">

    </div>
    <div class="row">
      <?php
      $service_binhthuong = $sv->getproduct_binhthuong();
      if ($service_binhthuong) {
        while ($result = $service_binhthuong->fetch_assoc()) {

      ?>

          <div class="col-12 col-sm-6 col-md-4  image">
            <a href="chitietdichvu.php?dichvuid=<?php echo $result['id_DV'] ?>">
              <img class="d-block w-100" style="border-radius:15px;" src="admin/uploads/<?php echo $result['image_1'] ?>" alt="" />
            </a>
            <h2><?php echo $result['name_DV'] ?></h2>
            <p><?php echo $fm->textShorten($result['desc_DV'], 20) ?></p>
            <p><span><?php echo $fm->format_currency($result['price']) . ' ' . 'VND' ?></span></p>
          </div>
      <?php
        }
      }
      ?>

    </div>
  </div>
</div>


<?php
include_once 'inc/footer.php';

?>