<?php
require_once __DIR__ . '/inc/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Utility::redirect('members.php', 'Akses tidak valid.');
}

$id = $_POST['id'] ?? null;

if ($id === null || !ctype_digit($id)) {
    Utility::redirect('members.php', 'ID tidak valid.');
}

$mhs = new Mahasiswa();
$lama = $mhs->getById((int)$id);

if (!$lama) {
    Utility::redirect('members.php', 'Data tidak ditemukan.');
}

if (!empty($lama['foto_path'])) {
    $filePath = __DIR__ . '/' . $lama['foto_path'];

    if (file_exists($filePath)) {
        @unlink($filePath);
    }
}
