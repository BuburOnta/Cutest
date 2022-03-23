<?php 
session_start();

// Cek session
if (!$_SESSION['sesiLogin']){
    header("Location: ?page=login");
} else if ($_GET['page'] != $_SESSION['role']){
    header("Location: ?page=".$_SESSION['role']);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage Guru</title>
    <link rel="stylesheet" href="assets/css/guru_dashboard.css">
</head>

<body>
    <header class="header">
        <span class="iconify" data-icon="eva:menu-outline"></span>
        <div class="right">
            <span class="tgl">Selasa, 22 Mar 2016</span>
            <div class="profile">
                <img src="assets/img/profile_icon.png">
                <span>Halo, Sutanto</span>
            </div>
        </div>
    </header>

    <nav class="nav">
        <div class="nav-container">
            <h1>PANEL GURU</h1>
            <span class="menu-utama"></span>
            <div class="menu">
                <span class="iconify" data-icon="healthicons:i-exam-multiple-choice-outline"></span>
                <h4>Ujian</h4>
            </div>
            <div class="menu">
                <span class="iconify" data-icon="ic:twotone-credit-score"></span>
                <h4>Cek Nilai</h4>
            </div>
        </div>
    </nav>

    <script src="https://code.iconify.design/2/2.2.0/iconify.min.js"></script>
</body>

</html>