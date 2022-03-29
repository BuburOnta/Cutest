<?php
require "../function.php";

// $users = query("SELECT * FROM users");
// $users = query("SELECT * FROM users INNER JOIN role ON users.role=role.id_role");
$guru = query("SELECT * FROM guru INNER JOIN role ON guru.role=role.id_role");
$users = query("SELECT * FROM users INNER JOIN role ON users.role=role.id_role INNER JOIN kelas ON users.kelas=kelas.id_kelas INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan");
// $users = query("SELECT * FROM users INNER JOIN role ON users.role=role.id_role INNER JOIN kelas ON users.kelas=kelas.id_kelas  INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan WHERE kelas.id_kelas=1 AND jurusan.id_jurusan='rpl'");

if(isset($_POST['submit'])){
    
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    if($kelas != "" && $jurusan != ""){
        $users = query("SELECT * FROM users INNER JOIN role ON users.role=role.id_role INNER JOIN kelas ON users.kelas=kelas.id_kelas  INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan WHERE kelas.id_kelas='$kelas' AND jurusan.id_jurusan='$jurusan'");
    } else if($kelas != ""){
        $users = query("SELECT * FROM users INNER JOIN role ON users.role=role.id_role INNER JOIN kelas ON users.kelas=kelas.id_kelas  INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan WHERE kelas.id_kelas='$kelas'");
    } else if($jurusan != ""){
        $users = query("SELECT * FROM users INNER JOIN role ON users.role=role.id_role INNER JOIN kelas ON users.kelas=kelas.id_kelas  INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan WHERE jurusan.id_jurusan='$jurusan'");
    }
}
?>
<form method="POST" action="">
    <label for="Kelas">Query Berdasarkan</label>
    <select name="kelas">
        <optgroup label="Kelas">
            <option value="" selected>Default</option>
            <option value="1">X</option>
            <option value="2">XI</option>
            <option value="3">XII</option>
        </optgroup>
    </select>
    <select name="jurusan">
        <optgroup label="jurusan">
            <option value="" selected>Default</option>
            <option value="rpl">Rpl</option>
            <option value="pplg">PPLG</option>
            <option value="mm">MM</option>
            <option value="dkv">DKV</option>
            <option value="aph">APH</option>
            <option value="akl">AKL</option>
            <option value="tbsm">TBSM</option>
            <option value="tkro">TKRO</option>
        </optgroup>
    </select>

    <button type="submit" name="submit">Submit</button>
</form>
    <h3>User</h3>
    <table border="1">
        <thead>
            <th>No</th>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Password</th>
            <th>Kelas</th>
            <th>Jurusan</th>
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
                    <td><?= $user["password"]; ?></td>
                    <td><?= $user["kelas"]; ?></td>
                    <td><?= $user["jurusan"]; ?></td>
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