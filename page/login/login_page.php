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
        .togglePassword {
            position: absolute;
            top: 5px;
            right: 0;
            width: 30px;
            height: 30px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <form action="" method="post">
                <img src="assets/img/qtest_logo_login.svg">
                <!-- Menampilkan pesan error -->
                <?php if (isset($_POST['error'])) : ?>
                    <p style="color: red;font-style:italic;font-size:15px;"><?= $_POST['error'] ?></p>
                <?php endif; ?>
                <input type="email" name="email" id="email" placeholder="Masukkan email">
                <div class="input__group">
                    <input type="password" name="password" id="password" placeholder="Masukkan password">
                    <img src="assets/icon/eye.svg" class="togglePassword" id="togglePassword">
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

    <script>
        const togglePass = document.getElementById("togglePassword");
        const password = document.getElementById("password");
        togglePass.addEventListener('click', () => {
            if(password.type === 'password'){
                password.type = 'text';
                togglePass.src = 'assets/icon/eye-slash.svg';
            } else {
                password.type = 'password';
                togglePass.src = 'assets/icon/eye.svg';
            }
        })
    </script>
</body>

</html>