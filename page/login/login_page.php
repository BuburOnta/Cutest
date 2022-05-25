<?php
session_start();

// COOKIE - mengecek apakah ada cookie atau tidak, jika ada maka set SESSION menjadi true
if (isset($_COOKIE['cookieLogin'])) {
    // var_dump($_COOKIE);die;
    $email = $_COOKIE['cookieLogin'];
    $cookieDefault = mysqli_query($con, "SELECT * FROM users WHERE email='$email' ");
    if ($row = mysqli_fetch_assoc($cookieDefault)) {
        $_SESSION['sesiLogin'] = $row['email'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['sesiId'] = $row['id_user'];
    }
}
// Mengecek SESSION sudah terbuat atau belum
if (isset($_SESSION['sesiLogin'])) {
    header("Location: ?page=".$_SESSION['role']);
}

// Mengecek tombol login
if (isset($_POST['login'])) {

    if (login($_POST) > 0) {
        // KONDISI 1 - Cek role
        if( $user = query("SELECT guru.email,role.role FROM guru INNER JOIN role ON guru.role=role.id_role WHERE email='$_POST[email]' ")){
            $user = $user[0]['role'];
            // var_dump($user);
        } else if($user = query("SELECT users.email,role.role  FROM users INNER JOIN role ON users.role=role.id_role WHERE email='$_POST[email]' ")){
            $user = $user[0]['role'];
            // var_dump($user);
        } else {
            $_POST['error'] = "error page";
            // setFlash('Invalid Username / Password', 'danger');
        }

        switch ($user) {
            case $user:
                $_SESSION['sesiLogin'] = $_POST['email'];
                $_SESSION['role'] = $user;
                // echo $_POST['email'];
                header("Location: ?page=".$user);
                break;

        }
    } else {
        echo mysqli_error($con);
        setFlash('Invalid Username / Password', 'danger');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <style>
        div.input__group {
            position: relative;
        }
        .left .eyeWrap {
            position: absolute;
            top: 8px;
            right: 10px;
            color: #415F9D;
            cursor: pointer;
            width: 25px;
            height: 25px;
            z-index: 999;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <form action="" method="post">
                <img src="assets/img/qtest_logo_login.svg">
                <?php flash(); ?>

                <!-- Menampilkan pesan error -->
                <input type="email" name="email" id="email" placeholder="Masukkan email">
                <div class="input__group">
                    <input type="password" name="password" id="password" placeholder="Masukkan password">
                    <!-- <img src="assets/icon/eye.svg" class="togglePassword" id="togglePassword"> -->
                    <!-- <span class="iconify togglePassword" id="togglePassword" data-icon="eva:eye-fill"></span> -->
                    <svg class="eyeWrap">
                        <use xlink:href="#eye" class="togglePassword" id="togglePassword" />
                    </svg>
                </div>
                <div class="info-login">
                    <input type="checkbox" name="info_login" id="info_login">
                    <span>Simpan info login</span>
                </div>
                <button type="submit" name="login">Login</button>
                <a href="?page=lupa_password">Lupa kata sandi?</a>
            </form>
        </div>

        <div class="right">
            <img src="assets/img/lamp_icon_login.svg">
            <span>Belum punya akun? <a href="?page=register">Daftar disini</a></span>
        </div>
    </div>

    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script>
        const togglePass = document.getElementById("togglePassword");
        const eyeWrap = document.querySelector(".eyeWrap");
        const password = document.getElementById("password");

        eyeWrap.addEventListener('click', () => {
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