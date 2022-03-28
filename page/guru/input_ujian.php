<?php 
session_start();
// var_dump($_FILES);
// var_dump($_POST['jurusan']);
// echo $_POST['jurusan'];

if(isset($_POST['submit'])){
$nama = $_POST['judul'];
// $jurusan = json_encode($_POST['jurusan']);
// $kelas = json_encode($_POST['kelas']);
$jurusan = 1;
$kelas = 1;
if( !mysqli_query($con, "INSERT INTO daftar_ujian SET judul='$nama' ")){
    echo "GGL";
}

$result = query("SELECT * FROM daftar_ujian WHERE judul='$nama' ");
$_SESSION['id_ujian'] = $result[0]['id_ujian'];
// if( !mysqli_query($con, "UPDATE daftar_ujian SET kelas='$kelas', jurusan='$jurusan' WHERE id_ujian=1")){
//     echo "GGL";
// }
}

var_dump($_SESSION);

if(isset($_POST['akses'])){
    $id_ujian = $_SESSION['id_ujian'];
    foreach ($_POST['kelas'] as $key => $value) {
        // echo gettype($value);
        $value = $value;
        // echo gettype($value);
        if(!mysqli_query($con, "INSERT INTO akses_ujian SET kelas='$value', id_ujian='$id_ujian'")){
            echo "GGL";
        }
    }
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
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="judul">Judul Ujian</label>
        <input type="text" name="judul" id="judul" autofocus>
<br>
        <label for="pdf">file pdf</label>
        <input type="file" name="pdf" id="pdf">

        <label>Kelas Dan jurusan</label>
        X<input type="checkbox" name="kelas[]" id="kelas" value="1">
        XI<input type="checkbox" name="kelas[]" id="kelas" value="2">
        XII<input type="checkbox" name="kelas[]" id="kelas" value="3">
<br>
        RPL<input type="checkbox" name="jurusan[]" id="jurusan" value="rpl">
        MM<input type="checkbox" name="jurusan[]" id="jurusan" value="mm">
<br>

        <button type="submit" name="submit">Submit</button>
    </form>

    <?php //if(isset($_SESSION['tambah'])): ?>
    <h3>SIAPA SAJA YANG DAPAT MENGAKSES</h3>
    <form method="POST" action="">
    X<input type="checkbox" name="kelas[]" id="kelas" value="1">
        XI<input type="checkbox" name="kelas[]" id="kelas" value="2">
        XII<input type="checkbox" name="kelas[]" id="kelas" value="3">
<br>
        RPL<input type="checkbox" name="jurusan[]" id="jurusan" value="rpl">
        MM<input type="checkbox" name="jurusan[]" id="jurusan" value="mm">
<br>
        <button type="submit" name="akses">Submit</button>
    </form>
    <?php //endif; ?>



    <h3>YANG DAPAT MELIHAT UJIAN</h3>
    <?php 
    // decode
    $ujian = query("SELECT * FROM daftar_ujian");
    foreach ($ujian as $uji) {
        $kelas = json_decode($uji['kelas']);
        foreach ($kelas as $kls => $val) {
            $soal = query("SELECT judul FROM daftar_ujian WHERE kelas=$val");
            var_dump($soal);
        }
    }
    // echo $soal;
    // var_dump($soal);
    
    ?>

</body>
<style>
    label {
        display: block;
    }
</style>
</html>