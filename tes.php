<?php 
require 'function.php';
// $pw = password_hash("raffie", PASSWORD_DEFAULT);

$us = ['1', '2', '3'];
// mysqli_query($con, "INSERT INTO tes SET jeson='$us' ");

// mysqli_query($con, "INSERT INTO `akses_ujian` (`id_akses`, `id_ujian`, `kelas`, `jurusan`) VALUES (NULL, '9', '2', 'RPL')");

// MASUKIN DATA USER
// mysqli_query($con, "UPDATE users SET password='$pw' WHERE email='klsterbuka@gmail.com'");
// mysqli_query($con, "INSERT INTO users (nama,email,password,role) VALUE ('admin','admin@admin','$pw', 3)");
// mysqli_query($con, "INSERT INTO guru (NIP,nama,email,password,role) VALUE (123123, 'Susanto', 'susanto@gmail.com','$pw', 2)");
$nama = $_POST['nama'];
$email = $_POST['email'];
// $pw = $_POST['pw'];
// $role = $_POST['role'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
// $nama = "";
// $email = "";
// $pw = "";
// $kelas = ;
// $jurusan = "";
$pw = password_hash($nama, PASSWORD_DEFAULT);
mysqli_query($con, "INSERT iNTO users (nama,email,password,role,kelas,jurusan) 
                        VALUES ('$nama', 
                                '$email', 
                                '$pw', 
                                '1',
                                '$kelas',
                                '$jurusan'
                                )");
?>
<form method="POST" action="">
    <input type="text" name="nama" id="nama" placeholder="nama" autofocus>
    <input type="email" name="email" id="email" placeholder="email" value="@gmail.com">
    <!-- <input type="password" name="pw" id="pw" placeholder="pass"> -->
    <input type="text" name="kelas" id="kelas" placeholder="kelas" value="3">
    <input type="text" name="jurusan" id="jurusan" placeholder="jurusan">
    <button type="submit" name="submit">Submit</button>
</form>

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
?>
