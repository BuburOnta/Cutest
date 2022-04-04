<?php
session_start();

// Mengecek tombol forget
if (isset($_POST['lupa_pass'])) {

    if (lupaPass($_POST) > 0) {
        echo "<script>alert('Berhasil')</script>";
        header("Location: ?page=login_verification");
    } else {
        // echo "<script>alert('gagal')</script>";
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
    <title>Lupa Password</title>
    <link rel="stylesheet" href="assets/css/section_logreg.css">
    <link rel="stylesheet" href="assets/css/font.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <form method="POST" action="" class="loginForm" autocomplete="off">
                <!-- Email -->
                <div class="regist-group email" style="margin-bottom: 13px;">
                    <label for="email">Lupa Password</label><br>
                    <!-- Menampilkan pesan error -->
                    <?php if (isset($_POST['error'])) : ?>
                        <p style="color: red;font-style:italic;font-size:15px;margin:5px 0 -5px 0;"><?= $_POST['error'] ?></p>
                    <?php endif; ?>
                    <input type="email" name="email" id="email" placeholder="email anda..." autofocus>
                </div>

                <!-- Cari -->
                <div class="login-group login">
                    <button type="submit" name="lupa_pass">Cari</button>
                </div>

            </form>
            <span class="foot">Belum Punya Akun? <a href="?page=register">Regist</a></span>
        </div>
    </div>
</body>
<style>
    form input {
        margin-top: 16px;
        margin-bottom: -5px;
    }

    span {
        font-family: "Montserrat", sans-serif;
        font-size: 0.8em;
        color: #5E5E5E;
    }

    a {
        text-decoration: none;
        color: #415F9D;
    }
</style>

</html>