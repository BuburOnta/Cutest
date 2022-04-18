<?php
require '../../function.php';
$keyword = $_GET['keyword'];

$listAbsensi = query("SELECT * FROM absensi WHERE keterangan LIKE '%$keyword%' OR tanggal LIKE '%$keyword%' ");
?>
<form method="POST" action="" class="form_absensi">
    <ul class="list__group">
        <?php $no = 1; ?>
        <?php foreach ($listAbsensi as $absensi): ?>
        <label for="<?= $absensi['id_absen'] ?>"
            class="list">
            <?= $no ?>.
            <?= $absensi['keterangan'] ?>
            /
            <?= $absensi['tanggal'] ?>
        </label>
        <input type="radio" name="id_absen"
            id="<?= $absensi['id_absen'] ?>"
            style="display: none;"
            value="<?= $absensi['id_absen'] ?>">

        <?php $no++; ?>
        <?php endforeach; ?>
    </ul>

    <button type="submit" name="submit">Pilih</button>
</form>