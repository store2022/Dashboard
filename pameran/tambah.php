<?php
session_start();
include '../koneksi.php';

// Fetch jenis kunjungan dan tipe akses untuk dropdown
$stmt = $pdo->query("SELECT * FROM jenis_kunjungan");
$jenis_kunjungan = $stmt->fetchAll();

$stmt = $pdo->query("SELECT * FROM tipe_akses");
$tipe_akses = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pameran = $_POST['id_pameran'];
    $id_jenis_kunjungan = $_POST['id_jenis_kunjungan'];
    $id_museum = $_POST['id_museum'];
    $id_tipe_akses = $_POST['id_tipe_akses'];
    $nama_pameran = $_POST['nama_pameran'];
    $deskripsi = $_POST['deskripsi'];
    $batas_pengunjungan = $_POST['batas_pengunjungan'];
    $penyelenggaraan = $_POST['penyelenggaraan'];
    $harga = $_POST['harga'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];

    $stmt = $pdo->prepare("INSERT INTO pameran (id_pameran, id_jenis_kunjungan, id_museum, id_tipe_akses, nama_pameran, deskripsi, batas_pengunjungan, penyelenggaraan, harga, tanggal_mulai, tanggal_selesai) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$id_pameran, $id_jenis_kunjungan, $id_museum, $id_tipe_akses, $nama_pameran, $deskripsi, $batas_pengunjungan, $penyelenggaraan, $harga, $tanggal_mulai, $tanggal_selesai]);
    
    $_SESSION['success'] = "Pameran added successfully!";
    header('Location: ../index.php?page=pameran'); // Redirect ke halaman daftar pameran
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pameran</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        h1 {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tambah Pameran</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="id_pameran">ID Pameran</label>
                <input type="text" class="form-control" id="id_pameran" name="id_pameran" value="P" required>
            </div>
            <div class="form-group">
                <label for="id_jenis_kunjungan">Jenis Kunjungan</label>
                <select class="form-control" id="id_jenis_kunjungan" name="id_jenis_kunjungan" required>
                    <option value="">Pilih Jenis Kunjungan</option>
                    <?php foreach ($jenis_kunjungan as $jk): ?>
                        <option value="<?= $jk['id_jenis_kunjungan'] ?>"><?= htmlspecialchars($jk['jenis_kunjungan']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_museum">ID Museum</label>
                <input type="text" class="form-control" id="id_museum" name="id_museum" value="M" required>
            </div>
            <div class="form-group">
                <label for="id_tipeakses">Tipe Akses</label>
                <select class="form-control" id="id_tipeakses" name="id_tipeakses" required>
                    <option value="">Pilih Tipe Akses</option>
                    <?php foreach ($tipe_akses as $ta): ?>
                        <option value="<?= $ta['id_tipe_akses'] ?>"><?= htmlspecialchars($ta['nama_tipe_akses']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_pameran">Nama Pameran</label>
                <input type="text" class="form-control" id="nama_pameran" name="nama_pameran" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="batas_pengunjungan">Batas Pengunjungan</label>
                <input type="number" class="form-control" id="batas_pengunjungan" name="batas_pengunjungan" required>
            </div>
            <div class="form-group">
                <label for="penyelenggaraan">Penyelenggaraan</label>
                <input type="text" class="form-control" id="penyelenggaraan" name="penyelenggaraan" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
            </div>
            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Pameran</button>
            <button type="button" class="btn btn-secondary" onclick="location.href='Location: ../index.php?page=pameran'">Cancel</button>
        </form>
    </div>
</body>
</html>