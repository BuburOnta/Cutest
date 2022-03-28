<?php
require "page/page.php";
require "function.php";

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




        // GURU
        // -> Input Ujian
        case 'input_ujian':
            include_once $input_ujian;
            break;
            
        default:
            include_once $dashboard_page; // jika isi page tidak diisi
            break;
    }
} else {
    include $dashboard_page; // jika tidak ada url page
}