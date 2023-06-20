<?php include_once 'inc/header.php'; ?>
<?php include_once 'inc/sidebar.php'; ?>
<?php include_once '../classes/brand.php'; ?>
<?php include_once '../classes/staff.php'; ?>
<?php include_once '../classes/category.php'; ?>
<?php include_once '../classes/product.php'; ?>
<?php include_once '../helpers/format.php'; ?>

<?php
$nv = new nhanvien();
$fm = new Format();
if (isset($_GET['productid'])) {
	$id = $_GET['productid'];
	// $delpro = $pd->del_product($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Staff list</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Tên</th>
						<th>User</th>
						<th>Email</th>
						<th>ID</th>
						<th>Level</th>
						<th>Số diện thoại</th>
						<th>Địa chỉ</th>
						<th>Căn cước/ CMND</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php

					$nvlist = $nv->show_staff();
					if ($nvlist) {
						$i = 0;
						while ($result = $nvlist->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['nhanvienName'] ?></td>
								<td><?php echo $result['nhanvienUser'] ?></td>

								<td><?php echo $result['nhanvienEmail'] ?></td>
								<td><?php echo $result['nhanvienID'] ?></td>
								<td><?php echo $result['level'] ?></td>
								<td><?php echo $result['sodienthoai'] ?></td>
								<td><?php echo $result['diachi'] ?></td>
								<td><?php echo $result['nhanvienCmnd'] ?></td>
								<td><a href="staffedit.php?staffid=<?php echo $result['nhanvienID'] ?>">Edit</a>
									|| <a href="?staffid=<?php echo $result['nhanvienID'] ?>">Delete</a>
								</td>
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