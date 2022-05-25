<?php
session_start();


if(isset($_POST['submit'])){
  if(upload('ujian') > 0) {
    echo pdfToJpg($_SESSION['soal-ujian']);
  } else {
    echo 'gagal';
  }
}
// echo $baseurl.'/dummy/converted/'.$_SESSION['soal-ujian'].';
?>
  <form method="POST" action="" enctype="multipart/form-data">
    <input type="file" name="files" id="files">
    <button type="submit" name="submit">Submit</button>
  </form>


<style>
  .soal-ujian {
    width: 535.5px;
    height: 700px;
    display: flex;
    flex-direction: column;
    overflow: auto;
    scrollbar-width: thin;
  }
</style>





<?php
  // $files = scandir($path);
  // for ($i=1; $i < count($files); $i++) { 
  //   if($files[$i] == $_SESSION['soal-ujian'].'.jpg') {
  //     $files[$i] = $_SESSION['soal-ujian'].'-1.jpg';
  //   }
  // }
  // sort($files);
  var_dump($files);
?>

<div class="soal-ujian">
  <img src="dummy/converted/<?= $_SESSION['soal-ujian'] ?>/<?= $_SESSION['soal-ujian']?>.jpg" alt="">
  <?php for ($i=1; $i < count($files); $i++) { ?>
    <img src="dummy/converted/<?= $_SESSION['soal-ujian'] ?>/<?= $_SESSION['soal-ujian'].'-'.$i ?>.jpg" alt="">
  <?php } ?>
</div>