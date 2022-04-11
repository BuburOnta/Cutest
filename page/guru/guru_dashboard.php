<?php
session_start();

// Cek session
if (!$_SESSION['sesiLogin']) {
    header("Location: ?page=login");
} else if ($_GET['page'] != $_SESSION['role']) {
    header("Location: ?page=" . $_SESSION['role']);
} else {
    // $_SESSION['guru_page_ujian'] = "F";
    // $_SESSION['guru_page_nilai'] = "F";
    // $_SESSION['guru_page_presensi'] = "F";
    $email = $_SESSION['sesiLogin'];
    $users = query("SELECT * FROM guru WHERE email='$email'")[0];
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
    <?php include $nav ?>

    <div class="container">
        <form method="POST" action="" class="container" enctype="multipart/form-data">
            <div class="left">
                <a href="?page=logout" class="keluar">
                    <i class="fa-solid fa-right-to-bracket"></i>
                </a>
                <style>
                    div.container a.keluar {
                        font-size: 30px;
                        color: #fff;
                        position: absolute;
                        left: 30px;
                        top: 20px;
                        transform: rotate(180deg);
                    }

                    div.container a.keluar:hover {
                        color: #121e39;
                    }
                </style>
                <?php if($users['jk'] == 'laki-laki'){
                    $jk = "Mr.";
                } else {$jk = "Mrs.";}?>
                <h1>Halaman <?= $jk ?> <?= $users['nama'] ?></h1>
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
                <a href="?page=raport_guru">
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