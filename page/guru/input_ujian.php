<?php
session_start();
if(!isset($_SESSION['guru_page_ujian'])){
    header("Location: ?page=guru");
} else {
    $_SESSION['guru_input_jawaban'] = "F";
}

// RESET AUTO INCREMENT
$result = mysqli_query($con, "SELECT * FROM `akses_ujian`");
if (mysqli_num_rows($result) == 0) {
    if (!mysqli_query($con, "ALTER TABLE `akses_ujian` AUTO_INCREMENT = 1")) {
        echo "GAGAL";
    }
}
$result = mysqli_query($con, "SELECT * FROM `daftar_ujian`");
if (mysqli_num_rows($result) == 0) {
    if (!mysqli_query($con, "ALTER TABLE `daftar_ujian` AUTO_INCREMENT = 1")) {
        echo "GAGAL";
    }
}

// ERROR
$error = [];
$values = [];
$errorKeys = ['judul'];
if (isset($_POST['submit'])) {
    // VIRTUAL KEY KELAS
    if (!isset($_POST['kelas'])) {
        $errorKeys[] = 'kelaz';
        $_POST['kelaz'] = "";
    } else {
        $errorKeys[] = "kelaz";
        $_POST['kelaz'] = "f";
    }
    // var_dump($_POST);
    // KELUARIN KEYS
    foreach ($errorKeys as $errorKey) {
        if (empty(trim($_POST[$errorKey]))) {
            $error[] = $errorKey;
        }
    }
    // KEYS FILES
    if (empty(trim($_FILES['files']['name']))) {
        $error[] = "files";
    }

    if (count($error) == 0) {
        if (tambah($_POST) > 0) {
            header("Location: ?page=input_jawaban");
        } else {
            echo mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Ujian</title>
    <link rel="stylesheet" href="assets/css/input_ujian.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <style>
        span.error {
            color: red;
            font-style: italic;
        }
    </style>
</head>

<body>
    <?php include_once $nav; ?>
    <div class="container">
        <form method="POST" action="" class="container" enctype="multipart/form-data">
            <label class="left" for="files">
                <a href="?page=guru" class="keluar">
                    <i class="fa-solid fa-right-to-bracket"></i>
                </a>
                <?php if (in_array('files', $error)) : ?>
                    <span class="error" style="font-weight: normal;">File dibutuhkan!</span>
                <?php endif; ?>
                <?php if (isset($_POST['error'])) : ?>
                    <span class="error"'><?= $_POST['error'] ?></span>
                <?php endif; ?>
                <img src="assets/img/input_ujian_paper.svg">
                <img src="assets/img/input_ujian_plus.svg"  id="plus">
                <span class="tambah">Tambah soal</span>
                <span class="note">Note: File soal harus berbentuk PDF!</span>
            </label>
            <input type="file" name="files" id="files" style="display: none;">


            <div class="right">
                <div class="right_left">
                    <?php if (in_array('judul', $error)) : ?>
                        <span class="error">Masukan judul</span>
                    <?php endif; ?>
                    <div class="form_group judul">
                        <label for="judul">Judul Ujian</label>
                        <input type="text" name="judul" id="judul" autofocus>
                    </div>
                    <button type="submit" name="submit">submit</button>
                </div>


                <div class="right_right">
                    <?php if (in_array('kelaz', $error)) : ?>
                        <span class="error">Pilih Kelas & Jurusan</span>
                    <?php endif; ?>
                    <h3>Kelas Dan jurusan</h3>
                    <div class="select_all">
                        <input type="checkbox" id="select_all" onclick="toggle(this)">
                        <label for="select_all">Select All</label>
                    </div>
                    <!-- <div>P</div> -->
                    <div class="form_group checkbox">
                        <div class="input">X RPL<input type="checkbox" name="kelas[]" id="kelas" value="1"></div>
                        <div class="input">XI RPL<input type="checkbox" name="kelas[]" id="kelas" value="2"></div>
                        <div class="input">XII RPL<input type="checkbox" name="kelas[]" id="kelas" value="3"></div>
                        <div class="input">X PPLG<input type="checkbox" name="kelas[]" id="kelas" value="4"></div>
                        <div class="input">XI PPLG<input type="checkbox" name="kelas[]" id="kelas" value="5"></div>
                        <div class="input">XII PPLG<input type="checkbox" name="kelas[]" id="kelas" value="6"></div>
                        <div class="input">X MM<input type="checkbox" name="kelas[]" id="kelas" value="7"></div>
                        <div class="input">XI MM<input type="checkbox" name="kelas[]" id="kelas" value="8"></div>
                        <div class="input">XII MM<input type="checkbox" name="kelas[]" id="kelas" value="9"></div>
                        <div class="input">X DKV<input type="checkbox" name="kelas[]" id="kelas" value="10"></div>
                        <div class="input">XI DKV<input type="checkbox" name="kelas[]" id="kelas" value="11"></div>
                        <div class="input">XII DKV<input type="checkbox" name="kelas[]" id="kelas" value="12"></div>
                        <div class="input">X TBSM<input type="checkbox" name="kelas[]" id="kelas" value="13"></div>
                        <div class="input">XI TBSM<input type="checkbox" name="kelas[]" id="kelas" value="14"></div>
                        <div class="input">XII TBSM<input type="checkbox" name="kelas[]" id="kelas" value="15"></div>
                        <div class="input">X TKRO<input type="checkbox" name="kelas[]" id="kelas" value="16"></div>
                        <div class="input">XI TKRO<input type="checkbox" name="kelas[]" id="kelas" value="17"></div>
                        <div class="input">XII TKRO<input type="checkbox" name="kelas[]" id="kelas" value="18"></div>
                        <div class="input">X APH<input type="checkbox" name="kelas[]" id="kelas" value="19"></div>
                        <div class="input">XI APH<input type="checkbox" name="kelas[]" id="kelas" value="20"></div>
                        <div class="input">XII APH<input type="checkbox" name="kelas[]" id="kelas" value="21"></div>
                        <div class="input">X AKL<input type="checkbox" name="kelas[]" id="kelas" value="22"></div>
                        <div class="input">XI AKL<input type="checkbox" name="kelas[]" id="kelas" value="23"></div>
                        <div class="input">XII AKL<input type="checkbox" name="kelas[]" id="kelas" value="24"></div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="assets/js/input.js"></script>
</body>

</html>