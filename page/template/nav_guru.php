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

        background: #1A3163;

        font-weight: 600;
        color: #fff;
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
</style>
<?php 
    $email = $_SESSION['sesiLogin'];
    $users = query("SELECT * FROM guru WHERE email='$email'")[0];
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
    <div class="right">
        <span><?= $users['email'] ?></span>
        <img src="assets/img/profile_icon.png">
    </div>
</nav>