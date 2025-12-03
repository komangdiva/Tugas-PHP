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

$nama     = trim($_POST['nama'] ?? '');
$nim      = trim($_POST['nim'] ?? '');
$prodi    = $_POST['prodi'] ?? '';
$angkatan = $_POST['angkatan'] ?? '';
$status   = $_POST['status'] ?? 'aktif';

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
    Utility::redirect('edit.php?id=' . $id, implode(' | ', $errors));
}
