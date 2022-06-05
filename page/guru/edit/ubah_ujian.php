<?php
session_start();
if (!isset($_SESSION['sesiLogin'])) {
    header("Location: ?page=login");
}

$group = 0; // nilai default jumlahSoal
$guru = query("SELECT * FROM guru WHERE email='$_SESSION[sesiLogin]'")[0];


// --- Mengambil soal
$id_ujian = $_GET['iu'];
if (!$soal = query("SELECT * FROM soal_ujian LEFT JOIN daftar_ujian ON soal_ujian.id_ujian=daftar_ujian.id_ujian WHERE soal_ujian.id_ujian='$id_ujian' AND id_guru='$guru[NIP]' ")) {
    $_POST['error'] = "Gagal menampilkan soal ujian";
} else {
    // $group = $soal['nomor_soal'];
    // var_dump($soal);
    $group = $soal[count($soal) - 1]['nomor_soal'];
}

// --- Mengambil daftar ujian
if (!$daftar = query("SELECT * FROM daftar_ujian WHERE id_ujian='$id_ujian' AND id_guru='$guru[NIP]' ")[0]) {
    $_POST['error'] = "Gagal menampilkan soal ujian";
} else {
}
// var_dump($daftar);


// --- Mengambil Akses Ujian
if (!$aksesUjian = query("SELECT * FROM akses_ujian 
                          LEFT JOIN daftar_ujian ON akses_ujian.id_ujian=daftar_ujian.id_ujian
                          WHERE akses_ujian.id_ujian='$id_ujian' AND id_guru='$guru[NIP]' ")) {
    $_POST['error'] = "Gagal menampilkan soal ujian";
} else {
}
// var_dump($aksesUjian);

//TODO TINGGAL BIKIN BACKEND BUAT UBAH UJIANNYA

//! JALANKAN SAAT BUTTON UBAH DITEKAN
if (isset($_POST['ubah_ujian'])) {
    var_dump($_POST);
}

//* CEK ERROR
if (isset($_POST["errorJawaban"])) {
    for ($i = 0; $i < count($_POST["errorJawaban"]); $i++) {
        $errorJawaban[] = $_POST['errorJawaban'][$i];
    }
} else {
    $errorJawaban = [];
}

//* SOAL UJIAN
$path = $baseurl.'/assets/converted-pdf/'.$daftar['file'];
$soalUjian = array_values(array_diff(scandir($path), array('.', '..')));

//* KELAS
$kelas = [
    ["judul" => "X RPL"],
    ["judul" => "XI RPL"],
    ["judul" => "XII RPL"],
    ["judul" => "X PPLG"],
    ["judul" => "XI PPLG"],
    ["judul" => "XII PPLG"],
    ["judul" => "X MM"],
    ["judul" => "XI MM"],
    ["judul" => "XII MM"],
    ["judul" => "X DKV"],
    ["judul" => "XI DKV"],
    ["judul" => "XII DKV"],
    ["judul" => "X TBSM"],
    ["judul" => "XI TBSM"],
    ["judul" => "XII TBSM"],
    ["judul" => "X TKRO"],
    ["judul" => "XI TKRO"],
    ["judul" => "XII TKRO"],
    ["judul" => "X APH"],
    ["judul" => "XI APH"],
    ["judul" => "XII APH"],
    ["judul" => "X AKL"],
    ["judul" => "XI AKL"],
    ["judul" => "XII AKL"],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian</title>
    <link rel="stylesheet" href="assets/css/guru/ubah_ujian.css">
    <link rel="stylesheet" href="assets/css/succesAnimation.css">
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <?php //include_once $nav_ujian
    ?>
    <div class="logo">
        <img src="assets/img/cutest_logo_text.svg">
    </div>

    <?php if (isset($_POST['success'])) : ?>
    <script>
        setTimeout(() => {}, 2000);
    </script>

    <div class="centering">
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
            <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
        </svg>
    </div>

    <script>
        setTimeout(() => {
            window.location.href = "?page=murid";
        }, 4000);
    </script>
    <?php endif; ?>

    <div class="container">
        <div class="left">

            <div class="soal-ujian">
                <img src="assets/converted-pdf/<?= $daftar['file'] ?>/<?= $daftar['file'] ?>.jpg"
                    alt="">
                <?php for ($i = 1; $i < count($soalUjian); $i++) { ?>
                <img src="assets/converted-pdf/<?= $daftar['file'] ?>/<?= $daftar['file'] . '-' . $i ?>.jpg"
                    alt="">
                <?php } ?>
            </div>
        </div>

        <div class="right-side">
            <span class="note">Urutan pilihan: A | B | C | D</span>
            <div class="jawaban">
                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="jumlahSoal"
                        value="<?= $group ?>">

                    <div class="bawah">
                        <?php $no = 1;
                        $o = 0; ?>
                        <?php for ($i = 1; $i <= $group; $i++) : ?>
                        <div class="input_group">

                            <!-- Menandai Label dari Jawaban Yang Kosong -->
                            <?php if (in_array("f" . $i, $errorJawaban)) { ?>
                            <label for="jawaban<?= $no ?>"
                                style=color:red;><?= $i ?>*</label>
                            <?php } else { ?>
                            <label for="jawaban<?= $no ?>"><?= $no ?></label>
                            <?php } ?>


                            <div class="right">
                                <div class="input">
                                    <input type="radio" <?= "name=jawaban" . $no ?>
                                    <?= "id=jawaban" . $no ?>
                                    value="a">
                                </div>
                                <div class="input">
                                    <!-- <span>B</span> -->
                                    <input type="radio"
                                        name="jawaban<?= $no ?>"
                                        id="jawaban<?= $no ?>"
                                        value="b">
                                </div>
                                <div class="input">
                                    <!-- <span>C</span> -->
                                    <input type="radio" <?= "name=jawaban" . $no ?>
                                    <?= "id=jawaban" . $no ?>
                                    value="c">
                                </div>
                                <div class="input">
                                    <!-- <span>D</span> -->
                                    <input type="radio" <?= "name=jawaban" . $no ?>
                                    <?= "id=jawaban" . $no ?>
                                    value="d">
                                </div>
                            </div>

                        </div>
                        <?php $no++;
                        $o++; ?>
                        <?php endfor; ?>
                    </div>

            </div>
        </div>
        <!-- </div> -->
    </div>

    <div class="button-wrap"><button type="submit" name="ubah_ujian" class="ubah_ujian">Ubah</button></div>

    <!-- //! CONTAINER 2 -->
    <div class="container-2">
        <div class="wrapper">
        <label class="left" for="files">
            <a href="?page=guru" class="keluar">
                <i class="fa-solid fa-right-to-bracket"></i>
            </a>
            <img src="assets/img/input_ujian_paper.svg">
            <img src="assets/img/input_ujian_plus.svg" id="plus">
            <span class="tambah">Tambah soal</span>
            <span class="note">Note: File soal harus berbentuk PDF!</span>
        </label>
        <input type="file" name="files" id="files" style="display: none;">


        <div class="right">
            <div class="right_left">
                <div class="form_group judul">
                    <label for="judul">Judul Ujian</label>
                    <input type="text" name="judul" id="judul"
                        value="<?= $daftar['judul'] ?>">
                </div>
            </div>


            <div class="right_right">
                <h3>Kelas Dan jurusan</h3>
                <div class="select_all">
                    <input type="checkbox" id="select_all" onclick="toggle(this)">
                    <label for="select_all">Select All</label>
                </div>
                <!-- <div>P</div> -->
                <div class="form_group checkbox">
                    <?php $no = 1; foreach ($kelas as $kls): ?>
                    <div class="input"><?= $kls['judul'] ?><input
                            type="checkbox" name="kelas[]" id="kelas"
                            class="kj<?= $no ?>"
                            value="<?= $no ?>"></div>
                    <?php $no++; endforeach; ?>
                </div>
            </div>
        </div>

        </div>
        </form>
    </div>


    <script>
        //! Memberikan Warna pada jawaban yang benar 
        const obj = <?php echo json_encode($soal) ?> ;

        let no = 1
        for (let i = 0; i < obj.length; i++) {
            const soals = obj[i]
            const soalU = document.querySelector('#jawaban' + no)

            if (soals.jawaban == soalU.value) {
                // console.log("ASUUU")
                soalU.classList.add("jawaban-benar")
                // console.log(soalU)
            } else {
                soalU.classList.remove("jawaban-benar")
            }
            no++
        }

        //! Memberikan Centang pada Kelas Dan Jurusan
        const kejur = <?php echo json_encode($aksesUjian) ?> ;
        const kejurs = document.getElementsByName("kelas[]")
        kejur.forEach((kj) => {
            kejurs.forEach((kjs) => {
                if (kj.kelas_jurusan == kjs.value) {
                    kjs.checked = true
                }
            })
        })

        //! Mengubah nama file
        const fileName = kejur[0]
        console.log(fileName)
        const fil = document.getElementById("files");
        const teks = document.querySelector(".tambah");
        const plus = document.getElementById("plus");

        teks.innerHTML = fileName.judul;
        teks.style.textDecoration = "underline";
        plus.style.display = 'none';
    </script>
</body>

</html>