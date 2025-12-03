<?php
    require_once __DIR__ . '/inc/config.php';

    $mhs = new Mahasiswa();
    $data = $mhs->getAll();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Daftar Mahasiswa</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>

<?php Utility::showNav(); ?>

<h2>Daftar Mahasiswa</h2>

<?php Utility::showFlash(); ?>

<a href="create.php" class="btn">+ Tambah Mahasiswa</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Prodi</th>
            <th>Angkatan</th>
            <th>Foto</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($data)): ?>
        <tr>
            <td colspan="8">Belum ada data.</td>
        </tr>
        <?php else: ?>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                <td><?php echo htmlspecialchars($row['nim']); ?></td>
                <td><?php echo htmlspecialchars($row['prodi']); ?></td>
                <td><?php echo htmlspecialchars($row['angkatan']); ?></td>
                <td>
                    <?php if (!empty($row['foto_path'])): ?>
                        <img src="<?php echo htmlspecialchars($row['foto_path']); ?>" alt="foto" style="width:60px;height:auto;">
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                    <form action="delete.php" method="post" style="display:inline;" onsubmit="return confirm('Yakin hapus data ini?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>
