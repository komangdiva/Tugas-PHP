<?php
require_once __DIR__ . '/inc/config.php';

$id = $_GET['id'] ?? null;

if ($id === null || !ctype_digit($id)) {
    Utility::redirect('members.php', 'ID tidak valid.');
}

$mhs = new Mahasiswa();
$row = $mhs->getById((int)$id);

if (!$row) {
    Utility::redirect('members.php', 'Data tidak ditemukan.');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Mahasiswa</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php Utility::showNav(); ?>

        <h2>Edit Mahasiswa</h2>

        <form action="update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

            <label>Nama</label>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required>

            <label>NIM</label>
            <input type="text" name="nim" value="<?php echo htmlspecialchars($row['nim']); ?>" required>

            <label>Prodi</label>
            <select name="prodi" required>
                <?php
                $prodiList = ['SI','TI','MI','DKV'];
                foreach ($prodiList as $p) {
                    $selected = ($row['prodi'] === $p) ? 'selected' : '';
                    echo "<option value=\"$p\" $selected>$p</option>";
                    }
                ?>
            </select>

            <label>Angkatan</label>
            <input type="number" name="angkatan" min="2000" max="2100"
                value="<?php echo htmlspecialchars($row['angkatan']); ?>" required>

            <label>Status</label>
            <select name="status" required>
                <option value="aktif" <?php echo ($row['status'] === 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                <option value="tidak_aktif" <?php echo ($row['status'] === 'tidak_aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
            </select>

            <button type="submit" class="btn">Update</button>
        </form>
    </body>
</html>
