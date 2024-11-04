<?php
include_once(__DIR__ . '/../koneksi.php');

try {
    $stmt = $pdo->query("SELECT * FROM museum");
    $museum = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("ERROR: Could not execute query. " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

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

<body>
    <div class="container mt-5">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Museum</h1>
        <div class="button-container">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <a href="museum/tambah.php" class="btn btn-primary">Tambah Museum</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Museum</th>
                    <th>Nama Museum</th>
                    <th>Deskripsi</th>
                    <th>Hari Operasional</th>
                    <th>Jam Buka</th>
                    <th>Jam Tutup</th>
                    <th>NO.TELP</th>
                    <th>id_kota</th
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($museum as $museum) : 
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?= htmlspecialchars($museum['id_museum']) ?></td>
                        <td><?= htmlspecialchars($museum['nama_museum']) ?></td>
                        <td><?= htmlspecialchars($museum['deskripsi']) ?></td>
                        <td><?= htmlspecialchars($museum['hari_operasional']) ?></td>
                        <td><?= htmlspecialchars($museum['jam_buka']) ?></td>
                        <td><?= htmlspecialchars($museum['jam_tutup']) ?></td>
                        <td><?= htmlspecialchars($museum['no_telp']) ?></td>
                        <td><?= htmlspecialchars($museum['id_kota']) ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="location.href='museum/edit.php?id=<?= htmlspecialchars($museum['id_museum']) ?>'">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="location.href='museum/hapus.php?id=<?= htmlspecialchars($museum['id_museum']) ?>'">
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