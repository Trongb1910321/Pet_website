<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admincp</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

</head>

<body>
    <h2 style="text-align:center">Welcom to ADminCP</h2>
    <h2 style="text-align:center">Thống kê doanh thu</h2>
    <div>
        <?php include_once 'thongke/dashboard.php'; ?>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.0/classic/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            thongke();
            var char = new Morris.Area({
                element: 'chart',
                xkey: 'date',
                ykeys: ['date', 'order_id', 'sales', 'quantity'],
                labels: ['', 'Đơn hàng', 'Doanh thu', 'Số lượng bán ra']
            });
            $('.select-date').change(function() {
                var thoigian = $(this).val();
                if (thoigian == '7ngay') {
                    var text1 = '7 ngày qua';
                } else if (thoigian == '28ngay') {
                    var text1 = '28 ngày qua';
                } else if (thoigian == '90ngay') {
                    var text1 = '90 ngày qua';
                } else {
                    var text1 = '365 ngày qua';
                }
                $.ajax({
                    url: "thongke/thongke.php",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        thoigian: thoigian
                    },
                    success: function(data) {
                        char.setData(data);
                        $('#text-date').text(text1);
                    }
                });
            });


            function thongke() {
                var text1 = '365 ngày qua';
                $('#text-date').text(text1);
                $.ajax({
                    url: "thongke/thongke.php",
                    method: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        char.setData(data);
                        $('#text-date').text(text1);
                    }
                });
            }

        });
    </script>


</body>