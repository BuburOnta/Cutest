<?php
session_start();

// Cek session
if (!isset($_SESSION['sesiLogin'])) {
    header("Location: ?page=login");
} elseif ($_GET['page'] != $_SESSION['role']) {
    header("Location: ?page=" . $_SESSION['role']);
} else {
    // $_SESSION['pilih_ujian'] = "f";
    // $_SESSION['presensi'] = "f";
    // $_SESSION['rapor'] = "f";
}
$user = query("SELECT * FROM users WHERE email='$_SESSION[sesiLogin]'")[0];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/murid/dashboard.css">
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

            span.note {
                position: absolute;
                bottom: 10px;
                color: red;
                font-family: "Inter","Poppins", sans-serif;                
                font-size: 12px;
                font-weight: 600;
                background-color: #E2E2E9;
                border-radius: 10px;
                padding: 4px 12px;
            }
    </style>
</head>

<body>
<div class="container">
        <span class="note">Note: harap input absen terlebih dahulu jika tersedia.</span>
        <a href="?page=logout" class="keluar">
            <i class="fa-solid fa-right-to-bracket"></i>
        </a>
        <div class="left">
            <?php if($user['foto_profile'] != '' && $user['foto_profile'] != "NULL"){ ?>
                <img src="assets/profile/<?= $user['foto_profile'] ?>" class="profileIcon">
            <?php }else{ ?>
                <img src="assets/icon/profile.svg ?>" class="profileIcon">
            <?php } ?>
            <div class="profile">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" disabled value="<?=$user['nama']?>">
            </div>
            <!-- <form method="POST" action="" redirect()"> -->
                <button onclick="redirect('?page=profile')">Edit profile</button>
            <!-- </form> -->
        </div>

        <div class="right">
            <a href="?page=pilih_ujian">
                <div class="card">
                    <img src="assets/img/dashboard_ujian.svg">
                    <span>ujian</span>
                </div>
            </a>
            <a href="?page=absensi">
                <div class="card dua">
                    <img src="assets/img/dashboard_presensi.svg">
                    <span>presensi</span>
                </div>
            </a>
            <a href="?page=raport">
                <div class="card">
                    <img src="assets/img/dashboard_raport.svg">
                    <span>rapor</span>
                </div>
            </a>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/redirect.js"></script>
</body>

</html>