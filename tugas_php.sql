create database tugas_php;

use tugas_php;

CREATE TABLE mahasiswa (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    
    nama VARCHAR(150) NOT NULL,
    nim VARCHAR(20) NOT NULL UNIQUE,
    prodi VARCHAR(50) NOT NULL,
    angkatan INT NOT NULL,
    
    foto_path VARCHAR(255) DEFAULT NULL,
    
    status ENUM('aktif', 'tidak_aktif') DEFAULT 'aktif',
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
);
