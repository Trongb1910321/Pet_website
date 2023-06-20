<?php
$mysqli = new mysqli("localhost", "root", "", "web");
if ($mysqli->connect_errno) {
    echo "Ket noi MSQLI loi" . $mysqli->connect_error;
    exit();
}
