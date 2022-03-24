<?php
session_start();

// Cek session
if (!$_SESSION['sesiLogin']) {
    header("Location: ?page=login");
}

// MAPEL
// var_dump(query("SELECT * FROM daftar_ujian"));
// foreach(query("SELECT * FROM daftar_ujian") as $f){
//     var_dump($f);
// }
$result = query("SELECT * FROM daftar_ujian");
if (count($result) == 0) {
    $mapels = [];
    $error = true;
} else {
    $mapels = $result;
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
                                <input type="radio" class="radio" id="automobiles" name="category" value="$mapel[nama]" />
                                <label for="automobiles"><?= $mapel['nama'] ?></label>
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