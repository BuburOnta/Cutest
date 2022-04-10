<?php
session_start();
$error = [];
$values = [];
$errorKeys = ['nama','email', 'password', 'kelas', 'jurusan']; // membuat error key
//$optional = ['confirm_password']; // optional untuk confirm pass

// Mengecek tombol regist
if (isset($_POST['register'])) {
    if (!isset($_POST['kelas'])) {
        $_POST['kelas'] = "";
    }
    if (!isset($_POST['jurusan'])) {
        $_POST['jurusan'] = "";
    }
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
$kelas = [
    ["id_kelas"=>'1',"kelas"=>'X'],
    ["id_kelas"=>'2',"kelas"=>'XI'],
    ["id_kelas"=>'3',"kelas"=>'XII'],
];
    $jurusan = [
        ["id_jurusan"=>'rpl', "jurusan"=>'Rekayasa Perangkat Lunak'],
        ["id_jurusan"=>'pplg', "jurusan"=>'Pemrograman Perangkat Lunak Gim'],
        ["id_jurusan"=>'mm', "jurusan"=>'Multi Media'],
        ["id_jurusan"=>'dkv', "jurusan"=>'Desain Komunikasi Visual'],
        ["id_jurusan"=>'akl', "jurusan"=>'Akutansi Keuangan Lembaga'],
        ["id_jurusan"=>'aph', "jurusan"=>'Akomodasi Perhotelan'],
        ["id_jurusan"=>'tkro', "jurusan"=>'Teknik Kendaraan Roda Empat'],
        ["id_jurusan"=>'tbsm', "jurusan"=>'Teknik Bisnis Sepeda Motor']
    ];
    // var_dump($kelas);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="assets/css/select.css">
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

        .select-container {
            margin: 0;
        }
        .select span,
        .selected span,
        .selected2 span {
            color: #5E5E5E;
        }
        .select span {
            font-weight: 600;
            text-align: left;
        }
        .selected span,
        .selected2 span {
            font-style: italic;
            text-align: left;
        }

        .select-box {
            position: relative;
        }

        .select-box .options-container,
        .select-box .options-container2 {
            top: 0;
            right: -270px;
            background: transparent;
        }

        .select-box .option:hover .select span,
        .select-box .option2:hover .select span {
            color: #000;
        }
        .select-box .option:hover,
        .select-box .option2:hover {
            background: transparent;
        }
        .select-box .option:hover .select,
        .select-box .option2:hover .select {
            background: #ddd;
        }
        .select-box .option,
        .select-box .option2 {
            margin-bottom: 3px;
        }

        
        .select-box .option, .select-box .option2 {
            background: transparent;
        }
        .selected, .selected2, .select {
            background: #FAFAFA;
            border: 1px solid #D5D5D5;
            outline: none;
            box-sizing: border-box;
            border-radius: 10px;
            transition: 130ms;
        }
        .selected span, .selected2 span {
            width: 150px;
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis; 
        }

        /* ANIMASI */
        .select-box .options-container.active + .selected::after, .select-box .options-container2.active  + .selected2::after {
            transform: rotateX(360deg);
        }
        .selected::after, .selected2::after {
            transform: rotate(270deg);
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

                <?php if (in_array('nama', $error)) : // jika ada 'nama' didalam error?>
                <span class="error">nama tidak boleh kosong</span>
                <?php endif; ?>
                <input type="text" name="nama" id="nama" placeholder="Masukkan nama">

                <?php if (in_array('email', $error)) : // jika ada 'email' didalam error?>
                <span class="error">Email tidak boleh kosong</span>
                <?php endif; ?>
                <input type="email" name="email" id="email" placeholder="Masukkan email">

                <?php if (in_array('password', $error)) : ?>
                <span class="error">Password tidak boleh kosong</span>
                <?php endif; ?>
                <input type="password" name="password" id="password" placeholder="Masukkan password" >
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Konfirmasi password">

                <?php if (in_array('kelas', $error)) : ?>
                <span class="error">Pilih salah satu kelas..</span>
                <?php endif; ?>
                <!-- SELECT DROPDOWN -->
                <div class="select-container">
                    <div class="select-box">
                        <div class="options-container">
                            <?php foreach ($kelas as $kel) { ?>
                            <div class="option">
                                <input type="radio" class="radio"
                                    id="<?=$kel['id_kelas']?>"
                                    name="kelas"
                                    value="<?= $kel['id_kelas'] ?>" />
                                <label
                                    for="<?=$kel['id_kelas']?>"
                                    class="select"><span><?= $kel['kelas'] ?></span></label>
                            </div>
                            <?php }; ?>
                        </div>

                        <label class="selected">
                            <span>Pilih kelas</span>
                        </label>
                    </div>
                </div>
                <!-- end select -->

                <?php if (in_array('jurusan', $error)) : ?>
                <span class="error">Pilih salah satu jurusan..</span>
                <?php endif; ?>
                <!-- JURUSAN -->
                <div class="select-container">
                    <div class="select-box">
                        <div class="options-container2">
                            <?php foreach ($jurusan as $jurus) { ?>
                            <div class="option2">
                                <input type="radio" class="radio"
                                    id="<?=$jurus['id_jurusan']?>"
                                    name="jurusan"
                                    value="<?= $jurus['id_jurusan'] ?>" />
                                <label
                                    for="<?=$jurus['id_jurusan']?>"
                                    class="select"><span><?= $jurus['jurusan'] ?></span></label>
                            </div>
                            <?php }; ?>
                        </div>

                        <label class="selected2">
                            <span>Pilih jurusan</span>
                        </label>
                    </div>
                </div>
                <!-- end select -->

                <span class="reminder">Pastikan kamu mendaftar sesuai dengan data yang diberikan oleh
                    sekolah.</span>
                <button type="submit" name="register">Registrasi</button>
                <span class="link">Sudah punya akun? <a href="?page=login">masuk</a></span>
            </form>
        </div>

        <div class="right">
            <img src="assets/img/female_icon_register.svg">
        </div>
    </div>

    <script src="assets/js/select.js"></script>
</body>

</html>