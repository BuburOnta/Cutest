<?php 
session_start();
require 'function.php';

$users = query("SELECT * FROM users WHERE email='onta@gmail.com' ")[0];  //ambil user
// echo $users['kelas'];
$ujian = query("SELECT * FROM akses_ujian WHERE kelas='$users[kelas]'"); // cek ujian berdasarkan kelas
// var_dump($ujian);

// $mapels = query("SELECT * FROM daftar_ujian WHERE id_ujian='$ujian[id_ujian]'");
// var_dump($mapels);

foreach ($ujian as $uji) {
    // var_dump($uji);
    $mapels[] = query("SELECT * FROM daftar_ujian WHERE id_ujian='$uji[id_ujian]'");
    // var_dump($mapels);
}
?>
<?php foreach ($mapels as $mapel) { ?>
  <div class="option">
    <input type="radio" class="radio" id="automobiles" name="category" value="$mapel[nama]" />
    <label for="automobiles"><?= $mapel[0]['judul'] ?></label>
  </div>
<?php }; ?>