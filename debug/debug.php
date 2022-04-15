<?php
session_start();
// if(isset($_POST['submit'])){
//     $file = upload('profile');
//     mysqli_query($con, "UPDATE users SET foto_profile='$file' WHERE id_user=''");
// }
var_dump($_POST);
echo '<br>';
var_dump($_FILES);
?>
<form method="POST" action="" enctype="multipart/form-data">
    <input type="file" name="files" id="files">
    <button type="submit" name="submit">Submit</button>
</form>