# Aplikasi CRUD Mahasiswa (PHP OOP + PDO)

## 1. Deskripsi Aplikasi
Aplikasi ini merupakan sistem backend sederhana untuk mengelola data **Mahasiswa** menggunakan bahasa pemrograman **PHP** dengan pendekatan **OOP**, serta koneksi basis data menggunakan **PDO**.  
Aplikasi menyediakan fitur CRUD: *Create, Read, Update, Delete* termasuk upload foto mahasiswa.

### Entitas yang Dipilih
**Entitas: Mahasiswa**  
Dengan atribut:
- nama  
- nim  
- prodi  
- angkatan  
- foto_path 
- status

### Fungsi Singkat Aplikasi
- Menambah data mahasiswa baru beserta foto
- Menampilkan daftar mahasiswa dalam bentuk tabel
- Mengubah data mahasiswa
- Menghapus data mahasiswa sekaligus menghapus foto terkait
- Menyimpan file foto ke folder `uploads/`
- Menggunakan PDO dan prepared statement untuk keamanan input

---

## 2. Spesifikasi Teknis

### Versi Bahasa & DBMS
- **PHP**: 8.4.13  
- **Database**: MySQL 
- **Driver**: PDO

### Struktur Folder (Ringkas)
```text
tugasPhp/
│ index.php
│ members.php
│ create.php
│ edit.php
│ save.php
│ update.php
│ delete.php
│
├── class/
│ ├── Database.php
│ ├── Mahasiswa.php
│ └── Utility.php
│
├── inc/
│ └── config.php
│
├── css/
│ └── style.css
│
└── uploads/
└── .gitkeep
```

### Penjelasan Class Utama
#### 1. **Database.php**
- Membuat koneksi ke MySQL menggunakan PDO  
- Menyediakan method `query()` untuk menjalankan prepared statement  
- Digunakan oleh semua repository (Mahasiswa.php)

#### 2. **Mahasiswa.php**
Berfungsi sebagai **Entity + Repository**, berisi:
- `getAll()` → mengambil semua data  
- `getById()` → mengambil data berdasarkan id  
- `insert()` → menambah data baru  
- `update()` → memperbarui data  
- `delete()` → menghapus data  

#### 3. **Utility.php**
- Menampilkan navigasi  
- Menampilkan flash message  
- Redirect halaman  
- Menyimpan data prefill ketika validasi gagal  

---

## 3. Instruksi Menjalankan Aplikasi

### 3.1 Impor Basis Data (schema.sql)
Buat database:

```sql
CREATE DATABASE tugas_php;
USE tugas_php;

CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    nim VARCHAR(20),
    prodi VARCHAR(20),
    angkatan INT,
    foto_path VARCHAR(255),
    status ENUM('aktif','tidak_aktif'),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL
);
```

### 3.2 Atur Konfigurasi Koneksi Database
Edit file:
inc/config.php
```php
Ubah sesuai environment:
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'tugas_php';
```
### 3.3 Menjalankan Aplikasi
Jalankan server PHP di folder project:
php -S localhost:8000

Akses aplikasi melalui browser:
http://localhost:8000

# 4. Contoh Skenario Uji Singkat
## 4.1 Tambah 1 Data
1. Buka create.php
2. Isi form dan upload foto
3. Klik Simpan
4. Berhasil masuk ke daftar mahasiswa

## 4.2 Tampilkan Daftar Data
1. Buka members.php
2. Semua data tampil dalam tabel

## 4.3 Ubah Data Tertentu
1. Klik Edit pada salah satu baris
2. Ubah nilai form
3. Klik Update

## 4.4 Hapus Data
1. Klik Hapus pada salah satu baris
2. Konfirmasi
3. Data terhapus dari tabel dan foto juga terhapus dari folder uploads