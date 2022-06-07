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

//TODO TINGGAL BIKIN BACKEND BUAT UBAH UJIANNYA

//! JALANKAN SAAT BUTTON UBAH DITEKAN
if (isset($_POST['ubah_ujian'])) {
    // var_dump($_POST);
    // echo '<hr>';
    // var_dump($_FILES);
    // die;
    if( ubahUjian($_POST) > 0){
        // header("Location: ?page=ubah_ujian&iu=".$id_ujian);
        $_POST['success'] = true;
    } else {
        echo mysqli_errno($con);
    }
}

//* CEK ERROR
if (isset($_POST["errorJawaban"])) {
    for ($i = 0; $i < count($_POST["errorJawaban"]); $i++) {
        $errorJawaban[] = $_POST['errorJawaban'][$i];
    }
} else {
    $errorJawaban = [];
}

//! CEK INPUT JUMLAH SOAL DARI USER
if (isset($_POST['jumlah'])) {
    $jumlahSoal = $_POST['jumlahSoal'];
    if ($jumlahSoal < 5) {
        $_POST['error'] = "Minimal 5 soal!";
    } else if ($jumlahSoal > 50) {
        $_POST['error'] = "Maksimal 50 soal!";
    } else {
        $group = $jumlahSoal;
    }
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
$tipeUjian = [
    ["tipeUjian" => "UH", "keterangan" => "Ulangan Harian"],
    ["tipeUjian" => "UP", "keterangan" => "Ujian Praktek"],
    ["tipeUjian" => "PTS", "keterangan" => "Penilaian Tengah Semester"],
    ["tipeUjian" => "PAS", "keterangan" => "Penilaian Akhir Semester"]
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian</title>
    <link rel="stylesheet" href="assets/css/select.css">
    <link rel="stylesheet" href="assets/css/guru/ubah_ujian.css">
    <link rel="stylesheet" href="assets/css/succesAnimation.css">
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <?php toast() ?>
    <?php include_once $nav ?>

    <?php if (isset($_POST['success'])) : ?>
        <div class="success-animation">
            <h1>Data Ujian berhasil diubah</h1>
            <span>mohon tunggu sebentar</span>
        </div>

        <script>
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const iu = urlParams.get("iu")
            console.log(iu)
            setTimeout(() => {
                window.location.href = "?page=ubah_ujian&iu="+iu
            }, 3000);
        </script>
    <?php endif; ?>

    <div class="container">
        <a href="?page=pilih_ubah_ujian" id="keluar">
            <i class="fa-solid fa-right-to-bracket"></i>
        </a>

        <div class="peringatan">
            
            <span>Melakukan perubahan akan mereset semua hasil ujian murid. <button class="peringatan-close">X</button></span>
        </div>

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
            <form method="POST" action="" class="form-jumlah-soal">
                <div class="group">
                    <label for="jumlahSoal">Jumlah soal</label>
                    <input type="text" name="jumlahSoal" id="jumlahSoal" placeholder="---------" <?php if ($group > 0) {echo "value=" . $group;} ?>>
                </div>
                <button type="submit" name="jumlah">pilih</button>
            </form>

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
                                    <?= "id=jawaban" . $no ?> class="jawaban-a jawaban<?= $no ?>"
                                    value="a">
                                </div>
                                <div class="input">
                                    <!-- <span>B</span> -->
                                    <input type="radio"
                                        name="jawaban<?= $no ?>"
                                        id="jawaban<?= $no ?>" class="jawaban-b jawaban<?= $no ?>"
                                        value="b">
                                </div>
                                <div class="input">
                                    <!-- <span>C</span> -->
                                    <input type="radio" <?= "name=jawaban" . $no ?>
                                    <?= "id=jawaban" . $no ?> class="jawaban-c jawaban<?= $no ?>"
                                    value="c">
                                </div>
                                <div class="input">
                                    <!-- <span>D</span> -->
                                    <input type="radio" <?= "name=jawaban" . $no ?>
                                    <?= "id=jawaban" . $no ?> class="jawaban-d jawaban<?= $no ?>"
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
                        <!-- SELECT DROPDOWN -->
                    </div>
                    <div class="select-container">
                        <div class="select-box">
                            <div class="options-container">
                                <?php foreach ($tipeUjian as $tipe) { ?>
                                <div class="option">
                                    <!-- <input type="hidden" name="id_ujian" value="//$tipe[0]['id_ujian'] "> -->
                                    <input type="radio" class="radio"
                                        id="<?=$tipe['tipeUjian']?>"
                                        name="tipeUjian"
                                        value="<?= $tipe['tipeUjian'] ?>" />
                                    <label
                                        for="<?=$tipe['tipeUjian']?>"
                                        class="select"><span><?= $tipe['keterangan'] ?></span></label>
                                </div>
                                <?php }; ?>
                            </div>

                            <label class="selected">
                                <img src="assets/img/ujian_vector.svg">
                                <span>Tipe Ujian</span>
                            </label>
                        </div>
                        <!-- end select -->
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

    
    <script src="assets/js/select2.js"></script>
    <script>
        const ujian = <?php echo json_encode($daftar) ?>;
        const selectInput = document.getElementsByName("tipeUjian")
        selectInput.forEach((select) => {
            if(ujian.tipe_ujian == select.id) {
                select.checked = true
            }
        })
        switch (ujian.tipe_ujian) {
            case "UH":
                ujian.tipe_ujian = "Ulangan Harian"
                break;
                case "UP":
                    ujian.tipe_ujian = "Ujian Praktek"
                    break;
                    case "PTS":
                        ujian.tipe_ujian = "Penilaian Tengah Semester"
                        break;
            case "PAT":
                ujian.tipe_ujian = "Penilaian Akhir Semester"
                break;
                
                default:
                    ujian.tipe_ujian
                    break;
        }
        // console.log(ujian)
        selected.innerText = ujian.tipe_ujian


        //! Memberikan Warna pada jawaban yang benar 
        const soalUjians = <?php echo json_encode($soal) ?> ;
        

        // let no = 1
        // for (let i = 0; i < obj.length; i++) {
        //     const soals = obj[i]
        //     const soalU = document.querySelector('#jawaban' + no)
        //     // console.log(soalU)
        //     // console.log(soalU)
        //     let soalsPair = "jawaban" + soals.nomor_soal
        //     // console.log(soalsPair)
        
        //     if (soalsPair == soalU.id) {
        //         if(soals.jawaban == soalU.value){
            //         soalU.checked = true
            //         soalU.value = soals.jawaban
            //         }
            //     } else {
                //         // soalU.classList.checked = false
                //     }
                //     no++
                // }
                
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
        // console.log(fileName)    
        const fil = document.getElementById("files");
        const teks = document.querySelector(".tambah");
        const plus = document.getElementById("plus");
        
        teks.innerHTML = fileName.judul;
        // console.log(fil.files)
        teks.style.textDecoration = "underline";
        // console.log(teks.style.textDecoration)
        plus.style.display = 'none';
        
        //! Input Files Effect
        fil.addEventListener("change", function(e) {
            let newText = fil.value.replace("C:\\fakepath\\", "");
            teks.innerHTML = newText;
            teks.style.textDecoration = "underline";
            plus.style.display = 'none';
        });
    </script>
<script src="assets/js/ubah_ujian.js"></script>
</body>

</html>