<?php
session_start();
if (!isset($_SESSION['sesiLogin'])) {
    header("Location: ?page=murid");
}

// var_dump($_SESSION);
// --- Mengambil data dari murid_ujian
$users = query("SELECT * FROM users INNER JOIN kelas ON users.kelas=kelas.id_kelas INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan WHERE email='$_SESSION[sesiLogin]' ")[0];
$daftarUjian = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan WHERE id_murid='$users[id_user]' ORDER BY id DESC");
// var_dump($daftarUjian);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="assets/css/murid/raport.css">

    <style>
        .logo {
            position: absolute;
            top: 20px;
            left: 50px;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="assets/img/cutest_logo_text.svg" onclick="window.location.href = '?page=murid';">
    </div>
    <div class="center">
        <div class="container">
            <a href="?page=murid" class="keluar">
                <i class="fa-solid fa-right-to-bracket"></i>
            </a>

            <h1>
                <?= $users['nama'] ?> | <?= $users['kelas'] ?> <span style="text-transform:uppercase;"><?= $users['id_jurusan'] ?></span> | <?= $users['jurusan'] ?>
            </h1>
            <div class="content">
            <table class="table table-striped table-bordered data">
                <thead>
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th>Angka</th>
                    <th>Prediket</th>
                    <th>Ket.</th>
                    <th>Waktu Selesai</th>
                </thead>

                <?php $no = 1; ?>
                <tbody>
                    <?php foreach ($daftarUjian as $ujian) { ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $ujian['judul'] ?></td>
                            <td><?= $ujian['nilai'] ?></td>
                            <td><?= $ujian['predikat'] ?></td>
                            <td><?= $ujian['keterangan'] ?></td>
                            <td><?= $ujian['waktu_selesai'] ?></td>
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