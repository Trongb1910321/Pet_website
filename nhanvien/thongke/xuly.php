<?php
// use Carbon\Carbon;
// use Carbon\CarbonInterval;

// require('../carbon/autoload.php');
// include('config.php');
// $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

// if(isset($_GET['cartId'])){
//     $code_cart = $_GET['cartId'];
//     // $xuly = $_POST['xuly'];
//     $sql_update = mysqli_query($mysqli,"UPDATE tbl_cart SET status_cart = 1 WHERE cartId='$code_cart'");
//     // $sql_update_giaodich = mysqli_query($mysqli,"UPDATE tbl_cart SET status_cart = 0 WHERE cartId='$code_cart'");
//     $query = mysqli_query($mysqli,$sql_update);
//     // $query = mysqli_query($mysqli,$sql_update_giaodich);
     
    
//     // cap nhat thong ke
//      $sql_lietke_dh = "SELECT * FROM tbl_cart, tbl_sanpham WHERE tbl_cart.productId = tbl_product.productId AND tbl_cart.cartId='$code_cart'
//  ORDER BY tbl_cart.cartId DESC";
//     $sql_thongke = "SELECT * FROM tbl_thongke Where ngaydat = '$now";
//     $query_thongke = mysqli_query($mysqli,$sql_thongke);
//     $query_lietke_dh = mysqli($mysqli,$sql_lietkq_dh);
//     $total = 0;
//     $giatien=0:

//     while($row = mysqli_fetch_array($query_lietke_dh)){
//         $total+=$row['quantity'];
//         $giatien += $row['price'];
//     }

//     if(mysqli_num_rows($query_thongke==0)){
//         $soluongban = $total;
//         $doanhthu = $giatien;
//         $donhang = 1;
//         $sql_update_thongke = mysqli_query($mysqli,"INSERT INTO tbl_thongke(ngaydat,soluongban,doanhthu,donhang) VALUE('$now','$soluongnban','$doanhthu','$donhang)");

//     }elseif(mysqli_num_rows($query_thongke)!=0){
//         while($row_tk = mysqli_fetch_array($query_thongke)){
//             $soluongban = $row_tk['soluongban']+$total;
//             $doanhthu = $row_tk['doanhthu']+$giatien;
//             $donhang = $row_tk['donhang']+1;
//             $sql_update_thongke = mysqli_query($mysqli, "UPDATE tbl_thongke SET soluongban='$soluongban',doanhthu='$doanhthu',donhang='$donhang' WHERE ngaydat='$now");

//         }
//     }

//     header('Location:../thongke.php?action=quanlydonhang&query=lietke');
?>