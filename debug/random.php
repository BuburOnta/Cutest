<?php
session_start();
// session_destroy();
resetWaktu();

// $query = query("SELECT * FROM absensi WHERE id_absen='$_SESSION[id_absen]'")[0];
// $tgl = date("2022-04-11");
// $tanggal = hari();
// $tanggal .= ", " . bulan($tgl);


$_SESSION['sesiLogins'] = "operator@operator";

$error = [];
$errorKeys = ['keterangan', 'tanggal'];
if (isset($_POST['submit'])) {
  // var_dump($_POST);
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
    // $tgl = $_POST['tanggal'];
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

        <div class="input__group">
          <label for="time">Time</label>
          <input type="time" name="time" id="time" placeholder="">
        </div>

        <button type="submit" name="submit">Submit</button>
      </form>
    </div>
  </div>

  <table border="2" cellspacing=0 cellpadding=3 style="color: #fff;">
      <thead>
        <th>Id_absen</th>
        <th>Keterangan</th>
        <th>Status</th>
      </thead>
      <?php $ois = query("SELECT * FROM absensi") ?>
        <?php foreach($ois as $oi ): ?>
      <tbody>
          <td><?= $oi['id_absen'] ?></td>
          <td><?= $oi['keterangan'] ?></td>
          <td><?= $oi['status'] ?></td>
      </tbody>
      <?php endforeach; ?>
  </table>
</body>

</html>