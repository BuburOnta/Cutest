<?php
session_start();
$user = query("SELECT * FROM users INNER JOIN jurusan ON users.jurusan=jurusan.id_jurusan INNER JOIN kelas ON users.kelas=kelas.id_kelas WHERE email='$_SESSION[sesiLogin]'")[0];
$password = $user['password'];

if(isset($_POST['submit'])){
    // var_dump($_POST);
    if(updateProfile($_POST)>0){
        header("Location: ?page=profile");
    } else {
        setToast("Gagal <strong>memperbarui</strong> profile", "danger");
    }
}
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
<div>
    <div class="logo">
        <img src="assets/img/cutest_logo_text.svg" onclick="window.location.href = '?page=murid';">
    </div>

    <?php toast() ?>

    <div class="center">
        <div class="container">
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="hiddenFoto_profile" value="<?= $user['foto_profile'] ?>">
                <div class="left">
                    <div class="fotos">
                    <?php if($user['foto_profile'] != '' && $user['foto_profile'] != "NULL"){ ?>
                        <img src="assets/profile/<?php echo $user['foto_profile'] ?>" alt="" class="foto">
                    <?php }else{ ?>
                        <img src="assets/icon/profile.svg ?>" class="foto">
                    <?php } ?>
                        <div class="cover"></div>
                        <label for="files" class="files"><i class="fa-solid fa-camera"></i><span>ganti foto</span></label>
                        <input type="file" accept="image/" onchange="loadFile(event)" name="files" id="files" style="display: none;">
                    </div>
                    <!-- <div class="foto" style="background-image: url('assets/profile/<?= $user['foto_profile'] ?>');"></div> -->
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
                    <button class="ubahProfile" name="submit">Ubah</button>
                    <button class="kembali" onclick="redirect('?page=murid')">Kembali</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const currentFoto = document.querySelector(".foto")
        var loadFile = function(event) {
            currentFoto.src = URL.createObjectURL(event.target.files[0]);
            currentFoto.onload = function() {
            URL.revokeObjectURL(currentFoto.src) // free memory
            }
        };
    </script>
    <script src="assets/js/imgToSvg.js"></script>
    <script src="assets/js/redirect.js"></script>
    <script>
        let kembali = document.querySelector(".kembali")
        kembali.addEventListener('click', (e) => {
            e.preventDefault()
        })
        // Ubah profile
        const tombol = document.querySelector(".ubahProfile")
        const input = document.querySelectorAll("input.info")
        const nama = document.querySelector("#nama")
        const password = document.getElementById("password")
        const email = document.getElementById("email")

        // Foto Profile
        const foto = document.querySelector(".files")
        const cover = document.querySelector(".cover")

        input.forEach(el => {
            // console.log(el)
            el.disabled = true;
        });
        tombol.addEventListener('click', (e) => {
            if (tombol.textContent == 'Perbarui') {

            } else {
                input[0].disabled = false
                input[3].disabled = false
                input[4].disabled = false
                input[0].focus()
                foto.style.display = 'flex'
                cover.style.display = 'unset'

                input.forEach(el => {
                    if(el.disabled == false){
                        el.style.borderBottom = '2px solid #b2b1b1'
                    }
                })
                tombol.textContent = 'Perbarui'
                e.preventDefault()
            }
        })
    </script>
    </body>

</html>