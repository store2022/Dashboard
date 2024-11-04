<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header('Location: ../index.php');
    exit;
}

$stmt = $pdo->query("SELECT koleksi.id_koleksi, koleksi.nama_koleksi, koleksi.deskripsi, koleksi.jumlah_koleksi, 
                     museum.nama_museum, kategori.nama_kategori
                     FROM koleksi
                     JOIN museum ON koleksi.id_museum = museum.id_museum
                     JOIN kategori ON koleksi.id_kategori = kategori.id_kategori");
$koleksis = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

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
    </style>
    <title>Manage Koleksi</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Manage Koleksi</h1>
        <div class="text-right mb-3">
            <a href="tambah.php" class="btn btn-success">Add Koleksi</a>
            <a href="../index.php" class="btn btn-secondary">Back</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Koleksi</th>
                    <th>Deskripsi</th>
                    <th>Museum</th>
                    <th>Jumlah Koleksi</th>
                    <th>Kategori</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($koleksis as $koleksi): ?>
                    <tr>
                        <td><?= $koleksi['id_koleksi'] ?></td>
                        <td><?= htmlspecialchars($koleksi['nama_koleksi']) ?></td>
                        <td><?= htmlspecialchars($koleksi['deskripsi']) ?></td>
                        <td><?= htmlspecialchars($koleksi['nama_museum']) ?></td>
                        <td><?= htmlspecialchars($koleksi['jumlah_koleksi']) ?></td>
                        <td><?= htmlspecialchars($koleksi['nama_kategori']) ?></td>
                        <td>
                            <a href="ubah.php?id=<?= $koleksi['id_koleksi'] ?>" class="btn btn-warning">Edit</a>
                            <a href="hapus.php?id=<?= $koleksi['id_koleksi'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this koleksi?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>