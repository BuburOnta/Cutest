<?php
session_start();
require 'function.php';


$mapels = [];
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $users = query("SELECT * FROM users WHERE email='$email'")[0];  //ambil user
} else {
  $users = query("SELECT * FROM users WHERE email='klsterbuka@gmail.com'")[0];
}

$ujian = query("SELECT * FROM akses_ujian WHERE kelas='$users[kelas]'"); // cek ujian berdasarkan kelas
foreach ($ujian as $uji) {
  // var_dump($uji);
  $mapels[] = query("SELECT * FROM daftar_ujian WHERE id_ujian='$uji[id_ujian]'");
  // var_dump($mapels);
}
?>

<h2>Saat Ini anda sedang login dengan email '<?= $users['email'] ?>' yang berada di kelas <?= $users['kelas'] ?></h2>

<form method="POST" action="">
  <input type="email" name="email" placeholder="ganti email" autofocus>
  <button type="submit" name="submit">Ganti</button>
</form>

<?php foreach ($mapels as $mapel) { ?>
  <div class="option">
    <input type="radio" class="radio" id="<?= $mapel[0]['judul'] ?>" name="category" value="<?= $mapel[0]['judul'] ?>" />
    <label for="<?= $mapel[0]['judul'] ?>"><?= $mapel[0]['judul'] ?></label>
  </div>
<?php }; ?>