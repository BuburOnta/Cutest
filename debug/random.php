<?php 
session_start();

$id_ujian=2;
// $result = query("SELECT * FROM akses_ujian INNER JOIN kelas_jurusan WHERE id_ujian='$id_ujian' ");
$result = query("SELECT * FROM `akses_ujian` INNER JOIN kelas_jurusan ON akses_ujian.kelas_jurusan=kelas_jurusan.id WHERE akses_ujian.id_ujian=2");
// $kelas_jurusan = $result['kelas_jurusan'];
// var_dump($result);
foreach($result as $res){
    $result1 = query("SELECT * FROM users WHERE kelas='$res[kelas]' AND jurusan='$res[jurusan]' ");
    // var_dump($res['kelas']);
    foreach($result1 as $res){
        // var_dump($res['nama']);
        var_dump($res);
    }
    // var_dump($result1);
}
foreach($result1 as $s){
    // var_dump($s);
}