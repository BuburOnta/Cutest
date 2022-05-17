<style>

</style>
<?php
function setFlash($pesan, $tipe)
{
    $_SESSION['flash'] = [
        "pesan" => $pesan,
        "tipe" => $tipe
    ];
}

function flash()
{
    if (isset($_SESSION['flash'])) {
        echo "
            <div class='alert alert-{$_SESSION["flash"]["tipe"]} alert-dismissible fade show' role='alert'>
                <strong>{$_SESSION["flash"]["pesan"]}</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        unset($_SESSION['flash']);
    }

    echo '
    <style>
    button {
        cursor: pointer;
    }
    /* BOOTSTRAP */
    .alert {
        position: relative;
        padding: 1rem 1rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.25rem;
    }

    .alert-heading {
        color: inherit;
    }

    .alert-link {
        font-weight: 700;
    }

    .alert-dismissible {
        padding-right: 3rem;
    }

    .alert-dismissible .btn-close {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 2;
        padding: 1.25rem 1rem;
    }

    .alert-primary {
        color: #084298;
        background-color: #cfe2ff;
        border-color: #b6d4fe;
    }

    .alert-primary .alert-link {
        color: #06357a;
    }

    .alert-secondary {
        color: #41464b;
        background-color: #e2e3e5;
        border-color: #d3d6d8;
    }

    .alert-secondary .alert-link {
        color: #34383c;
    }

    .alert-success {
        color: #0f5132;
        background-color: #d1e7dd;
        border-color: #badbcc;
    }

    .alert-success .alert-link {
        color: #0c4128;
    }

    .alert-info {
        color: #055160;
        background-color: #cff4fc;
        border-color: #b6effb;
    }

    .alert-info .alert-link {
        color: #04414d;
    }

    .alert-warning {
        color: #664d03;
        background-color: #fff3cd;
        border-color: #ffecb5;
    }

    .alert-warning .alert-link {
        color: #523e02;
    }

    .alert-danger {
        color: #842029;
        background-color: #f8d7da;
        border-color: #f5c2c7;
    }

    .alert-danger .alert-link {
        color: #6a1a21;
    }

    .alert-light {
        color: #636464;
        background-color: #fefefe;
        border-color: #fdfdfe;
    }

    .alert-light .alert-link {
        color: #4f5050;
    }

    .alert-dark {
        color: #141619;
        background-color: #d3d3d4;
        border-color: #bcbebf;
    }

    .alert-dark .alert-link {
        color: #101214;
    }

    .alert {
        box-sizing: border-box;
        position: relative;
        font-size: 12px;
        width: 100%;
        height: 39px;
        padding: 12px 18px;
        margin-bottom: 7px;
        padding-right: 28px;
        text-align: left;
    }

    .alert .btn-close {
        width: max-content;
        height: max-content;
        top: -2px;
        right: 0;
    }
    </style>
    ';
}
?>