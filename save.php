<?php
require_once __DIR__ . '/inc/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Utility::redirect('members.php', 'Akses tidak valid.');
}

$nama     = trim($_POST['nama'] ?? '');
$nim      = trim($_POST['nim'] ?? '');
$prodi    = $_POST['prodi'] ?? '';
$angkatan = $_POST['angkatan'] ?? '';
$status   = $_POST['status'] ?? 'aktif';

$prefill = [
    'nama'     => $nama,
    'nim'      => $nim,
    'prodi'    => $prodi,
    'angkatan' => $angkatan,
    'status'   => $status,
];
