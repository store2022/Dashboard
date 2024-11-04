<?php
include_once(__DIR__ . '/../koneksi.php');

// Fetch provinces with country names
$stmt = $pdo->query("SELECT p.*, n.nama_negara 
                     FROM provinsi p 
                     JOIN negara n ON p.id_negara = n.id_negara");
$provinces = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">

<style>
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
            gap: 10px; /* Memberikan jarak antara tombol */
        }
    </style>
</head>

<head>
    <meta charset="container mt-5">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div class="button-container">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Provinsi</h1>
        
        <!-- Add Province Button -->
        <div class="button-container">
            <a href="index.php" class="btn btn-secondary">Kembali</a>
            <a href="provinsi/tambah.php" class="btn btn-primary">Tambah Provinsi</a>
        </div>

        <!-- Province Table -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Provinsi</th>
                    <th>Nama Provinsi</th>
                    <th>Negara</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($provinces as $province): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($province['id_provinsi']) ?></td>
                        <td><?= htmlspecialchars($province['nama_provinsi']) ?></td>
                        <td><?= htmlspecialchars($province['nama_negara']) ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="location.href='provinsi/edit.php?id=<?= htmlspecialchars($province['id_provinsi']) ?>'">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="location.href='provinsi/hapus.php?id=<?= htmlspecialchars($province['id_provinsi']) ?>'">
                                Hapus
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>