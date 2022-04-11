<?php 
session_start();
$_SESSION['sesiLogins'] = 'operator@operator';
// RESET AUTO INCREMENT
$result = mysqli_query($con, "SELECT * FROM `absensi`");
if (mysqli_num_rows($result) == 0) {
    if (!mysqli_query($con, "ALTER TABLE `absensi` AUTO_INCREMENT = 1")) {
        echo "GAGAL";
    }
}

tambahAbsensi($_SESSION);
// mysqli_query($con, "INSERT INTO absensi SET ")
?>