<?php
session_start();
include '../koneksi.php';

// Fetch cities for the dropdown
$stmt = $pdo->query("SELECT * FROM kota");
$kotas = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_museum = $_POST['id_museum'];
    $nama_museum = $_POST['nama_museum'];
    $deskripsi = $_POST['deskripsi'];
    $hari_operasional = $_POST['hari_operasional'];
    $jam_buka = $_POST['jam_buka'];
    $jam_tutup = $_POST['jam_tutup'];
    $no_telp = $_POST['no_telp'];
    $id_kota = $_POST['id_kota'];

    $stmt = $pdo->prepare("INSERT INTO museum (id_museum, nama_museum, deskripsi, hari_operasional, jam_buka, jam_tutup, no_telp, id_kota) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$id_museum, $nama_museum, $deskripsi, $hari_operasional, $jam_buka, $jam_tutup, $no_telp, $id_kota]);
    $_SESSION['success'] = "Museum added successfully!";
    header('Location: ../index.php?page=museum');
    exit;
}
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
    <title>Add Museum</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Add Museum</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="id_museum">Museum Id</label>
                <input type="text" class="form-control" id="id_museum" name="id_museum" placeholder="id_museum" value="M" required>
                <label for="nama_museum">Museum Name</label>
                <input type="text" class="form-control" id="nama_museum" name="nama_museum" placeholder="nama_museum" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Description</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="hari_operasional">Operational Days</label>
                <input type="text" class="form-control" id="hari_operasional" name="hari_operasional" placeholder="hari_operasional" required>
            </div>
            <div class="form-group">
                <label for="jam_buka">Opening Time</label>
                <input type="time" class="form-control" id="jam_buka" name="jam_buka" placeholder="jam_buka" required>
            </div>
            <div class="form-group">
                <label for="jam_tutup">Closing Time</label>
                <input type="time" class="form-control" id="jam_tutup" name="jam_tutup" placeholder="jam_tutup" required>
            </div>
            <div class="form-group">
                <label for="no_telp">Contact Number</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="no_telp" required>
            </div>
            <div class="form-group">
                <label for="id_kota">City</label>
                <select class="form-control" id="id_kota" name="id_kota" placeholder="id_kota" required>
                    <option value="">Select City</option>
                    <?php foreach ($kotas as $kota): ?>
                        <option value="<?= $kota['id_kota'] ?>"><?= htmlspecialchars($kota['nama_kota']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Museum</button>
            <a href="Location: ../index.php?page=museum" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>