<?php
session_start();
$error = [];
$values = [];
$errorKeys = ['nama','email', 'password', 'kelas_jurusan']; // membuat error key
//$optional = ['confirm_password']; // optional untuk confirm pass

// Mengecek tombol regist
if (isset($_POST['register'])) {
    // validasi form
    foreach ($errorKeys as $errorKey) { // mengeluarkan semua array
        // menggunakan error key dengan post untuk mengecek apakah input kosong atau tidak, jika kosong maka variabel error diisi dengan masing masing error key
        if (empty(trim($_POST[$errorKey]))) {
            $error[] = $errorKey; // memasukkan key kedalam var error
        } else {
            $values[$errorKey] = $_POST[$errorKey];
        }
    }

    // Menghitung jumlah error key didalam variabel error, jika sudah 0 atau tidak ada error baru jalankan function register
    if (count($error) == 0) {
        // menerima data dari function register yang dimana jika dikembalikan nilai true (1), dan false (0)
        if (register($_POST) > 0) { // mengirim value didalam $_POST ke function register
            header("Location: ?page=register_verification");
        } else {
            echo mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="assets/css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <style>
        span.error {
            /* text-align: left; */
            margin-top: 3px;
            margin-bottom: 3px;
            color: red;
            font-style: italic;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="left">
            <form action="" method="post" autocomplete="off">
                <img src="assets/img/qtest_logo_login.svg">
                <?php if (isset($_POST['error'])) : ?>
                    <span style="color: red; font-style: italic;margin-bottom: 3px;"><?= $_POST['error'] ?></span>
                <?php endif; ?>

                <?php if (in_array('nama', $error)) : // jika ada 'nama' didalam error ?>
                    <span class="error">nama tidak boleh kosong</span>
                <?php endif; ?>
                <input type="text" name="nama" id="nama" placeholder="Masukkan nama" value="Raffi Ramadhan">

                <?php if (in_array('email', $error)) : // jika ada 'email' didalam error ?>
                    <span class="error">Email tidak boleh kosong</span>
                <?php endif; ?>
                <input type="email" name="email" id="email" placeholder="Masukkan email" value="klsterbuka@gmail.com">

                <?php if (in_array('password', $error)) : ?>
                    <span class="error">Password tidak boleh kosong</span>
                <?php endif; ?>
                <input type="password" name="password" id="password" placeholder="Masukkan password" value="raffie">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Konfirmasi password" value="raffie">
                <?php if (in_array('kelas_jurusan', $error)) : ?>
                    <span class="error">Silahkan pilih kelas dan jurusan</span>
                <?php endif; ?>
                <select name="kelas_jurusan" id="kelas_jurusan">
                    <option value="" selected hidden>Pilih kelas dan jurusan</option>
                    <optgroup label="Rekayasa Perangkat Lunak">
                    <option value="1">X RPL</option>
                    <option value="2">XI RPL</option>
                    <option value="3">XII RPL</option>
                    </optgroup>
                    <optgroup label="Pemrograman Perangkat Lunak & Gim">
                    <option value="4">X PPLG</option>
                    <option value="5">XI PPLG</option>
                    <option value="6">XII PPLG</option>
                    </optgroup>
                    <optgroup label="Multimedia">
                    <option value="7">X MM</option>
                    <option value="8">XI MM</option>
                    <option value="9">XII MM</option>
                    </optgroup>
                    <optgroup label="Desain Komunikasi Visual">
                    <option value="10">X DKV</option>
                    <option value="11">XI DKV</option>
                    <option value="12">XII DKV</option>
                    </optgroup>
                    <optgroup label="Teknik Bisnis Sepeda Motor">
                    <option value="13">X TBSM</option>
                    <option value="14">XI TBSM</option>
                    <option value="15">XII TBSM</option>
                    </optgroup>
                    <optgroup label="Teknik Kendaraan Ringan Otomotif">
                    <option value="16">X TKRO</option>
                    <option value="17">XI TKRO</option>
                    <option value="18">XII TKRO</option>
                    </optgroup>
                    <optgroup label="Akomodasi Perhotelan">
                    <option value="19">X APH</option>
                    <option value="20">XI APH</option>
                    <option value="21">XII APH</option>
                    </optgroup>
                    <optgroup label="Akutansi Keuangan Lembaga">
                    <option value="22">X AKL</option>
                    <option value="23">XI AKL</option>
                    <option value="24">XII AKL</option>
                    </optgroup>

                </select>
                <span class="reminder">Pastikan kamu mendaftar sesuai dengan data yang diberikan oleh sekolah.</span>
                <button type="submit" name="register">Registrasi</button>
                <span class="link">Sudah punya akun? <a href="?page=login">masuk</a></span>
            </form>
        </div>

        <div class="right">
            <img src="assets/img/female_icon_register.svg">
        </div>
    </div>
</body>

</html>