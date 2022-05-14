<?php
function setToast($pesan, $tipe)
{
    $_SESSION['flash'] = [
        "pesan" => $pesan,
        "tipe" => $tipe
    ];
}
function toast()
{
    if (isset($_SESSION['flash'])) {
        echo "
        <div class='toast'>
            <div class='toast-header'>
                <img src='assets/icon/logo.svg' class='rounded me-2 toast-logo' alt='...' style='margin-right:4px;'>
                <strong class='me-auto'>Cutest</strong>
                <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
            <div class='toast-body text-{$_SESSION['flash']['tipe']}'>
                {$_SESSION['flash']['pesan']}
            </div>
        </div>
        <script>
            toastOut('btn-close', 'toast');
        </script>
        ";
        unset($_SESSION['flash']);
    }

    echo '
    <style>
    /* BOOTSTRAP */
    .toast {
        width: 350px;
        max-width: 100%;
        font-size: 0.875rem;
        pointer-events: auto;
        background-color: rgba(255, 255, 255, 0.85);
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-radius: 0.25rem;
    }

    .toast:not(.showing):not(.show) {
        opacity: 0;
    }

    .toast.hide {
        display: none;
    }

    .toast-container {
        width: -webkit-max-content;
        width: -moz-max-content;
        width: max-content;
        max-width: 100%;
        pointer-events: none;
    }

    .toast-container> :not(:last-child) {
        margin-bottom: 0.75rem;
    }

    .toast-header {
        display: flex;
        align-items: center;
        padding: 0.5rem 0.75rem;
        color: #6c757d;
        background-color: rgba(255, 255, 255, 0.85);
        background-clip: padding-box;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        border-top-left-radius: calc(0.25rem - 1px);
        border-top-right-radius: calc(0.25rem - 1px);
    }

    .toast-header .btn-close {
        margin-right: -0.375rem;
        margin-left: 0.75rem;
    }

    .toast-body {
        padding: 0.75rem;
        word-wrap: break-word;
    }

    

    .toast {
        position: fixed;
        bottom: 50px;
        animation: toastIn 1s ease-in-out forwards;
        z-index: 999;
    }

    @keyframes toastIn {
        from {
            right: -150px;
            opacity: 0;
        }

        to {
            right: 20px;
            opacity: 1;
        }
    }

    @keyframes toastOut {
        from {
            right: 20px;
            opacity: 1;
        }

        to {
            right: -150px;
            opacity: 0;
        }
    }

    .toast-logo {
        filter: invert(21%) sepia(8%) saturate(5111%) hue-rotate(184deg) brightness(100%) contrast(95%);
    }
</style>
    ';
}
?>
<script>
    function toastOut(closeBtn, toastContainer) {
        const closeBtns = document.querySelector("." + closeBtn)
        const toastContainers = document.querySelector("." + toastContainer)
        closeBtns.addEventListener('click', function() {
            console.log(toastContainers.style.animation = 'toastOut 1s forwards')
        })
    }
</script>

<style>
    /* BUTTON */
    .btn-close {
        box-sizing: content-box;
        width: 1em;
        height: 1em;
        padding: 0.25em 0.25em;
        color: #000;
        background: transparent url("data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 16 16\' fill=\'%23000\'%3e%3cpath d=\'M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z\'/%3e%3c/svg%3e") center/1em auto no-repeat;
        border: 0;
        border-radius: 0.25rem;
        opacity: 0.5;
        cursor: pointer;

        position: absolute;
        right: 12px;
    }

    .btn-close:hover {
        color: #000;
        text-decoration: none;
        opacity: 0.75;
    }

    .btn-close:focus {
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        opacity: 1;
    }

    .btn-close.disabled,
    .btn-close:disabled {
        pointer-events: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        opacity: 0.25;
    }

    .btn-close-white {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
</style>