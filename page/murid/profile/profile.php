<?php
session_start();
$user = query("SELECT * FROM users INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan INNER JOIN kelas ON users.kelas=kelas.id_kelas WHERE email='$_SESSION[sesiLogin]'")[0];
$password = $user['password'];

// var_dump($_POST);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="assets/css/murid/profile.css">
    <style>
        .logo {
            position: absolute;
            top: 20px;
            left: 50px;
        }
    </style>
</head>
<iv>
    <div class="logo">
        <img src="assets/img/cutest_logo_text.svg" onclick="window.location.href = '?page=murid';">
    </div>

    <div class="center">
        <div class="container">
            <div class="left">
                <img src="assets/icon/profile.svg" alt="ss" class="foto">
                <form method="POST" action="">
                    <div class="informasi">
                        <label for="nama">Nama</label>
                        <input type="text" class="info" name="nama" id="nama" value="<?= $user['nama'] ?>" disabled>
                    </div>
                    <div class="informasi">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="info" name="kelas" id="kelas" value="<?= $user['kelas'] ?> <?= $user['id_jurusan'] ?>" style="text-transform: uppercase;" disabled>
                    </div>
            </div>

            <!-- <span class="midLine"></span> -->

            <div class="right">
                    <div class="informasi">
                        <label for="jurusan">Jurusan</label>
                        <input type="text" class="info" name="jurusan" id="jurusan" value="<?= $user['jurusan'] ?>" disabled>
                    </div>
                    <div class="informasi">
                        <label for="nis">NIS</label>
                        <input type="text" class="info" name="nis" id="nis" value="<?= $user['nis'] ?>" disabled>
                    </div>
                    <div class="informasi">
                        <label for="nisn">NISN</label>
                        <input type="text" class="info" name="nisn" id="nisn" value="<?= $user['nisn'] ?>" disabled>
                    </div>
                    <div class="informasi">
                        <label for="email">Email</label>
                        <input type="text" class="info" name="email" id="email" value="<?= $user['email'] ?>" disabled>
                    </div>
                    <div class="informasi">
                        <label for="password">Password</label>
                        <input type="text" class="info" name="password" id="password" value="*************" disabled>
                    </div>
            </div>

            <div class="button">
                <button class="ubahProfile">Ubah</button>
                <button class="kembali" onclick="redirect('?page=murid')">Kembali</button>
            </div>
            </form>
        </div>
    </div>

    <script src="assets/js/imgToSvg.js"></script>
    <script src="assets/js/redirect.js"></script>
    <script>
        let kembali = document.querySelector(".kembali")
        kembali.addEventListener('click',(e)=>{
            e.preventDefault()
        })
        // Ubah profile
        const tombol = document.querySelector(".ubahProfile")
        const input = document.querySelectorAll("input.info")
        const nama = document.querySelector("#nama")
        input.forEach(el => {
            // console.log(el)
            el.disabled = true;
        });
        tombol.addEventListener('click', (e) => {
            if(tombol.textContent == 'Perbarui'){
                
            } else {
                input.forEach(el => {
                    // console.log(el)
                    el.disabled = false;
                    nama.focus()
                });
                tombol.textContent = 'Perbarui'
                e.preventDefault()
            }
        })
    </script>
    </body>

</html>