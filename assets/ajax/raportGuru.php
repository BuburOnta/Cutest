<?php
require '../../function.php';
$keyword = $_GET['keyword'];

$listAbsensi = query("SELECT * FROM murid_ujian INNER JOIN daftar_ujian ON murid_ujian.id_ujian=daftar_ujian.id_ujian INNER JOIN kelas ON murid_ujian.kelas=kelas.id_kelas INNER JOIN jurusan ON murid_ujian.jurusan=jurusan.id_jurusan INNER JOIN users ON murid_ujian.id_murid=users.id_user WHERE daftar_ujian.id_guru='$guru[NIP]' AND users.nama='$keyword' OR users.nama LIKE '%$keyword%' ORDER BY id DESC ");
?>
<?php $no = 1; ?>
<?php foreach ($daftarUjian as $ujian) { ?>
<tbody id="tableValue">
    <td><?= $no ?>
    </td>
    <td><?= $ujian['judul'] ?>
    </td>
    <td><?= $ujian['kelas'] ?>
    </td>
    <td><?= $ujian['jurusan'] ?>
    </td>
    <td><?= $ujian['nama'] ?>
    </td>
    <td><?= $ujian['nilai'] ?>
    </td>
    <td><?= $ujian['predikat'] ?>
    </td>
    <td><?= $ujian['tipe_ujian'] ?>
    </td>
    <td><?= $ujian['waktu_selesai'] ?>
    </td>
</tbody>
<?php $no++;
                    }
