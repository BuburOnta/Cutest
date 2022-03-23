<?php 
require 'function.php';
$pw = password_hash("admin12345", PASSWORD_DEFAULT);
mysqli_query($con, "INSERT INTO users (nama,email,password,password_debug,role) VALUE ('admin','admin@admin','$pw','admin12345',3)");
// mysqli_query($con, "INSERT INTO guru (NIP,nama,email,password,role) VALUE (123123, 'Susanto', 'susanto@gmail.com','$pw', 2)");


// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=1, kelas_jurusan='x rpl'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=2, kelas_jurusan='xi rpl'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=3, kelas_jurusan='xii rpl'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=4, kelas_jurusan='x pplg'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=5, kelas_jurusan='xi pplg'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=6, kelas_jurusan='xii pplg'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=7, kelas_jurusan='x mm'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=8, kelas_jurusan='xi mm'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=9, kelas_jurusan='xii mm'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=10, kelas_jurusan='x dkv'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=11, kelas_jurusan='xi dkv'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=12, kelas_jurusan='xii dkv'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=13, kelas_jurusan='x tbsm'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=14, kelas_jurusan='xi tbsm'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=15, kelas_jurusan='xii tbsm'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=16, kelas_jurusan='x tkro'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=17, kelas_jurusan='xi tkro'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=18, kelas_jurusan='xii tkro'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=19, kelas_jurusan='x aph'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=20, kelas_jurusan='xi aph'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=21, kelas_jurusan='xii aph'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=22, kelas_jurusan='x akl'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=23, kelas_jurusan='xi akl'");
// mysqli_query($con, "INSERT INTO kelas_jurusan SET id_kelas_jurusan=24, kelas_jurusan='xii akl'");
$email = 'admin@gmail.com';
// $result = mysqli_query($con, "SELECT * FROM guru INNER JOIN users WHERE guru.email='$email' OR users.email='$email' ");
// var_dump($result);
// // var_dump($result);
// $rows = [];
// while($row = mysqli_fetch_assoc($result)){
//     $rows = $row;
//     var_dump($row);

// }
if( $user = query("SELECT role.role FROM guru INNER JOIN role ON guru.role=role.id_role WHERE email='$email' ")){
    $user = $user['role'];
} else if($user = query("SELECT role.role FROM users INNER JOIN role ON users.role=role.id_role WHERE email='$email' ")){
    $user = $user['role'];
} else {
    echo "AGGAGAL!";
}
switch ($user) { 
    case 'admin':
        // header("Location: ?page=admin");
        echo "admin";
        break;
    case 'guru':
        // header("Location: ?page=guru");
        echo "guru";
        break;
    case 'murid':
        // header("Location: ?page=home");
        echo "murid";
        break;
}
die;

// $us = query("SELECT email, role.role FROM guru INNER JOIN role WHERE guru.role=role.role");
// var_dump($us);
?>
<table border="1">
    <td><?= $rows['NIP'] ?></td>
    <td><?= $rows['nama'] ?></td>
    <td><?= $rows['email'] ?></td>
    <td><?= $rows['role'] ?></td>
    <td><?= $rows['password'] ?></td>
</table>