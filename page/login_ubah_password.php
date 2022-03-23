<?php
session_start();

$error = []; // set varibael error menjadi array
$values = []; // set variabel values menjadi array
$errorKeys = ['password']; // membuat error key
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
        if (ubahPassword($_POST) > 0) { // mengirim value didalam $_POST ke function register
            // header("Location: verifikasiEmail.php");
            header("Location: ?page=login");
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
    <title>Verification Page</title>
    <link rel="stylesheet" href="assets/css/font.css">
    <link rel="stylesheet" href="assets/css/section_logreg.css">
    <style>
        form {
            width: 300px;
        }

        form input.satu {
            margin-top: 10px;
        }
        form input{
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <form method="POST" action="" autocomplete="off">
                <!-- CODE OTP -->
                <div class="regist-group username">
                    <label for="verifCode">Ubah password</label>
                    <!-- Menampilkan pesan error -->
                    <?php if (isset($_POST['error'])) : ?>
                        <p style="color: red;font-style:italic;font-size:15px;margin:4px 0 -7px 0;"><?= $_POST['error'] ?></p>
                    <?php endif; ?>
                    <?php if (in_array('password', $error)) : ?>
                        <span class="error">Password tidak boleh kosong</span>
                    <?php endif; ?>
                    <input type="password" name="password" id="password" placeholder="Masukkan password" class="satu">
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Konfirmasi password">
                
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

</html>