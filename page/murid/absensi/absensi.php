<?php
session_start();
$user = query("SELECT * FROM users WHERE email='$_SESSION[sesiLogin]' ")[0];

// Ambil Absensi
if (count($absensi = query("SELECT * FROM absensi WHERE status='aktif'")) == 0) {
    $error = true;
}

// if(count($tes = query("SELECT * FROM akses_absensi WHERE id_murid='$_SESSION[sesiId]' ")) > 0){
//     var_dump($tes);
//     $absensi = [];
//     $error = true;
// }
// echo $absensi['id_murid'];
// if($absensi['id_murid'])

$keterangan = [
    ["keterangan" => "Hadir"],
    ["keterangan" => "Sakit"],
    ["keterangan" => "Izin"]
];
if (!isset($_POST['id_absen'])) {
    $_POST['id_absen'] = "";
}
if (!isset($_POST['keterangan'])) {
    $_POST['keterangan'] = "";
}

if (isset($_POST['submit'])) {
    if (absensiMurid($_POST) > 0) {
        $_POST['success'] = true;
    } else {
        // echo "<script>
        //      alert('Gagal')
        // </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <link rel="stylesheet" href="assets/css/select.css">
    <link rel="stylesheet" href="assets/css/murid/absensi.css">
    <link rel="stylesheet" href="assets/css/error-slide-down.css">
    <link rel="stylesheet" type="text/css" href="assets/css/succesAnimation.css">
    <style>
        .logo {
            position: absolute;
            top: 20px;
            left: 50px;
        }

        div.container a.keluar {
            font-size: 30px;
            color: #fafafa;
            position: absolute;
            left: 25px;
            top: 10px;
            transform: rotate(180deg);
        }

        div.container a.keluar:hover {
            color: #c5c5c5;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="assets/img/cutest_logo_text.svg" onclick="window.location.href = '?page=murid';">
    </div>

    <?php if (isset($_POST['error'])) { ?>
        <div class="error">
            <span><?= $_POST['error'] ?></span>
        </div>
    <?php } ?>

   <?php if (isset($_POST['success'])) : ?>
        <script>
            setTimeout(() => {}, 2000);
        </script>

        <div class="centering">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
        </div>

        <script>
            setTimeout(() => {
                window.location.href = "?page=murid";
            }, 4000);
        </script>
    <?php endif; ?>

    <div class="container">
        <a href="?page=murid" class="keluar">
            <i class="fa-solid fa-right-to-bracket"></i>
        </a>
        <img src="assets/icon/logo.svg" style="width: 39px;height: 39px;">
        <form method="POST" action="" class="form" id="form">
            <input type="hidden" name="id_murid" value="<?= $user['id_user'] ?>">
            <h3>Hari & tanggal</h3>
            <!-- SELECT DROPDOWN -->
            <div class="select-container">
                <div class="select-box">
                    <?php if ($error == false) : ?>
                        <div class="options-container">
                            <?php foreach ($absensi as $absen) { ?>
                                <div class="option">
                                    <input type="radio" class="radio" id="<?= $absen['id_absen'] ?>" name="id_absen" value="<?= $absen['id_absen'] ?>" />
                                    <label for="<?= $absen['id_absen'] ?>" class="select">
                                        <span><?= $absen['tanggal'] ?> | <?= $absen['keterangan'] ?></span>
                                    </label>
                                </div>
                            <?php }; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($error) { ?>
                        <label class="selected">
                            <span>Saat ini tidak ada absensi</span>
                        </label>
                    <?php } else { ?>
                        <label class="selected">
                            <span>Pilih absensi</span>
                            <i class="fa-solid fa-circle-exclamation alertIcon satu"></i>
                        </label>
                    <?php }; ?>
                </div>
                <!-- end select -->
            </div>

            <h3>Keterangan</h3>
            <!-- SELECT DROPDOWN -->
            <div class="select-container">
                <div class="select-box">
                    <?php if ($error == false) : ?>
                        <div class="options-container2">
                            <?php foreach ($keterangan as $ket) { ?>
                                <div class="option2">
                                    <input type="radio" class="radio" id="<?= $ket['keterangan'] ?>" name="keterangan" value="<?= $ket['keterangan'] ?>" />
                                    <label for="<?= $ket['keterangan'] ?>" class="select"><span>
                                            <?= $ket['keterangan'] ?>
                                        </span></label>
                                </div>
                            <?php }; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($error) { ?>
                        <label class="selected2">
                            <span id="keteranganValue">Saat ini tidak ada absensi</span>
                        </label>
                    <?php } else { ?>
                        <label class="selected2">
                            <span id="keteranganValue">Pilih keterangan</span>
                            <i class="fa-solid fa-circle-exclamation alertIcon dua"></i>
                        </label>
                    <?php }; ?>
                </div>
                <!-- end select -->
            </div>

            <h3>Alasan</h3>
            <div class="select-container">
                <input type="text" name="alasan" id="alasan" placeholder="Masukkan alasan">
            </div>

            <button type="submit" name="submit">Submit</button>
        </form>
        <span>Masukkan presensi dengan baik dan benar!</span>
        <span>Presensi mempengaruhi nilai rapor.</span>
    </div>

    <script src="assets/js/select.js"></script>
    <script>
        const alertIcon1 = document.querySelector(".alertIcon.satu")
        const alertIcon2 = document.querySelector(".alertIcon.dua")
        const form = document.getElementById("form")
        const error = [];
        // VALIDASI FORM
        form.addEventListener("submit", (e) => {
            if (selected.innerText == "Pilih absensi") {
                error.push("satu")
                alertIcon1.classList.add("activeAlertIcon")
            } else {error.shift()}
            if (selected2.innerText == "Pilih keterangan") {
                error.push("dua")
                alertIcon2.classList.add("activeAlertIcon")
            } else{error.pop()}
            if (error.length > 0) {
                e.preventDefault()
            }
        })

        function validate() {
            // e.preventDefault();
            // if(selected.innerText == "Pilih absensi"){
            //     alertIcon1.classList.add("activeAlertIcon")
            //     return false
            // }
            // if(selected2.innerText == "Pilih keterangan"){
                // alertIcon2.classList.add("activeAlertIcon")
            //     return false;
            // }
            // return true;
        }



        // Disable `alasan` By Keterangan
        const alasan = document.getElementById("alasan");
        // Set default Input Alasan
        alasan.disabled = true;
        alasan.style.backgroundColor = "#cfcfcf";
        alasan.style.opacity = "0.5";

        // Query check untuk Input Keterangan yang dipilih user
        optionsList2.forEach(o => {
            o.addEventListener("click", () => {
                // console.log(selected2);
                let val = selected2.innerText;
                // console.log(val);
                if (val == 'Izin') {
                    // console.log(alasan);
                    alasan.disabled = false;
                    alasan.style.backgroundColor = "#fafafa";
                    alasan.style.opacity = "1";
                } else {
                    alasan.disabled = true;
                    alasan.style.backgroundColor = "#cfcfcf";
                    alasan.style.opacity = "0.5";
                }
            });
        });
    </script>
</body>

</html>