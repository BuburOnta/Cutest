<?php 
session_start();
$guru = query("SELECT * FROM guru WHERE email='$_SESSION[sesiLogin]'")[0];
$_GET['iu'] = 19;
// --- Mengambil soal
$id_ujian = $_GET['iu'];

if (!$soal = query("SELECT * FROM soal_ujian LEFT JOIN daftar_ujian ON soal_ujian.id_ujian=daftar_ujian.id_ujian WHERE soal_ujian.id_ujian='$id_ujian' AND id_guru='$guru[NIP]' ORDER BY id_soal DESC LIMIT 1  ")[0]) {
  $_POST['error'] = "Gagal menampilkan soal ujian";
} else {
  $group = $soal['nomor_soal'];
} 

var_dump($soal);
?>