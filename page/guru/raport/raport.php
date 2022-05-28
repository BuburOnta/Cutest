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
    ["id_status" => "selesai", "status" => "Selesai"],
    ["id_status" => "belum submit", "status" => "Belum selesai"]
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
if (isset($_POST['search'])) {
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
</head>

<body>
    <?php include_once $nav ?>

    <div class="center">
        <div class="container">
            <a href="?page=murid" class="keluar">
                <!-- <i class="fa-solid fa-right-to-bracket"></i> -->
                Kembali
            </a>

            <div class="content">
                <table cellspacing='0' id="table-raport" class="table table-striped table-bordered data">
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

                    <?php $no = 1; ?>
                    <tbody>
                        <?php foreach ($daftarUjian as $ujian) { ?>
                            <tr>
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
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
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