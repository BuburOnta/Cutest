<?php
session_start();
// session_destroy();
// $_SESSION['sesiLogins'] = "operator@operator";
// var_dump($_SESSION);

$error = [];
$errorKeys = ['keterangan', 'tanggal'];
if (isset($_POST['submit'])) {
    // var_dump($_POST);
    foreach ($errorKeys as $errorKey) { // mengeluarkan semua array
        // menggunakan error key dengan post untuk mengecek apakah input kosong atau tidak, jika kosong maka variabel error diisi dengan masing masing error key
        if (empty(trim($_POST[$errorKey]))) {
            $error[] = $errorKey; // memasukkan key kedalam var error
        } else {
        }
    }

    if (count($error) == 0) {
        if (tambahAbsensi($_POST) > 0) {
            // header("Location: ?page=register_verification");
            $_POST['success'] = "f";
        } else {
            echo mysqli_errno($con);
        }
    }

    // var_dump($_POST);
    // $tgl = $_POST['tanggal'];
    // $tanggal = hari();
    // $tanggal .= ", " . bulan($tgl);
}

?>

<html lang="id">

<head>
    <title></title>
    <link rel="stylesheet" href="assets/css/operator/tambahAbsensi.css">
    <link rel="stylesheet" href="assets/css/succesAnimation.css">
	<style>
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
                window.location.href = "?page=operator";
            }, 4000);
        </script>
    <?php endif; ?>
    <div class="container">

		      <a href="?page=operator" class="keluar">
           		<i class="fa-solid fa-right-to-bracket"></i>
        	</a>
            <h1 class="h1">Absensi</h1>
            <form method="POST" action="">
                <div class="input__group">
                    <?php if (in_array('keterangan', $error)) { ?>
                        <span class='error'>Masukkan format keterangan yang valid</span>
                    <?php } ?>
                    <label for="keterangan">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" placeholder="Ulangan harian... Penilaian tengah semester...">
                </div>


                <div class="input__group">
                    <?php if (in_array('tanggal', $error)) { ?>
                        <span class='error'>Masukkan format tanggal yang valid</span>
                    <?php } ?>
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal">
                </div>

                <div class="input__group">
                    <label for="time">Time</label>
                    <input type="time" name="time" id="time" placeholder="">
                </div>

                <button type="submit" name="submit">Submit</button>
            </form>
    </div>
</body>

</html>