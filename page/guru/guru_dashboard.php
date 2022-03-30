<?php 
session_start();

// Cek session
if (!$_SESSION['sesiLogin']) {
    header("Location: ?page=login");
} else if ($_GET['page'] != $_SESSION['role']) {
    header("Location: ?page=".$_SESSION['role']);
} else {
    $_SESSION['guru_page_ujian'] = "F";
    $_SESSION['guru_page_nilai'] = "F";
    $_SESSION['guru_page_presensi'] = "F";
}
// unset($_SESSION['guru_page_ujian']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <link rel="stylesheet" href="assets/css/guru_dashboard.css">
</head>

<body>
    <?php include "page/guru/nav.php" ?>

    <div class="container">
        <form method="POST" action="" class="container" enctype="multipart/form-data">
            <div class="left">
                <h1>Halaman Mrs. Adul</h1>
                <img src="assets/img/guru_dashboard_left.svg">
            </div>

            <div class="right">
                <a href="?page=input_ujian">
                    <div class="card">
                        <img src="assets/img/guru_right_ujian.svg">
                        <h4>Tambah soal ujian dan jawaban</h4>
                        <span class="panah"><i class="fa-solid fa-angle-right"></i></span>
                    </div>
                </a>
                <a href="">
                    <div class="card">
                        <img src="assets/img/guru_right_nilai.svg">
                        <h4>Input nilai hasil ujian disini!</h4>
                        <span class="panah"><i class="fa-solid fa-angle-right"></i></span>
                    </div>
                </a>
                <a href="">
                    <div class="card">
                        <img src="assets/img/guru_right_presensi.svg">
                        <h4>Rekap laporan presensi disini!</h4>
                        <span class="panah"><i class="fa-solid fa-angle-right"></i></span>
                    </div>
                </a>
            </div>
    </div>
</body>

</html>