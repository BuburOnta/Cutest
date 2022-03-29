<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Include library PHPMailer
include('assets/PHPMailer/src/Exception.php');
include('assets/PHPMailer/src/PHPMailer.php');
include('assets/PHPMailer/src/SMTP.php');

// DEFINE VAR
define("USERNAME_EMAIL", "popon.pon321@gmail.com");
define("PASSWORD_EMAIL", "dlbnxsdkwvrcftlo");
define('PENGIRIM', 'Cutest');



$con = mysqli_connect('localhost', 'root', '', 'cutest') or die("Koneksi ke database CUTEST gagal");

// Membuat variabel untuk feedback user
$error = "";
$succes = "";

// --- PUBLIC FUNCTION
// --- PF -> Ambil Data
function query($query)
{
    global $con;
    $result = mysqli_query($con, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// --- PF -> Token Generator
function token($panjang)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i = 0; $i < $panjang; $i++) {
        $token .= $codeAlphabet[random_int(0, $max - 1)];
    }
    return $token;
}


// --- Function Register
function register($data)
{
    // Variabel
    global $con;
    // memfilter sql injection
    $nama = mysqli_real_escape_string($con, $data['nama']);
    $email = mysqli_real_escape_string($con, $data['email']);
    $password = mysqli_real_escape_string($con, $data['password']);
    $confirm_password = mysqli_real_escape_string($con, $data['confirm_password']);
    $kelas_jurusan = mysqli_real_escape_string($con, $data['kelas_jurusan']);
    // memfilter html
    $nama = htmlspecialchars($nama);
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);
    $confirm_password = htmlspecialchars($confirm_password);

    // KONDISI 1 - cek ketersediaan email
    $result = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");
    if (mysqli_fetch_assoc($result)) { // jika true
        $_POST['error'] = "Email sudah terdaftar!";
        return false;
    }

    // KONDISI 2 - Cek konfirmasi password
    if ($password !== $confirm_password) {
        $_POST['error'] = 'Konfirmasi password tidak sesuai!';
        return false;
    }

    // KONDISI 3 - Memverifikasi email dengan cara mengirimkan kode otp
    $code_otp = rand(999999, 111111);
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPAuth = true;
    $mail->Username = USERNAME_EMAIL;
    $mail->Password = PASSWORD_EMAIL;
    $mail->setFrom(USERNAME_EMAIL, 'Cutest');
    $mail->addAddress($email);
    $mail->Subject = 'Kode OTP Verifikasi Email Cutest.';
    $mail->Body = 'Kode verifikasi anda: ' . $code_otp;

    // if (!$mail->send()) {
    //     // echo 'Mailer Error: ' . $mail->ErrorInfo;
    //     echo "ERROR CODE OTP";
    //     $_POST['error'] = 'Error Code OTP';
    //     return false;
    // }

    // KONDISI 4 - Jika di tempuser sudah ada username yg sama maka hanya menguba code_otp
    $result = mysqli_query($con, "SELECT email FROM temp_users WHERE email='$email'");
    if (mysqli_fetch_assoc($result)) {
        mysqli_query($con, "UPDATE temp_users SET code_otp=$code_otp WHERE email='$email'");
        $_SESSION['tempPass'] = $password;
        $_SESSION['tempNama'] = $nama;
        $_SESSION['tempKelas_jurusan'] = $kelas_jurusan;
        $_SESSION['tempEmail'] = $email;
        return mysqli_affected_rows($con);
    }

    // KONDISI 5 - Jika pertama kali daftar
    // $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($con, "INSERT INTO temp_users SET password_debug='$password', email='$email', code_otp=$code_otp, status='not verified' ");
    $_SESSION['tempPass'] = $password;
    $_SESSION['tempNama'] = $nama;
    $_SESSION['tempKelas_jurusan'] = $kelas_jurusan;
    $_SESSION['tempEmail'] = $email;

    return mysqli_affected_rows($con);
}

// --- Function Register -> Verification Email
// - VERIFIKASI EMAIL ---
function verification($data)
{
    global $con;
    $code_otp = $data['verifCode'];
    $email = $_SESSION['tempEmail'];
    $nama = $_SESSION['tempNama'];
    $kelas_jurusan = $_SESSION['tempKelas_jurusan'];
    $password = password_hash($_SESSION['tempPass'], PASSWORD_DEFAULT);

    $result = mysqli_query($con, "SELECT * FROM temp_users WHERE email='$email'");
    $rows = mysqli_fetch_assoc($result);

    // KONDISI 1 - Menyamakan input code oTP dengan di database
    if ($code_otp == $rows['code_otp']) {
        //mysqli_query($con, "UPDATE temp_users SET code_otp='', status='verified' WHERE username='$username'"); // mengembalikan nilai code otp menjadi kosong kembali
        mysqli_query($con, "DELETE FROM temp_users WHERE email='$email'");
        mysqli_query($con, "INSERT INTO users SET nama='$nama', email='$email', password='$password', kelas_jurusan=$kelas_jurusan, role=1, password_debug='$_SESSION[tempPass]' ");
        $_SESSION = [];
        return mysqli_affected_rows($con);
    } else {
        $_POST['error'] = "Kode verifikasi salah!";
        return false;
    }
}


// --- Function Login
function login($data)
{
    global $con;
    $email = $data['email'];
    $password = $data['password'];

    // QUERY 1 - Mengecek email didalam database
    if (!mysqli_num_rows($result = mysqli_query($con, "SELECT * FROM users WHERE email='$email'")) && !mysqli_num_rows($result = mysqli_query($con, "SELECT * FROM guru WHERE email='$email'"))) {
        $_POST['error'] = "Invalid Email";
        return false;
    }

    // KONDISI 1 - Cek Password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        // SESSION - Membuat Session dengan key sesiLogin
        $_SESSION['sesiLogin'] = $email;
        $_SESSION['sesiId'] = $row['id_user'];

        // COOKIE - Jika user menyimpan info login
        if (isset($data['info_login'])) {
            // Memasukan cookie ke database
            $id = $row['id_user'];
            $key = hash('sha256', $row['email']);
            mysqli_query($con, "UPDATE users SET cookie='$key' WHERE id_user=$id ");
            setcookie('cookieLogin', $key, time() + 7 * 60 * 60 * 24); // jumlahHari menit jam hari
        }
        return true;
    } else {
        $_POST['error'] = "Invalid password";
        return false;
    }
}
// --- Function Login -> Lupa Password Page
function lupaPass($data)
{
    global $con;
    $email = $data['email'];

    // KONDISI 1 - Cek email terdaftar atau tidak
    $result = mysqli_query($con, "SELECT email FROM users WHERE email='$email' ");
    if (!mysqli_fetch_assoc($result)) {
        $_POST['error'] = "Email tidak ditemukan!";
        return false;
    }

    // KONDISI 2 - Mengirim kode otp kepada email yang ditulis
    $code_otp = rand(999999, 111111);
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPAuth = true;
    $mail->Username = USERNAME_EMAIL;
    $mail->Password = PASSWORD_EMAIL;
    $mail->setFrom('Cutest');
    $mail->addAddress($email);
    $mail->Subject = 'Kode OTP Lupa Password Cutest.';
    $mail->Body = 'Kode lupa password anda: ' . $code_otp;

    // if (!$mail->send()) {
    //     // echo 'Mailer Error: ' . $mail->ErrorInfo;
    //     $_POST['error'] = "Gagal mengirim kode otp.";
    //     return false;
    // }

    // QUERY 2 - Memasukan code otp ke database
    mysqli_query($con, "UPDATE users SET code_otp=$code_otp WHERE email='$email'");
    $_SESSION['email'] = $email;
    return mysqli_affected_rows($con); // mengembalikan nilai false kepada else di register php
}

// --- Function Login -> Verifikasi OTP
function verification_login($data)
{
    global $con;
    $code_otp = $data['verifCode'];
    $email = $_SESSION['email'];

    $result = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
    $rows = mysqli_fetch_assoc($result);

    // KONDISI 1 - Menyamakan input code oTP dengan di database
    if ($code_otp == $rows['code_otp']) {
        // QUERY 1 - Mengembalikan kode otp database menjadi kosong
        mysqli_query($con, "UPDATE users SET code_otp=''WHERE email='$email'");
        return mysqli_affected_rows($con);
    } else {
        $_POST['error'] = "Kode verifikasi salah!";
        return false;
    }
}

// --- Function Login -> Ubah Password
function ubahPassword($data)
{
    global $con;
    $email = $_SESSION['email'];
    $password = $data['password'];
    $confirm_password = $data['confirm_password'];

    if ($password !== $confirm_password) {
        $_POST['error'] = "Konfirmasi password tidak sesuai";
        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($con, "UPDATE users SET password='$password', password_debug='$confirm_password' WHERE email='$email' ");
    $_SESSION['email'] = '';
    return mysqli_affected_rows($con);
}







// --- Guru -> Ujian
// ---Tambah Data---
function tambah($data)
{
    global $con;
    // membuat variabel
    // mencegah adanya element html
    $judul = $data['judul'];
    $kelas = $data['kelas'];
    $token = token(6);

    // QUERY 1 -> Upload File terlebih dahulu
    $files = upload(); // mengisi `files` dengan return dari func `upload`
    if (!$files) {
        // $_POST['error'] = "Gagal mengupload file";
        return false;
    }
    // $files = "TEST.pdf";

    // QUERY 2 -> Memasukan topik ke tabel daftar_ujian hanya dengan judul
    if (!mysqli_query($con, "INSERT INTO daftar_ujian SET judul='$judul', file='$files', token='$token' ")) {
        $_POST['error'] = "Gagal memasukan soal ujian";
        return false;
    }

    // QUERY 3 -> Mengambil id_ujian dari tabel daftar_ujian
    $result = query("SELECT * FROM daftar_ujian WHERE judul='$judul' ");
    $id_ujian = $result[0]['id_ujian'];

    // -> Pengulangan untuk array `kelas`
    foreach ($kelas as $key => $value) {
        // QUERY 4 -> Sorting akses ujian berdasarkan `kelas` dengan `id_ujian` yang sudah diambil
        if (!mysqli_query($con, "INSERT INTO akses_ujian SET kelas_jurusan='$value', id_ujian='$id_ujian'")) {
            $_POST['error'] = "Gagal mengatur akses ujian";
            return false;
        }
    }

    return mysqli_affected_rows($con);
}

// --- Guru -> Ujian --> Upload File
function upload()
{
    $namaFile = $_FILES['files']['name'];
    $ukuranFile = $_FILES['files']['size']; // karna $_FILES menghasilkan array multi dimensi
    $error = $_FILES['files']['error'];
    $tmpName = $_FILES['files']['tmp_name'];

    // Kondisi 1 - Apakah gambar diupload atau tidak
    if ($error === 4) {
        // $_POST['error'] = "Upload File";
        return false;
    }

    // Kondisi 2 - Apakah file yang diupload berekstensi pdf / tidak
    $validType = ['pdf'];
    $ekstensiGambar = explode('.', $namaFile); // mengubah $namaFile menjadi array terpisah saat terdapat titik
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // mengubah semua ke lowercase // mengambil array paling akhir

    // in_array($string, $array) = mengecek apakah ada string didalam array | menghasilkan nilai true / false
    if (!in_array($ekstensiGambar, $validType)) {
        // $_POST['error'] = "Harap input file pdf";
        return false;
    }

    // Kondisi 3 - Membatasi ukuran gambar
    /*     if( $ukuranFile > 2000000 ) {
        echo "
        <script>
            alert('ukuran gambar terlalu besar!');
        </script>
        ";
    } */

    // Kondisi 4 - Kondisi sebelumnya berhasil maka upload file ke tempat tujuan
    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'assets/pdf/' . $namaFileBaru);
    return $namaFileBaru;
}
