<?php
session_start();
// unset($_SESSION['id_ujian']);
// var_dump($_SESSION);
if (!isset($_SESSION['sesiLogin']) && $_SESSION['role'] !== "guru") {
    header("Location: ?page=login");
}

$guru = query("SELECT * FROM guru WHERE email='$_SESSION[sesiLogin]'")[0];

$listUjian = query("SELECT * FROM daftar_ujian WHERE id_guru='$guru[NIP]' ");

if (isset($_POST['submit'])) {
    // var_dump($_POST);
    if (!isset($_POST['id_ujian'])) {
        setToast("Pilih salah satu ujian");
    } else {
        header("Location: ?page=ubah_ujian&iu={$_POST['id_ujian']}");
    }
}


// DELETE FEATURE
if(isset($_GET['iu']) && isset($_GET['delete']) && isset($_SESSION['sesiLogin']) ) {
    $idUjian = $_GET['iu'];
    if(!mysqli_query($con, "DELETE FROM daftar_ujian WHERE id_ujian='$idUjian' AND id_guru='$guru[NIP]'")){
        setToast("Gagal menghapus ujian");
    }
    header("Location: ?page=pilih_ubah_ujian");
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Ujian</title>
    <link rel="stylesheet" href="assets/css/select.css">

    <!-- <link rel="stylesheet" href="assets/css/operator/pilihAbsensi.css"> -->
    <link rel="stylesheet" href="assets/css/guru/pilih_ujian.css">
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

    <?php include_once $nav ?>

    <div class="container">

        <a href="?page=operator" class="keluar">
            <i class="fa-solid fa-right-to-bracket"></i>
        </a>
        <!-- <h1 class="h1">Daftar Ujian</h1> -->

        <div class="form_container">
            <h3>Daftar ujian</h3>



            <form method="POST" action="" class="form_cari">
                <input type="text" name="cari" id="cari" placeholder="Cari ujian...">
                <button type="submit" name="cari" id="tombolCari" style="display: none;">Cari</button>
            </form>

            <form method="POST" action="" class="form_absensi">
                <ul class="list__group">
                    <?php $no = 1; ?>
                    <?php foreach ($listUjian as $ujian) : ?>
                        <li class="list__wrap">
                        <label for="<?= $ujian['id_ujian'] ?>" class="list">
                            <?= $no ?>.
                            <?= $ujian['judul'] ?>
                            /
                            <?= $ujian['tipe_ujian'] ?>
                        </label>
                        <a href="?page=pilih_ubah_ujian&iu=<?= $ujian['id_ujian'] ?>&delete" class="list-delete" onclick="return confirm('hapus?')">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                        </li>
                        <input type="radio" name="id_ujian" id="<?= $ujian['id_ujian'] ?>" style="display: none;" value="<?= $ujian['id_ujian'] ?>">
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