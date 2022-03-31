<?php
session_start();
unset($_SESSION['guru_page_ujian']);
// var_dump($_SESSION);

$group = 0; // nilai default jumlahSoal

if(isset($_POST['submitJawaban'])){
    // var_dump($_POST);
    if(tambahJawaban($_POST) > 0){
        // echo "<script>alert('sukses')</script>";
    } else {
        // echo "<script>alert('gagal')</script>";
    }
}

// CEK INPUT JUMLAH SOAL DARI USER
if (isset($_POST['jumlah'])) {
    $jumlahSoal = $_POST['jumlahSoal'];
    if ($jumlahSoal < 5) {
        $_POST['error'] = "Minimal 5 soal!";
    } else if ($jumlahSoal > 50) {
        $_POST['error'] = "Maksimal 50 soal!";
    } else {
        $group = $jumlahSoal / 5;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Jawaban</title>
    <link rel="stylesheet" href="assets/css/input_jawaban.css">
    <style>

        .note {
            position: absolute;
            top: 75px;
            left: 50%;
            transform: translateX(-50%);
            background: #17617C;
            color: #fff;
            border-radius: 10px;
            padding: 5px 10px;
            z-index: 99;
            text-decoration: underline;
        }

        button.submit_jawaban {
            z-index: 99;
            position: absolute;
            bottom: -23px;
            left: 50%;
            transform: translateX(-50%);

            padding: 7px 25px;
            background: #17617C;
            border-radius: 10px;
            outline: none;
            border: none;

            font-family: inherit;
            font-weight: 600;
            font-size: 18px;
            color: #FFFFFF;
            cursor: pointer;
            transition: linear 150ms;
        }
        button.submit_jawaban:hover {
            background: #094257;
        }
    </style>
</head>

<body>
    <?php include $nav ?>

    <div class="container">
        <div class="center">
            <?php if (isset($_POST['error'])) : ?>
                <span style='color:red;font-style:italic;'><?= $_POST['error'] ?></span>
            <?php endif; ?>
            <form method="POST" action="" class="atas">
                <div class="group">
                    <label for="jumlahSoal">Jumlah soal</label>
                    <input type="text" name="jumlahSoal" id="jumlahSoal" placeholder="---------" <?php if($group > 0){echo "value=".$group*5;} ?>>
                </div>
                <button type="submit" name="jumlah">pilih</button>
            </form>

            <form method="POST" action="" class="bawah">
                <input type="hidden" name="jumlahSoal" value="<?=$group*5?>">
                <span class="note">Urutan pilihan: A | B | C | D</span>

                <div class="bawah">
                    <?php
                    // Jika group lebih dari 6 (30 soal)
                    if ($group > 6) {
                        echo "
                        <style>
                            div.container div.bawah {
                                justify-content: flex-start;
                            }
                        </style>
                        ";
                    }
                    ?>
                    <?php $no = 1;  ?>
                    <?php for ($a = 1; $a <= $group; $a++) { ?>
                        <div class="group">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <div class="input_group">
                                    <?php echo "<label for=" . $no . ">$no</label>" ?>
                                    <div class="right">
                                        <div class="input">
                                            <input type="radio" <?= "name=jawaban" .$no ?> <?= "id=jawaban" .$no ?> value="a">
                                        </div>
                                        <div class="input">
                                            <!-- <span>B</span> -->
                                            <input type="radio" <?= "name=jawaban" .$no ?> <?= "id=jawaban" .$no ?> value="b">
                                        </div>
                                        <div class="input">
                                            <!-- <span>C</span> -->
                                            <input type="radio" <?= "name=jawaban" .$no ?> <?= "id=jawaban" .$no ?> value="c">
                                        </div>
                                        <div class="input">
                                            <!-- <span>D</span> -->
                                            <input type="radio" <?= "name=jawaban" .$no ?> <?= "id=jawaban" .$no ?> value="d">
                                        </div>
                                    </div>
                                </div>
                                <?php $no++; ?>
                            <?php endfor; ?>
                            <!-- end div group -->
                        </div>
                    <?php }; ?>
                </div>
                <button type="submit" name="submitJawaban" class="submit_jawaban">submit</button>
            </form>
        </div>
    </div>
</body>

</html>