<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Ujian</title>
    <link rel="stylesheet" href="assets/css/pilih_ujian.css">
</head>

<body>
    <div class="logo">
        <img src="assets/img/cutest_logo_text.svg">
    </div>

    <div class="container">
        <div class="card">
            <img src="assets/img/dashboard_ujian.svg">
            <span>ujian</span>
        </div>

        <form method="POST" action="">
            <h3>Kategori ujian</h3>
            <img src="assets/img/ujian_vector.svg">
            <select name="pilih_ujian" id="pilih_ujian">
                <option selected hidden class="p">Pilih ujian</option>
                <option value="">Matematika</option>
                <option value="">Pemrograman Dasar</option>
            </select>

            <button type="submit" name="next">Next</button>
        </form>
    </div>
</body>

</html>