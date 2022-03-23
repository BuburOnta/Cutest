<?php
require "function.php";

// $users = query("SELECT * FROM users");
$users = query("SELECT * FROM users INNER JOIN role ON users.role=role.id_role INNER JOIN kelas_jurusan ON users.kelas_jurusan=kelas_jurusan.id_kelas_jurusan");
$guru = query("SELECT * FROM guru INNER JOIN role ON guru.role=role.id_role");

?>
    <h3>User</h3>
    <table border="1">
        <thead>
            <th>No</th>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Password</th>
            <th>Kelas & Jurusan</th>
            <th>Role</th>
        </thead>

        <tbody>
            <?php $i = 1;
            foreach ($users as $user) { ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $user["id_user"]; ?></td>
                    <td><?= $user["nama"]; ?></td>
                    <td><?= $user["email"]; ?></td>
                    <td><?= $user["password_debug"]; ?></td>
                    <td><?= $user["kelas_jurusan"]; ?></td>
                    <td><?= $user["role"]; ?></td>
                </tr>
            <?php $i++;
            } ?>
        </tbody>
    </table>

    <h3>Guru</h3>
    <table border="1">
        <thead>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Password</th>
            <th>Role</th>
        </thead>

        <tbody>
            <?php $i = 1;
            foreach ($guru as $user) { ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $user["NIP"]; ?></td>
                    <td><?= $user["nama"]; ?></td>
                    <td><?= $user["email"]; ?></td>
                    <td><?= $user["password"]; ?></td>
                    <td><?= $user["role"]; ?></td>
                </tr>
            <?php $i++;
            } ?>
        </tbody>
    </table>