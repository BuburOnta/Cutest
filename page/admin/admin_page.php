<?php 
session_start();

// Cek session
if (!$_SESSION['sesiLogin']){
    header("Location: ?page=login");
} else if ($_GET['page'] != $_SESSION['role']){
    header("Location: ?page=".$_SESSION['role']);
}
?>
admin