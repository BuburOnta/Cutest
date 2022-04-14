<?php 
$error = [];
$absensi = query("SELECT * FROM absensi");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Murid</title>
    <link rel="stylesheet" href="assets/css/select.css">

    <link rel="stylesheet" href="assets/css/operator/tampilAbsensi.css">
    <style>
        div.container a.keluar {
            font-size: 30px;
            color: #fafafa;
            position: absolute;
            left: 25px;
            top: 10px;
            transform: rotate(180deg);
        }

        div.container a.keluar:hover {
            color: #c5c5c5;
        }
    </style>
</head>

<body>
    <div class="container">

        <a href="?page=operator" class="keluar">
            <i class="fa-solid fa-right-to-bracket"></i>
        </a>
        <h1 class="h1">Absensi</h1>
        <form method="POST" action="">
        <h3>Hari & tanggal</h3>
            <!-- SELECT DROPDOWN -->
            <div class="select-container">
                <div class="select-box">
                    <?php if ($error == false) : ?>
                        <div class="options-container">
                            <?php foreach ($absensi as $absen) { ?>
                                <div class="option">
                                    <input type="radio" class="radio" id="<?= $absen['id_absen'] ?>" name="id_absen" value="<?= $absen['id_absen'] ?>" />
                                    <label for="<?= $absen['id_absen'] ?>" class="select">
                                        <span><?= $absen['tanggal'] ?> | <?= $absen['keterangan'] ?></span>
                                    </label>
                                </div>
                            <?php }; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($error) { ?>
                        <label class="selected">
                            <span>Saat ini tidak ada absensi</span>
                        </label>
                    <?php } else { ?>
                        <label class="selected">
                            <span>Pilih absensi</span>
                            <i class="fa-solid fa-circle-exclamation alertIcon satu"></i>
                        </label>
                    <?php }; ?>
                </div>
                <!-- end select -->
            </div>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>