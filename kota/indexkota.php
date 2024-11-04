<?php
include_once(__DIR__ . '/../koneksi.php');

// Fetch cities with province names
$stmt = $pdo->query("SELECT k.*, p.nama_provinsi 
                     FROM kota k 
                     JOIN provinsi p ON k.id_provinsi = p.id_provinsi");
$kotas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff;
        }
        h2 {
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
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar Kota</h2>

        <!-- Button Container -->
        <div class="button-container">
            <a href="../index.php" class="btn btn-secondary">Kembali</a>
            <a href="kota/tambah.php" class="btn btn-primary">Tambah Kota</a>
        </div>

        <!-- Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= $_SESSION['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- City Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Kota</th>
                        <th>Nama Kota</th>
                        <th>Provinsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($kotas as $kota): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($kota['id_kota']) ?></td>
                            <td><?= htmlspecialchars($kota['nama_kota']) ?></td>
                            <td><?= htmlspecialchars($kota['nama_provinsi']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="location.href='kota/edit.php?id=<?= htmlspecialchars($kota['id_kota']) ?>'">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="location.href='kota/hapus.php?id=<?= htmlspecialchars($kota['id_kota']) ?>'">
                                    Hapus
                                </button>
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