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

$fotoPath = $lama['foto_path']; 

if (!empty($_FILES['foto']['name'])) {
    $file = $_FILES['foto'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Terjadi kesalahan saat upload file.';
    } else {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($file['type'], $allowedTypes, true)) {
            $errors[] = 'Tipe file harus JPG, PNG, atau WebP.';
        }

        if ($file['size'] > 2 * 1024 * 1024) {
            $errors[] = 'Ukuran file maksimal 2MB.';
        }
    }

    if (!empty($errors)) {
        Utility::redirect('edit.php?id=' . $id, implode(' | ', $errors));
    }

    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0777, true);
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = time() . '_' . bin2hex(random_bytes(5)) . '.' . $ext;
    $dest = UPLOAD_DIR . '/' . $newName;

    if (move_uploaded_file($file['tmp_name'], $dest)) {
        // hapus foto lama kalau ada
        if (!empty($lama['foto_path'])) {
            $oldFile = __DIR__ . '/' . $lama['foto_path'];
            if (file_exists($oldFile)) {
                @unlink($oldFile);
            }
        }

        $fotoPath = UPLOAD_PATH . '/' . $newName;
    }
}
