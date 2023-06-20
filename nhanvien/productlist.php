<?php include_once 'inc/header.php'; ?>
<?php include_once 'inc/sidebar.php'; ?>
<?php include_once '../classes/brand.php'; ?>
<?php include_once '../classes/category.php'; ?>
<?php include_once '../classes/product.php'; ?>
<?php include_once '../helpers/format.php'; ?>
<?php
$pd = new product();
$fm = new Format();
if (isset($_GET['productid'])) {
	$id = $_GET['productid'];
	$delpro = $pd->del_product($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách sản phẩm</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tên sản phẩm</th>
						<th>Gía</th>
						<th>Hình ảnh</th>
						<th>Danh mục</th>
						<th>Thương hiệu</th>
						<th>Mô tả</th>
						<th>Loại</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php

					$pdlist = $pd->show_product();
					if ($pdlist) {
						$i = 0;
						while ($result = $pdlist->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><?php echo $result['price'] ?></td>
								<td><img src="../admin/uploads/<?php echo $result['image_1'] ?>" width="80"></td>
								<td><?php echo $result['catName'] ?></td>
								<td><?php echo $result['brandName'] ?></td>
								<td><?php
									echo $fm->textShorten($result['productdesc'], 30) ?></td>


								<td><?php
									if ($result['type_1'] == 1) {
										echo 'Feathered';
									} else {
										echo 'Non-Feathered';
									}
									?>
								</td>
								<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Edit</a> || <a href="?productid=<?php echo $result['productId'] ?>">Delete</a></td>
							</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include_once 'inc/footer.php'; ?>