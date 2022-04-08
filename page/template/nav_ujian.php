<style>
    @import url(font.css);

    * {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: "Poppins", sans-serif;
        font-size: 15px;
    }

    nav.head {
        width: 100%;
        box-sizing: border-box;
        padding: 5px 30px;

        display: flex;
        justify-content: space-between;
        align-items: center;

        background: transparent;
        color: #0029FF;

        font-weight: 600;
    }

    nav.head a {
        text-decoration: none;
        color: inherit;
        font-weight: 500;
        font-size: 15px;

        margin-right: 5px;
    }

    nav.head .left {
        width: 277px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    nav.head .left img {
        filter: invert(49%) sepia(86%) saturate(2826%) hue-rotate(162deg) brightness(96%) contrast(103%);
    }

    nav.head .right {
        box-sizing: border-box;
        width: 253px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    nav.head .right span {
        display: inline-block;
        /* margin-left: -10px; */
    }

    nav.head img {
        width: 60px;
    }

    nav.head .center {
        color: #C5c5c5;
        font-size: 1.2em;
    }
</style>
<?php 

?>
<nav class="head">
    <div class="left">
        <img src="assets/img/cutest_logo_text.svg">
        <div class="left_right">
            <a href="#">Beranda</a>
            <a href="#">Fitur</a>
            <a href="#">Kontak</a>
        </div>
    </div>

    <?php if(isset($_GET['page'])){
        if($_GET['page'] == 'raport'){
            echo "
            <div class='center'>
                <h1>". $_GET['page'] ."</h1>
            </div>
            ";
            // echo $_GET['page'];
        } else  { ?>
            <?php 
                $id_ujian = $_SESSION['id_ujian'];
                $ujian = query("SELECT * FROM daftar_ujian WHERE id_ujian='$id_ujian'")[0];
            ?>
            <div class="center">
                <h1><?= $ujian['judul'] ?></h1>
            </div>
        <?php }} ?>

    <div class="right">
        <span>anjingah@cute.com</span>
        <img src="assets/img/profile_icon.png">
    </div>
</nav>