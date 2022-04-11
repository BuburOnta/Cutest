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
    <link rel="stylesheet" href="assets/css/raport.css">
    <style>
        body {
            background-color: #233b6e;
            background-image: none;
        }
    </style>
</head>

<body>
    <?php include_once $nav_ujian ?>
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
            <style>
                div.container a.keluar {
                    font-size: 30px;
                    color: #fff;
                    position: absolute;
                    left: 25px;
                    top: 18px;
                    transform: rotate(180deg);
                }
                div.container a.keluar:hover {
                    color: #ddd;
                }
            </style>

                <h1>
                    <?= $users['nama'] ?> | <?= $users['kelas'] ?> <span style="text-transform:uppercase;"><?= $users['id_jurusan'] ?></span> | <?= $users['jurusan'] ?>
                </h1>
            <div class="content">
                <table cellspacing='0'>
                    <thead>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Angka</th>
                        <th>Prediket</th>
                        <th>Ket.</th>
                        <th>Waktu Selesai</th>
                    </thead>

                    <?php $no = 1; ?>
                    <?php foreach ($daftarUjian as $ujian) { ?>
                        <tbody>
                            <td><?= $no ?></td>
                            <td><?= $ujian['judul'] ?></td>
                            <td><?= $ujian['nilai'] ?></td>
                            <td><?= $ujian['predikat'] ?></td>
                            <td><?= $ujian['keterangan'] ?></td>
                            <td><?= $ujian['waktu_selesai'] ?></td>
                        </tbody>
                    <?php $no++;
                    } ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>