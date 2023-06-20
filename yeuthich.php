<?php
include_once 'inc/header.php';
// include_once 'inc/slider.php';
?>

<?php
if (isset($_GET['proid'])) {
  $customer_id = Session::get('customer_id');
  $proid = $_GET['proid'];
  $delwlist = $product->del_wlist($proid, $customer_id);
}
?>
<div class="container">

  <h1 style="text-align: center;">Sản phẩm yêu thích</h1>
  <table class="table">


    <thead>
      <tr>
        <th scope="col">ID Compare</th>
        <th scope="col">Product Name</th>
        <th scope="col">Image</th>
        <th scope="col">Price</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $customer_id = Session::get('customer_id');
      $get_wishlist = $product->get_wishlist($customer_id);
      if ($get_wishlist) {
        $i = 0;
        while ($result = $get_wishlist->fetch_assoc()) {
          $i++;
      ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $result['productName'] ?></td>
            <td><img width=150px; src="admin/uploads/<?php echo $result['image_1'] ?>"></td>
            <td><?php echo $fm->format_currency($result['price']) . ' ' . 'VND'; ?></td>


            <td>
              <a href="?proid=<?php echo $result['productId'] ?>">Xóa</a> ||
              <a href="trangchitiet.php?proid=<?php echo $result['productId'] ?>">Mua ngay</a>
            </td>
          </tr>
      <?php
        }
      }
      ?>
    </tbody>
  </table>

</div>



<?php
include_once 'inc/footer.php';

?>