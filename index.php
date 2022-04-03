<?php
// require "page/page.php";
require "function.php";

$login_page = 'page/login_page.php';
$register_page = 'page/register_page.php';
$dashboard_page = 'page/dashboard_page.php';
$guru_page = 'page/guru/guru_dashboard.php';
$admin_page = 'page/admin_page.php';

$profile_page = 'page/profile_page.php';
$register_verification = 'page/register_verification.php';
$login_lupa_pass = 'page/login_lupa_password.php';
$login_verification = 'page/login_verification.php';
$login_ubah_password = 'page/login_ubah_password.php';

// UJIAN
$pilih_ujian = 'page/ujian/pilih_ujian.php';
$tampilan_ujian = 'page/ujian/tampilan_ujian.php';
$nilai = 'page/ujian/nilai_ujian.php';
$nav_ujian = 'page/template/nav_ujian.php';

// GURU
$nav = "page/template/nav.php";
$input_ujian = 'page/guru/input_ujian.php';
$input_jawaban = 'page/guru/input_jawaban.php';


if( isset($_GET['page']) ){
$page = $_GET['page'];

    switch ($page) {
        // Page dashboard
        case 'admin':
            include_once $admin_page;
            break;
        case 'guru':
            include_once $guru_page;
            break;
        case 'dashboard':
            include_once $dashboard_page;
            break;
        case 'home':
            include_once $dashboard_page;
            break;

        // Login & Register
        case 'register':
            include_once $register_page;
            break;
        case 'register_verification':
            include_once $register_verification;
            break;

        case 'login':
            include_once $login_page;
            break;
        case 'lupa_password':
            include_once $login_lupa_pass;
            break;
        case 'login_verification':
            include_once $login_verification;
            break;
        case 'ubah_password':
            include_once $login_ubah_password;
            break;
        case 'logout':
            include_once 'page/logout.php';
            break;

        // Page Ujian
        case 'pilih_ujian':
            include_once $pilih_ujian;
            break;
        case 'ujian':
            include_once $tampilan_ujian;
            break;
        case 'nilai':
            include_once $nilai;
            break;


    // RANDOM
    case 'random':
        include_once "debug/random.php";
        break;


        // GURU
        // -> Input Ujian
        case 'input_ujian':
            include_once $input_ujian;
            break;
        case 'input_jawaban':
            include_once $input_jawaban;
            break;
            
        default:
            include_once $dashboard_page; // jika isi page tidak diisi
            break;
    }
} else {
    include $dashboard_page; // jika tidak ada url page
}
// var_dump($_SESSION);
// echo '<br>';