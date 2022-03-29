<?php
session_start();

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
    }else {
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
    if(empty(trim($_FILES['files']['name']))){
        $error[] = "files";
    }
    
    if (count($error) == 0) {
        if (tambah($_POST) > 0) {
            echo "SUKSES";
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
    <title>Tambah Ujian</title>

    <style>
        span.error {
            color: red;
            font-style: italic;
        }
    </style>
</head>

<body>
    <?php if (isset($_POST['error'])) : ?>
        <span style="color: red;font-style:italic;"><?= $_POST['error'] ?></span>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data" style="margin-top: 20px; border:2px solid black;">
        <?php if (in_array('judul', $error)) : ?>
            <span class="error">Judul tidak boleh kosong</span>
        <?php endif; ?>
        <label for="judul">Judul Ujian</label>
        <input type="text" name="judul" id="judul" autofocus>
        <br>
        <?php if (in_array('files', $error)) : ?>
            <span class="error">File tidak boleh kosong</span>
        <?php endif; ?>
        <label for="files">file pdf</label>
        <input type="file" name="files" id="files">
        <br>
        <?php if (in_array('kelaz', $error)) : ?>
            <span class="error">Kelas tidak boleh kosong</span>
        <?php endif; ?>
        <label>Kelas Dan jurusan</label>
        <div class="input">X RPL<input type="checkbox" name="kelas[]" id="kelas" value="1"></div>
        <div class="input">XI RPL<input type="checkbox" name="kelas[]" id="kelas" value="2"></div>
        <div class="input">XII RPL<input type="checkbox" name="kelas[]" id="kelas" value="3"></div>
        <div class="input">X PPLG<input type="checkbox" name="kelas[]" id="kelas" value="4"></div>
        <div class="input">XI PPLG<input type="checkbox" name="kelas[]" id="kelas" value="5"></div>
        <div class="input">XII PPLG<input type="checkbox" name="kelas[]" id="kelas" value="6"></div>
        <div class="input">X MM<input type="checkbox" name="kelas[]" id="kelas" value="7"></div>
        <div class="input">XI MM<input type="checkbox" name="kelas[]" id="kelas" value="8"></div>
        <div class="input">XII MM<input type="checkbox" name="kelas[]" id="kelas" value="9"></div>

        <br>

        <button type="submit" name="submit">Submit</button>
    </form>

</body>
<style>
    label {
        display: block;
    }

    .input {
        display: block;
        margin-bottom: 5px;
    }
</style>

</html>