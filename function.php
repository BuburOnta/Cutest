<?php
// session_start();
// Set Default TimeZone
date_default_timezone_set('Asia/Jakarta');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use \ConvertApi\ConvertApi;

require_once('assets/convert-api/lib/ConvertApi/autoload.php');

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

// ---PF -> Ubah hari indonesia
function hari()
{
    $tgl = date('D');
    switch ($tgl) {
        case 'Sun':
            $hari = "Minggu";
            break;

        case 'Mon':
            $hari = "Senin";
            break;

        case 'Tue':
            $hari = "Selasa";
            break;

        case 'Wed':
            $hari = "Rabu";
            break;

        case 'Thu':
            $hari = "Kamis";
            break;

        case 'Fri':
            $hari = "Jumat";
            break;

        case 'Sat':
            $hari = "Sabtu";
            break;

        default:
            $hari = "Tidak di ketahui";
            break;
    }

    return $hari;
}

// --- PF -> Ubah bulan Indonesia
function bulan($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $pecahkan = explode('-', $tanggal);
    // var_dump($pecahkan);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

// --- PF -> Reset Auto Increment
function resetAI(){
    global $con;
    // UJIAN
    // Akses Ujian
    $result = mysqli_query($con, "SELECT * FROM `akses_ujian`");
    if (mysqli_num_rows($result) == 0) {
        if (!mysqli_query($con, "ALTER TABLE `akses_ujian` AUTO_INCREMENT = 1")) {
            echo "GAGAL";
        }
    }
    // Daftar Ujian
    $result = mysqli_query($con, "SELECT * FROM `daftar_ujian`");
    if (mysqli_num_rows($result) == 0) {
        if (!mysqli_query($con, "ALTER TABLE `daftar_ujian` AUTO_INCREMENT = 1")) {
            echo "GAGAL";
        }
    }
    //  Murid Ujian
    $result = mysqli_query($con, "SELECT * FROM `murid_ujian`");
    if (mysqli_num_rows($result) == 0) {
        if (!mysqli_query($con, "ALTER TABLE `murid_ujian` AUTO_INCREMENT = 1")) {
            echo "GAGAL";
        }
    }
    // Soal Ujian
    $result = mysqli_query($con, "SELECT * FROM `soal_ujian`");
    if (mysqli_num_rows($result) == 0) {
        if (!mysqli_query($con, "ALTER TABLE `soal_ujian` AUTO_INCREMENT = 1")) {
            echo "GAGAL";
        }
    }

    // ABSENSI
    // Absensi
    $result = mysqli_query($con, "SELECT * FROM `absensi`");
    if (mysqli_num_rows($result) == 0) {
        if (!mysqli_query($con, "ALTER TABLE `absensi` AUTO_INCREMENT = 1")) {
            echo "GAGAL";
        }
    }
    // Akses Absensi
    $result = mysqli_query($con, "SELECT * FROM `akses_absensi`");
    if (mysqli_num_rows($result) == 0) {
        if (!mysqli_query($con, "ALTER TABLE `akses_absensi` AUTO_INCREMENT = 1")) {
            echo "GAGAL";
        }
    }
}

// -- PF -> PDF to IMAGE
function pdfToJpg($file) {
    global $baseurl;
    ConvertApi::setApiSecret('xqcrnozrqcdpwA9f');
    $result = ConvertApi::convert('jpg', [
            'File' => $baseurl.'/assets/pdf/'.$file.'.pdf',
        ], 'pdf'
    );
    mkdir($baseurl.'/assets/converted-pdf/'.$file);
    return $result->saveFiles($baseurl.'/assets/converted-pdf/'.$file) ? true : false;
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
    // memfilter html
    $nama = htmlspecialchars($nama);
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);
    $confirm_password = htmlspecialchars($confirm_password);
    // FFF
    $kelas = $data['kelas'];
    $jurusan = $data['jurusan'];

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

    if (!$mail->send()) {
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
        echo "ERROR CODE OTP";
        $_POST['error'] = 'Error Code OTP';
        return false;
    }

    // KONDISI 4 - Jika di tempuser sudah ada username yg sama maka hanya menguba code_otp
    $result = mysqli_query($con, "SELECT email FROM temp_users WHERE email='$email'");
    if (mysqli_fetch_assoc($result)) {
        mysqli_query($con, "UPDATE temp_users SET code_otp=$code_otp WHERE email='$email'");
        $_SESSION['tempPass'] = $password;
        $_SESSION['tempNama'] = $nama;
        $_SESSION['tempEmail'] = $email;
        $_SESSION['tempJurusan'] = $jurusan;
        $_SESSION['tempKelas'] = $kelas;
        return mysqli_affected_rows($con);
    }

    // KONDISI 5 - Jika pertama kali daftar
    // $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($con, "INSERT INTO temp_users SET email='$email', code_otp=$code_otp, status='not verified' ");
    $_SESSION['tempPass'] = $password;
    $_SESSION['tempNama'] = $nama;
    $_SESSION['tempEmail'] = $email;
    $_SESSION['tempJurusan'] = $jurusan;
    $_SESSION['tempKelas'] = $kelas;

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
    $jurusan = $_SESSION['tempJurusan'];
    $kelas = $_SESSION['tempKelas'];
    $password = password_hash($_SESSION['tempPass'], PASSWORD_DEFAULT);

    $result = mysqli_query($con, "SELECT * FROM temp_users WHERE email='$email'");
    $rows = mysqli_fetch_assoc($result);

    // KONDISI 1 - Menyamakan input code oTP dengan di database
    if ($code_otp == $rows['code_otp']) {
        //mysqli_query($con, "UPDATE temp_users SET code_otp='', status='verified' WHERE username='$username'"); // mengembalikan nilai code otp menjadi kosong kembali
        mysqli_query($con, "DELETE FROM temp_users WHERE email='$email'");
        mysqli_query($con, "INSERT INTO users SET nama='$nama', email='$email', password='$password', role=1, kelas='$kelas', jurusan='$jurusan' ");
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
        // $_SESSION['sesiLogin'] = $email;
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
        setFlash("Email tidak ditemukan!", "danger");
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
    $mail->setFrom(USERNAME_EMAIL, 'Cutest');
    $mail->addAddress($email);
    $mail->Subject = 'Kode OTP Lupa Password Cutest.';
    $mail->Body = 'Kode lupa password anda: ' . $code_otp;

    if (!$mail->send()) {
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
        $_POST['error'] = "Gagal mengirim kode otp.";
        setFlash("Gagal mengirim kode otp!", "danger");
        return false;
    }

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
        setFlash("Kode verifikasi salah!", "danger");
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
        setFlash("Konfirmasi password tidak sesuai.", "danger");
        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($con, "UPDATE users SET password='$password' WHERE email='$email' ");
    $_SESSION['email'] = '';
    return mysqli_affected_rows($con);
}



// --- MURID ---
// --- mr -> Submit Jawaban Ulangan
function submitJawaban($data)
{
    global $con;
    $id_ujian = $_SESSION['id_ujian'];
    $no = 1;
    $nilai = 0;

    // QUERY 1 -> Memanggil soal_ujian
    $result = query("SELECT * FROM soal_ujian WHERE id_ujian='$id_ujian'");
    // var_dump($result);die;

    // --- Mengecek semua jawaban terisi atau tidak

    for ($i = 0; $i < $data['jumlahSoal']; $i++) {
        if (!isset($data['jawaban' . $no])) {
            $errorJawaban[] = $data['jawaban' . $no] = "f" . $no;
        }

        // var_dump($jawaban);
        // --- Mengambil jawaban yang ada di database
        $jawabanDatabase = $result[$i]['jawaban'];

        // --- Mengecek jawaban database dengan jawaban dari user
        $jawaban = $data['jawaban' . $no];
        if ($jawabanDatabase == $jawaban) {
            $nilai++;
        } else {
            // $nilai--;
        }

        $no++;
    }
    if(!isset($errorJawaban)){
        $errorJawaban = [];
    }
    if (count($errorJawaban) > 0) {
        $_POST['errorJawaban'] = $errorJawaban;
        return false;
    }

    // --- Algoritma penghitungan nilai berdasarkan jumlah soal
    if ($nilai > 0) {
        $nilai = round($nilai / $data['jumlahSoal'] * 100);
    }
    // --- Algoritma predikat
    if ($nilai > 89) {
        $predikat = "A";
    } else if ($nilai > 79) {
        $predikat = "B";
    } else if ($nilai > 59) {
        $predikat = "C";
    } else if ($nilai < 59) {
        $predikat = "D";
    } else {
        $predikat = "";
    }

    $user = query("SELECT * FROM users WHERE email='$_SESSION[sesiLogin]' ")[0];
    $waktuSelesai = date('Y-d-m / H:i:s');
    mysqli_query($con, "UPDATE murid_ujian SET keterangan='selesai', waktu_selesai='$waktuSelesai', nilai='$nilai', predikat='$predikat' WHERE id_murid='$user[id_user]' AND id_ujian='$id_ujian' ");
    $_POST['nilai'] = $nilai;
    return true;
}


// --- mr -> Submit Absensi
function absensiMurid($data){
    global $con;
    $idAbsensi = $data['id_absen'];
    $keterangan = $data['keterangan'];
    $alasan = isset($data['alasan']) ? "$data[alasan]" : "NULL";
    $idMurid = $_SESSION['sesiId'];
    $waktuAbsen = date("H:i:s");

    // CEK Apakah sudah absen
    if(count(query("SELECT * FROM akses_absensi WHERE id_absensi='$idAbsensi' AND id_murid='$idMurid' "))){
        $_POST['error'] = "Anda sudah melakukan absensi";
        setToast("Anda sudah melakukan absensi.");
        return false;
    }
    // --- Query
    if(!mysqli_query($con, "INSERT INTO akses_absensi (id_absensi,id_murid,waktu_absen,keterangan,alasan) VALUES ('$idAbsensi', '$idMurid', '$waktuAbsen', '$keterangan', '$alasan')")){
        $_POST['error'] = "gagal query";
        return false;
    }
    return true;
}


// --- mr -> Update Profile
function updateProfile($data){
    global $con;
    $id = $_SESSION['sesiId'];
    $nama = htmlspecialchars($data['nama']);
    // $kelas = htmlspecialchars($data['kelas']);
    // $jurusan = htmlspecialchars($data['jurusan']);
    $nis = htmlspecialchars($data['nis']);
    $nisn = htmlspecialchars($data['nisn']);
    $foto = upload('profile');
    if(!$foto){
        if($data['hiddenFoto_profile'] != "" || $data['hiddenFoto_profile'] != "NULL"){
            $foto = $data['hiddenFoto_profile'];
        } else {
            $foto = 'profile.svg';
        }
    }

    // QUERY
    $query = "UPDATE users SET nama='$nama', nis='$nis', nisn='$nisn', foto_profile='$foto' WHERE id_user='$id'";
    if(!mysqli_query($con, $query)){
        echo "<script>
             alert('gagal query')
        </script>";
        return false;
    }
    return true;
}




// --- Guru -> Ujian
// ---Tambah Ujian---

function tambah($data)
{
    global $con;
    // membuat variabel
    // mencegah adanya element html
    $judul = $data['judul'];
    $kelas = $data['kelas'];
    $tipeUjian = $data['tipeUjian'];
    $token = token(6);
    $email = $_SESSION['sesiLogin'];

    // --- Mengambil data guru
    $guru = query("SELECT * FROM guru WHERE email='$email' ")[0];

    // QUERY 1 -> Upload File terlebih dahulu
    $files = upload('ujian'); // mengisi `files` dengan return dari func `upload`
    if (!$files) {
        // $_POST['error'] = "Gagal mengupload file";
        return false;
    }
    $files = explode('.', $files);
    $files = $files[0];

    //* converting pdf to jpg
    pdfToJpg($files);

    // QUERY 2 -> Memasukan topik ke tabel daftar_ujian hanya dengan judul
    if (!mysqli_query($con, "INSERT INTO daftar_ujian SET id_guru='$guru[NIP]', judul='$judul', tipe_ujian='$tipeUjian', file='$files', token='$token' ")) {
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
    // QUERY 5 -> Mengambil kelas_jurusan dari tabel akses_ujian
    $result = query("SELECT * FROM `akses_ujian` INNER JOIN kelas_jurusan ON akses_ujian.kelas_jurusan=kelas_jurusan.id WHERE akses_ujian.id_ujian='$id_ujian' ");
    // -> Pengulangan untuk mengambil kelas dan jurusan dari relasi tabel kelas_jurusan dengan kelas, jurusan
    foreach ($result as $res) {
        // QUERY 5 -> Mengambil semua data users berdasarkan kelas dan jurusan diatas
        $result1 = query("SELECT * FROM users WHERE kelas='$res[kelas]' AND jurusan='$res[jurusan]' ");
        // --- Memasukkan data ke database
        foreach ($result1 as $res) {

            if (!mysqli_query($con, "INSERT INTO murid_ujian (id_ujian,kelas,jurusan,id_murid) VALUES ('$id_ujian','$res[kelas]','$res[jurusan]','$res[id_user]') ")) {
                // if(!mysqli_query($con, "INSERT INTO murid_ujian SET id_ujian='$id"))
                $_POST['error'] = "Gagal mengatur murid ujian";
                return false;
            }
        }
    }

    $_SESSION['id_ujian'] = $id_ujian;
    return mysqli_affected_rows($con);
}

// * --- Ubah Ujian ---
function ubahUjian($data)
{
    // var_dump($data);
    global $con;
    $id_ujian = $_GET['iu'];
    $judul = $data['judul'];
    $jumlahSoal = $data['jumlahSoal'];
    $kelas = $data['kelas'];
    $tipeUjian = $data['tipeUjian'];
    $email = $_SESSION['sesiLogin'];
    $token = token(6);

    // --- Mengambil data guru & ujian
    $guru = query("SELECT * FROM guru WHERE email='$email' ")[0];
    $daftar = query("SELECT * FROM daftar_ujian WHERE id_ujian='$id_ujian' AND id_guru='$guru[NIP]'")[0];

    // QUERY 1 -> Upload File terlebih dahulu
    $files = upload('ujian'); // mengisi `files` dengan return dari func `upload`
    if (!$files) {
        // $_POST['error'] = "Gagal mengupload file";
        // setToast("ERROR FILE");
        $files = $daftar['file'];
    } else {
        $files = explode('.', $files);
        $files = $files[0];
        //* converting pdf to jpg
        pdfToJpg($files);
    }
    // echo $files;
    // die;


    // QUERY 2 -> Mengubah daftar_ujian
    if (!mysqli_query($con, "UPDATE daftar_ujian SET judul='$judul', tipe_ujian='$tipeUjian', file='$files', token='$token' WHERE id_ujian='$id_ujian' ")) {
        $_POST['error'] = "Gagal mengubah daftar_ujian";
        setToast("GAGAL mengubah daftar_ujian");
        return false;
    }

    // QUERY 3 ->  Mengambil akses ujian
    // $aksesUjian = query("SELECT * FROM akses_ujian WHERE id_ujian='$id_ujian' ");
    $aksesUjian = query("SELECT * FROM akses_ujian WHERE id_ujian='$id_ujian' ");
    
    // -> Pengulangan untuk array `kelas`
    mysqli_query($con, "DELETE FROM akses_ujian WHERE id_ujian='$id_ujian'");
    foreach($kelas as $value) {
        // var_dump($value);
        // QUERY 4 -> Sorting akses ujian berdasarkan `kelas` dengan `id_ujian` yang sudah diambil
        if (!mysqli_query($con, "INSERT INTO akses_ujian SET kelas_jurusan='$value', id_ujian='$id_ujian'")) {
            $_POST['error'] = "Gagal mengatur akses ujian";
            setToast("GAGAL mengubah akses_ujian");
            return false;
        }
    }

    // QUERY 5 -> Mengambil kelas_jurusan dari tabel akses_ujian
    $result = query("SELECT * FROM `akses_ujian` INNER JOIN kelas_jurusan ON akses_ujian.kelas_jurusan=kelas_jurusan.id WHERE akses_ujian.id_ujian='$id_ujian' ");
    // -> Pengulangan untuk mengambil kelas dan jurusan dari relasi tabel kelas_jurusan dengan kelas, jurusan
    mysqli_query($con, "DELETE FROM murid_ujian WHERE id_ujian='$id_ujian'");
    foreach ($result as $res) {
        // var_dump($res);
        // QUERY 5 -> Mengambil semua data users berdasarkan kelas dan jurusan diatas
        $result1 = query("SELECT * FROM users WHERE kelas='$res[kelas]' AND jurusan='$res[jurusan]' ");
        // --- Memasukkan data ke database
        foreach ($result1 as $res) {
        //     // var_dump($res);
            if (!mysqli_query($con, "INSERT INTO murid_ujian SET kelas='$res[kelas]', jurusan='$res[jurusan]', id_murid='$res[id_user]', id_ujian='$id_ujian' ")) {
                $_POST['error'] = "Gagal mengatur murid ujian";
                setToast("GAGAL mengubah murid_ujian");
                return false;
            }
        }
    }


    //* Mengubah Kunci Jawaban
    ubahJawaban($data);

    // $_SESSION['id_ujian'] = $id_ujian;
    return mysqli_affected_rows($con);
}


// --- Guru -> Ujian --> Upload File
function upload($tipe)
{
    $tipe = $tipe;

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
    if($tipe == 'ujian'){
        $validType = ['pdf'];
    } else if($tipe == 'profile') {
        $validType = ['png', 'jpg', 'jpeg'];
    }
    $ekstensiGambar = explode('.', $namaFile); // mengubah $namaFile menjadi array terpisah saat terdapat titik
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // mengubah semua ke lowercase // mengambil array paling akhir

    // in_array($string, $array) = mengecek apakah ada string didalam array | menghasilkan nilai true / false
    if($tipe == 'ujian'){
        if (!in_array($ekstensiGambar, $validType)) {
            $_POST['error'] = "Harap input file pdf";
            return false;
        }
    } else if($tipe == 'profile') {
        if (!in_array($ekstensiGambar, $validType)) {
            $_POST['error'] = "Harap input file png/jpeg";
            return false;
        }
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
    // $_SESSION['soal-ujian'] = $namaFileBaru;
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    if($tipe == 'ujian'){
        move_uploaded_file($tmpName, 'assets/pdf/' . $namaFileBaru);
    } else if($tipe == 'profile'){
        move_uploaded_file($tmpName, 'assets/profile/' . $namaFileBaru);
    }
    return $namaFileBaru;
}


//! --- Guru -> Ubah Ujian --> Ubah jawaban
function ubahJawaban($data){
    global $con;
    $jumlahSoal = $data['jumlahSoal'];
    $id_ujian = $_GET['iu'];

    //*** Menghapus jawaban berdasarkan ID_UJIAN
    mysqli_query($con, "DELETE FROM soal_ujian WHERE id_ujian='$id_ujian' ");

    //* Pengulangan untuk memanggil semua input name jawaban dengan 1 indeks i
    for($i = 1; 1 <= $jumlahSoal; $i++) {
        //** Jika ada salah satu jawaban yang kosong maka mengembalikan nilai false
        if(!isset($data['jawaban'.$i])) {
            $_POST['jumlah'] = true;
            $_POST['jumlahSoal'] = $jumlahSoal;
            $_POST['error'] = "Jawaban tidak boleh kosong";
            return false;
        }

        $jawaban = $data['jawaban'.$i];

        //*** RESET AUTO INCREMENT
        $result = mysqli_query($con, "SELECT * FROM soal_ujian");
        if(mysqli_num_rows($result) == 0){
            mysqli_query($con, "ALTER TABLE soal_ujian AUTO_INCREMENT=1");
        }

        //*** Insert Jawaban Ke Database
        if( !mysqli_query($con, "INSERT INTO soal_ujian SET id_ujian='$id_ujian', nomor_soal='$i', jawaban='$jawaban' ")){
            $_POST['error'] = "Gagal input ujian";
            return false;
        }
    }
    return true;
}


// --- Guru -> Ujian --> Input Jawaban
function tambahJawaban($data)
{
    global $con;
    $jumlahSoal = $data['jumlahSoal'];
    $id_ujian = $_SESSION['id_ujian'];
    // $id_ujian = 1;

    // Pengulangan untuk memanggil semua input name jawaban dengan indeks i
    for ($i = 1; $i <= $jumlahSoal; $i++) {
        // echo $data['jawaban'.$i];

        // KONDISI 1 - Jika ada salah satu jawaban yang kosong maka mengembalikan false
        if (!isset($data['jawaban' . $i])) {
            $_POST['jumlah'] = true;
            $_POST['jumlahSoal'] = $jumlahSoal;
            $_POST['error'] = "Jawaban tidak boleh kosong";
            return false;
        }

        $jawaban = $data['jawaban' . $i];

        // RESET AUTO INCREMENT
        $result = mysqli_query($con, "SELECT * FROM `soal_ujian`");
        if (mysqli_num_rows($result) == 0) {
            if (!mysqli_query($con, "ALTER TABLE `soal_ujian` AUTO_INCREMENT = 1")) {
                echo "Gagal reset auto_increment";
            }
        }
        // QUERY 1 - Insert jawaban ke database
        if (!mysqli_query($con, "INSERT INTO soal_ujian SET id_ujian='$id_ujian', nomor_soal='$i', jawaban='$jawaban' ")) {
            $_POST['error'] = "Gagal input ujian";
            return false;
        }
    }

    // $_POST['jumlah'] = true;
    // $_POST['jumlahSoal'] = $jumlahSoal;
    return true;
}



// --- Operator ---
// --- OP -> Input absensi
function tambahAbsensi($data)
{
    global $con;
    $email = $_SESSION['sesiLogin'];
    $user = query("SELECT * FROM users WHERE email='$email'")[0];
    if ($user['role'] != '4') { // operator role
        return false;
    }
    $keterangan = htmlspecialchars($data['keterangan']);
    $tgl = $data['tanggal'];

    // Hari, Bulan Tahun
    $tanggal = hari();
    $tanggal .= ", " . bulan($tgl);

    // Waktu Expired
    // $tanggalExp = $data['time'];
    // $expTime = strtotime($tanggalExp); // set cookie
    $tanggalExp = $data['time'];    
    $expTime = strtotime($tanggalExp); // set cookie

    if (!mysqli_query($con, "INSERT INTO absensi SET absensi='$keterangan', tanggal='$tanggal', tanggal_exp='$tanggalExp' ")) {
        return false;
    }
    $absensi = query("SELECT * FROM absensi WHERE tanggal='$tanggal' AND tanggal_exp='$tanggalExp' ")[0];
    setcookie("id_absen", $absensi['id_absen'], $expTime);
    return true;
}


// Reset Waktu
function resetWaktu()
{
    global $con;

    // RESET ABSENSI
    $listAbsen = query("SELECT * FROM absensi WHERE status='aktif'");
    foreach($listAbsen as $absen){
        $absenExp = strtotime($absen['tanggal_exp']);
        $rightNow = time();

        if ($ide = $absenExp < $rightNow) {
            $idAbsen = date("H:i",$absenExp);
            // echo $idAbsen;
            // $_POST['error'] = "";
            mysqli_query($con, "UPDATE absensi SET status='tidak aktif' WHERE tanggal_exp='$idAbsen' AND status='aktif'");
            // unset($_SESSION['id_absen']);
        } else {
            // echo "AJOG";
        }
    }
}

