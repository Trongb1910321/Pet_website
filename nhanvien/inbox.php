<?php include_once 'inc/header.php'; ?>
<?php include_once 'inc/sidebar.php'; ?>
<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
$ct = new cart();
$insertThongke = $ct->insertThongke();
if (isset($_GET['shiftid'])) {
	$nhanvienid = Session::get('nhanvienID');
	$order_id = $_GET['shiftid'];
	$time = $_GET['time'];
	$shifted = $ct->shifted($order_id, $time, $nhanvienid);
}
if (isset($_GET['delid'])) {
	$order_id = $_GET['delid'];
	$time = $_GET['time'];

	$shifted = $ct->del_shifted($order_id, $time);
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Quản lý đơn hàng</h2>
		<div class="block">
			<?php
			if (isset($shifted)) {
				echo $shifted;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Thời gia đặt</th>
						<th>Sản phẩm</th>
						<th>Số lượng</th>
						<th>Gía</th>
						<th>ID khách hàng</th>
						<th>Địa chỉ</th>
						<th>Tình trạng</th>
						<th>ID nhân viên</th>
						<th>ID admin</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$ct = new cart();
					$fm = new Format();
					$nhanvienid = Session::get('nhanvienID');
					$get_inbox_cart = $ct->get_inbox_cart();
					if ($get_inbox_cart) {
						$i = 0;
						while ($result = $get_inbox_cart->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gredeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $fm->formatDate($result['date_order']) ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><?php echo $result['quantity'] ?></td>
								<td><?php echo $fm->format_currency($result['price']) . ' ' . 'VND' ?></td>
								<td><?php echo $result['customer_id'] ?></td>
								<td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>">Xem thông tin</a></td>

								<td>
									<?php
									if ($result['status'] == '0') {
									?>
										<a href="?shiftid=<?php echo $result['order_id'] ?>&time=<?php echo $result['date_order'] ?>">Đang xử lý(Pending)</a>
									<?php
									} elseif ($result['status'] == '1') {
									?>
										<?php
										echo 'Đã xử lý(shifting ...)';
										?>
									<?php
									} elseif ($result['status'] == '2') {
									?>
										<a href="?delid=<?php echo $result['order_id'] ?>&time=<?php echo $result['date_order'] ?>">Xóa(remove)</a>
									<?php
									}
									?>

								</td>
								<td>
									<?php
									if ($result['status'] == '1' || $result['status'] == '2') {
										echo $result['nhanvienID'];
									}
									?>
								</td>
								<td>
									<?php
									// if($result['status']=='1'){
									echo $result['adminID'];
									//	}
									?>
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