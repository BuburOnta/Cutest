<?php
session_start();

if (!$_SESSION['email']) {
    header("Location: ?page=lupa_password");
    exit;
}

$error = []; // set varibael error menjadi array
$values = []; // set variabel values menjadi array
$errorKeys = ['verifCode']; // membuat error key
//$optional = ['confirm_password']; // optional untuk confirm pass

// Mengecek tombol regist
if (isset($_POST['verification'])) {
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
        if (verification_login($_POST) > 0) { // mengirim value didalam $_POST ke function register
            // header("Location: verifikasiEmail.php");
            header("Location: ?page=ubah_password");
        } else {
            echo mysqli_error($con);
        }
    }
}

if (in_array('verifCode', $error)) {
    setFlash("Kode verifikasi tidak boleh kosong", "danger");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Page</title>
    <link rel="stylesheet" href="assets/css/font.css">
    <link rel="stylesheet" href="assets/css/section_logreg.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <form method="POST" action="" class="registForm" autocomplete="off">
                <!-- CODE OTP -->
                <div class="regist-group username">
                    <label for="verifCode">Kode verifikasi</label><? //= $error['verifCode'] 
                                                                    ?><br>
                    <!-- Menampilkan pesan error -->
                    <?php flash() ?>
                    <input type="text" name="verifCode" id="verifCode" placeholder="Periksa email anda" autofocus>
                </div>

                <!-- Submit -->
                <div class="regist-group daftar">
                    <button type="submit" name="verification">verifikasi</button>
                </div>

            </form>

        </div>
    </div>
    </main>

    </div>
</body>
<style>
    input {
        margin-top: 10px;
        margin-bottom: 20px;
    }
</style>

</html>