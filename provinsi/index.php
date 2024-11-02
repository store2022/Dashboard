<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Include the database connection file
require_once '../koneksi.php'; // Adjust the path to your connection file

// Fetch provinces and their corresponding country names from the database
$stmt = $pdo->query("
    SELECT p.*, n.nama_negara 
    FROM provinsi p 
    LEFT JOIN negara n ON p.id_negara = n.id_negara
");
$provinces = $stmt->fetchAll(); // Store the fetched data in $provinces
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        h1 {
            color: #007bff;
        }
        .table {
            background-color: #ffffff;
            border: 1px solid #dee2e6; /* Add border to the table */
        }
        .table th, .table td {
            border: 1px solid #dee2e6; /* Add border to table cells */
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-warning, .btn-danger {
            color: white;
        }
    </style>
    <title>Kelola Provinsii</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Kelola Provinsi</h1>
        <div class="text-right mb-3">
            <a href="tambah.php" class="btn btn-success">Tambah Provinsi</a>
            <a href="../index.php" class="btn btn-secondary">Kembali</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th> <!-- Column for row number -->
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Negara</th>
                    <th>Operasi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($provinces): ?> <!-- Check if provinces are available -->
                    <?php foreach ($provinces as $index => $province): ?>
                        <tr>
                            <td><?= $index + 1 ?></td> <!-- Row number starting from 1 -->
                            <td><?= htmlspecialchars($province['id_provinsi']) ?></td>
                            <td><?= htmlspecialchars($province['nama_provinsi']) ?></td>
                            <td><?= htmlspecialchars($province['nama_negara']) ?></td>
                            <td>
                                <a href="ubah.php?id=<?= $province['id_provinsi'] ?>" class="btn btn-warning">Edit</a>
                                <a href="hapus.php?id=<?= $province['id_provinsi'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus provinsi ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data provinsi.</td> <!-- Message when no provinces are found -->
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>