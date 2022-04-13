<?php 
require '../function.php';
// $pw = password_hash("raffie", PASSWORD_DEFAULT);
$sql = "SELECT id, daftar_ujian.judul, kelas.kelas, jurusan.jurusan, users.nama FROM `murid_ujian` INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user;";

$us = ['1', '2', '3'];
// mysqli_query($con, "INSERT INTO tes SET jeson='$us' ");

// mysqli_query($con, "INSERT INTO `akses_ujian` (`id_akses`, `id_ujian`, `kelas`, `jurusan`) VALUES (NULL, '9', '2', 'RPL')");

// MASUKIN DATA USER
// mysqli_query($con, "UPDATE users SET password='$pw' WHERE email='klsterbuka@gmail.com'");
// mysqli_query($con, "INSERT INTO users (nama,email,password,role) VALUE ('admin','admin@admin','$pw', 3)");
// mysqli_query($con, "INSERT INTO guru (NIP,nama,email,password,role) VALUE (123123, 'Susanto', 'susanto@gmail.com','$pw', 2)");
// $nama = $_POST['nama'];
// $email = $_POST['email'];
// $kelas = $_POST['kelas'];
// $jurusan = $_POST['jurusan'];
// $pw = password_hash($nama, PASSWORD_DEFAULT);
// mysqli_query($con, "INSERT iNTO users (nama,email,password,role,kelas,jurusan) 
//                         VALUES ('$nama', 
//                                 '$email', 
//                                 '$pw', 
//                                 '1',
//                                 '$kelas',
//                                 '$jurusan'
//                                 )");
// ?>
<!-- <form method="POST" action="">
    <input type="text" name="nama" id="nama" placeholder="nama" autofocus>
    <input type="email" name="email" id="email" placeholder="email" value="@gmail.com">
    <input type="password" name="pw" id="pw" placeholder="pass">
    <input type="text" name="kelas" id="kelas" placeholder="kelas" value="3">
    <input type="text" name="jurusan" id="jurusan" placeholder="jurusan">
    <button type="submit" name="submit">Submit</button>
</form> -->

<?php
// MASUKIN DATA JURUSAN
/* mysqli_query($con,"INSERT INTO jurusan SET id_jurusan='rpl', jurusan='Rekayasa Perangkat Lunak'");
mysqli_query($con,"INSERT INTO jurusan SET id_jurusan='pplg', jurusan='Pemrograman Perangkat Lunak Gim'");
mysqli_query($con,"INSERT INTO jurusan SET id_jurusan='mm', jurusan='MultiMedia'");
mysqli_query($con,"INSERT INTO jurusan SET id_jurusan='dkv', jurusan='Desain Komunikasi Visual'");
mysqli_query($con,"INSERT INTO jurusan SET id_jurusan='tbsm', jurusan='Teknik Bisnis Sepeda Motor'");
mysqli_query($con,"INSERT INTO jurusan SET id_jurusan='tkro', jurusan='Teknik Kendaraan Ringan Otomotif'");
mysqli_query($con,"INSERT INTO jurusan SET id_jurusan='aph', jurusan='Akomodasi Perhotelan'");
mysqli_query($con,"INSERT INTO jurusan SET id_jurusan='akl', jurusan='Akutansi Keuangan Lembaga'"); */

// MASUKIN DATA KELAs
// mysqli_query($con,"INSERT INTO kelas SET jurusan='rpl', kelas=''");
// mysqli_query($con,"INSERT INTO kelas SET jurusan='pplg', kelas=''");
// mysqli_query($con,"INSERT INTO kelas SET jurusan='mm', kelas='X' ");
// mysqli_query($con,"INSERT INTO kelas SET jurusan='mm', kelas='XI' ");
// mysqli_query($con,"INSERT INTO kelas SET jurusan='mm', kelas='XII' ");

// mysqli_query($con,"INSERT INTO kelas SET jurusan='dkv', kelas='X' ");
// mysqli_query($con,"INSERT INTO kelas SET jurusan='dkv', kelas='XI' ");
// mysqli_query($con,"INSERT INTO kelas SET jurusan='dkv', kelas='XII' ");

// mysqli_query($con,"INSERT INTO kelas SET jurusan='tbsm', kelas='X' ");
// mysqli_query($con,"INSERT INTO kelas SET jurusan='tbsm', kelas='XI' ");
// mysqli_query($con,"INSERT INTO kelas SET jurusan='tbsm', kelas='XII' ");

// mysqli_query($con,"INSERT INTO kelas SET jurusan='tkro', kelas='X' ");
// mysqli_query($con,"INSERT INTO kelas SET jurusan='tkro', kelas='XI' ");
// mysqli_query($con,"INSERT INTO kelas SET jurusan='tkro', kelas='XII' ");

// mysqli_query($con,"INSERT INTO kelas SET jurusan='aph', kelas='X' ");
// mysqli_query($con,"INSERT INTO kelas SET jurusan='aph', kelas='XI' ");
// mysqli_query($con,"INSERT INTO kelas SET jurusan='aph', kelas='XII' ");

// mysqli_query($con,"INSERT INTO kelas SET jurusan='akl', kelas='X' ");
// mysqli_query($con,"INSERT INTO kelas SET jurusan='akl', kelas='XI' ");
// mysqli_query($con,"INSERT INTO kelas SET jurusan='akl', kelas='XII' ");

mysqli_query($con, "UPDATE kelas_jurusan SET kelas=3    WHERE kelas='xii'")
?>
