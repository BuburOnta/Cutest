<?php 
require "../../function.php";

if(isset($_POST['submit'])){
    if(!$_POST['mapel']) {
        echo "ERROR";
    }else {
    $mapel = $_POST['mapel'];
    mysqli_query($con, "INSERT INTO daftar_ujian SET nama='$mapel' ") or die('GGL');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAPEL</title>
</head>
<body>
    <form method="POST" action="">
        <label for="mapel">Tambah Mapel</label>
        <input type="text" name="mapel" id="mapel">

        <button type="submit" name="submit">Tambah</button>
    </form>
</body>
</html>