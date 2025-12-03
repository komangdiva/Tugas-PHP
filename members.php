<?php
    require_once __DIR__ . '/inc/config.php';

    $mhs = new Mahasiswa();
    $data = $mhs->getAll();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Daftar Mahasiswa</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>

<?php Utility::showNav(); ?>

<h2>Daftar Mahasiswa</h2>

<?php Utility::showFlash(); ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Prodi</th>
            <th>Angkatan</th>
            <th>Foto</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
</table>
</body>
</html>
