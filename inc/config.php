<?php

    session_start();

    spl_autoload_register(function ($class_name){
        $file = __DIR__ . '/../class/' . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    });

    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_NAME = 'tugas_php';

    const UPLOAD_DIR = __DIR__ . '/../uploads';
    const UPLOAD_PATH = 'uploads';

    const BASE_URL = 'http://localhost:8000/';

    const NAV_PAGES = [
    ['title' => 'Home',   'url' => 'index.php'],
    ['title' => 'Daftar', 'url' => 'members.php'],
    ['title' => 'Tambah', 'url' => 'create.php']
    ];