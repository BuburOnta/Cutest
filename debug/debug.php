<?php
session_start();
require '../function.php';


$mapels = [];

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $users = query("SELECT * FROM users WHERE email='$email'")[0];  //ambil user
} else {
  // $users = query("SELECT * FROM users WHERE nama='a3' AND jurusan='tkro' ");
  $users = query("SELECT * FROM users WHERE email='klsterbuka@gmail.com'")[0];  //ambil user
  // var_dump($users);
  echo '<br>';
}

$ujian = query("SELECT id_ujian FROM akses_ujian INNER JOIN kelas_jurusan ON akses_ujian.kelas_jurusan=kelas_jurusan.id 
                                          WHERE kelas_jurusan.kelas='$users[kelas]'  AND kelas_jurusan.jurusan='$users[jurusan]'   "); // cek ujian berdasarkan kelas
// var_dump($ujian);                          
foreach ($ujian as $uji) {
  // var_dump($uji);
  $mapels[] = query("SELECT * FROM daftar_ujian WHERE id_ujian='$uji[id_ujian]'");
  // var_dump($mapels);
}
?>

<span style="display:block; margin: 20px 0;">Saat Ini anda sedang login dengan email <b>'<?= $users['email'] ?>'</b> yang berada di kelas <b><?= $users['kelas'] ?></b> jurusan <b><?= $users['jurusan'] ?></b></span>

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