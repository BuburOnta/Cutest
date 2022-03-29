<?php
session_start();
// $_SESSION['sesiLogin'] = 'seno@gmail.com';
echo $_SESSION['sesiLogin'];
// Cek session
if (!$_SESSION['sesiLogin']) {
    header("Location: ?page=login");
}

// $mapels = [];
// QUERY 1 -> Mengambil data user berdasarkan `sesiLogin`
$users = query("SELECT * FROM users WHERE email='$_SESSION[sesiLogin]' ")[0];
// echo $users['kelas'];

// QUERY 2 -> Mengambil data `id_ujian` dari tabel `akses_ujian` dengan ketentuan kelas dari `user`
    // -> Output dari id_ujian bisa saja lebih dari 1
$ujian = query("SELECT id_ujian FROM akses_ujian INNER JOIN kelas_jurusan ON akses_ujian.kelas_jurusan=kelas_jurusan.id WHERE kelas_jurusan.kelas='$users[kelas]'  AND kelas_jurusan.jurusan='$users[jurusan]'");
if(count($ujian) == 0){
    $mapels = [];
    $error = true;
}

// -> Pengulangan dari data `id_ujian` jika lebih dari 1
foreach ($ujian as $uji) {
    // var_dump($uji);
    // QUERY 3 -> Mengambil `judul` dari `daftar_ujian` Berdasarkan `id_ujian` yang sudah diambil diatas
        // -> Lalu memasukan kedalam array $mapels yang akan digunakan untuk menampilkan data nantinya
    $mapels[] = query("SELECT * FROM daftar_ujian WHERE id_ujian='$uji[id_ujian]'");
    // var_dump($mapels);
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
</head>

<body>
    <div class="logo">
        <img src="assets/img/cutest_logo_text.svg">
    </div>

    <div class="container">
        <div class="card">
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
                                <input type="radio" class="radio" id="category" name="category" value="$mapel[nama]" />
                                <label for="category"><?= $mapel[0]['judul'] ?></label>
                            </div>
                        <?php }; ?>
                    </div>

                    <?php if ($error) { ?>
                        <div class="selected">
                            <img src="assets/img/ujian_vector.svg">
                            Saat ini tidak ada ujian
                        </div>
                    <?php } else { ?>
                        <div class="selected">
                            <img src="assets/img/ujian_vector.svg">
                            Pilih ujian
                        </div>
                    <?php }; ?>
                </div>
                <!-- end select -->
            </div>

            <button type="submit" name="next">Next</button>
        </form>
    </div>
</body>
<script src="assets/js/select.js"></script>

</html>