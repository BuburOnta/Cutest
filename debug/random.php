<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/random.css">
</head>

<body>
    <div class="container">
        <div class="right-side">
            <form method="POST" action="" class="bawah">
                <!-- <div class="lol"> -->
                <?php
                $soal = 55;
                $p = $soal."px";
                // echo "
                //         <style>
                //             div.container div.input_group {
                //                 height: calc(100% / $p);
                //             }
                //         </style>
                //         ";
                ?>
                <?php $no = 1;  ?>
                <?php for ($i = 1; $i <= $soal; $i++) : ?>
                    <div class="input_group">
                        <?php echo "<label for=" . $no . ">$no</label>" ?>
                        <div class="right">
                            <div class="input">
                                <input type="radio" <?= "name=jawaban" . $no ?> <?= "id=jawaban" . $no ?> value="a">
                            </div>
                            <div class="input">
                                <!-- <span>B</span> -->
                                <input type="radio" <?= "name=jawaban" . $no ?> <?= "id=jawaban" . $no ?> value="b">
                            </div>
                            <div class="input">
                                <!-- <span>C</span> -->
                                <input type="radio" <?= "name=jawaban" . $no ?> <?= "id=jawaban" . $no ?> value="c">
                            </div>
                            <div class="input">
                                <!-- <span>D</span> -->
                                <input type="radio" <?= "name=jawaban" . $no ?> <?= "id=jawaban" . $no ?> value="d">
                            </div>
                        </div>
                    </div>
                    <?php $no++; ?>
                <?php endfor; ?>
                <!-- <button type="submit" name="submitJawaban" class="submit_jawaban">submit</button> -->
                <!-- </div> -->
            </form>
        </div>
    </div>
</body>

</html>