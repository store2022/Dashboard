<?php 
session_start(); 
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php'); 
    exit();
}

// Ambil data museum
$sql = "SELECT m.*, k.nama AS kota_nama FROM museum m JOIN kota k ON m.kota_id = k.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Daftar Museum</title>
</head>
<body>
    <h1>Daftar Museum</h1>
    <a href="create.php">Tambah Museum</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Museum</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                        <td><?php echo htmlspecialchars($row['kota_nama']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus museum ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Tidak ada data museum</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
