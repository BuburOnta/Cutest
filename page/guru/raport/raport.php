<?php
session_start();
if (!isset($_SESSION['sesiLogin'])) {
    header("Location: ?page=murid");
}

$guru = query("SELECT * FROM guru WHERE email='$_SESSION[sesiLogin]'")[0];
// --- Mengambil data dari murid_ujian
$daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' ORDER BY id DESC");
// $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_ujian='1' ORDER BY id DESC");
// var_dump($daftarUjian);

$kelas = query("SELECT * FROM kelas");
$jurusan = query("SELECT * FROM jurusan");
$ujian = query("SELECT * FROM daftar_ujian WHERE id_guru='$guru[NIP]'");
$status = [
    ["id_status"=>"selesai","status"=>"Selesai"],
    ["id_status"=>"belum submit","status"=>"Belum selesai"]
];

// --- Filter
if (isset($_POST['filter'])) {
    $kelasF = $_POST['kelas'];
    $jurusanF = $_POST['jurusan'];
    $ujianF = $_POST['ujian'];
    $statusF = $_POST['status'];
    if (!empty(trim($kelasF)) && !empty(trim($jurusanF)) && !empty(trim($ujianF && !empty(trim($statusF))))) {
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND daftar_ujian.id_ujian='$ujianF' AND kelas.id_kelas='$kelasF' AND jurusan.id_jurusan='$jurusanF' AND murid_ujian.keterangan='$statusF' ORDER BY id DESC");
    } elseif (!empty(trim($kelasF)) && !empty(trim($jurusanF)) && !empty(trim($ujianF))) { // 3 Sorting
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND daftar_ujian.id_ujian='$ujianF' AND kelas.id_kelas='$kelasF' AND jurusan.id_jurusan='$jurusanF' ORDER BY id DESC");
    } elseif (!empty(trim($kelasF)) && !empty(trim($jurusanF)) && !empty(trim($statusF))) { // 3 Sorting
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND kelas.id_kelas='$kelasF' AND jurusan.id_jurusan='$jurusanF' AND murid_ujian.keterangan='$statusF' ORDER BY id DESC");
    } elseif (!empty(trim($jurusanF)) && !empty(trim($ujianF)) && !empty(trim($statusF))) { // 3 Sorting
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND daftar_ujian.id_ujian='$ujianF' AND jurusan.id_jurusan='$jurusanF' AND murid_ujian.keterangan='$statusF' ORDER BY id DESC");
    } elseif (!empty(trim($ujianF)) && !empty(trim($statusF)) && !empty(trim($kelasF))) { // 3 Sorting
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND daftar_ujian.id_ujian='$ujianF' AND kelas.id_kelas='$kelasF' AND murid_ujian.keterangan='$statusF' ORDER BY id DESC");
    } elseif (!empty(trim($kelasF)) && !empty(trim($jurusanF))) {
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND daftar_ujian.id_ujian='1' AND kelas.id_kelas='$kelasF' AND jurusan.id_jurusan='$jurusanF' ORDER BY id DESC");
    } elseif (!empty(trim($kelasF)) && !empty(trim($ujianF))) {
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND daftar_ujian.id_ujian='$ujianF' AND kelas.id_kelas='$kelasF' ORDER BY id DESC");
    } elseif (!empty(trim($jurusanF)) && !empty(trim($ujianF))) {
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND jurusan.id_jurusan='$jurusanF' AND daftar_ujian.id_ujian='$ujianF' ORDER BY id DESC");
    } elseif (!empty(trim($statusF)) && !empty(trim($ujianF))) {
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND murid_ujian.keterangan='$statusF' AND daftar_ujian.id_ujian='$ujianF' ORDER BY id DESC");
    } elseif (!empty(trim($statusF)) && !empty(trim($kelasF))) {
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND murid_ujian.keterangan='$statusF' AND kelas.id_kelas='$kelasF' ORDER BY id DESC");
    } elseif (!empty(trim($statusF)) && !empty(trim($jurusanF))) {
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND murid_ujian.keterangan='$statusF' AND jurusan.id_kelas='$jurusanF' ORDER BY id DESC");
    } elseif (!empty(trim($kelasF))) {
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND kelas.id_kelas='$kelasF' ORDER BY id DESC");
    } elseif (!empty(trim($jurusanF))) {
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND jurusan.id_jurusan='$jurusanF' ORDER BY id DESC");
    } elseif (!empty(trim($ujianF))) {
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND daftar_ujian.id_ujian='$ujianF' ORDER BY id DESC");
    } elseif (!empty(trim($statusF))) {
        $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND murid_ujian.keterangan='$statusF' ORDER BY id DESC");
    }
}

// -- SEarch
if(isset($_POST['search'])) {
    $nama = htmlspecialchars($_POST['nama']);
    // echo $nama;
    $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND users.nama='$nama' OR users.nama LIKE '%$nama%' ORDER BY id DESC");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport</title>
    <link rel="stylesheet" href="assets/css/guru/raport.css">
    <style>
        div.container div.center {
            width: 900px;
            max-height: 450px;
            overflow: auto;
            /* padding: 0 20px; */
            padding: 30px 10px;
            padding-top: 0;
            overflow-x: hidden;
            /* flex-direction: column; */
            /* align-items: center; */
            /* justify-content: flex-start; */
        }

        div.center a.keluar {
            font-size: 30px;
            color: #fff;
            position: absolute;
            left: 20px;
            top: 15px;
            transform: rotate(180deg);
            z-index: 99;
        }

        div.center a.keluar:hover {
            color: #ddd;
        }

        div.content {
            position: relative;
            width: 700px;
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .sorter {
            top: 25px;
            color: #333;
        }
        .sorter button, .searchNama button {
            padding: 0 5px;
        }
        .searchNama {
            color: #333;
            margin: 5px 0;
        }
        .searchNama input, .sorter input {
            border-radius: 5px;
            border: none;
            padding: 1px 0;
            padding-left: 10px;
            font-size: 12px;
            /* outline: none; */
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>

<body>
    <?php include_once $nav ?>
    <style>
        nav.head {
            color: #fff;
        }

        nav.head .left img {
            filter: none;
        }

        nav.head div.center h1 {
            color: #fff;
            font-style: normal;
            font-weight: 300;
            font-size: 21px;
            letter-spacing: 0.02em;
            color: #FFFFFF;
        }
    </style>
    <div class="container">
        <div class="center">
            <a href="?page=murid" class="keluar">
                <i class="fa-solid fa-right-to-bracket"></i>
            </a>

            <div class="content">
                <div class="sorter">
                    <form method="POST" action="">
                        <span>Filter By : </span>
                        <select name="kelas" id="kelas">
                            <option value="" hidden selected>Kelas</option>
                            <?php foreach ($kelas as $kel): ?>
                            <option
                                value="<?=$kel['id_kelas']?>">
                                <?= $kel['kelas'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>

                        <select name="jurusan" id="jurusan">
                            <option value="" hidden selected>Jurusan</option>
                            <?php foreach ($jurusan as $jur): ?>
                            <option
                                value="<?= $jur['id_jurusan'] ?>">
                                <?= $jur['id_jurusan'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>

                        <select name="ujian" id="ujian">
                            <option value="" hidden selected>Ujian</option>
                            <?php foreach ($ujian as $uji): ?>
                            <option
                                value="<?= $uji['id_ujian'] ?>">
                                <?= $uji['judul'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>

                        <select name="status" id="status">
                            <option value="" hidden selected>Status</option>
                            <?php foreach ($status as $stat): ?>
                            <option
                                value="<?= $stat['id_status'] ?>">
                                <?= $stat['status'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>

                        <button type="submit" name="filter">Filter</button>
                    </form>
                </div>

                <div class="searchNama">
                    <form method="POST" action="">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" placeholder="Cari peserta">
                        <button type="submit" name="search">Cari</button>
                    </form>
                </div>
                <!-- <div id="table-reports"> -->
                <table cellspacing='0' id="table-raport">
                    <thead>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                        <th>Prediket</th>
                        <th>Ket.</th>
                        <th>Waktu Selesai</th>
                    </thead>

                    <?php //if(count($daftarUjian) > 10){?>
                    <style>
                        div.container div.center {
                            /* justify-content: flex-start; */
                            align-items: flex-start;
                            /* padding: 30px 10px; */
                            /* padding-top: 60px; */
                        }
                    </style>
                    <?php //}?>
                    <div id="tableValue">
                    <?php $no = 1; ?>
                    <?php foreach ($daftarUjian as $ujian) { ?>
                    <tbody>
                        <td><?= $no ?>
                        </td>
                        <td><?= $ujian['judul'] ?>
                        </td>
                        <td><?= $ujian['kelas'] ?>
                        </td>
                        <td><?= $ujian['jurusan'] ?>
                        </td>
                        <td><?= $ujian['nama'] ?>
                        </td>
                        <td><?= $ujian['nilai'] ?>
                        </td>
                        <td><?= $ujian['predikat'] ?>
                        </td>
                        <td><?= $ujian['tipe_ujian'] ?>
                        </td>
                        <td><?= $ujian['waktu_selesai'] ?>
                        </td>
                    </tbody>
                    <?php $no++;
                    } ?>
                    </div>
                </table>
                <!-- </div> -->
            </div>
        </div>
    </div>
    <script src="assets/js/liveSearch.js"></script>
    <script>
        liveSearch('nama','#tableValue', 'raportGuru.php')
    </script>
</body>

</html>