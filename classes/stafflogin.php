<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
// include_once('/../lib/session.php');
Session::checkLogin();
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>


<?php
class   stafflogin
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login_staff($staffUser, $staffPass)
    {
        $staffUser = $this->fm->validation($staffUser);
        $staffPass = $this->fm->validation($staffPass);

        $staffUser = mysqli_real_escape_string($this->db->link, $staffUser);
        $staffPass = mysqli_real_escape_string($this->db->link, $staffPass);

        if (empty($staffUser) || empty($staffPass)) {
            $alert = "User and Pass must be not empty";
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_nhanvien WHERE nhanvienUser = '$staffUser' AND nhanvienPass = '$staffPass' LIMIT 1";
            $result = $this->db->select($query);

            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set('stafflogin', true);
                Session::set('nhanvienID', $value['nhanvienID']);
                Session::set('nhanvienUser', $value['nhanvienUser']);
                Session::set('nhanvienName', $value['nhanvienName']);
                echo '<script>document.location.href = "./index.php"</script>';
            } else {
                $alert = "User and Pass not match";
                return $alert;
            }
        }
    }
}

?>