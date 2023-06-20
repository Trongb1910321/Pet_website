<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/staff.php' ?>
 <?php 
    $nv = new nhanvien();
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $nvUser = $_POST['userName'];
        $nvPassword = $_POST['password'];
        $nvName = $_POST['name'];
        $nvEmail = $_POST['email'];
        $nvLevel = $_POST['level'];
        $nvSodienthoai = $_POST['sodienthoai'];
        $nvDiachi = $_POST['diachi'];
        $nvCmnd = $_POST['cmnd'];
        $insertNv = $nv->insert_Nv($nvUser,$nvPassword,$nvName,$nvEmail,$nvLevel,$nvSodienthoai,$nvDiachi,$nvCmnd);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm nhân viên</h2>
                
               <div class="block copyblock">   
               <?php
                if(isset($insertNv)){
                    echo $insertNv;
                }
                ?>
                 <form action="staffadd.php" method="post">
                        <table class="form">					
                            <tr>
                                <td>
                                  <label>User name:</label>
                                </td>
                                <td>
                                    <input type="text" name="userName" placeholder="Làm ơn thêm username..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Password:</label>
                                </td>
                                <td>
                                    <input type="text" name="password" placeholder="Làm ơn thêm mật khẩu..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tên:</label>
                                </td>
                                <td>
                                    <input type="text" name="name" placeholder="Làm ơn thêm Name..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Email:</label>
                                </td>
                                <td>
                                    <input type="text" name="email" placeholder="Làm ơn thêm email..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Level:</label>
                                </td>
                                <td>
                                    <input type="text" name="level" placeholder="Làm ơn thêm level..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Số điện thoại:</label>
                                </td>
                                <td>
                                    <input type="text" name="sodienthoai" placeholder="Làm ơn thêm số điện thoại..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Địa chỉ:</label>
                                </td>
                                <td>
                                    <input type="text" name="diachi" placeholder="Làm ơn thêm địa chỉ..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Căn cước/ CMND:</label>
                                </td>
                                <td>
                                    <input type="text" name="cmnd" placeholder="Làm ơn thêm CMND..." class="medium" />
                                </td>
                            </tr>
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                  </form>
                </div>
            </div>
        </div>
<?php include_once 'inc/footer.php';?>