<?php
include_once(__DIR__ . '/../koneksi.php');

try {
    $stmt = $pdo->query("SELECT * FROM pameran"); // Mengubah dari museum ke pameran
    $pameran = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("ERROR: Could not execute query. " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pameran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff;
        }
        h1 {
            color: #007bff;
        }
        .table {
            background-color: #ffffff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-warning, .btn-danger {
            color: white;
        }
        .button-container {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }
        .alert {
            margin-top: 20px;
        }
        .alert-dismissible .close {
            padding: 0.5rem 1.25rem;
        }
        .btn-sm {
            margin: 2px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Pameran</h1>
        
        <div class="button-container">
            <a href="../index.php" class="btn btn-secondary">Kembali</a>
            <a href="pameran/tambah.php" class="btn btn-primary">Tambah Pameran</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>ID Pameran</th>
                        <th>ID Jenis Kunjungan</th>
                        <th>ID Museum</th>
                        <th>ID Tipe Akses</th>
                        <th>Nama Pameran</th>
                        <th>Deskripsi</th>
                        <th>Batas Pengunjungan</th>
                        <th>Penyelenggaraan</th>
                        <th>Harga</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($pameran as $pam) : 
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?= htmlspecialchars($pam['id_pameran']) ?></td>
                            <td><?= htmlspecialchars($pam['id_jenis_kunjungan']) ?></td>
                            <td><?= htmlspecialchars($pam['id_museum']) ?></td>
                            <td><?= htmlspecialchars($pam['id_tipe_akses']) ?></td>
                            <td><?= htmlspecialchars($pam['nama_pameran']) ?></td>
                            <td><?= htmlspecialchars($pam['deskripsi']) ?></td>
                            <td><?= htmlspecialchars($pam['batas_pengunjungan']) ?></td>
                            <td><?= htmlspecialchars($pam['penyelenggaraan']) ?></td>
                            <td><?= htmlspecialchars($pam['harga']) ?></td>
                            <td><?= htmlspecialchars($pam['tanggal_mulai']) ?></td>
                            <td><?= htmlspecialchars($pam['tanggal_selesai']) ?></td>
                            <td>
                                <a href="edit.php?id=<?= htmlspecialchars($pam['id_pameran']) ?>" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <a href="hapus.php?id=<?= htmlspecialchars($pam['id_pameran']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>