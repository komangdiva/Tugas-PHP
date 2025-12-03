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

$errors = [];
    if ($nama === '') {
        $errors[] = 'Nama wajib diisi.';
    }

    if ($nim === '') {
        $errors[] = 'NIM wajib diisi.';
    }

    $allowedProdi = ['SI','TI','MI','DKV'];
    if (!in_array($prodi, $allowedProdi, true)) {
        $errors[] = 'Prodi tidak valid.';
    }

    if (!ctype_digit((string)$angkatan) || (int)$angkatan < 2000) {
        $errors[] = 'Angkatan tidak valid.';
    }

    $allowedStatus = ['aktif', 'tidak_aktif'];
    if (!in_array($status, $allowedStatus, true)) {
        $errors[] = 'Status tidak valid.';
    }

    if (!empty($errors)) {
        Utility::redirect('create.php', implode(' | ', $errors), $prefill);
    }
