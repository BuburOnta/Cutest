<?php

function Woi()
{
    global $con;
    if (!mysqli_query($con, "INSERT INTO daftar_ujian SET id_guru='221133', judul='tes', tipe_ujian='tes', file='tes', token='tes' ")) {
        $_POST['error'] = "Gagal memasukan soal ujian";
        echo "<script>
         alert('Gagal 1')
    </script>";
    }

    // QUERY 3 -> Mengambil id_ujian dari tabel daftar_ujian
    $result = query("SELECT * FROM daftar_ujian WHERE judul='tes' ");
    $id_ujian = $result[0]['id_ujian'];

    // -> Pengulangan untuk array `kelas`

    // QUERY 4 -> Sorting akses ujian berdasarkan `kelas` dengan `id_ujian` yang sudah diambil
    if (!mysqli_query($con, "INSERT INTO akses_ujian SET kelas_jurusan='2', id_ujian='$id_ujian'")) {
        $_POST['error'] = "Gagal mengatur akses ujian";
        echo "<script>
             alert('Gagal 2')
        </script>";
    }

    // QUERY 5 -> Mengambil kelas_jurusan dari tabel akses_ujian
    $result = query("SELECT * FROM `akses_ujian` INNER JOIN kelas_jurusan ON akses_ujian.kelas_jurusan=kelas_jurusan.id WHERE akses_ujian.id_ujian='$id_ujian' ");
    // -> Pengulangan untuk mengambil kelas dan jurusan dari relasi tabel kelas_jurusan dengan kelas, jurusan
    foreach ($result as $res) {
        // QUERY 5 -> Mengambil semua data users berdasarkan kelas dan jurusan diatas
        $result1 = query("SELECT * FROM users WHERE kelas='$res[kelas]' AND jurusan='$res[jurusan]' ");
        // --- Memasukkan data ke database
        foreach ($result1 as $res) {

            if (!mysqli_query($con, "INSERT INTO murid_ujian (id_ujian,kelas,jurusan,id_murid) VALUES ('$id_ujian','$res[kelas]','$res[jurusan]','$res[id_user]') ")) {
                // if(!mysqli_query($con, "INSERT INTO murid_ujian SET id_ujian='$id"))
                $_POST['error'] = "Gagal mengatur murid ujian";
                echo "<script>
                 alert('Gagal 3')
            </script>";
            }
        }
    }
}

$tbn = "users";
$p = query("SELECT TABLE_NAME, CONSTRAINT_TYPE, CONSTRAINT_NAME FROM information_schema.table_constraints WHERE table_name='$tbn' AND CONSTRAINT_TYPE='FOREIGN KEY' ;");
var_dump($p);

mysqli_query($con, 
    "ALTER TABLE users DROP FOREIGN KEY users_ibfk_3;
    ");

mysqli_query($con, 
"ALTER TABLE users ADD CONSTRAINT users_ibfk_3 FOREIGN KEY (`role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;"
);


// $p = query("SELECT * FROM daftar_ujian INNER JOIN akses_ujian ON daftar_ujian.id_ujian=akses_ujian.id_ujian y
// INNER JOIN murid_ujian ON daftar_ujian.id_ujian=murid_ujian.id_ujian WHERE daftar_ujian.judul='tes'");

// var_dump($p);







//todo WHAT I DONE
//! Menambahkan datatables
//! Upload ke online web
//! Mengubah database menjadi CASCADE

//todo Membuat fitur hapus ujian dan absensi