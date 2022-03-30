<?php
session_start();

// Cek session
if (!isset($_SESSION['sesiLogin'])) {
    header("Location: ?page=login");
} else if ($_GET['page'] != $_SESSION['role']) {
    header("Location: ?page=".$_SESSION['role']);
} else {
    $_SESSION['pilih_ujian'] = "f";
    $_SESSION['presensi'] = "f";
    $_SESSION['rapor'] = "f";
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>
    <div class="container">
        <div class="left">
            <a href="?page=pilih_ujian">
                <div class="card">
                    <img src="assets/img/dashboard_ujian.svg">
                    <span>ujian</span>
                </div>
            </a>
            <a href="">
                <div class="card dua">
                    <img src="assets/img/dashboard_presensi.svg">
                    <span>presensi</span>
                </div>
            </a>
            <a href="">
                <div class="card">
                    <img src="assets/img/dashboard_raport.svg">
                    <span>rapor</span>
                </div>
            </a>
        </div>

        <div class="right">
            <img src="assets/img/sitting man_right_dashboard.svg">
        </div>
    </div>
<script src="assets/js/script.js"></script>
</body>

</html>