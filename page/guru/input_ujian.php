<?php
session_start();
// var_dump($_FILES);
// var_dump($_POST['jurusan']);
// echo $_POST['jurusan'];

// RESET AUTO INCREMENT
$result = mysqli_query($con,"SELECT * FROM `akses_ujian`");
if(mysqli_num_rows($result) == 0) {
    if(!mysqli_query($con, "ALTER TABLE `akses_ujian` AUTO_INCREMENT = 1")){
        echo "GAGAL";
    }
} else{
    echo "jumlah akses ujian " . mysqli_num_rows($result);
}
$result = mysqli_query($con,"SELECT * FROM `daftar_ujian`");
if(mysqli_num_rows($result) == 0) {
    if(!mysqli_query($con, "ALTER TABLE `daftar_ujian` AUTO_INCREMENT = 1")){
        echo "GAGAL";
    }
} else{
    echo '<br>';
    echo "jumlah soal " . mysqli_num_rows($result);
}
$p = 100;

if (isset($_POST['submit'])) {
    // var_dump($_POST);
    // QUERY 1 -> Memasukan topik ke tabel daftar_ujian hanya dengan judul
    $judul = $_POST['judul'];
    if (!mysqli_query($con, "INSERT INTO daftar_ujian SET judul='$judul' ")) {
        echo "GGL";
    }

    // QUERY 2 -> Mengambil id_ujian dari tabel daftar_ujian
    $result = query("SELECT * FROM daftar_ujian WHERE judul='$judul' ");
    $id_ujian = $result[0]['id_ujian'];

    // -> Pengulangan untuk array `kelas`
    foreach ($_POST['kelas'] as $key => $kelas) {
        // QUERY 3 -> Sorting akses ujian berdasarkan `kelas` dengan `id_ujian` yang sudah diambil
        if (!mysqli_query($con, "INSERT INTO akses_ujian SET kelas='$kelas', id_ujian='$id_ujian'")) {
            echo "er".$p++;
        }
    }

    // $_SESSION['id_ujian'] = $result[0]['id_ujian'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ujian</title>
</head>

<body>
    <form method="POST" action="" enctype="multipart/form-data" style="margin-top: 20px; border:2px solid black;">
        <label for="judul">Judul Ujian</label>
        <input type="text" name="judul" id="judul" autofocus>
        <br>
        <label for="pdf">file pdf</label>
        <input type="file" name="pdf" id="pdf">

        <label>Kelas Dan jurusan</label>
        <div class="input">X RPL<input type="checkbox" name="kelas[]" id="kelas" value="1"></div>
        <div class="input">XI RPL<input type="checkbox" name="kelas[]" id="kelas" value="2"></div>
        <div class="input">XII RPL<input type="checkbox" name="kelas[]" id="kelas" value="3"></div>
        <div class="input">X PPLG<input type="checkbox" name="kelas[]" id="kelas" value="4"></div>
        <div class="input">XI PPLG<input type="checkbox" name="kelas[]" id="kelas" value="5"></div>
        <div class="input">XII PPLG<input type="checkbox" name="kelas[]" id="kelas" value="6"></div>
        <div class="input">X MM<input type="checkbox" name="kelas[]" id="kelas" value="7"></div>
        <div class="input">XI MM<input type="checkbox" name="kelas[]" id="kelas" value="8"></div>
        <div class="input">XII MM<input type="checkbox" name="kelas[]" id="kelas" value="9"></div>

        <br>

        <button type="submit" name="submit">Submit</button>
    </form>

</body>
<style>
    label {
        display: block;
    }
    .input {
        display: block;
        margin-bottom: 5px;
    }
</style>

</html>