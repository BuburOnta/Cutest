<?php
session_start();
// if(!isset($_SESSION['guru_input_jawaban'])){
//     header("Location: ?page=guru");
// }


$group = 0; // nilai default jumlahSoal


// --- Mengambil soal
$id_ujian = $_SESSION['id_ujian'];
if (!$soal = query("SELECT * FROM soal_ujian WHERE id_ujian='$id_ujian' ORDER BY id_soal DESC LIMIT 1  ")[0]) {
    $_POST['error'] = "Gagal menampilkan soal ujian";
} else {
    $group = $soal['nomor_soal'];
}


// --- Submit Jawaban 
// $no = 1;
// for ($i = 1; $i <= $_POST['jumlahSoal']; $i++) {
//     if(!isset($_POST['jawaban'.$i])){
//         $errorJawaban[] = $_POST['jawaban'.$i] = "f".$i;
//     }
//     $no++;
// }
// var_dump($errorJawaban);


if (isset($_POST['submitJawaban'])) {
    // echo $_POST['jawaban']
    if (submitJawaban($_POST) > 0) {
        $_SESSION['nilai'] = $_POST['nilai'];
        header("Location: ?page=nilai");
    } else {
    }
}

// --- Mengecek jawaban yang kosong
// if (isset($errorJawaban)) {
//     for ($i = 0; $i < count($errorJawaban); $i++) {
//         $errorJawaban[] = $errorJawaban[$i];
//     }
// } else {
//     $errorJawaban = [];
// }
if (isset($_POST["errorJawaban"])) {
    for ($i = 0; $i < count($_POST["errorJawaban"]); $i++) {
        $errorJawaban[] = $_POST['errorJawaban'][$i];
    }
} else {
    $errorJawaban = [];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian</title>
    <link rel="stylesheet" href="assets/css/ujian_tampilan.css">
</head>

<body>
    <?php include_once $nav_ujian ?>

    <div class="container">
        <!-- <div class="center"> -->
        <div class="left">
            <iframe src="oiii.pdf" frameborder="0" width="100%" height="100%" style="zoom:1.5;"></iframe>
        </div>

        <div class="right-side">
            <span class="note">Urutan pilihan: A | B | C | D</span>

            <form method="POST" action="" class="bawah">
                <input type="hidden" name="jumlahSoal" value="<?= $group ?>">

                <div class="bawah">
                    <?php $no = 1; $o = 0;?>
                    <?php for ($i = 1; $i <= $group; $i++) : ?>
                        <div class="input_group">

                            <!-- Menandai Label dari Jawaban Yang Kosong -->
                            <?php if (in_array("f".$i, $errorJawaban)) { ?>
                                <label for="jawaban<?= $no ?>" style=color:red;><?= $i ?>*</label>
                            <?php } else { ?>
                                <label for="jawaban<?= $no ?>"><?= $no ?></label>
                            <?php } ?>

                            <div class="right">
                                <div class="input">
                                    <input type="radio" <?= "name=jawaban" . $no ?> <?= "id=jawaban" . $no ?> value="a">
                                </div>
                                <div class="input">
                                    <!-- <span>B</span> -->
                                    <input type="radio" <?= "name=jawaban" . $no ?> <?= "id=jawaban" . $no ?> value="b">
                                </div>
                                <div class="input">
                                    <!-- <span>C</span> -->
                                    <input type="radio" <?= "name=jawaban" . $no ?> <?= "id=jawaban" . $no ?> value="c">
                                </div>
                                <div class="input">
                                    <!-- <span>D</span> -->
                                    <input type="radio" <?= "name=jawaban" . $no ?> <?= "id=jawaban" . $no ?> value="d">
                                </div>
                            </div>
                        </div>
                        <?php $no++;$o++; ?>
                    <?php endfor; ?>
                </div>
                <button type="submit" name="submitJawaban" class="submit_jawaban">submit</button>
            </form>
        </div>
        <!-- </div> -->
    </div>
</body>

</html>