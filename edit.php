<?php
require_once __DIR__ . '/inc/config.php';

$id = $_GET['id'] ?? null;

if ($id === null || !ctype_digit($id)) {
    Utility::redirect('members.php', 'ID tidak valid.');
}

$mhs = new Mahasiswa();
$row = $mhs->getById((int)$id);

if (!$row) {
    Utility::redirect('members.php', 'Data tidak ditemukan.');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Mahasiswa</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php Utility::showNav(); ?>

        <h2>Edit Mahasiswa</h2>
    </body>
</html>
