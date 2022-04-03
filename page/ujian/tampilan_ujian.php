<?php
session_start();
// if(!isset($_SESSION['guru_input_jawaban'])){
//     header("Location: ?page=guru");
// }


$group = 0; // nilai default jumlahSoal
$input = 0;

// var_dump($_SESSION);

// --- Mengambil soal
$id_ujian = $_SESSION['id_ujian'];
if( !$soal = query("SELECT * FROM soal_ujian WHERE id_ujian='2' ORDER BY id_soal DESC LIMIT 1  ")[0]){
    $_POST['error'] = "Gagal menampilkan soal ujian";
} else {
    $group = $soal['nomor_soal'] / 5;
    if($group % 2 == 0){
        $input = 10;
    } else if($group % 2 == 1){
        $input = 5;
    }
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
    <?php include_once $nav ?>

    <div class="container">
        <!-- <div class="center"> -->
        <div class="left">
            <iframe src="oiii.pdf" frameborder="0" width="100%" height="450px" style="zoom:1.5;"></iframe>
        </div>

        <div class="right-side">
            <form method="POST" action="" class="bawah">
                <!-- <div class="bawah"> -->

                <?php $no = 1;  ?>
                <?php for ($a = 1; $a <= $group; $a++) { ?>
                    <div class="group">
                        <?php for ($i = 1; $i <= $input; $i++) : ?>
                            <div class="input_group">
                                <?php echo "<label for=" . $no . ">$no</label>" ?>
                                <div class="input_right">
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
                            <?php $no++; ?>
                        <?php endfor; ?>
                        <!-- end div group -->
                    </div>
                <?php }; ?>
                <!-- <button type="submit" name="submitJawaban" class="submit_jawaban">submit</button> -->
                <!-- </div> -->
            </form>
        </div>
        <!-- </div> -->
    </div>
</body>

</html>