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

        div.input__group {
            position: relative;
        }
        .left .eyeWrap {
            position: absolute;
            top: 8px;
            right: 10px;
            /* width: 25px;
            height: 25px; */
            font-size: 50px;
            cursor: pointer;
            z-index: 99;

            width: 25px;
            /*height: 25px;*/
           
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
                <div class="input__group">
                    <input type="password" name="password" id="password" placeholder="Masukkan password" >
                     <svg class="eyeWrap">
                        <use xlink:href="#eye" class="togglePassword" id="togglePassword" />
                    </svg>
                </div>
                <div class="input__group">
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Konfirmasi password">
                    <svg class="eyeWrap">
                        <use xlink:href="#eye" class="togglePassword" id="togglePassword2" />
                    </svg>             
                </div>

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
    <script>
        const togglePass = document.getElementById("togglePassword");
        const togglePass2 = document.getElementById("togglePassword2");
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirm_password");

        togglePass.addEventListener('click', () => {
            if(password.type === 'password'){
                password.type = 'text';
                // togglePass.src = 'assets/icon/eye-slash.svg';
                togglePass.setAttribute("xlink:href", "#eye-slash")
            } else {
                password.type = 'password';
                // togglePass.src = 'assets/icon/eye.svg';
                togglePass.setAttribute("xlink:href", "#eye")
            }
        })
         togglePass2.addEventListener('click', () => {
            if(confirmPassword.type === 'password'){
                confirmPassword.type = 'text';
                // togglePass.src = 'assets/icon/eye-slash.svg';
                togglePass2.setAttribute("xlink:href", "#eye-slash")
            } else {
                confirmPassword.type = 'password';
                // togglePass.src = 'assets/icon/eye.svg';
                togglePass2.setAttribute("xlink:href", "#eye")
            }
        })
    </script>

<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
    <symbol id="eye-slash">
        <circle cx="12" cy="12" r="1.5" fill="currentColor"/>
        <path fill="currentColor" d="M15.29 18.12L14 16.78l-.07-.07l-1.27-1.27a4.07 4.07 0 0 1-.61.06A3.5 3.5 0 0 1 8.5 12a4.07 4.07 0 0 1 .06-.61l-2-2L5 7.87a15.89 15.89 0 0 0-2.87 3.63a1 1 0 0 0 0 1c.63 1.09 4 6.5 9.89 6.5h.25a9.48 9.48 0 0 0 3.23-.67ZM8.59 5.76l2.8 2.8A4.07 4.07 0 0 1 12 8.5a3.5 3.5 0 0 1 3.5 3.5a4.07 4.07 0 0 1-.06.61l2.68 2.68l.84.84a15.89 15.89 0 0 0 2.91-3.63a1 1 0 0 0 0-1c-.64-1.11-4.16-6.68-10.14-6.5a9.48 9.48 0 0 0-3.23.67Zm12.12 13.53L19.41 18l-2-2l-9.52-9.53L6.42 5L4.71 3.29a1 1 0 0 0-1.42 1.42L5.53 7l1.75 1.7l7.31 7.3l.07.07L16 17.41l.59.59l2.7 2.71a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.42Z"/>
    </symbol>
    <symbol id="eye">
        <circle cx="12" cy="12" r="1.5" fill="currentColor"/>
        <path fill="currentColor" d="M21.87 11.5c-.64-1.11-4.16-6.68-10.14-6.5c-5.53.14-8.73 5-9.6 6.5a1 1 0 0 0 0 1c.63 1.09 4 6.5 9.89 6.5h.25c5.53-.14 8.74-5 9.6-6.5a1 1 0 0 0 0-1Zm-9.87 4a3.5 3.5 0 1 1 3.5-3.5a3.5 3.5 0 0 1-3.5 3.5Z"/>
    </symbol>
</svg>

</body>

</html>