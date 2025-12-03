<?php
    require_once __DIR__ . '/inc/config.php';
    $prefill = Utility::getPrefill(['nama', 'nim', 'prodi', 'angkatan', 'status']);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tambah Mahasiswa</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <?php Utility::showNav(); ?>
        
        <h2>Tambah Mahasiswa</h2>

        <?php Utility::showFlash(); ?>


        <form action="save.php" method="post" enctype="multipart/form-data">

            <label>Nama</label>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($prefill['nama']); ?>" required>

            <label>NIM</label>
            <input type="text" name="nim" value="<?php echo htmlspecialchars($prefill['nim']); ?>" required>

            <label>Prodi</label>
            <select name="prodi" required>
                <option value="">-- Pilih Prodi --</option>
                <?php
                $prodiList = ['SI','TI','MI','DKV'];
                foreach ($prodiList as $p) {
                    $selected = ($prefill['prodi'] === $p) ? 'selected' : '';
                    echo "<option value=\"$p\" $selected>$p</option>";
                    }
                ?>
            </select>

            <label>Angkatan</label>
            <input type="number" name="angkatan"
                value="<?php echo htmlspecialchars($prefill['angkatan']); ?>" min="2000" max="2100" required>

            <label>Status</label>
            <select name="status" required>
                <option value="aktif" <?php echo ($prefill['status'] === 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                <option value="tidak_aktif" <?php echo ($prefill['status'] === 'tidak_aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
            </select>

            <label>Foto (jpg/png, max 2MB)</label>
            <input type="file" name="foto" accept="image/*">

            <button type="submit" class="btn">Simpan</button>
        </form>

    </body>
</html>