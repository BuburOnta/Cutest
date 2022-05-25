<?php
session_start();

$error = [];
$listAbsensi = query("SELECT * FROM absensi");
if (isset($_POST['submit'])) {
    if (!isset($_POST['id_absen'])) {
        $_POST['error'] = "Pilih salah satu absensi";
        setToast("Pilih salah satu absensi");
    } else {
        $_SESSION['id_absen'] = $_POST['id_absen'];
        header("Location: ?page=tampilAbsensiOP");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Murid</title>
    <link rel="stylesheet" href="assets/css/select.css">

    <link rel="stylesheet" href="assets/css/operator/pilihAbsensi.css">
    <link rel="stylesheet" href="assets/css/error-slide-down.css">
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
    <?php toast() ?>
    <div class="container">

        <a href="?page=operator" class="keluar">
            <i class="fa-solid fa-right-to-bracket"></i>
        </a>
        <h1 class="h1">Absensi</h1>

        <div class="form_container">
            <h3>Hari & tanggal</h3>



            <form method="POST" action="" class="form_cari">
                <input type="text" name="cari" id="cari" placeholder="Cari absen...">
                <button type="submit" name="cari" id="tombolCari" style="display: none;">Cari</button>
            </form>

            <form method="POST" action="" class="form_absensi">
                <ul class="list__group">
                    <?php $no = 1; ?>
                    <?php foreach ($listAbsensi as $absensi) : ?>
                        <label for="<?= $absensi['id_absen'] ?>" class="list">
                            <?= $no ?>.
                            <?= $absensi['absensi'] ?>
                            /
                            <?= $absensi['tanggal'] ?>
                        </label>
                        <input type="radio" name="id_absen" id="<?= $absensi['id_absen'] ?>" style="display: none;" value="<?= $absensi['id_absen'] ?>">

                        <?php $no++; ?>
                    <?php endforeach; ?>
                </ul>

                <button type="submit" name="submit">Pilih</button>
            </form>
        </div>
    </div>

    <script>
        const listGroup = document.querySelector('.list__group')
        const pilih = document.querySelectorAll('.list')

        listGroup.addEventListener('click', (e) => {
            console.log(e.target.tagName)
            if (e.target.tagName == 'LABEL') {
                const list = e.target

                pilih.forEach(el => {
                    if (el.classList.contains('active')) {
                        el.classList.remove('active')
                    }
                })

                list.classList.add('active')
            }
        })
    </script>
    <script src="assets/js/liveSearch.js"></script>
</body>

</html>