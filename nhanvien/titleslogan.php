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
// Session::set('nhanvienId');
if (isset($_GET['productid'])) {
	$id = $_GET['productid'];
	// $delpro = $pd->del_product($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Thông tin cá nhân</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Họ tên nhân viên</th>
						<th>User</th>
						<th>Email</th>
						<th>ID</th>
						<th>Level</th>
						<th>số diện thoại</th>
						<th>Địa chỉ</th>
						<th>Căn cước/ CMND</th>
						<th>Thay đổi</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$id = Session::get('nhanvienID');
					$nvlist = $nv->show_staff2($id);
					if ($nvlist) {
						$i = 0;
						$result = $nvlist->fetch_assoc();

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
							<td><a href="staffedit.php?staffid=<?php echo $result['nhanvienID'] ?>">Edit</a> </td>
						</tr>
					<?php
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