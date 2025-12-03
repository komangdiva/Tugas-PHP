<?php
    require_once __DIR__ . '/inc/config.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tambah Mahasiswa</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <h2>Tambah Mahasiswa</h2>

        <form action="save.php" method="post" enctype="multipart/form-data">

            <label>Nama</label>
            <input type="text" name="nama" required>

            <label>NIM</label>
            <input type="text" name="nim" required>

            <label>Prodi</label>
            <select name="prodi" required>
                <option value="">-- Pilih Prodi --</option>
                <option value="SI">SI</option>
                <option value="TI">TI</option>
                <option value="MI">MI</option>
                <option value="DKV">DKV</option>
            </select>

            <label>Angkatan</label>
            <input type="number" name="angkatan" min="2000" max="2100" required>

            <label>Status</label>
            <select name="status" required>
                <option value="aktif">Aktif</option>
                <option value="tidak_aktif">Tidak Aktif</option>
            </select>


            <button type="submit" class="btn">Simpan</button>
        </form>

    </body>
</html>