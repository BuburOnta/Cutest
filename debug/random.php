<?php 
$con = mysqli_connect('localhost', 'root', '', 'cutest');

// var_dump(mysqli_num_rows(mysqli_query($con,"SELECT * FROM `akses_ujian`")));
$result = mysqli_query($con,"SELECT * FROM `akses_ujian`");
if(mysqli_num_rows($result) == 0) {
    if(!mysqli_query($con, "ALTER TABLE `akses_ujian` AUTO_INCREMENT = 1")){
        echo "GAGAL";
    }
} else{
    echo mysqli_num_rows($result);
}

// mysqli_query($con, "ALTER TABLE `akses_ujian` AUTO_INCREMENT = number");