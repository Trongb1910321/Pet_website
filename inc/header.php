<!doctype html>
<html lang="en">
<?php
include_once 'lib/session.php';
Session::init();
?>
<?php
include_once 'lib/database.php';
include_once 'helpers/format.php';

spl_autoload_register(function ($className) {
    include_once "classes/" . $className . ".php";
});

$db = new Database();
$fm = new Format();
$ct = new cart();
$cat = new category();
$cs = new customer();
$product = new product();
$sv = new service();
?>

<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
</head>




<body>


    <header>
        <div class="menu container-fluid">
            <nav class="navbar navbar-expand-lg nav">
                <div class="container-fluid thanhtren">
                    <img src="images/logo/logo_real.png" style="width: 150px; heigh: 200px;" alt="" id="logo">
                    <a class="navbar-brand" href="trangchu.php" style="color: #357C3C ; font-weight: bold;"><i class="fa-solid fa-house-chimney" style="color: #357C3Cd ;"></i>&ensp;Trang chủ</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="sanpham.php" style="color: #357C3C ; font-weight: bold;"><i class="fa-solid fa-dog"></i>&ensp;Sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="dichvu.php" style="color: #357C3C ; font-weight: bold;"><i class="fa-solid fa-clock-rotate-left"></i>&ensp;Dịch vụ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="chitietdonhang.php" //chua ro lam style="color: #357C3C ; font-weight: bold;"><i class="fa-solid fa-cart-arrow-down"></i>&ensp; Đơn hàng đã dặt
                                </a>
                            </li>
                            <?php
                            $login_check = Session::get('customer_login');
                            if ($login_check == false) {
                                echo '';
                            } else {
                                echo '<li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="profile.php"
                                        style="color: #357C3C ; font-weight: bold;"><i
                                            class="fa-solid fa-right-to-bracket"></i>&ensp;Thông tin cá nhân
                                    </a>
                                </li>';
                            }
                            ?>
                            <?php
                            $login_check = Session::get('customer_login');
                            if ($login_check) {
                                // echo '<a href="yeuthich.php">Sản phẩm yêu thích</a>';
                                echo '<li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="yeuthich.php"
                                        style="color: #357C3C ; font-weight: bold;"><i
                                        class="fa-solid fa-heart"></i>&ensp;Sản phẩm yêu thích
                                    </a>';
                            }
                            ?>



                        </ul>
                        <form class="d-flex" role="search" method="POST" action='timkiem.php'>
                            <input class="form-control me-2" type="text" placeholder="Search" name="search">
                            <button class="btn btn-outline-success" type="submit" name='submit'>Search</button>
                            <!-- <button onclick="click_cart();" class="fas fa-shopping-cart cart1"></button> -->
                        </form>
                        <a href="donhang.php">
                            <button type="button" class="btn btn-primary" style="margin-left: 10px;"> <i class="fa-solid fa-cart-arrow-down"></i></button>
                        </a> <?php
                                if (isset($_GET['customer_id'])) {
                                    Session::destroy_1();
                                }
                                ?>
                        <?php
                        $login_check = Session::get('customer_login');
                        if ($login_check == false) {
                            echo '<a href="dangnhap.php"><button class="btn btn-outline-success " style="color:blue; padding: 5px; margin: 5px;" >Login</button></a>';
                        } else {
                            echo '<a  href="?customer_id=' . Session::get('customer_id') . '"><button class="btn btn-outline-success " style="color:blue; padding: 5px; margin: 5px;" >Logout</button></a>';
                        }

                        ?>
                    </div>
                </div>
            </nav>

        </div>






    </header>