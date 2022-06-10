<?php
session_start();
if (!isset($_SESSION['sesiLogin'])) {
    header("Location: ?page=murid");
}

$users = query("SELECT * FROM users WHERE email='$_SESSION[sesiLogin]'")[0];
$idAbsensi = $_SESSION['id_absen'];

// --- Mengambil data dari akses_absensi
// $daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' ORDER BY id DESC");
$query = "SELECT * FROM akses_absensi INNER JOIN absensi ON akses_absensi.id_absensi=absensi.id_absen 
                                    INNER JOIN users ON akses_absensi.id_murid=users.id_user 
                                    INNER JOIN kelas ON users.kelas=kelas.id_kelas 
                                    INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan 
                                    WHERE akses_absensi.id_absensi='$idAbsensi' ";
$listAbsensi = query($query);


$kelas = query("SELECT * FROM kelas");
$jurusan = query("SELECT * FROM jurusan");
$keterangan = [
    ["id_keterangan" => "Hadir", "keterangan" => "Hadir"],
    ["id_keterangan" => "Sakit", "keterangan" => "Sakit"],
    ["id_keterangan" => "Izin", "keterangan" => "Izin"]
];

// Sorting
$error = [];
$values = [];
$errorKeys = ['kelas', 'jurusan', 'keterangan'];

// --- Filter
if (isset($_POST['filter'])) {
    $kelasF = $_POST['kelas'];
    $jurusanF = $_POST['jurusan'];
    $keteranganF = $_POST['keterangan'];

    if (!empty(trim($kelasF)) && !empty(trim($jurusanF)) && !empty(trim($keteranganF))) { // 3 Sorting
        $query = "SELECT * FROM akses_absensi INNER JOIN absensi ON akses_absensi.id_absensi=absensi.id_absen INNER JOIN users ON akses_absensi.id_murid=users.id_user INNER JOIN kelas ON users.kelas=kelas.id_kelas INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan WHERE akses_absensi.id_absensi='$idAbsensi' AND kelas.id_kelas='$kelasF' AND jurusan.id_jurusan='$jurusanF' AND akses_absensi.keterangan='$keteranganF' ";
        $listAbsensi = query($query);
    } elseif (!empty(trim($kelasF)) && !empty(trim($jurusanF))) { // 2 sorting
        $query = "SELECT * FROM akses_absensi INNER JOIN absensi ON akses_absensi.id_absensi=absensi.id_absen INNER JOIN users ON akses_absensi.id_murid=users.id_user INNER JOIN kelas ON users.kelas=kelas.id_kelas INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan WHERE akses_absensi.id_absensi='$idAbsensi' AND kelas.id_kelas='$kelasF' AND jurusan.id_jurusan='$jurusanF' ";
        $listAbsensi = query($query);
    } elseif (!empty(trim($kelasF)) && !empty(trim($keteranganF))) { // 2 sorting
        $query = "SELECT * FROM akses_absensi INNER JOIN absensi ON akses_absensi.id_absensi=absensi.id_absen INNER JOIN users ON akses_absensi.id_murid=users.id_user INNER JOIN kelas ON users.kelas=kelas.id_kelas INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan WHERE akses_absensi.id_absensi='$idAbsensi' AND kelas.id_kelas='$kelasF' AND akses_absensi.keterangan='$keteranganF' ";
        $listAbsensi = query($query);
    } elseif (!empty(trim($jurusanF)) && !empty(trim($keteranganF))) { // 2 sorting
        $query = "SELECT * FROM akses_absensi INNER JOIN absensi ON akses_absensi.id_absensi=absensi.id_absen INNER JOIN users ON akses_absensi.id_murid=users.id_user INNER JOIN kelas ON users.kelas=kelas.id_kelas INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan WHERE akses_absensi.id_absensi='$idAbsensi' AND jurusan.id_jurusan='$jurusanF' AND akses_absensi.keterangan='$keteranganF' ";
        $listAbsensi = query($query);
    } elseif (!empty(trim($kelasF))) { // 1 sorting
        $query = "SELECT * FROM akses_absensi INNER JOIN absensi ON akses_absensi.id_absensi=absensi.id_absen INNER JOIN users ON akses_absensi.id_murid=users.id_user INNER JOIN kelas ON users.kelas=kelas.id_kelas INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan WHERE akses_absensi.id_absensi='$idAbsensi' AND kelas.id_kelas='$kelasF' ";
        $listAbsensi = query($query);
    } elseif (!empty(trim($jurusanF))) { // 1 sorting
        $query = "SELECT * FROM akses_absensi INNER JOIN absensi ON akses_absensi.id_absensi=absensi.id_absen INNER JOIN users ON akses_absensi.id_murid=users.id_user INNER JOIN kelas ON users.kelas=kelas.id_kelas INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan WHERE akses_absensi.id_absensi='$idAbsensi' AND jurusan.id_jurusan='$jurusanF' ";
        $listAbsensi = query($query);
    } elseif (!empty(trim($keteranganF))) { // 1 sorting
        $query = "SELECT * FROM akses_absensi INNER JOIN absensi ON akses_absensi.id_absensi=absensi.id_absen INNER JOIN users ON akses_absensi.id_murid=users.id_user INNER JOIN kelas ON users.kelas=kelas.id_kelas INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan WHERE akses_absensi.id_absensi='$idAbsensi' AND akses_absensi.keterangan='$keteranganF' ";
        $listAbsensi = query($query);
    }
}

// -- SEarch
if (isset($_POST['search'])) {
    $nama = htmlspecialchars($_POST['nama']);
    // echo $nama;
    $query = "SELECT * FROM akses_absensi INNER JOIN absensi ON akses_absensi.id_absensi=absensi.id_absen 
                                    INNER JOIN users ON akses_absensi.id_murid=users.id_user 
                                    INNER JOIN kelas ON users.kelas=kelas.id_kelas 
                                    INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan 
                                    WHERE akses_absensi.id_absensi='$idAbsensi' AND users.nama='$nama' OR users.nama LIKE '%$nama%' ";
    $listAbsensi = query($query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport</title>
    <link rel="stylesheet" href="assets/css/operator/tampilAbsensi.css">
    <!-- <link rel="stylesheet" href="assets/css/guru/raport.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
</head>

<body>
    <nav class="head">
        <div class="left">
            <img src="assets/img/cutest_logo_text.svg">
        </div>
        <div class="right">
            <span><?= $users['email'] ?></span>
            <img src="assets/img/profile_icon.png">
        </div>
    </nav>

    <div class="center">
        <div class="container">
            <a href="?page=pilihAbsensi" class="keluar">
                Kembali
            </a>

            <div class="content">
                <div class="sorter">
                    <form method="POST" action="">
                        <span>Filter By : </span>
                        <select name="kelas" id="kelas">
                            <option value="" hidden selected>Kelas</option>
                            <?php foreach ($kelas as $kel) : ?>
                                <option value="<?= $kel['id_kelas'] ?>">
                                    <?= $kel['kelas'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <select name="jurusan" id="jurusan">
                            <option value="" hidden selected>Jurusan</option>
                            <?php foreach ($jurusan as $jur) : ?>
                                <option value="<?= $jur['id_jurusan'] ?>">
                                    <?= $jur['id_jurusan'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <select name="keterangan" id="keterangan">
                            <option value="" hidden selected>Keterangan</option>
                            <?php foreach ($keterangan as $ket) : ?>
                                <option value="<?= $ket['id_keterangan'] ?>">
                                    <?= $ket['keterangan'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <button type="submit" name="filter">Filter</button>
                    </form>
                </div>

                <div class="ajakx">
                    <table cellspacing='0' id="table-raport" class="table table-striped table-bordered data">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Keterangan</th>
                            <th>Alasan</th>
                            <th>Waktu absensi</th>
                        </thead>

                        <style>
                            div.container div.center {
                                align-items: flex-start;
                            }
                        </style>
                        <?php $no = 1; ?>
                        <?php foreach ($listAbsensi as $absen) { ?>
                            <?php if ($absen['alasan'] == "NULL") {
                                $absen['alasan'] = "-";
                            } ?>
                            <tbody>
                                <td><?= $no ?>
                                </td>
                                <td><?= $absen['nama'] ?>
                                </td>
                                <td><?= $absen['kelas'] ?>
                                </td>
                                <td><?= $absen['jurusan'] ?>
                                </td>
                                <td><?= $absen['keterangan'] ?>
                                </td>
                                <td><?= $absen['alasan'] ?>
                                </td>
                                <td><?= $absen['waktu_absen'] ?>
                                </td>
                            </tbody>
                        <?php $no++;
                        } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('.data').DataTable();
        });
    </script>
</body>

</html>