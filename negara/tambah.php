<?php
session_start();
include '../koneksi.php';

// Check if the user is authorized
if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_negara = $_POST['id_negara'];
    $nama_negara = $_POST['nama_negara'];

    // Validasi input
    if (empty($id_negara) || empty($nama_negara)) {
        $_SESSION['error'] = "ID Negara dan Nama Negara harus diisi.";
    } else {
        // Insert negara ke dalam database
        $stmt = $pdo->prepare("INSERT INTO negara (id_negara, nama_negara) VALUES (?, ?)");
        
        if ($stmt->execute([$id_negara, $nama_negara])) {
            $_SESSION['success'] = "Negara telah ditambahkan!";
            header('Location: index.php'); // Redirect ke halaman index
            exit;
        } else {
            $_SESSION['error'] = "Terjadi kesalahan saat menambahkan negara.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Tambah Negara</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tambah Negara</h1>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>ID Negara</label>
                <input type="text" name="id_negara" class="form-control" value="<?= htmlspecialchars($id_negara ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Nama Negara</label>
                <input type="text" name="nama_negara" class="form-control" value="<?= htmlspecialchars($nama_negara ?? '') ?>">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>