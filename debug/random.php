<?php 
session_start();
var_dump($_SESSION);
?>
<html lang="id">
<head>
    <title>P</title>
</head>
<body>
    <a href="javascript:sesi('pilih_ujian')">
        P
    </a>

<script>
    function sesi(e){
        let f = window.ujian = "F";
        window.location.href = '?page='+e;
    }
</script>
</body>
</html>