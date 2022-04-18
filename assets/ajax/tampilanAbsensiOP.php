<?php 
session_start();
require('../../function.php');
$idAbsensi = $_SESSION['id_absen'];
$nama = htmlspecialchars($_GET['keyword']);
// echo $nama;
$query = "SELECT * FROM akses_absensi INNER JOIN absensi ON akses_absensi.id_absensi=absensi.id_absen 
                                INNER JOIN users ON akses_absensi.id_murid=users.id_user 
                                INNER JOIN kelas ON users.kelas=kelas.id_kelas 
                                INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan 
                                WHERE akses_absensi.id_absensi='$idAbsensi' AND users.nama='$nama' OR users.nama LIKE '%$nama%' ";
$listAbsensi = query($query);
?>
<table cellspacing='0'>
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