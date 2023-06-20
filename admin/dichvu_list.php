<?php include_once 'inc/header.php'; ?>
<?php include_once 'inc/sidebar.php'; ?>
<?php include_once '../classes/brand.php'; ?>
<?php include_once '../classes/category.php'; ?>
<?php include_once '../classes/service.php'; ?>
<?php include_once '../classes/product.php'; ?>
<?php include_once '../helpers/format.php'; ?>
<?php
$sv = new service();
$fm = new Format();
if (isset($_GET['dichvuid'])) {
	$id = $_GET['dichvuid'];
	$delsv = $sv->del_service($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách dịch vụ</h2>
		<div class="block">
			<?php
			if (isset($delsv)) {
				echo $delsv;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tên dịch vụ</th>
						<th>Gía</th>
						<th>Hình ành</th>
						<th>Mô tả</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php

					$svlist = $sv->show_service();
					if ($svlist) {
						$i = 0;
						while ($result = $svlist->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['name_DV'] ?></td>
								<td><?php echo $result['price'] ?></td>
								<td><img src="uploads/<?php echo $result['image_1'] ?>" width="80"></td>
								<td><?php
									echo $fm->textShorten($result['desc_DV'], 30) ?></td>



								<td><a href="dichvuedit.php?dichvuid=<?php echo $result['id_DV'] ?>">Edit</a> || <a href="?dichvuid=<?php echo $result['id_DV'] ?>">Delete</a></td>
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