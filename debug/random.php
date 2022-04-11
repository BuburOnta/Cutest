<?php
session_start();
// echo date("M");
$_SESSION['sesiLogins'] = "operator@operator";

$p = hari();
$p .= ", " . bulan(date('Y-m-d'));
// echo strlen($p);
// echo date("H:i:s");
// echo date('Y-m-d');
$zz = date("Y-m-d");
// echo $zz;
echo '<br>';

$error = [];
$errorKeys = ['keterangan', 'tanggal'];
if (isset($_POST['submit'])) {
    foreach ($errorKeys as $errorKey) { // mengeluarkan semua array
        // menggunakan error key dengan post untuk mengecek apakah input kosong atau tidak, jika kosong maka variabel error diisi dengan masing masing error key
        if (empty(trim($_POST[$errorKey]))) {
            $error[] = $errorKey; // memasukkan key kedalam var error
        } else {
        }
    }

    if (count($error) == 0) {
        if (tambahAbsensi($_POST) > 0) {
            // header("Location: ?page=register_verification");
            echo "F";
        } else {
            echo mysqli_error($con);
        }
    }

    // var_dump($_POST);
    $tgl = $_POST['tanggal'];
    // $tanggal = hari();
    // $tanggal .= ", " . bulan($tgl);
}

?>

<html lang="id">

<head>
  <title></title>
  <link rel="stylesheet" href="assets/css/tambahAbsensi.css">
</head>

<body>
  <div class="container">
    <div class="card">
      <h1 class="h1">Absensi</h1>
      <form method="POST" action="">
        <div class="input__group">
          <?php if(in_array('keterangan', $error)){ ?>
             <span class='error'>Masukkan format keterangan yang valid</span>
          <?php } ?>
          <label for="keterangan">Keterangan</label>
          <input type="text" name="keterangan" id="keterangan" placeholder="Ulangan harian... Penilaian tengah semester...">
        </div>

      
        <div class="input__group">
          <?php if(in_array('tanggal', $error)){ ?>
             <span class='error'>Masukkan format tanggal yang valid</span>
          <?php } ?>
          <label for="tanggal">Tanggal</label>
          <input type="date" name="tanggal" id="tanggal">
        </div>

        <button type="submit" name="submit">Submit</button>
      </form>
    </div>
  </div>

</body>

</html>