<?php
<<<<<<< Updated upstream
session_start();
include '../koneksi.php';

if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header('Location: ../index.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM jenis");
$jenis = $stmt->fetchAll();
=======
include_once(__DIR__ . '/../koneksi.php');

try {
    $stmt = $pdo->query("SELECT * FROM jenis");
    $jenis = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("ERROR: Could not execute query. " . $e->getMessage());
}
>>>>>>> Stashed changes
?>

<!DOCTYPE html>
<html lang="en">

<<<<<<< Updated upstream
=======
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

>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
    </style>
    <title>Manage Jenis</title>
=======
        
        .button-container {
            margin-bottom: 20px;
            display: flex;
            gap: 10px; /* Memberikan jarak antara tombol */
        }
    </style>
>>>>>>> Stashed changes
</head>

<body>
    <div class="container mt-5">
<<<<<<< Updated upstream
        <h1 class="text-center">Manage Jenis</h1>
        <div class="text-right mb-3">
            <a href="tambah.php" class="btn btn-success">Add Jenis</a>
            <a href="../index.php" class="btn btn-secondary">Back</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Jenis</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jenis as $item): ?>
                    <tr>
                        <td><?= $item['id_jenis'] ?></td>
                        <td><?= htmlspecialchars($item['nama_jenis']) ?></td>
                        <td>
                            <a href="ubah.php?id=<?= $item['id_jenis'] ?>" class="btn btn-warning">Edit</a>
                            <a href="hapus.php?id=<?= $item['id_jenis'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this jenis?');">Delete</a>
=======
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Negara</h1>
        <div class="button-container">
            <a href="index.php" class="btn btn-secondary">Kembali</a>
            <a href="jenis/tambah.php" class="btn btn-primary">Tambah Jenis</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Jenis</th>
                    <th>Nama Jenis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($jenis as $jenis) : 
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?= htmlspecialchars($jenis['id_jenis']) ?></td>
                        <td><?= htmlspecialchars($jenis['nama_jenis']) ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="location.href='jenis/edit.php?id=<?= htmlspecialchars($jenis['id_jenis']) ?>'">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="location.href='jenis/hapus.php?id=<?= htmlspecialchars($jenis['id_jenis']) ?>'">
                                Hapus
                            </button>
>>>>>>> Stashed changes
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
</html>