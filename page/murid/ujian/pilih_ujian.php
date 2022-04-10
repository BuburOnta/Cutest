<?php
session_start();
// $_SESSION['sesiLogin'] = 'a1@gmail.com';
// echo $_SESSION['sesiLogin'];
// Cek session
if (!isset($_SESSION['sesiLogin'])) {
    header("Location: ?page=murid");
}

// $mapels = [];
// QUERY 1 -> Mengambil data user berdasarkan `sesiLogin`
$users = query("SELECT * FROM users WHERE email='$_SESSION[sesiLogin]' ")[0];
// echo $users['kelas'];

// QUERY 2 -> Mengambil data `id_ujian` dari tabel `akses_ujian` dengan ketentuan kelas dari `user`
// -> Output dari id_ujian bisa saja lebih dari 1
// $ujian = query("SELECT * FROM murid_ujian INNER JOIN kelas_jurusan ON akses_ujian.kelas_jurusan=kelas_jurusan.id WHERE kelas_jurusan.kelas='$users[kelas]'  AND kelas_jurusan.jurusan='$users[jurusan]'");
$ujian = query("SELECT * FROM murid_ujian WHERE kelas='$users[kelas]' AND jurusan='$users[jurusan]' AND keterangan='belum submit' AND id_murid='$users[id_user]' ");
if (count($ujian) == 0) {
    $mapels = [];
    $error = true;
}

// -> Pengulangan dari data `id_ujian` jika lebih dari 1
foreach ($ujian as $uji) {
    // QUERY 3 -> Mengambil `judul` dari `daftar_ujian` Berdasarkan `id_ujian` yang sudah diambil diatas
    // -> Lalu memasukan kedalam array $mapels yang akan digunakan untuk menampilkan data nantinya
    $mapels[] = query("SELECT * FROM daftar_ujian WHERE id_ujian='$uji[id_ujian]'");
    // var_dump($mapels);
}

// NEXT
if (isset($_POST['next'])) {
    if(!isset($_POST['id_ujian'])) {
        $_POST['error'] = "Pilih salah satu ujian terlebih dahulu goblok!!";
    } else {
        $_SESSION['id_ujian'] = $_POST['id_ujian'];
        $waktuMulai = date('Y-d-m H:i:s');
        mysqli_query($con, "UPDATE murid_ujian SET waktu_mulai='$waktuMulai' WHERE id_murid='$users[id_user]' AND id_ujian='$_POST[id_ujian]' ");
        header("Location: ?page=ujian");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Ujian</title>
    <link rel="stylesheet" href="assets/css/pilih_ujian.css">
    <link rel="stylesheet" href="assets/css/select.css">
    <style>
        @keyframes slideDown {
            0% {
                top: -100%;
                opacity: 0;
                
            }
            100% {
                top: 20px;
                opacity: 0.7;
            }
        }
        .error {
            animation: slideDown 500ms;

            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 250px;
            word-wrap: break-word;
            /* height: 150px; */
            padding: 20px;

            color: #ff0000;
            background-color: #c5c5c5;
            opacity: 0.7;
            box-shadow: 0 0 10px rgba(197, 197, 197, 0.5);
            border-radius: 10px;

            z-index: 999;
            text-align: center;
            font-family: "Inter", sans-serif;
            font-weight: 600;
            font-size: 17px;
            word-wrap: break-word;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="assets/img/cutest_logo_text.svg" onclick="window.location.href = '?page=murid';">
    </div>

    <?php if (isset($_POST['error'])) { ?>
    <div class="error">
        <span><?= $_POST['error'] ?></span>
    </div>
    <?php } ?>

    <div class="container">
        <div class="card">
            <a href="?page=murid" class="keluar">
                <i class="fa-solid fa-right-to-bracket"></i>
            </a>
            <style>
                div.container a.keluar {
                    font-size: 30px;
                    color: #233B6E;
                    position: absolute;
                    left: 25px;
                    top: 10px;
                    transform: rotate(180deg);
                }

                div.container a.keluar:hover {
                    color: #121e39;
                }
            </style>
            <img src="assets/img/dashboard_ujian.svg">
            <span>ujian</span>
        </div>

        <form method="POST" action="">
            <h3>Kategori ujian</h3>
            <!-- SELECT DROPDOWN -->
            <div class="select-container">
                <div class="select-box">
                    <div class="options-container">
                        <?php foreach ($mapels as $mapel) { ?>
                        <div class="option">
                            <!-- <input type="hidden" name="id_ujian" value="//$mapel[0]['id_ujian'] "> -->
                            <input type="radio" class="radio"
                                id="<?=$mapel[0]['id_ujian']?>"
                                name="id_ujian"
                                value="<?= $mapel[0]['id_ujian'] ?>" />
                            <label
                                for="<?=$mapel[0]['id_ujian']?>"
                                class="select"><span><?= $mapel[0]['judul'] ?></span></label>
                        </div>
                        <?php }; ?>
                    </div>

                    <!-- <label for="<?=$mapel[0]['id_ujian']?>"
                    class="selected"><?= $mapel[0]['judul'] ?></label>
                    -->
                    <?php if ($error) { ?>
                    <label class="selected">
                        <img src="assets/img/ujian_vector.svg">
                        <span>Saat ini tidak ada ujian</span>
                    </label>
                    <?php } else { ?>
                    <label class="selected">
                        <img src="assets/img/ujian_vector.svg">
                        <span>Pilih ujian</span>
                    </label>
                    <?php }; ?>
                </div>
                <!-- end select -->
            </div>

            <?php if ($error) { ?>
            <?php } else { ?>
            <button type="submit" name="next">Next</button>
            <?php }; ?>
        </form>
    </div>
</body>
<script src="assets/js/select.js">
</script>

</html>