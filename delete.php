<?php
require_once __DIR__ . '/inc/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Utility::redirect('members.php', 'Akses tidak valid.');
}

$id = $_POST['id'] ?? null;

if ($id === null || !ctype_digit($id)) {
    Utility::redirect('members.php', 'ID tidak valid.');
}
